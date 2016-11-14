<?php

class Voucher_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getVoucher($username,$voucher_code){
        $this->db->select('id, potongan_harga');
        $this->db->where('nama',$voucher_code);
        $this->db->where('now() < akhir',null,false);
        $this->db->where('awal < now()',null,false);
        $result = $this->db->get('vouchers');
        if ($this->db->affected_rows() == 0){
            return -1; // Voucher tidak ditemukan
        }
        $voucher_id = $result->row()->id;
        $potongan_harga = $result->row()->potongan_harga;
        $this->db->where('user_username',$username);
        $this->db->where('voucher_id',$voucher_id);
        $this->db->get('user_voucher');
        if ($this->db->affected_rows() > 0){
            return -2; // Voucher Sudah pernah dipakai
        }
        return $potongan_harga;
    }
}