<div class="container">
<p style="font-size:16px; font-weight:bold">Log Delivery</th>
	<form action="act/delivery2.php" method="POST" class="form-horizontal" name="input">
<br>	
		<div class="form-group">
			<label class="control-label col-md-2" for="nama">Nama Delivery</label>				
				<div class="col-md-3">					
					<select name="nama_delivery" class="form-control" required="required">
						<option value=""></option>
						<option value="Mety" >Mety</option>
						<option value="Rizal">Rizal</option>
						<option value="Zul" >Zul</option>
						<option value="Sulli">Sulli</option>  
                                                <option value="Ari">Ari</option
					</select>
				</div>
		</div>			
			<label class="control-label col-md-2" for="menu"></label>
				<div class="col-md-3">
				<input type="submit" class="btn btn-primary" name="masuk" value="Masuk">				
				</div>
	</form>
</div>
<hr>


<body>	
	<div  class="container-fluid" style="width:800px; font-size:8px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); color:#000000; margin-bottom:10px; margin-top:15px">
		<p style="font-weight:bold; font-size:16px">Laporan Delivery Part-Time</p>
		<table class="table table-bordered table-stripped table-hover" style="font-size:12px">
			<thead>
				<tr>
					<th>Tanggal</th>
					<th>Nama Delivery</th>
					<th>Outlet</td>
					<th>Masuk Pukul</th>
					<th>Pulang Pukul</th>
					<th>Delivered</th>
					<th>Collected</th>					
				</tr>
			</thead>

				

<tbody>
<?php
$q=mysqli_query($con, "SELECT DATE_FORMAT(masuk, '%Y-%m-%d') as tanggal,nama_delivery,nama_outlet,TIME_FORMAT(masuk, '%H:%i:%s') as masuk,TIME_FORMAT(pulang, '%H:%i:%s') as pulang,antar,jemput FROM log_delivery2 GROUP BY masuk,nama_delivery,nama_outlet order by id DESC LIMIT 4");
WHILE ($view=mysqli_fetch_array($q)){

?>
				<tr>
					<td><?php echo $view['tanggal'];?></td>
					<td><?php echo $view['nama_delivery'];?></td>
					<td><?php echo $view['nama_outlet'];?></td>
					<td><?php echo $view['masuk'];?></td>
					<td><?php echo $view['pulang'];?></td>
					<td><?php echo $view['antar'];?></td>
					<td><?php echo $view['jemput'];?></td>				
				</tr>
<?php
}
?>
			</tbody>
		</table>
	</div>

	
<div class="container col-md-20 col-md-offset-0">
<div class="form-group">
	<label class="control-label col-md-2" for="antar"></label>
		<div class="col-md-2">			
			<a type="button" class="btn btn-danger" href="index.php?menu=pulang_delivery" > Pulang</a>
		</div>
		
</div>
</div>			
</body>		