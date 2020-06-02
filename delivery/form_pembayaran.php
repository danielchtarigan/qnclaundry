<?php 
include '../config.php';
session_start();
$idkey = $_GET['idtrx']; 

$sql = mysqli_query($con, "SELECT * FROM customer WHERE id='$idkey'");
$data = mysqli_fetch_assoc($sql);

if($data['lgn']=='1'){
	$status = "langganan";
} else if($data['member']=='1') {
	$status = "member";
} else {
	$status = "normal";
} 

$sql2 = mysqli_query($con, "SELECT * FROM saldo_subagen WHERE subagen='$_SESSION[subagen]' ");
$s = mysqli_fetch_assoc($sql2);

if($_SESSION['subagen']<>'') {
	$saldo = $s['saldo']+$s['bonus'];
}
else {
	$saldo = 2000000;
}
?>

<h3>Pembayaran</h3>
	<div align="center">
		<p style="color: red; font-weight: bold" id="is"></p>
		<table style="margin-top: 15px; margin-left: 0; margin-bottom: 10px;">
			<?php 
			$total = mysqli_query($con, "SELECT SUM(total_bayar) AS total FROM reception WHERE id_customer='$idkey' AND lunas=false AND cara_bayar=''");
			$rtotal = mysqli_fetch_row($total);
			$tagihan = $rtotal[0];
			?>
			<tr>
				<td width="45%" class="bolder">Total Tagihan</td>
				<td width="5%">&nbsp; :</td>
				<td class="bolder"><input class="form-control" type="number" name="" value="<?php echo $tagihan ?>" readonly id="tagihan" onfocus="startCalc()" onblur="endCalc()"></td>
			</tr>
			<?php 
			$tagihankiloan = mysqli_query($con, "SELECT COALESCE(SUM(detail_penjualan.berat),0) AS berat FROM detail_penjualan INNER JOIN reception ON detail_penjualan.no_nota=reception.no_nota WHERE reception.lunas=false AND reception.cara_bayar='' AND detail_penjualan.item LIKE 'Cuci Kering Setrika%' AND detail_penjualan.id_customer='$idkey'");
			$rtagihankiloan = mysqli_fetch_row($tagihankiloan);
			$cks = $rtagihankiloan[0];

			$tagihansetrika = mysqli_query($con, "SELECT COALESCE(SUM(a.berat),0) AS berat FROM detail_penjualan AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota WHERE b.lunas=false AND b.cara_bayar='' AND a.item LIKE 'Setrika%' AND a.id_customer='$idkey'");
			$rtagihansetrika = mysqli_fetch_row($tagihansetrika);
			$ss = $rtagihansetrika[0];

			$totaltagihankuota = $cks*8800+$ss*6400;

			$langganan = mysqli_query($con, "SELECT * FROM langganan WHERE id_customer='$idkey'");
			$lgn = mysqli_fetch_assoc($langganan);

			if($status=="langganan"){ ?>

				<tr>
					<td class="bolder">Kuota Kiloan</td>
					<td>&nbsp; :</td>
					<td>
						<div class="input-group" style="width: 100%">
							<input class="form-control" style="width: 50%" type="" value="" name="" id="cks" placeholder="Berat CKS" onfocus="startCalc()" onblur="endCalc()">
							<input class="form-control" type="" name="" value="" id="ss" style="width: 50%" placeholder="Berat SS" onfocus="startCalc()" onblur="endCalc()">
						</div>				
					</td>
				</tr>
				<tr>
					<td class="bolder">Kuota Potongan</td>
					<td>&nbsp; :</td>
					<td><input class="form-control" type="" name="" value="0" id="kuota_potongan" onfocus="startCalc()" onblur="endCalc()"></td>
				</tr>
				<?php
			} else {
				?>
				<tr>
					<td class="bolder"><input class="form-control" type="text" name="" id="voucherc" placeholder="Kode Cashback!!" onfocus="startCalc()" onblur="endCalc()"></td>
					<td>&nbsp; :</td>
					<td><input class="form-control" type="number" name="" id="diskonc" value="0" readonly="" onfocus="startCalc()" onblur="endCalc()">
					</td>
				</tr>
				<?php
			}
			?>			
			<tr>
				<td class="bolder">Pembayaran Cash</td>
				<td>&nbsp; :</td>
				<td><input class="form-control" type="number" name="" value="0" id="bayar_cash" onfocus="startCalc()" onblur="endCalc()" ></td>
			</tr>
			<?php 
			if($_SESSION['subagen']=='') { ?>
				<tr>
					<td>
						<select class="form-control no-border" placeholder="Click to Choose..." id="edc" onfocus="startCalc()" onblur="endCalc()">
							<option class="bolder" value="">--Pilih EDC--</option>
							<option value="BCA">BCA</option>
							<option value="BNI">BNI</option>
							<option value="BRI">BRI</option>
							<option value="Mandiri">Mandiri</option>			
						</select>
					</td>
					<td>&nbsp; :</td>
					<td><input class="form-control" type="number" name="" value="0" disabled="disabled" id="bayar_edc" onfocus="startCalc()" onblur="endCalc()"></td>
				</tr> <?php
			} else { ?>
				<tr>
					<td>
						<select class="form-control no-border" disabled="disabled" placeholder="Click to Choose..." id="edc" onfocus="startCalc()" onblur="endCalc()">
							<option class="bolder" value="">--Pilih EDC--</option>
							<option value="BCA">BCA</option>
							<option value="BNI">BNI</option>
							<option value="BRI">BRI</option>
							<option value="Mandiri">Mandiri</option>			
						</select>
					</td>
					<td>&nbsp; :</td>
					<td><input class="form-control" type="number" name="" value="0" disabled="disabled" id="bayar_edc" onfocus="startCalc()" onblur="endCalc()"></td>
				</tr> <?php

			}

			?>
				
			<tr>
				<td class="bolder">Sisa Tagihan</td>
				<td>&nbsp; :</td>
				<td class="bolder"><input class="form-control" type="number" name="" value="0" readonly="" id="sisa" onfocus="startCalc()" onblur="endCalc()"></td>
			</tr>		
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><input class="btn btn-block btn-success" type="submit" name="" id="simpanx" value="Simpan" disabled=""></td>
			</tr>
		</table>
	</div>


	<script src="../js/jquery-1.11.0.js"></script>
	<script type="text/javascript">

		function startCalc(){
			interval=setInterval("calc()",1);
		}
		function calc() {
			var edc = $("#edc").val();
			if(edc!=''){
				$("#bayar_edc").prop('disabled', false);
			} else {
				$("#bayar_edc").prop('disabled', true);
				$("#bayar_edc").val("0");
			}

			var cks = $("#cks").val();
			var ss = $("#ss").val();
			var totsisakuota = "<?php echo number_format(($lgn['kilo_cks']*8800),0,'','')  ?>";			
			var bayarkiloan = (cks*8800+ss*6400).toFixed();
			var totsisapotongan = "<?php echo $lgn['potongan'] ?>";
			var bayar_potongan = $("#kuota_potongan").val();
			if((cks*8800+ss*6400)>totsisakuota){
				alert(bayarkiloan+" "+totsisakuota);
				$("#cks").val("0");
				$("#ss").val("0");
			};

			if(bayar_potongan>totsisapotongan){
				alert("kuota potongan tidak mencukupi");
				$("#kuota_potongan").val(0);
			}
			
			var tagihan = $("#tagihan").val();
			var status = "<?php echo $status ?>";
			var saldo_subagen = "<?php echo $saldo ?>";
			var ceksald = saldo_subagen-tagihan;
			if(ceksald<0) {
				$("#is").html("Saldo Anda tidak cukup!!");	
				$("#bayar_cash").prop('disabled', true);	
				alert(ceksald);		
			} 
			var voucher = $("#voucherc").val();
			if(voucher!='') {
				$.ajax({
					url 	: 'inc_kode_rupiah.php',
					data 	: 'voucher='+voucher+'&tagihan='+tagihan,
					success : function(data){
						$("#diskonc").val(data);
					}
				});			
			} else {
				$("#diskonc").val(0);
			}; 

			var diskon  = $("#diskonc").val();
			var cash = $("#bayar_cash").val();
			var edc = $("#bayar_edc").val();			
			
			if(status=="langganan"){
				var sisa = tagihan-cash-edc-bayarkiloan-bayar_potongan;
			} else {
				var sisa = tagihan-diskon-cash-edc;
			}
			
			$("#sisa").val(sisa);

			var bayar_kuota = bayarkiloan+bayar_potongan;
			if(bayar_kuota>0 && cash>0 && edc>0){
				alert("Tidak boleh 3 cara bayar!!");
				$("#bayar_cash").val(0);
				$("#bayar_edc").val(0);
			} else if(diskon>0 && cash>0 && edc>0){
				alert("Tidak boleh 3 cara bayar!!");
				$("#bayar_edc").val(0);
				$("#bayar_cash").val(0);
			}
			
			if(sisa=='0'){
				$("#simpanx").prop('disabled', false);
			} else if(sisa!='0') {
				$("#simpanx").prop('disabled', true);
			}
		}

		function endCalc(){
			clearInterval(interval);
		};

		$("#voucherc").focusout(function(){
			var voucher = $("#voucherc").val();
			var diskon = $("#diskonc").val();
			if(voucher != '' && diskon==0) {
				$('#is').html("Voucher tidak dapat digunakan!!");
			}
		});

		
		$("#simpanx").on('click', function(){
			var total = $("#tagihan").val();
			var id = "<?php echo $idkey ?>";
			var voucher = $("#voucherc").val();
			var diskon = $("#diskonc").val();
			var bayar_cash = $("#bayar_cash").val();
			var edc = $("#edc").val();
			var bayar_edc = $("#bayar_edc").val();
			var cks = $("#cks").val();
			var ss = $("#ss").val();
			var kuota_potongan = $("#kuota_potongan").val();
			var kuota = cks*8800+ss*6400+kuota_potongan*1;
			$.ajax({
				url 	: 'action/simpan_pembayaran_order.php',
				data 	: 'id='+id+'&total_tagihan='+total+'&bayar_cash='+bayar_cash+'&edc='+edc+'&bayar_edc='+bayar_edc+'&kuota='+kuota+'&cks='+cks+'&ss='+ss+'&kuota_potongan='+kuota_potongan+'&voucher='+voucher+'&diskon='+diskon,
				success : function(data){
					$('#faktur-pembayaran').removeClass('hidden').html(data);
				}
			})
		})
		

	</script>