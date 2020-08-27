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
        $paymentMethod = 'cara_bayar';
        $query1 = "SELECT SUM(IF(jenis_transaksi = 'membership', total, 0)) AS membership,
                        SUM(IF(jenis_transaksi = 'deposit', total, 0)) AS langganan,
                        SUM(IF((jenis_transaksi = 'mlocker' OR jenis_transaksi = 'slocker'), total, 0)) AS locker,
                        SUM(IF(jenis_transaksi <> 'ritel', total, 0)) AS total,
                        DATE(tgl_transaksi) AS tgl, rcp, nama_outlet AS outlet FROM $this->table 
                        WHERE nama_outlet = :outlet
                        AND (DATE(tgl_transaksi) BETWEEN :startDate 
                        AND :endDate) GROUP BY tgl ASC";                        

        $query2 = "SELECT SUM(IF(a.cara_bayar <> 'Kuota', jumlah, 0)) AS laundry, DATE(tgl_transaksi) AS tgl FROM $paymentMethod a LEFT JOIN $this->table b ON a.no_faktur = b.no_faktur
                    WHERE nama_outlet = :outlet
                    AND (DATE(tgl_transaksi) BETWEEN :startDate 
                    AND :endDate) GROUP BY tgl ASC";

        $this->conn->query("SELECT b.laundry, a.membership, a.langganan, a.locker, (a.total + b.laundry) AS total , a.tgl, a.outlet AS nama_outlet FROM ($query1) AS a JOIN ($query2) AS b ON a.tgl = b.tgl");
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
                    AND :endDate) AND lunas = true AND (cara_bayar <> 'Void' AND cara_bayar <> 'Reject') GROUP BY tgl ASC, reception";
        $this->conn->query($query);
        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('startDate', $data['startDate']);
        $this->conn->bind('endDate', $data['endDate']);

        return $this->conn->all();
    }

}