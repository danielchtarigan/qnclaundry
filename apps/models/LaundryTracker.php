<?php 

/**
 * Ini dipersiapkan untuk jalur baru semua laundry yang masuk
 * pertama digunakan untuk memeriksa jalur checkout dan checkin laundry
 * nantinya jalur spk, checkout, checkin, cuci, kering, setrika, packing, dan handover to customer di tabel ini
 * dan kemudian melacak laundry customer akan berada di tabel ini juga
 */

class LaundryTracker {
    private $table = 'bs_laundry_trackers';
    private $conn;

    public function __construct()
    {
        $this->conn = new Database;
    }

    public function insertFromCheckoutOutlet($data)
    {
        $query = "INSERT INTO $this->table (spk, sales_order_id, checkout_outlet) VALUES (:spk, :sales_order_id, :checkout_outlet) ON DUPLICATE KEY UPDATE checkout_outlet = :checkout_outlet, spk = :spk";
        $this->conn->query($query);

        $countInsert = 0;
        foreach ($data as $val) {
            $this->conn->bind('sales_order_id', $val->sales_id);
            $this->conn->bind('spk', '1');
            $this->conn->bind('checkout_outlet', '1');
            $this->conn->execute();
            $countInsert += $this->conn->rowCount();
        }

        return $countInsert;
    }

    public function update($field, $data)
    {
        $query = "UPDATE $this->table SET $field = :field_value WHERE sales_order_id = :sales_order_id";
        $this->conn->query($query);

        $countInsert = 0;
        foreach ($data as $val) {
            $this->conn->bind('sales_order_id', $val->sales_id);
            $this->conn->bind('field_value', '1');
            $this->conn->execute();
            $countInsert += $this->conn->rowCount();
        }

        return $countInsert;
    }

    public function getOrderToCheckOutOutlet($outlet)
    {
        $sales = 'reception';
        $query = "SELECT a.sales_order_id, b.no_nota AS sales_order, a.spk FROM $this->table AS a LEFT JOIN $sales AS b ON a.sales_order_id = b.id WHERE b.nama_outlet = :outlet AND a.checkout_outlet = :checkout_outlet AND a.spk = :spk";
        $this->conn->query($query);

        $this->conn->bind('outlet', $outlet);
        $this->conn->bind('checkout_outlet', 0);
        $this->conn->bind('spk', 1);

        return $this->conn->all();
    }

    public function getOrderToCheckInWorkshop($driverId)
    {
        $sales = 'reception';
        $checkOutletDetail = 'bs_check_outlet_delivery_details';
        $checkOutlet = 'bs_check_outlet_deliveries';
        $query = "SELECT a.sales_order_id, b.no_nota AS sales_order FROM $this->table AS a LEFT JOIN $sales AS b ON a.sales_order_id = b.id LEFT JOIN $checkOutletDetail AS c ON a.sales_order_id = c.sales_id LEFT JOIN $checkOutlet AS d ON c.bs_check_outlet_delivery_id = d.id WHERE a.checkout_outlet = :checkout_outlet AND a.checkin_workshop = :checkin_workshop AND d.delivery_id = :driver_id AND d.type = :type GROUP BY a.sales_order_id";
        $this->conn->query($query);

        $this->conn->bind('driver_id', $driverId);
        $this->conn->bind('type', 'out');
        $this->conn->bind('checkout_outlet', 1);
        $this->conn->bind('checkin_workshop', 0);

        return $this->conn->all();
    }

    public function getOrderToCheckOutWorkshop($workshopId)
    {
        $sales = 'reception';
        $checkWorkshopDetail = 'bs_check_workshop_delivery_details';
        $checkWorkshop = 'bs_check_workshop_deliveries';
        $query = "SELECT a.sales_order_id, b.no_nota AS sales_order, a.packing FROM $this->table AS a LEFT JOIN $sales AS b ON a.sales_order_id = b.id LEFT JOIN $checkWorkshopDetail AS c ON a.sales_order_id = c.sales_id LEFT JOIN $checkWorkshop AS d ON c.bs_check_workshop_delivery_id = d.id WHERE d.workshop_id = :workshop_id AND a.checkin_workshop = :checkin_workshop AND a.checkout_workshop = :checkout_workshop GROUP BY a.sales_order_id";
        $this->conn->query($query);

        $this->conn->bind('workshop_id', $workshopId);
        $this->conn->bind('checkin_workshop', 1);
        $this->conn->bind('checkout_workshop', 0);

        return $this->conn->all();
    }

    public function getOrderToCheckInOutlet($driverId)
    {
        $sales = 'reception';
        $checkWorkshopDetail = 'bs_check_workshop_delivery_details';
        $checkWorkshop = 'bs_check_workshop_deliveries';

        $query = "SELECT a.sales_order_id, b.no_nota AS sales_order, b.nama_outlet AS outlet FROM $this->table AS a LEFT JOIN $sales AS b ON a.sales_order_id = b.id LEFT JOIN $checkWorkshopDetail AS c ON a.sales_order_id = c.sales_id LEFT JOIN $checkWorkshop AS d ON c.bs_check_workshop_delivery_id = d.id WHERE a.checkout_workshop = :checkout_workshop AND a.checkin_outlet = :checkin_outlet AND d.delivery_id = :driver_id AND d.type = :type GROUP BY a.sales_order_id";
        $this->conn->query($query);

        $this->conn->bind('driver_id', $driverId);
        $this->conn->bind('type', 'in');
        $this->conn->bind('checkout_workshop', 1);
        $this->conn->bind('checkin_outlet', 0);

        return $this->conn->all();
    }
    
}