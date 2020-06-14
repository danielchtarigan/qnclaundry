<?php 
include '../../config.php';

$startDate = $_GET['start'];
$endDate = $_GET['end'];
$jar = $_GET['jar'];

function currency($number) {
    $format = number_format($number, 0, ',', '.');
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

$sql  =  "SELECT tgl_input AS order_date, a.nama_outlet AS outlet, a.id_customer AS customer_id, a.no_faktur AS no_faktur, a.no_nota AS no_order, a.total_bayar AS amount, a.diskon AS discount, a.voucher AS promo_code, a.nama_reception AS created_by FROM reception AS a LEFT JOIN outlet AS b ON a.nama_outlet=b.nama_outlet WHERE DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND b.Kota='".$_GET['jar']."' AND lunas=true AND cara_bayar<>'Void' AND cara_bayar<>'Reject'";
$query = $con->query($sql);
while($row = $query->fetch_assoc()) {
    $noOrder = $row['no_order'];
    $outlet = $row['outlet'];
    $data[$noOrder] = $row;
}

?>

		<thead>
            <tr>
				<th>Tanggal</th>
				<th>Nama Outlet</th>
				<th>Nama Customer</th>
				<th>Nomor Order</th>
				<th>Dibuat Oleh</th>
				<th>Harga</th>
				<th>Kode Promo</th>
				<th>Diskon</th>
				<th width="20%">Jumlah</th>
			</tr>
		</thead>
		<tbody>
            <?php 
            foreach ($data as $key => $val) {
                // $date = date_create($val['order_date']);

                $disc = $val['discount'];
                if ($disc == "") {
                    $disc = 0;
                }
                $amount = $val['amount'] + $disc;
                echo '
                <tr>
                    <td>'.date_format(date_create($val['order_date']), 'd/m/Y').'</td>
                    <td>'.$val['outlet'].'</td>
                    <td>'.customer($val['customer_id']).'</td>
                    <td>'.$key.'</td>
                    <td>'.$val['created_by'].'</td>
                    <td>'.$amount.'</td>
                    <td>'.$val['promo_code'].'</td>
                    <td>'.$val['discount'].'</td>
                    <td>'.$val['amount'].'</td>
                </tr>
                ';
                
            }
                ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>

    
    