<?php

class Barang_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	public function getBarangByCategory($category_id,$limit,$start){
		$this->db->limit($limit,$start);
		if($category_id != "all"){
			$this->db->where('kategori_id', $category_id);
		}
		$result = $this->db->get('barang')->result();
		$barang_list = [];
		foreach($result as $row){
			$barang_list[] = $this->getBarang($row->id);
		}
		return $barang_list;
	}
	public function getBrands($category_id){
		if($category_id != "all"){
			$this->db->where('kategori_id',$category_id);
		}
		$this->db->select('brand');
		$this->db->distinct();
		return $this->db->get('barang')->result();
	}
	public function getCategories(){
		return $this->db->get('kategori')->result();
	}
	public function getCategoryName($category_id){
		if($category_id == "all") return "All";
		$this->db->where('id', $category_id);
		return $this->db->get('kategori')->row()->nama;
	}
	public function getMaxPrice(){
		$this->db->select_max('harga');
		return $this->db->get('barang')->row()->harga;
	}
	public function getBarangKategori($barang_id){
		$this->db->where('id',$barang_id);
		return $this->db->get('barang')->row()->kategori_id;
	}
	public function getListAllBarang(){
		$rows = $this->db->get('barang')->result();
		$data = [];
		foreach($rows as $row){
			$data[$row->id] = $row->nama;
		}
		return $data;
	}
	public function getListOtherBarang($barang_id){
		$this->db->where('kategori_id',$this->getBarangKategori($barang_id));
		$this->db->where('id !=',$barang_id);
		$rows = $this->db->get('barang')->result();
		$data = [];
		foreach($rows as $row){
			$data[$row->id] = $row->nama;
		}
		return $data;
	}
	public function getBarangBySearch($sdata,$limit,$start){
		$this->db->limit($limit,$start);
		$nm = $sdata['nama']; $desc = $sdata['deskripsi'];
		$this->db->where("(nama LIKE '%$nm%' OR deskripsi LIKE '%$desc%')");
		if($sdata['brand'] != "all")$this->db->where('brand',$sdata['brand']);
		if($sdata['kategori_id'] != "all")$this->db->where('kategori_id',$sdata['kategori_id']);
		$this->db->where('harga <=',$sdata['maxprice']);
		$this->db->where('harga >=',$sdata['minprice']);
		$result = $this->db->get('barang')->result();
		$barang_list = [];
		foreach($result as $row){
			$barang_list[] = $this->getBarang($row->id);
		}
		return $barang_list;
	}
	public function countBarang($category_id){
		if($category_id != "all")$this->db->where('kategori_id',$category_id);
		return $this->db->count_all_results('barang');
	}
	public function countBarangBySearch($sdata){
		$nm = $sdata['nama']; $desc = $sdata['deskripsi'];
		$this->db->where("(nama LIKE '%$nm%' OR deskripsi LIKE '%$desc%')");
		if($sdata['brand'] != "all")$this->db->where('brand',$sdata['brand']);
		if($sdata['kategori_id'] != "all")$this->db->where('kategori_id',$sdata['kategori_id']);
		$this->db->where('harga <=',$sdata['maxprice']);
		$this->db->where('harga >=',$sdata['minprice']);
		return $this->db->count_all_results('barang');
	}
    public function getBarang($barang_id){
        $this->db->where('id',$barang_id);
        $item = $this->db->get('barang')->row();
        if ($this->db->affected_rows() > 0){
            $barang = [];
            $barang['id'] = $item->id;
            $barang['nama'] = $item->nama;
            $barang['brand'] = $item->brand;
            $barang['deskripsi'] = $item->deskripsi;
            $barang['stok'] = $item->stok;
            $barang['harga'] = $item->harga;
            $barang['diskon'] = $item->diskon;
            $barang['berat_gram'] = $item->berat_gram;
            $barang['harga_total'] = (100-$item->diskon)*$item->harga/100;
            $barang['warna'] = explode(';',$item->warna);
            $barang['gambar'] = explode(';',$item->gambar);
            $kategori = $this->db->get_where('kategori',['id'=> $item->kategori_id])->row();
            $barang['kategori'] = $kategori->nama;
            $judul_detail = explode(';',$kategori->field_detail);
            $jawaban_detail = explode(';', $item->field_detail);
            $detail = [];
            for ($i =0 ; $i< count($judul_detail); $i++){
                $detail[$judul_detail[$i]] = $jawaban_detail[$i];
            }
            $barang['spesifikasi'] = $detail;
            return $barang;
        }
        return false;
    }
    public function getOtherBarang(){
        $sql = "select b.id, b.nama, b.harga, b.diskon,b.berat_gram, b.gambar, k.nama as kategori from barang b, kategori k where k.id = b.kategori_id and b.stok > 0 and b.status = 1 order by rand() limit 4";
        $results = $this->db->query($sql)->result();
        $items =  [];
        foreach ($results as $result){
            $item = [];
            $item['id'] = $result->id;
            $item['nama'] = $result->nama;
            $item['harga'] = $result->harga;
            $item['diskon'] = $result->diskon;
            $item['berat_gram'] = $result->berat_gram;
            $item['harga_total'] = (100-$result->diskon)*$result->harga/100;
            $temp_gambar = explode(';',$result->gambar);
            $item['gambar'] =$temp_gambar[0];
            $item['kategori'] = $result->kategori;
            $items[] = $item;
        }
        return $items;
    }
	public function getSomeBarang($mode){
		if($mode == "popular"){
			$sql = "select b.id, b.nama, b.harga, b.diskon,b.berat_gram, b.gambar, b.jumlah_lihat, k.nama as kategori from barang b, kategori k where k.id = b.kategori_id and b.stok > 0 and b.status = 1 order by b.jumlah_lihat limit 4";
		}
		if($mode == "random"){
			$sql = "select b.id, b.nama, b.harga, b.diskon,b.berat_gram, b.gambar, k.nama as kategori from barang b, kategori k where k.id = b.kategori_id and b.stok > 0 and b.status = 1 order by rand() limit 4";
		}
		if($mode == "recent"){
			$sql = "select distinct b.id, b.nama, b.harga, b.diskon,b.berat_gram, b.gambar, b.jumlah_lihat, k.nama as kategori from dorder d, barang b, kategori k where k.id = b.kategori_id and b.stok > 0 and b.status = 1 and d.barang_id = b.id order by d.id limit 4";
		}
        $results = $this->db->query($sql)->result();
        $items =  [];
        foreach ($results as $result){
            $item = [];
            $item['id'] = $result->id;
            $item['nama'] = $result->nama;
            $item['harga'] = $result->harga;
            $item['diskon'] = $result->diskon;
            $item['berat_gram'] = $result->berat_gram;
            $item['harga_total'] = (100-$result->diskon)*$result->harga/100;
            $temp_gambar = explode(';',$result->gambar);
            $item['gambar'] =$temp_gambar[0];
            $item['kategori'] = $result->kategori;
            $items[] = $item;
        }
        return $items;
    }
    public function hitViewBarang($barang_id){
        $this->db->set('jumlah_lihat','jumlah_lihat + 1',false);
        $this->db->where('id', $barang_id);
        $this->db->update('barang');
        return $this->db->affected_rows();
    }
	// NANCY
		public function insertKategori($nama, $fd, $status){
		$data = array(
			'nama'=>$nama,
			'field_detail'=>$fd,
			'status'=>$status
		);
		
		$this->db->insert('kategori', $data);
		return $this->db->affected_rows();
	}
	
	public function allKategori(){
		$this->db->select('nama');
		$this->db->from('kategori');
		$result = $this->db->get()->result_array();
		return $result;
	
	}
	
	public function getKategoriId($namaKategori){
		$this->db->select('id');
		$this->db->from('kategori');
		$this->db->where('nama', $namaKategori);
		$result = $this->db->get()->row()->id;
		return $result;
	}
	
	public function getNamaBrg($id){
		$this->db->select('nama');
		$this->db->from('barang');
		$this->db->where('id', $id);
		return $this->db->get()->row()->nama;
	}
	
	public function insertBarangBaru($nama, $brand, $desk, $stock, $hrg, $disk, $idKategori, $detBrg, $garansi, $kumpulanFileName, $kumpulanWarna){
		$data = array(
			'nama' => $nama,
			'brand' => $brand,
			'deskripsi'=> $desk,
			'stok' => $stock,
			'harga'=> $hrg,
			'diskon'=> $disk,
			'kategori_id'=> $idKategori,
			'field_detail'=> $detBrg,
			'garansi'=> $garansi,
			'warna' => $kumpulanWarna,
			'gambar'=> $kumpulanFileName
		);
		
		$this->db->insert('barang', $data);
	
	}
	
	public function getAllDataBarang(){
		$this->db->select('id as id_barang, nama as nama_barang, brand as brand_barang, stok as stock_barang, harga as harga_barang, diskon as diskon_barang, status as status');
		$this->db->from('barang');
		$results = $this->db->get()->result();
		
		return $results;
	}
	
	public function getAllDataKategori(){
		$this->db->select('id as id_kategori, nama as nama_kategori, status as status_kategori');
		$this->db->from('kategori');
		$results = $this->db->get()->result();
		
		return $results;
	}
	
	public function getDataHorder(){
		$this->db->select('*');
		$this->db->from('horder');
		$results = $this->db->get()->result();
		
		return $results;
	}
	
	public function getDataLogOrder($orders, $limit, $start){
		$this->db->select('*');
		$this->db->from('log_order');
		$this->db->limit($limit,$start);
		
		if ($orders != null){
			foreach ($orders as $key => $value){
				$this->db->order_by($key, $value);
			}
		}
		
		$results = $this->db->get()->result();
		
		$arrLogOrder = [];
		foreach($results as $row){
			$logOrder = [];
			$logOrder [] = $row->id;
			$logOrder [] = $row->horder_id;
			$logOrder [] = $row->status;
			$logOrder [] = $row->tanggal;
			$logOrder [] = anchor('barang/delete_logOrder/'.$row->id,'Delete', 'class="btn btn-primary btn-sm"');
		
			$arrLogOrder [] = $logOrder;
		}
		
		return $arrLogOrder;
	}
	
	public function countAll() {
		$this->db->select('*');
        $this->db->from('barang');
		return $this->db->count_all_results();
    }
	
	public function countAllKategori() {
		$this->db->select('*');
        $this->db->from('kategori');
		return $this->db->count_all_results();
    }
	
	public function countAllOrder() {
		$this->db->select('*');
        $this->db->from('horder');
		return $this->db->count_all_results();
    }
	
	public function countAllLogOrder() {
		$this->db->select('*');
        $this->db->from('log_order');
		return $this->db->count_all_results();
    }
	
	public function countAllTodayOrder(){
		$this->db->select('*');
        $this->db->from('todayorder');
		return $this->db->count_all_results();
    }
	
	public function get_detailBarang($id_barang){
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('id', $id_barang);
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function get_gambarBarang($id){
		$this->db->select('gambar');
		$this->db->from('barang');
		$this->db->where('id', $id);
		$result = $this->db->get()->row()->gambar;
		return $result;
	}
	
	public function get_warnaBarang($id){
		$this->db->select('warna');
		$this->db->from('barang');
		$this->db->where('id', $id);
		$result = $this->db->get()->row()->warna;
		return $result;
	}
	
	public function UbahGambarBarang($id,$nama, $brand, $desk,$stok,$harga,$diskon, $det, $garansi,$berat,$status, $kumpulanGambar, $kumpulanWarna){
		$data = array(
			'nama' => $nama,
			'brand' =>$brand,
			'deskripsi' =>$desk,
			'stok' =>$stok,
			'harga' => $harga,
			'diskon' => $diskon,
			'field_detail' => $det,
			'garansi' => $garansi,
			'berat_gram' => $berat,
			'status' => $status,
			'gambar' => $kumpulanGambar,
			'warna' => $kumpulanWarna
			
		);
		
		$this->db->where('id', $id);
		$this->db->update('barang', $data);
		
	}
	
	public function tambahGambarBarang($id, $gbr, $warna){
		$this->db->select('gambar');
		$this->db->from('barang');
		$this->db->where('id', $id);
		$kumpGambar = $this->db->get()->row()->gambar;
		$kumpGambar.= ';images/'.$gbr; 
		
		$this->db->select('warna');
		$this->db->from('barang');
		$this->db->where('id', $id);
		$kumpWarna = $this->db->get()->row()->warna;
		$kumpWarna .= ';'.$warna;
		$data = array(
			'gambar' => $kumpGambar,
			'warna' => $kumpWarna		
		);
		
		$this->db->where('id', $id);
		$this->db->update('barang', $data);
	}
	
	public function getDataKategori($id_kategori){
		$this->db->select('*');
		$this->db->from('kategori');
		$this->db->where('id', $id_kategori);
		$result = $this->db->get()->result();
		return $result;
	}
	

	
	public function update_kategori($id, $nama, $det, $status){
		$data = array(
			'nama'=> $nama,
			'field_detail' => $det,
			'status' => $status
		);
		
		$this->db->where('id', $id);
		$this->db->update('kategori', $data);
	}
	
	public function getDataOrder($horder_id){
		$this->db->select('*');
		$this->db->from('horder');
		$this->db->where('id', $horder_id);
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function getDetailOrder($id){
		$this->db->select('*');
		$this->db->from('dorder');
		$this->db->where('horder_id', $id);
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function getDataDetailOrder($selected_horderId){
		 
		$this->db->select('*');
		$this->db->from('dorder');
		$this->db->where('horder_id', $selected_horderId);
		$results = $this->db->get()->result();
		
		return $results;	
	}
	
	public function setDataOrderHariIni(){
		// clear data from table
		$this->db->select('*');
		$this->db->from('todayorder');
		$result = $this->db->get()->result();
		
		foreach($result as $row){
			$this->db->where('id', $row->id);
			$this->db->delete('todayorder');
		
		}
		
		$tgl_saatIni = date('Y-m-d');
		
		$this->db->select('id, tanggal_create');
		$this->db->from('horder');
		$resultsTanggalCreated = $this->db->get()->result();
		
		$arr_horderId = []; 
		foreach($resultsTanggalCreated as $row){
			$tglcreate = explode(" ", $row->tanggal_create);
			if($tglcreate[0] == $tgl_saatIni){
				$arr_horderId [] = $row->id; 
			}
		}
		
		if(count($arr_horderId) > 0){
		for($i = 0; $i < count($arr_horderId); $i++){
			
			$this->db->select('id');
			$this->db->from('dorder');
			$this->db->where('horder_id', $arr_horderId[$i]);
			$resultDorderId = $this->db->get()->result();
			
			foreach($resultDorderId as $rowDorder){
				
				$this->db->select('barang_id');
				$this->db->from('dorder');
				$this->db->where('id', $rowDorder->id);
				$barangId = $this->db->get()->row()->barang_id;
				
				$this->db->select('nama');
				$this->db->from('barang');
				$this->db->where('id', $barangId);	
				$namaBarang = $this->db->get()->row()->nama;
				
				$this->db->select('keterangan');
				$this->db->from('dorder');
				$this->db->where('id', $rowDorder->id);
				$ket = $this->db->get()->row()->keterangan;
				
				$this->db->select('qty');
				$this->db->from('dorder');
				$this->db->where('id', $rowDorder->id);
				$qty = $this->db->get()->row()->qty;
				
				$data = array(
					'horder_id' => $arr_horderId[$i],
					'barang_id' => $barangId,
					'nama_barang' => $namaBarang,
					'keterangan' => $ket,
					'qty' => $qty,
					'date' => $tgl_saatIni
				);
				
				$this->db->insert('todayorder', $data);
			}
		}
		}
	}
	
	public function getTodayOrder(){
		$tgl_hariIni = date('Y-m-d');
		
		$this->db->select('*');
		$this->db->from('todayorder');
		$this->db->where('date', $tgl_hariIni);
		$results = $this->db->get()->result();
		
		return $results;
	}
	
	public function getDataDOrder($id_dorder){
		$this->db->select('*');
		$this->db->from('dorder');
		$this->db->where('id', $id_dorder);
		$result = $this->db->get()->result();
		return $result;
	}
	
	public function countAllDOrder($selected_horderId){
		$this->db->select('*');
        $this->db->from('dorder');
		$this->db->where('horder_id', $selected_horderId);
		return $this->db->count_all_results();
	}
	
	public function updateDorder($idDOrder,$horderId ,$barangId,$ket,$qty,$hrg,$subtot,$status){
		$data = array(
			'keterangan'=>$ket,
			'qty'=> $qty,
			'harga'=>$hrg,
			'subtotal'=>$subtot,
			'status'=>$status
		);
		$this->db->where('id', $idDOrder);
		$this->db->where('horder_id', $horderId);
		$this->db->where('barang_id', $barangId);
		$this->db->update('dorder', $data);
	}
	
	public function getStatusOrder($horderId){
		$this->db->select('status');
		$this->db->from('horder');
		$this->db->where('id', $horderId);
		$result = $this->db->get()->row()->status;
		return $result;	
	}
	
	public function logOrder_delete($id){
		$this->db->where('id', $id);
		$this->db->delete('log_order');
	}
	
	public function update_dbarang($id_barang, $nama, $brand, $deskripsi, $stock, $hrg, $diskon, $detail, $garansi,$berat,$status){
		$data = array(
			'nama'=>$nama,
			'brand'=>$brand,
			'deskripsi'=>$deskripsi,
			'stok'=> $stock, 
			'harga'=>$hrg,
			'diskon'=>$diskon,
			'field_detail'=>$detail,
			'garansi'=> $garansi,
			'berat_gram'=> $berat,
			'status'=> $status
		);
		$this->db->where('id', $id_barang);
		$this->db->update('barang', $data);
	}
	
	 public function insertLog($horder_id, $status){
        $data = ['horder_id' => $horder_id, 'status' => 'Order #'.$horder_id.': '.$status];
        $this->db->insert('log_order',$data);
        return $this->db->affected_rows();
    }

    public function changeOrder($horder_id,$to){
        $data = [
			'status' => $to
		];
        $this->db->set('tanggal_update','now()',false);
        $this->db->where('id', $horder_id);
        $this->db->update('horder',$data);
        
		return $this->db->affected_rows();
    }

    public function changeOrderToPending($horder_id){
        $this->changeOrder($horder_id,'1');
        $this->insertLog($horder_id," Menunggu customer untuk menyelesaikan transaksi");
        
		return $this->db->affected_rows();
    }
    public function changeOrderToFinishPayment($horder_id, $transaction_id,$payment_type){
        $this->changeOrder($horder_id,'2');
        $this->insertLog($horder_id," Berhasil Menyelesaikan transaksi. Order sedang diproses.");
		
        $data = ['kode_pembayaran' => $transaction_id, 'tipe_pembayaran'=>$payment_type];
        $this->db->where('id',$horder_id);
        $this->db->update('horder',$data);

        return $this->db->affected_rows();
    }
    public function changeOrderToSent($horder_id, $kode_jne){
        $this->changeOrder($horder_id,'3');
        $this->insertLog($horder_id," Order sudah dikirim dengan resi #".$kode_jne);

        $data = ['kode_jne'=>$kode_jne];
        $this->db->where('id',$horder_id);
        $this->db->update('horder',$data);
		return $this->db->affected_rows();
    }
    public function changeOrderToCancel($horder_id){
        $this->changeOrder($horder_id,'0');
        $this->insertLog($horder_id," Order dibatalkan.");
        return $this->db->affected_rows();
    }
    public function changeOrderToProblem($horder_id){
        $this->changeOrder($horder_id,'4');
        $this->insertLog($horder_id," Pembayaran masih menunggu verifikasi merchant");
        return $this->db->affected_rows();
    }
	



}