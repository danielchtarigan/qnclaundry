
<style>
	table#langganan tfoot>tr>th {
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
	<table id="langganan" class="table table-bordered table-hover table-striped" style="width:100%">
		<thead>
			<tr>
				<th>Nama Customer</th>
				<th>Telepon</th>
				<th>Kuota Kiloan</th>
				<th>Kuota Potongan</th>
				<th>Aktif</th>
				<th>Berakhir</th>
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
			$('#langganan').DataTable().destroy();
			datatable(start_at, end_at, outlet, token);
		});
		
		function datatable(start_at, end_at, outlet, token) {
			let datatable = $('#langganan').DataTable({
				"processing": true,
				"ajax": {
					url: apiURL+"Langganan/index/"+outlet,
					type: "POST",
					data: {start_at:start_at, end_at:end_at, outlet:outlet, token: token},
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
                    { "data": "name" },
                    { "data": "telp" },
                    { 
                        "data": "kiloan",
                        render: function ( data, type, row ) {
							return Number(data).toString().replace(".", ",");
						} 
                    },
                    { "data": "potongan" },
                    { "data": "join_at" },
                    { "data": "end_at" }
                ],
			})
		}
            
	});


</script>

<style>
    #langganan_wrapper .row:nth-child(odd) {
        padding: 10px 10px 4px !important;
    }
</style>