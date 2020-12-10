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
}