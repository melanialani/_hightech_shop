<?php

class Orders extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('p_username')){
            $this->session->set_flashdata('alert_level','danger');
            $this->session->set_flashdata('alert','You need to login to view this page!');
            $this->session->set_userdata('current_url', uri_string());
            redirect('auth/login');
        }
        $this->load->model('order_model');
    }
    public function index(){
        redirect('order/checkout');
    }
    public function checkout(){
        if($this->cart->total_items() == 0){
            $this->session->set_flashdata('alert_con_level','danger');
            $this->session->set_flashdata('alert_con','There\'s nothing in your cart. Choose an item first');
            redirect('/');
        }
        $data['title'] ='Checkout Order ';
        $data['notShowCart'] = true;
        if ($this->input->post('btnEditCart')){
            $item = ['rowid' => $this->input->post('cart_rowid'), 'qty' => $this->input->post('cart_qty')];
            $this->cart->update($item);
        }
        else if($this->input->post('btnRemoveCart')) {
            $item = ['rowid' => $this->input->post('cart_rowid'), 'qty' => 0];
            $this->cart->update($item);
        }
        $this->load->view('header',$data);
        $this->load->view('order/checkout',$data);
        $this->load->view('footer',$data);
    }
    public function billing(){
        if($this->cart->total_items() == 0){
            $this->session->set_flashdata('alert_con_level','danger');
            $this->session->set_flashdata('alert_con','There\'s nothing in your cart. Choose an item first');
            redirect('/');
        }
        $data['title'] ='Billing Order ';
        $data['notShowCart'] = true;

        if($this->input->post('btnSubmit')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama_penerima','Nama Penerima','required|max_length[50]|trim');
            $this->form_validation->set_rules('alamat_penerima','Alamat Penerima','required|max_length[255]|trim');
            $this->form_validation->set_rules('provinsi_id','Provinsi Penerima','required|numeric');
            $this->form_validation->set_rules('city_id','Kota Penerima','required|numeric');
            if($this->form_validation->run()){
                $this->session->unset_userdata('nama_penerima');
                $this->session->unset_userdata('alamat_penerima');
                $this->session->unset_userdata('kota_penerima');
                $this->session->unset_userdata('kota_penerima_id');
                $this->session->unset_userdata('provinsi_penerima');
                $this->session->unset_userdata('provinsi_penerima_id');
                $this->session->set_userdata('nama_penerima', $this->input->post('nama_penerima'));
                $this->session->set_userdata('alamat_penerima', $this->input->post('alamat_penerima'));
                $this->session->set_userdata('kota_penerima', $this->input->post('city'));
                $this->session->set_userdata('kota_penerima_id', $this->input->post('city_id'));
                $this->session->set_userdata('provinsi_penerima', $this->input->post('provinsi'));
                $this->session->set_userdata('provinsi_penerima_id', $this->input->post('provinsi_id'));
                redirect('orders/payment');
            }


        }
        // Ambil Data Session
        $username =  $this->session->userdata('p_username');
        $this->load->model('customer_model');
        $data['user'] = $this->customer_model->getUser($username);
        if ($data['user']->provinsi_id == "0"){
            $data['dd_city'] = $this->customer_model->getListCity(1);
        }
        else {
            $data['dd_city'] = $this->customer_model->getListCity($data['user']->provinsi_id);
        }
        $data['dd_province'] = $this->customer_model->getListProvince();

        $this->load->view('header',$data);
        $this->load->view('order/billing',$data);
        $this->load->view('footer',$data);
    }
    public function payment(){
        if($this->cart->total_items() == 0){
            $this->session->set_flashdata('alert_con_level','danger');
            $this->session->set_flashdata('alert_con','There\'s nothing in your cart. Choose an item first');
            redirect('/');
        }
        if (!$this->session->userdata('nama_penerima')){
            $this->session->set_flashdata('alert_con','Anda belum menentukan alamat pengiriman barang.');
            $this->session->set_flashdata('alert_con_level','danger');
            redirect('orders/billing');
        }
        if ($this->input->post('btnPurchase')){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('kode_kurir','Kode Kurir','required');
            $this->form_validation->set_rules('service_kurir','Service Kurir','required');
            if ($this->form_validation->run()){

                // Insert Horder
                $this->load->model('voucher_model');
                $ongkir = $this->_getRecountOngkir($this->input->post('kode_kurir'),$this->input->post('service_kurir'));
                $temp = $this->voucher_model->getVoucher($this->session->userdata('p_username'),$this->input->post('voucher_id'));
                $potongan_harga = 0;
                if ($temp != -1 && $temp != -2){
                    $potongan_harga = $temp;
                }
                $hargaTotal = $this->cart->total();
                $grandTotal = $this->cart->total() + $ongkir - $potongan_harga;
                $caraJne = strtoupper($this->input->post('kode_kurir')." ".$this->input->post('service_kurir'));
                $nama = $this->session->userdata('nama_penerima');
                $alamat =  $this->session->userdata('alamat_penerima')." ".$this->session->userdata('kota_penerima').', '.$this->session->userdata('provinsi_penerima');
                $kota_id = $this->session->userdata('kota_penerima_id');


                $horder_id = $this->order_model->insertHOrder($this->session->userdata('p_username'),$nama,$alamat,$kota_id,$hargaTotal,$ongkir,$grandTotal,$this->input->post('voucher_id'),$caraJne);

                // Insert Detailnya
                foreach ($this->cart->contents() as $product){
                    $product_options = $this->cart->product_options($product['rowid']);
                    $this->order_model->insertDOrder($horder_id,$product['id'],$product_options['warna'],$product['qty'],$product['price'],$product['subtotal']);
                }
                // Delete Cartnya
                $this->cart->destroy();
                $this->session->unset_userdata('nama_penerima');
                $this->session->unset_userdata('alamat_penerima');
                $this->session->unset_userdata('kota_penerima');
                $this->session->unset_userdata('kota_penerima_id');
                $this->session->unset_userdata('provinsi_penerima');
                $this->session->unset_userdata('provinsi_penerima_id');
                redirect('orders/confirm/'.$horder_id);
            }
        }
        // Halaman Payment
        $data['title'] ='Payment Order ';
        $data['notShowCart'] = true;
        $this->load->view('header',$data);
        $this->load->view('order/payment',$data);
        $this->load->view('footer',$data);
    }
    public function confirm($horder_id){
        $data['title'] ='Confirm Order #'.$horder_id." ";
        $data['notShowCart'] = true;
        $data['order'] = $this->order_model->getOrder($horder_id);
        if ($data['order']['username'] != $this->session->userdata('p_username')){
            // Data tak sama
            $this->session->set_flashdata('alert_con_level','danger');
            $this->session->set_flashdata('alert_con','You can\'t view this order!');
            redirect('/');
        }
        $this->load->view('header',$data);
        $this->load->view('order/confirm',$data);
        $this->load->view('footer',$data);
    }

    public function getOngkirBarang(){
        if ($this->input->post('kode_kurir')) {
            $this->load->library('curl');
            $totalGram = 0;
            foreach ($this->cart->contents() as $item) {
                $product_options = $this->cart->product_options($item['rowid']);
                $totalGram = $totalGram + $product_options['berat_gram'] * $item['qty'];
            }
            $arr = json_decode($this->curl->simple_post('http://api.rajaongkir.com/starter/cost',
                ['key' => 'aa9e53551783cc4033336ff25586148f',
                    'origin' => 444,
                    'destination' => $this->session->userdata('kota_penerima_id'),
                    'weight' => $totalGram,
                    'courier' => $this->input->post('kode_kurir')
                ]
            ))->rajaongkir;
            $arrCourier = $arr->results;
            foreach ($arrCourier as $courier) {
                if (count($courier->costs) > 0) {
                    $arrService = $courier->costs;
                    foreach ($arrService as $service) {
                        echo form_radio(['name' => 'radio_service', 'data-val' => $service->cost[0]->value, 'value' => $service->service]) . " " . $courier->name . " " . $service->service . " ( IDR " . number_format($service->cost[0]->value) . ") ";
                        if ($service->cost[0]->etd != "") {
                            echo $service->cost[0]->etd . " hari ";
                        } else if ($service->cost[0]->etd == "1-1") {
                            echo "1 hari ";
                        }
                        echo "<br/>";
                    }
                }
            }
        }
    }
    public function _getRecountOngkir($kode,$serviceChosen){
        $this->load->library('curl');
        $totalGram = 0;
        foreach ($this->cart->contents() as $item) {
            $product_options = $this->cart->product_options($item['rowid']);
            $totalGram = $totalGram + $product_options['berat_gram'] * $item['qty'];
        }
        $arr = json_decode($this->curl->simple_post('http://api.rajaongkir.com/starter/cost',
            ['key' => 'aa9e53551783cc4033336ff25586148f',
                'origin' => 444,
                'destination' => $this->session->userdata('kota_penerima_id'),
                'weight' => $totalGram,
                'courier' => $kode
            ]
        ))->rajaongkir;
        $arrCourier = $arr->results;
        foreach ($arrCourier as $courier) {
            if (count($courier->costs) > 0) {
                $arrService = $courier->costs;
                foreach ($arrService as $service) {
                    if($service->service == $serviceChosen){
                        return $service->cost[0]->value;
                    }
                }
            }
        }
    }
    public function getVoucher(){
        if ($this->input->post('voucher_code')){
            $this->load->model('voucher_model');
            $voucher_code = $this->input->post('voucher_code');
            $user = $this->session->userdata('p_username');
            $success = $this->voucher_model->getVoucher($user,$voucher_code);
            if ($success == -1){
                echo "<strong class='text-danger'>Kode Voucher tidak terdaftar.</strong>";
            }
            else if ($success == -2) {
                echo "<strong class='text-danger'>Voucher sudah pernah dipakai.</strong>";
            }
            else{
                echo $success."_"."<strong class='text-success'>Voucher bisa dipakai.</strong>";
            }
        }
    }

}