<?php 
include_once 'models/SalesOrderDetail.php';

class SalesOrder {
    private $table = 'reception';
    private $conn;
    private $count = 0;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getOrders($request)
    {
        $query = "SELECT * FROM $this->table WHERE no_nota = :nota";
        $this->conn->query($query);
        $this->conn->bind('nota', $request['nota']);
        return $this->conn->single();
    }

    public function getListOrderItem($orderNumber) {
        $query = "SELECT * FROM detail_penjualan WHERE no_nota = :orderNumber";
        $this->conn->query($query);
        $this->conn->bind('orderNumber', $orderNumber);
        return $this->conn->all();
    }

    public function getCodeOutlet($outlet)
    {
        $query = "SELECT b.id AS branchId, a.id_outlet AS outletId FROM outlet AS a INNER JOIN cabang AS b on a.Kota = b.cabang
                    WHERE nama_outlet = :outlet";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        return $this->conn->single();
    }

    public function getOrderNumber($code)
    {
        $query = "SELECT no_so AS orderNumber FROM $this->table WHERE no_so LIKE :code ORDER BY id DESC LIMIT 0, 1";
        $this->conn->query($query);
        $this->conn->bind('code', $code.'%');
        return $this->conn->single();
    }

    public function saveOrder($data)
    {
        $query = "INSERT INTO $this->table (nama_outlet, tgl_input, nama_reception, id_customer, nama_customer, no_nota, no_so, berat, jenis, express, total_bayar, diskon, cabang)
                    VALUES (:outlet, :datenow, :userId, :customerId, :customer, :orderNumber, :orderNumber, :isWeight, :isType, :express, :total, :discount, :branch)";
        $this->conn->query($query);
        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('datenow', $data['datenow']);
        $this->conn->bind('userId', $data['user']);
        $this->conn->bind('customerId', $data['customer_id']);
        $this->conn->bind('customer', $data['customer']);
        $this->conn->bind('orderNumber', $data['order_number']);
        $this->conn->bind('isWeight', $data['is_weight']);
        $this->conn->bind('isType', $data['is_type']);
        $this->conn->bind('express', $data['express']);
        $this->conn->bind('total', $data['total']);
        $this->conn->bind('discount', $data['discount']);
        $this->conn->bind('branch', $data['branch']);
        $this->conn->execute();

        return $this->conn->rowCount();
    }

    public function insert($dataPost, $data)
    {
        $query = "INSERT INTO $this->table (nama_outlet, tgl_input, nama_reception, id_customer, nama_customer, no_nota, no_so, berat, jenis, express, total_bayar, diskon, cabang)
                    VALUES (:outlet, :datenow, :userId, :customerId, :customer, :orderNumber, :orderNumber, :isWeight, :isType, :express, :total, :discount, :branch)";
        $this->conn->query($query);
        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('datenow', $data['datenow']);
        $this->conn->bind('userId', $data['user']);
        $this->conn->bind('customerId', $data['customer_id']);
        $this->conn->bind('customer', $data['customer']);
        $this->conn->bind('orderNumber', $data['order_number']);
        $this->conn->bind('isWeight', $data['is_weight']);
        $this->conn->bind('isType', $data['is_type']);
        $this->conn->bind('express', $data['express']);
        $this->conn->bind('total', $data['total']);
        $this->conn->bind('discount', $data['discount']);
        $this->conn->bind('branch', $data['branch']);
        $this->conn->execute();

        if ($this->conn->rowCount() > 0) {

            $detail = new SalesOrderDetail;
            return $detail->insert($dataPost, $data['datenow'], $data['order_number']);
        }
    }

    public function saveOrderItem($data, $datenow, $customerId)
    {
        $query = "INSERT INTO detail_penjualan (tgl_transaksi, item, harga, jumlah, total, no_nota, id_customer, berat, keterangan)
                    VALUES (:datenow, :item, :price, :quantity, :total, :no_order, :customerId, :isWeight, :category)";
        $this->conn->query($query);

        foreach ($data->data as $val) {
            $this->conn->bind('datenow', $datenow);
            $this->conn->bind('item', $val->item);
            $this->conn->bind('price', $val->price);
            $this->conn->bind('quantity', $val->qty);
            $this->conn->bind('total', $val->amount);
            $this->conn->bind('no_order', $data->order_number);
            $this->conn->bind('customerId', $customerId);
            $this->conn->bind('isWeight', $val->weight);
            $this->conn->bind('category', $val->category);
            $this->conn->execute();
            $this->count += $this->conn->rowCount();    
        }

        return $this->count;
    }

    public function getOrderInvoice($customerId, $outlet) 
    {
        $query = "SELECT no_nota AS orderNumber, total_bayar AS total FROM $this->table WHERE lunas = false AND nama_outlet = :outlet AND id_customer = :customerId";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        $this->conn->bind('customerId', $customerId);

        $data = $this->conn->all();

        $detail = new SalesOrderDetail;

        foreach ($data as $key => $value) {
            $data[$key]['items'] = $detail->getOrderItem($value['orderNumber']);
        }

        return $data;
    }

    public function getOrdersCreated($customerId, $outlet) 
    {
        $query = "SELECT no_nota AS orderNumber, total_bayar AS total FROM $this->table WHERE lunas = false AND nama_outlet = :outlet AND id_customer = :customerId";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        $this->conn->bind('customerId', $customerId);
        return $this->conn->all();
    }

    public function getOrderItems($orderNumber)
    {
        $query = "SELECT item, jumlah AS quantity, berat AS isweight, keterangan AS category, total FROM detail_penjualan WHERE no_nota = :order_number";
        $this->conn->query($query);
        $this->conn->bind('order_number', $orderNumber);
        return $this->conn->all();
    }

    public function deleteOrder($orderNumber)
    {
        $query = "DELETE FROM $this->table WHERE no_nota = :orderNumber";        
        $this->conn->query($query);
        $this->conn->bind('orderNumber', $orderNumber);
        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function deleteOrderItems($orderNumber)
    {
        $query = "DELETE FROM detail_penjualan WHERE no_nota = :orderNumber";
        $this->conn->query($query);
        $this->conn->bind('orderNumber', $orderNumber);
        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function OrderByDate($request)
    {
        $query = "SELECT * FROM $this->table WHERE nama_outlet = :outlet AND DATE(tgl_input) BETWEEN :start_at AND :end_at ORDER BY tgl_input ASC";
        $this->conn->query($query);
        $this->conn->bind('outlet', $request['outlet']);
        $this->conn->bind('start_at', $request['start_at']);
        $this->conn->bind('end_at', $request['end_at']);
        return $this->conn->all();
    }

    public function updateOrderPayOff($data)
    {
        $query = "UPDATE $this->table SET lunas = :pay_off, cara_bayar = :payment_method, no_faktur = :invoice_number WHERE no_nota = :order_number";
        $this->conn->query($query);
        foreach ($data->data_order as $val) {
            $this->conn->bind('pay_off', 1);
            $this->conn->bind('payment_method', $data->method);
            $this->conn->bind('order_number', $val->number);
            $this->conn->bind('invoice_number', $data->number);
            $this->conn->execute();
            $this->count += $this->conn->rowCount(); 
        }
        return $this->count;
    }

    public function getOrderByInvoice($invoiceNumber)
    {
        $query = "SELECT no_nota AS order_number, total_bayar AS total FROM $this->table WHERE no_faktur = :invoice_number";
        $this->conn->query($query);
        $this->conn->bind('invoice_number', $invoiceNumber);
        return $this->conn->all();
    }

    public function getLaundryAlready($customerId)
    {
        $query = "SELECT id AS id, no_nota AS order_number, jumlah AS quantity, DATE(tgl_input) AS order_date, nama_outlet AS outlet, IF(jenis = 'k', 'Kiloan', 'Potongan') AS order_type FROM $this->table WHERE id_customer = :customerId AND lunas = true AND packing = true AND ambil = false";
        $this->conn->query($query);
        $this->conn->bind('customerId', $customerId);
        $result = $this->conn->all();

        $detail = new SalesOrderDetail;
        foreach ($result as $key => $value) {
            $result[$key]['detail'] = $detail->getOrderItem($value['order_number']);
        }

        return $result;
    }

    /**
     * Mendapatkan nota cucian yang akan dicheckout dari outlet
     * Ini digunakan sementara sampai tabel bs_laundry_trackers menerima inputan dari spk cucian
     */

    public function getOrderToCheckOutOutlet($outlet)
    {
        $tracker = 'bs_laundry_trackers';
        $query = "SELECT a.id AS sales_order_id, a.no_nota AS sales_order, a.spk AS spk FROM $this->table AS a LEFT JOIN $tracker AS b ON a.id = b.sales_order_id WHERE b.sales_order_id IS NULL AND a.nama_outlet = :outlet AND (cara_bayar <> 'Void' AND cara_bayar <> 'Reject') AND a.packing = :packing AND a.kembali = :kembali AND DATE(a.tgl_input) >= DATE(NOW()) - INTERVAL 7 DAY";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        $this->conn->bind('packing', false);
        $this->conn->bind('kembali', false);
        return $this->conn->all();
    }

    public function getOrderToCheckInOutlet($outlet)
    {
        $query = "SELECT id, no_nota AS sales_order, packing FROM $this->table WHERE nama_outlet = :outlet AND (cara_bayar <> 'Void' AND cara_bayar <> 'Reject') AND cuci = :cuci AND kembali = :kembali AND DATE(tgl_input) >= DATE(NOW()) - INTERVAL 7 DAY";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        $this->conn->bind('cuci', true);
        $this->conn->bind('kembali', false);
        return $this->conn->all();
    }

    public function updateWorkshop($data)
    {
        $query = "UPDATE $this->table SET workshop = :workshop, tgl_workshop = :date, op_workshop = :op_workshop WHERE id = :id";
        $this->conn->query($query);

        $count = 0;
        foreach ($data->list as $val) {
            $this->conn->bind('workshop', $data->workshop_name);
            $this->conn->bind('date', $data->today);
            $this->conn->bind('op_workshop', $data->user_name);
            $this->conn->bind('id', $val->sales_id);

            $this->conn->execute();
            
            $count += $this->conn->rowCount();
        }
        
        return $count;
    }

    public function updateOpr($data, $objectField)
    {
        $query = "UPDATE $this->table SET $objectField->operation = :operation, $objectField->field_date = :date, $objectField->field_user = :user WHERE id = :id";
        $this->conn->query($query);

        $count = 0;
        foreach ($data as $val) {
            $this->conn->bind('operation', 1);
            $this->conn->bind('date', $objectField->date);
            $this->conn->bind('user', $objectField->user);
            $this->conn->bind('id', $val->id);

            $this->conn->execute();
            
            $count += $this->conn->rowCount();
        }
        
        return $count;
    }

    public function getOrderByFaktur($faktur)
    {
        $query = "SELECT no_nota AS orderNumber, total_bayar AS totalOrder, nama_reception AS userOrder, nama_outlet AS outletOrder FROM $this->table WHERE no_faktur = :faktur";
        $this->conn->query($query);
        $this->conn->bind('faktur', $faktur);
        return $this->conn->all();
    }

    public function updatePayment($order, $status)
    {
        $query = "UPDATE $this->table SET cara_bayar = :status WHERE no_nota = :order_number";
        $this->conn->query($query);
        $this->conn->bind('status', $status);
        $this->conn->bind('order_number', $order);
        $this->conn->execute();

        return $this->conn->rowCount();
    }
    
}