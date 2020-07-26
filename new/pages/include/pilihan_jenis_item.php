<?php 
include '../../config.php';
session_start();

$query = mysqli_query($con, "SELECT *FROM customer WHERE id='$_GET[id]'");
$row = mysqli_fetch_assoc($query);

$outlet = $_SESSION['outlet'];
$cabang = $_SESSION['cabang'];

//cek status berlangganan
if($row['lgn']=='1'){
	$status = "langganan";
} else if($row['member']=='1') {
	$status = "member";
} else {
	$status = "normal";
} 

if($cabang=="Jakarta"){

	if($_GET['jenis']=="cks") { ?>
			<label class="control-label col-md-4 col-xs-3">Item</label>
			<div class="col-md-6 col-xs-9">
				<select class="form-control" id="item">
					<option value="0-0">--Pilih Item--</option>
					<?php 
					$ritem = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='k' AND nama_item LIKE '%Cuci Kering Setrika%'");
					while($item = mysqli_fetch_assoc($ritem)){
						$berat = $item['berat'];
						$harga = ($berat>3) ? 15000+$berat*8000 : 10000+8000*$berat;
						$hargalgn = ($outlet=="Gading Serpong") ? $berat*8000 : $berat*8800;

						if($status=="langganan") {
							echo '<option value="'.$item['nama_item'].'-'.$hargalgn.'">'.$item['nama_item'].'</option>';
						} else if($status=="member") {
							echo '<option value="'.$item['nama_item'].'-'.$harga*0.8.'">'.$item['nama_item'].'</option>';
						} else {
							echo '<option value="'.$item['nama_item'].'-'.$harga.'">'.$item['nama_item'].'</option>';
						}
						
					}
					?>
				</select>
			</div> <?php
		} else if($_GET['jenis']=="ss") { ?>
			<label class="control-label col-md-4 col-xs-3">Item</label>
			<div class="col-md-6 col-xs-9">
				<select class="form-control" id="item">
					<option value="0-0">--Pilih Item--</option>
					<?php 
					$ritem = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='k' AND nama_item LIKE 'Setrika%'");
					while($item = mysqli_fetch_assoc($ritem)){
						$berat = $item['berat'];
						$harga = $berat*8000;
						$hargalgn = ($outlet=="Gading Serpong") ? $berat*6000 : $berat*6400;

						if($status=="langganan") {
							echo '<option value="'.$item['nama_item'].'-'.$hargalgn.'">'.$item['nama_item'].'</option>';
						} else if($status=="member") {
							echo '<option value="'.$item['nama_item'].'-'.$harga*0.8.'">'.$item['nama_item'].'</option>';
						} else {
							echo '<option value="'.$item['nama_item'].'-'.$harga.'">'.$item['nama_item'].'</option>';
						}
						
					}
					?>
				</select>
			</div> <?php
		} else if($_GET['jenis']=="ckl") { ?>
			<label class="control-label col-md-4 col-xs-3">Item</label>
			<div class="col-md-6 col-xs-9">
				<select class="form-control" id="item">
					<option value="0-0">--Pilih Item--</option>
					<?php 
					$ritem = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='k' AND nama_item LIKE 'Cuci Kering Lipat%'");
					while($item = mysqli_fetch_assoc($ritem)){
						$berat = $item['berat'];
						$harga = ($berat>3) ? 15000+$berat*4000 : 10000+4000*$berat ;
						$hargalgn = ($outlet=="Gading Serpong") ? $berat*4000 : $berat*4000;

						if($status=="langganan") {
							echo '<option value="'.$item['nama_item'].'-'.$hargalgn.'">'.$item['nama_item'].'</option>';
						} else if($status=="member") {
							echo '<option value="'.$item['nama_item'].'-'.$harga*0.8.'">'.$item['nama_item'].'</option>';
						} else {
							echo '<option value="'.$item['nama_item'].'-'.$harga.'">'.$item['nama_item'].'</option>';
						}
						
					}
					?>
				</select>
			</div> <?php
		} else if($_GET['jenis']=="ck") { ?>
			<label class="control-label col-md-4 col-xs-3">Item</label>
			<div class="col-md-6 col-xs-9">
				<select class="form-control" id="item">
					<option value="0-0">--Pilih Item--</option>
					<?php 
					$ritem = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='k' AND nama_item LIKE 'Cuci Kering Lipat%'");
					while($item = mysqli_fetch_assoc($ritem)){
						$items = str_replace(" Lipat", "", $item['nama_item']);
						$berat = $item['berat'];
						$harga = ($berat>3) ? 15000 : 10000 ;
						$hargalgn = ($outlet=="Gading Serpong") ? $berat*4000 : $berat*3300;

						if($status=="langganan") {
							echo '<option value="'.$items.'-'.$hargalgn.'">'.$items.'</option>';
						} else if($status=="member") {
							echo '<option value="'.$items.'-'.$harga*0.8.'">'.$items.'</option>';
						} else {
							echo '<option value="'.$items.'-'.$harga.'">'.$items.'</option>';
						}
						
					}
					?>
				</select>
			</div> <?php
		}
}
else {
	if($_GET['jenis']=="cks") { ?>
		<label class="control-label col-md-4 col-xs-3">Item</label>
		<div class="col-md-6 col-xs-9">
			<select class="form-control" id="item">
				<option value="0-0">--Pilih Item--</option>
				<?php 
				$ritem = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='k' AND nama_item LIKE '%Cuci Kering Setrika%'");
				while($item = mysqli_fetch_assoc($ritem)){
					if($_SESSION['cabang']=="Medan") {
						$berat = $item['berat'];
						$harga = $item['harga_medan'];
						$hargalgn = $berat*7920;
					} else if($_SESSION['cabang']=="Jakarta") {
						$berat = $item['berat'];
						$harga = $item['harga'];
						$hargalgn = ($outlet=="Gading Serpong") ? $berat*8000 : $berat*8800;
					} else {
						$berat = $item['berat'];
						$harga = $item['harga_mjkt'];
						$hargalgn = $berat*7000;						
					}

					if($status=="langganan") {
						echo '<option value="'.$item['nama_item'].'-'.$hargalgn.'">'.$item['nama_item'].'</option>';
					} else if($status=="member") {
						echo '<option value="'.$item['nama_item'].'-'.$harga*0.8.'">'.$item['nama_item'].'</option>';
					} else {
						echo '<option value="'.$item['nama_item'].'-'.$harga.'">'.$item['nama_item'].'</option>';
					}
					
				}
				?>
			</select>
		</div> <?php
	} else if($_GET['jenis']=="ss") { ?>
		<label class="control-label col-md-4 col-xs-3">Item</label>
		<div class="col-md-6 col-xs-9">
			<select class="form-control" id="item">
				<option value="0-0">--Pilih Item--</option>
				<?php 
				$ritem = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='k' AND nama_item LIKE 'Setrika%'");
				while($item = mysqli_fetch_assoc($ritem)){
					if($_SESSION['cabang']=="Medan") {
						$berat = $item['berat'];
						$harga = $item['harga_medan'];
						$hargalgn = $berat*4000;
					} else if($_SESSION['cabang']=="Jakarta") {
						$berat = $item['berat'];
						$harga = $item['harga'];
						$hargalgn = ($outlet=="Gading Serpong") ? $berat*6000 : $berat*6400;
					} else {
						$berat = $item['berat'];
						$harga = $item['harga_mjkt'];
						$hargalgn = $berat*4000;	
					}

					if($status=="langganan") {
						echo '<option value="'.$item['nama_item'].'-'.$hargalgn.'">'.$item['nama_item'].'</option>';
					} else if($status=="member") {
						echo '<option value="'.$item['nama_item'].'-'.$harga*0.8.'">'.$item['nama_item'].'</option>';
					} else {
						echo '<option value="'.$item['nama_item'].'-'.$harga.'">'.$item['nama_item'].'</option>';
					}
					
				}
				?>
			</select>
		</div> <?php
	} else if($_GET['jenis']=="ckl") { ?>
		<label class="control-label col-md-4 col-xs-3">Item</label>
		<div class="col-md-6 col-xs-9">
			<select class="form-control" id="item">
				<option value="0-0">--Pilih Item--</option>
				<?php 
				$ritem = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='k' AND nama_item LIKE 'Cuci Kering Lipat%'");
				while($item = mysqli_fetch_assoc($ritem)){
					if($_SESSION['cabang']=="Medan") {
						$berat = $item['berat'];
						$harga = $item['harga_medan'];
						$hargalgn = $berat*5000;
					} else if($_SESSION['cabang']=="Jakarta"){
						$berat = $item['berat'];
						$harga = $item['harga'];
						$hargalgn = ($outlet=="Gading Serpong") ? $berat*6000 : $berat*7400;
					} else {
						$berat = $item['berat'];
						$harga = $item['harga_mjkt'];
						$hargalgn = $berat*5000;
					}

					if($status=="langganan") {
						echo '<option value="'.$item['nama_item'].'-'.$hargalgn.'">'.$item['nama_item'].'</option>';
					} else if($status=="member") {
						echo '<option value="'.$item['nama_item'].'-'.$harga*0.8.'">'.$item['nama_item'].'</option>';
					} else {
						echo '<option value="'.$item['nama_item'].'-'.$harga.'">'.$item['nama_item'].'</option>';
					}
					
				}
				?>
			</select>
		</div> <?php
	}
}

		

?>

<script type="text/javascript">
	$("#item").change(function(){
		var item = $(this).val().split('-');
		$('#it').val(item[0]);
		$("#harga").val(item[1]);
			
	});
</script>