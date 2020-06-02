<?php 
include '../config.php';
include 'head.php';

// $query = mysqli_query($con, "SELECT * FROM reception WHERE id_customer != '0' AND tgl_input >= '2019-01-01'");
date_default_timezone_set('Asia/Makassar');
$bulan = date('Y-m');
$currentMonth = date('m');
$currentYear = date('Y');
$outlet = '%%';

if(isset($_POST['cari'])){
	$bulan = $_POST['tahun'].'-'.$_POST['bulan'];
	$currentMonth = $_POST['bulan'];
	$currentYear = $_POST['tahun'];
	$outlet = $_POST['outlet'];
} else{
	$bulan = date('Y-m');
}

function formatRupiah($amount)
{
  return "Rp ".number_format($amount,0,',','.');
}

?>
<h3 class="page-header">Marketing Summary</h3>
<p>
    Note :<br/>
    - Status pembayaran tidak dicek <br/>
    - W1 (1-7), W2 (8-15), W3 (16-22), W4 (23-30) 
</p>

<div style="height: 50px; color: green; font-size: 14px">
	<form action="" method="POST">
		<label>Pencarian Bulanan</label>
		<select name="bulan">
			<option>Bulan</option>
			<option value="01" <?php if($currentMonth == '01') echo"selected='selected'"; ?>>Januari</option>
			<option value="02" <?php if($currentMonth == '02') echo"selected='selected'"; ?>>Februari</option>
			<option value="03" <?php if($currentMonth == '03') echo"selected='selected'"; ?>>Maret</option>
			<option value="04" <?php if($currentMonth == '04') echo"selected='selected'"; ?>>April</option>
			<option value="05" <?php if($currentMonth == '05') echo"selected='selected'"; ?>>Mei</option>
			<option value="06" <?php if($currentMonth == '06') echo"selected='selected'"; ?>>Juni</option>
			<option value="07" <?php if($currentMonth == '07') echo"selected='selected'"; ?>>Juli</option>
			<option value="08" <?php if($currentMonth == '08') echo"selected='selected'"; ?>>Agustus</option>
			<option value="09" <?php if($currentMonth == '09') echo"selected='selected'"; ?>>September</option>
			<option value="10" <?php if($currentMonth == '10') echo"selected='selected'"; ?>>Oktober</option>
			<option value="11" <?php if($currentMonth == '11') echo"selected='selected'"; ?>>November</option>
			<option value="12" <?php if($currentMonth == '12') echo"selected='selected'"; ?>>Desember</option>
		</select>
		<select name="tahun">
			<option>Tahun</option>
			<?php 
			$t = 6;
			for ($a=0; $a <= $t ; $a++) { 
				$tahun = date('Y')-6+$a;
				echo $tahun.'<br>';
			?>
			
			<option value="<?php echo $tahun ?>" <?php if($_POST['tahun'] == $tahun || ($_POST['tahun'] == null && $currentYear == $tahun)) echo"selected='selected'"; ?>><?php echo $tahun ?></option>
			<?php } ?>
		</select>	
		<select name="outlet">
		    <option>Semua outlet</option>
		    <?php
		        $outlets = mysqli_query($con, "SELECT nama_outlet FROM outlet");
		        while($row = mysqli_fetch_array($outlets)) {
		            $outletName = $row[0];
		            $option = "<option value='$outletName' ";
		            if ($outlet == $outletName) {
		                $option = $option." selected = 'selected'";
		            }
		            $option = $option.">$outletName</option>";
		            echo $option;
                }
		    ?>
		</select>
		<input type="submit" name="cari" value="Search">
	</form>
</div><br>

<div>
	<table border="1">
		<thead>
			<tr>
				<th style="padding: 10px; text-align: center" rowspan="2">ID</th>
				<th style="padding: 10px; text-align: center" rowspan="2">Nama Customer</th>
				<th style="padding: 10px; text-align: center" rowspan="2">Outlet</th>
				<th style="padding: 10px; text-align: center" colspan="5">Frekuensi Kunjungan</th>
				<th style="padding: 10px; text-align: center" colspan="5">Kontribusi Omset</th>
				<th style="padding: 10px; text-align: center" colspan="5">Frekuensi Penggunaan Promo</th>
				<th style="padding: 10px; text-align: center" colspan="5">Total Discount</th>
			</tr>
			<tr>
			    <th style="padding: 10px">W1</th>
			    <th style="padding: 10px">W2</th>
			    <th style="padding: 10px">W3</th>
			    <th style="padding: 10px">W4</th>
			    <th style="padding: 10px">Total</th>
			    <th style="padding: 10px">W1</th>
			    <th style="padding: 10px">W2</th>
			    <th style="padding: 10px">W3</th>
			    <th style="padding: 10px">W4</th>
			    <th style="padding: 10px">Total</th>
			    <th style="padding: 10px">W1</th>
			    <th style="padding: 10px">W2</th>
			    <th style="padding: 10px">W3</th>
			    <th style="padding: 10px">W4</th>
			    <th style="padding: 10px">Total</th>
			    <th style="padding: 10px">W1</th>
			    <th style="padding: 10px">W2</th>
			    <th style="padding: 10px">W3</th>
			    <th style="padding: 10px">W4</th>
			    <th style="padding: 10px">Total</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$queryString = "SELECT id_customer, nama_customer, nama_outlet, total_bayar, tgl_input, diskon FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m')='$bulan'";
			if ($outlet != 'Semua outlet') {
			    $queryString = $queryString." AND nama_outlet = '$outlet' ";
			}
			$queryString = $queryString." ORDER BY nama_customer ASC";
			$query = mysqli_query($con, $queryString);
			$custTrxQtyW1 = array();
			$custTrxQtyW2 = array();
			$custTrxQtyW3 = array();
			$custTrxQtyW4 = array();
			$custTrxQtyTotal = array();
			$custTrxAmountW1 = array();
			$custTrxAmountW2 = array();
			$custTrxAmountW3 = array();
			$custTrxAmountW4 = array();
			$custTrxAmountTotal = array();
			$custDiscountQtyW1 = array();
			$custDiscountQtyW2 = array();
			$custDiscountQtyW3 = array();
			$custDiscountQtyW4 = array();
			$custDiscountQtyTotal = array();
			$custDiscountAmountW1 = array();
			$custDiscountAmountW2 = array();
			$custDiscountAmountW3 = array();
			$custDiscountAmountW4 = array();
			$custDiscountAmountTotal = array();
			$custRow = array();
			
			    while($row = mysqli_fetch_array($query)) {
			        
			        $custId = $row['id_customer'];
			        $custName = $row['nama_customer'];
			        $outlet = $row['nama_outlet'];
			        $tglInput = $row['tgl_input'];
			        $disc = $row['diskon'];
			        
			        // Transaction Frequency
			        $trxQtyTotal = 0;
			        if (!empty($custTrxQtyTotal[$custId])) {
			            $trxQtyTotal = $custTrxQtyTotal[$custId];
			        }
			        $trxQtyTotal = $trxQtyTotal+1;
			        $custTrxQtyTotal[$custId] = $trxQtyTotal;
			        
			        $timestamp = strtotime($tglInput);
                    $date = date('d', $timestamp);
                    
                    $trxQty = 0;
                    if ($date <= 7) {
    			        if (!empty($custTrxQtyW1[$custId])) {
    			            $trxQty = $custTrxQtyW1[$custId];
    			        }
    			        $trxQty = $trxQty+1;
    			        $custTrxQtyW1[$custId] = $trxQty;
                    } else if ($date <= 15) {
                        if (!empty($custTrxQtyW2[$custId])) {
    			            $trxQty = $custTrxQtyW2[$custId];
    			        }
    			        $trxQty = $trxQty+1;
    			        $custTrxQtyW2[$custId] = $trxQty;
                    } else if ($date <= 22) {
                        if (!empty($custTrxQtyW3[$custId])) {
    			            $trxQty = $custTrxQtyW3[$custId];
    			        }
    			        $trxQty = $trxQty+1;
    			        $custTrxQtyW3[$custId] = $trxQty;
                    } else if ($date <= 31) {
                        if (!empty($custTrxQtyW4[$custId])) {
    			            $trxQty = $custTrxQtyW4[$custId];
    			        }
    			        $trxQty = $trxQty+1;
    			        $custTrxQtyW4[$custId] = $trxQty;
                    }
			        
			        
			        // Transaction Amount
			        $trxAmountTotal = 0;
			        if (!empty($custTrxAmountTotal[$custId])) {
			            $trxAmountTotal = $custTrxAmountTotal[$custId];
			        }
			        $trxAmountTotal = $trxAmountTotal+$row['total_bayar'];
			        $custTrxAmountTotal[$custId] = $trxAmountTotal;
			        
			        $trxAmount = 0;
                    if ($date <= 7) {
    			        if (!empty($custTrxAmountW1[$custId])) {
    			            $trxAmount = $custTrxAmountW1[$custId];
    			        }
    			        $trxAmount = $trxAmount+$row['total_bayar'];
    			        $custTrxAmountW1[$custId] = $trxAmount;
                    } else if ($date <= 15) {
                        if (!empty($custTrxAmountW2[$custId])) {
    			            $trxAmount = $custTrxAmountW2[$custId];
    			        }
    			        $trxAmount = $trxAmount+$row['total_bayar'];
    			        $custTrxAmountW2[$custId] = $trxAmount;
                    } else if ($date <= 22) {
                        if (!empty($custTrxAmountW3[$custId])) {
    			            $trxAmount = $custTrxAmountW3[$custId];
    			        }
    			        $trxAmount = $trxAmount+$row['total_bayar'];
    			        $custTrxAmountW3[$custId] = $trxAmount;
                    } else if ($date <= 31) {
                        if (!empty($custTrxAmountW4[$custId])) {
    			            $trxAmount = $custTrxAmountW4[$custId];
    			        }
    			        $trxAmount = $trxAmount+$row['total_bayar'];
    			        $custTrxAmountW4[$custId] = $trxAmount;
                    }
                    
                    
                    // Disc Qty
                    if ($disc > 0) {
                        
                        $discQtyTotal = 0;
    			        if (!empty($custDiscountQtyTotal[$custId])) {
    			            $discQtyTotal = $custDiscountQtyTotal[$custId];
    			        }
    			        $discQtyTotal = $discQtyTotal+1;
    			        $custDiscountQtyTotal[$custId] = $discQtyTotal;
    			        
    			        $discQty = 0;
                        if ($date <= 7) {
        			        if (!empty($custDiscountQtyW1[$custId])) {
        			            $discQty = $custDiscountQtyW1[$custId];
        			        }
        			        $discQty = $discQty+1;
        			        $custDiscountQtyW1[$custId] = $discQty;
                        } else if ($date <= 15) {
                            if (!empty($custDiscountQtyW2[$custId])) {
        			            $discQty = $custDiscountQtyW2[$custId];
        			        }
        			        $discQty = $discQty+1;
        			        $custDiscountQtyW2[$custId] = $discQty;
                        } else if ($date <= 22) {
                            if (!empty($custDiscountQtyW3[$custId])) {
        			            $discQty = $custDiscountQtyW3[$custId];
        			        }
        			        $discQty = $discQty+1;
        			        $custDiscountQtyW3[$custId] = $discQty;
                        } else if ($date <= 31) {
                            if (!empty($custDiscountQtyW4[$custId])) {
        			            $discQty = $custDiscountQtyW4[$custId];
        			        }
        			        $discQty = $discQty+1;
        			        $custDiscountQtyW4[$custId] = $discQty;
                        }
                        
                        
                        // Disc Amount
    			        $discAmountTotal = 0;
    			        if (!empty($custDiscountAmountTotal[$custId])) {
    			            $discAmountTotal = $custDiscountAmountTotal[$custId];
    			        }
    			        $discAmountTotal = $discAmountTotal + $disc;
    			        $custDiscountAmountTotal[$custId] = $discAmountTotal;
    			        
                        $discAmount = 0;
                        if ($date <= 7) {
        			        if (!empty($custDiscountAmountW1[$custId])) {
        			            $discAmount = $custDiscountAmountW1[$custId];
        			        }
        			        $discAmount = $discAmount+$disc;
        			        $custDiscountAmountW1[$custId] = $discAmount;
                        } else if ($date <= 15) {
                            if (!empty($custDiscountAmountW2[$custId])) {
        			            $discAmount = $custDiscountAmountW2[$custId];
        			        }
        			        $discAmount = $discAmount+$disc;
        			        $custDiscountAmountW2[$custId] = $discAmount;
                        } else if ($date <= 22) {
                            if (!empty($custDiscountAmountW3[$custId])) {
        			            $discAmount = $custDiscountAmountW3[$custId];
        			        }
        			        $discAmount = $discAmount+$disc;
        			        $custDiscountAmountW3[$custId] = $discAmount;
                        } else if ($date <= 31) {
                            if (!empty($custDiscountAmountW4[$custId])) {
        			            $discAmount = $custDiscountAmountW4[$custId];
        			        }
        			        $discAmount = $discAmount+$disc;
        			        $custDiscountAmountW4[$custId] = $discAmount;
                        }

                    }
			        
			        
			        
			        
			        
			        
			        
			        // Store customer object
			        $custRow[$custId] = array('id' => $custId, 'name' => $custName, 'outlet' => $outlet);
			        
                }
                
                foreach ($custRow as $customer ) {
                                  
                    
 				?>
			
    			    <tr>
     					<td style="padding: 10px"><?php echo $customer['id']; ?></td>
     					<td style="padding: 10px"><?php echo $customer['name'] ?></td>
     					<td style="padding: 10px"><?php echo $customer['outlet'] ?></td>
     					<td style="padding: 10px"><?php echo $custTrxQtyW1[$customer['id']] ?></td>
     					<td style="padding: 10px"><?php echo $custTrxQtyW2[$customer['id']] ?></td>
     					<td style="padding: 10px"><?php echo $custTrxQtyW3[$customer['id']] ?></td>
     					<td style="padding: 10px"><?php echo $custTrxQtyW4[$customer['id']] ?></td>
     					<td style="padding: 10px"><strong><?php echo $custTrxQtyTotal[$customer['id']] ?></strong></td>
     					<td style="padding: 10px"><?php echo formatRupiah($custTrxAmountW1[$customer['id']]) ?></td>
     					<td style="padding: 10px"><?php echo formatRupiah($custTrxAmountW2[$customer['id']]) ?></td>
     					<td style="padding: 10px"><?php echo formatRupiah($custTrxAmountW3[$customer['id']]) ?></td>
     					<td style="padding: 10px"><?php echo formatRupiah($custTrxAmountW4[$customer['id']]) ?></td>
     					<td style="padding: 10px"><strong><?php echo formatRupiah($custTrxAmountTotal[$customer['id']]) ?></strong></td>
     					<td style="padding: 10px"><?php echo $custDiscountQtyW1[$customer['id']] ?></td>
     					<td style="padding: 10px"><?php echo $custDiscountQtyW2[$customer['id']] ?></td>
     					<td style="padding: 10px"><?php echo $custDiscountQtyW3[$customer['id']] ?></td>
     					<td style="padding: 10px"><?php echo $custDiscountQtyW4[$customer['id']] ?></td>
     					<td style="padding: 10px"><strong><?php echo $custDiscountQtyTotal[$customer['id']] ?></strong></td>
     					<td style="padding: 10px"><?php echo formatRupiah($custDiscountAmountW1[$customer['id']]) ?></td>
     					<td style="padding: 10px"><?php echo formatRupiah($custDiscountAmountW2[$customer['id']]) ?></td>
     					<td style="padding: 10px"><?php echo formatRupiah($custDiscountAmountW3[$customer['id']]) ?></td>
     					<td style="padding: 10px"><?php echo formatRupiah($custDiscountAmountW4[$customer['id']]) ?></td>
     					<td style="padding: 10px"><strong><?php echo formatRupiah($custDiscountAmountTotal[$customer['id']]) ?></strong></td>
     				</tr>
			
			
			
    			<?php
    			}
    			?>
		</tbody>
	</table>
</div>
