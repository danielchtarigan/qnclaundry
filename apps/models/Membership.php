<?php 

class Membership {
    private $table = 'membership';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function cekMemberCustomer($id)
    {
        $query = "SELECT level, expire_date AS valid_date, status FROM $this->table WHERE customer_id = :customer_id";
        $this->conn->query($query);
        $this->conn->bind('customer_id', $id);
        return $this->conn->all();
    }

    public function membershipByOutlet($outlet, $request) {
        $customer = 'customer';
        $query = "SELECT b.nama_customer AS name, b.no_telp AS telp, a.level AS level, b.poin AS poin, a.join_date AS join_at, a.expire_date AS end_at, a.status AS status 
                    FROM $this->table AS a LEFT JOIN $customer AS b ON a.customer_id = b.id 
                    WHERE b.outlet = :outlet AND join_date BETWEEN :start_at AND :end_at";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        $this->conn->bind('start_at', $request['start_at']);
        $this->conn->bind('end_at', $request['end_at']);
        return $this->conn->all();
    }

    public function show($id)
    {
        $query = "SELECT * FROM $this->table WHERE customer_id = :id";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        return $this->conn->single();
    }

    public function insertOrder($data)
    {
        $query = "INSERT INTO $this->table (customer_id, no_telp, level, join_date, expire_date, user_allow, status) 
                    VALUES (:customer_id, :telp, :level, :nowdate, DATE_ADD(CURDATE(), INTERVAL :expire MONTH), :user, :status)";
        $this->conn->query($query);
        $this->conn->bind('customer_id', $data['customer_id']);
        $this->conn->bind('telp', $data['telpon']);
        $this->conn->bind('level', $data['data']['level']);
        $this->conn->bind('nowdate', $data['data']['nowdate']);
        $this->conn->bind('expire', $data['data']['months']);
        $this->conn->bind('user', $data['user']);
        $this->conn->bind('status', 1);

        $this->conn->execute();
        return $this->conn->rowCount();
    }
}