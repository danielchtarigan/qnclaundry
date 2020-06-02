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
							Tgl Masuk
						</th>
						<th>
							outlet
						</th>
						<th >
							rcp
						</th>
						<th>
							Cucian
						</th>
						<th>
							Mmber/Dps
						</th>
						<th>
							Cash
						</th>
						<th>
							Edc
						</th>
						
						<th>
							Kuota
						</th>
						<th>
							Voucher
						</th>
						<th>
							Ttp Ksr
						</th>
						<th>
							Pengeluaran
						</th>
						
						
						<th>
						Slsh Omset
						</th>
												<th>
						Slsh Cash
						</th>
<th>
						Utk
						</th>



					</tr>
				</thead>
				<tfoot>
					<tr>
						<th colspan="3" style="text-align:right">
							Total:
						</th>
						<th>
						</th>
					</tr>
				</tfoot>

				<tbody>
					<?php
					$query   = "SELECT nama_outlet,DATE_FORMAT(tgl_lunas, '%Y-%m-%d') as tgl_lunas,rcp_lunas,sum(total_bayar) as jumlahomset FROM reception  WHERE (DATE_FORMAT(tgl_lunas, '%Y-%m-%d') between '$newDate' and '$newDate2') group by rcp_lunas,nama_outlet,DATE_FORMAT(tgl_lunas, '%Y-%m-%d') ORDER BY tgl_lunas ASC" ;

					$tampil  = mysqli_query($con, $query);

					while($data = mysqli_fetch_array($tampil))
					{
						$jumlahomset   = $data['jumlahomset'];
						$reception = $data['rcp_lunas'];
						$tgllunas       = $data['tgl_lunas'];
						$outlet=$data['nama_outlet'];

						$query1    = "SELECT tanggal,outlet,reception,sum(setoran_bersih) as setoran_bersih,edc_bri,edc_mandiri,edc_bca,pengeluaran,untuk,ijin,bank,tgl_setor,ket,DATE_FORMAT(tanggal,'%Y-%m-%d') as tgl1 FROM tutup_kasir WHERE DATE_FORMAT(tanggal,'%Y-%m-%d')='$tgllunas' and reception='$data[rcp_lunas]' and outlet='$outlet' GROUP BY DATE_FORMAT(tanggal, '%Y-%m-%d'),reception,outlet ORDER BY tanggal DESC" ;
						$tampil1   = mysqli_query($con, $query1);
						$data1     = mysqli_fetch_array($tampil1);
						$tutupkasir = $data1['setoran_bersih'];
						$pengeluaran       = $data1['pengeluaran'];
$untuk       = $data1['untuk'];
						
?>

						<tr>
							<td>
								<?php echo $data['tgl_lunas'];?>
							</td>
							<td>
								<?php echo $data['nama_outlet'];?>
							</td>
							<td>
								<?php echo $data['rcp_lunas'];?>
							</td>
							<td><?php echo $jumlahomset;?>
							</td>
							<td>
							<?php

								$sql4 = mysqli_query($con,"SELECT sum(total) as jumlahmember FROM faktur_penjualan WHERE (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas') and rcp='$reception' and jenis_transaksi IN ('membership','deposit')   group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
								$s2   = mysqli_fetch_array($sql4);
								$memberdp  = $s2['jumlahmember'];
								echo $memberdp;
								?>
							</td>
							
							
							<td>
								<?php

$sql4 = mysqli_query($con,"SELECT sum(total_bayar) as jumlahcash FROM reception   WHERE DATE_FORMAT(tgl_lunas, '%Y-%m-%d')='$tgllunas' and cara_bayar='cash' and rcp_lunas='$reception' and nama_outlet='$outlet' group by rcp_lunas,nama_outlet,DATE_FORMAT(tgl_lunas, '%Y-%m-%d'),cara_bayar");
$s2   = mysqli_fetch_array($sql4);
$jumlahcash = $s2['jumlahcash'];
								
$sql4=mysqli_query($con,"SELECT sum(total) as jumlahmember FROM faktur_penjualan WHERE (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas') and rcp='$reception' and (jenis_transaksi='membership' or jenis_transaksi='deposit') and cara_bayar='cash'  group by rcp,nama_outlet,DATE_FORMAT(tgl_transaksi, '%Y%m%d'),cara_bayar,jenis_transaksi ORDER BY tgl_transaksi ASC");
$s2=mysqli_fetch_array($sql4);
$mbr=$s2['jumlahmember'];

$totalcash=$jumlahcash+$mbr;
echo $totalcash;
								
								?>
							</td>
							
							<td>
								<?php

//$sql4 = mysqli_query($con,"SELECT sum(total_bayar) as jumlahedc FROM reception WHERE DATE_FORMAT(tgl_lunas, '%Y-%m-%d')='$tgllunas' and (cara_bayar='edcbca' or cara_bayar='edcmandiri' or cara_bayar='edcbri') and rcp_lunas='$reception' and nama_outlet='$outlet' group by rcp_lunas,nama_outlet,DATE_FORMAT(tgl_lunas, '%Y%m%d'),cara_bayar ORDER BY tgl_input ASC");
//								$s2   = mysqli_fetch_array($sql4);
//								$jumlahedc = $s2['jumlahedc'];
								
								$sql4=mysqli_query($con,"SELECT sum(total) as jumlahmember FROM //faktur_penjualan WHERE (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas') and rcp='$reception' and (jenis_transaksi='membership' or jenis_transaksi='deposit') and (cara_bayar='edcmandiri' or cara_bayar='edcbri' or cara_bayar='edcbca')  group by rcp,nama_outlet,DATE_FORMAT(tgl_transaksi, '%Y%m%d'),cara_bayar,jenis_transaksi ORDER BY tgl_transaksi ASC");
//$s2=mysqli_fetch_array($sql4);
//$mbr=$s2['jumlahmember'];

//$totaledc=$jumlahedc+$mbr;
//edited

$sql4 = mysqli_query($con,"SELECT sum(total) as jumlahedc FROM faktur_penjualan WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas' and rcp='$reception' and cara_bayar IN('edcmandiri','edcbri') and nama_outlet='$outlet' group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
$s2=mysqli_fetch_array($sql4);
$totaledc=$s2['jumlahedc'];
echo $totaledc;
								
								?>
							</td>
							<td>
								<?php

								$sql4 = mysqli_query($con,"SELECT sum(total_bayar) as jumlahkuota FROM reception   WHERE DATE_FORMAT(tgl_lunas, '%Y-%m-%d')='$tgllunas' and cara_bayar='kuota' and rcp_lunas='$reception' and nama_outlet='$outlet' group by rcp_lunas,nama_outlet,DATE_FORMAT(tgl_lunas, '%Y-%m-%d'),cara_bayar ORDER BY tgl_input ASC");
								$s2   = mysqli_fetch_array($sql4);
								$jumlahkuota = $s2['jumlahkuota'];
								echo $jumlahkuota ;
								?>
							</td>
							<td>
								<?php

								$sql4 = mysqli_query($con,"SELECT sum(total_bayar) as jumlahkuota FROM reception   WHERE DATE_FORMAT(tgl_lunas, '%Y-%m-%d')='$tgllunas' and (cara_bayar='voucher5kg' or cara_bayar='voucher3kg') and rcp_lunas='$reception' and nama_outlet='$outlet' group by rcp_lunas,nama_outlet,DATE_FORMAT(tgl_lunas, '%Y%m%d'),cara_bayar ORDER BY tgl_input ASC");
								$s2   = mysqli_fetch_array($sql4);
								$voucher = $s2['jumlahkuota'];
								echo $voucher ;
								?>
							</td>
							<td>
								<?php echo $tutupkasir;?>
							</td>
							<td>
								<?php echo $pengeluaran;?>
							</td>
							<td>
								<?php //selisih omset
								$A = $jumlahomset;
								$B = $memberdp;//tutup kasir
								$c = $totalcash;//pengerluaran;
								$d=$totaledc;
								$e=$jumlahkuota;
								$g=$voucher;
								
								$f = ($A + $B) - ($c + $d + $e+$g);
								echo $f ;

								?>

							</td>
							<td>
								<?php //selisih cash
								$A = $tutupkasir;
								$B = $totalcash;//tutup kasir
								
								$C = ($A - $B)+$pengeluaran;
								echo $C ;

								?>

							</td>
<td>
								<?php echo $untuk;?>
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
					Rincian Omset
				</strong>
			</legend>
			<table id="rincianomset" class="display">
				<thead>
					<tr>
						<th>
							Tgl
						</th>
						<th >
							rcp
						</th>
						<th >
							Outlet
						</th>
						<th>
							no nota
						</th>
						<th>
							nama customer
						</th>
						
						<th>
							Jumlah
						</th>
						
						<th>
							cara bayar
						</th>
						
						<th>
							no faktur
						</th>
						
						<th>
							Tgl Lunas
						</th>
						<th>
							Rcp Lunas
						</th>
						
						<th>
							cuci
						</th>
						<th>
							setrika
						</th>
						<th>
							packing
						</th>

					</tr>
				</thead>
				<tfoot>
					<tr>
						<th colspan="5" style="text-align:right">
							Total:
						</th>
						<th>
						</th>
					</tr>
				</tfoot>

				<tbody>
					<?php
					$query = "SELECT  tgl_input,nama_reception,no_nota,op_cuci,user_setrika,user_packing,nama_outlet,cara_bayar, tgl_lunas,rcp_lunas,total_bayar as jumlah,no_faktur,nama_customer FROM reception WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') ORDER BY tgl_input ASC" ;
					$tampil= mysqli_query($con, $query);

					while($data = mysqli_fetch_array($tampil))
					{

						?>

						<tr>
							<td>
								<?php echo $data['tgl_input'];?>
							</td>
							<td>
								<?php echo $data['nama_reception'];?>
							</td>
							<td>
								<?php echo $data['nama_outlet'];?>
							</td>
							
							<td>
								<?php echo $data['no_nota'];?>
							</td>
							
							<td>
								<?php echo $data['nama_customer'];?>
							</td>
							
							<td>
								<?php echo $data['jumlah'];?>
							</td>
							
							<td>
								<?php echo $data['cara_bayar'];?>
							</td>
							
							<td>
								<?php echo $data['no_faktur'];?>
							</td>
							<td>
								<?php echo $data['tgl_lunas'];?>
							</td>
							<td>
								<?php echo $data['rcp_lunas'];?>
							</td>
							
							
							<td>
								<?php echo $data['op_cuci'];?>
							</td>

							<td>
								<?php echo $data['user_setrika'];?>
							</td>
							<td>
								<?php echo $data['user_packing'];?>
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
								"mColumns": [0,1,2,3,4,5,6,7,8,9,10,11,12,13],
								"oSelectorOpts":
								{
									filter: "applied", order: "current"
								}
							},
							{
								'sExtends': 'xls',
								"mColumns": [0,1,2,3,4,5,6,7,8,9,10,11,12,13],
								"oSelectorOpts":
								{
									filter: 'applied', order: 'current'
								}
							},

							{
								'sExtends': 'print',
								"mColumns": [0,1,2,3,4,5,6,7,8,9,10,11,12,13],
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
						$( api.column( 3 ).footer() ).html(
							''+pageTotal +' ( '+ total +' total)'
						);
					},
					"aaSorting": [[ 0, "desc" ]],
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 5
					
					
				}).yadcf([
					{
						column_number : 0,
						filter_type: 'range_date',
						date_format: "yyyy-mm-dd"
					},

					{
						column_number : 1
					},
					{
						column_number : 2
					}

				]);

			$('#rincianomset').dataTable(
				{
					"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
					dom: 'T<"clear">lfrtip',
					tableTools:
					{
						"sSwfPath": "swf/copy_csv_xls_pdf.swf",
						"aButtons": [
							{
								"sExtends": "copy",
								"mColumns": [0,1,2,3,4,5,6,7,8,9,10,11,12],
								"oSelectorOpts":
								{
									filter: "applied", order: "current"
								}
							},
							{
								'sExtends': 'xls',
								"mColumns": [0,1,2,3,4,5,6,7,8],
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
						.column(5)
						.data()
						.reduce( function (a, b)
							{
								return intVal(a) + intVal(b);
							});

						// Total over this page
						pageTotal = api
						.column( 5, { page: 'current'} )
						.data()
						.reduce( function (a, b)
							{
								return intVal(a) + intVal(b);
							}, 0);

						// Update footer
						$( api.column( 5 ).footer() ).html(
							''+pageTotal +' ( '+ total +' total)'
						);
					},
					"aaSorting": [[ 0, "desc" ]],
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 5
				}).yadcf([
					{
						column_number : 0,
						filter_type: 'range_date',
						date_format: "yyyy-mm-dd"
					},

					{
						column_number : 1
					},
					{
						column_number : 2
					},
					{
						column_number : 6
					}

				]);

		});
</script>