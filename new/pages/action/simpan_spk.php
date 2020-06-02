<?php 
include '../../config.php';
include '../zonawaktu.php';

$jumlah = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(jumlah) FROM detail_spk WHERE no_nota='$_GET[nota]'"))[0];

mysqli_query($con, "UPDATE reception SET spk='1',rcp_spk='$_SESSION[user_id]',tgl_spk='$nowDate',jumlah='$jumlah' WHERE no_nota='$_GET[nota]' ");

if($_SESSION['outlet']=="Casa deParco") {
    mysqli_query($con, "UPDATE reception SET workshop='Casa deParco', tgl_workshop='$nowDate', cuci='1', tgl_cuci='$nowDate', pengering='1', setrika='1', tgl_setrika='$nowDate' WHERE no_nota='$_GET[nota]' ");
}

$sql = $con->query("SELECT id_customer, no_faktur FROM reception WHERE no_nota='$_GET[nota]'");
$data = $sql->fetch_array();

$ot = $_SESSION['outlet'];
$idcs = $data['id_customer'];
$no_nota= $_GET['nota'];
$faktur = $data['no_faktur'];
$hr = $jumlah;

require_once '../../../notifikasi_spk.php';
// Load Composer's autoloader
require '../../../../phpmailer/vendor/autoload.php';

?>
