
<script type="text/javascript">
	$(document).ready(function(){
		$('#cara').dataTable({
		    "iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"order": [[0,"desc"]],
			"columnDefs": [
             	{                 	
                 	"visible": true,
                 	"searchable": true,"width":"5%",
            	 },  { "width": "12%", "targets": 0 }
         	],  
			dom: 'T<"clear">lfrtip',
         	tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf", 
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },  
                    		"aaSorting": [[ 0, "desc" ]],
            				"bJQueryUI" : true,
            				"sPaginationType" : "full_numbers",
            				 "iDisplayLength": 10
            				
                    		
		}).yadcf([
                {
                column_number : 0,
                filter_type: 'range_date',
                date_format: "yyyy-mm-dd"
                },
            ]);
           
		
	});									
</script>

<style type="text/css">
	th{		
		color:green;
		font-weight: bold;
		text-align: center;
		font-size: 14px;
	}
</style>

<h2><center>Tabel Cara Bayar Order Retail</center></h2><br>

<div style="height: 50px; color: green; font-size: 14px">
	<form action="" method="POST">
		<label>Pencarian Bulanan</label>
		<select name="bulan">
			<option>Bulan</option>
			<option value="01">Januari</option>
			<option value="02">Februari</option>
			<option value="03">Maret</option>
			<option value="04">April</option>
			<option value="05">Mei</option>
			<option value="06">Juni</option>
			<option value="07">Juli</option>
			<option value="08">Agustus</option>
			<option value="09">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">Desember</option>
		</select>
		<select name="tahun">
			<option>Tahun</option>
			<?php 
			$t = 6;
			for ($a=0; $a <= $t ; $a++) { 
				$tahun = date('Y')-6+$a;
				echo $tahun.'<br>';
			?>
			
			<option value="<?php echo $tahun ?>"><?php echo $tahun ?></option><?php } ?>
		</select>	
		<input type="submit" name="cari" value="Search">
	</form>
</div><hr>



<div>
	<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover" id="cara">
			<thead>
				<tr>
					<th>Tanggal Lunas</th>
					<th>No Faktur</th>
					<th>Cara Bayar</th>
					<th>Jumlah Bayar</th>
					<th>Resepsionis</th>
					<th>Outlet</th>
					<th>Id Customer</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php
					
					if(isset($_POST['cari'])){
						$bulan = $_POST['bulan'];
						$tahun = $_POST['tahun'];
					}
					else{
						$bulan = date('m');
						$tahun = date('Y');
					}	
					$no = 31;	
					
					for ($i=1; $i<=$no; $i++) {
						$tanggal = $tahun.'-'.$bulan.'-'.sprintf('%02s', $i);							

					$carabayar = mysqli_query($con, "select *from cara_bayar where tanggal_input like '%$tanggal%' ");
					while($cbayar = mysqli_fetch_array($carabayar)){
						$carab = $cbayar['cara_bayar'];
						if ($carab == 'Kuota') {
							$fpenjualan = mysqli_query($con, "select *from faktur_penjualan where cara_bayar = '$carab' and tgl_transaksi like '%$tanggal%' and no_faktur='$cbayar[no_faktur]' ");
							$fakturp = mysqli_fetch_array($fpenjualan);
							$jumlah = $fakturp['total'];
						}
						else{
							$jumlah = $cbayar['jumlah'];
						}

					?>
					<td><?php echo $tanggal ?></td>
					<td><?php echo $cbayar['no_faktur'] ?></td>
					<td style="text-align: center"><?php echo $cbayar['cara_bayar'] ?></td>
					<td style="text-align: right"><?php echo rupiah ($jumlah) ?></td>
					<td><?php echo $cbayar['resepsionis'] ?></td>
					<td><?php echo $cbayar['outlet'] ?></td>
					<td><?php 
					$custs = mysqli_query($con, "SELECT id_customer FROM faktur_penjualan WHERE no_faktur='$cbayar[no_faktur]'");
					$cust = mysqli_fetch_row($custs);
					echo $cust[0];
					 ?></td>
					
				</tr>
				<?php } }?>
			</tbody>
		</table>
	</div>
</div>
	

