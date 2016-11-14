<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Created by: Melania Laniwati
* 		  at: 8 December 2015
* 
* Other contributor: Nancy Yonata
* 
* About this file:
* Controls everything back-end (nothing to do with user)
* Creates website for website's admin
* 
* Version controls:
* v1.0 - 8 December 2015
* - adds contstruct
* - adds dashboard function
* v1.2 - 9 December 2015
* - adds login function
* v2.0 - 18 December 2015
* - adds masterBarang function (Nancy)
* - adds masterKategori function (Nancy)
* v2.1 - 24 December 2015
* - adds masterOrder function (Nancy)
* v3.0 - 25 December 2015
* - adds laporanTransaksi function
* - adds laporanUser function
* - adds laporanDilihat function
* v3.1 - 26 December 2015
* - adds laporanDibeli function
* - adds laporanPemasukan function
*/

class Admin extends CI_Controller {
	
	/**
	* loads any helpers, libraries, and models needed
	* 
	* @return
	*/
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('cookie');
		
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('gcharts');
		
		$this->load->model('model_user');
		$this->load->model('model_voucher');
		$this->load->model('model_reports');
		$this->load->model('barang_model');
	}
	
	/**
	* calls the default page (should be login)
	* 
	* @return
	*/
	public function index(){
		$this->dashboard();
	}
	
	/**
	* controls admin's login page
	* 
	* @return
	*/
	public function login(){
		// clear cookies automatically if you enters login page
		delete_cookie('proyek'); 
		
		// set page's title
		$data['title'] = "Login";
		
		// empty the error message
		$data['message'] = "";
		
		// take user's input from form
		$data['username'] = $this->input->post('username', TRUE);
		$data['password'] = $this->input->post('password', TRUE);
		$data['rememberMe'] = $this->input->post('rememberMe', TRUE);
		
		// if button LOGIN is pressed
		if ($this->input->post('login', TRUE)) {
			// cek kesesuaian username dan password
			$result = $this->model_user->get_all_admin();
			
			$adaDiDatabase = 0;
			for ($i = 0; $i < count($result); $i++){
				// if username found
				if ($data['username'] == $result[$i]['username']) {
					// if password is correct
					if ($data['password'] == $result[$i]['password']) $adaDiDatabase = 1;
					else $data['message'] = "<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg>Incorrect password</div>";
					
					break;
				} else $data['message'] = "<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg>Matching username not found</div>";
			}
			
			if ($adaDiDatabase){
				if ((int) $data['rememberMe'] == 1) {
					// set cookies
					$cookie = array('name' => 'proyek', 'value' => $data['username'], 'expire' => 60*60*24 ); // expire in a day
					set_cookie($cookie);
				} else {
					// set session -- pake metode cookie, tapi expire nya diset jadi 0
					$cookie = array('name' => 'proyek', 'value' => $data['username'], 'expire' => 0 ); // expire when browser closed
					set_cookie($cookie);
				}
				
				// go to home page
				$info['title'] = "Dashboard"; // set page title
				$info['username'] = $data['username']; // set username
				$info['total_order'] = $this->model_reports->get_count_order(); // get total_order data from database
				$info['total_user'] = $this->model_reports->get_count_user(); // get total_user data from database
				$info['total_item'] = $this->model_reports->get_count_item(); // get total_item data from database
				$info['income_day'] = $this->model_reports->get_transaction_today(); // get income_day data from database
				
				$this->barang_model->setDataOrderHariIni();
				$info['allDataOrder'] = $this->barang_model->getTodayOrder();
				$this->load->view('includes/header', $info); // loads views
				$this->load->view('includes/navbar', $info);
				$this->load->view('dashboard', $info);
				$this->load->view('includes/footer_empty');
			} 
			else { // not found in database
				$this->load->view('includes/header', $data);
				$this->load->view('login', $data);
				$this->load->view('includes/footer');
			}
		}
		else { // page loads for the first time
			$this->load->view('includes/header', $data);
			$this->load->view('login', $data);
			$this->load->view('includes/footer');
		}
	}
	
	/**
	* controls admin's homepage -- called dashboard
	* 
	* @return
	*/
	public function dashboard(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			// get data from database
			$data['total_order'] = $this->model_reports->get_count_order();
			$data['total_user'] = $this->model_reports->get_count_user();
			$data['total_item'] = $this->model_reports->get_count_item();
			$data['income_day'] = $this->model_reports->get_transaction_today();
			
			// set page title
			$data['title'] = "Dashboard";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			$this->barang_model->setDataOrderHariIni();
			$data['allDataOrder'] = $this->barang_model->getTodayOrder();
		
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	/**
	* Controls master user
	* 
	* @return
	*/
	public function masterUser(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			
			// get information from form view
			$data['new_username'] = $this->input->post('new_username');
			$data['new_password'] = $this->input->post('new_password');
			
			// insert button on click
			if ($this->input->post('insert')){
				if ($this->model_user->insert_admin($data['new_username'], $data['new_password'])){
					$data['message'] = "<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg>Insert success</div>";
				} else {
					$data['message'] = "<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg>Insert failed</div>";
				}
			}
			
			// set page title
			$data['title'] = "Master User";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			
			// get information from database
			$data['tabelUser'] = $this->model_user->get_all_user();
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('masters/master_user', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	/**
	* Controls master voucher
	* 
	* @return
	*/
	public function masterVoucher(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			
			// get information from form view
			$data['id'] = $this->input->post('id');
			$data['nama'] = $this->input->post('nama');
			$data['potongan_harga'] = $this->input->post('potongan_harga');
			$data['awal'] = $this->input->post('awal');
			$data['akhir'] = $this->input->post('akhir');
			$data['status'] = $this->input->post('status');
			
			// insert button on click
			if ($this->input->post('insert')){
				$this->model_voucher->insert_voucher($data['nama'], $data['potongan_harga'], $data['awal'], $data['akhir']);
				//$data['message'] = "<div class='alert bg-danger' role='alert'><svg class='glyph stroked cancel'><use xlink:href='#stroked-cancel'></use></svg>Insert failed</div>";
			}
			
			// update button on click -> go to update_voucher page
			if ($this->input->post('update')){
				$this->updateVoucher($data['id']);
			} 
			
			// load page as usual
			else {
				// set page title
				$data['title'] = "Master Voucher";
				
				// set username from cookie
				$data['username'] = $this->input->cookie('proyek');
				
				// get information from database
				$data['tabelVoucher'] = $this->model_voucher->get_all_voucher();
				
				// loads views
				$this->load->view('includes/header', $data);
				$this->load->view('includes/navbar', $data);
				$this->load->view('masters/master_voucher', $data);
				$this->load->view('includes/footer_empty');
			}
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	public function updateVoucher($id = NULL){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			
			// button save on click
			if ($this->input->post('save')){
				// get input from view
				$data['id'] = $this->input->post('id');
				$data['nama'] = $this->input->post('nama');
				$data['potongan_harga'] = $this->input->post('potongan_harga');
				$data['awal'] = $this->input->post('awal');
				$data['akhir'] = $this->input->post('akhir');
				$data['status'] = $this->input->post('status');
				
				// update the voucher
				if ($this->model_voucher->update_voucher($data['id'], $data['nama'], $data['potongan_harga'], $data['awal'], $data['akhir'], $data['status'])){
					// success -> go back to master voucher
					$this->masterVoucher();
				}
			}
			
			// load page as usual
			else {
				$dataVoucher = $this->model_voucher->get_voucher($id);
				
				// pass the data into view
				$data['id'] = $dataVoucher[0]['id'];
				$data['nama'] = $dataVoucher[0]['nama'];
				$data['potongan_harga'] = $dataVoucher[0]['potongan_harga'];
				$data['awal'] = $dataVoucher[0]['awal'];
				$data['akhir'] = $dataVoucher[0]['akhir'];
				$data['status'] = $dataVoucher[0]['status'];
				
				// set page title
				$data['title'] = "Update Voucher";
				
				// set username from cookie
				$data['username'] = $this->input->cookie('proyek');
				
				$this->load->view('includes/header', $data);
				$this->load->view('includes/navbar');
				$this->load->view('update_voucher', $data);
				$this->load->view('includes/footer_empty');
			}
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	public function masterBarang(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			// set page title
			$data['title'] = "Master Barang";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			
			$data['allDataBarang'] = $this->barang_model->getAllDataBarang();
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('barang_view', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	public function masterKategori(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			// set page title
			$data['title'] = "Master Kategori";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			$data['allDataKategori'] = $this->barang_model->getAllDataKategori();
		
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('kategori_view', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	public function masterOrder(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			// set page title
			$data['title'] = "Master Order";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			$data['allDataOrder'] = $this->barang_model->getDataHorder();
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('order_view', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	/**
	* Controls report kota_order
	* Shows how many order (transaction) for city x
	* 
	* @return
	*/
	public function laporanTransaksi(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$data['datatable'] = $this->model_reports->get_kota_order();
			
			$this->gcharts->DataTable('kota_order')
			              ->addColumn('string', 'City', 'city')
			              ->addColumn('number', $data['datatable'][0]['kota'], $data['datatable'][0]['kota'])
			              ->addColumn('number', $data['datatable'][1]['kota'], $data['datatable'][1]['kota'])
			              ->addColumn('number', $data['datatable'][2]['kota'], $data['datatable'][2]['kota'])
			              ->addColumn('number', $data['datatable'][3]['kota'], $data['datatable'][3]['kota'])
			              ->addColumn('number', $data['datatable'][4]['kota'], $data['datatable'][4]['kota'])
			              ->addColumn('number', $data['datatable'][5]['kota'], $data['datatable'][5]['kota'])
			              ->addColumn('number', $data['datatable'][6]['kota'], $data['datatable'][6]['kota'])
			              ->addColumn('number', $data['datatable'][7]['kota'], $data['datatable'][7]['kota'])
			              ->addColumn('number', $data['datatable'][8]['kota'], $data['datatable'][8]['kota'])
			              ->addColumn('number', $data['datatable'][9]['kota'], $data['datatable'][9]['kota'])
			              ->addRow(array(
			                  'Jumlah transaksi',
			                  $data['datatable'][0]['COUNT(id)'],
			                  $data['datatable'][1]['COUNT(id)'],
			                  $data['datatable'][2]['COUNT(id)'],
			                  $data['datatable'][3]['COUNT(id)'],
			                  $data['datatable'][4]['COUNT(id)'],
			                  $data['datatable'][5]['COUNT(id)'],
			                  $data['datatable'][6]['COUNT(id)'],
			                  $data['datatable'][7]['COUNT(id)'],
			                  $data['datatable'][8]['COUNT(id)'],
			                  $data['datatable'][9]['COUNT(id)']
			              ));
			
			$config = array(
			    'title' => '10 Kota yang Memiliki Transaksi Pembelian Terbanyak'
			);
			
			$this->gcharts->ColumnChart('kota_order')->setConfig($config);
			
			// set page title
			$data['title'] = "Laporan banyak transaksi dalam kota";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('reports/kota_order', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	/**
	* Controls report kota_user
	* Shows how many users in city x
	* 
	* @return
	*/
	public function laporanUser(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$data['datatable'] = $this->model_reports->get_kota_user();
			
			$this->gcharts->DataTable('kota_user')
			              ->addColumn('string', 'City', 'city')
			              ->addColumn('number', $data['datatable'][0]['kota'], $data['datatable'][0]['kota'])
			              ->addColumn('number', $data['datatable'][1]['kota'], $data['datatable'][1]['kota'])
			              ->addColumn('number', $data['datatable'][2]['kota'], $data['datatable'][2]['kota'])
			              ->addColumn('number', $data['datatable'][3]['kota'], $data['datatable'][3]['kota'])
			              ->addColumn('number', $data['datatable'][4]['kota'], $data['datatable'][4]['kota'])
			              ->addColumn('number', $data['datatable'][5]['kota'], $data['datatable'][5]['kota'])
			              ->addColumn('number', $data['datatable'][6]['kota'], $data['datatable'][6]['kota'])
			              ->addColumn('number', $data['datatable'][7]['kota'], $data['datatable'][7]['kota'])
			              ->addColumn('number', $data['datatable'][8]['kota'], $data['datatable'][8]['kota'])
			              ->addColumn('number', $data['datatable'][9]['kota'], $data['datatable'][9]['kota'])
			              ->addRow(array(
			                  'Jumlah user',
			                  $data['datatable'][0]['COUNT(username)'],
			                  $data['datatable'][1]['COUNT(username)'],
			                  $data['datatable'][2]['COUNT(username)'],
			                  $data['datatable'][3]['COUNT(username)'],
			                  $data['datatable'][4]['COUNT(username)'],
			                  $data['datatable'][5]['COUNT(username)'],
			                  $data['datatable'][6]['COUNT(username)'],
			                  $data['datatable'][7]['COUNT(username)'],
			                  $data['datatable'][8]['COUNT(username)'],
			                  $data['datatable'][9]['COUNT(username)']
			              ));
			
			$config = array(
			    'title' => '10 Kota yang Memiliki User Terbanyak'
			);
			
			$this->gcharts->ColumnChart('kota_user')->setConfig($config);
			
			// set page title
			$data['title'] = "Laporan banyak user dalam kota";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('reports/kota_user', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	/**
	* Controls report populer_dilihat
	* Shows top 10 items that are most viewed
	* 
	* @return
	*/
	public function laporanDilihat(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$data['datatable'] = $this->model_reports->get_popular_items();
			
			$this->gcharts->DataTable('populer_dilihat')
			              ->addColumn('string', 'Item', 'item')
			              ->addColumn('number', $data['datatable'][0]['nama'], $data['datatable'][0]['nama'])
			              ->addColumn('number', $data['datatable'][1]['nama'], $data['datatable'][1]['nama'])
			              ->addColumn('number', $data['datatable'][2]['nama'], $data['datatable'][2]['nama'])
			              ->addColumn('number', $data['datatable'][3]['nama'], $data['datatable'][3]['nama'])
			              ->addColumn('number', $data['datatable'][4]['nama'], $data['datatable'][4]['nama'])
			              ->addColumn('number', $data['datatable'][5]['nama'], $data['datatable'][5]['nama'])
			              ->addColumn('number', $data['datatable'][6]['nama'], $data['datatable'][6]['nama'])
			              ->addColumn('number', $data['datatable'][7]['nama'], $data['datatable'][7]['nama'])
			              ->addColumn('number', $data['datatable'][8]['nama'], $data['datatable'][8]['nama'])
			              ->addColumn('number', $data['datatable'][9]['nama'], $data['datatable'][9]['nama'])
			              ->addRow(array(
			                  'Jumlah lihat',
			                  $data['datatable'][0]['jumlah_lihat'],
			                  $data['datatable'][1]['jumlah_lihat'],
			                  $data['datatable'][2]['jumlah_lihat'],
			                  $data['datatable'][3]['jumlah_lihat'],
			                  $data['datatable'][4]['jumlah_lihat'],
			                  $data['datatable'][5]['jumlah_lihat'],
			                  $data['datatable'][6]['jumlah_lihat'],
			                  $data['datatable'][7]['jumlah_lihat'],
			                  $data['datatable'][8]['jumlah_lihat'],
			                  $data['datatable'][9]['jumlah_lihat']
			              ));
			
			$config = array(
			    'title' => '10 Barang yang Sering Dilihat'
			);
			
			$this->gcharts->ColumnChart('populer_dilihat')->setConfig($config);
			
			// set page title
			$data['title'] = "Laporan barang yang sering dilihat";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('reports/populer_dilihat', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	/**
	* Controls report populer_dibeli
	* Shows top 10 items that are most ordered
	* 
	* @return
	*/
	public function laporanDibeli(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$data['datatable'] = $this->model_reports->get_most_ordered_items();
			
			$this->gcharts->DataTable('populer_dibeli')
			              ->addColumn('string', 'Item', 'item')
			              ->addColumn('number', $data['datatable'][0]['nama'], $data['datatable'][0]['nama'])
			              ->addColumn('number', $data['datatable'][1]['nama'], $data['datatable'][1]['nama'])
			              ->addColumn('number', $data['datatable'][2]['nama'], $data['datatable'][2]['nama'])
			              ->addColumn('number', $data['datatable'][3]['nama'], $data['datatable'][3]['nama'])
			              ->addColumn('number', $data['datatable'][4]['nama'], $data['datatable'][4]['nama'])
			              ->addColumn('number', $data['datatable'][5]['nama'], $data['datatable'][5]['nama'])
			              ->addColumn('number', $data['datatable'][6]['nama'], $data['datatable'][6]['nama'])
			              ->addColumn('number', $data['datatable'][7]['nama'], $data['datatable'][7]['nama'])
			              ->addColumn('number', $data['datatable'][8]['nama'], $data['datatable'][8]['nama'])
			              ->addColumn('number', $data['datatable'][9]['nama'], $data['datatable'][9]['nama'])
			              ->addRow(array(
			                  'Jumlah pembelian',
			                  $data['datatable'][0]['COUNT(d.barang_id)'],
			                  $data['datatable'][1]['COUNT(d.barang_id)'],
			                  $data['datatable'][2]['COUNT(d.barang_id)'],
			                  $data['datatable'][3]['COUNT(d.barang_id)'],
			                  $data['datatable'][4]['COUNT(d.barang_id)'],
			                  $data['datatable'][5]['COUNT(d.barang_id)'],
			                  $data['datatable'][6]['COUNT(d.barang_id)'],
			                  $data['datatable'][7]['COUNT(d.barang_id)'],
			                  $data['datatable'][8]['COUNT(d.barang_id)'],
			                  $data['datatable'][9]['COUNT(d.barang_id)']
			              ));
			
			$config = array(
			    'title' => '10 Barang yang Sering Dibeli'
			);
			
			$this->gcharts->ColumnChart('populer_dibeli')->setConfig($config);
			
			// set page title
			$data['title'] = "Laporan barang yang sering dibeli";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('reports/populer_dibeli', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
	
	/**
	* Controls report pemasukan
	* Shows how much money you get for month x or year y
	* 
	* @return
	*/
	public function laporanPemasukan(){
		// checks if it's admin
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			
			// button GO! on click
			if ($this->input->post('go') && $this->input->post('year') != 0){
				$datatable = NULL;
				
				$this->gcharts->DataTable('Pemasukan')
					          ->addColumn('string', 'Count', 'count')
					          ->addColumn('number', 'Income', 'income');
				
				// lihat laporan pemasukan per-tahun
				if ($this->input->post('month') == 0){
					$datatable = $this->model_reports->get_yearly_income($this->input->post('year'));
					
					// add data to chart
					for($i = 0; $i < count($datatable); $i++)
					{
					    $data = array(
					        $datatable[$i]['MONTHNAME(tanggal_create)'],   // count
					        $datatable[$i]['SUM(grand_total)'] 			  // line data
					    );
						
					    $this->gcharts->DataTable('Pemasukan')->addRow($data);
					}
				}
				
				// lihat laporan pemasukan per-bulan
				else {
					$datatable = $this->model_reports->get_monthly_income($this->input->post('month'), $this->input->post('year'));
					
					// add data to chart
					for($i = 0; $i < count($datatable); $i++)
					{
					    $data = array(
					        date('F j, Y', strtotime($datatable[$i]['tanggal_create'])),   // count
					        $datatable[$i]['SUM(grand_total)'] 			// line data
					    );
						
					    $this->gcharts->DataTable('Pemasukan')->addRow($data);
					}
				}
			} 
			
			// empty chart
			else {
				$this->gcharts->DataTable('Pemasukan')
				              ->addColumn('number', 'Count', 'count')
				              ->addColumn('number', 'Income', 'income');
				
				for($i = 1; $i < 25; $i++)
				{
				    $data = array(
				        $i,      // count
				        0 		// line data
				    );
					
				    $this->gcharts->DataTable('Pemasukan')->addRow($data);
				}
			}
			
			$config = array(
				'title' => 'Pemasukan bulan:  ' . $this->input->post('month') . ' tahun: ' . $this->input->post('year')
			);
			
			$this->gcharts->LineChart('Pemasukan')->setConfig($config);
			
			// get input from database
			$data['min_year'] = $this->model_reports->get_min_year();
			$data['max_year'] = $this->model_reports->get_max_year();
			
			// get input from form
			$data['month'] = $this->input->post('month');
			$data['year'] = $this->input->post('year');
			
			// set page title
			$data['title'] = "Laporan barang yang sering dibeli";
			
			// set username from cookie
			$data['username'] = $this->input->cookie('proyek');
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('reports/pemasukan', $data);
			$this->load->view('includes/footer_empty');
		} 
		else { // no it's not admin, go back to login page
			$this->login();
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */