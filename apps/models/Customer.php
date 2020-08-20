<?php 

class Customer {
    private $table = 'customer';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function show($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
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
}