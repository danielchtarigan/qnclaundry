
<div class="app-title">
<div>
  <h1><i class="fa fa-th-list"></i> Tables</h1>
  <p>Omset Penjualan Kiloan & Potongan</p>
</div>
<ul class="app-breadcrumb breadcrumb side">
  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
  <li class="breadcrumb-item">Tables</li>
  <li class="breadcrumb-item active"><a href="#">Sales Omset Laundry</a></li>
</ul>
</div>


<div class="tile">
<div class="tile-body">
  <h4>Select Range</h4>
  <form class="row" method="POST" action="#" id="filter_range">
    <div class="form-group col-md-3">
      <input class="form-control" type="" placeholder="Select Start Date" id="startDate" name="startDate" autocomplete="off">
    </div>
    <div class="form-group col-md-3">
      <input class="form-control" type="" placeholder="Select End Date" id="endDate" name="endDate" autocomplete="off">
    </div>
    <div class="form-group col-md-4 align-self-end">
      <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
    </div>
  </form>
</div>
</div>

<div class="tile">
<div class="tile-body">
  <h4>Omset Kiloan & Potongan</h4>
  <div class="table-responsive">
    <table id="omset" class="table table-bordered table-hover table-striped" style="width:100%">
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
				<th colspan="2" style="text-align:right">Total:</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
  </div>
      
</div>
</div>

<script type="text/javascript">

	$(function(){
		$('#filter_range').on('submit', function (e) {
			e.preventDefault();
			let token = $('meta[name=branch_token]').attr('content');
			let userId = '<?= $_SESSION['id'] ?>';
			let startDate = $('#startDate').val();
			let endDate = $('#endDate').val();
			let outlet = '<?= $_SESSION['outlet'] ?>';
			$('#omset').DataTable().destroy();
			datatable(startDate, endDate, outlet, userId, token);
		});
		
		function datatable(startDate, endDate, outlet, userId, token) {
			let datatable = $('#omset').DataTable({
				"processing": true,
				"ajax": {
					url: apiURL+"SalesInvoice/omset_order/",
					type: "POST",
					data: {startDate:startDate, endDate:endDate, outlet:outlet, userId: userId},
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
					{ "data": "tgl" },
					{ "data": "reception" },
					{ 
						"data": "kiloan",  
						render: function ( data, type, row ) {
							return Number(data).toLocaleString("id-ID");
						} 
					},
					{ 
						"data": "potongan",  
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
					let kiloan = api
						.column( 2 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );

					let potongan = api
						.column( 3 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );

					let total = api
						.column( 4 )
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
						 'Rp '+ kiloan.toLocaleString("id-ID")
					);
					$( api.column( 3 ).footer() ).html(
						 'Rp '+ potongan.toLocaleString("id-ID")
					);
					$( api.column( 4 ).footer() ).html(
						 'Rp '+ total.toLocaleString("id-ID")
					);
				}
			})
		}
            
	});

</script>