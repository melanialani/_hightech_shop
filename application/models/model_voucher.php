<?php

class Model_Voucher extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->database();
	}
	
	public function get_all_voucher(){
		return $this->db->get('vouchers')->result();
	}
	
	public function get_voucher($id){
		$this->db->where('id', $id);
		return $this->db->get('vouchers')->result_array();
	}
	
	public function get_all_voucher_with_pagination($limit, $start){
		$this->db->limit($limit, $start);
		
		$query = $this->db->get('vouchers');
		return $query->result();
	}
	
	public function get_number_of_voucher_records(){
		return $this->db->count_all('vouchers');
	}
	
	public function get_ongoing_voucher() {
		$this->db->where('akhir >=', date('Y-m-d'));
		return $this->db->get('vouchers')->result();
	}
	
	public function get_ongoing_voucher_with_pagination($limit, $start) {
		$this->db->limit($limit, $start);
		$this->db->where('akhir >=', date('Y-m-d'));
		return $this->db->get('vouchers')->result();
	}
	
	public function insert_voucher($nama, $potongan_harga, $awal, $akhir){
        $myArr = array(
        	'nama' => $nama,
        	'potongan_harga' => $potongan_harga,
        	'awal' => $awal,
        	'akhir' => $akhir,
        	'status' => 1
        );
        
        $this->db->insert('vouchers', $myArr);
        
        return $this->db->affected_rows();
	}
	
	public function update_voucher($id, $nama, $potongan_harga, $awal, $akhir, $status){
        $myArr = array(
        	'nama' => $nama,
        	'potongan_harga' => $potongan_harga,
        	'awal' => $awal,
        	'akhir' => $akhir,
        	'status' => $status
        );
        
        $this->db->where('id', $id);
        $this->db->update('vouchers', $myArr);
        
        return $this->db->affected_rows();
	}
	
}

?>