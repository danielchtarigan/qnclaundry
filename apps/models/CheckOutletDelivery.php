<?php

include_once 'models/CheckOutletDeliveryDetail.php';

class CheckOutletDelivery {
    private $table = 'bs_check_outlet_deliveries';
    private $conn;

    public function __construct() 
    {
        $this->conn = new Database;
    }

    public function getLastCode($data)
    {
        $query = "SELECT check_outlet_delivery_code AS code FROM $this->table WHERE outlet_id = :outlet_id AND type = :type ORDER BY id DESC LIMIT 0,1";
        $this->conn->query($query);

        $this->conn->bind('outlet_id', $data->outlet_id);
        $this->conn->bind('type', $data->check_type);
        return $this->conn->single();
    }

    public function insert($data)
    {
        $query = "INSERT INTO $this->table (check_outlet_delivery_code, outlet_id, type, count, delivery_id, user_id) VALUES (:code, :outlet_id, :type, :count, :delivery_id, :user_id)";
        $this->conn->query($query);

        $this->conn->bind('code', $data->code);
        $this->conn->bind('outlet_id', $data->outlet_id);
        $this->conn->bind('type', $data->check_type);
        $this->conn->bind('count', $data->count);
        $this->conn->bind('delivery_id', $data->delivery_id);
        $this->conn->bind('user_id', $data->user_id);
        $this->conn->execute();

        if ($this->conn->rowCount() > 0) {
            $lastId = $this->conn->lastId();

            $detail = new CheckOutletDeliveryDetail;
            return $detail->insert($data, $lastId);
        }        
    }

    public function getList($data)
    {
        $driver = 'user_driver';
        $user = 'user';
        $query = "SELECT a.id AS id, a.created_at AS date, a.count AS count, a.check_outlet_delivery_code AS code, b.name AS driver, c.name AS kasir FROM $this->table AS a LEFT JOIN $driver AS b ON a.delivery_id = b.id LEFT JOIN $user AS c ON a.user_id = c.user_id WHERE a.outlet_id = :outlet_id AND a.type = :type AND DATE(a.created_at) BETWEEN :startDate AND :endDate";
        $this->conn->query($query);

        $this->conn->bind('outlet_id', $data->outlet_id);
        $this->conn->bind('type', $data->type);
        $this->conn->bind('startDate', $data->startDate);
        $this->conn->bind('endDate', $data->endDate);

        return $this->conn->all();
    }
}