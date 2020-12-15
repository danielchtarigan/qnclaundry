<?php 

class Items {
    private $table = "bs_items";
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function get_items($data)
    {
        $this->conn->query("SELECT a.name AS name, a.price AS price, b.name AS category FROM $this->table a LEFT JOIN bs_item_categories b ON a.item_category_id = b.id");
        return $this->conn->all();
    }

    public function checkOutletInItem($outletId)
    {
        $this->conn->query("SELECT * FROM bs_adjustment_prices WHERE outlet_id = :outlet_id");
        $this->conn->bind('outlet_id', $outletId);
        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function checkBranchInItem($branchId)
    {
        $this->conn->query("SELECT * FROM bs_adjustment_prices WHERE branch_id = :branch_id");
        $this->conn->bind('branch_id', $branchId);
        $this->conn->execute();
        return $this->conn->rowCount();
    }    

    public function getItemPriceDefault()
    {
        $this->conn->query("SELECT b.type AS type, b.name AS category, a.name AS item, price
                FROM $this->table AS a
                LEFT JOIN bs_item_categories AS b ON a.bs_item_category_id = b.id");
        return $this->conn->all();
    }

    public function getItemPriceByBranch($branch)
    {
        $this->conn->query("SELECT c.type AS type, c.name AS category, b.name AS item, a.price 
            FROM bs_adjustment_prices AS a 
            LEFT JOIN $this->table AS b ON a.bs_item_id = b.id 
            LEFT JOIN bs_item_categories AS c ON b.bs_item_category_id = c.id 
            WHERE a.branch_id = :branch");

        $this->conn->bind('branch', $branch);
        return $this->conn->all();
    }

    public function getItemPriceByOutlet($branch, $outlet)
    {
        $this->conn->query("SELECT c.type AS type, c.name AS category, b.name AS item, a.price 
            FROM bs_adjustment_prices AS a 
            LEFT JOIN $this->table AS b ON a.bs_item_id = b.id 
            LEFT JOIN bs_item_categories AS c ON b.bs_item_category_id = c.id 
            WHERE a.branch_id = :branch AND a.outlet_id = :outlet");

        $this->conn->bind('branch', $branch);
        $this->conn->bind('outlet', $outlet);
        return $this->conn->all();
    }

}