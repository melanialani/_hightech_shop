<?php

class Order_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getAllOrderByCustomer($username){
        $this->db->select('id,grand_total,tanggal_update,status');
        $this->db->from('horder');
        $this->db->where('user_username',$username);
        $this->db->order_by('tanggal_create','desc');
        $results = $this->db->get()->result();
        if ($this->db->affected_rows() > 0){
            $orders = [];
            foreach ($results as $result){
                $order = [];
                $order['id'] = $result->id;
                $order['grand_total'] = $result->grand_total;
                $order['tanggal_update'] = $result->tanggal_update;
                $order['status'] = $result->status;

                $order['barang'] = "";
                $this->db->select('d.barang_id, b.nama,d.keterangan, d.qty');
                $this->db->from('dorder d, barang b');
                $this->db->where('d.horder_id',$result->id);
                $this->db->where('d.barang_id = b.id');
                $items = $this->db->get()->result();
                foreach ($items as $item){
                    $order['barang'] .=  $item->nama." - ".$item->keterangan.'('.$item->qty.') <br>';
                }
                $orders[] = $order;
            }

            return $orders;
        }
        return false;
    }

    public function insertHOrder($user_id, $nama_penerima,$alamat,$kota,$total,$harga_jne,$grand_total,$voucher_id,$cara_jne){
        if($voucher_id != null) {
            $data = ['user_username' => $user_id, 'voucher_id' => $voucher_id];
            $this->db->insert('user_voucher',$data);
        }
        else {
            $voucher_id = "";
        }
        $data = ['user_username' => $user_id,
            'nama_penerima' => $nama_penerima,
            'alamat' => $alamat,
            'kota' => $kota,
            'total' => $total,
            'harga_jne' => $harga_jne,
            'grand_total' => $grand_total,
            'voucher_id' => $voucher_id,
            'cara_jne' => $cara_jne
        ];
        $this->db->insert('horder',$data);
        $horder_id = $this->db->insert_id();

        $data = ['horder_id' => $horder_id, 'status' => 'Order #'.$horder_id.' menunggu konfirmasi pembayaran'];
        $this->db->insert('log_order',$data);
        return $horder_id;
    }

    public function insertDOrder($horder_id,$barang_id,$keterangan,$qty,$harga,$subtotal){
        $data = ['horder_id' => $horder_id,
            'barang_id' => $barang_id,
            'keterangan' => $keterangan,
            'qty' => $qty,
            'harga' => $harga,
            'subtotal' => $subtotal
        ];
        $this->db->insert('dorder',$data);
    }

    public function getOrder($order_id){
        $this->db->select('h.user_username, h.alamat, h.nama_penerima, h.grand_total, h.total, h.harga_jne');
        $this->db->where('h.id',$order_id);
        $horder = $this->db->get('horder h')->row();

        $order = [];
        $order['id'] = $order_id;
        $order['username'] = $horder->user_username;
        $order['alamat'] = $horder->alamat;
        $order['nama'] = $horder->nama_penerima;
        $order['grand_total'] = $horder->grand_total;
        $order['ongkir'] = $horder->harga_jne;
        $order['total'] = $horder->total;
        $order['potongan_voucher'] = $horder->harga_jne + $horder->total - $horder->grand_total;

        $this->db->select('b.warna, b.gambar,d.barang_id, b.nama, d.keterangan, d.qty, d.harga, d.subtotal');
        $this->db->from('dorder d, barang b');
        $this->db->where('b.id = d.barang_id');
        $this->db->where('d.horder_id',$order_id);
        $results = $this->db->get()->result();
        $products = [];
        foreach ($results as $result){
            $product=[];
            $product['id'] = $result->barang_id;
            $product['name'] = $result->nama." ( ".$result->keterangan." )";
            $product['qty'] = $result->qty;
            $product['price'] = $result->harga;
            $product['subtotal'] = $result->subtotal;

            $arrGambar = explode(';',$result->gambar);
            $arrWarna = explode(';',$result->warna);
            $product['gambar'] = $arrGambar[0];
            for ($i=0;$i< count($arrGambar) && $i<count($arrWarna);$i++){
                if ($arrWarna[$i] == $result->keterangan ){
                    $product['gambar'] = $arrGambar[$i];
                }
            }

            $products[] = $product;
        }
        $order['products'] = $products;

        $this->db->select('tanggal,status');
        $this->db->where('horder_id',$order_id);
        $this->db->order_by('tanggal','asc');
        $results = $this->db->get('log_order')->result_array();
        $order['log'] = $results;

        return $order;
    }
    public function insertLog($horder_id, $status){
        $data = ['horder_id' => $horder_id, 'status' => 'Order #'.$horder_id.': '.$status];
        $this->db->insert('log_order',$data);
        return $this->db->affected_rows();
    }

    public function changeOrder($horder_id,$to){
        $data = ['status' => $to];
        $this->db->set('tanggal_update','now()',false);
        $this->db->where('id', $horder_id);
        $this->db->update('log_order',$data);
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

        $data = ['kode_pembayaran' => $transaction_id, 'tipe_pembayaran', $payment_type];
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