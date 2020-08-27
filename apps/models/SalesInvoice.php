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
        $this->conn->query("SELECT SUM(IF(jenis_transaksi = 'ritel', total, 0)) AS laundry,
                        SUM(IF(jenis_transaksi = 'membership', total, 0)) AS membership,
                        SUM(IF(jenis_transaksi = 'deposit', total, 0)) AS langganan,
                        SUM(IF((jenis_transaksi = 'mlocker' OR jenis_transaksi = 'slocker'), total, 0)) AS locker,
                        SUM(total) AS total,
                        DATE(tgl_transaksi) AS tgl, rcp, nama_outlet FROM $this->table 
                        WHERE nama_outlet = :outlet
                        AND (DATE(tgl_transaksi) BETWEEN :startDate 
                        AND :endDate) GROUP BY tgl ASC");

        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('startDate', $data['startDate']);
        $this->conn->bind('endDate', $data['endDate']);

        return $this->conn->all();
    }

    public function getOmsetByOrder($data)
    {
        $invoice = 'reception';
        $query = "SELECT SUM(IF(jenis = 'k' ,total_bayar, 0)) AS kiloan, 
                    SUM(IF(jenis = 'p' ,total_bayar, 0)) AS potongan, 
                    SUM(total_bayar) AS total,
                    nama_reception AS reception, DATE(tgl_input) AS tgl 
                    FROM $invoice 
                    WHERE nama_outlet = :outlet
                    AND (DATE(tgl_input) BETWEEN :startDate 
                    AND :endDate) AND lunas = true AND (cara_bayar <> 'Void' AND cara_bayar <> 'Reject') GROUP BY tgl ASC";
        $this->conn->query($query);
        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('startDate', $data['startDate']);
        $this->conn->bind('endDate', $data['endDate']);

        return $this->conn->all();
    }

}