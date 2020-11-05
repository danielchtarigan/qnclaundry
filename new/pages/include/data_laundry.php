
<style>
	table#laundry tfoot>tr>th {
		background-color: #8de3d5;
	}
</style>

<form class="form-horizontal" action="#">
	<input type="text" name="start" id="tanggal1" placeholder="Mulai" autocomplete="off">
	<input type="text" name="end" id="tanggal2" placeholder="Akhir" autocomplete="off">
	<br>
	<button style="margin-top: 5px" type="button" class="btn btn-success btn-sm" name="cari" value="Cari" id="cari">Cari</button>
	
</form><hr>

<div class="table-responsive">
	<table id="laundry" class="table table-bordered table-hover table-striped" style="width:100%">
		<thead>
			<tr>
				<th>Customer</th>
				<th>No Nota</th>
				<th>Tgl Masuk</th>
				<th>Tgl Cuci</th>
				<th>Tgl Kering</th>
				<th>Tgl Setrika</th>
				<th>Tgl Packing</th>
				<th>Tgl Kembali</th>
				<th>Tgl Ambil</th>
			</tr>
		</thead>
	</table>
</div>


<script type="text/javascript">
	$(function(){
		$('#tanggal1').datepicker({
			dateFormat : 'yy/mm/dd',
		});

		$('#tanggal2').datepicker({
			dateFormat : 'yy/mm/dd',
        });

        let token = $('meta[name=branch_token]').attr('content');
        let outlet = '<?= $_SESSION['outlet'] ?>';
        
		$('button#cari').on('click', function (e) {
            e.preventDefault();            
			let start_at = $('#tanggal1').val();
			let end_at = $('#tanggal2').val();
			$('#laundry').DataTable().destroy();
			datatable(start_at, end_at, outlet, token);
		});
		
		function datatable(start_at, end_at, outlet, token) {
			let datatable = $('#laundry').DataTable({
				"processing": true,
                "order": [[ 2, "asc" ]],
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"ajax": {
					url: apiURL + "SalesOrder/data_laundry/",
					type: "POST",
					data: {start_at:start_at, end_at:end_at, outlet:outlet},
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
                    { "data": "nama_customer" },
                    { "data": "no_nota" },
                    { "data": "tgl_input" },
                    { "data": "tgl_cuci" },
                    { "data": "tgl_pengering" },
                    { "data": "tgl_setrika" },
                    { "data": "tgl_packing" },
                    { "data": "tgl_kembali" },
                    { "data": "tgl_ambil" }
                ],
			})
		}
            
	});


</script>

<style>
    #laundry_wrapper .row:nth-child(odd) {
        padding: 10px 10px 4px !important;
    }
    tbody>tr>td {
        font-size: 1.1rem;
    }
</style>