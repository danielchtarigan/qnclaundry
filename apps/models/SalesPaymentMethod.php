<?php

class SalesPaymentMethod {
    private $table = 'cara_bayar';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function insert($data)
    {
        $query = "INSERT INTO $this->table (no_faktur, cara_bayar, jumlah, resepsionis, outlet, tanggal_input)
                VALUES (:invoice_number, :payment_method, :value_payment, :user, :outlet, :nowdate)";
        $this->conn->query($query);

        $count = 0;
        foreach ($data->data as $val) {
            $this->conn->bind('invoice_number', $data->number);
            $this->conn->bind('payment_method', $val->method);
            $this->conn->bind('value_payment', $val->value);
            $this->conn->bind('user', $data->user);
            $this->conn->bind('outlet', $data->outlet);
            $this->conn->bind('nowdate', $data->nowdate);
            $this->conn->execute();
            $count += $this->conn->rowCount();  
        }

        return $count;
    }

    public function insertNewMethod($data)
    {
        $query = "INSERT INTO $this->table (no_faktur, cara_bayar, jumlah, resepsionis, outlet, tanggal_input)
                VALUES (:invoice_number, :payment_method, :value_payment, :user, :outlet, :nowdate)";
        $this->conn->query($query);

        $count = 0;
        $this->conn->bind('invoice_number', $data->faktur);
        $this->conn->bind('payment_method', $data->status);
        $this->conn->bind('value_payment', $data->total_order);
        $this->conn->bind('user', $data->user_order);
        $this->conn->bind('outlet', $data->outlet_order);
        $this->conn->bind('nowdate', $data->to_date);
        $this->conn->execute();
        $count += $this->conn->rowCount();  

        return $count;
    }
}