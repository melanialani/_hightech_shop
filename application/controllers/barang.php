<?php
/**
* Created by: Nancy Yonata 
* Created at: 8 December 2015
 
  Edited  at : 15 December 2015
  Edited  at : 17 December 2015
  
* Controls everything back-end (nothing to do with user)
* Creates website for website's admin
 
*/


class Barang extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','upload', 'session'));
		$this->load->helper(array('url','form'));
		$this->load->model(['barang_model', 'order_model', 'model_user']);
	}
	
	public function index(){
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
			redirect('admin/login');
		}
	}
	
	public function page_insert_barang(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$arr = [];
			$kategori = $this->barang_model->allKategori();
			foreach ($kategori as $row){
				$arr [$row['nama']] = $row['nama'];
			}
			
			$data['title'] = "Insert Barang Step 1";
			$data['username'] = $this->input->cookie('proyek');
			$data['allKategori'] = $arr;
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('barang_view1', $data);
		}
		else{
			redirect('admin/login');
		}
	}
	
	public function page_kategori(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$data['title'] = "Insert Kategori Barang";
			$data['username'] = $this->input->cookie('proyek');
			$data['insertKategoriConf'] = "";
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('barangKategori_view', $data);
		}
		else{
			redirect('admin/login');
		}	
	}
	
	public function insertKategori(){
		
		$nama = $this->input->post('tbNama');
		$fd = $this->input->post('fdetail_kategori');
		$status = $this->input->post('tbStatus');
		$berhasil = $this->barang_model->insertKategori($nama, $fd, $status);
		if($berhasil == 1){
			redirect('barang/list_kategori');
		}
	}
	
	public function insertDetailBarang(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$nama = $this->input->post('tbNama');
			$brand = $this->input->post('tbBrand');
			$deskripsi = $this->input->post('tbDeskripsi');
			$stock = $this->input->post('tbStock');
			$hrg = $this->input->post('tbHarga');
			$diskon = $this->input->post('tbDiskon');
			$namaKategori = $this->input->post('cbKategori');
			$kategori_id = $this->barang_model->getKategoriId($namaKategori);
			$detail = $this->input->post('tbDetail');
			$garansi = $this->input->post('tbGaransi');
			
			//detail barang sementara simpan di session
			$this->session->set_userdata('nama_brg',$nama);
			$this->session->set_userdata('brand_brg', $brand);
			$this->session->set_userdata('desk_brg', $deskripsi);
			$this->session->set_userdata('stock_brg', $stock);
			$this->session->set_userdata('hrg_brg', $hrg);
			$this->session->set_userdata('diskon_brg', $diskon);
			$this->session->set_userdata('idKategori_brg', $kategori_id);
			$this->session->set_userdata('detail_brg', $detail);
			$this->session->set_userdata('garansi_brg', $garansi);
			
			$data['title'] = "Insert Barang Step 2";
			$data['username'] = $this->input->cookie('proyek');
		
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('barang_view2', $data);
		}
		else{
			redirect('admin/login');
		}
			
	}
	
	public function editBarangStep1(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$nama = $this->input->post('tbNama');
			$brand = $this->input->post('tbBrand');
			$deskripsi = $this->input->post('tbDeskripsi');
			$stock = $this->input->post('tbStock');
			$hrg = $this->input->post('tbHarga');
			$diskon = $this->input->post('tbDiskon');
			$detail = $this->input->post('tbDetail');
			$garansi = $this->input->post('tbGaransi');
			$berat = $this->input->post('tbBerat');
			$status = $this->input->post('tbStatus');
			$id_barang = $this->input->post('hidden_id');
			
			if($this->input->post('btnNext') == true){
				//simpan di session dulu
				$this->session->set_userdata('update_nama_brg',$nama);
				$this->session->set_userdata('update_brand_brg', $brand);
				$this->session->set_userdata('update_desk_brg', $deskripsi);
				$this->session->set_userdata('update_stock_brg', $stock);
				$this->session->set_userdata('update_hrg_brg', $hrg);
				$this->session->set_userdata('update_diskon_brg', $diskon);
				$this->session->set_userdata('update_detail_brg', $detail);
				$this->session->set_userdata('update_garansi_brg', $garansi);
				$this->session->set_userdata('update_berat_brg', $berat);
				$this->session->set_userdata('update_status_brg', $status);
				
				$data['title'] = "Edit Barang Step 2";
				$data['username'] = $this->input->cookie('proyek');
				$data['detail'] = $this->barang_model->get_detailBarang($id_barang);
				
				$this->load->view('includes/header', $data);
				$this->load->view('includes/navbar');
				$this->load->view('barang_view_detail2', $data);
			}
			else if($this->input->post('btnSave') == true){
				$this->barang_model->update_dbarang($id_barang, $nama, $brand, $deskripsi, $stock, $hrg, $diskon, $detail, $garansi, $berat, $status);
				$data['title'] = "FORM EDIT BARANG";
				$data['detail'] = $this->barang_model->get_detailBarang($id_barang);
				$data['username'] = $this->input->cookie('proyek');
			
				$this->load->view('includes/header', $data);
				$this->load->view('includes/navbar');
				$this->load->view('barang_view_detail', $data);
			}
		}
		else{
			redirect('admin/login');
		}
	}
	
	
	public function insertDetailGambar(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->upload->initialize($config);
			
			$arrFileName = [];
			$arrWarna = [];
			if($_FILES["gambar1"]["name"] != ""){
				$this->upload->do_upload('gambar1');
				$resultGbr1 = $this->upload->data();
				foreach($resultGbr1 as $item => $value){
					if($item == "file_name"){
						$arrFileName [] = $value;
						$arrWarna [] = $this->input->post('inputWarnaGbr1');
					}
				}			
				
			}
			
			if($_FILES["gambar2"]["name"] != ""){
				$this->upload->do_upload('gambar2');
				$resultGbr2 = $this->upload->data();
				foreach($resultGbr2 as $item => $value){
					if($item == "file_name"){
						$arrFileName [] = $value;
						$arrWarna [] =  $this->input->post('inputWarnaGbr2');
					}
				}	
			}
			
			if($_FILES["gambar3"]["name"] != ""){
				$this->upload->do_upload('gambar3');
				$resultGbr3 = $this->upload->data();
				foreach($resultGbr3 as $item => $value){
					if($item == "file_name"){
						$arrFileName [] = $value;
						$arrWarna [] = $this->input->post('inputWarnaGbr3');
					}
				}	
			}		
			
			$kumpulanFileName = "";
			$kumpulanWarna = "";
			
			for($i = 0; $i < count($arrFileName); $i++){
				if($i > 0){
					$kumpulanFileName .= ';images/'.$arrFileName[$i];
					$kumpulanWarna .= ';'.$arrWarna[$i];
				
				}
				else{
					$kumpulanFileName .= 'images/'.$arrFileName[$i];
					$kumpulanWarna .= $arrWarna[$i];
				}
				
			}
			
			$nama = $this->session->userdata('nama_brg');
			$brand = $this->session->userdata('brand_brg');
			$desk = $this->session->userdata('desk_brg');
			$stock = $this->session->userdata('stock_brg');
			$hrg = $this->session->userdata('hrg_brg');
			$disk = $this->session->userdata('diskon_brg');
			$idKategori = $this->session->userdata('idKategori_brg');
			$detBrg = $this->session->userdata('detail_brg');
			$garansi = $this->session->userdata('garansi_brg');
			
			$this->barang_model->insertBarangBaru($nama, $brand, $desk, $stock, $hrg, $disk, $idKategori, $detBrg, $garansi, $kumpulanFileName, $kumpulanWarna);
			$data['title'] = "List Barang";
			$data['username'] = $this->input->cookie('proyek');
			$data['allDataBarang'] = $this->barang_model->getAllDataBarang();
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('barang_view', $data);
			$this->load->view('includes/footer_empty');	
			//hapus semua session yg ada
			$this->session->unset_userdata('nama_brg');
			$this->session->unset_userdata('brand_brg');
			$this->session->unset_userdata('desk_brg');
			$this->session->unset_userdata('stock_brg');
			$this->session->unset_userdata('hrg_brg');
			$this->session->unset_userdata('diskon_brg');
			$this->session->unset_userdata('idKategori_brg');
			$this->session->unset_userdata('detail_brg');
			$this->session->unset_userdata('garansi_brg');
		}
		else{
			redirect('admin/login');
		}
	}
	
	public function ajax_logOrder(){
		if(isset($_POST['order'])){
			$column = ["id", "horder_id","status","tanggal"];
			$orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
        }
		else {
			$orders = null;
		}
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$allDataLogOrder = $this->barang_model->getDataLogOrder($orders, $limit, $start);
		
        $output = array("recordsTotal" => $this->barang_model->countAllLogOrder(), 
						"recordsFiltered" => $this->barang_model->countAllLogOrder(),
						"data" => $allDataLogOrder);
		
        // Print Output Berupa JSON
        echo json_encode($output);
	}
	
	public function ajax_detailOrderBarang($selected_horderId){
		if(isset($_POST['order'])){
			$column = ["horder_id","barang_id","subtotal", "status"];
			$orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
        }
		else {
			$orders = null;
		}
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		
		$allDataDetailOrder = $this->barang_model->getDataDetailOrder($selected_horderId, $orders, $limit, $start);
		
        $output = array("recordsTotal" => $this->barang_model->countAllDOrder($selected_horderId), 
						"recordsFiltered" => $this->barang_model->countAllDOrder($selected_horderId),
						"data" => $allDataDetailOrder);
		
        // Print Output Berupa JSON
        echo json_encode($output);
	}
	
	public function view_detail($id_barang){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$data['title'] = "FORM EDIT BARANG";
			$data['detail'] = $this->barang_model->get_detailBarang($id_barang);
			$data['username'] = $this->input->cookie('proyek');
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('barang_view_detail', $data);
		}
		else{
			redirect('admin/login');
		}	
	}
	
	public function list_kategori(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$data['title'] = "List Kategori";
			$data['username'] = $this->input->cookie('proyek');
			$data['allDataKategori'] = $this->barang_model->getAllDataKategori();
		
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('kategori_view', $data);
			$this->load->view('includes/footer_empty');
		}
		else{
			redirect('admin/login');
		}
	}
	
	public function edit_kategori($id_kategori){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$data['title'] = "Edit Kategori";
			$data['username'] = $this->input->cookie('proyek');
			$data['dataKategori'] = $this->barang_model->getDataKategori($id_kategori);
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('edit_kategori_view', $data);
		
		}
		else{
			redirect('admin/login');
		}
	
	}
	
	public function update_kategori(){
		$id = $this->input->post('hidden_id');
		$nama = $this->input->post('tbNama');
		$det = $this->input->post('tbDetail');
		$status = $this->input->post('tbStatus');
		
		$this->barang_model->update_kategori($id, $nama, $det, $status);
		$this->list_kategori();
	}
	
	
	public function editBarangStep2(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$id = $this->input->post('hidden_id');
			$gambar = $this->barang_model->get_gambarBarang($id);
			$arrGambar = explode(';',$gambar);
			
			$warna = $this->barang_model->get_warnaBarang($id);
			$arrWarna = explode(';', $warna);
			
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->upload->initialize($config);
			
			// untuk ganti gambar
			for($i=0; $i < count($arrGambar); $i++){
				// update array gambar
				if($_FILES["gambar".$i]["name"] != ""){
					$arrGambar[$i] = 'images/'.$_FILES["gambar".$i]["name"];
				}
				$this->upload->do_upload('gambar'.$i);
				
				//update array warna
				$warnaBrg = $this->input->post('tbWarna'.$i);
				if($warnaBrg != $arrWarna[$i]){
					$arrWarna[$i] = $this->input->post('tbWarna'.$i);
				}
			}
			
			// untuk delete gambar
			for($i=0; $i < count($arrGambar); $i++){
				if($this->input->post('btnDeleteGbr'.$i) == true){
					//echo "deleteGbr".$i;
					$arrGambar[$i] = "-";
					$arrWarna[$i] = "-";
				}
			}	
			
			$kumpulanGambar = "";
			$kumpulanWarna = "";
			$gbr1 = "";
			for($i=0; $i < count($arrGambar); $i++){
				if($arrGambar[$i] != "-"){
					if($gbr1 == "sdh"){
						$kumpulanGambar .= ";".$arrGambar[$i];
						$kumpulanWarna .= ";".$arrWarna[$i];
					}
					else{
						$kumpulanGambar .= $arrGambar[$i];
						$kumpulanWarna .= $arrWarna[$i];
						$gbr1 = "sdh";
					}
				}
			}
			
			$nama = $this->session->userdata('update_nama_brg');
			$brand = $this->session->userdata('update_brand_brg');
			$desk = $this->session->userdata('update_desk_brg');
			$stok = $this->session->userdata('update_stock_brg');
			$harga = $this->session->userdata('update_hrg_brg');
			$diskon = $this->session->userdata('update_diskon_brg');
			$det = $this->session->userdata('update_detail_brg');
			$garansi = $this->session->userdata('update_garansi_brg');
			$berat = $this->session->userdata('update_berat_brg');
			$status = $this->session->userdata('update_status_brg');
			
			$this->barang_model->UbahGambarBarang($id,$nama, $brand, $desk,$stok,$harga,$diskon, $det, $garansi,$berat, $status, $kumpulanGambar, $kumpulanWarna);
			
			$data['title'] = "List Barang";
			$data['username'] = $this->input->cookie('proyek');
			$data['allDataBarang'] = $this->barang_model->getAllDataBarang();
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('barang_view', $data);
			$this->load->view('includes/footer_empty');	
			
		}
		else{
			redirect('admin/login');
		}
	}
	
	public function tambahGambar(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$id = $this->session->userdata('id_barang');
			$warna = $this->input->post('warnaBarang');
			
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->upload->initialize($config);
			
			$this->upload->do_upload('fotoBarang');
			$resultGbr = $this->upload->data();
			foreach($resultGbr as $item => $value){
				if($item == "file_name"){
					$gbr = $value;
				}
			}
			
			$this->barang_model->tambahGambarBarang($id, $gbr, $warna);
			$data['title'] = "List Barang";
			$data['username'] = $this->input->cookie('proyek');
			$data['allDataBarang'] = $this->barang_model->getAllDataBarang();
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('barang_view', $data);
			$this->load->view('includes/footer_empty');	
			
		}
		else{
			redirect('admin/login');
		}	
	}
	
	public function listOrder(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$data['title'] = "Master Order";
			$data['username'] = $this->input->cookie('proyek');
			$data['allDataOrder'] = $this->barang_model->getDataHorder();
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('order_view', $data);
			$this->load->view('includes/footer_empty');
		}
		else{
			redirect('admin/login');
		}
	}
	
	public function listLogOrder(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$data['title'] = "Master Log Order";
			$data['username'] = $this->input->cookie('proyek');
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('logOrder_view', $data);
		}
		else{
			redirect('admin/login');
		}
	} 
	
	public function edit_order($horder_id){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			// UNTUK HEADER ORDER BARANG
			$data['title'] = "Edit Header Order";
			$data['username'] = $this->input->cookie('proyek');
			$data['dataOrder'] = $this->barang_model->getDataOrder($horder_id);
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('edit_order_view', $data);
		}
		else{
			redirect('admin/login');
		}	
	}
	
	public function edit_detailOrder(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			//UNTUK DETAIL ORDER BARANG
			$data['title'] = "Detail Order";
			$data['username'] = $this->input->cookie('proyek');
			$data['hOrder_idSelect'] = $this->session->userdata('hidden_idhOrder');
			
			$allDataDetailOrder = $this->barang_model->getDataDetailOrder($data['hOrder_idSelect']);
		 
			$data['allDorder'] = $allDataDetailOrder;
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('edit_detailOrder_view', $data);
		}
		else{
			redirect('admin/login');
		}
	}
	
	public function edit_DOrder($id_dorder){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
			$data['title'] = "Detail Order";
			$data['username'] = $this->input->cookie('proyek');
			$data['detail_dorder'] = $this->barang_model->getDataDOrder($id_dorder);
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('edit_dOrder_view', $data);
		}
		else{
			redirect('admin/login');
		}
			
	}
	
	public function saveEditHOrder(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$data['title'] = "Master Order";
			$data['username'] = $this->input->cookie('proyek');
			$horder_id = $this->session->userdata('hidden_idhOrder');
			$kodeBayar = $this->input->post('h_kodePemb');
			$tipeBayar = $this->input->post('h_tipePemb');
			$kodeJNE = $this->input->post('h_kodejne');
			// update status order
			
			if($this->input->post('optOrder') == "1"){
				$this->barang_model->changeOrderToPending($horder_id);
			}
			else if($this->input->post('optOrder') == "2"){
				
				$this->barang_model->changeOrderToFinishPayment($horder_id, $kodeBayar,$tipeBayar);
			}
			else if($this->input->post('optOrder') == "3"){
				$this->barang_model->changeOrderToSent($horder_id, $kodeJNE);	
			}
			else if($this->input->post('optOrder') == "4"){
				$this->barang_model->changeOrderToCancel($horder_id);
			}
			else if($this->input->post('optOrder') == "5"){
				$this->barang_model->changeOrderToProblem($horder_id);
			}
			
			$data['allDataOrder'] = $this->barang_model->getDataHorder();
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('order_view', $data);
			$this->load->view('includes/footer_empty');
			
		}
		else{
			redirect('admin/login');
		}
			
	}
	
	public function update_dOrder(){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$idDOrder = $this->input->post('hidden_id');
			$horderId = $this->input->post('hidden_horderId');
			$barangId = $this->input->post('hidden_barangId');
			$ket = $this->input->post('tbKet');
			$qty = $this->input->post('tbQty');
			$hrg = $this->input->post('tbHarga');
			$subtot = $this->input->post('tbSubTotal');
			$status = $this->input->post('tbStatus');
			$this->barang_model->updateDorder($idDOrder,$horderId, $barangId,$ket,$qty,$hrg,$subtot,$status);
			
			$data['title'] = "Detail Order";
			$data['username'] = $this->input->cookie('proyek');
			$data['allDataOrder'] = $this->barang_model->getDataHorder();
			
			// loads views
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('order_view', $data);
			$this->load->view('includes/footer_empty');
			
		}
		else{
			redirect('admin/login');
		}	
	}

	public function EditStatus_order($horderId){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$data['title'] = "Change Status Order";
			$data['username'] = $this->input->cookie('proyek');
			$status = $this->barang_model->getStatusOrder($horderId); 
			$data['statusOrder'] = $status;
			$data['horderId'] = $horderId; 
			
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar');
			$this->load->view('changeStatusOrder_view', $data);
		}
		else{
			redirect('admin/login');
		}
	}
	
	public function changeStatusOrder(){
		$horder_id = $this->input->post('hidden_horderId');
	}
	
	public function delete_logOrder($id){
		if ($this->model_user->is_admin($this->input->cookie('proyek'))){
		
			$this->barang_model->logOrder_delete($id);
			$data['title'] = "Master Log Order";
			$data['username'] = $this->input->cookie('proyek');
			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar', $data);
			$this->load->view('logOrder_view', $data);
		}
		else{
			redirect('admin/login');
		}
	}
	
	
}
?>