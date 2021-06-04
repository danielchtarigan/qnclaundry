<?php
include_once 'models/SalesOrder.php';
include_once 'models/SalesInvoice.php';

class OrderVoid {
    private $table = 'bs_order_void';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getItems($data)
    {
        $query = "SELECT * FROM $this->table WHERE DATE(created_at) BETWEEN :startDate AND :endDate";
        $this->conn->query($query);
        $this->conn->bind('startDate', $data->startDate);
        $this->conn->bind('endDate', $data->endDate);
        return $this->conn->all();
    }

    public function insert($data)
    {
        $query = "INSERT INTO $this->table (no_order, total_order, user_order, faktur, status, memo, created_by, updated_by) VALUES (:orderNumber, :totalOrder, :userOrder, :faktur, :status, :memo, :created_by, :updated_by)";
        $this->conn->query($query);
        $this->conn->bind('orderNumber', $data->order_number);
        $this->conn->bind('totalOrder', $data->total_order);
        $this->conn->bind('userOrder', $data->user_order);
        $this->conn->bind('faktur', $data->faktur);
        $this->conn->bind('status', $data->status);
        $this->conn->bind('memo', $data->memo);
        $this->conn->bind('created_by', $data->user);
        $this->conn->bind('updated_by', $data->user);

        $this->conn->execute();

        $result = $this->conn->rowCount();

        if ($result) {
            $sales = new SalesOrder;

            $updateOrder = $sales->updatePayment($data->order_number, ucfirst($data->status));

            if ($updateOrder) {
                $payment = new SalesInvoice;
                return $payment->updatePayment($data);
            }
        }
    }

    public function update($data, $orderNumber)
    {
        $query = "UPDATE $this->table SET status = :status, memo = :memo, updated_by = :updated_by WHERE no_order = :order_number";
        $this->conn->query($query);
        $this->conn->bind('status', $data->status);
        $this->conn->bind('memo', $data->memo);
        $this->conn->bind('updated_by', $data->user);
        $this->conn->bind('order_number', $orderNumber);

        $this->conn->execute();

        $result = $this->conn->rowCount();

        if ($result) {
            $sales = new SalesOrder;

            return $sales->updatePayment($orderNumber, ucfirst($data->status));
        }
    }

}