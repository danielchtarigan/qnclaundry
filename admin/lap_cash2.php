<head>
	<?php

	include "../config.php";

	function rupiah($angka)
	{
		$jadi = "Rp.".number_format($angka,0,',','.');
		return $jadi;
	}
	$tgl     = $_POST['tgl'];
	$date    = new DateTime($tgl);
	$newDate = $date->format('Y-m-d');

	$tgl2    = $_POST['tgl2'];
	$date2   = new DateTime($tgl2);
	$newDate2= $date2->format('Y-m-d');
	?>
	<script type="text/javascript">

		$(document).ready(function()
			{
				$('table#rinciancash td a.delete').click(function()
					{
						if (confirm("Are you sure you want to delete this row?"))
						{
							var id = $(this).parent().parent().attr('id');
							var data = 'id=' + id ;
							var parent = $(this).parent().parent();

							$.ajax(
								{
									type: "POST",
									url: "del_lap_cash.php",
									data: data,
									cache: false,

									success: function()
									{
										parent.fadeOut('slow', function() {$(this).remove();});
									}
								});
						}
					});

				// style the table with alternate colors
				// sets specified color for every odd row
				$('table#rinciancash tr:odd').css('background',' #FFFFFF');
			});

	</script>


</head>
<body>

	<div class="container-fluid" style="width:95%; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
		<fieldset>
			<legend align="center">
				<strong>
					Cash
				</strong>
			</legend>
			<table id="cuci" class="display">
				<thead>
					<tr>
						<th>
							no
						</th>
						<th >
							total
						</th>


					</tr>
				</thead>


				<tbody>
					<?php
					$query   = "SELECT no_faktur,total FROM faktur_penjualan WHERE (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') between '$newDate' and '$newDate2') group by rcp,DATE_FORMAT(tgl_transaksi, '%Y%m%d'),cara_bayar,nama_outlet ORDER BY tgl_transaksi ASC" ;
					$tampil  = mysqli_query($con, $query);

					while($data = mysqli_fetch_array($tampil))
					{

						?>

						<tr>
							<td>
								<?php echo $data['no_faktur'];?>
							</td>

							<td>
								<?php echo $data['total'];?>
							</td>


						</tr>

						<?php
					}
					?>
				</tbody>








			</table>
		</fieldset>
	</div>
	<div class="container-fluid" style="width:100%; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">


		<fieldset>
			<legend align="center">
				<strong>
					Rincian Cash
				</strong>
			</legend>
			<table id="rinciancash" class="display">
				<thead>
					<tr>
						<th>
							No faktur
						</th>
						<th >
							Jumlah
						</th>

					</tr>
				</thead>


				<tbody>
					<?php
					$query = "SELECT sum(total_bayar) as jumlah,no_faktur FROM reception WHERE (DATE_FORMAT(tgl_lunas, '%Y-%m-%d') between '$newDate' and '$newDate2') GROUP BY no_faktur " ;
					$tampil= mysqli_query($con, $query);

					while($data = mysqli_fetch_array($tampil))
					{
						
						?>

						<tr>
							<td>
								<?php echo $data['no_faktur'];?>
							</td>
							<td>
								<?php echo $data['jumlah'];?>
							</td>


						</tr>

						<?php
					}
					?>
				</tbody>








			</table>
		</fieldset>



	</div>
</body>
<script type="text/javascript">
	$(document).ready(function()
		{
			$('#cuci').dataTable(
				{
					"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
					dom: 'T<"clear">lfrtip',
					tableTools:
					{
						"sSwfPath": "swf/copy_csv_xls_pdf.swf",
						"aButtons": [
							{
								"sExtends": "copy",
								"mColumns": [0,1,2,4,5,6,7,8],
								"oSelectorOpts":
								{
									filter: "applied", order: "current"
								}
							},
							{
								'sExtends': 'xls',
								"mColumns": [0,1,3,4,5,6,7,8],
								"oSelectorOpts":
								{
									filter: 'applied', order: 'current'
								}
							},

							{
								'sExtends': 'print',
								"mColumns": [0,1,2,4,5,6,7,8],
								"oSelectorOpts":
								{
									filter: 'applied', order: 'current'
								}
							}

						]
					},
					"columnDefs": [
						{
							"targets": [0],
							"visible": true,
							"searchable": true,"width":"5%",
						},
						{
							"width": "50%", "targets": [1]
						}
					],


					
					"aaSorting": [[ 0, "desc" ]],
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 5
				});

			$('#rinciancash').dataTable(
				{
					"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
					dom: 'T<"clear">lfrtip',
					tableTools:
					{
						"sSwfPath": "swf/copy_csv_xls_pdf.swf",
						"aButtons": [
							{
								"sExtends": "copy",
								"mColumns": [0,1,2,4,5,6,7],
								"oSelectorOpts":
								{
									filter: "applied", order: "current"
								}
							},
							{
								'sExtends': 'xls',
								"mColumns": [0,1,3,4,5,6,7],
								"oSelectorOpts":
								{
									filter: 'applied', order: 'current'
								}
							},

							{
								'sExtends': 'print',
								"mColumns": [0,1,2,4,5,6,7],
								"oSelectorOpts":
								{
									filter: 'applied', order: 'current'
								}
							}

						]
					},
					"columnDefs": [
						{
							"targets": [0],
							"visible": true,
							"searchable": true,"width":"5%",
						},
						{
							"width": "50%", "targets": [1]
						}
					],

					"footerCallback": function ( row, data, start, end, display )
					{
						var api = this.api(), data;

						// Remove the formatting to get integer data for summation
						var intVal = function ( i )
						{
							return typeof i === 'string' ?
							i.replace(/[\$,]/g, '')*1 :
							typeof i === 'number' ?
							i : 0;
						};

						// Total over all pages
						total = api
						.column(1)
						.data()
						.reduce( function (a, b)
							{
								return intVal(a) + intVal(b);
							});

						// Total over this page
						pageTotal = api
						.column( 1, { page: 'current'} )
						.data()
						.reduce( function (a, b)
							{
								return intVal(a) + intVal(b);
							}, 0);

						// Update footer
						$( api.column( 1 ).footer() ).html(
							''+pageTotal +' ( '+ total +' total)'
						);
					},
					"aaSorting": [[ 0, "desc" ]],
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 5
				});

		});
</script>