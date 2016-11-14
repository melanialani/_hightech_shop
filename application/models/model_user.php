<?php

class Model_User extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->database();
	}
	
	public function get_all_user(){
		return $this->db->get('users')->result();
	}
	
	public function get_all_admin(){
		$myArr = array('status' => 1, 'role' => 'admin');
		$this->db->where($myArr);
		return $this->db->get('users')->result_array();
	}
	
	public function is_admin($username){
		
		$isAdmin = FALSE;
		
		$allAdmin = $this->get_all_admin();
		
		for ($i = 0; $i < count($allAdmin); $i++){
			if ($allAdmin[$i]['username'] == $username){
				$isAdmin = TRUE;
			}
		}
		
		return $isAdmin;
	}
	
	public function insert_admin($username, $password){
        $myArr = array(
        	'username' => $username,
        	'password' => $password,
        	'status' => 1,
        	'role' => 'admin'
        );
        
        $this->db->insert('users', $myArr);
        
        return $this->db->affected_rows();
	}
	
	/*
	public function insert_admin($username, $password, $nama_depan, $nama_belakang, $email, $tanggal_lahir, $alamat, $telepon, $status){
        $myArr = array(
        	'username' => $username,
        	'password' => $password,
        	'nama_depan' => $nama_depan,
        	'nama_belakang' => $nama_belakang,
        	'email' => $email,
        	'tanggal_lahir' => $tanggal_lahir,
        	'alamat' => $alamat,
        	'telepon' => $telepon,
        	'status' => $status,
        	'role' => 'admin'
        );
        
        $this->db->insert('user', $myArr);
        
        return $this->db->affected_rows();
	}
	
	public function update_admin($username, $nama_depan, $nama_belakang, $email, $tanggal_lahir, $alamat, $telepon, $status){
        $myArr = array(
        	'nama_depan' => $nama_depan,
        	'nama_belakang' => $nama_belakang,
        	'email' => $email,
        	'tanggal_lahir' => $tanggal_lahir,
        	'alamat' => $alamat,
        	'telepon' => $telepon,
        	'status' => $status
        );
        
        $this->db->where('username', $username);
        $this->db->update('user', $myArr);
        
        return $this->db->affected_rows();
	}
	*/
}

?>