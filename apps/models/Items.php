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
        $this->conn->query("SELECT a.name AS name, a.price AS price, b.name AS category FROM $this->table a LEFT JOIN bs_item_categories b ON a.bs_item_category_id = b.id");
        return $this->conn->all();
    }

    public function getItems()
    {
        $this->conn->query("SELECT a.name AS name, a.price AS price, b.id AS category_id, b.name AS category, b.type AS type FROM $this->table a LEFT JOIN bs_item_categories b ON a.bs_item_category_id = b.id");
        return $this->conn->all();
    }

    public function insert($data)
    {
        $query = "INSERT INTO $this->table (name, price, unit, bs_item_category_id, created_by, updated_by) VALUES (:name, :price, :unit, :category_id, :created_by, :updated_by)";
        $this->conn->query($query);
        $this->conn->bind('name', $data->name);
        $this->conn->bind('price', $data->price);
        $this->conn->bind('unit', $data->unit);
        $this->conn->bind('category_id', $data->category_id);
        $this->conn->bind('created_by', $data->user_id);
        $this->conn->bind('updated_by', $data->user_id);
        $this->conn->execute();

        return $this->conn->rowCount();
    }

    public function insertAdjustmentPrice($data)
    {
        if ($this->insert($data) > 0) {
            $bs_item_id = $this->conn->lastId();
            $query = "INSERT INTO bs_adjustment_prices (price, bs_item_id, outlet_id, branch_id, created_by, updated_by) VALUES (:price, :bs_item_id, :outlet_id, :branch_id, :created_by, :updated_by)";
            $this->conn->query($query);
            $this->conn->bind('price', $data->price);
            $this->conn->bind('bs_item_id', $bs_item_id);
            $this->conn->bind('outlet_id', $data->outlet_id);
            $this->conn->bind('branch_id', $data->branch_id);
            $this->conn->bind('created_by', $data->user_id);
            $this->conn->bind('updated_by', $data->user_id);
            $this->conn->execute();
    
            return $this->conn->rowCount();
        }
    }

    public function update($data)
    {
        $query = "UPDATE $this->table SET name = :name, unit = :unit, updated_by = :updated_by WHERE id = :id";
        $this->conn->query($query);
        $this->conn->bind('name', $data->name);
        $this->conn->bind('unit', $data->unit);
        $this->conn->bind('updated_by', $data->user_id);
        $this->conn->bind('id', $data->goods_id);
        $this->conn->execute();

        return $this->conn->rowCount();
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