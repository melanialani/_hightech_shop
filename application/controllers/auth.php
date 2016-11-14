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
class Auth extends CI_Controller {

    /**
     * Yang bisa mengakses controller auth hanyalah user yang belum login
     * Jika user sudah login maka secara otomatis akan diredirect ke
     * profile halamannya sendiri.
     */
    public function __construct(){
		parent::__construct();
		$this->load->helper('url');
        $this->load->library('session');
        $this->load->model('customer_model');
        $this->load->helper('form');

        // Kalau sudah login di redirect ke Profile Controller
        if ($this->session->userdata('p_username')){
            redirect('profile');
        }
	}

    /**
     * Langsung Cek Login
     */
    public function index(){
        redirect('auth/login');
	}

    /**
     * Show the Register form and Check User Registration Data
     * before inserting to the database
     */
    public function register(){
		$this->load->helper('form');
		// Cek Button User Register
		if ($this->input->post('btnRegister')){
			$this->load->library('form_validation');
			$this->load->database();
			$this->form_validation->set_rules('username','Username','max_length[15]|required|trim|min_length[4]|alpha_numeric|is_unique[users.username]');
			$this->form_validation->set_rules('password','Password','max_length[15]|required|trim|min_length[6]|alpha_numeric');
			$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('conf_password','Confirm Password','required|matches[password]|trim');
			$this->form_validation->set_rules('agreeTerms','Terms and Conditions','required');
			if ($this->form_validation->run()){
                $this->load->library('curl');
                $arr = json_decode($this->curl->simple_post('https://www.google.com/recaptcha/api/siteverify',
                        ['secret' => '6Lfz6-8SAAAAADfmzCkF1Jd4Tb8r1XH0TmQ2Dcsa',
                            'response'=> $this->input->post('g-recaptcha-response'),
                            'remoteip' => $this->session->userdata('ip_address')
                        ], ['SSL_VERIFYPEER' => false])
                );
                if ($arr->success) {
                    $this->load->library('email');
                    $this->email->to($this->input->post('email'));
                    $this->email->from('admin@hightechshop.hol.es', 'Admin HighTech Shop');
                    $this->email->subject('Welcome to High Tech Shop');
                    $this->email->message($this->load->view('email/welcome', null, true));
                    if ($this->email->send()) {
                        $success = $this->customer_model->registerUser($this->input->post('username'), $this->input->post('email'), $this->input->post('password'));
                        if ($success) {
                            $this->session->set_flashdata('alert_level', 'success');
                            $this->session->set_flashdata('alert', '<strong>Menunggu Verifikasi Email Anda!</strong><br/>Terima kasih telah bergabung dengan High Tech Shop');
                            $this->email->to($this->input->post('email'));
                            $this->email->from('admin@hightechshop.hol.es', 'Admin HighTech Shop');
                            $data['link'] = anchor('auth/activate?key=' . $success, 'Activate Your Account Now');
                            $this->email->subject('Confirm your account | High Tech Shop');
                            $this->email->message($this->load->view('email/confirm', $data, true));
                            $this->email->send();
                            redirect('auth/login');
                        }
                    } else {
                        $this->session->set_flashdata('alert_level', 'danger');
                        $this->session->set_flashdata('alert', 'Email tidak valid.');
//                        echo $this->email->print_debugger();
                        redirect('auth/login');
                    }
                }
                else {
                    $this->session->set_flashdata('alert_level', 'danger');
                    $this->session->set_flashdata('alert', 'Human Verification failed.');
                    redirect('auth/register');
                }

			}
		}
        $data['title'] = "Register to HighTech Shop";
		$this->load->view('header',$data);
		$this->load->view('user/register');
		$this->load->view('footer');
	}

    /**
     *  Show the Login Form
     */
    public function login(){
        $data['title'] = "Login to HighTech Mall";
        $this->load->helper('form');
        $this->load->view('header',$data);
        $this->load->view('user/login');
        $this->load->view('footer');

    }

    /**
     * Method yang digunakan untuk Sign In secara umum pada customer
     * Disini terdapat pengecekan untuk Customer. Customer yang dapat login hanyalah
     * Customer yang sudah melakukan verifikasi email dan Customer dengan user_role =3 atau customer_verified
     */
    public function do_login(){
        if ($this->input->post('btnSignIn')){
            $cekLogin = $this->customer_model->checkUserLogin($this->input->post('username'), $this->input->post('password'));
            if ($cekLogin == 0) {
                $this->session->set_flashdata('alert_level', 'danger');
                $this->session->set_flashdata('alert', 'Username / Password doesn\'t match.');
                redirect('auth/login');
            }
            else if($cekLogin == -1){ // Jika dia adalah user yang belum melakukan verifikasi email.
                $this->session->set_flashdata('alert_level', 'danger');
                $this->session->set_flashdata('alert', 'Please verify your email before login.');
                redirect('auth/login');
            }
            else{
                if(strpos($this->input->post('username'),'@')){
                    $cekLogin = $this->customer_model->getUsernameByEmail($this->input->post('username'));
                }
                else{
                    $cekLogin = $this->input->post('username');
                }
                $this->session->set_userdata('p_username', $cekLogin);
                if ($this->session->userdata('current_url')){
                    $temp = $this->session->userdata('current_url');
                    $this->session->unset_userdata('current_url');
                    redirect($temp);
                }
                else if ($this->input->post('current_url')){
                    redirect($this->input->post('current_url'));
                }
                redirect('profile');
            }
        }
        else{
            redirect('auth');
        }
    }


    public function activate(){
        if ($this->input->get('key')){
            $success = $this->customer_model->activateCustomer($this->input->get('key'));
            if ($success){
                $this->session->set_flashdata('alert_level', 'success');
                $this->session->set_flashdata('alert', 'Successfully activate the account. Now, you can login.');
            }
            else{
                $this->session->set_flashdata('alert_level', 'danger');
                $this->session->set_flashdata('alert', 'Cannot activate user by given credentials.');
            }
            redirect('auth/login');
        }
        //redirect('auth');
    }

    public function forgot_password(){
        $data['title'] = "Reset Password | Aftervow";
        if ($this->input->post('btnResetPassword')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('reset_email','Reset Email','required|trim|valid_email');
            if ($this->form_validation->run()){
                $email = $this->input->post('reset_email');
                $key = $this->customer_model->resetCustomerPassword($email);
                if ($key == -1){ // Email belum terdaftar
                    $this->session->set_flashdata('alert_level', 'warning');
                    $this->session->set_flashdata('alert', 'There\'s no user registered with that email.');
                    redirect('auth/forgot_password');
                }
                else {
                    // Send Email && Reset the PASSWORD

                    $this->load->library('email');
                    $this->email->to($email);
                    $this->email->from('admin@hightechshop.hol.es','Admin HighTech Shop');
                    $this->email->subject('Reset your account');
                    $data['link'] = anchor('auth/reset_password?forgot_key=' . $key, 'Reset Password');
                    $this->email->message($this->load->view('email/reset_password',$data,true));
                    if ($this->email->send()) {
                        $this->session->set_flashdata('alert_level', 'success');
                        $this->session->set_flashdata('alert', 'Email Sent. Please Check your email to reset your password.');
                        redirect('auth/forgot_password');
                    }
                    else {
                        $this->session->set_flashdata('alert_level', 'danger');
                        $this->session->set_flashdata('alert', 'Cannot Send Email');
                        redirect('auth/forgot_password');
                    }
                }
            }
        }
        $this->load->view('header',$data);
        $this->load->view('user/forgot_password');
        $this->load->view('footer');
    }


    public function reset_password(){
        $key = '';
        if ($this->input->post('btnChangeReset')){ // Password sudah disubmit
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password','Password','max_length[15]|required|trim|min_length[6]|alpha_numeric');
            $this->form_validation->set_rules('conf_password','Confirm Password','required|matches[password]|trim');
            $key = $this->encrypt->decode($this->input->post('key'));
            if ($this->form_validation->run()){


                $success = $this->customer_model->resetPassword($key,$this->input->post('password'));
                if ($success){
                    $this->session->set_flashdata('alert_level', 'success');
                    $this->session->set_flashdata('alert', 'Successfully reset your password. Now you can login as usual.');
                    redirect('auth/login');
                }
            }
        }
        if ($this->input->get('forgot_key') || $key != ''){
            if ($key == '') { // Jika kosong berarti mengambil data dari get
                $key = $this->input->get('forgot_key');
            }
            if ($this->customer_model->isForgotKeyExist($key)){
                $data['title'] = 'Confirm Your New Password | Aftervow';
                $data['key'] = $this->encrypt->encode($key);
                $this->load->view('header',$data);
                $this->load->view('user/change_password_after_reset',$data);
                $this->load->view('footer');
            }
            else {
                redirect('/');
            }
        }
        else{
            redirect('auth');
        }

    }


}