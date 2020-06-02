<?php 

include '../../config.php';
include '../zonawaktu.php';

$key = $_GET['key'];

$outlet = $_SESSION['outlet'];
$cabang = $_SESSION['cabang'];


$query = mysqli_query($con, "SELECT * FROM customer WHERE no_telp = '$key' ORDER BY nama_customer ASC LIMIT 15");
if(mysqli_num_rows($query)>0){
    while($data = mysqli_fetch_assoc($query)){
        echo '<tr>';
        echo '<td>'.$data['nama_customer'].'</td>';
        echo '<td>'.$data['alamat'].'</td>';
        echo '<td>'.$data['no_telp'].'</td>';
        if($data['lgn']=="1" AND $data['member']=="1"){
            echo '<td class="cust">Berlangganan dan Membership</td>';
        } else if($data['lgn']=="1" AND $data['member']=="0"){
            echo '<td class="cust">Berlangganan</td>';
        } else if($data['lgn']=="0" AND $data['member']=="1"){
            echo '<td class="cust">Membership</td>';
        } else if($data['lgn']=="0" AND $data['member']=="0"){
            echo '<td class="cust"></td>';
        }
        echo '<td class="cust"><a href="?transaksi&id='.$data['id'].'" class="btn btn-xs btn-success">Pilih</a></td>';
        echo '</tr>';
    }
} else {
    echo '<tr>';
    echo '<td colspan="5" align="center">..Data tidak ditemukan..</td>';
    echo '</tr>';
}
    
?>

