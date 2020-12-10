<?php 

class Langganan {
    private $table = 'langganan';
    private $conn;
    private $count = 0;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function langgananByOutlet($outlet, $request) {
        $customer = 'customer';
        $query = "SELECT b.nama_customer AS name, b.no_telp AS telp, a.kilo_cks AS kiloan, a.potongan AS potongan, a.tgl_join AS join_at, a.tgl_expire AS end_at 
                    FROM $this->table AS a LEFT JOIN $customer AS b ON a.id_customer = b.id 
                    WHERE b.outlet = :outlet AND a.tgl_join BETWEEN :start_at AND :end_at";
        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        $this->conn->bind('start_at', $request['start_at']);
        $this->conn->bind('end_at', $request['end_at']);
        return $this->conn->all();
    }

    public function show($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $this->conn->query($query);
        $this->conn->bind('id', $id);
        return $this->conn->single();
    }

    public function getKuota($customerId)
    {
        $query = "SELECT kilo_cks AS kiloan, potongan, tgl_expire AS expire FROM $this->table WHERE id_customer = :customer_id ORDER BY id LIMIT 0,1";
        $this->conn->query($query);
        $this->conn->bind('customer_id', $customerId);
        return $this->conn->single();
    }

    public function updateQuota($data)
    {
        $query = "UPDATE $this->table SET kilo_cks = :kilos, all_kuota = :all_kuota WHERE id_customer = :customer_id";
        $this->conn->query($query);
        foreach ($data->data_kuota as $val) {
            $this->conn->bind('kilos', $val->kilo);
            $this->conn->bind('all_kuota', 0);
            $this->conn->bind('customer_id', $data->customer_id);
            $this->conn->execute();
            $this->count += $this->conn->rowCount();
        }
        return $this->count;
    }

    public function insertQuotaNow($data)
    {
        $query = "INSERT INTO $this->table (id_customer, kilo_cks, tgl_expire) VALUES (:customer_id, :kiloan, DATE_ADD(CURDATE(), INTERVAL :expire DAY))";
        $this->conn->query($query);

        $this->conn->bind('customer_id', $data['customer']);
        $this->conn->bind('kiloan', $data['kiloan']);
        $this->conn->bind('expire', $data['days']);

        $this->conn->execute();
        return $this->conn->rowCount();
    }

    public function updateQuotaNow($data)
    {
        $query = "UPDATE $this->table SET kilo_cks = :kiloan, all_kuota = :all_kuota, tgl_expire = DATE_ADD(CURDATE(), INTERVAL :expire DAY) WHERE id_customer = :customer_id";
        $this->conn->query($query);
        $this->conn->bind('kiloan', $data['kiloan']);
        $this->conn->bind('all_kuota', 0);
        $this->conn->bind('customer_id', $data['customer']);
        $this->conn->bind('expire', $data['days']);
        $this->conn->execute();

        return $this->conn->rowCount();
    }
}