<?php 

class Items {
    private $table = "bs_items";
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function get_items()
    {
        $this->conn->query("SELECT a.name AS name, a.price AS price, b.name AS category FROM $this->table a LEFT JOIN bs_item_categories b ON a.item_category_id = b.id");
        return $this->conn->all();
    }
}