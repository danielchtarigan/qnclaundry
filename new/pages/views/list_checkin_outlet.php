
<style>
	table#omset tfoot>tr>th {
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
	<table id="omset" class="table table-bordered table-hover table-striped" style="width:100%">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Kode Checkin</th>
				<th>Driver</th>
				<th>Kasir</th>
				<th>Jumlah</th>
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

		$('button#cari').on('click', function (e) {
			e.preventDefault();			
			let startDate = $('#tanggal1').val();
			let endDate = $('#tanggal2').val();
			$('#omset').DataTable().destroy();
			datatable(startDate, endDate, outletId, "in");
		});

        let d = new Date();
        let year = d.getFullYear();
        let month = ("0" + (d.getMonth() + 1)).slice(-2);
		let date = ("0" + d.getDate()).slice(-2);
        let nowDate = `${year}/${month}/${date}`;

        datatable(nowDate, nowDate, outletId, "in");
		
		function datatable(startDate, endDate, outletId, type) {
            let token = $('meta[name=branch_token]').attr('content');
			let datatable = $('#omset').DataTable({
				"processing": true,
				"ajax": {
					url: apiURL+"CheckOutletDelivery/list",
					type: "POST",
					data: {startDate:startDate, endDate:endDate, outlet_id:outletId, type: type},
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
					{ "data": "date" },
					{ "data": "code", render: function (data, type, row) {
						return '<a href=\"document/checkin.php?ot&d='+data+'\" target=\"_blank\">'+data+'</a>';
					}},
					{ "data": "driver" },
					{ "data": "kasir" },
					{ "data": "count" }
				],

			})
		}
            
	});


</script>