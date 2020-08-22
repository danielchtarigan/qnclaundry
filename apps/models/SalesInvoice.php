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

    public function invoiceUnionPayment()
    {
        $paymentMethod = 'cara_bayar';
        $query = "SELECT 0 AS jumlah, total AS total, cara_bayar AS payment, jenis_transaksi AS jenis, tgl_transaksi AS tgl, rcp AS rcp, nama_outlet AS outlet
                    FROM $this->table
                    UNION SELECT jumlah AS jumlah, 0 AS total, cara_bayar AS payment, '' AS jenis, tanggal_input AS tgl, resepsionis AS rcp, outlet AS outlet
                    FROM $paymentMethod LIMIT 10";
        // $this->conn->query($query);
        // return $this->conn->all();
        return $query;
    }

    public function omsets($data)
    {
        $paymentMethod = 'cara_bayar';
        $this->conn->query("SELECT (SELECT SUM(IF(cara_bayar <> 'Kuota', jumlah, 0)) FROM $paymentMethod WHERE outlet = :outlet AND (DATE(tanggal_input) BETWEEN :startDate AND :endDate) GROUP BY DATE(tanggal_input) ASC) AS laundry, 
                            DATE(tgl_transaksi) AS tgl, rcp, nama_outlet FROM $this->table 
                            WHERE nama_outlet = :outlet
                            AND (DATE(tgl_transaksi) BETWEEN :startDate 
                            AND :endDate) GROUP BY tgl ASC");

        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('startDate', $data['startDate']);
        $this->conn->bind('endDate', $data['endDate']);

        return $this->conn->all();
    }

}