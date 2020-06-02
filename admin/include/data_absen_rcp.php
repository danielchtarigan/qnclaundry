<script type="text/javascript">
$(document).ready(function(){
			oTable = $('#dabsen').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],

                dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        
                        {
                            'sExtends': 'xls',
                            
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
		 {column_number : 1},{column_number : 5},
	    
	    ]);
});
</script>


<div class="table-responsive">
	<table class="table table-bordered table-hover table-condensed table-striped" id="dabsen">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Resepsionis</th>
				<th>Masuk</th>
				<th>Pulang</th>
				<th>Durasi Kerja</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$query = mysqli_query($con, "SELECT DATE_FORMAT(b.tgl_log, '%Y-%m-%d') AS tanggal, b.id_user AS username, TIME_FORMAT(b.tgl_log, '%H:%i:%s') AS masuk FROM user AS a INNER JOIN log_rcp AS b ON a.name=b.id_user WHERE DATE_FORMAT(b.tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND b.id_outlet<>'mojokerto' AND a.aktif='Ya' ORDER BY b.id_user ");
		while($data = mysqli_fetch_array($query)){
			$username = $data['username']; 
			$tanggal = $data['tanggal']; 
			$masuk = $data['masuk'];?>
			<tr>
				<td><?php echo $tanggal ?></td>
				<td><?php echo $username; ?></td>
				<td><?php echo $masuk ?></td>
				<?php 
				$tutup_kasir = mysqli_query($con, "SELECT MAX(TIME_FORMAT(tanggal, '%H:%i:%s')) AS pulang FROM tutup_kasir WHERE DATE_FORMAT(tanggal, '%Y-%m-%d')='$tanggal' AND reception='$username' ");
				$datat = mysqli_fetch_row($tutup_kasir);
				$pulang = $datat[0];

				$selisih = mysqli_query($con, "SELECT TIMEDIFF('$pulang', '$masuk') AS selisih");
				$datattt = mysqli_fetch_row($selisih);
				$durasi = $datattt[0];
				?>
				<td><?php echo $pulang ?></td>
				<td><?php echo $durasi ?></td>
				<td><?php if($durasi>='11:00:00') echo '12 Jam'; else if($durasi<'11:00:00' AND $durasi>='07:00:00') echo '8 Jam'; else if($durasi<'07:00:00' AND $durasi>='04:00:00') echo '4 Jam'; else echo 'Tidak Ceklog Pulang'; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>