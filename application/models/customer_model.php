<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Sha1 $sha1
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 *
 * Add additional libraries you wish
 * to use in your controllers here
 *
 * @property Customer_model $customer_model
 *
 */
class Customer_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('encrypt');
	}
	public function registerUser($username, $email,  $password){
        $rand = random_string('alpha',32);
		$data = [ 'username' => $username ,
				'password' => $this->encrypt->encode($password),
				'email' => $email,
                'kode_verifikasi' => $rand,
                'role' => 'customer',
				'status' => 0 // tidak konfirmasi tidak dianggap sebagai user
				];
        $this->db->set('tanggal_lahir','now()',false);
		$this->db->insert('users', $data);
        // Mengirimkan Verifikasi Email
        if ($this->db->affected_rows()){
            return $rand;
        }
        return 0;

	}
	public function checkUserLogin($username, $password){
		$this->db->select('password, status,  role');
		$this->db->where('username',$username);
		$this->db->or_where('email',$username);
		$result = $this->db->get('users')->row();
		if ($this->db->affected_rows() > 0) {
            if($result->role == 'customer') { //Jika User adalah customer
                $correctPassword = $this->encrypt->decode($result->password);
                if ($correctPassword == $password) {
                    if ($result->status == 0) { // Jika belum terverifikasi
                        return -1;
                    }
                    return 1;
                }
            }
        }
        return 0;
	}
	public function getUser($username){
        $this->db->where('username', $username);
        $this->db->where('status >',0);
        return $this->db->get('users')->row();
    }
    public function getUsernameByEmail($email){
        $this->db->select('username');
        $this->db->where('email',$email);
        return $this->db->get('users')->row()->username;
    }
    public function updateUserProfile($username,$nama_depan, $nama_belakang, $tgl_lahir,$alamat, $kota,$provinsi, $telepon, $provinsi_id, $kota_id){
        $data = ['nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'alamat' => $alamat,
            'kota' => $kota,
            'telepon' => $telepon,
            'provinsi' => $provinsi,
            'provinsi_id' => $provinsi_id,
            'kota_id' => $kota_id
        ];
        $this->db->set('tanggal_lahir', date_format(date_create_from_format('d/m/Y',$tgl_lahir),'Y-m-d'));
        $this->db->where('username',$username);
        $this->db->update('users',$data);
        return $this->db->affected_rows();
    }
    public function setPassword($username,$password){
        $this->db->where('username',$username);
        $this->db->set('password',$this->encrypt->encode($password));
        $this->db->update('users');
        return $this->db->affected_rows();
    }

    public function activateCustomer($key){
        // Activate User
        $this->db->set('status',1);
        $this->db->where('kode_verifikasi',$key);
        $this->db->update('users');

        // Hapuskan Users_verification_code
        $this->db->set('kode_verifikasi','');
        $this->db->where('kode_verifikasi',$key);
        $this->db->update('users');

        return $this->db->affected_rows();

    }
    public function resetCustomerPassword($email){
        $this->db->where('email', $email);
        $this->db->get('users');
        if ($this->db->affected_rows() == 0){
            return -1; // There is no account with that emails
        }
        $key =  random_string('alpha',32);
        $data = ['kode_verifikasi' => $key];
        $this->db->where('email', $email);
        $this->db->update('users',$data);
        return $key;
    }
    public function isForgotKeyExist($key){
        $this->db->where('kode_verifikasi',$key);
        $this->db->from('users');
        return $this->db->count_all_results();
    }
    public function resetPassword($key, $password){
        $this->db->select('username');
        $this->db->where('kode_verifikasi',$key);
        $this->db->from('users');
        $username = $this->db->get()->row()->username;
        // Hapuskan Users_verification_code
        $this->db->set('kode_verifikasi','');
        $this->db->where('username',$username);
        $this->db->update('users');
        return $this->setPassword($username,$password);
    }
    public function getListProvince(){
        $this->load->library('curl');
        $arr = json_decode($this->curl->simple_get('http://api.rajaongkir.com/starter/province',['key' => 'aa9e53551783cc4033336ff25586148f']));
        $arrProvince = $arr->rajaongkir->results;
        $provinces = [];
        foreach ($arrProvince as $province){
            $provinces[$province->province_id] = $province->province;
        }
        return $provinces;
    }
    public function getListCity($province_id){
        $this->load->library('curl');
        $arr = json_decode($this->curl->simple_get('http://api.rajaongkir.com/starter/city',
            ['key' => 'aa9e53551783cc4033336ff25586148f',
                'province' => $province_id
            ]
        ));
        $arrCity = $arr->rajaongkir->results;
        $cities = [];
        foreach ($arrCity as $city){
            $cities[$city->city_id] = $city->city_name;
        }
        return $cities;
    }

}