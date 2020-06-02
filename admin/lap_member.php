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
					Membership/Deposit
				</strong>
			</legend>
			<table id="cuci" class="display">
				<thead>
					<tr>
						<th>
							Tgl
						</th>
						<th >
							rcp
						</th>
						<th>
							Jumlah
						</th>
						<th hidden="true">
						</th>

						<th>
							cara bayar
						</th>

						<th>
							outlet
						</th>
						<th>
							Jenis
						</th>

					</tr>
				</thead>
				<tfoot>
					<tr>
						<th colspan="2" style="text-align:right">
							Total:
						</th>
						<th>
						</th>
					</tr>
				</tfoot>

				<tbody>
					<?php
					$query   = "SELECT a.no_faktur,a.nama_outlet,DATE_FORMAT(a.tgl_transaksi, '%Y-%m-%d') as tgl_transaksi,sum(a.total) as jumlah,a.rcp,a.cara_bayar,a.jenis_transaksi FROM faktur_penjualan a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND (DATE_FORMAT(a.tgl_transaksi, '%Y-%m-%d') between '$newDate' and '$newDate2') and (a.jenis_transaksi='membership' or a.jenis_transaksi='deposit') group by a.rcp,a.nama_outlet,DATE_FORMAT(a.tgl_transaksi, '%Y%m%d'),a.cara_bayar,a.jenis_transaksi ORDER BY a.tgl_transaksi ASC" ;

					$tampil  = mysqli_query($con, $query);

					while($data = mysqli_fetch_array($tampil)){

						?>

						<tr>
							<td>
								<?php echo $data['tgl_transaksi'];?>
							</td>

							<td>
								<?php echo $data['rcp'];?>
							</td>
							<td>
								<?php echo rupiah($data['jumlah']);?>
							</td>
							<td hidden="true">
								<?php echo $data['jumlah'];?>
							</td>
							<td>
								<?php echo $data['cara_bayar'];?>
							</td>
							<td>
								<?php echo $data['nama_outlet'];?>
							</td>
							<td>
								<?php echo $data['jenis_transaksi'];?>
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
					Rincian Membership/Deposit
				</strong>
			</legend>
			<table id="rinciancash" class="display">
				<thead>
					<tr>
						<th>
							Tgl
						</th>
						<th >
							rcp
						</th>
						<th>
							Jumlah
						</th>
						<th hidden="true">
						</th>
						<th>
							cara bayar
						</th>
						<th>
							outlet
						</th>
						<th>
							no faktur
						</th>
						<th>
							nama customer
						</th>
						<th>
							Jenis
						</th>
						<!--<th>-->
						<!--	Hapus-->
						<!--</th>-->
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th colspan="2" style="text-align:right">
							Total:
						</th>
						<th>
						</th>
					</tr>
				</tfoot>

				<tbody>
					<?php
					$query = "SELECT a.jenis_transaksi ,a.nama_outlet,a.cara_bayar, a.tgl_transaksi,a.rcp,a.total as jumlah,a.no_faktur,a.id,a.id_customer FROM faktur_penjualan a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND (DATE_FORMAT(a.tgl_transaksi, '%Y-%m-%d') between '$newDate' and '$newDate2') and (a.jenis_transaksi='membership' or a.jenis_transaksi='deposit')  ORDER BY a.tgl_transaksi ASC" ;
					$tampil= mysqli_query($con, $query);

					while($data = mysqli_fetch_array($tampil))
					{
						$hr = $data['id_customer'];
						
						?>

						<tr id="<?php echo $data['id'] ; ?>">
							<td>
								<?php echo $data['tgl_transaksi'];?>
							</td>
							<td>
								<?php echo $data['rcp'];?>
							</td>
							<td>
								<?php echo rupiah($data['jumlah']);?>
							</td>
							<td hidden="true">
								<?php echo $data['jumlah'];?>
							</td>
							<td>
								<?php echo $data['cara_bayar'];?>
							</td>
							<td>
								<?php echo $data['nama_outlet'];?>
							</td>
							<td>
								<a href="d_faktur_penjualan.php"><?php echo $data['no_faktur'];?></a>
							</td>
							<td>
								<?php

								$sql4 = mysqli_query($con,"SELECT nama_customer FROM customer WHERE id='$hr'");
								$s2   = mysqli_fetch_array($sql4);
								$nama = $s2['nama_customer'];
								echo $nama ;
								?>
							</td>
							<td>
								<?php echo $data['jenis_transaksi'];?>
							</td>
							<!--<td>-->
							<!--	<a href="#" class="delete" style="color:#FF0000;">-->
							<!--		<img alt="" align="absmiddle" border="0"  />hapus-->
							<!--	</a>-->
							<!--</td>-->
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
								"mColumns": [0,1,2,4,5],
								"oSelectorOpts":
								{
									filter: "applied", order: "current"
								}
							},
							{
								'sExtends': 'xls',
								"mColumns": [0,1,3,4,5],
								"oSelectorOpts":
								{
									filter: 'applied', order: 'current'
								}
							},

							{
								'sExtends': 'print',
								"mColumns": [0,1,2,4,5],
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
							"searchable": true,"width":"10%",
						},
						{
							"width": "50%", "targets": [2]
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
						.column(3)
						.data()
						.reduce( function (a, b)
							{
								return intVal(a) + intVal(b);
							});

						// Total over this page
						pageTotal = api
						.column( 3, { page: 'current'} )
						.data()
						.reduce( function (a, b)
							{
								return intVal(a) + intVal(b);
							}, 0);

						// Update footer
						$( api.column( 2 ).footer() ).html(
							''+pageTotal +' ( '+ total +' total)'
						);
					},
					"aaSorting": [[ 0, "desc" ]],
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 5
				}).yadcf([
					
					{
						column_number : 1
					},
					{
						column_number : 5
					},
					{
						column_number : 6
					}


				]);

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
								"mColumns": [0,1,2,4,5,6,7,8],
								"oSelectorOpts":
								{
									filter: "applied", order: "current"
								}
							},
							{
								'sExtends': 'xls',
								"mColumns": [0,1,3,4,5,6],
								"oSelectorOpts":
								{
									filter: 'applied', order: 'current'
								}
							},

							{
								'sExtends': 'print',
								"mColumns": [0,1,2,4,5,6],
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
							"searchable": true,"width":"20%",
						},
						{
							"width": "50%", "targets": [2]
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
						.column(3)
						.data()
						.reduce( function (a, b)
							{
								return intVal(a) + intVal(b);
							});

						// Total over this page
						pageTotal = api
						.column( 3, { page: 'current'} )
						.data()
						.reduce( function (a, b)
							{
								return intVal(a) + intVal(b);
							}, 0);

						// Update footer
						$( api.column( 2 ).footer() ).html(
							''+pageTotal +' ( '+ total +' total)'
						);
					},
					"aaSorting": [[ 0, "desc" ]],
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 5
				}).yadcf([
					{
						column_number : 1
					},
					{
						column_number : 4
					},
					{
						column_number : 5
					},
					
					{
						column_number : 8
					}



				

				]);

		});
</script>