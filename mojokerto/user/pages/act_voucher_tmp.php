<?php
include '../../../config.php';
session_start();
$ot = $_SESSION['nama_outlet'];
date_default_timezone_set('Asia/Jakarta');
$jam1 = date("Y-m-d H:i:s");
$tgl = date("Y-m-d");
 if (isset($_GET['jenis'])){
	 $jenis = $_GET['jenis'];
	 }
 if (isset($_GET['id'])){
	 $id_cs = $_GET['id'];
	 }
 if (isset($_GET['voucher'])){
	 $voucher = $_GET['voucher'];
	 }
 $diskon = 0;

 $qtmp = mysqli_query($con, "select * from order_tmp where id_customer='$id_cs'");
 $ntmp = mysqli_num_rows($qtmp);
 $qtmp1 = mysqli_query($con, "select * from order_potongan_tmp where id_customer='$id_cs'");
 $ntmp1 = mysqli_num_rows($qtmp1);
 if ($ntmp1>0){
	//menghapus data sebelumnya
	$xtmp = mysqli_fetch_array($qtmp1);
	$hapustmp = mysqli_query($con, "delete from detail_penjualan where no_nota='$xtmp[no_nota]'");
	$hapustmp = mysqli_query($con, "delete from cris_icon_details where id_reception='$xtmp[no_nota]'");
	$hapustmp = mysqli_query($con, "delete from reception where no_nota='$xtmp[no_nota]'");

	$qtmp1 = mysqli_query($con, "SELECT * FROM `order_potongan_tmp` WHERE  id_customer = '$id_cs'");
	while ($rtmp = mysqli_fetch_array($qtmp1)){
 	$no_nota = $rtmp['no_nota'];
	//memindahkan data dari tabel order_tmp
	$total = $rtmp['harga']*$rtmp['jumlah'];
	mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rtmp[item]', '$rtmp[harga]', '$rtmp[jumlah]', '$total', '$rtmp[no_nota]', '$id_cs', '$rtmp[berat]', '$rtmp[ket]')");
	}
	$qtmp1 = mysqli_query($con, "SELECT * FROM `order_potongan_tmp` WHERE  id_customer = '$id_cs'");
	$rtmp = mysqli_fetch_array($qtmp1);
			$hargacharge = $rtmp['charge']*15000;
		if ($rtmp['charge']=='1'){
			$ketcharge = "Express";
			$qact = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$ketcharge', '$hargacharge', '1', '$hargacharge', '$rtmp[no_nota]', '$id_cs', '0', '$rtmp[ket]')");
			}
		if ($rtmp['charge']=='2'){
			$ketcharge = "Double Express";
			$qact = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$ketcharge', '$hargacharge', '1', '$hargacharge', '$rtmp[no_nota]', '$id_cs', '0', '$rtmp[ket]')");
			}
		if ($rtmp['charge']=='3'){
			$ketcharge = "Super Express";
			$qact = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$ketcharge', '$hargacharge', '1', '$hargacharge', '$rtmp[no_nota]', '$id_cs', '0', '$rtmp[ket]')");
			}
		if ($rtmp['charge']=='0'){
			$ketcharge = "";
			}

		$qact = mysqli_query($con, "insert into cris_icon_details values ('', '$jam1', '$_SESSION[name]', '$xtmp[no_nota]', '$xtmp[no_nota]', '$xtmp[hanger_own]', '$xtmp[deliver]', '$xtmp[parfum]', '$xtmp[charge]', '$xtmp[hanger]', '$xtmp[hanger_plastic]', '$xtmp[no_nota]')");
		$qcus = mysqli_query($con, "select * from customer where id='$id_cs'");
		$rcus = mysqli_fetch_array($qcus);
		$nama_customer = $rcus['nama_customer'];
		$qpriority = mysqli_query($con, "SELECT COUNT(*) AS orders FROM reception WHERE (tgl_input >= now()-interval 3 month) AND id_customer='$id_cs'");
	    $prioritydata = mysqli_fetch_array($qpriority);
	    if ($prioritydata['orders'] >= 9) $priority = 1; else $priority = 0;
		$qact = mysqli_query($con, "insert into reception(new_nota, nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon,priority) values ('$xtmp[new_nota]', '$ot', '$_SESSION[name]', '$jam1', '$nama_customer', '$xtmp[no_nota]', 'p', '$xtmp[charge]', '$xtmp[no_so]', '$id_cs', '0', '$xtmp[cabang]', '$xtmp[ket]', '$xtmp[berat]', '$voucher', '', '$priority')");
 }
 if ($ntmp>0)
 {
 $rtmp = mysqli_fetch_array($qtmp);
 $no_nota = $rtmp['no_nota'];
//menghapus data sebelumnya
 $qtmp = mysqli_query($con, "delete from detail_penjualan where no_nota='$rtmp[no_nota]'");
 $qtmp = mysqli_query($con, "delete from cris_icon_details where id_reception='$rtmp[no_nota]'");
 $qtmp = mysqli_query($con, "delete from reception where no_nota='$rtmp[no_nota]'");
 //memindahkan data dari tabel order_tmp
 $qact = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rtmp[item]', '$rtmp[harga]', '$rtmp[jumlah]', '$rtmp[harga]', '$rtmp[no_nota]', '$id_cs', '$rtmp[berat]', '$rtmp[ket]')");
	 if ($rtmp['charge']=='1'){
		$hargacharge = $rtmp['charge']*15000;
	 	$ketcharge = "Express";
		$qact = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$ketcharge', '$hargacharge', '1', '$hargacharge', '$rtmp[no_nota]', '$id_cs', '0', '$rtmp[ket]')");
		 }
	 if ($rtmp['charge']=='2'){
		$hargacharge = $rtmp['charge']*15000;
		$ketcharge = "Double Express";
		$qact = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$ketcharge', '$hargacharge', '1', '$hargacharge', '$rtmp[no_nota]', '$id_cs', '0', '$rtmp[ket]')");
		 }
	 if ($rtmp['charge']=='3'){
		$hargacharge = $rtmp['charge']*15000;
		$ketcharge = "Super Express";
		$qact = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$ketcharge', '$hargacharge', '1', '$hargacharge', '$rtmp[no_nota]', '$id_cs', '0', '$rtmp[ket]')");
		 }
	 if ($rtmp['charge']=='0'){
		 $ketcharge = "";
		 }
	$qact = mysqli_query($con, "insert into cris_icon_details values ('', '$jam1', '$_SESSION[name]', '$rtmp[no_nota]', '$rtmp[no_nota]', '$rtmp[hanger_own]', '$rtmp[deliver]', '$rtmp[parfum]', '$rtmp[charge]', '$rtmp[hanger]', '$rtmp[hanger_plastic]', '$rtmp[no_nota]')");

	$qcus = mysqli_query($con, "select * from customer where id='$id_cs'");
	$rcus = mysqli_fetch_array($qcus);
	$nama_customer = $rcus['nama_customer'];
	$qpriority = mysqli_query($con, "SELECT COUNT(*) AS orders FROM reception WHERE (tgl_input >= now()-interval 3 month) AND id_customer='$id_cs'");
    $prioritydata = mysqli_fetch_array($qpriority);
    if ($prioritydata['orders'] >= 9) $priority = 1; else $priority = 0;
	$qact = mysqli_query($con, "insert into reception(new_nota, nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon,priority) values ('$rtmp[new_nota]', '$ot', '$_SESSION[name]', '$jam1', '$nama_customer', '$rtmp[no_nota]', 'k', '$rtmp[charge]', '$rtmp[no_so]', '$id_cs', '0', '$rtmp[cabang]', '$rtmp[ket]', '$rtmp[berat]', '$voucher', '', '$priority')");
 }
	//akhir memindahkan data dari tabel order_tmp

 if ($voucher<>''){
	 $qharga = mysqli_query($con, "select sum(total) as total, sum(berat) as berat from detail_penjualan where no_nota='$rtmp[no_nota]' and item not like '%Express%' and item not like '%Hanger%' and item not like '%Voucher%' and item not like '%Flat%'");
	 $rharga = mysqli_fetch_array($qharga);
	 $harga = $rharga['total'];
	 $berat = $rharga['berat'];

	$sql     = mysqli_query($con, "select * from voucher_lucky where no_voucher='$voucher' and aktif='0'");
	$cek     = mysqli_num_rows($sql);

	$sql1     = mysqli_query($con,"select * from mjk_voucher_berkala where kode_voucher='$voucher' and status='aktif' and periode_awal<='$tgl' and periode_akhir>='$tgl' and minimal<='$harga' and maksimal>='$harga'");
	$d1=mysqli_fetch_array($sql1);
	$cek1     = mysqli_num_rows($sql1);

	$newhari = date("l");
	$sql2     = mysqli_query($con,"select * from mjk_kode_promo where kode='$voucher' and status='Aktif' and hari like '%$newhari%' and minimum_transaksi<='$harga' and maksimum_transaksi>='$harga'");
	$d2=mysqli_fetch_array($sql2);
	$cek2     = mysqli_num_rows($sql2);

	$sql3     = mysqli_query($con,"select * from mjk_promo_flat where kode='$voucher' and status='Aktif' and hari like '%$newhari%' and minimum_berat<='$berat' and maksimum_berat>='$berat'");
	$d3=mysqli_fetch_array($sql3);
	$cek3     = mysqli_num_rows($sql3);

	$sql4     = mysqli_query($con,"select * from voucher_rupiah where kode='$voucher' and status='Aktif' and tgl_akhir >= '$tgl'");
	$d4=mysqli_fetch_array($sql4);
	$cek4     = mysqli_num_rows($sql4);

	$sql5     = mysqli_query($con,"select * from voucher_recovery where kode='$voucher' and status='Aktif' and tgl_akhir >= '$tgl'");
	$d5=mysqli_fetch_array($sql5);
	$cek5     = mysqli_num_rows($sql5);

  $outlets = explode(";",mysqli_fetch_array(mysqli_query($con,"SELECT value FROM settings WHERE name='outlet_referral'"))[0]);
  if (in_array($ot,$outlets)) {
	$sql6 = mysqli_query($con,"select * from customer where kode_referral='$voucher' OR kode_referral_baru='$voucher'");
  	$d6 = mysqli_fetch_array($sql6);
  	$cek6 = mysqli_num_rows($sql6);
  } else $cek6 = 0;

	if (($cek<1) and ($cek1<1) and ($cek2<1) and ($cek3<1) and ($cek4<1) and ($cek5<1) and ($cek6<1)){
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan ..!');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $rtmp['no_nota'];?>#popup12";
	 </script>
     <?php
	}
	else if ($cek>0){
	$d=mysqli_fetch_array($sql);
	$potongan = $d['disk'];
	 if ($harga<=30000){
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan! Nilai Transaksi dibawah Rp. 30.000');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $rtmp['no_nota'];?>#popup12";
	 </script>
     <?php
	 }
	 else{
		 $qv = mysqli_query($con, "select * from voucher_lucky where no_voucher='$voucher'");
		 $rv = mysqli_fetch_array($qv);
		 $diskon = $harga*$rv['disk'];
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $rv[no_voucher]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");
		  if (($rv['jenis_voucher'] == 'RV') and ($rv['kali'] <= 10 )){
			 $baru = $rv['kali']+1;
			 $qvouc1 = mysqli_query($con, "update voucher_lucky set kali='$baru' where no_voucher='$voucher'");
		  }
	      else{
			 $qvouc1 = mysqli_query($con, "update voucher_lucky set aktif='1' where no_voucher='$voucher'");
			 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[name]', '$voucher', '$id_cs', '$_SESSION[nama_outlet]')");
		  }
		?>
		<script type="text/javascript">
		 alert("Data telah terinput!");
		 location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $rtmp['no_nota'];?>#popup12";
		</script>
		<?php
	 }
	}
	else if ($cek1>0){
	 $diskon = $harga*$d1['diskon']/100;
	 if (($d1['outlet']=='ALL') and ($d1['kategori']=='ALL')){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $d1[kode_voucher]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");
	 }
	 else if (($d1['outlet']=='ALL') and ($d1['kategori']==$jenis)){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $d1[kode_voucher]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");
	 }
	 else if (($d1['outlet']==$ot) and ($d1['kategori']=='ALL')){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $d1[kode_voucher]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");
	 }
	 else if (($d1['outlet']==$ot) and ($d1['kategori']==$jenis)){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $d1[kode_voucher]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");
	 }
	 else{
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan!!!!!!');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 }
	 $qvouc1 = mysqli_query($con, "update mjk_voucher_berkala set status='Tidak Aktif' where kode_voucher='$d1[kode_voucher]'");
	 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[name]', '$d1[kode_voucher]', '$id_cs', '$_SESSION[nama_outlet]')");
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher Digunakan!');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 //menghapus data tmp
//	 $qtmp = mysqli_query($con, "delete from order_potongan_tmp where id_customer='$id_cs'");
//	 $qtmp = mysqli_query($con, "delete from order_tmp where id_customer='$id_cs'");
	}
	else if ($cek2>0){
	 $diskon = $harga*$d2['diskon']/100;
	 if (($d2['outlet']=='ALL') and ($d2['kategori']=='ALL')){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $d2[kode]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");
	 }
	 else if (($d2['outlet']=='ALL') and ($d2['kategori']==$jenis)){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $d2[kode]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");
	 }
	 else if (($d2['outlet']==$ot) and ($d2['kategori']=='ALL')){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $d2[kode]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");
	 }
	 else if (($d2['outlet']==$ot) and ($d2['kategori']==$jenis)){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $d2[kode]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");
	 }
	 else{
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan!!!!!!');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 }
//	 $qvouc1 = mysqli_query($con, "update mjk_voucher_berkala set status='Tidak Aktif' where kode_voucher='$d1[kode_voucher]'");
	 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[name]', '$d2[kode]', '$id_cs', '$_SESSION[nama_outlet]')");
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher Digunakan!\n');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 //menghapus data tmp
//	 $qtmp = mysqli_query($con, "delete from order_potongan_tmp where id_customer='$id_cs'");
//	 $qtmp = mysqli_query($con, "delete from order_tmp where id_customer='$id_cs'");
	}

	else if ($cek4>0){
	 $diskon = $d4['nilai'];
	 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher Rupiah $d4[kode]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");

	 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[name]', '$d4[kode]', '$id_cs', '$_SESSION[nama_outlet]')");
	 $sql999    = mysqli_query($con,"update voucher_rupiah set status='Terpakai' where kode='$voucher'");
	 ?>

         <script type="text/javascript">
	  alert('Kode Voucher Digunakan!\n');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
        <?php
	}

	else if ($cek5>0){
	 $diskon = $d5['nilai'];
	 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher Recovery $d5[kode]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");

	 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[name]', '$d5[kode]', '$id_cs', '$_SESSION[nama_outlet]')");
	 $sql998    = mysqli_query($con,"update voucher_recovery set status='Terpakai' where kode='$voucher'");
	 ?>

         <script type="text/javascript">
	  alert('Kode Voucher Digunakan!\n');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
        <?php
	}

	else if ($cek3>0){
	 $flat = $d3['flat'];
	 if (($d3['outlet']=='ALL') and ($d3['kategori']=='ALL')){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Promo Flat $d3[kode]', '$flat', '1', '$flat', '$no_nota', '$id_cs', '0', 'Promo Flat $d3[kode]')");
		 $ubah = mysqli_query($con, "select * from detail_penjualan where no_nota='$no_nota' and berat>0");
		 while ($rubah = mysqli_fetch_array($ubah)){
			 $hargabaru = $flat*$rubah['berat'];
			 $totalbaru = $hargabaru*$rubah['jumlah'];
			 $qharga = mysqli_query($con, "update detail_penjualan set harga='$hargabaru', total='$totalbaru' where id='$rubah[id]'");
			 }
	 }
	 else if (($d3['outlet']=='ALL') and ($d3['kategori']==$jenis)){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Promo Flat $d3[kode]', '$flat', '1', '$flat', '$no_nota', '$id_cs', '0', 'Promo Flat $d3[kode]')");
		 $ubah = mysqli_query($con, "select * from detail_penjualan where no_nota='$no_nota' and berat>0");
		 while ($rubah = mysqli_fetch_array($ubah)){
			 $hargabaru = $flat*$rubah['berat'];
			 $totalbaru = $hargabaru*$rubah['jumlah'];
			 $qharga = mysqli_query($con, "update detail_penjualan set harga='$hargabaru', total='$totalbaru' where id='$rubah[id]'");
			 }
	 }
	 else if (($d3['outlet']==$ot) and ($d3['kategori']=='ALL')){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Promo Flat $d3[kode]', '$flat', '1', '$flat', '$no_nota', '$id_cs', '0', 'Promo Flat $d3[kode]')");
		 $ubah = mysqli_query($con, "select * from detail_penjualan where no_nota='$no_nota' and berat>0");
		 while ($rubah = mysqli_fetch_array($ubah)){
			 $hargabaru = $flat*$rubah['berat'];
			 $totalbaru = $hargabaru*$rubah['jumlah'];
			 $qharga = mysqli_query($con, "update detail_penjualan set harga='$hargabaru', total='$totalbaru' where id='$rubah[id]'");
			 }
	 }
	 else if (($d3['outlet']==$ot) and ($d3['kategori']==$jenis)){
		 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Promo Flat $d3[kode]', '$flat', '1', '$flat', '$no_nota', '$id_cs', '0', 'Promo Flat $d3[kode]')");
		 $ubah = mysqli_query($con, "select * from detail_penjualan where no_nota='$no_nota' and berat>0");
		 while ($rubah = mysqli_fetch_array($ubah)){
			 $hargabaru = $flat*$rubah['berat'];
			 $totalbaru = $hargabaru*$rubah['jumlah'];
			 $qharga = mysqli_query($con, "update detail_penjualan set harga='$hargabaru', total='$totalbaru' where id='$rubah[id]'");
			 }
	 }
	 else{
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan!!!!!!');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 }
//	 $qvouc1 = mysqli_query($con, "update mjk_voucher_berkala set status='Tidak Aktif' where kode_voucher='$d1[kode_voucher]'");
	 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[name]', '$d3[kode]', '$id_cs', '$_SESSION[nama_outlet]')");
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher Digunakan!');
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 //menghapus data tmp
//	 $qtmp = mysqli_query($con, "delete from order_potongan_tmp where id_customer='$id_cs'");
//	 $qtmp = mysqli_query($con, "delete from order_tmp where id_customer='$id_cs'");
	} else if ($cek6>0) {
      $kasihdiskon = false;
      if ($d6['id'] == $id_cs && $d6['diskon_terpakai']==false && $d6['kode_terpakai']==true) {
        $kasihdiskon = true;
      } else if ($d6['id'] != $id_cs) {
        if ($rcus['referrer']==null && $rcus['kode_referral_baru']==null) {
          $kasihdiskon = true;
        } else {
          ?>
          <script type="text/javascript">
         alert('Customer sudah pernah menggunakan kode referral sebelumnya!\n');
         location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
        </script>
        <?php
        }
      }

      if ($kasihdiskon) {
        $persendiskon = (int)$d6['nilai_diskon'];
        $diskon = $persendiskon/100 * $harga;
        $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher Referral $voucher', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', '$voucher')");
        ?>
        <script type="text/javascript">
       alert('Kode Voucher Digunakan!\n');
       location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
      </script>
      <?php
    } else {
       ?>
         <script type="text/javascript">
        alert('Kode Voucher tidak dapat digunakan!!!!!!');
        location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
       </script>
         <?php
     }
  }
}
  else{
	 ?>
     <script type="text/javascript">
	  location.href="transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
  }

?>
