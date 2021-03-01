<?php
include_once 'models/LaundryTracker.php';

class CheckWorkshopDeliveryDetail {
    private $table = 'bs_check_workshop_delivery_details';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function insert($data, $checkId)
    {
        $query = "INSERT INTO $this->table (sales_id, bs_check_workshop_delivery_id) VALUES (:sales_id, :check_id)";
        $this->conn->query($query);

        $countInsert = 0;
        foreach ($data->list as $val) {
            $this->conn->bind('sales_id', $val->sales_id);
            $this->conn->bind('check_id', $checkId);

            $this->conn->execute();
            $countInsert += $this->conn->rowCount();
        }

        if ($countInsert > 0) {
            $tracker = new LaundryTracker;
            $tracker->update($data->field_tracker, $data->list);
        }

        return $countInsert;
    }
}