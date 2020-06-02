<?php
require '../../config.php';
if ($con->connect_error){
  echo "Gagal terkoneksi ke database : (".$mysqli->connect_error.")".$mysqli->connect_error;

  $qcus = $con->query("SELECT * FROM customer WHERE id='$_GET[id]'");
  $r = $qcus->fetch_array();

}
?>
<option value="0">--Pilih Item--</option>
<?php 
$qcus = $con->query("SELECT * FROM customer WHERE id='$_GET[id]'");
$r = $qcus->fetch_array();
$levelp2 = $_GET['level'];
$sql = $con->query("SELECT kategori FROM item_harga WHERE kategori='$_GET[kategori]' GROUP BY kategori ORDER BY kategori ASC");
while($data = $sql->fetch_array()){                
    switch ($data['kategori']) {
      case 'p1':
        $katp2 = "Clothes";
        break;
      case 'p2':
        $kat = "Shoes & Ransel";
        break;
      case 'p3':
        $katp2 = "Beddings";
        break;
      case 'p4':
        $katp2 = "Carpet";
        break;
      case 'p5':
        $katp2 = "Gordyn";
        break;
    }
    echo '<option value="0" disabled>'.$katp2.'</option>';
    $qp = $con->query("SELECT nama_item,$levelp2 AS harga FROM item_harga WHERE kategori='$data[kategori]' ORDER BY nama_item ASC");
    while($datp = $qp->fetch_array()){
      $itemp2 = $datp['nama_item'];
      $hargap2 = $datp['harga'];
      if($r['lgn']==1){ 
        $hargap2 = $hargap2*0.88;
      }
      elseif($r['member']==1){
        $hargap2 = $datp['harga']*0.80;
      }                    
      echo '<option value="'.$itemp2.'-'.$hargap2.'-'.$data['kategori'].'-'.$levelp2.'"> &nbsp; &nbsp; '.$itemp2.'</option>'; 
    }
                 
}
?>