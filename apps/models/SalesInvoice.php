<?php 
include_once 'models/SalesPaymentMethod.php';
include_once 'models/SalesOrder.php';

class SalesInvoice {
    private $table = 'faktur_penjualan';
    private $conn;
    private $count = 0;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function getInvoiceNumber($code)
    {
        $query = "SELECT no_faktur_urut AS invoiceNumber FROM $this->table WHERE no_faktur_urut LIKE :code ORDER BY id DESC LIMIT 0, 1";
        $this->conn->query($query);
        $this->conn->bind('code', $code.'%');
        return $this->conn->single();
    }

    public function getPaymentsByCustomer($customerId)
    {
        $query = "SELECT no_faktur AS faktur, total AS total, nama_outlet AS outlet, rcp AS kasir, DATE(tgl_transaksi) AS createDate, cara_bayar AS payMethod, jenis_transaksi AS type, item_package FROM $this->table WHERE id_customer = :customer_id AND DATE_ADD(CURDATE(), INTERVAL -3 DAY) ORDER BY id DESC";
        $this->conn->query($query);
        $this->conn->bind('customer_id', $customerId);
        return $this->conn->all();
    }

    public function getPaymentMethodByInvoiceNumber($invoiceNumber)
    {
        $table = 'cara_bayar';
        $query = "SELECT cara_bayar AS method, jumlah AS amount FROM $table WHERE no_faktur = :invoice_number";
        $this->conn->query($query);
        $this->conn->bind('invoice_number', $invoiceNumber);
        return $this->conn->all();
    }

    public function insertSalesPayment($data)
    {
        $query = "INSERT INTO $this->table (no_faktur, no_faktur_urut, nama_outlet, rcp, tgl_transaksi, total, cara_bayar, id_customer, jenis_transaksi, item_package) 
                VALUES (:invoice_number, :invoice_number, :outlet, :user, :nowdate, :total_pay, :pay_method, :customer_id, :istype, :item_package)";
        $this->conn->query($query);
        $this->conn->bind('invoice_number', $data->number);
        $this->conn->bind('outlet', $data->outlet);
        $this->conn->bind('user', $data->user);
        $this->conn->bind('nowdate', $data->nowdate);
        $this->conn->bind('total_pay', $data->total_pay);
        $this->conn->bind('pay_method', $data->method);
        $this->conn->bind('customer_id', $data->customer_id);
        $this->conn->bind('istype', $data->type);
        $this->conn->bind('item_package', $data->item_package);
        $this->conn->execute();

        if ($data->type === "ritel") {
            if ($this->conn->rowCount() > 0) {    
                $paymentMethod = new SalesPaymentMethod; 
                $insertMethod = $paymentMethod->insert($data);
    
                if ($insertMethod > 0) {
                    $salesOrder = new SalesOrder;
                    return $salesOrder->updateOrderPayOff($data);
                }
            }
        } else {
            return $this->conn->rowCount();
        }

    }

    public function insertSalesPaymentMethod($data) {
        $query = "INSERT INTO cara_bayar (no_faktur, cara_bayar, jumlah, resepsionis, outlet, tanggal_input)
                VALUES (:invoice_number, :payment_method, :value_payment, :user, :outlet, :nowdate)";
        $this->conn->query($query);

        foreach ($data->data as $val) {
            $this->conn->bind('invoice_number', $data->invoice_number);
            $this->conn->bind('payment_method', $val->method);
            $this->conn->bind('value_payment', $val->value);
            $this->conn->bind('user', $data->user);
            $this->conn->bind('outlet', $data->outlet);
            $this->conn->bind('nowdate', $data->nowdate);
            $this->conn->execute();
            $this->count += $this->conn->rowCount();    
        }

        return $this->count;
    }

    public function getOmsetByOutlet($data)
    {
        $paymentMethod = 'cara_bayar';
        $query = "SELECT SUM(IF(jenis_transaksi = 'membership', total, 0)) AS membership,
                        SUM(IF(jenis_transaksi = 'deposit', total, 0)) AS langganan,
                        SUM(IF((jenis_transaksi = 'mlocker' OR jenis_transaksi = 'slocker'), total, 0)) AS locker,
                        SUM(IF(jenis_transaksi <> 'ritel', total, 0)) AS total,
                        DATE(tgl_transaksi) AS tgl, rcp, nama_outlet AS outlet FROM $this->table 
                        WHERE nama_outlet = :outlet
                        AND (DATE(tgl_transaksi) BETWEEN :startDate 
                        AND :endDate) GROUP BY tgl ASC";    
                        
        $this->conn->query($query);
        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('startDate', $data['startDate']);
        $this->conn->bind('endDate', $data['endDate']);
        $payments = $this->conn->all();

        foreach ($payments as $key => $value) {
            $laundry = $this->getOmsetLaundryNotKuota($data['outlet'], $value['tgl']);
            $result[$key] = [
                'tgl' => $value['tgl'],
                'nama_outlet' => $value['outlet'],
                'laundry' => $laundry['laundry'] == null ? 0 : $laundry['laundry'],
                'membership' => $value['membership'],
                'langganan' => $value['langganan'],
                'locker' => $value['locker'],
                'total' => $value['total'] + ($laundry['laundry'] == null ? 0 : $laundry['laundry'])
            ];
        }
        
        return $result;
    }

    public function getOmsetLaundryNotKuota($outlet, $tgl)
    {
        $paymentMethod = 'cara_bayar';
        $query = "SELECT SUM(IF(a.cara_bayar <> 'Kuota', jumlah, 0)) AS laundry
                    FROM $paymentMethod a LEFT JOIN $this->table b ON a.no_faktur = b.no_faktur 
                    WHERE nama_outlet = :outlet
                    AND DATE(tgl_transaksi) = :tgl";

        $this->conn->query($query);
        $this->conn->bind('outlet', $outlet);
        $this->conn->bind('tgl', $tgl);
        return $this->conn->single();
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
                    AND :endDate) AND lunas = true AND (cara_bayar <> 'Void' AND cara_bayar <> 'Reject' AND cara_bayar <> 'Kuota') GROUP BY tgl ASC, reception";
        $this->conn->query($query);
        $this->conn->bind('outlet', $data['outlet']);
        $this->conn->bind('startDate', $data['startDate']);
        $this->conn->bind('endDate', $data['endDate']);

        return $this->conn->all();
    }

    public function updatePayment($data)
    {
        $query = "UPDATE $this->table AS a SET total = (select total FROM $this->table AS b 
        WHERE b.no_faktur = a.no_faktur) - :total WHERE a.no_faktur = :faktur";
        $this->conn->query($query);
        $this->conn->bind('total', $data->total_order);
        $this->conn->bind('faktur', $data->faktur);
        $this->conn->execute();

        $result = $this->conn->rowCount();

        if($result) {
            $paymentMethod = new SalesPaymentMethod;

            return $paymentMethod->insertNewMethod($data);
        }
    }

}