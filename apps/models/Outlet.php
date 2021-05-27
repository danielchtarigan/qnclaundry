<?php 
include_once 'models/Workshop.php';
include_once 'models/MachineCapacities.php';

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
        $result = $this->conn->single();
    }

    public function getOutletById($outlet)
    {
        $query = "SELECT nama_outlet AS outlet, alamat AS address, no_telp AS telpon, Kota AS branch FROM $this->table WHERE id_outlet = :outlet";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        $result = $this->conn->single();

        $wk = new Workshop;
        $result['workshop'] = $wk->outletWorkshop($outlet);

        $caps = new MachineCapacities;
        $result['workshop']['capacity'] = $caps->getCapacity($result['workshop']['id'])['linen'];
        return $result;
    }

    function workshopOutlet($outlet)
    {
        $table = 'outlet_workshop';
        $query = "SELECT * FROM $table WHERE outlet_id = $outlet";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        return $this->conn->single();
    }

    public function getOutlets()
    {
        $query = "SELECT id_outlet, nama_outlet, alamat, Kota As cabang, no_telp AS telpon, active AS status FROM outlet";
        $this->conn->query($query);
        $result = $this->conn->all();

        $wk = new Workshop;

        foreach ($result as $key => $value) {
            $result[$key]['workshop'] = $wk->outletWorkshop($value['id_outlet']);
        }

        return $result;
    }

    public function getOutletsByBranch($branch)
    {
        $query = "SELECT id_outlet, nama_outlet, alamat, Kota As cabang, no_telp AS telpon, active AS status FROM $this->table WHERE Kota = :branch ";
        $this->conn->query($query);
        $this->conn->bind('branch', $branch);
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
        $result = $this->conn->rowCount();
        
        if ($result) {
            $lastId = $this->conn->lastId();
            return $this->insertToOutletWorkshop($lastId, $data->workshopId);
        }
    }

    public function insertToOutletWorkshop($outlet, $workshop)
    {
        $table = 'outlet_workshop';
        $query = "INSERT INTO $table (workshop_id, outlet_id) 
                VALUES (:workshop, :outlet)";
        $this->conn->query($query);
        $this->conn->bind('workshop', $workshop);
        $this->conn->bind('outlet', $outlet);
        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function updateToOutletWorkshop($outlet, $workshop)
    {
        $table = 'outlet_workshop';
        $query = "UPDATE $table SET workshop_id = :workshop WHERE outlet_id = :outlet";
        $this->conn->query($query);
        $this->conn->bind('workshop', $workshop);
        $this->conn->bind('outlet', $outlet);
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
        $result = $this->conn->rowCount();

        if ($result) {
            return $this->updateToOutletWorkshop($outletId, $data->workshopId);
        }
    }

    public function updateOutletCode($data)
    {
        if ($this->insertOutlet($data) > 0) {
            $id = $this->conn->lastId();
            $code = sprintf('%03s', $id);

            $query = "UPDATE $this->table SET kode = :code WHERE id_outlet = :outletId";
            $this->conn->query($query);
            $this->conn->bind('code', $code);
            $this->conn->bind('outletId', $id);

            $this->conn->execute();
            return $id;
        }
    }

    public function insertOldRulePrice($id)
    {
        $query = "INSERT INTO outlet_harga (id_outlet, ket_harga, level_harga) VALUES (:id, :desc, :level)";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        $this->conn->bind('desc', 1);
        $this->conn->bind('level', 1);
        $this->conn->execute();

        return $this->conn->rowCount();
    }
}