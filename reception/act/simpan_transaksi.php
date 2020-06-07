<?php 
require '../../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$us = $_SESSION['user_id'];
$ot = $_SESSION['nama_outlet'];
$kota = "Makassar";
$id = $_POST['id'];

$qcus = $con->query("SELECT * FROM customer WHERE id='$id'");
$rcus = $qcus->fetch_array();
$customer = $rcus['nama_customer'];

$jam1 = date("Y-m-d H:i:s");
$tanggalkemarin = date('Y-m-d', strtotime('-1 day', strtotime($jam1)));

$t = date('Y');
$m = date('m');
$d = date('d');
$h = date('H');
$i = date('i');

include '../code.php';

if ($_POST['nota']<>''){
 	$notanew = $_POST['nota'];
 	$nota = $notanew;
}
else{	
	$nota = $noso;
}

$cek_nota = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$nota' AND total_bayar>0 ");
if(mysqli_num_rows($cek_nota)>0){		
	echo '
	<script>alert("Nomor nota tidak bisa digunakan lagi, silahkan laporkan ke IT segera!");</script>
	';
} else{
	$nota = $nota;
}

$new_nota = $res['kode'].$t.$m.$d.$h.sprintf('%03s', $nextNoUrut1);
$ordertmp = ($_POST['layanan']=="Potongan") ? "order_potongan_tmp" : "order_tmp";
$jenis = $_POST['layanan'];
$charjenis = ($jenis=="Potongan") ? "p" : "k";

switch ($_POST['simpanlayanan']) {
	case 'cks':		
		$item = $_POST['item'];
		$harga = $_POST['harga'];
		$berat = $_POST['berat'];
		$jumlah = $_POST['jumlah'];
		$ket = $_POST['ket'];
		
		$cekdata = mysqli_query($con, "SELECT * FROM $ordertmp where id_customer='$id' AND cabang<>'Delivery'");
		$ncek = mysqli_num_rows($cekdata);

		if ($ncek>0){
			$qrincian = mysqli_query($con, "DELETE from order_tmp where id_customer = '$id' AND cabang<>'Delivery' ");
		}

		$qrincian = mysqli_query($con, "INSERT INTO $ordertmp (id, tgl, no_nota, no_so, id_customer, item, harga, jumlah, berat, hanger_own, deliver, parfum, charge, hanger, hanger_plastic, ket, new_nota,cabang) values ('', '$jam1', '$nota', '$noso', '$id', '$item', '$harga', '$jumlah', '$berat', 'false', 'off', '0', '0','0', '0', '$ket', '$new_nota','Makassar')");

		$kat_item = mysqli_fetch_array(mysqli_query($con, "SELECT kategori FROM item_harga WHERE nama_item LIKE '$item'"))[0];

    	if($kat_item=='p1'){
			$kat = "6";
		}
		else if($kat_item=='p2'){
			$kat = "7";
		}
		else if($kat_item=='p3'){
			$kat = "5";
		}
		else if($kat_item=='p4'){
			$kat = "9";
		}
		else if($kat_item=='p5'){
			$kat = "8";
		}
		else{
			$kat = "1";
		}

		$qrincian .= mysqli_query($con, "INSERT INTO kategori_item_order VALUES ('$nota','$charjenis','$kat','$jam1')");

		$vpacks = mysqli_query($con, "SELECT * FROM subkode_voucher_pack WHERE nama_item='$item' AND syarat_order<='$jumlah' AND gratis_order<>''");
		if(mysqli_num_rows($vpacks)>0){
			$dpack = mysqli_fetch_array($vpacks);
			$qrincian .=mysqli_query($con, "UPDATE pemilik_voucher_pack set status='1' WHERE id_customer='$id' AND id_subkode='$dpack[id_subkode]'");
		}
			

		echo $nota;

		break;
	
	case 'parfum':
		$parfum = $_POST['parfum'];
		if($parfum=="Normal") $parfum = "0";
		else if($parfum=="Extra") $parfum = "extra";
		else if($parfum=="Tanpa Parfum") $parfum = "no";
		$qrincian = mysqli_query($con, "UPDATE $ordertmp SET parfum='$parfum' WHERE no_nota='$nota' AND id_customer='$id'");
		$qrincian .= mysqli_query($con, "INSERT INTO rincian_pilihan_order VALUES ('','$nota','$id','$parfum','','','','')");
		break;

	case 'hanger':
		$hanger = ($_POST['hanger']=="") ? "0" : $_POST['hanger'];
		$plastikhanger = ($_POST['plastikhanger']=="") ? "0" : $_POST['plastikhanger'];
		$hangersendiri = ($_POST['hangersendiri']=="on") ? "on" : "false";
		$qrincian = mysqli_query($con, "UPDATE $ordertmp SET hanger_own='$hangersendiri', hanger='$hanger', hanger_plastic='$plastikhanger' WHERE no_nota='$nota' AND id_customer='$id'");
		$qrincian .= mysqli_query($con, "UPDATE rincian_pilihan_order SET hanger_own='$hangersendiri',hanger='$hanger',hanger_plastik='$plastikhanger' WHERE no_nota='$nota' AND id_customer='$id'");
		break;

	case 'express':
		$charge = ($_POST['charge']=="") ? "0" : $_POST['charge'];
		$qrincian = mysqli_query($con, "UPDATE $ordertmp SET charge='$charge' WHERE no_nota='$nota' AND id_customer='$id'");
		$qrincian .= mysqli_query($con, "UPDATE rincian_pilihan_order SET charge='$charge' WHERE no_nota='$nota' AND id_customer='$id'");

		/*Enter into tabel utama*/
		$idcs = $id;

		$qtmp = mysqli_query($con, "SELECT * FROM $ordertmp where id_customer='$idcs' AND cabang<>'Delivery'");
		$ntmp = mysqli_num_rows($qtmp);

		//menghapus data sebelumnya
		$rtmp = mysqli_fetch_array($qtmp);
		$hapustmp = mysqli_query($con, "delete from detail_penjualan where no_nota='$rtmp[no_nota]'");
		$hapustmp = mysqli_query($con, "delete from reception where no_nota='$rtmp[no_nota]'");

		$itemlike = $rtmp['item'];
		//diskon penyesuaian harga Lama
		$diskonharga = 0; 
		if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM outlet_harga a, outlet b WHERE a.id_outlet=b.id_outlet AND b.nama_outlet='$ot' AND ket_harga=false"))>0){
		    $qhargalama = mysqli_query($con, "SELECT * FROM item_spk WHERE nama_item='$itemlike' AND nama_item LIKE 'Cuci Kering Setrika%'");
    		if(mysqli_num_rows($qhargalama)>0 && $rcus['lgn']<1 && $rcus['type_c']<1){
    			$rhargalama = mysqli_fetch_array($qhargalama);
    			if($rcus['member']==1){
    				$diskonharga = $rtmp['harga'] - ($rhargalama['harga']*0.8);
    			}
    			else{
    				$diskonharga = $rtmp['harga'] - $rhargalama['harga'];
    			}      		
        
        		$updateD = mysqli_query($con, "INSERT INTO detail_penjualan  VALUES ('',NOW(),'Voucher Harga','$diskonharga','1','$diskonharga','$nota','$idcs','0','Voucher harga') ");
    		}
		}

		if($ntmp>0){
			$qtmp1 = mysqli_query($con, "SELECT * FROM $ordertmp where id_customer='$idcs' AND cabang<>'Delivery'");
			while ($rtmp1 = mysqli_fetch_array($qtmp1)){
				$nota = $rtmp1['no_nota'];
				$total = $rtmp1['harga']*$rtmp1['jumlah'];
				$berat = $rtmp1['berat'];
				mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rtmp1[item]', '$rtmp1[harga]', '$rtmp1[jumlah]', '$total', '$rtmp1[no_nota]', '$idcs', '$rtmp1[berat]', '$rtmp1[ket]')");
			}

			
			$hargacharge = $rtmp['charge']*15000;

			switch ($rtmp['charge']) {
				case '1': $ketcharge = "Express"; break;
				case '2': $ketcharge = "Double Express"; break;
				case '3': $ketcharge = "Super Express"; break;
				case '0': $ketcharge = ""; break;
			}

			if($ketcharge!=''){
				$qact = mysqli_query($con, "INSERT INTO detail_penjualan values ('', '$jam1', '$ketcharge', '$hargacharge', '1', '$hargacharge', '$rtmp[no_nota]', '$idcs', '$berat', '$rtmp[ket]')");
			}

			$omsbfr = mysqli_query($con, "SELECT SUM(a.total_bayar) as omsbefore FROM reception a, outlet b where a.nama_outlet=b.nama_outlet AND b.Kota='$kota' AND a.tgl_input like '%$tanggalkemarin%'");
			$ctrlprior = mysqli_query($con, "select omset_maks from control_priority");
			$rsltomset = mysqli_fetch_array($omsbfr);
			$rsltprior = mysqli_fetch_array($ctrlprior);
			$qpriority = mysqli_query($con, "SELECT COUNT(*) AS orders FROM reception WHERE (tgl_input >= now()-interval 3 month) AND id_customer='$idcs'");
		    $prioritydata = mysqli_fetch_array($qpriority);
		    if ($prioritydata['orders'] >= 9 && $rsltomset['omsbefore']>=$rsltprior['omset_maks']) $priority = 1; else $priority = 0;

		    if($jenis=="Potongan"){
		    	$kat_item = mysqli_fetch_array(mysqli_query($con, "SELECT kategori FROM item_harga WHERE nama_item='$rtmp[item]'"))[0];

		    	if($kat_item=='p1' OR $kat_item=='p3'){
					$katItem = "P1";
				}
				else if($kat_item=='p2'){
					$katItem = "P2";
				}
				else if($kat_item=='p4' OR $kat_item=='p5'){
					$katItem = "P3";
				}
			}
			else if($jenis=="Kiloan") $katItem = "K";

			$qact = mysqli_query($con, "INSERT INTO reception(new_nota, nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,priority,kategori_item) values ('$rtmp[new_nota]', '$ot', '$us', '$jam1', '$customer', '$rtmp[no_nota]', '$charjenis', '$rtmp[charge]', '$rtmp[no_so]', '$idcs', '0', '$rtmp[cabang]', '$rtmp[ket]', '$rtmp[berat]','$priority','$katItem')");
		    

		}

		break;

	case 'voucher':
		$voucher = $_POST['kode'];
		$nota = $_POST['nota'];
		$idcs = $id;
		if(!empty($voucher)){
			$tgl = date('Y-m-d');
			
			

			$qharga = mysqli_query($con, "SELECT SUM(total) AS total, SUM(berat) AS berat, item, jumlah FROM detail_penjualan WHERE no_nota='$nota' AND item NOT LIKE '%Express%' AND item NOT LIKE '%Hanger%' AND item NOT LIKE '%Voucher%' AND item NOT LIKE '%Flat%'");
			 $rharga = mysqli_fetch_array($qharga);
			 $harga = $rharga['total'];
			 $berat = $rharga['berat'];
			 $item = $rharga['item'];
			 $jumlah = $rharga['jumlah'];

			/*CashbackDariOrder*/
			$promo1 = mysqli_query($con,"SELECT * FROM voucher_cashback_order where kode_voucher='$voucher' AND mulai<='$tgl' AND akhir>='$tgl' AND id_customer='$idcs' AND status=false");
			$dpromo1 = mysqli_fetch_array($promo1);
			$cekpromo1 = mysqli_num_rows($promo1);

			/*TelemarketerCustomerYgDinotifikasi*/
			$promo2 = mysqli_query($con,"SELECT * FROM telemarketer_sms_upload a, telemarketer_kode_promo b where a.id_kode_promo=b.id AND b.kode_promo='$voucher' AND b.berlaku_sampai>='$tgl' AND b.status=true AND (b.kota='$kota' OR b.kota='All') AND (b.outlet='All' OR b.outlet='$ot') AND b.min_order<='$harga' AND a.id_customer='$idcs'");
			$dpromo2 = mysqli_fetch_array($promo2);
			$cekpromo2 = mysqli_num_rows($promo2);

			/*TelemarketerAllCustomer*/
			$promo3 = mysqli_query($con,"SELECT * FROM telemarketer_kode_promo where kode_promo='$voucher' AND status=true AND (kota='$kota' OR kota='All') AND (outlet='$ot' OR outlet='All') AND min_order<='$harga'");
			$dpromo3 = mysqli_fetch_array($promo3);
			$cekpromo3     = mysqli_num_rows($promo3);

			/*MemberMahasiswa*/
			$promo4 = mysqli_query($con,"select * from member_mahasiswa where stambuk_mahasiswa='$voucher' and status='aktif' and outlet='$ot' AND kuota>='$berat'");
			$dpromo4 = mysqli_fetch_array($promo4);
			$cekpromo4 = mysqli_num_rows($promo4);

			/*VoucherKiloan*/
			$promo5 = mysqli_query($con,"select * from voucher_kiloan where kode='$voucher' AND tgl_akhir>='$tgl' AND berat>='$berat'");
			$dpromo5 = mysqli_fetch_array($promo5);
			$cekpromo5 = mysqli_num_rows($promo5);

			$kodebaru = preg_replace('/[^a-zA-Z]/', '', $voucher);
			$promo6 = mysqli_query($con,"SELECT * from subkode_voucher_pack a, kode_voucher_pack b where a.id_kode=b.id_kode AND b.nama_kode='$kodebaru' AND status=true");
			$dpromo6 = mysqli_fetch_array($promo6);
			$cekpromo6 = mysqli_num_rows($promo6);


			
			if($cekpromo1>0)
			{
				$diskon = $dpromo1['nominal'];
				if($diskon>$harga){
					$diskon = $harga;
				} 

				if(date('w')==1 OR date('w')==2 OR date('w')==3 OR date('w')==4){
					$harganew = 
					$qrincian = mysqli_query($con, "INSERT INTO detail_penjualan VALUES ('', '$jam1', 'Voucher Cashback $voucher', '$diskon', '1', '$diskon', '$nota', '$idcs', '0', 'Voucher Cashback $voucher')");
				  	$qrincian .= mysqli_query($con, "UPDATE voucher_cashback_order SET status='1' WHERE kode_voucher='$voucher' AND id_customer='$idcs'");				  	
						
					 echo "Kode promo berlaku";
				 } else {
				 	echo "Kode promo tidak berlaku pada hari ini!!";
				 }
			}
			else if($cekpromo2>0) 
			{
				$idKode = $dpromo2['id_kode_promo'];
				$diskon = $dpromo2['diskon']*$harga/100;
				$usingPromo = $dpromo2['penggunaan_kode_promo'];
				$maxPromo = $dpromo2['max_penggunaan'];
				$kategory = $dpromo2['kategori_item'];

				switch ($kategory) {
					case '5': $kat = "Beddings"; break;
					case '6': $kat = "Clothes"; break;
					case '7': $kat = "Ransel & Shoes"; break;
					case '8': $kat = "Gordyn"; break;
					case '9': $kat = "Carpet"; break;
					case '4': $kat = "Pillow Case"; break;
					case '1': $kat = "Kiloan"; break;
					default: $kat = "All"; break;
				}

				if($usingPromo>=$maxPromo) 
				{
					echo "Maaf, penggunaan kode promo sudah ".$maxPromo;
				}
				else 
				{
		            if($kategory=="All") {
		                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$nota' AND jenis_item='$charjenis'");
		            } else {
		                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$nota' AND jenis_item='$charjenis' AND kategori_item='$kategory' ");
		            }
					
					$ckat = mysqli_num_rows($qkat);

					if($ckat>0) {
						$using = $usingPromo+1;
						$qq = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $voucher', '$diskon', '1', '$diskon', '$nota', '$idcs', '0', 'Voucher $voucher')");
						$qq = mysqli_query($con, "UPDATE telemarketer_sms_upload SET penggunaan_kode_promo='$using' WHERE id_customer='$idcs' AND id_kode_promo='$idKode'");
						echo $using.' dari '.$maxPromo.' penggunaan';	
					}
					else {
						echo "Kode promo hanya berlaku untuk ".$kat;
					}				

				}
			}
			else if($cekpromo3>0) 
			{
				$idKode = $dpromo3['id'];
				$tgl_berakhir = $dpromo3['berlaku_sampai'];
				
				if($tgl_berakhir>=$tgl)
				{
				    $usingPromo = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(voucher) FROM reception WHERE voucher LIKE '$voucher'"))[0];
    				$maxPromo = $dpromo3['max_penggunaan'];
    				$kategory = $dpromo3['kategori_item'];
    
    				$jenisPromo = ($dpromo3['flat']==0) ? "Diskon" : "Flat";
    
    				switch ($jenisPromo) {
    					case 'Flat':
                            
    						if($berat==0)
    						{
    							echo "Kode promo hanya untuk Kiloan";
    						}
    						else
    						{
    							
    							if(strpos($item, "Setrika")=="12" && strpos($item, "Lipat")=="") {
    								//$it = "CKS";
    								$hargaNew = $dpromo3['flat']*$berat;
    							} else if(strpos($item, "Setrika")=="0" && strpos($item, "Lipat")=="") {
    								//$it = "SS";
    								$hargaNew = ($dpromo3['flat']-2000)*$berat;
    							} else if(strpos($item, "Setrika")=="0" && strpos($item, "Lipat")=="12") {
    								//$it = "CKL";
    								$hargaNew = ($dpromo3['flat']-4000)*$berat;
    							}
    
    							$diskon = ($harga-$hargaNew)*-1;
    							$disc = $diskon*-1;
    
    							$cekKontrols = $con->query("SELECT * FROM telemarketer_kontrol_kode_promo WHERE id_customer='$idcs' AND id_kode_promo='$idKode'");
    
    							if(mysqli_num_rows($cekKontrols)>0){
    								$cekKontrol = $cekKontrols->fetch_array();
    								$usingPromo = $cekKontrol['penggunaan'];
    							} else {
    								$usingPromo = 0;
    							}
    
    							if($usingPromo>=$maxPromo) 
    							{
    								echo "Maaf, penggunaan kode promo sudah ".$maxPromo;
    							}
    							else
    							{   
    							    mysqli_query($con, "DELETE FROM detail_penjualan WHERE item LIKE 'Voucher Harga%' AND no_nota='$nota'");
    								$using = $usingPromo+1;
    
    								if(mysqli_num_rows($cekKontrols)>0) {
    									$inKontrol = $con->query("UPDATE telemarketer_kontrol_kode_promo SET penggunaan='$using' WHERE id_kode_promo='$idKode' AND id_customer='$idcs'");
    								} else {
    									$inKontrol = $con->query("INSERT INTO telemarketer_kontrol_kode_promo VALUES ('$idKode','$idcs','$using')");
    								}
    
    								$qq = mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$jam1','Voucher $voucher','$disc','1','$disc','$nota','$idcs') ");
    								$qq .= mysqli_query($con, "UPDATE telemarketer_sms_upload SET penggunaan_kode_promo='$using' WHERE id_customer='$idcs' AND id_kode_promo='$idKode'");
    								echo $using.' dari '.$maxPromo.' penggunaan';
    							}
    
    
    						}
    
    						break;
    					
    					default:
    						
    						$diskon = $dpromo3['diskon']*$harga/100;
    
    						$diskon = $dpromo3['diskon']*$harga/100;
    
    						if($ddpromo3['diskon']==100){
    							$diskon = ($charjenis=="p" && $harga>30000) ? 30000 : $diskon; 
    						}
    						else {
    							$diskon = $diskon;
    						}
    
    						$qcekcs = $con->query("SELECT * FROM telemarketer_sms_upload WHERE id_kode_promo='$idKode'");
    						if(mysqli_num_rows($qcekcs)>0)
    						{
    							echo "Maaf, Kode promo ini khusus untuk customer yang mendapatkan notifikasi/sms";
    						}
    						else 
    						{
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
    
    							$cekKontrols = $con->query("SELECT * FROM telemarketer_kontrol_kode_promo WHERE id_customer='$idcs' AND id_kode_promo='$idKode'");
    							if(mysqli_num_rows($cekKontrols)>0){
    								$cekKontrol = $cekKontrols->fetch_array();
    								$usingPromo = $cekKontrol['penggunaan'];
    							}
    							else {
    								$usingPromo = 0;
    							}
    
    							if($usingPromo>=$maxPromo) {
    								echo "Maaf, penggunaan sudah ".$maxPromo." kali";
    							}
    							else {
    					            if($kategory=="All") {
    					                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$nota' AND jenis_item='$charjenis'");
    					            } else {
    					                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$nota' AND jenis_item='$charjenis' AND kategori_item='$kategory' ");
    					            }
    								
    								$ckat = mysqli_num_rows($qkat);
    
    								if($ckat>0) 
    								{
    									$using = $usingPromo+1;
    									if(mysqli_num_rows($cekKontrols)>0) {
    										$inKontrol = $con->query("UPDATE telemarketer_kontrol_kode_promo SET penggunaan='$using' WHERE id_kode_promo='$idKode' AND id_customer='$idcs'");
    									} else {
    										$inKontrol = $con->query("INSERT INTO telemarketer_kontrol_kode_promo VALUES ('$idKode','$idcs','$using')");
    									}
    									$qq = mysqli_query($con, "INSERT INTO detail_penjualan values ('', '$jam1', 'Voucher $voucher', '$diskon', '1', '$diskon', '$nota', '$idcs', '0', 'Voucher $voucher')");
    
    									$qq .= mysqli_query($con, "UPDATE telemarketer_sms_upload SET penggunaan_kode_promo='$using' WHERE id_customer='$idcs' AND id_kode_promo='$idKode'");
    
    									echo $using.' dari '.$maxPromo.' penggunaan';
    								}
    								else {
    									echo "Kode promo berlaku untuk ".$kat;
    								}				
    
    							}
    						}
    
    						break;
    					}
				}
				else{
				    echo "* Kode promo sudah tidak berlaku!";
				}
				
    				
			}

			else if($cekpromo6>0) {
				$voucherId = $dpromo6['id_kode'];
				$kode = $dpromo6['nama_kode'];
				$berakhir = $dpromo6['tgl_berakhir'];
				$outlet = $dpromo6['outlet'];
				$kota = $dpromo6['kota'];
				$minimal = $dpromo6['minimal_order'];

				$kodecs = $rcus['kode_referral'];

				if($voucher==$kodecs){
					if(date('Y-m-d')>$berakhir)
					{
						echo "*Masa berlaku sudah lewat!! ";
					}
					if(date('Y-m-d')<=$berakhir && $minimal<=$harga)
					{	
						$resp = "";
						$item1 = (strpos($item, "Cuci Kering Setrika")==0) ? substr($item, 0, 19) : $item;
						$packets = mysqli_query($con, "SELECT * FROM subkode_voucher_pack WHERE id_kode='$voucherId' AND (nama_item='$item1' OR gratis_order='$item1')");
						if(mysqli_num_rows($packets)>0){
							$pack = mysqli_fetch_array($packets);

							$pemiliks = mysqli_query($con, "SELECT * FROM pemilik_voucher_pack WHERE id_subkode='$pack[id_subkode]' AND id_customer='$id'");
							$dpm = mysqli_fetch_array($pemiliks);
							$used = $dpm['penggunaan'];

							if($used<$pack['maks_penggunaan'])
							{
								if($pack['gratis_order']==""){
									$diskon = ($harga-$pack['harga_baru'])*-1;
									$disc = $diskon*-1;

									if($item1 == "Cuci Kering Setrika"){							
										mysqli_query($con, "DELETE FROM detail_penjualan WHERE item LIKE 'Voucher Harga%' AND no_nota='$nota'");
									}
									$resp .= 'Voucher digunakan!';									
								}
								else {
									
									//Cuci item 1 gratis cuci item 2
									$item2 = $pack['gratis_order'];
									$statGratis = mysqli_num_rows(mysqli_query($con, "SELECT * FROM pemilik_voucher_pack WHERE id_customer='$id' AND id_subkode='$pack[id_subkode]' AND status=true"));

									if($statGratis=="1" && $item==$item2){
										$diskon = ($harga/$jumlah)*-1;
										$disc = $diskon*-1;
										
										$resp .= 'Voucher digunakan!';
									}
									else {
										$resp .= 'Gratisnya sudah pernah digunakan!';
									}


								}

								$penjVouchers = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE item='Voucher $voucher' AND no_nota='$nota'");
								if(mysqli_num_rows($penjVouchers)<1){
									$qq = mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$jam1','Voucher $voucher','$disc','1','$disc','$nota','$idcs') ");
									$guna = $used+1;
									$qq .= mysqli_query($con, "UPDATE pemilik_voucher_pack SET penggunaan='$guna', status='0' WHERE id_customer='$id' AND id_subkode='$pack[id_subkode]'");

									echo $resp;
								}	
							}
							else 
							{
								echo "* Penggunaan sudah mencapai maksimal!";
							}

								
						}
						else {
							echo "* Tidak bisa digunakan!";
						}
						
					}
				}

				else echo "* Hanya berlaku untuk customer yang menerima notifikasi!";					

			}

			else {
				echo "*Belum ada promo dengan kode ini atau order di bawah syarat minimal!!";
			}



			


		}

		break;
}

?>