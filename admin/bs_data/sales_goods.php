<?php 
include '../../config.php';

$startDate = $_GET['start'];
$endDate = $_GET['end'];
$jar = $_GET['jar'];

function currency($number) {
    $format = number_format($number, 0, '', '.');
    return $format;
}

function customer($customerId) {
    global $con;
    $sql = "SELECT nama_customer FROM customer WHERE id = '$customerId' LIMIT 0,1";
    $query = $con->query($sql);
    $row = $query->fetch_row();
    $data = $row[0];
    return $data;
}

function item($item) {
    global $con;
    $sql = "SELECT nama_barang FROM retail WHERE kode = '$item' LIMIT 0,1";
    $query = $con->query($sql);
    $row = $query->fetch_row();
    $data = $row[0];
    return $data;
}

function sales_goods($startDate, $endDate, $jar) {
    global $con;
    $sql  =  "SELECT a.tgl_transaksi AS input_date, a.nama_outlet AS outlet, b.id_customer AS customer_id, a.no_faktur AS no_faktur, a.rcp AS created_by, b.amount AS amount, b.no_order AS no_order, b.item AS item, b.price AS price, b.qty AS qty FROM faktur_penjualan AS a JOIN detail_order_item AS b ON a.no_faktur=b.no_faktur JOIN outlet AS c ON a.nama_outlet=c.nama_outlet WHERE DATE_FORMAT(a.tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND c.Kota='$jar'";
    $query = $con->query($sql);
    while($row = $query->fetch_assoc()) {
        $faktur = $row['no_faktur'];
        $noOrder = $row['no_order'];
        $outlet = $row['outlet'];
        $data[$faktur][$row['item']] = $row;
        $data[$faktur]['created_by'] = $row['created_by'];
        $data[$faktur]['order_date'] = $row['input_date'];
        $data[$faktur]['outlet'] = $row['outlet'];
        $data[$faktur]['customer_id'] = $row['customer_id'];
    
        $amount = 0;
        if(!empty($tomset[$noOrder])) {
            $amount = $tomset[$noOrder];
        }
        $tomset[$noOrder] = $amount + $row['amount'];
    
        $data[$faktur]['amount'] = $tomset[$noOrder];
    }
    if (mysqli_num_rows($query) == 0)
    {
        $data = null;
    }
    return $data;
}

$data = sales_goods($startDate, $endDate, $jar);
// print_r($data);
if(isset($_GET['key'])) {
    echo '<tr class="goods'.$_GET['key'].'">';
    echo '<td colspan="6" align="left">';
    echo '<table width="30%" style="line-height:6px; border: 1px solid #a6a6a6;">';
    echo '<th>Barang</th><th>Harga</th><th>Qty</th><th>Jumlah</th>';
    foreach ($data[$_GET['key']] as $key => $val) {
        if(is_array($val)) {
            $item = item($key);
            if (is_array($val)) {
                echo '
                    <tr class=""></td><td>'.$item.'</td><td align="right">'.currency($val['price']).'</td><td align="center">'.$val['qty'].'</td><td align="right">'.currency($val['amount']).'</td></tr>
                ';
            }
        }
        
    }
    echo '</table>';
    echo '</td>';
    echo '</tr>';
}

