<?php
include "../config.php";


session_start();
$us             = $_SESSION['user_id'];
date_default_timezone_set('Asia/Makassar');
$date         = date("Y-m-d H:i:s");


$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='rincian_spk')
{
	$id_cs=$_GET['id_cs'];
	$no_nota=$_GET['no_nota'];
	$brg=mysqli_query($con,"select * from detail_hotel WHERE no_nota='$no_nota'");
	
	echo "<thead>
	<tr>
	<td>No Nota</td>
	<td>Item</td>
	<td>Jumlah</td>
	<td>Hapus</td>
	
	</tr>
	</thead>";
	while($r=mysqli_fetch_array($brg)){
	
	echo "<tr id='$r[id]' >
	<td>$r[no_nota]</td>
	<td>$r[item]</td>
	<td>$r[jumlah]</td>
	
	<td><a class='hapus' id='$r[id]' style='cursor: pointer;'>hapus</a></td>
	
	
	</tr>";
	}
	?><script>
	$(function () {
	//Box Konfirmasi Hapus
	$('#konfirm-box').dialog({
	modal: true,
	autoOpen: false,
	show: "Bounce",
	hide: "explode",
	title: "Konfirmasi",
	buttons: {
	
	"Ya": function () {
	jQuery.ajax({
	type: "POST",
	url: "del_detail_hotel.php",
	data: 'id=' +id,
	success: function(){
	$('#'+id).animate({ backgroundColor: "#fbc7c7" }, "fast")
	.animate({ opacity: "hide" }, "slow");
	}
	});
	$(this).dialog("close");
	},
	
	"Batal": function () {
	//jika memilih tombol batal
	$(this).dialog("close");
	
	}
	}
	});
	
	//Tombol hapus diklik
	$('.hapus').click(function () {
	$('#konfirm-box').dialog("open");
	//ambil nomor id
	id = $(this).attr('id');
	});
	});
	</script>   
<?php
}
elseif($op=='tambahspk')
{
	$jumlah=$_GET['jumlah'];
	$id_cs=$_GET['id_cs'];
	$no_nota=$_GET['no_nota'];
	$jenis_item=$_GET['jenis_item'];
	$tambah=mysqli_query($con,"insert into detail_hotel (tgl_transaksi,item,no_nota,jumlah,nama_hotel) VALUES ('$date','$jenis_item','$no_nota','$jumlah','$id_cs')");    
    if($tambah)
    {
    	  echo "sukses";
      
    }else
    {
        echo "ERROR";
    }
}

elseif($op=='selesai')
{
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
$id_cs=$_GET['id_cs'];
$no_nota=$_GET['no_nota'];

$sql5=$con->query("SELECT sum(jumlah) as total FROM detail_hotel WHERE no_nota= '$no_nota'");
$r = $sql5->fetch_assoc();
$t=$r['total'];  
$tambah=mysqli_query($con," update hotel_trans set jumlah='$t' WHERE no_so='$no_nota'");
    
    if($tambah)
    {

	 include"bar128.php";
    	$edit = mysqli_query($con,"SELECT * FROM hotel_trans WHERE id='$id_cs'");
    	$r    = mysqli_fetch_array($edit);

    	?>
<div style="font-size: 12px; font-family: Arial" >
    <div align="center" class="style1 style4">SPK</div>
    <div align="center"> <?php echo bar128(stripslashes($no_nota))?></div>
    <div>
    <?php
    echo 'Nama : '.$r['nama_hotel'].'<br>';
    echo 'No Faktur : '.$no_nota.'<br>';
    ?>
    </div>
    <table id="resultTable" data-responsive="table" style="text-align: left; font-size: 12px;font-family: arial">
    <thead>
        <tr>
            <th></th>
            
            <th></th>
            
        </tr>
    </thead>
    <tbody>
    <?php
            $sql2=mysqli_query($con,"SELECT * FROM detail_hotel WHERE no_nota= '$no_nota'");
            while($s = mysqli_fetch_array($sql2)){
                ?>
                <tr>
                <td colspan="2"><?php echo $s['jenis_item'];?></td><td></td>
                <td colspan="4"><?php echo $s['jumlah'];?></td>
                
                </tr>
            
                        <?php  
                        }
                    ?>
                    <tr>
                <td colspan="2">Total:</td><td></td>
                <td colspan="4">
                <?php
                $sql3=mysqli_query($con,"SELECT sum(jumlah) as total FROM detail_hotel WHERE no_nota= '$no_nota'");
    $s1=mysqli_fetch_array($sql3);
    $hr=$s1['total'];
    echo "harus di hitung manual";
                ?>
                </td>
            </tr>
    
        
    </tbody>
    </table>
</div>

<?php echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[user_id]" ?>
<?php

    }else
    {
        echo "ERROR";
    }
}
   
?>
	
	


