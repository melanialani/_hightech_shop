<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

    public $user; // current user
    /**
     * Yang bisa mengakses controller profile, hanyalah user yang sudah login
     * Jika belum, maka akn diredirect ke auth/login.
     */
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');
        if (!$this->session->userdata('p_username')){
            $this->session->set_flashdata('alert_level','danger');
            $this->session->set_flashdata('alert','You need to login to view this page!');
            $this->session->set_userdata('current_url', uri_string());

            redirect('auth/login');
        }
        $username =  $this->session->userdata('p_username');
        $this->load->model('customer_model');
        $this->user = $this->customer_model->getUser($username);
    }

    private function _getCity(){
        $json = file_get_contents(base_url('assets/json/kota.json'));
        $arrCity =  json_decode($json);
        $temp_cities = $arrCity->Indonesia;
        $cities = [];
        foreach ($temp_cities as $city){
            $cities[$city] = $city;
        }
        return $cities;
    }
    /**
     * Show User's Profile and Change The Password
     */
    public function index(){
        if ($this->user->tanggal_lahir == '0000-00-00'){
            // Belum pernah setup sebelumnya tunjukkan form
            $this->session->set_flashdata('alert_level','warning');
            $this->session->set_flashdata('alert','Please finish your profile details!');
            redirect('profile/edit');
        }
        else {
            // Sudah set up tunjukkan data User
            if($this->input->post('btnChangePassword')){
                $this->load->library('form_validation');
                $this->form_validation->set_rules('old_password','Old Password','required|trim|callback_cekPasswordLama');
                $this->form_validation->set_rules('new_password','New Password','max_length[15]|required|trim|min_length[6]|alpha_numeric');
                $this->form_validation->set_rules('conf_password','Confirm Password','required|matches[new_password]|trim');

                if($this->form_validation->run()){
                    // nanti akan dijalankan
                    $cek = $this->customer_model->setPassword($this->user->username,$this->input->post('new_password'));
                    if ($cek){
                        $this->session->set_flashdata('alert_level','success');
                        $this->session->set_flashdata('alert','Successfully update your credentials.');
                        redirect('profile');
                    }
                }
            }
            $data['user'] = $this->user;
            $data['title'] = 'Profile User';
            $this->load->view('header',$data);
            $this->load->view('user/profile', $data);
            $this->load->view('footer');

        }
    }

    /**
     * Shows Edit Profile Form and check the data before updating.
     */
    public function edit(){
        $data = [];

        // if user updates its credentials
        if ($this->input->post('btnEditProfile')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name','First Name','required|trim|max_length[50]');
            $this->form_validation->set_rules('last_name','Last Name','trim|max_length[50]');
            $this->form_validation->set_rules('address','Address','trim|max_length[255]');
            $this->form_validation->set_rules('tanggal_lahir','Date of Birth', 'max_length[11]|callback_cekRegexTanggal');
            $this->form_validation->set_rules('telepon','Telephone', 'trim');
            $this->form_validation->set_rules('city_id','City','required|numeric');
            $this->form_validation->set_rules('provinsi_id','Province','required|numeric');

            IF ($this->form_validation->run()) {
                // Jika Update Berhasil
                $cekUpdate = $this->customer_model->updateUserProfile($this->user->username,
                    $this->input->post('first_name'),
                    $this->input->post('last_name'),
                    $this->input->post('tanggal_lahir'),
                    $this->input->post('address'),
                    $this->input->post('city'),
                    $this->input->post('provinsi'),
                    $this->input->post('telepon'),
                    $this->input->post('provinsi_id'),
                    $this->input->post('city_id'));
                if ($cekUpdate){
                    $this->session->set_flashdata('alert_level','success');
                    $this->session->set_flashdata('alert','Successfully update your profile!');
                    redirect('profile');
                }
                else {
                    $this->session->set_flashdata('alert_level','warning');
                    $this->session->set_flashdata('alert','There\'s no data to update!');
                    redirect('profile');
                }
            }
        }

        $data['user']= $this->user;
        if ($this->user->provinsi_id == "0"){
            $data['dd_city'] = $this->customer_model->getListCity(1);
        }
        else {
            $data['dd_city'] = $this->customer_model->getListCity($this->user->provinsi_id);
        }
        $data['dd_province'] = $this->customer_model->getListProvince();

        $data['title'] = 'Edit Profile User';
        $this->load->view('header',$data);
        $this->load->view('user/edit.php', $data);
        $this->load->view('footer.php');
    }

    /**
     * Checks the format of string to DD/MM/YYYY
     * @param $str string date
     * @return bool
     */
    public function cekRegexTanggal($str){
        if(preg_match('(([1-9]|[1-2][0-9]|0[1-9]|3[0-1])/([1-9]|0[1-9]|1[0-2])/[0-9]{4})',$str)){
            return true;
        }
        $this->form_validation->set_message('cekRegexTanggal','%s must be in DD/MM/YYYY format');
        return false;
    }

    /**
     * Log Outs the active customer and redirect to the auth/login
     */
    public function do_logout(){
        $this->session->unset_userdata('p_username');
        $this->session->set_flashdata('alert_level','success');
        $this->session->set_flashdata('alert','Successfully log out from Hightech Shop! . See you later!');
        redirect('auth/login');
    }

    /**
     * Check old password the same with $str
     * @param $str old password
     * @return bool
     */
    public function cekPasswordLama($str){
        $cek = $this->customer_model->checkUserLogin($this->user->username,$str);
        if ($cek){
            return true;
        }
        $this->form_validation->set_message('cekPasswordLama','%s is not correct!');
        return false;
    }

    public function getCity(){
        if ($this->input->post('province_id')){
            $arr = $this->customer_model->getListCity($this->input->post('province_id'));
            foreach ($arr as $key => $value){
                echo "<option value='$key'>$value</option>";
            }
        }
    }

    public function order(){
        $data['title'] = 'All Order ';
        $this->load->model('order_model');
        $data['orders'] = $this->order_model->getAllOrderByCustomer($this->session->userdata('p_username'));
        $this->load->view('header',$data);
        $this->load->view('user/order_list',$data);
        $this->load->view('footer');
    }

}