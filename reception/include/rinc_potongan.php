<?php
require '../../config.php';
if ($con->connect_error){
	echo "Gagal terkoneksi ke database : (".$mysqli->connect_error.")".$mysqli->connect_error;
}
?>
<button type="button" class="btn btn-xs btn-default" id="hidetablerinc" style="color: red">Sembunyikan/Tampilkan Rincian</button>
<table class="table table-condensed" id="rincpotongan" name="" style="background: #c4dc96; font-size: 12px; width: 80%;margin: auto 10%">
    <?php
	$qcustomer = mysqli_query($con, "select * from order_potongan_tmp where id_customer='$_GET[id]' AND cabang<>'Delivery' order by id desc");
	$ncustomer = mysqli_num_rows($qcustomer);
	if ($ncustomer>0){
		$no = 1;
		while ($rcustomer = mysqli_fetch_array($qcustomer)){
            $ket = ($rcustomer['ket']=="") ? "" : " (".$rcustomer['ket'].")";
		?>
        <tr>            
            <td style="text-align: center"><?php echo $rcustomer['jumlah']; ?></td>
            <td><?php echo $rcustomer['item'].$ket ?></td>
            <td style="text-align: right"><?php echo "@ ".number_format($rcustomer['harga'],0,'.',','); ?></td>
            <td style="text-align: right"><?php echo "Rp. ".number_format($rcustomer['harga']*$rcustomer['jumlah'],0,'.',','); ?></td>                                           
        </tr>
	   <?php	
	   $no++;
		}
        
	}
	else{
	?>
        <tr class="odd gradeX">
            <td colspan="4" align="center">.. Data Tidak Ada ..</td>
        </tr>
     <?php
	 }
	 ?>
</table>

<script type="text/javascript">
    $('#hidetablerinc').on('click', function(){
        $('#rincpotongan').toggleClass('hide');
    })
</script>