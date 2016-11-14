<?php
/**
 * Created by PhpStorm.
 * User: MESHIANG
 * Date: 12/6/2015
 * Time: 5:22 PM
 */
class Items extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('barang_model');
		$this->load->library('pagination');
    }
	public function index(){
		$data['title'] = "Home";
		$data['popular_barang'] = $this->barang_model->getSomeBarang("popular");
		$data['recent_barang'] = $this->barang_model->getSomeBarang("recent");
		$data['random_barang'] = $this->barang_model->getSomeBarang("random");
		$this->load->view('header',$data);
        $this->load->view('barang/home',$data);
        $this->load->view('footer');
	}
	public function compare(){
		$data['title'] = "Compare";
		$data['barang'] = ['kategori'=>'Compare'];
		$data['barang']['a'] = [];
		$data['barang']['a']['spesifikasi'] = [];
		$data['barang']['b'] = [];
		$data['barang']['b']['spesifikasi'] = [];
		$data['barang']['c'] = [];
		$data['barang']['c']['spesifikasi'] = [];
		$data['compare']['item1'] = $this->input->get('comp1') ? $this->input->get('comp1') : "";
		$data['compare']['item2'] = $this->input->get('comp2') ? $this->input->get('comp2') : "";
		$data['compare']['item3'] = $this->input->get('comp3') ? $this->input->get('comp3') : "";
		$data['list_other_barang'] = [];
		$data['list_all_barang'] = [];
		if($this->input->get('comp1')){
			$data['barang']['a'] = $this->barang_model->getBarang($this->input->get('comp1'));
			$data['list_other_barang'] = $this->barang_model->getListOtherBarang($this->input->get('comp1'));
			$data['dis2'] = '';
			$data['dis3'] = '';
		}else{
			$data['dis2'] = 'disabled';
			$data['dis3'] = 'disabled';
		}
		if($this->input->get('comp2')){
			$data['barang']['b'] = $this->barang_model->getBarang($this->input->get('comp2'));
			if($data['barang']['a']['kategori'] != $data['barang']['b']['kategori']){
				$data['barang']['b'] = [];
				$data['barang']['b']['spesifikasi'] = [];
			}
		}
		if($this->input->get('comp3')){
			$data['barang']['c'] = $this->barang_model->getBarang($this->input->get('comp3'));
			if($data['barang']['a']['kategori'] != $data['barang']['c']['kategori']){
				$data['barang']['c'] = [];
				$data['barang']['c']['spesifikasi'] = [];
			}
		}
		$data['list_all_barang'] = $this->barang_model->getListAllBarang();
		$this->load->view('header',$data);
        $this->load->view('barang/compare',$data);
        $this->load->view('footer');
	}
	public function browse(){
		$limit = 6;
		$data['barang'] = ['kategori' => "Browse"];
		$data['title'] = "Browse";
		$data['search']['name'] = $this->input->get('srcTxt') ? $this->input->get('srcTxt') : "";
		$data['search']['selected_category'] = $this->input->get('categorydd') ? $this->input->get('categorydd') : "all";
		$data['search']['selected_brand'] = $this->input->get('branddd') ? $this->input->get('branddd') : "all";
		$data['search']['maxpricenow'] = $this->input->get('maxprice') ? $this->input->get('maxprice') : $this->barang_model->getMaxPrice();
		$data['search']['minpricenow'] = $this->input->get('minprice') ? $this->input->get('minprice') : 0;
		$data['search']['maxprice'] = $this->barang_model->getMaxPrice();
		$data['search']['brand_list'] = [];
		foreach($this->barang_model->getBrands("all") as $brand){
			$data['search']['brand_list'][$brand->brand] = $brand->brand;
		}
		$data['search']['brand_list']['all'] = "All";
		$data['search']['category_list'] = [];
		foreach($this->barang_model->getCategories() as $cat){
			$data['search']['category_list'][$cat->id] = $cat->nama;
		}
		$data['search']['category_list']['all'] = "All";
		
		$searchdata = [];
		$searchdata['kategori_id'] = $data['search']['selected_category'];
		$searchdata['nama'] = $data['search']['name'];
		$searchdata['deskripsi'] = $data['search']['name'];
		$searchdata['brand'] = $data['search']['selected_brand'];
		$searchdata['maxprice'] = $data['search']['maxpricenow'];
		$searchdata['minprice'] = $data['search']['minpricenow'];
		
		$settings['base_url'] = base_url()."/items/browse/";
		$settings['total_rows'] = $this->barang_model->countBarangBySearch($searchdata);
		$settings['per_page'] = $limit;
		$settings['uri_segment'] = 3;
		if (count($_GET) > 0) $settings['suffix'] = '?' . http_build_query($_GET, '', "&");
		if (count($_GET) > 0)$settings['first_url'] = $settings['base_url'].'?'.http_build_query($_GET);
		
		$this->pagination->initialize($settings);
		$page = $this->uri->segment(3,0);
		$data['links'] = $this->pagination->create_links();
		$data['barang_list'] = $this->barang_model->getBarangBySearch($searchdata,$limit,$page);
		$data['viewstring'] = $settings['total_rows'] > 0 ? "Viewing items " . ($page+1) . " to " . ($page+count($data['barang_list'])) . " from ".$settings['total_rows']." results" : "No items found";
		$this->load->view('header',$data);
        $this->load->view('barang/search',$data);
        $this->load->view('footer');
	}
    public function detail($barang_id){
        $this->load->helper('form');
        $barang = $this->barang_model->getBarang($barang_id);
		
        $arr = [];
        if ($this->session->userdata('viewed_items')){
            $arr = explode(';',$this->session->userdata('viewed_items'));
        }
        if (!in_array($barang_id,$arr)){
            $arr[] = $barang_id;
            $this->barang_model->hitViewBarang($barang_id);
            $this->session->set_userdata('viewed_items',implode(';',$arr));
        }
        $data['title'] = $barang["nama"]. ' | '.$barang['kategori'];
        $data['other_barang'] = $this->barang_model->getOtherBarang();
        $data['barang'] = $barang;
        $this->load->view('header',$data);
        $this->load->view('barang/detail',$data);
        $this->load->view('footer');
    }
    public function addToCart(){
        if($this->input->post('cart_id')){
            $rowid = "";
            $changed_quantity = 0;
            foreach ($this->cart->contents() as  $item){
                $product_options = $this->cart->product_options($item['rowid']);
                if ($item['id'] == $this->input->post('cart_id') && $product_options['warna'] == $this->input->post('cart_warna')){
                    $rowid = $item['rowid'];
                    $changed_quantity = $item['qty'] + $this->input->post('cart_qty');
                }
            }
            if ($rowid == "") {
                $barang = $this->barang_model->getBarang($this->input->post('cart_id'));
                $warna = $this->input->post('cart_warna');
                $gambar = $barang["gambar"][0];
                for ($i = 0; $i < count($barang['gambar']); $i++) {
                    if ($i < count($barang["warna"]) && $barang["warna"][$i] == $warna) {
                        $gambar = $barang["gambar"][$i];
                    }
                }
                $item = ['id' => $barang["id"],
                    'name' => $barang['nama'],
                    'price' => $barang['harga_total'],
                    'qty' => $this->input->post('cart_qty'),
                    'options' => ['gambar' => $gambar, 'warna' => $warna,'kategori'=>$barang['kategori'], 'berat_gram' => $barang['berat_gram']]
                ];
                $this->cart->insert($item);
            }
            else {
                $item = ['rowid' => $rowid, 'qty' => $changed_quantity];
                $this->cart->update($item);
            }
        }
        echo $this->load->view('barang/ajax_cart',null,true);
    }
    public function deleteFromCart(){
        if ($this->input->post('cart_rowid')){
            $item = ['rowid' => $this->input->post('cart_rowid'), 'qty' => 0];
            $this->cart->update($item);
        }
        echo $this->load->view('barang/ajax_cart',null,true);
    }




}