<?php 

class Outlet {
    private $table = "outlet";
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getOutletId($outlet)
    {
        $this->conn->query("SELECT id_outlet AS id FROM $this->table WHERE nama_outlet = :outlet");
        $this->conn->bind('outlet', $outlet);
        return $this->conn->single();
    }

    public function getCodeOutlet($outlet)
    {
        $query = "SELECT b.id AS branchId, a.id_outlet AS outletId FROM $this->table AS a INNER JOIN cabang AS b on a.Kota = b.cabang
                    WHERE nama_outlet = :outlet";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        return $this->conn->single();
    }

    public function getOutletByName($outlet)
    {
        $query = "SELECT nama_outlet AS outlet, alamat AS address, no_telp AS telpon, Kota AS branch FROM $this->table WHERE nama_outlet = :outlet";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        return $this->conn->single();
    }

    public function getOutlets()
    {
        $query = "SELECT id_outlet, nama_outlet, alamat, Kota As cabang, no_telp AS telpon, active AS status FROM outlet";
        $this->conn->query($query);
        return $this->conn->all();
    }

    public function insertOutlet($data)
    {
        $query = "INSERT INTO $this->table (nama_outlet, alamat, Kota, no_telp, active) 
                    VALUES (:name, :address, :branch, :telp, :active)";
        $this->conn->query($query);
        $this->conn->bind('name', $data->name);
        $this->conn->bind('address', $data->address);
        $this->conn->bind('branch', $data->branch);
        $this->conn->bind('telp', $data->telp);
        $this->conn->bind('active', $data->active);

        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function updateOutlet($data, $outletId)
    {
        $query = "UPDATE $this->table SET nama_outlet = :name, alamat = :address, Kota = :branch, no_telp = :telp, active = :active WHERE id_outlet = :outletId";
        $this->conn->query($query);
        $this->conn->bind('name', $data->name);
        $this->conn->bind('address', $data->address);
        $this->conn->bind('branch', $data->branch);
        $this->conn->bind('telp', $data->telp);
        $this->conn->bind('active', $data->active);
        $this->conn->bind('outletId', $outletId);

        $this->conn->execute();
        return $this->conn->rowCount();
    }
}