<?php 
include 'config.php';
include 'encrypt-url.php';

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d H:i:s');

if($date>"2019-03-19 16:00:00"){
    $id = decrypt($_GET['id'],$key);
} else {
    $id = $_GET['id'];
}


$fakturs = mysqli_query($con, "SELECT no_faktur FROM faktur_penjualan WHERE no_faktur='$id' ORDER BY id DESC");
$result = mysqli_fetch_row($fakturs);
$no_faktur = $result[0];


$cuss = mysqli_query($con, "SELECT SUM(total_bayar) AS total, nama_customer, no_faktur, id_customer FROM reception WHERE no_faktur='$no_faktur'");
$cus = mysqli_fetch_array($cuss);

$notif = mysqli_fetch_array(mysqli_query($con, "SELECT pilihan_notif FROM notifikasi_customer WHERE id_customer='$cus[id_customer]' "))[0];


require 'genqrcode.php';

?>


<div>
	<div style="background-color: #ecce50; text-align: center"><em id="pesan_berhasil" style="color: green; font-size: 12px; text-align: right;"></em></div>
	<form>
		<fieldset data-role="controlgroup" data-mini="true" data-iconpos="right">
			<legend>Ingin menerima notifikasi cucian melalui:</legend>
			<input type="radio" name="notif" id="radio-choice-v-6a" value="0" onchange="live_form()">
			<label for="radio-choice-v-6a">SMS</label>
			<input type="radio" name="notif" id="radio-choice-v-6b" value="1" onchange="live_form()">
			<label for="radio-choice-v-6b">Whatsapp</label>
			<input type="radio" name="notif" id="radio-choice-v-6c" value="2" onchange="live_form()">
			<label for="radio-choice-v-6c">Email</label>
			<input type="email" name="email" id="radio-choice-v-6c" onchange="live_form()" placeholder="Enter your email di sini">
			<label for="radio-choice-v-6c">Email</label>
		</fieldset>
	</form>
</div>



<script type="text/javascript">
	notif = '<?= $notif ?>';
	$('input[name=notif][value='+notif+']').prop('checked', true);	
	$('input[name=email]').css('display', 'none');

	function live_form(){
		notif = $('input[name=notif]:checked').val();
		idcs = '<?= $cus['id_customer'] ?>';
		email = $('input[name=email]').val();

		if(notif=="2") {
			$('input[name=email]').css('display', 'block');
		}
		else {
			$('input[name=email]').css('display', 'none');
		}

		$.ajax({
			url 	: 'https://qnclaundry.com/rubah_notifikasi.php',
			data 	: 'notif='+notif+'&idcs='+idcs+'&email='+email,
			success : function(msg){
				$('#pesan_berhasil').html(msg);
			}
		})
	}
</script>


<ul data-role="listview" data-inset="true">
    <li data-role="list-divider" data-theme="b"><h1>Yth Customer kami Bpk/Ibu <?= ucwords($cus['nama_customer']) ?></h1></li>
    <li data-role="list-divider"><h1><?= $no_faktur ?></h1></li>
    <?php 
    $bayars = mysqli_query($con, "SELECT * FROM cara_bayar WHERE no_faktur='$no_faktur'");
    while($bayar = mysqli_fetch_array($bayars)){
		echo '
		<li>
            <h1>'.$bayar['cara_bayar'].'</h1>
            <ul>
                <li>Rp '.number_format($bayar['jumlah'],0,',','.').'</li>
            </ul>
        </li>
		';
	}

    ?>
</ul>

<div style="background-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-width: 2px;">
<h3 class="ui-bar ui-bar-a" style="margin-bottom: -2px; font-size: 16px">Rincian Nota Pemesanan</h3>
	<div class="ui-body">
		<div data-role="collapsibleset" data-inset="false" style="margin: 0 2%">
			<?php 
			$sql = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$no_faktur'");
			while($data = mysqli_fetch_array($sql)) {
				
				?>
				<div data-role="collapsible" data-iconpos="right">	
					<h5><?= $data['no_nota'] ?></h5>				
					<div align="center">					
						<img src="https://qnclaundry.com/qrcodetemp/<?= $data['no_nota'].'.png'; ?>">
					</div>
					<div style="border: 1px double #ddd; font-size: 12px">
						<table style="text-align: left; border-bottom: 1px solid #ddd; width: 100%">
							<tr>
								<th width="40%">Item</th>	
								<th width="35%">Price</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>
									<?php 
									$items = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE no_nota='$data[no_nota]'");
									while($item = mysqli_fetch_array($items)) {
										echo $item['jumlah'].' | '.$item['item'].'<br>';
									}
									?>

								</td>
								<td style="vertical-align: top"><?= "Rp ". number_format($data['total_bayar'],0,',','.') ?></td>
								<td style="color: #2826FF; vertical-align: top">
									<?php 
									$statuss = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$data[no_nota]'");
									$status = mysqli_fetch_array($statuss);
									if($status['kembali']=='1') {
										echo "Ready";
									} else if($status['packing']=='1') {
										echo "Packing";
									} else if($status['setrika']=='1') {
										echo "Setrika";
									} else if($status['cuci']=='1') {
										echo "Cuci";
									} else {
										echo "Not Yet";
									}
									?>
								</td>
							</tr>
						</table>
						<table style="text-align: left; border-bottom: 1px solid #ddd; width: 100%">
							<tr>
								<th width="40%">Created By</th>	
								<th width="35%">Order Date</th>
								<th>Estimate</th>					
							</tr>
							<tr>
								<td style="vertical-align: top"><?= $data['nama_reception'] ?></td>
								<td><?= date('d/m/Y', strtotime($data['tgl_input'])).'<br>'.date('H:i', strtotime($data['tgl_input'])) ?></td>
								<td>
									<?php 
									if($status['express']=='3'){
										$tgl_selesai = date('d/m/Y', strtotime('+4 hours', strtotime($data['tgl_input']))).'<br>'.date('H:i', strtotime('+4 hours', strtotime($data['tgl_input'])));
									}
									elseif($status['express']=='2'){
										$tgl_selesai = date('d/m/Y', strtotime('+6 hours', strtotime($data['tgl_input']))).'<br>'.date('H:i', strtotime('+6 hours', strtotime($data['tgl_input'])));
									}
									elseif($status['express']=='1'){
										$tgl_selesai = date('d/m/Y', strtotime('+1 days', strtotime($data['tgl_input']))).'<br>'.date('H:i', strtotime('+1 days', strtotime($data['tgl_input'])));
									} 
									else {
										$tgl_selesai = date('d/m/Y', strtotime('+3 days', strtotime($data['tgl_input']))).'<br>'.date('H:i', strtotime('+3 days', strtotime($data['tgl_input'])));
									}
									echo $tgl_selesai;

									?>
								</td>		
							</tr>
						</table>
						<table style="text-align: left; width: 100%">
							<tr>
								<th width="40%">On Time</th>
								<th>Detail SPK</th>						
							</tr>
							<tr>
								<td style="color: #2826FF; vertical-align: top">
									<?php 
									$sql3 = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$data[no_nota]' AND (DATEDIFF(tgl_cuci, tgl_input)>='2' OR DATEDIFF(tgl_setrika, tgl_input)>='2')");
									if(mysqli_num_rows($sql3)>0){
										echo $ontime = "No";
									} else {
										echo $ontime = "Yes";
									}
									?>
								</td>	
								<td>
									<?php 
									$sql4 = mysqli_query($con, "SELECT * FROM detail_spk WHERE no_nota='$data[no_nota]'");
									if(mysqli_num_rows($sql4)>0){
										while($dtl=mysqli_fetch_array($sql4)) {
											echo $dtl['jumlah'].' '.str_replace("WebCam SPK", "", $dtl['jenis_item']).'<br>';
										}
									} 
									else {
										echo "Belum tersedia";
									}

									?>
								</td>						
							</tr>
						</table>					
					</div>				
				</div>
				<?php
			}

			?>
						
		</div>
	</div>
</div>



	
		

    