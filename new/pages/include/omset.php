<?php 
if(isset($_POST['cari'])){
	$startDate = $_POST['start'];
	$endDate = $_POST['end'];
} else {
	$startDate = date('Y/m/d', strtotime('-7 days', strtotime(date('Y-m-d'))));
	$endDate = date('Y/m/d');
}
?>



<script type="text/javascript">
	$(function(){
		$('#tanggal1').datepicker({
			dateFormat : 'yy/mm/dd',
		});

		$('#tanggal2').datepicker({
			dateFormat : 'yy/mm/dd',
		});

		$('#omset').dataTable({
            lengthMenu: [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
            // dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
		     "oLanguage": {
			      "sLengthMenu": "Tampilkan _MENU_",
			      "sSearch": "Pencarian: ", 
			      "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
			      "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
			      "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
			      "sInfoFiltered": "(di filter dari _MAX_ total data)",
			      "oPaginate": {
			          "sFirst": "<<",
			          "sLast": ">>",
			          "sPrevious": "<",
			          "sNext": ">"
		       }
	      },
          "sPaginationType":"full_numbers",
          "bJQueryUI":true,
          "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(''+pageTotal +' ( '+ total +' total )'
            );
          }

        });
	});


</script>



<form class="form-horizontal" action="" method="POST">
	<input type="text" name="start" id="tanggal1" placeholder="Mulai" autocomplete="off">
	<input type="text" name="end" id="tanggal2" placeholder="Akhir" autocomplete="off">
	<br>
		<button style="margin-top: 5px" type="submit" class="btn btn-success btn-sm" name="cari" value="Cari">Cari</button>
	
</form><hr>




<div class="table-responsive">
	<table class="table table-bordered table-hover table-striped" id="omset">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Reception</th>
				<th>Kiloan</th>
				<th>Potongan</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
		<tbody>
			<?php 
			$query = mysqli_query($con, "SELECT SUM(total_bayar) AS omset, DATE_FORMAT(tgl_input, '%Y/%m/%d') AS tanggal, nama_reception FROM reception WHERE DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate' AND nama_outlet='$outlet' AND lunas=true AND (cara_bayar<>'Void' OR cara_bayar<>'Reject') GROUP BY tanggal ORDER BY tanggal ASC");
			while($data = mysqli_fetch_array($query)){?>
				<tr>
					<td><?php echo $data['tanggal'] ?></td>
					<td><?php echo $data['nama_reception'] ?></td>
				    <td>
				        <?php 
				        $kiloan = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS omset FROM reception WHERE DATE_FORMAT(tgl_input, '%Y/%m/%d') = '$data[tanggal]' AND nama_outlet='$outlet' AND jenis='k' AND lunas=true AND (cara_bayar<>'Void' OR cara_bayar<>'Reject')");
				        $datakiloan = mysqli_fetch_row($kiloan);
				        echo $datakiloan[0];
				        ?>
				    </td>
				    <td>
				        <?php 
				        $potongan = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS omset FROM reception WHERE DATE_FORMAT(tgl_input, '%Y/%m/%d') = '$data[tanggal]' AND nama_outlet='$outlet' AND jenis='p' AND lunas=true AND (cara_bayar<>'Void' OR cara_bayar<>'Reject')");
				        $datapotongan = mysqli_fetch_row($potongan);
				        echo $datapotongan[0];
				        ?>
				    </td>
					<td><?php echo $data['omset'] ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
	