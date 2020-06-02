<?php
include '../../config.php';
session_start();
$ot = $_SESSION['nama_outlet'];
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d H:i:s");
$tgl = date("Y-m-d");
$tanggalkemarin = date('Y-m-d', strtotime('-1 day', strtotime($tgl)));
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

 $qtmp = mysqli_query($con, "SELECT * from order_tmp where id_customer='$id_cs' AND cabang<>'Delivery'");
 $ntmp = mysqli_num_rows($qtmp);
 $qtmp1 = mysqli_query($con, "SELECT * from order_potongan_tmp where id_customer='$id_cs' AND cabang<>'Delivery'");
 $ntmp1 = mysqli_num_rows($qtmp1);
 if ($ntmp1>0){
	//menghapus data sebelumnya
	$xtmp = mysqli_fetch_array($qtmp1);
	$hapustmp = mysqli_query($con, "delete from detail_penjualan where no_nota='$xtmp[no_nota]'");
	$hapustmp = mysqli_query($con, "delete from cris_icon_details where id_reception='$xtmp[no_nota]'");
	$hapustmp = mysqli_query($con, "delete from reception where no_nota='$xtmp[no_nota]'");

	$qtmp1 = mysqli_query($con, "SELECT * FROM `order_potongan_tmp` WHERE  id_customer = '$id_cs' AND cabang<>'Delivery'");
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

		$qact = mysqli_query($con, "insert into cris_icon_details values ('', '$jam1', '$_SESSION[user_id]', '$xtmp[no_nota]', '$xtmp[no_nota]', '$xtmp[hanger_own]', '$xtmp[deliver]', '$xtmp[parfum]', '$xtmp[charge]', '$xtmp[hanger]', '$xtmp[hanger_plastic]', '$xtmp[no_nota]')");
		$qcus = mysqli_query($con, "select * from customer where id='$id_cs'");
		$rcus = mysqli_fetch_array($qcus);
		$nama_customer = $rcus['nama_customer'];
		$omsbfr = mysqli_query($con, "SELECT SUM(a.total_bayar) as omsbefore FROM reception a, outlet b where a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND a.tgl_input like '%$tanggalkemarin%'");
		$ctrlprior = mysqli_query($con, "select omset_maks from control_priority");
		$rsltomset = mysqli_fetch_array($omsbfr);
		$rsltprior = mysqli_fetch_array($ctrlprior);
		$qpriority = mysqli_query($con, "SELECT COUNT(*) AS orders FROM reception WHERE (tgl_input >= now()-interval 3 month) AND id_customer='$id_cs'");
	    $prioritydata = mysqli_fetch_array($qpriority);
	    if ($prioritydata['orders'] >= 9 && $rsltomset['omsbefore']>=$rsltprior['omset_maks']) $priority = 1; else $priority = 0;

	    $kat_item = mysqli_fetch_array(mysqli_query($con, "SELECT kategory FROM item_spk WHERE nama_item='$rtmp[item]'"))[0];

	    
		if($kat_item=='4' OR $kat_item=='5' OR $kat_item=='6'){
			$katItem = "P1";
		}
		else if($kat_item=='7'){
			$katItem = "P2";
		}
		else if($kat_item=='8' OR $kat_item=='9'){
			$katItem = "P3";
		}

		$qact = mysqli_query($con, "insert into reception(new_nota, nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon,priority,kategori_item) values ('$xtmp[new_nota]', '$ot', '$_SESSION[user_id]', '$jam1', '$nama_customer', '$xtmp[no_nota]', 'p', '$xtmp[charge]', '$xtmp[no_so]', '$id_cs', '0', '$xtmp[cabang]', '$xtmp[ket]', '$xtmp[berat]', '$voucher', '', '$priority','$katItem')");




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
	$qact = mysqli_query($con, "insert into cris_icon_details values ('', '$jam1', '$_SESSION[user_id]', '$rtmp[no_nota]', '$rtmp[no_nota]', '$rtmp[hanger_own]', '$rtmp[deliver]', '$rtmp[parfum]', '$rtmp[charge]', '$rtmp[hanger]', '$rtmp[hanger_plastic]', '$rtmp[no_nota]')");

	$qcus = mysqli_query($con, "select * from customer where id='$id_cs'");
	$rcus = mysqli_fetch_array($qcus);
	$nama_customer = $rcus['nama_customer'];
	$omsbfr = mysqli_query($con, "select sum(total_bayar) as omsbefore from reception where tgl_input like '%$tanggalkemarin%' and nama_outlet<>'mojokerto' ");
	$ctrlprior = mysqli_query($con, "select omset_maks from control_priority");
	$rsltomset = mysqli_fetch_array($omsbfr);
	$rsltprior = mysqli_fetch_array($ctrlprior);
	$qpriority = mysqli_query($con, "SELECT COUNT(*) AS orders FROM reception WHERE (tgl_input >= now()-interval 3 month) AND id_customer='$id_cs'");
	$prioritydata = mysqli_fetch_array($qpriority);
	if ($prioritydata['orders'] >= 9 && $rsltomset['omsbefore']>=$rsltprior['omset_maks']) $priority = 1; else $priority = 0;
	$qact = mysqli_query($con, "insert into reception(new_nota, nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon,priority,kategori_item) values ('$rtmp[new_nota]', '$ot', '$_SESSION[user_id]', '$jam1', '$nama_customer', '$rtmp[no_nota]', 'k', '$rtmp[charge]', '$rtmp[no_so]', '$id_cs', '0', '$rtmp[cabang]', '$rtmp[ket]', '$rtmp[berat]', '$voucher', '', '$priority','K')");
 }
	//akhir memindahkan data dari tabel order_tmp


 if ($voucher<>''){
	 $qharga = mysqli_query($con, "select sum(total) as total, sum(berat) as berat from detail_penjualan where no_nota='$rtmp[no_nota]' and item not like '%Express%' and item not like '%Hanger%' and item not like '%Voucher%' and item not like '%Flat%'");
	 $rharga = mysqli_fetch_array($qharga);
	 $harga = $rharga['total'];
	 $berat = $rharga['berat'];


	$sql     = mysqli_query($con, "select * from voucher_lucky where no_voucher='$voucher' and aktif='0'");
	$cek     = mysqli_num_rows($sql);

	$sql1     = mysqli_query($con,"select * from voucher_berkala where kode_voucher='$voucher' and status='aktif' and periode_awal<='$tgl' and periode_akhir>='$tgl' and minimal<='$harga' and maksimal>='$harga'");
	$d1=mysqli_fetch_array($sql1);
	$cek1     = mysqli_num_rows($sql1);

	$newhari = date("l");
	$sql2     = mysqli_query($con,"select * from kode_promo where kode='$voucher' and status='Aktif' and hari like '%$newhari%' and minimum_transaksi<='$harga' and maksimum_transaksi>='$harga'");
	$d2=mysqli_fetch_array($sql2);
	$cek2     = mysqli_num_rows($sql2);

	$sql3     = mysqli_query($con,"select * from promo_flat where kode='$voucher' and status='Aktif' and hari like '%$newhari%' and minimum_berat<='$berat' and maksimum_berat>='$berat'");
	$d3=mysqli_fetch_array($sql3);
	$cek3     = mysqli_num_rows($sql3);

	$sql4     = mysqli_query($con,"select * from voucher_rupiah where kode='$voucher' and status='Aktif' and tgl_akhir >= '$tgl'");
	$d4=mysqli_fetch_array($sql4);
	$cek4     = mysqli_num_rows($sql4);

	$sql5     = mysqli_query($con,"select * from voucher_recovery where kode='$voucher' and status='Aktif' and tgl_akhir >= '$tgl'");
	$d5=mysqli_fetch_array($sql5);
	$cek5     = mysqli_num_rows($sql5);
	
	$sql7     = mysqli_query($con,"select * from member_mahasiswa where stambuk_mahasiswa='$voucher' and status='aktif' and outlet='$ot' AND kuota>='$rtmp[berat]'");
	$d7=mysqli_fetch_array($sql7);
	$cek7     = mysqli_num_rows($sql7);

	$sql8     = mysqli_query($con,"select * from voucher_kiloan where kode='$voucher' AND tgl_akhir>='$tgl' AND berat>='$berat'");
	$d8=mysqli_fetch_array($sql8);
	$cek8     = mysqli_num_rows($sql8);

	$sql9     = mysqli_query($con,"SELECT * from voucher_cashback_order where kode_voucher='$voucher' AND mulai<='$tgl' AND akhir>='$tgl' AND id_customer='$id_cs' AND status=false");
	$d9=mysqli_fetch_array($sql9);
	$cek9     = mysqli_num_rows($sql9);

	$sql10     = mysqli_query($con,"SELECT * from telemarketer_sms_upload a, telemarketer_kode_promo b where a.id_kode_promo=b.id AND b.kode_promo='$voucher' AND b.berlaku_sampai>='$tgl' AND b.status=true AND (b.kota='Makassar' OR b.kota='All') AND (b.outlet='All' OR b.outlet='$ot') AND b.min_order<='$harga' AND a.id_customer='$id_cs'");
	$d10=mysqli_fetch_array($sql10);
	$cek10     = mysqli_num_rows($sql10);

	$sql11     = mysqli_query($con,"SELECT * from telemarketer_kode_promo where kode_promo='$voucher' and berlaku_sampai>='$tgl' AND status=true AND (kota='Makassar' OR kota='All') AND (outlet='$ot' OR outlet='All') AND min_order<='$harga'");
	$d11 = mysqli_fetch_array($sql11);
	$cek11     = mysqli_num_rows($sql11);


  $outlets = explode(";",mysqli_fetch_array(mysqli_query($con,"SELECT value FROM settings WHERE name='outlet_referral'"))[0]);
  if (in_array($ot,$outlets)) {
	$sql6 = mysqli_query($con,"select * from customer where kode_referral='$voucher' OR kode_referral_baru='$voucher'");
  	$d6 = mysqli_fetch_array($sql6);
  	$cek6 = mysqli_num_rows($sql6);
  } else $cek6 = 0;

	if (($cek<1) and ($cek1<1) and ($cek2<1) and ($cek3<1) and ($cek4<1) and ($cek5<1) and ($cek6<1) and ($cek7<1) and ($cek8<1) and ($cek9<1) and ($cek10<1) and ($cek11<1)){
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan ..!');
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $rtmp['no_nota'];?>#popup12";
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
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $rtmp['no_nota'];?>#popup12";
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
			 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[user_id]', '$voucher', '$id_cs', '$_SESSION[nama_outlet]')");
		  }
		?>
		<script type="text/javascript">
		 alert("Data telah terinput!");
		 location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $rtmp['no_nota'];?>#popup12";
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
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 }
	 $qvouc1 = mysqli_query($con, "update voucher_berkala set status='Tidak Aktif' where kode_voucher='$d1[kode_voucher]'");
	 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[user_id]', '$d1[kode_voucher]', '$id_cs', '$_SESSION[nama_outlet]')");
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher Digunakan!');
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 //menghapus data tmp
	 // $qtmp = mysqli_query($con, "DELETE from order_potongan_tmp where id_customer='$id_cs' AND cabang<>'Delivery'");
	 // $qtmp = mysqli_query($con, "DELETE from order_tmp where id_customer='$id_cs' AND cabang<>'Delivery'");
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
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 }
//	 $qvouc1 = mysqli_query($con, "update voucher_berkala set status='Tidak Aktif' where kode_voucher='$d1[kode_voucher]'");
	 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[user_id]', '$d2[kode]', '$id_cs', '$_SESSION[nama_outlet]')");
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher Digunakan!\n');
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 //menghapus data tmp
	 // $qtmp = mysqli_query($con, "DELETE from order_potongan_tmp where id_customer='$id_cs' AND cabang<>'Delivery'");
	 // $qtmp = mysqli_query($con, "DELETE from order_tmp where id_customer='$id_cs' AND cabang<>'Delivery'");
	}



	else if ($cek5>0){
	 $diskon = $d5['nilai'];
	 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher Recovery $d5[kode]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");

	 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[user_id]', '$d5[kode]', '$id_cs', '$_SESSION[nama_outlet]')");
	 $sql998    = mysqli_query($con,"update voucher_recovery set status='Terpakai' where kode='$voucher'");
	 ?>

         <script type="text/javascript">
	  alert('Kode Voucher Digunakan!\n');
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
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
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 }
//	 $qvouc1 = mysqli_query($con, "update voucher_berkala set status='Tidak Aktif' where kode_voucher='$d1[kode_voucher]'");
	 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[user_id]', '$d3[kode]', '$id_cs', '$_SESSION[nama_outlet]')");
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher Digunakan!');
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
	 //menghapus data tmp
	 // $qtmp = mysqli_query($con, "DELETE from order_potongan_tmp where id_customer='$id_cs' AND cabang<>'Delivery' ");
	 // $qtmp = mysqli_query($con, "DELETE from order_tmp where id_customer='$id_cs' AND cabang<>'Delivery' ");
	} 
	
	else if ($cek6>0) {
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
         location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
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
       location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
      </script>
      <?php
    } else {
       ?>
         <script type="text/javascript">
        alert('Kode Voucher tidak dapat digunakan!!!!!!');
        location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
       </script>
         <?php
     }
  }
  
  else if ($cek7>0){
  	if($rtmp['berat']<3){
  		?>
	     <script type="text/javascript">
		  alert('Kartu tidak bisa digunakan, Trx minimal 3 Kg!\n');
		  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
		 </script>
	     <?php
  	} else{
  		$flat = $d7['flat'];
  		$sisaKuota = $d7['kuota']-$rtmp['berat'];
			 if ($d7['kategori']==$jenis and $d7['id_customer']==$id_cs){
				 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Mahasiswa $d7[stambuk_mahasiswa]', '$flat', '1', '$flat', '$no_nota', '$id_cs', '0', 'Mahasiswa $d7[stambuk_mahasiswa]')");
				 $ubah = mysqli_query($con, "select * from detail_penjualan where no_nota='$no_nota' and berat>0");
				 while ($rubah = mysqli_fetch_array($ubah)){
					 $hargabaru = $flat*$rubah['berat'];
					 $totalbaru = $hargabaru*$rubah['jumlah'];
					 $qharga = mysqli_query($con, "update detail_penjualan set harga='$hargabaru', total='$totalbaru' where id='$rubah[id]'");		 
				 }

			 $potkuota = mysqli_query($con, "UPDATE member_mahasiswa SET kuota=$sisaKuota WHERE id_customer='$id_cs'");	
			 ?>
		     <script type="text/javascript">
			  alert('Kode Voucher Digunakan!\n');
			  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
			 </script>
		     <?php
						 
			 }
			 else if ('Potongan'==$jenis and $d7['id_customer']==$id_cs){
			 $diskon = $harga*25/100;
			 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher Recovery $d7[stambuk_mahasiswa]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher')");

			 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[user_id]', '$d7[stambuk_mahasiswa]', '$id_cs', '$_SESSION[nama_outlet]')");	
			 ?>

		      <script type="text/javascript">
				  alert('Kode Voucher Digunakan!\n');
				  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
			 </script>
		        <?php
			}
			 
			 else{
			 ?>
		     <script type="text/javascript">
			  alert('KTM tidak bisa digunakan');
			  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
			 </script>
		     <?php
			 }
	}

	//menghapus data tmp
	 // $qtmp = mysqli_query($con, "delete from order_potongan_tmp where id_customer='$id_cs'");
	 // $qtmp = mysqli_query($con, "delete from order_tmp where id_customer='$id_cs'");
  }
  else if($cek8>0){
  	$diskon = $harga;
  	$qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher Kiloan $d3[kode]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher Kiloan $d3[kode]')");
		
	 ?>
     <script type="text/javascript">
	  alert('Voucher  Digunakan!\n');
	  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
	 </script>
     <?php
  }
  else if($cek9>0){
  	$diskon = $d9['nominal'];
	if($diskon>$harga){
		$diskon = $harga;
	} 

	if(date('w')==1 OR date('w')==2 OR date('w')==3 OR date('w')==4){
		$qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher Cashback $d9[kode_voucher]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher Cashback $d9[kode_voucher]')");
	  	mysqli_query($con, "UPDATE voucher_cashback_order SET status='1' WHERE kode_voucher='$voucher' AND id_customer='$id_cs'");
			
		 ?>
	     <script type="text/javascript">
		  alert('Voucher  Digunakan!\n');
		  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
		 </script>
	     <?php
	 } else {
	 	?>
	     <script type="text/javascript">
		  alert('Voucher tidak berlaku hari ini!\n');
		  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
		 </script>
	     <?php
	 }

	  	
  
	}

	else if($cek10>0) {
		$kode = $d10['kode_promo'];
		$idKode = $d10['id_kode_promo'];
		$diskon = $d10['diskon']*$harga/100;
		$usingPromo = $d10['penggunaan_kode_promo'];
		$maxPromo = $d10['max_penggunaan'];
		$kategory = $d10['kategori_item'];
		$jenisOrder = ($jenis=="Potongan") ? "p" : "k";

		switch ($kategory) {
			case '5':
				$kat = "Beddings";
				break;
			case '6':
				$kat = "Clothes";
				break;
			case '7':
				$kat = "Dolls & Shoes";
				break;
			case '8':
				$kat = "Gordyn";
				break;
			case '9':
				$kat = "Carpet";
				break;
			case '4':
				$kat = "Pillow Case";
				break;
			default:
				$kat = "All";
				break;
		}

		if($usingPromo>=$maxPromo) {
			?>
			<script type="text/javascript">
				alert("Maaf, penggunaan sudah <?= $maxPromo ?> kali");
				location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";	
			</script>
			<?php
		}
		else {
            if($kategory=="All") {
                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$no_nota' AND jenis_item='$jenisOrder'");
            } else {
                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$no_nota' AND jenis_item='$jenisOrder' AND kategori_item='$kategory' ");
            }
			
			$ckat = mysqli_num_rows($qkat);

			if($ckat>0) {
				$using = $usingPromo+1;
				$qq = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher TLM $d10[kode_promo]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher TLM $d10[kode_promo]')");
				$qq = mysqli_query($con, "UPDATE telemarketer_sms_upload SET penggunaan_kode_promo='$using' WHERE id_customer='$id_cs' AND id_kode_promo='$idKode'");

				?>
		     <script type="text/javascript">
			  alert("<?= $using.' dari '.$maxPromo.' penggunaan' ?>");	
			   location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";	  
			 </script>
		     <?php	
			}
			else {
				?>
		     <script type="text/javascript">
			  alert("Maaf, berlaku untuk <?= $kategory ?>");	
			   location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";	  
			 </script>
		     <?php	
			}				

		}
	} 

	else if($cek11>0) {

		$kode = $d11['kode_promo'];
		$idKode = $d11['id'];
		$usingPromo = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(voucher) FROM reception WHERE voucher LIKE '$kode'"))[0];
		$maxPromo = $d11['max_penggunaan'];
		$kategory = $d11['kategori_item'];

		$jenisPromo = ($d11['flat']==0) ? "Diskon" : "Flat";

		switch ($jenisPromo) {
			case 'Flat':
				
				$qberat = mysqli_query($con, "SELECT SUM(berat), SUM(total), item FROM detail_penjualan WHERE no_nota='$no_nota'");
				$data = mysqli_fetch_array($qberat);

				if($data[0]==0){
					?>
					<script type="text/javascript">
						alert("Hanya berlaku untuk kiloan");	
					   location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
					</script>
					<?php
				}
				else{

					$item = $data['item'];

					if(strpos($item, "Setrika")=="12" && strpos($item, "Lipat")=="") {
						//$it = "CKS";
						$hargaNew = $d11['flat']*$data[0];
					} else if(strpos($item, "Setrika")=="0" && strpos($item, "Lipat")=="") {
						//$it = "SS";
						$hargaNew = ($d11['flat']-2000)*$data[0];
					} else if(strpos($item, "Setrika")=="0" && strpos($item, "Lipat")=="12") {
						//$it = "CKL";
						$hargaNew = ($d11['flat']-4000)*$data[0];
					}

					$diskon = ($data[1]-$hargaNew)*-1;
					$disc = $diskon*-1;

					$cekKontrols = $con->query("SELECT * FROM telemarketer_kontrol_kode_promo WHERE id_customer='$id_cs' AND id_kode_promo='$idKode'");

					if(mysqli_num_rows($cekKontrols)>0){
						$cekKontrol = $cekKontrols->fetch_array();
						$usingPromo = $cekKontrol['penggunaan'];
					} else {
						$usingPromo = 0;
					}

					if($usingPromo>=$maxPromo) 
					{
						?>
						<script type="text/javascript">
							alert("Batas penggunaan telah habis");	
						   location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
						</script>
						<?php
					}
					else
					{
						$using = $usingPromo+1;

						if(mysqli_num_rows($cekKontrols)>0) {
							$inKontrol = $con->query("UPDATE telemarketer_kontrol_kode_promo SET penggunaan='$using' WHERE id_kode_promo='$idKode' AND id_customer='$id_cs'");
						} else {
							$inKontrol = $con->query("INSERT INTO telemarketer_kontrol_kode_promo VALUES ('$idKode','$id_cs','$using')");
						}

						mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$jam1','Voucher $kode','$disc','1','$disc','$no_nota','$id_cs') ");
						mysqli_query($con, "UPDATE telemarketer_sms_upload SET penggunaan_kode_promo='$using' WHERE id_customer='$id_cs' AND id_kode_promo='$idKode'");
						mysqli_query($con, "UPDATE reception SET total_bayar='$hargaNew',diskon='$disc',voucher='$kode' WHERE no_nota='$no_nota'");	

						?>
					     <script type="text/javascript">
						  alert("<?= $using.' dari '.$maxPromo.' penggunaan' ?>");	
						   location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";	  
						 </script>
					     <?php	
					}


				}


				break;
			
			default:
				
				$diskon = $d11['diskon']*$harga/100;
				
				$jenisOrder = ($jenis=="Potongan") ? "p" : "k";

				$diskon = ($jenisOrder=="p" && $harga>30000) ? 30000 : $diskon; 

				$qcekcs = $con->query("SELECT * FROM telemarketer_sms_upload WHERE id_kode_promo='$idKode'");
				if(mysqli_num_rows($qcekcs)>0){
					?>
					<script type="text/javascript">
						alert("Maaf, hanya berlaku untuk Customer yang dikirimkan kode promo");
						location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";	
					</script>
					<?php
				}

				else {

					switch ($kategory) {
						case '5':
							$kat = "Beddings";
							break;
						case '6':
							$kat = "Clothes";
							break;
						case '7':
							$kat = "Dolls & Shoes";
							break;
						case '8':
							$kat = "Gordyn";
							break;
						case '9':
							$kat = "Carpet";
							break;
						case '4':
							$kat = "Pillow Case";
							break;
						default:
							$kat = "All";
							break;
					}

					$cekKontrols = $con->query("SELECT * FROM telemarketer_kontrol_kode_promo WHERE id_customer='$id_cs' AND id_kode_promo='$idKode'");
					if(mysqli_num_rows($cekKontrols)>0){
						$cekKontrol = $cekKontrols->fetch_array();
						$usingPromo = $cekKontrol['penggunaan'];
					}
					else {
						$usingPromo = 0;
					}

					if($usingPromo>=$maxPromo) {
						?>
						<script type="text/javascript">
							alert("Maaf, penggunaan sudah <?= $maxPromo ?> kali");
							location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";	
						</script>
						<?php
					}
					else {
			            if($kategory=="All") {
			                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$no_nota' AND jenis_item='$jenisOrder'");
			            } else {
			                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$no_nota' AND jenis_item='$jenisOrder' AND kategori_item='$kategory' ");
			            }
						
						$ckat = mysqli_num_rows($qkat);

						if($ckat>0) {
							$using = $usingPromo+1;
							if(mysqli_num_rows($cekKontrols)>0) {
								$inKontrol = $con->query("UPDATE telemarketer_kontrol_kode_promo SET penggunaan='$using' WHERE id_kode_promo='$idKode' AND id_customer='$id_cs'");
							} else {
								$inKontrol = $con->query("INSERT INTO telemarketer_kontrol_kode_promo VALUES ('$idKode','$id_cs','$using')");
							}
							$qq = mysqli_query($con, "INSERT INTO detail_penjualan values ('', '$jam1', 'Voucher TLM $d11[kode_promo]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0', 'Voucher TLM $d11[kode_promo]')");

							$qq .= mysqli_query($con, "UPDATE telemarketer_sms_upload SET penggunaan_kode_promo='$using' WHERE id_customer='$id_cs' AND id_kode_promo='$idKode'");
							$qq .= mysqli_query($con, "UPDATE reception SET total_bayar='$hargaNew',diskon='$diskon',voucher='$kode' WHERE no_nota='$no_nota'");	

							?>
					     <script type="text/javascript">
						  alert("<?= $using.' dari '.$maxPromo.' penggunaan' ?>");	
						   location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";	  
						 </script>
					     <?php	
						}
						else {
							?>
					     <script type="text/javascript">
						  alert("Maaf, berlaku untuk <?= $kategory ?>");	
						   location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";	  
						 </script>
					     <?php	
						}				

					}
				}

				break;
		}	

			
	} 
			
}

else{
 ?>
 <script type="text/javascript">
  location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>#popup12";
 </script>
 <?php
}

//hapus tabel kategori_item_order
mysqli_query($con, "DELETE FROM kategori_item_order WHERE no_nota='$no_nota'");

include_once 'voucher_cashback_order.php';

?>
