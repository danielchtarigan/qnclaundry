<?php 

class Workshop {
    private $table = "workshop";
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getWorkshops()
    {
        $branch = "cabang";
        $query = "SELECT a.id_workshop AS id, a.workshop AS workshop, b.id AS branch_id, b.cabang AS branch, a.alamat AS address, a.active AS status, a.kode AS code 
                    FROM $this->table a LEFT JOIN $branch b ON a.id_cabang = b.id";
        $this->conn->query($query);
        return $this->conn->all();
    }

    public function insertWorkshop($data)
    {
        $query = "INSERT INTO $this->table (id_cabang, workshop, alamat, active) 
                    VALUES (:branch_id, :name, :address, :active)";
        $this->conn->query($query);
        $this->conn->bind('branch_id', $data->branch_id);
        $this->conn->bind('name', $data->name);
        $this->conn->bind('address', $data->address);
        $this->conn->bind('active', $data->active);

        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function updateWorkshop($data, $workshopId)
    {
        $query = "UPDATE $this->table SET id_cabang = :branch_id, workshop = :name, alamat = :address, active = :active WHERE id_workshop = :workshopId";
        $this->conn->query($query);
        $this->conn->bind('branch_id', $data->branch_id);
        $this->conn->bind('name', $data->name);
        $this->conn->bind('address', $data->address);
        $this->conn->bind('active', $data->active);
        $this->conn->bind('workshopId', $workshopId);     

        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function updateWorkshopCode($data)
    {
        if ($this->insertWorkshop($data) > 0) {
            $id = $this->conn->lastId();
            $code = sprintf('%03s', $id);
            $query = "UPDATE $this->table SET kode = :code WHERE id_workshop = :id";
            $this->conn->query($query);
            $this->conn->bind('code', $code);
            $this->conn->bind('id', $id);
            $this->conn->execute();
            return $this->conn->rowCount();
        }
    }
}