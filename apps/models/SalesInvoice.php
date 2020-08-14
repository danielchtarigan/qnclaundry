<?php 

class SalesInvoice {
    private $table = 'faktur_penjualan';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getOmsetByOutlet($data)
    {
        $this->conn->query("SELECT SUM(total) FROM $this->table 
                        WHERE jenis_transaksi = :jenis 
                        AND nama_outlet = :outlet
                        AND DATE(tgl_transaksi) = :startDate 
                        AND DATE(tgl_transaksi) = :endDate ");

        $this->conn->bind('jenis', $data['jenis']);
        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('startDate', $data['startDate']);
        $this->conn->bind('endDate', $data['endDate']);

        return $this->conn->single();
    }

}