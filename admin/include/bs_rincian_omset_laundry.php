<style type="text/css">
	.ffr {
		margin-bottom: 5px;
	}
</style>

<div class="row">
	<div class="col-lg-4 col-md-4">
		<form class="form-horizontal" id="rangeDate">
			<div class="ffr">
				<input class="form-control" type="text" name="" id="start" required="" placeholder="dari" autocomplete="off">
			</div>
			<div class="ffr">
				<input class="form-control" type="text" name="" id="end" required="" placeholder="sampai" autocomplete="off">
			</div>

			<div class="ffr">
				<input class="btn btn-default btn-sm btn-block" type="submit" name="" value="Jaringan">
			</div>
			
		</form>
	</div>

	<div class="col-md-8 col-lg-8">
		<form class="jaringan" style="display: none;">
			<div class="ffr">
				<button class="btn btn-block" disabled="">Pilih Jaringan</button>
			</div>
			<div class="ffr">
				<select class="form-control" id="jaringan">
					<?php 
					$sql = $con-> query("SELECT cabang FROM cabang ORDER BY cabang ASC");
					while($res = $sql -> fetch_array()){
						echo '<option value='.$res['cabang'].'>'.$res['cabang'].'</option>';
					}

					?>
				</select>
			</div>

			<div class="ffr">
				<input class="btn btn-success btn-sm btn-block" type="submit" name="" value="Cari Omset">
			</div>
		</form>
	</div>

</div>
<hr>
<h4>Penjualan Laundry</h4>
<div class="table-responsive" style="overflow-x:auto">
	<table class="table table-bordered table-striped table-condensed result" style="font-size: 12px;" id="result">
		<thead>
            <tr>
				<th>Tanggal</th>
				<th>Nama Outlet</th>
				<th>Nama Customer</th>
				<th>Nomor Order</th>
				<th>Dibuat Oleh</th>
				<th>Harga</th>
				<th>Kode Promo</th>
				<th>Diskon</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="10" align="center">Data belum tersedia</td>
			</tr>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	jQuery(function($){
		$('#start, #end').datepicker({
			dateFormat : 'yy-mm-dd',
		});

		$('#rangeDate').submit(function(e){
			e.preventDefault();
			$('.jaringan').slideToggle("slow");
		});

		$('.jaringan').submit(function(e){
			e.preventDefault();			
			destroy_datatable();

			var jar = $('#jaringan').val();
			var start = $('#start').val();
			var end = $('#end').val();

			$.ajax({
				url			: 'include/bs_details_omset_laundry.php',
				data 		: {start : start, end : end, jar : jar},
				beforeSend : function(){
					$('#result').slideDown().html("<p align='center'>Memuat Data...</p>");
				},
				success 	: function(data){
					$('#result').html(data);
					datatable();
				} 
			})

		})
		
	});

	function destroy_datatable() {
		if ( $.fn.DataTable.isDataTable('#result') ) {
				$('#result').DataTable().destroy();
			}
			$('#result tbody').empty();
	}

	function datatable() {
		$('#result').dataTable({
            "order": [[ 0,"desc" ]],
            "iDisplayLength": 5,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
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
                    .column( 8 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Total over this page
                pageTotal = api
                    .column( 8, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                $( api.column( 8 ).footer() ).html(
                    'Rp '+pageTotal.toLocaleString("id-ID") +' (Rp '+ total.toLocaleString("id-ID") +')'
                );
            }	
        })
	}
</script>

