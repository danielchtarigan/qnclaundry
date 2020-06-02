<?php
///rupiah adalah fungsi yang nantinya akan kita panggil
    
     include "../../../config.php";
     session_start();

$us=$_SESSION['name'];
$ot=$_SESSION['nama_outlet'];
 function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }


$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='tambahspk')
{
    $jumlah=$_GET['jumlah'];
    $no_nota=$_GET['no_nota'];
    $jenis_item=$_GET['jenis_item'];
   
    $sql=$con->query("select no_nota,nama_customer,tgl_input from reception WHERE no_nota = '$no_nota'");
	$r = $sql->fetch_assoc();
	$nama_customer=$r['nama_customer'];
	$tgl=$r['tgl_input'];
  
      $tambah=mysqli_query($con,"insert into detail_spk (jenis_item,no_nota,jumlah) VALUES('$jenis_item','$no_nota','$jumlah')");
    
    if($tambah)
    {
    	
echo ''.$no_nota.'<br>';
     
    }else
    {
        echo "ERROR";
    }
}

elseif($op=='rincian_spk')
{
	$id_cs=$_GET['id_cs'];
	$no_nota=$_GET['no_nota'];
    $brg=mysqli_query($con,"select * from detail_spk WHERE no_nota='$no_nota'");
   
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
                <td>$r[jenis_item]</td>
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
  url: "../fungsi/del_detail_spk.php",
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
</script>    <?php
    
    }

elseif($op=='selesaispk')
{
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
    $id_cs=$_GET['id_cs'];
    $no_nota=$_GET['no_nota'];
    $sql5=$con->query("SELECT sum(jumlah) as total FROM detail_spk WHERE no_nota= '$no_nota'");
$r = $sql5->fetch_assoc();
  $t=$r['total'];  
    
  
    $tambah=mysqli_query($con," update reception set spk='1',tgl_spk='$jam',rcp_spk='$us',jumlah='$t' WHERE no_nota='$no_nota'");
    
    if($tambah)
    {

	 include"../../../reception/bar128.php";
    	$edit = mysqli_query($con,"SELECT * FROM reception WHERE id='$id_cs'");
    	$r    = mysqli_fetch_array($edit);

    	?>
 <div style="font-size: 12px; font-family: Arial" >
<div align="center" class="style1 style4">SPK</div>
<div align="center"> <?php echo bar128(stripslashes($no_nota))?></div>
 <div>
<?php
echo 'Nama : '.$r['nama_customer'].'<br>';
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
			$sql2=mysqli_query($con,"SELECT * FROM detail_spk WHERE no_nota= '$no_nota'");
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
				$sql3=mysqli_query($con,"SELECT sum(jumlah) as total FROM detail_spk WHERE no_nota= '$no_nota'");
$s1=mysqli_fetch_array($sql3);
$hr=$s1['total'];
echo $hr ;
				?>
				</td>
			</tr>
	
		
	</tbody>
</table>
</div>
<?php echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[name]" ?>
<?php

    }else
    {
        echo "ERROR";
    }
}

?>

