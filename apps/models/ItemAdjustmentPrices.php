<?php 

class ItemAdjustmentPrices {
    private $table = 'bs_adjustment_prices';
    private $conn;
    private $count = 0;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function lists($data)
    {
        $query = "SELECT b.id AS id, a.price AS price, b.name AS item, c.name AS category, c.type AS type FROM $this->table a LEFT JOIN bs_items b ON a.bs_item_id = b.id 
                    LEFT JOIN bs_item_categories c ON b.bs_item_category_id = c.id WHERE branch_id = :branch_id AND outlet_id = :outlet_id ORDER BY a.id ASC";
        $this->conn->query($query);
        $this->conn->bind('branch_id', $data->branch);
        $this->conn->bind('outlet_id', $data->outlet);
        return $this->conn->all();
    }

    public function insertCopy($data)
    {
        $query = "INSERT INTO $this->table (price, bs_item_id, outlet_id, branch_id, created_by, updated_by) VALUES (:price, :bs_item_id, :outlet_id, :branch_id, :created_by, :updated_by)";
        $this->conn->query($query);
        foreach ($data->data as $val) {
            $this->conn->bind('price', $val->price);
            $this->conn->bind('bs_item_id', $val->item_id);
            $this->conn->bind('outlet_id', $data->outlet_id);
            $this->conn->bind('branch_id', $data->branch_id);
            $this->conn->bind('created_by', $data->user_id);
            $this->conn->bind('updated_by', $data->user_id);
            $this->conn->execute();
            $this->count += $this->conn->rowCount(); 
        }
        return $this->count;
    }
}