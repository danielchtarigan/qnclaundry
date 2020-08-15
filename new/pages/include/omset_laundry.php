
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
				<th>Nama Outelet</th>
				<th>Laundry</th>
				<th>Membership</th>
				<th>Langganan</th>
				<th>Locker</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th colspan="2" style="text-align:right">Total:</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
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
			let userId = '<?= $_SESSION['id'] ?>';
			let startDate = $('#tanggal1').val();
			let endDate = $('#tanggal2').val();
			let outlet = '<?= $_SESSION['outlet'] ?>';
			$('#omset').DataTable().destroy();
			datatable(startDate, endDate, outlet, userId);
		});
		
		function datatable(startDate, endDate, outlet, userId) {
			let datatable = $('#omset').DataTable({
				"processing": true,
				"ajax": {
					url: "https://qnclaundry.com/apps/SalesInvoice/omset/"+userId,
					type: "POST",
					data: {startDate:startDate, endDate:endDate, outlet:outlet}
				},
				"columns": [
					{ "data": "tgl" },
					{ "data": "nama_outlet" },
					{ 
						"data": "laundry",  
						render: function ( data, type, row ) {
							return Number(data).toLocaleString("id-ID");
						} 
					},
					{ 
						"data": "membership",  
						render: function ( data, type, row ) {
							return Number(data).toLocaleString("id-ID");
						} 
					},
					{ 
						"data": "langganan",  
						render: function ( data, type, row ) {
							return Number(data).toLocaleString("id-ID");
						} 
					},
					{ 
						"data": "locker",  
						render: function ( data, type, row ) {
							return Number(data).toLocaleString("id-ID");
						} 
					},
					{ 
						"data": "total",  
						render: function ( data, type, row ) {
							return Number(data).toLocaleString("id-ID");
						} 
					},
				],

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
					let totalLaundry = api
						.column( 2 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );

					let totalMember = api
						.column( 3 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );

					let totalLangganan = api
						.column( 4 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );

					let totalLocker = api
						.column( 5 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );

					let total = api
						.column( 6 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		
					// Total over this page
					// pageTotal = api
					// 	.column( 4, { page: 'current'} )
					// 	.data()
					// 	.reduce( function (a, b) {
					// 		return intVal(a) + intVal(b);
					// 	}, 0 );
		
					// Update footer
					$( api.column( 2 ).footer() ).html(
						 'Rp '+ totalLaundry.toLocaleString("id-ID")
					);
					$( api.column( 3 ).footer() ).html(
						 'Rp '+ totalMember.toLocaleString("id-ID")
					);
					$( api.column( 4 ).footer() ).html(
						 'Rp '+ totalLangganan.toLocaleString("id-ID")
					);
					$( api.column( 5 ).footer() ).html(
						 'Rp '+ totalLocker.toLocaleString("id-ID")
					);
					$( api.column( 6 ).footer() ).html(
						 'Rp '+ total.toLocaleString("id-ID")
					);
				}
			})
		}
            
	});


</script>