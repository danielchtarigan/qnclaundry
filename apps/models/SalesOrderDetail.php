<?php 

class SalesOrderDetail {
    private $table = 'detail_penjualan';
    private $conn;
    private $count = 0;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function insert($data, $datenow, $number)
    {
        $query = "INSERT INTO $this->table (tgl_transaksi, item, harga, jumlah, total, no_nota, id_customer, berat, keterangan)
                    VALUES (:datenow, :item, :price, :quantity, :total, :no_order, :customerId, :isWeight, :category)";
        $this->conn->query($query);

        if (isset($data->items)) {
            foreach ($data->items as $val) {
                $this->conn->bind('datenow', $datenow);
                $this->conn->bind('item', ucwords(str_replace("_", " ", $val->name)));
                $this->conn->bind('price', $val->price);
                $this->conn->bind('quantity', ($val->category === "Kiloan") ? 1 : $val->quantity);
                $this->conn->bind('total', ($val->custom > 0) ? $val->price : $val->price * $val->quantity);
                $this->conn->bind('no_order', $number);
                $this->conn->bind('customerId', $data->customer_id);
                $this->conn->bind('isWeight', $val->quantity);
                $this->conn->bind('category', $val->category);
                $this->conn->execute();
                $this->count += $this->conn->rowCount();    
            }
        }
        if (isset($data->extras)) {
            foreach ($data->extras as $val) {
                $this->conn->bind('datenow', $datenow);
                $this->conn->bind('item', $val->name);
                $this->conn->bind('price', $val->price);
                $this->conn->bind('quantity', $val->quantity);
                $this->conn->bind('total', $val->price * $val->quantity);
                $this->conn->bind('no_order', $number);
                $this->conn->bind('customerId', $data->customer_id);
                $this->conn->bind('isWeight', 0);
                $this->conn->bind('category', $val->category);
                $this->conn->execute();
                $this->count += $this->conn->rowCount();    
            }
        }
        if (isset($data->express)) {
            foreach ($data->express as $val) {
                $this->conn->bind('datenow', $datenow);
                $this->conn->bind('item', $val->name);
                $this->conn->bind('price', $val->price);
                $this->conn->bind('quantity', $val->quantity);
                $this->conn->bind('total', $val->price * $val->quantity);
                $this->conn->bind('no_order', $number);
                $this->conn->bind('customerId', $data->customer_id);
                $this->conn->bind('isWeight', 0);
                $this->conn->bind('category', $val->category);
                $this->conn->execute();
                $this->count += $this->conn->rowCount();  
            }
        }
        if (isset($data->discounts)) {
            foreach ($data->discounts as $val) {
                $this->conn->bind('datenow', $datenow);
                $this->conn->bind('item', $val->name);
                $this->conn->bind('price', $val->price * -1);
                $this->conn->bind('quantity', $val->quantity);
                $this->conn->bind('total', $val->price * $val->quantity * -1);
                $this->conn->bind('no_order', $number);
                $this->conn->bind('customerId', $data->customer_id);
                $this->conn->bind('isWeight', 0);
                $this->conn->bind('category', $val->category);
                $this->conn->execute();
                $this->count += $this->conn->rowCount();  
            }
        }
        if (isset($data->membership)) {
            $this->conn->bind('datenow', $datenow);
            $this->conn->bind('item', "Diskon Membership");
            $this->conn->bind('price', $data->membership * -1);
            $this->conn->bind('quantity', 1);
            $this->conn->bind('total', $data->membership * -1);
            $this->conn->bind('no_order', $number);
            $this->conn->bind('customerId', $data->customer_id);
            $this->conn->bind('isWeight', 0);
            $this->conn->bind('category', "Discount");
            $this->conn->execute();
            $this->count += $this->conn->rowCount();  
        }

        return $this->count;        
    }

    public function getOrderItem($orderNumber)
    {
        $query = "SELECT item, jumlah AS quantity, berat AS isweight, keterangan AS category, total FROM $this->table WHERE no_nota = :order_number";
        $this->conn->query($query);
        $this->conn->bind('order_number', $orderNumber);
        return $this->conn->all();
    }

    
}