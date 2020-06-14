<?php 
include '../../config.php';

$startDate = $_GET['start'];
$endDate = $_GET['end'];
$jar = $_GET['jar'];

function currency($number) {
    $format = number_format($number, 0, ',', '.');
    return $format;
}

function sales_faktur($startDate,$endDate,$outlet) {
    global $con;
    $sql = "SELECT a.nama_outlet AS nama_outlet, a.jenis_transaksi AS jenis_transaksi, a.no_faktur AS no_faktur, a.total AS total, c.amount AS total_goods FROM faktur_penjualan AS a LEFT JOIN detail_order_item AS c ON a.no_faktur=c.no_faktur WHERE DATE_FORMAT(a.tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND a.nama_outlet='$outlet' AND a.jenis_transaksi<>'deposit'";
    $query = $con->query($sql);
    // $numRows = mysqli_num_rows($query);
    while($row = $query->fetch_array()) {
        $type = $row['jenis_transaksi'];
        // Omset Sales
        $salesOmset = 0;
        if(!empty($omset[$outlet][$type])) {
            $salesOmset = $omset[$outlet][$type];
        }
        $omset[$outlet][$type] = $salesOmset + $row['total'];
        
        // Omset Sales Goods
        $salesGoods = 0;
        if(!empty($omsetGoods[$outlet]['goods'])) {
            $salesGoods = $omsetGoods[$outlet]['goods'];
        }
        $omsetGoods[$outlet]['goods'] = $salesGoods + $row['total_goods'];
    }

    if(empty($omset[$outlet]['membership'])) {
        $omset[$outlet]['membership'] = 0;
    }
    if(empty($omset[$outlet]['ritel'])) {
        $omset[$outlet]['ritel'] = 0;
    }
    if(empty($omset['membership'])) {
        $omset['membership'] = 0;
    }
    
    $data[$outlet] = [
        'outlet' => $outlet,
        'member' => $omset[$outlet]['membership'],
        'ritel' => $omset[$outlet]['ritel'],
        'goods' => $omsetGoods[$outlet]['goods']        
    ];
    return $data;
}

function sales_laundry($startDate, $endDate, $outlet) {
    global $con; $rincian = array();
    $sql = "SELECT * FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND nama_outlet='$outlet' AND lunas=true AND cara_bayar<>'Void' AND cara_bayar<>'Reject'";
    $query = $con->query($sql);
    $numRows = mysqli_num_rows($query);
    while($row = $query->fetch_array()) {
        $outlet = $row['nama_outlet'];
        $service = $row['jenis'];
    
        $omsetlaundry = 0;
        if(!empty($laundry[$outlet][$service])) {
            $omsetlaundry = $laundry[$outlet][$service];
        }
        $laundry[$outlet][$service] = $omsetlaundry + $row['total_bayar'];

    }
    if(empty($laundry[$outlet]['p'])) {
        $laundry[$outlet]['p'] = 0;
    }
    if(empty($laundry[$outlet]['k'])) {
        $laundry[$outlet]['k'] = 0;
    }

    $data[$outlet] = [
        'outlet' => $outlet,
        'kiloan' => $laundry[$outlet]['k'],
        'potongan' => $laundry[$outlet]['p']
    ];

    return $data;
}

$sql = "SELECT a.nama_outlet AS outlet FROM outlet AS a JOIN faktur_penjualan AS b ON a.nama_outlet=b.nama_outlet WHERE DATE_FORMAT(b.tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND a.Kota='$jar' AND b.jenis_transaksi<>'deposit' ORDER BY a.nama_outlet ASC";
$query = $con->query($sql);
while($row = $query->fetch_array()) {
    $outlet = $row['outlet'];

    $data[$outlet] = [
        'outlet' => $outlet
    ];
}


?>



<table class="table table-bordered table-striped table-condensed">
    <thead>
        <tr>
            <th>Nama Outlet</th>
            <th>Kiloan</th>
            <th>Potongan</th>
            <th>Membership</th>
            <th>Laundry</th>
            <th>Barang</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($data as $data) {
                $salesFaktur = sales_faktur($startDate,$endDate,$data['outlet']);
                $salesLaundry = sales_laundry($startDate,$endDate,$data['outlet']);

                $tkiloans = 0;
                $tkiloans += $salesLaundry[$data['outlet']]['kiloan'];
                $tkiloan[] = $tkiloans;

                $tpotongans = 0;
                $tpotongans += $salesLaundry[$data['outlet']]['potongan'];
                $tpotongan[] = $tpotongans;

                $tmembers = 0;
                $tmembers += $salesFaktur[$data['outlet']]['member'];
                $tmember[] = $tmembers;

                $tgoodss = 0;
                $tgoodss += $salesFaktur[$data['outlet']]['goods'];
                $tgoods[] = $tgoodss;
                
            ?>
                <tr>
                    <td align="left"><?= $data['outlet'] ?></td>
                    <td align="center"><?= currency($salesLaundry[$data['outlet']]['kiloan']) ?></td>
                    <td align="center"><?= currency($salesLaundry[$data['outlet']]['potongan']) ?></td>
                    <td align="center"><?= currency($salesFaktur[$data['outlet']]['member']) ?></td>
                    <td align="center"><?= currency(array_sum($salesLaundry[$data['outlet']]) + $salesFaktur[$data['outlet']]['member']) ?></td>
                    <td align="center"><?= currency($salesFaktur[$data['outlet']]['goods']) ?></td>
                </tr>

            <?php
            }
        ?>

    </tbody>
    <tfoot>
        <tr>
            <th style="text-align:right; background-color: #00A8FF">Total:</th>
            <th style="background-color: #00A8FF"><?= currency(array_sum($tkiloan)) ?></th>
            <th style="background-color: #00A8FF"><?= currency(array_sum($tpotongan)) ?></th>
            <th style="background-color: #00A8FF"><?= currency(array_sum($tmember)) ?></th>
            <th style="background-color: #00A8FF"><?= currency(array_sum($tkiloan) + array_sum($tpotongan) + array_sum($tmember)) ?></th>
            <th style="background-color: #00A8FF"><?= currency(array_sum($tgoods)) ?></th>
        </tr>
    </tfoot>
