<h4><strong>Pengaturan SMS Cucian Selesai</strong></h4>
<?php
$qcustomer = mysqli_query($con, "select * from sms_kembali");
$rcustomer = mysqli_fetch_array($qcustomer);
?>
			<div class="col-md-8 col-md-offset-0" >
			<form action="act/sms_kembali.php" method="get" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left">Isi SMS</p>
					</label>
					<div class="col-xs-4">
						<textarea name="sms" id="sms" cols="50" rows="10"><?php echo $rcustomer['sms']; ?></textarea>
					</div>
				</div>
				<button type="submit" class="btn btn-default">Save</button>   
			</form>			
			</div>