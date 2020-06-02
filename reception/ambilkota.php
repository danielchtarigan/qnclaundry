<?php
include "../config.php";
$kategori = $_GET['kategori'];
$itemklp = mysqli_query($con, "SELECT * FROM item_spk WHERE kategory='$kategori'");
echo "<option>-- Pilih Item --</option>";
while($k = mysqli_fetch_array($itemklp)){
    echo "<option value=\"".$k['id']."\">".$k['nama_item']."</option>\n";
}
?>
