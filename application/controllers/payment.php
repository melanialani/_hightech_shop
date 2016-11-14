<?php

class Payment extends  CI_Controller{

    public function __construct(){
        parent::__construct();
        $params = array('server_key' => 'VT-server-60EkrYm1CkNnViim5AdZRuPu', 'production' => false);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->model('order_model');
    }
    public function make($order_id){
        if (!$this->session->userdata('p_username')){
            $this->session->set_flashdata('alert_level','danger');
            $this->session->set_flashdata('alert','You need to login to view this page!');
            $this->session->set_userdata('current_url', uri_string());
            redirect('auth/login');
        }
        $this->load->model('order_model');
        $order = $this->order_model->getOrder($order_id);
        $transaction_details = array(
            'order_id' 			=> $order_id,
            'gross_amount' 	=> $order['grand_total']
        );

        // Populate
        $items = [];
        foreach ($order['products'] as $product){
            $item = [];
            $item['id'] = $product['id'];
            $item['price'] = $product['price'];
            $item['quantity'] = $product['qty'];
            $item['name'] = $product['name'];
            $items[] = $item;
        }
        $item = [];
        $item['id'] = '0';
        $item['price'] = $order['ongkir'];
        $item['quantity'] = 1;
        $item['name'] = 'Ongkir';
        $items[] = $item;

        $item = [];
        $item['id'] = '0';
        $item['price'] = -$order['potongan_voucher'];
        $item['quantity'] = 1;
        $item['name'] = 'Voucher';
        $items[] = $item;

        // Populate customer's billing address
        $shipping_address = array(
            'first_name' 		=> $order['nama'],
            'last_name' 		=> "",
            'address' 			=> $order['alamat'],
            'country_code'	=> 'IDN'
        );


        // Populate customer's Info
        $this->load->model('customer_model');
        $customer = $this->customer_model->getUser($this->session->userdata('p_username'));
        $customer_details = array(
            'first_name' 			=> $customer->nama_depan,
            'last_name' 			=> $customer->nama_belakang,
            'email' 					=> $customer->email,
            'phone' 					=> $customer->telepon,
            'shipping_address'=> $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
        // Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
        $transaction_data = array(
            'payment_type' 			=> 'vtweb',
            'vtweb' 						=> array(
                //'enabled_payments' 	=> ['credit_card'],
                'credit_card_3d_secure' => true
            ),
            'transaction_details'=> $transaction_details,
            'item_details' 			 => $items,
            'customer_details' 	 => $customer_details
        );

        try
        {
            $vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
            header('Location: ' . $vtweb_url);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    public function notification()
    {
        echo 'test notification handler';
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if($result){
            $notif = $this->veritrans->status($result->order_id);
        }
        error_log(print_r($result,TRUE));
        //notification handler sample
        $transaction = $notif->transaction_status;
        $transaction_id = $notif->transaction_id;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id ." is challenged by FDS";
                    $this->order_model->changeOrderToProblem($order_id);
                }
                else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
                    $this->order_model->changeOrderToFinishPayment($order_id,$transaction_id,$type);
                }
            }
        }
        else if ($transaction == 'settlement'){
            // TODO set payment status in merchant's database to 'Settlement'
            echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
            $this->order_model->changeOrderToFinishPayment($order_id,$transaction_id,$type);
        }
        else if($transaction == 'pending'){
            // TODO set payment status in merchant's database to 'Pending'
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
            $this->order_model->changeOrderToPending($order_id);
        }
        else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        }

    }

}