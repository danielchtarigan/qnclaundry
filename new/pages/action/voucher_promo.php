<?php 
include '../../config.php';
include '../zonawaktu.php';

$tgl = date('Y-m-d');	
$id_cs = $_GET['id'];
$ot = $_SESSION['outlet'];

mysqli_query($con, "DELETE FROM detail_penjualan WHERE item LIKE '%Voucher%' AND no_nota='$_GET[nota]'");

if($_GET['kode_voucher']==""){
} else{

	$harga = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) FROM detail_penjualan WHERE no_nota='$_GET[nota]' AND item NOT LIKE '%Voucher%'"))[0];

	$kodeVoucher = strtoupper($_GET['kode_voucher']);

	//kode_promo_diskon
	$kode = mysqli_query($con, "SELECT * FROM kode_promo_new WHERE kode='$kodeVoucher' AND tgl_berakhir>='$nowDate' AND status='1' AND outlet='$_SESSION[outlet]' AND cabang='$_SESSION[cabang]'");
	$res = mysqli_fetch_assoc($kode);
	$confirm = mysqli_num_rows($kode);

	//kode promo dari telemarketer
	$kode2 = mysqli_query($con, "SELECT * from telemarketer_sms_upload a, telemarketer_kode_promo b where a.id_kode_promo=b.id AND b.berlaku_sampai>='$tgl' AND b.status=true AND (b.kota='$_SESSION[cabang]' OR b.kota='All') AND (b.outlet='All' OR b.outlet='$_SESSION[outlet]') AND b.min_order<='$harga' AND a.id_customer='$id_cs' AND b.kode_promo='$kodeVoucher' AND b.flat='0' ");
	$res2 = mysqli_fetch_assoc($kode2);
	$confirm2 = mysqli_num_rows($kode2);

	$kode3 = mysqli_query($con,"SELECT * from telemarketer_kode_promo where kode_promo='$kodeVoucher' and berlaku_sampai>='$tgl' AND status=true AND (kota='$_SESSION[cabang]' OR kota='All') AND (outlet='$ot' OR outlet='All') AND min_order<='$harga'");
	$res3 = mysqli_fetch_array($kode3);
	$confirm3 = mysqli_num_rows($kode3);

	if($confirm<1 && $confirm2<1 && $confirm3<1) {
		echo "X";
	}
	
	else if($confirm>0){

		$voucherKode = ($res['diskon']==0) ? "KiloFlat" : "Diskon";

		switch ($voucherKode) {
			case 'KiloFlat':

				$qberat = mysqli_query($con, "SELECT SUM(berat), SUM(total), item FROM detail_penjualan WHERE no_nota='$_GET[nota]'");
				$data = mysqli_fetch_array($qberat);

				if($data[0]==0)
				{
					echo "Z";
				}
				else
				{

					$item = $data['item'];

					if(strpos($item, "Setrika")=="12" && strpos($item, "Lipat")=="") {
						//$it = "CKS";
						$hargaNew = $res['nilai']*$data[0];
					} else if(strpos($item, "Setrika")=="0" && strpos($item, "Lipat")=="") {
						//$it = "SS";
						$hargaNew = ($res['nilai']-2000)*$data[0];
					} else if(strpos($item, "Setrika")=="0" && strpos($item, "Lipat")=="12") {
						//$it = "CKL";
						$hargaNew = ($res['nilai']-4000)*$data[0];
					}

					$diskon = ($data[1]-$hargaNew)*-1;
					$disc = $diskon*-1;

					mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','Voucher $kodeVoucher','$diskon','1','$diskon','$_GET[nota]','$_GET[id]') ");
					mysqli_query($con, "UPDATE reception SET total_bayar='$hargaNew',diskon='$disc',voucher='$kodeVoucher' WHERE no_nota='$_GET[nota]' ");

					echo "V";
				}

				break;
			
			case 'Diskon':
				
				$tagihan = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) FROM detail_penjualan WHERE no_nota='$_GET[nota]'"))[0];
				$diskon = ($res['diskon']/100)*$tagihan*-1;
				$disc = $diskon*-1;

				mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','Voucher $kodeVoucher','$diskon','1','$diskon','$_GET[nota]','$_GET[id]') ");

				mysqli_query($con, "UPDATE reception SET diskon='$disc',voucher='$kodeVoucher' WHERE no_nota='$_GET[nota]' ");

				echo "V";

				break;
		}

	} 
	else if($confirm2>0) {

		$kode = $res2['kode_promo'];
		$idKode = $res2['id_kode_promo'];
		$diskon = $res2['diskon']*$harga/100;
		$usingPromo = $res2['penggunaan_kode_promo'];
		$maxPromo = $res2['max_penggunaan'];
		$kategory = $res2['kategori_item'];
		$jenisOrder = $res2['item_order'];

		$disc = $diskon*-1;

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
			echo "X";
		}
		else {
            if($kategory=="All") {
                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$_GET[nota]'");
            } else {
                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$_GET[nota]' AND jenis_item='$jenisOrder' AND kategori_item='$kategory' ");
            }
			
			$ckat = mysqli_num_rows($qkat);

			if($ckat>0) {
				$using = $usingPromo+1;
				$qq = mysqli_query($con, "INSERT INTO detail_penjualan values ('', '$nowDate', 'Voucher TLM $res2[kode_promo]', '$disc', '1', '$disc', '$_GET[nota]', '$id_cs', '0', 'Voucher TLM $res2[kode_promo]')");
				$qq = mysqli_query($con, "UPDATE telemarketer_sms_upload SET penggunaan_kode_promo='$using' WHERE id_customer='$id_cs' AND id_kode_promo='$idKode'");

				echo "V";

				//hapus tabel kategori_item_order
				mysqli_query($con, "DELETE FROM kategori_item_order WHERE no_nota='$_GET[nota]'");
			}
			else {
				echo "X";	
			}	

		}
	}

	else if($confirm3>0) {

		$kode = $res3['kode_promo'];
		$idKode = $res3['id'];


		$jenisPromo = ($res3['flat']==0) ? "Diskon" : "Flat";

		switch ($jenisPromo) {
			case 'Flat':

				$maxPromo = $res3['max_penggunaan'];
				$kategory = $res3['kategori_item'];
				$jenisOrder = ($jenis=="Potongan") ? "p" : "k";

				$qberat = mysqli_query($con, "SELECT SUM(berat), SUM(total), item FROM detail_penjualan WHERE no_nota='$_GET[nota]'");
				$data = mysqli_fetch_array($qberat);

				if($data[0]==0)
				{
					echo "Z";
				}
				else
				{

					$item = $data['item'];

					if(strpos($item, "Setrika")=="12" && strpos($item, "Lipat")=="") {
						//$it = "CKS";
						$hargaNew = $res3['flat']*$data[0];
					} else if(strpos($item, "Setrika")=="0" && strpos($item, "Lipat")=="") {
						//$it = "SS";
						$hargaNew = ($res3['flat']-2000)*$data[0];
					} else if(strpos($item, "Setrika")=="0" && strpos($item, "Lipat")=="12") {
						//$it = "CKL";
						$hargaNew = ($res3['flat']-4000)*$data[0];
					}

					$diskon = ($data[1]-$hargaNew)*-1;
					$disc = $diskon*-1;

					$cekKontrols = $con->query("SELECT * FROM telemarketer_kontrol_kode_promo WHERE id_customer='$id_cs' AND id_kode_promo='$idKode'");

					if(mysqli_num_rows($cekKontrols)>0){
						$cekKontrol = $cekKontrols->fetch_array();
						$usingPromo = $cekKontrol['penggunaan'];
					}
					else {
						$usingPromo = 0;
					}

					if($usingPromo>=$maxPromo) 
					{
						echo "X";
					}
					else
					{
						$using = $usingPromo+1;

						if(mysqli_num_rows($cekKontrols)>0) {
							$inKontrol = $con->query("UPDATE telemarketer_kontrol_kode_promo SET penggunaan='$using' WHERE id_kode_promo='$idKode' AND id_customer='$id_cs'");
						} else {
							$inKontrol = $con->query("INSERT INTO telemarketer_kontrol_kode_promo VALUES ('$idKode','$id_cs','$using')");
						}

						mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','Voucher $kodeVoucher','$diskon','1','$diskon','$_GET[nota]','$_GET[id]') ");
						mysqli_query($con, "UPDATE telemarketer_sms_upload SET penggunaan_kode_promo='$using' WHERE id_customer='$id_cs' AND id_kode_promo='$idKode'");
						mysqli_query($con, "UPDATE reception SET total_bayar='$hargaNew',diskon='$disc',voucher='$kodeVoucher' WHERE no_nota='$_GET[nota]'");

						echo "V";	
					}


						
				}

				break;
			
			default:
				
				$diskon = $res3['diskon']*$harga/100;
				$usingPromo = mysqli_fetch_row(mysqli_query($con, "SELECT COUNT(voucher) FROM reception WHERE voucher LIKE '$kode'"))[0];
				$maxPromo = $res3['max_penggunaan'];
				$kategory = $res3['kategori_item'];
				$jenisOrder = $res3['item_order'];

				$diskon = ($jenisOrder=="p" && $harga>20000) ? 20000 : $diskon; 

				$disc = $diskon*-1;

				$jenisItem = ($res3['item_order'] == "All") ? " " : "AND jenis_item = '$jenisOrder'";

				$qcekcs = $con->query("SELECT * FROM telemarketer_sms_upload WHERE id_kode_promo='$idKode'");
				if(mysqli_num_rows($qcekcs)>0){
					echo "X";
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
						echo "X";
					}
					else {
			            if($kategory=="All") {
			                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$_GET[nota]'");
			            } else {
			                $qkat = $con->query("SELECT * FROM kategori_item_order WHERE no_nota='$_GET[nota]' $jenisItem AND kategori_item='$kategory' ");
			            }
						
						$ckat = mysqli_num_rows($qkat);

						if($ckat>0) {
							$using = $usingPromo+1;

							if(mysqli_num_rows($cekKontrols)>0) {
								$inKontrol = $con->query("UPDATE telemarketer_kontrol_kode_promo SET penggunaan='$using' WHERE id_kode_promo='$idKode' AND id_customer='$id_cs'");
							} else {
								$inKontrol = $con->query("INSERT INTO telemarketer_kontrol_kode_promo VALUES ('$idKode','$id_cs','$using')");
							}
							
							$qq = mysqli_query($con, "INSERT INTO detail_penjualan values ('', '$nowDate', 'Voucher TLM $res3[kode_promo]', '$disc', '1', '$disc', '$_GET[nota]', '$id_cs', '0', 'Voucher TLM $res3[kode_promo]')");
							$qq = mysqli_query($con, "UPDATE telemarketer_sms_upload SET penggunaan_kode_promo='$using' WHERE id_customer='$id_cs' AND id_kode_promo='$idKode'");

							echo "V";

							//hapus tabel kategori_item_order
							mysqli_query($con, "DELETE FROM kategori_item_order WHERE no_nota='$_GET[nota]'");
						}
						else {
							echo "X";	
						}	

					}
				}

				break;
		}

				

			
	}

	
}







?>
