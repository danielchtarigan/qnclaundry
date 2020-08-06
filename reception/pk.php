<?php
///rupiah adalah fungsi yang nantinya akan kita panggil
     function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
     session_start();

$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];



?>
<?php
include "../config.php";
$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='tambah')
{
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
    $id_cs=$_GET['id_cs'];
    $jumlah=$_GET['jumlah'];
    $no_nota=$_GET['no_nota'];
    $total=$_GET['total'];
    $jenis="deposit";
  
    $tambah=mysqli_query($con," update customer set sisa_kuota='$total' WHERE id='$id_cs'");
    $tambah=mysqli_query($con,"insert into detail_lgn (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota) VALUES('1','$jumlah','$id_cs','$jam','$no_nota')");
    
    if($tambah)
    {
    	$edit = mysqli_query($con,"SELECT * FROM customer WHERE id='$id_cs'");
    	$r    = mysqli_fetch_array($edit);
    	 $total=rupiah($_GET['total']);
    	
    
       echo "<form method=POST >
          <input type=hidden name=id value=$r[id]>
          <table width=100%>
          <tr>
          <td style='width:50px'>
          Nama Customer
          </td>        
          <td> : $r[nama_customer]</td>
          </tr>
          
          <tr><td>
          No Nota</td>        
          <td> : $no_nota</td>
          </tr>
          <tr><td>
          Jenis :</td>        
          <td> : $jenis</td>
          </tr>
          <tr>
          <td>Transaksi</td> 
          <td> :  $jumlah</td>
          </tr>
                    <tr>
          <td>Sisa Kuota</td> 
          <td> :  $total</td>
          </tr>

          </table></form>";
    }else
    {
        echo "ERROR";
    }
}
elseif($op=='up_cst_lgn')
{
	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
    $id=$_GET['id'];
    
    $tambah=mysqli_query($con," update customer set lgn=1 WHERE id='$id'");
       
    if($tambah)
    {
    	header("location: admin/index.php");
       echo "sukses";
     
    }else
    {
        echo "ERROR";
    }
}

elseif($op=='up_cst_member')
{
	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
    $id=$_GET['id'];
    $jenis=$_GET['jenis'];
    $tgl_join=$_GET['tgl_join'];
    $tgl_akhir=$_GET['tgl_akhir'];
    
    
    $tambah=mysqli_query($con," update customer set member=1 , jenis_member='$jenis',tgl_join='$tgl_join',tgl_akhir='$tgl_akhir' WHERE id='$id'");
       
    if($tambah)
    {
       echo "sukses";
    }else
    {
        echo "ERROR";
    }
}























elseif($op=='kurang')
{
	date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
    $id_cs=$_GET['id_cs'];
    $jumlah=$_GET['jumlah'];
    $no_nota=$_GET['no_nota'];
    $total=$_GET['total'];
  	$jenis="pemakaian";
    $tambah=mysqli_query($con," update customer set sisa_kuota='$total' WHERE id='$id_cs'");
    $tambah=mysqli_query($con,"insert into detail_lgn (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota) VALUES('0','$jumlah','$id_cs','$jam','$no_nota')");
    
    if($tambah)
    {
    	$edit = mysqli_query($con,"SELECT * FROM customer WHERE id='$id_cs'");
    	$r    = mysqli_fetch_array($edit);
    	 $total=rupiah($_GET['total']);
       echo "<form method=POST >
          <input type=hidden name=id value=$r[id]>
          <table width=100%>
          <tr>
          <td style='width:50px'>
          Nama Customer
          </td>        
          <td> : $r[nama_customer]</td>
          </tr>
          
          <tr><td>
          No Nota</td>        
          <td> : $no_nota</td>
          </tr>
          <tr>
          <tr><td>
          Jenis :</td>        
          <td> : $jenis</td>
          </tr>
          <tr>
          <td>Transaksi</td> 
          <td> :  $jumlah</td>
          </tr>
                    <tr>
          <td>Sisa Kuota</td> 
          <td> :  $total</td>
          </tr>

          </table></form>";
    }else
    {
        echo "no nota sudah ada";
    }
}

elseif($op=='tambah_customer')
{
	date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
  
    $nama_customer1=$_GET['nama_customer1'];
    $alamat1=$_GET['alamat1'];
    $no_telp1=$_GET['no_telp1'];
  
  $con->query("INSERT INTO customer(nama_customer,alamat,no_telp) VALUES ('$nama_customer1','$alamat1','$no_telp1')");
    
    if($con)
    {
       echo "sukses";
    }else
    {
        echo "ERROR";
    }
}
elseif($op=='customer')
{
?><?PHP
	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
    $id_cs=$_GET['id_cs'];
    $sql=$con->query("select * from customer WHERE id = '$id_cs'");
	$r = $sql->fetch_assoc();
    $langganan = mysqli_query($con, "select *from langganan where id_customer='$id_cs' ");
            $ql = mysqli_fetch_array($langganan);
    ?>
    <div class="row equal">
     <div  class="col-md-6 col-xs-6 col-sm-6" style="font-size: 30px" >
		    <div class="form-group">
		    <div  class="col-md-7 col-md-offset-4 ">
		    <label style="font-size: 30px ;  background-color: #ccff00; "><?php echo $ql['kilo_cks'].' Kg<br>'.rupiah($ql['potongan']) ?></label>
            <input class="sisa" id="sisa" name="sisa" type="hidden"  readonly=true value="<?php echo $r['sisa_kuota'] ?>" /> 
            </div></div>
     </div>
      <div  class="col-md-6 col-xs-6 col-sm-6" >
       <div class="form-group"><label class="control-label col-5" for="nama_customer">Nama Customer : </label>
 	   <label class="control-label col-6" style="font-size: 12px;color: #000000;"><?php echo $r['nama_customer'] ?></label></div>
	   <div class="form-group"><label class="control-label col-5" for="nama_customer">Alamat : </label>
	   <label  class="control-label col-6" style="font-size: 12px;color: #000000;"><?php echo $r['alamat'] ?></label></div>
		<div class="form-group"><label class="control-label col-5" for="nama_customer">No Telp : </label>
	   <label class="control-label col-6"  style="font-size: 12px;color: #000000;"><?php echo $r['no_telp'] ?></label></div>
		</div>
	</div>

<?php
}

elseif($op=='dt_lgn')
{
	$id_cs=$_GET['id_cs'];
    $brg=mysqli_query($con,"select * from detail_lgn WHERE id_customer='$id_cs' ORDER BY tgl_transaksi DESC");
   
    echo "<thead>
            <tr>
            	<td>No Nota</td>
                <td>tgl transaksi</td>
                <td>Jumlah</td>
                <td>Jenis Transaksi</td>
 <td>Cara Bayar</td>
                
               </tr>
        </thead>";
    while($r=mysqli_fetch_array($brg)){
    	 $harga       = rupiah($r['jumlah_transaksi']);
    	if($r['jenis_transaksi']==TRUE) {
    			$jenis = "deposit";
   				} else {
		      $jenis = "pemakaian";}
        echo "<tr>
        		<td>$r[no_nota]</td>
                <td>$r[tgl_transaksi]</td>
                <td>$harga</td>
                <td>$jenis</td>
              <td>$r[cara_bayar]</td>
            </tr>";
    }
}elseif($op=='cek'){
    $no_nota=$_GET['no_nota'];
    $sql=mysqli_query($con,"select * from detail_lgn where no_nota='$no_nota'");
    $cek=mysqli_num_rows($sql);
    echo $cek;
    }elseif($op=='telp'){
    $no_telp=$_GET['no_telp'];
    $sql=mysqli_query($con,"select * from customer where no_telp='$no_telp'");
    $cek=mysqli_num_rows($sql);
    echo $cek;}
    
 elseif($op=='member')
{
?><?PHP
	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
    $id_cs=$_GET['id_cs'];
    $sql=$con->query("select * from customer WHERE id = '$id_cs'");
	$r = $sql->fetch_assoc();
    ?>
    <div class="row equal">
     <div  class="col-md-6 col-xs-6 col-sm-6" style="font-size: 30px" >
	<div class="form-group">
	<div  class="col-md-7 col-md-offset-4 ">
		    <label style="font-size: 50px ;  background-color: #ccff00;  "><?php echo $r['poin'] ?></label>
            <input class="sisa" id="sisa" name="sisa" type="hidden"  readonly=true value="<?php echo $r['poin'] ?>" /> 
            </div></div>
     </div>
      <div  class="col-md-6 col-xs-6 col-sm-6" >
       <div class="form-group"><label class="control-label col-5" for="nama_customer">Nama Customer : </label>
 	   <label class="control-label col-6" style="font-size: 12px;color: #000000;"><?php echo $r['nama_customer'] ?></label></div>
	   <div class="form-group"><label class="control-label col-5" for="nama_customer">Alamat : </label>
	   <label  class="control-label col-6" style="font-size: 12px;color: #000000;"><?php echo $r['alamat'] ?></label></div>
		<div class="form-group"><label class="control-label col-5" for="nama_customer">No Telp : </label>
	   <label class="control-label col-6"  style="font-size: 12px;color: #000000;"><?php echo $r['no_telp'] ?></label></div>
		</div>
	</div>

<?php
}

elseif($op=='rc_member')
{
	$id_cs=$_GET['id_cs'];
    $brg=mysqli_query($con,"select * from transaksi_member WHERE id_customer='$id_cs' ORDER BY tgl_transaksi DESC");
   
    echo "<thead>
            <tr>
            	<td>No Nota</td>
                <td>tgl transaksi</td>
                <td>Jumlah</td>
                <td>Poin</td>
                <td>Jenis Transaksi</td>
                
               </tr>
        </thead>";
    while($r=mysqli_fetch_array($brg)){
    	 $harga       = rupiah($r['jumlah_transaksi']);
    	if($r['jenis_transaksi']==TRUE) {
    			$jenis = "tambah";
   				} else {
		      $jenis = "pemakaian";}
        echo "<tr>
        		<td>$r[no_nota]</td>
                <td>$r[tgl_transaksi]</td>
                <td>$harga</td>
                <td>$r[jumlah_poin]</td>
                <td>$jenis</td>
             
            </tr>";
    }
}   
elseif($op=='tambahpoin')
{
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
    $id_cs=$_GET['id_cs'];
    $jumlah=$_GET['jumlah'];
    $no_nota=$_GET['no_nota'];
    $total=$_GET['total'];
    $jenis="tambah";
    $poin=$_GET['poin'];
    
  
    $tambah=mysqli_query($con," update customer set poin='$total' WHERE id='$id_cs'");
    $tambah=mysqli_query($con,"insert into transaksi_member (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota,jumlah_poin) VALUES('1','$jumlah','$id_cs','$jam','$no_nota','$poin')");
    
    if($tambah)
    {
    	$edit = mysqli_query($con,"SELECT * FROM customer WHERE id='$id_cs'");
    	$r    = mysqli_fetch_array($edit);
    	 $jumlah=rupiah($_GET['jumlah']);
    	
    
       echo "<form method=POST >
          <input type=hidden name=id value=$r[id]>
          <table width=100%>
          <tr>
          <td style='width:50px'>
          Nama Customer
          </td>        
          <td> : $r[nama_customer]</td>
          </tr>
          
          <tr><td>
          No Nota</td>        
          <td> : $no_nota</td>
          </tr>
          <tr><td>
          Jenis :</td>        
          <td> : $jenis</td>
          </tr>
          <tr>
          <td>Transaksi</td> 
          <td> :  $jumlah</td>
          </tr>
          <tr>
          <td>Poin</td> 
          <td> :  $poin</td>
          </tr>
                    <tr>
          <td>Total Poin</td> 
          <td> :  $total</td>
          </tr>

          </table></form>";
    }else
    {
        echo "ERROR";
    }
}elseif($op=='belumspk')
{?>
	<table id="belumkembali" class="display">
		<thead>
		<tr>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Nama Customer</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT id, tgl_input,no_nota,nama_customer FROM reception where nama_outlet='$ot' and ambil=false and packing=false and kembali=false and spk=false and cuci=false and setrika=false ORDER BY tgl_input DESC" ;
			$tampil = mysqli_query($con, $query);
				while($data = mysqli_fetch_array($tampil)){
					?>
					
				<tr id="<?php echo $data['id']; ?>">
				<td>
				<?php echo $data['tgl_input']; ?></td>
				<td><?php echo $data['no_nota']; ?></td>
				<td><?php echo $data['nama_customer']; ?></td>
				<td align="center">
				<a class="btn btn-sm btn-danger" href="detail_spk.php?id=<?php echo $data['id']; ?>">pilih</a>
				</td>
				</tr>
				<?php } 
				?>
		</tbody>
	</table>
	 <script src="../lib/js/jquery-2.1.3.min.js"></script> <!-- Memasukkan plugin jQuery -->
  <script src="../lib/js/jquery.dataTables.min.js"></script> <!-- Memasukkan file jquery.dataTables.js -->
<script type="text/javascript">
		$(document).ready(function(){
			$('#belumkembali').dataTable();

		});
		</script>
	   
<?PHP
}
elseif($op=='rincian_spk')
{
	$id_cs=$_GET['id_cs'];
	$no_nota=$_GET['no_nota'];
	$qrep = mysqli_query($con,"select * from reception WHERE no_nota='SOBRG190508002'");
	$rrep = mysqli_fetch_array($qrep);
	if ($rrep['jenis']=='p'){
    $brg=mysqli_query($con,"select * from detail_spk WHERE no_nota='$no_nota'");
	$nbrg=mysqli_num_rows($brg);   
    echo "<thead>
            <tr>
            	<td>Label</td>
            	<td>No Nota</td>
                <td>Item</td>
                <td>Jumlah</td>
                <td>Hapus</td>
               </tr>
        </thead>";
		$i=1;
    while($r=mysqli_fetch_array($brg)){
    	$tgl =  date('d M');
    	echo "<tr id='$r[id]' >
        		<td>$i/$nbrg # $r[no_nota] # $tgl # $r[no_nota] # $i/$nbrg</td>
        		<td>$r[no_nota]</td>
                <td>$r[jenis_item]</td>
                <td>$r[jumlah]</td>
                <td><a class='hapus' id='$r[id]' style='cursor: pointer;'>hapus</a></td>
              </tr>";
			$i++;
    }
	}
	else{
    $brg=mysqli_query($con,"select * from detail_spk WHERE no_nota='$no_nota'");
	$nbrg=mysqli_num_rows($brg);   
    echo "<thead>
            <tr>
            	<td>No Nota</td>
                <td>Item</td>
                <td>Jumlah</td>
                <td>Hapus</td>
               </tr>
        </thead>";
		$i=1;
    while($r=mysqli_fetch_array($brg)){
    	$tgl =  date('d M');
    	echo "<tr id='$r[id]' >
        		<td>$r[no_nota]</td>
                <td>$r[jenis_item]</td>
                <td>$r[jumlah]</td>
                <td><a class='hapus' id='$r[id]' style='cursor: pointer;'>hapus</a></td>
              </tr>";
			$i++;
    }		
		}
    ?>
	<script>
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
  url: "del_detail_spk.php",
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
 
 elseif($op=='customerspk')
{
?><?PHP
	$id_cs=$_GET['id_cs'];
    $sql=$con->query("select * from reception WHERE id = '$id_cs' and spk=false");
	$r = $sql->fetch_assoc();
    ?>
    <div class="row equal">
     <div  class="col-md-6 col-xs-6 col-sm-6" >
       <div class="form-group"><label class="control-label col-5" for="nama_customer">Nama Customer : </label>
 	   <label class="control-label col-6" style="font-size: 12px;color: #000000;"><?php echo $r['nama_customer'] ?></label></div>
	   <div class="form-group"><label class="control-label col-5" for="nama_customer">Alamat : </label>
	   <label  class="control-label col-6" style="font-size: 12px;color: #000000;"><?php echo $r['no_nota'] ?></label></div>
		<div class="form-group"><label class="control-label col-5" for="nama_customer">No Telp : </label>
	   <label class="control-label col-6"  style="font-size: 12px;color: #000000;"><?php echo $r['jumlah'] ?></label></div>
		</div>
	</div>

<?php
}

elseif($op=='tambahspk')
{
    $jumlah=$_GET['jumlah'];
    $no_nota=$_GET['no_nota'];
    $jenis_item=$_GET['jenis_item'];
    
  
      $tambah=mysqli_query($con,"insert into detail_spk (jenis_item,no_nota,jumlah) VALUES('$jenis_item','$no_nota','$jumlah')");
    
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
    $sql5=$con->query("SELECT sum(jumlah) as total FROM detail_spk WHERE no_nota='$no_nota'");
$r = $sql5->fetch_assoc();
  $t=$r['total'];  
  
    if (empty($_GET['workshop'])) {
        if($ot=="Toddopuli" || $ot=="support") {
            $workshop = "Toddopuli";
            $tgl_workshop = $jam;
            $op_wk = $us;
        } else if($ot=="Antang") {
            $workshop = "Daya";
            $tgl_workshop = $jam;
            $op_wk = $us;
        } else {
            $workshop = "";
            $tgl_workshop = "0000-00-00 00:00:00";
            $op_wk = "";
        }
        
        $tambah=mysqli_query($con," update reception set spk='1',tgl_spk='$jam',rcp_spk='$us',jumlah='$t', workshop='$workshop',tgl_workshop='$tgl_workshop', op_workshop='$op_wk' WHERE no_nota='$no_nota'");
    }
    
    else {
        $tambah=mysqli_query($con," update reception set spk='1',tgl_spk='$jam',rcp_spk='$us',jumlah='$t' WHERE no_nota='$no_nota'");
    }
        
    //cek item setrika saja
    $qitem = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE item LIKE 'Setrika%' AND no_nota='$no_nota'");
  	$countI = mysqli_num_rows($qitem);
  	if($countI>0) {
  		$tambah .= mysqli_query($con, "UPDATE reception SET cuci='1', pengering='1' WHERE no_nota='$no_nota'");
  	}
    
    
    if($tambah)
    {

	 include"bar128.php";
    	$edit = mysqli_query($con,"SELECT * FROM reception a, customer b WHERE a.id_customer=b.id AND a.no_nota='$no_nota'");
    	$r    = mysqli_fetch_array($edit);

      $idcs = $r['id_customer'];

    	?>
 <div style="font-size: 12px; font-family: Arial" >
<div align="center" class="style1 style4">SPK</div>
<div align="center"> <?php echo bar128(stripslashes($no_nota))?></div>
 <div>
<?php
echo 'Nama : '.$r['nama_customer'].'<br>';
echo 'No Order : '.$no_nota.'<br>';
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
echo "harus di hitung manual";
				?>
				</td>
			</tr>
	
		
	</tbody>
</table>
</div>
<?php echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[user_id]";

$telp = $r['no_telp'];
$faktur = $r['no_faktur'];


require_once '../notifikasi_spk.php';
// Load Composer's autoloader
require '../../phpmailer/vendor/autoload.php';

?>
<?php

    }else
    {
        echo "ERROR";
    }
}
   
?>

