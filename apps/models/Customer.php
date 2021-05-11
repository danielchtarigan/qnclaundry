<?php 

include_once 'models/NewLangganan.php';
include_once 'models/Membership.php';

class Customer {
    private $table = 'customer';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    //Berlaku di new.qnclaundry.com
    public function getCustomer($data) {
        $query = "SELECT id AS id, nama_customer AS name, alamat AS address, no_telp AS telp, member, poin
                    FROM $this->table WHERE no_telp LIKE '08%' AND LENGTH(no_telp) > 10 ORDER BY nama_customer ASC";
        $this->conn->query($query);
        $result = $this->conn->all();

        $lgn = new NewLangganan;
        $mbr = new Membership;
        foreach ($result as $key => $value) {
            $result[$key]['lgn'] = $lgn->cekLanggananCustomer($value['id'], $data['branch']);
            if (count($result[$key]['lgn']) > 0) {
                $result[$key]['status'] = "Langganan";
            } else {
                if ($value['member'] == 1) {
                    $result[$key]['status'] = "Membership";
                } else {
                    $result[$key]['status'] = "Reguler";
                }
            }
        }

        return $result;
    }

    public function getCustomerById($id)
    {
        $query = "SELECT nama_customer AS name FROM $this->table WHERE id = :id";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        return $this->conn->single();
    }

    public function addCustomer($data) {
        $query = "INSERT INTO $this->table ( nama_customer, no_telp, alamat, kota, tgl_input, outlet, user_input ) 
                    VALUES (:name, :telp, :address, :branch, :dateInput, :outlet, :userId)";
        $this->conn->query($query);
        $this->conn->bind('telp', $data['telp']);
        $this->conn->bind('name', $data['name']);
        $this->conn->bind('address', $data['address']);
        $this->conn->bind('branch', $data['branch']);
        $this->conn->bind('dateInput', $data['dateInput']);
        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('userId', $data['userId']);
        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function getCustomerByOrder($data) {
        $query = "SELECT * FROM $this->table WHERE kota = :branch AND (nama_customer LIKE :id OR no_telp LIKE :id)";
        $this->conn->query($query);
        $this->conn->bind('branch', $data['branch']);
        $this->conn->bind('id', '%'.$data['id'].'%');
        return $this->conn->all();
    }

    public function show($id)
    {
        $query = "SELECT id AS customer_id, nama_customer AS name, no_telp AS telp, alamat AS address, poin AS poin,
                    IF(lgn = 1, 'Langganan', '') AS langganan,
                    IF(member = 1, 'Membership', '') AS membership
                    FROM $this->table WHERE id = :id";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        return $this->conn->single();
    }

    public function updateExistChecked($id, $column, $value) {
        $query = "SELECT * FROM $this->table WHERE id <> :id AND $column = :value";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        $this->conn->bind('value', $value);
        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function update($id, $request)
    {
        $query = "UPDATE $this->table SET no_telp = :telp, alamat = :alamat, email = :email WHERE id = :id";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        $this->conn->bind('telp', $request['telp']);
        $this->conn->bind('alamat', $request['alamat']);
        $this->conn->bind('email', $request['email']);
        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function updateStatusLangganan($customerId)
    {
        $query = "UPDATE $this->table SET lgn = :lgn WHERE id = :customer_id";
        $this->conn->query($query);
        $this->conn->bind('lgn', 1);
        $this->conn->bind('customer_id', $customerId);
        $this->conn->execute();
        return $this->conn->rowCount();
    }
    
    public function updateMembership($data)
    {
        $query = "UPDATE $this->table SET member = :status, poin = poin + :poin WHERE id = :customer_id";
        $this->conn->query($query);
        $this->conn->bind('status', 1);
        $this->conn->bind('poin', $data['poin']);
        $this->conn->bind('customer_id', $data['customer_id']);
        $this->conn->execute();
        return $this->conn->rowCount();
    }
}