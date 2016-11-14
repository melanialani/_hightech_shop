<?php

class Model_Reports extends CI_Model {
	
	public function __construct() {
		parent::__construct();
		
		$this->load->database();
	}
	
	/**
	* Returns top 10 city that has extravagant users
	* 
	* @return
	*/
	public function get_kota_order(){
		// only get top 10 from the results
		$this->db->limit(10, 0);
		
		// count how many transactions/orders are happening in city x
		$this->db->select('COUNT(id), kota', FALSE); 
		$this->db->group_by('kota');
		
		// order by largest orders
		$this->db->order_by('COUNT(id) DESC');
		
		return $this->db->get('horder')->result_array();
	}
	
	/**
	* Returns top 10 populated city
	* 
	* @return
	*/
	public function get_kota_user(){
		// only get top 10 from the results
		$this->db->limit(10, 0);
		
		// count how many users are in city x
		$this->db->select('COUNT(username), kota', FALSE); 
		$this->db->group_by('kota');
		
		// order by largest population
		$this->db->order_by('COUNT(username) DESC');
		
		return $this->db->get('users')->result_array();
	}
	
	/**
	* Returns top 10 most-viewed items
	* 
	* @return
	*/
	public function get_popular_items(){
		// only get top 10 from the results
		$this->db->limit(10, 0);
		
		$this->db->select('jumlah_lihat, nama', FALSE);
		
		// order by the largest one
		$this->db->order_by('jumlah_lihat DESC');
		
		return $this->db->get('barang')->result_array();
	}
	
	/**
	* Returns top 10 most-ordered items
	* 
	* @return
	*/
	public function get_most_ordered_items(){
		// only get top 10 from the results
		$this->db->limit(10, 0);
		
		// count how many order for each items
		$this->db->select('COUNT(d.barang_id), b.nama', FALSE);
		$this->db->from('barang as b, dorder as d');
		$this->db->where('b.id = d.barang_id');
		$this->db->group_by('b.nama');
		
		// order by the largest one
		$this->db->order_by('COUNT(d.barang_id) DESC');
		
		return $this->db->get()->result_array();
	}
	
	/**
	* Get min year of transaction
	* 
	* @return
	*/
	public function get_min_year(){
		$this->db->select('MIN(YEAR(tanggal_create)) as year', FALSE); 
		$hasil = $this->db->get('horder')->row_array();
		return $hasil['year'];
	}
	
	/**
	* Get max year of transaction
	* 
	* @return
	*/
	public function get_max_year(){
		$this->db->select('MAX(YEAR(tanggal_create)) as year', FALSE); 
		$hasil = $this->db->get('horder')->row_array();
		return $hasil['year'];
	}
	
	/**
	* Returns income for year yyyy (grouped monthly)
	* 
	* @param int $year
	* 
	* @return
	*/
	public function get_yearly_income($year){
		$this->db->select('SUM(grand_total), MONTHNAME(tanggal_create), MONTH(tanggal_create)', FALSE);
		$this->db->where('YEAR(tanggal_create)', $year);
		$this->db->group_by('MONTHNAME(tanggal_create)');
		$this->db->order_by('MONTH(tanggal_create)');
		return $this->db->get('horder')->result_array();
	}
	
	/**
	* Returns income for month mm year yyyy (grouped daily)
	* 
	* @param int $month
	* @param int $year
	* 
	* @return
	*/
	public function get_monthly_income($month, $year){
		$this->db->select('SUM(grand_total), DAY(tanggal_create), tanggal_create', FALSE);
		$this->db->where('MONTH(tanggal_create)', $month);
		$this->db->where('YEAR(tanggal_create)', $year);
		$this->db->group_by('DAY(tanggal_create)');
		return $this->db->get('horder')->result_array();
	}
	
	/**
	* Returns how many user there are
	* 
	* @return
	*/
	public function get_count_user(){
		$this->db->select('COUNT(username)', FALSE); 
		$hasil = $this->db->get('users')->row_array();
		return $hasil['COUNT(username)'];
	}
	
	/**
	* Returns how many order there are
	* 
	* @return
	*/
	public function get_count_order(){
		$this->db->select('COUNT(id)', FALSE); 
		$hasil = $this->db->get('horder')->row_array();
		return $hasil['COUNT(id)'];
	}
	
	/**
	* Returns how much money you get today
	* 
	* @return
	*/
	public function get_transaction_today(){
		$this->db->select('SUM(grand_total)', FALSE);
		$this->db->where('DAY(tanggal_create)', date('d'));
		$this->db->where('MONTH(tanggal_create)', date('m'));
		$this->db->where('YEAR(tanggal_create)', date('Y'));
		$hasil = $this->db->get('horder')->row_array();
		return $hasil['SUM(grand_total)'];
	}
	
	/**
	* Returns how many items you have
	* 
	* @return
	*/
	public function get_count_item(){
		$this->db->select('COUNT(id)', FALSE); 
		$hasil = $this->db->get('barang')->row_array();
		return $hasil['COUNT(id)'];
	}
}

?>