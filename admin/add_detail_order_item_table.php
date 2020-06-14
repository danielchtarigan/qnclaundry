<?php
include '../config.php';

$sql = "CREATE TABLE IF NOT EXISTS `detail_order_item` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `order_date` datetime NOT NULL,
    `no_order` varchar(6) NOT NULL,
    `item` varchar(25) NOT NULL,
    `price` double(12,2) NOT NULL,
    `qty` tinyint(4) NOT NULL,
    `amount` double(14,2) NOT NULL,
    `no_faktur` varchar(14) NOT NULL,
    `id_customer` int(11) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1; ";

mysqli_select_db($con, 'qnclaundry');

$query = $con->query($sql);
if($query)
{   
    echo "Tabel baru berhasil dibuat!";
}
else {
    echo "Gagal!";
}
mysqli_close($con);