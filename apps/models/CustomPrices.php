<?php 

class CustomPrices {
    private $table = 'custom_prices';
    private $count = 0;
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function lists($priceId)
    {
        $query = "SELECT minimal_quantity AS minqty, price AS price FROM $this->table WHERE active = true AND bs_adjustment_price_id = :price_id";
        $this->conn->query($query);
        $this->conn->bind('price_id', $priceId);
        $this->conn->all();
    }

    public function getDataByPriceId($priceId)
    {
        $query = "SELECT id AS custom_id, bs_adjustment_price_id AS id, price, minimal_quantity AS minqty FROM $this->table WHERE bs_adjustment_price_id = :price_id";
        $this->conn->query($query);
        $this->conn->bind('price_id', $priceId);

        return $this->conn->all();
    }

    public function insert($data)
    {
        $query = "INSERT INTO $this->table (bs_adjustment_price_id, minimal_quantity, price, active) VALUES (:id, :minqty, :price, :active)";
        $this->conn->query($query);

        foreach($data->data as $val) {
            $this->conn->bind('id', $data->id);
            $this->conn->bind('minqty', $val->minqty);
            $this->conn->bind('price', $val->price);
            $this->conn->bind('active', $data->active);
    
            $this->conn->execute();
            $this->count += $this->conn->rowCount();
        }
        return $this->count;
    }

    public function update($data)
    {
        $query = "UPDATE $this->table SET minimal_quantity = :minqty, price = :price, active = :active WHERE id = :id";
        $this->conn->query($query);

        foreach ($data->data as $val) {
            $this->conn->bind('minqty', $val->minqty);
            $this->conn->bind('price', $val->price);
            $this->conn->bind('active', $data->active);
            $this->conn->bind('id', $val->id);

            $this->conn->execute();
            $this->count += $this->conn->rowCount();
        }

        return $this->count;
    }

}