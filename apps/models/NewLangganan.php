<?php 

class NewLangganan {
    private $table = 'bs_langganan';
    private $conn;
    private $count = 0;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function cekLanggananCustomer($id, $branch)
    {
        $outlet = 'outlet';
        $query = "SELECT a.kiloan, a.potongan, a.valid_date, b.Kota AS branch FROM $this->table AS A LEFT JOIN $outlet AS B ON a.outlet_id = b.id_outlet WHERE a.customer_id = :customer_id AND b.Kota = :branch";
        $this->conn->query($query);
        $this->conn->bind('customer_id', $id);
        $this->conn->bind('branch', $branch);
        return $this->conn->all();
    }

    public function getKuota($customerId, $outletId)
    {
        $query = "SELECT kiloan, potongan, valid_date AS expire FROM $this->table WHERE customer_id = :customer_id AND outlet_id = :outlet_id ORDER BY id LIMIT 0,1";
        $this->conn->query($query);
        $this->conn->bind('customer_id', $customerId);
        $this->conn->bind('outlet_id', $outletId);
        return $this->conn->single();
    }

    public function updateQuota($data)
    {
        $query = "UPDATE $this->table SET kiloan = :kilos WHERE customer_id = :customer_id AND outlet_id = :outlet_id";
        $this->conn->query($query);
        foreach ($data->data_kuota as $val) {
            $this->conn->bind('kilos', $val->kilo);
            $this->conn->bind('customer_id', $data->customer_id);
            $this->conn->bind('outlet_id', $data['outlet_id']);
            $this->conn->execute();
            $this->count += $this->conn->rowCount();
        }
        return $this->count;
    }

    public function updateQuotaNow($data)
    {
        $query = "UPDATE $this->table SET kiloan = :kiloan, valid_date = DATE_ADD(CURDATE(), INTERVAL :valid DAY) WHERE customer_id = :customer_id AND outlet_id = :outlet_id";
        $this->conn->query($query);
        $this->conn->bind('kiloan', $data['data']['kiloan']);
        $this->conn->bind('customer_id', $data['customer_id']);
        $this->conn->bind('valid', $data['data']['days']);
        $this->conn->bind('outlet_id', $data['outlet_id']);
        $this->conn->execute();

        return $this->conn->rowCount();
    }

    public function insertQuotaNow($data)
    {
        $query = "INSERT INTO $this->table (since_date, customer_id, kiloan, valid_date, outlet_id) VALUES (:nowdate,  :customer_id, :kiloan, DATE_ADD(CURDATE(), INTERVAL :valid DAY), :outlet_id)";
        $this->conn->query($query);

        $this->conn->bind('nowdate', $data['data']['nowdate']);
        $this->conn->bind('customer_id', $data['customer_id']);
        $this->conn->bind('kiloan', $data['data']['kiloan']);
        $this->conn->bind('valid', $data['data']['days']);
        $this->conn->bind('outlet_id', $data['outlet_id']);

        $this->conn->execute();
        return $this->conn->rowCount();
    }

}