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
    <legend align="center"> <strong> Cash </strong></legend>
    <table id="cuci" class="display">
      <thead>
         <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2" align="center">Order</td>
        <td colspan="2" align="center">Non Order</td>
        <td colspan="6" align="center">Cara Bayar Order</td>
        <td colspan="4" align="center">Cara Bayar Member/Langganan</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr>
          <th> Tgl Masuk </th>
          <th> outlet </th>
          <th > rcp </th>
          <th> Kiloan </th>
          <th> Potongan </th>
          <th> Membership </th>
          <th> Deposit </th>
          <th> Cash </th>
          <th> EDC BRI </th>
          <th> EDC BNI </th>
          <th> EDC BCA </th>
          <th> EDC Mandiri </th>
          <th> Kuota </th>
          <th> Voucher </th>
          <th> Cash </th>
          <th> EDC BRI </th>
          <th> EDC BNI </th>
          <th> EDC BCA </th>
          <th> EDC Mandiri </th>
          <th> Pendapatan Cash </th>
          <th> Pengeluaran </th>
          <th> Jenis Pengeluaran </th>
          <th> Setoran Bank </th>
          <th> Selisih Setoran </th>
          <th> Keterangan </th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="3" style="text-align:right"> Total: </th>
          <th></th>
        </tr>
      </tfoot>
      <tbody>
        <?php
$query   = "SELECT nama_outlet,DATE_FORMAT(tgl_input, '%Y-%m-%d') as tgl_input,nama_reception,jenis,sum(total_bayar) as jumlahomset FROM reception  WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') group by nama_reception,nama_outlet,DATE_FORMAT(tgl_input, '%Y-%m-%d') ORDER BY tgl_input ASC" ;

$tampil  = mysqli_query($con, $query);
while($data = mysqli_fetch_array($tampil))
{
	$jumlahomset   = $data['jumlahomset'];
	$reception = $data['nama_reception'];
	$tgllunas      = $data['tgl_input'];
	$outlet = $data['nama_outlet'];

$query1    = "SELECT tanggal,outlet,reception,sum(setoran_bersih) as setoran_bersih,edc_bri,edc_bni,edc_mandiri,edc_bca,pengeluaran,untuk,ijin,bank,tgl_setor,ket,DATE_FORMAT(tanggal,'%Y-%m-%d') as tgl1 FROM tutup_kasir WHERE DATE_FORMAT(tanggal,'%Y-%m-%d')='$tgllunas' and reception='$data[nama_reception]' and outlet='$outlet' GROUP BY DATE_FORMAT(tanggal, '%Y-%m-%d'),reception,outlet ORDER BY tanggal DESC" ;
	$tampil1   = mysqli_query($con, $query1);
	$data1     = mysqli_fetch_array($tampil1);
	$tutupkasir = $data1['setoran_bersih'];
	$pengeluaran       = $data1['pengeluaran'];
	$untuk       = $data1['untuk'];
	
?>
        <tr>
          <td><?php echo $data['tgl_input'];?></td>
          <td><?php echo $data['nama_outlet'];?></td>
          <td><?php echo $data['nama_reception'];?></td>
          <td><?php

$sqlkilo = mysqli_query($con,"SELECT sum(total_bayar) as jumkilo FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d')='$tgllunas' and nama_reception='$reception' and jenis='k' group by nama_reception,nama_outlet ORDER BY tgl_input ASC");
$k2=mysqli_fetch_array($sqlkilo);
$totalkilo=$k2['jumkilo'];
echo $totalkilo;

?></td>
          <td><?php

$sqlkilo = mysqli_query($con,"SELECT sum(total_bayar) as jumkilo FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d')='$tgllunas' and nama_reception='$reception' and jenis='p' group by nama_reception,nama_outlet ORDER BY tgl_input ASC");
$k2=mysqli_fetch_array($sqlkilo);
$totalkilo=$k2['jumkilo'];
echo $totalkilo;

?></td>
          <td><?php

								$sql4 = mysqli_query($con,"SELECT sum(total) as jumlahmember FROM faktur_penjualan WHERE (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas') and rcp='$reception' and jenis_transaksi='membership'	   group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
								$s2   = mysqli_fetch_array($sql4);
								$memberdp  = $s2['jumlahmember'];
								echo $memberdp;
								?></td>
          <td><?php

								$sql4 = mysqli_query($con,"SELECT sum(total) as jumlahmember FROM faktur_penjualan WHERE (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas') and rcp='$reception' and jenis_transaksi='deposit'	   group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
								$s2   = mysqli_fetch_array($sql4);
								$memberdp  = $s2['jumlahmember'];
								echo $memberdp;
								?></td>
          <td><?php

$sql4 = mysqli_query($con,"SELECT sum(total_bayar) as jumlahcash FROM reception   WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d')='$tgllunas' and cara_bayar='cash' and nama_reception='$reception' and nama_outlet='$outlet' group by nama_reception,nama_outlet,DATE_FORMAT(tgl_input, '%Y-%m-%d'),cara_bayar");
$s2   = mysqli_fetch_array($sql4);
$jumlahcash = $s2['jumlahcash'];
								


$totalcash=$jumlahcash;
echo $totalcash;
								
								?></td>
          <td><?php
           
            $sql4 = mysqli_query($con,"SELECT sum(total) as jumlahedc FROM faktur_penjualan WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas' and rcp='$reception' and cara_bayar='edcbri' and nama_outlet='$outlet' and jenis_transaksi='ritel' group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
            $s2=mysqli_fetch_array($sql4);
            $totaledc=$s2['jumlahedc'];
            echo $totaledc;
            
            ?></td>
          <td><?php
           
            $sql4 = mysqli_query($con,"SELECT sum(total) as jumlahedc FROM faktur_penjualan WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas' and rcp='$reception' and cara_bayar='edcbni' and nama_outlet='$outlet' and jenis_transaksi='ritel' group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
            $s2=mysqli_fetch_array($sql4);
            $totaledc=$s2['jumlahedc'];
            echo $totaledc;
            
            ?></td>
          <td><?php
           
            $sql4 = mysqli_query($con,"SELECT sum(total) as jumlahedc FROM faktur_penjualan WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas' and rcp='$reception' and cara_bayar='edcbca' and nama_outlet='$outlet' and jenis_transaksi='ritel' group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
            $s2=mysqli_fetch_array($sql4);
            $totaledc=$s2['jumlahedc'];
            echo $totaledc;
            
            ?></td>
          <td><?php
           
            $sql4 = mysqli_query($con,"SELECT sum(total) as jumlahedc FROM faktur_penjualan WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas' and rcp='$reception' and cara_bayar='edcmandiri' and nama_outlet='$outlet' and jenis_transaksi='ritel' group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
            $s2=mysqli_fetch_array($sql4);
            $totaledc=$s2['jumlahedc'];
            echo $totaledc;
            
            ?></td>
          <td><?php

								$sql4 = mysqli_query($con,"SELECT sum(total_bayar) as jumlahkuota FROM reception   WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d')='$tgllunas' and nama_reception='$reception' and nama_outlet='$outlet' and cara_bayar='kuota' group by nama_reception,nama_outlet,DATE_FORMAT(tgl_input, '%Y-%m-%d'),cara_bayar ORDER BY tgl_input ASC");
								$s2   = mysqli_fetch_array($sql4);
								$jumlahkuota = $s2['jumlahkuota'];
								echo $jumlahkuota ;
								?></td>
                                <td>
                                <?php

								$sql4 = mysqli_query($con,"SELECT sum(total_bayar) as jumlahkuota FROM reception   WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d')='$tgllunas' and (cara_bayar='voucher5kg' or cara_bayar='voucher3kg') and nama_reception='$reception' and nama_outlet='$outlet' group by nama_reception,nama_outlet,DATE_FORMAT(tgl_input, '%Y%m%d'),cara_bayar ORDER BY tgl_input ASC");
								$s2   = mysqli_fetch_array($sql4);
								$voucher = $s2['jumlahkuota'];
								echo $voucher ;
								?>
                                </td>
                                <td><?php
			
$sql4=mysqli_query($con,"SELECT sum(total) as jumlahmember FROM faktur_penjualan WHERE (DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas') and rcp='$reception' and (jenis_transaksi='membership' or jenis_transaksi='deposit') and cara_bayar='cash'  group by rcp,nama_outlet,DATE_FORMAT(tgl_transaksi, '%Y%m%d'),cara_bayar,jenis_transaksi ORDER BY tgl_transaksi ASC");
$s2=mysqli_fetch_array($sql4);
$mbr=$s2['jumlahmember'];

$totalcash=$mbr;
echo $totalcash;
								
								?></td>
                                <td><?php
           
            $sql4 = mysqli_query($con,"SELECT sum(total) as jumlahedc FROM faktur_penjualan WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas' and rcp='$reception' and cara_bayar='edcbri' and nama_outlet='$outlet' and jenis_transaksi<>'ritel' group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
            $s2=mysqli_fetch_array($sql4);
            $totaledc=$s2['jumlahedc'];
            echo $totaledc;
            
            ?></td>
            <td><?php
           
            $sql4 = mysqli_query($con,"SELECT sum(total) as jumlahedc FROM faktur_penjualan WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas' and rcp='$reception' and cara_bayar='edcbni' and nama_outlet='$outlet' and jenis_transaksi<>'ritel' group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
            $s2=mysqli_fetch_array($sql4);
            $totaledc=$s2['jumlahedc'];
            echo $totaledc;
            
            ?></td>
            <td><?php
           
            $sql4 = mysqli_query($con,"SELECT sum(total) as jumlahedc FROM faktur_penjualan WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas' and rcp='$reception' and cara_bayar='edcbca' and nama_outlet='$outlet' and jenis_transaksi<>'ritel' group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
            $s2=mysqli_fetch_array($sql4);
            $totaledc=$s2['jumlahedc'];
            echo $totaledc;
            
            ?></td>
            <td><?php
           
            $sql4 = mysqli_query($con,"SELECT sum(total) as jumlahedc FROM faktur_penjualan WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d')='$tgllunas' and rcp='$reception' and cara_bayar='edcmandiri' and nama_outlet<>'$outlet' and jenis_transaksi='ritel' group by rcp,nama_outlet ORDER BY tgl_transaksi ASC");
            $s2=mysqli_fetch_array($sql4);
            $totaledc=$s2['jumlahedc'];
            echo $totaledc;
            
            ?></td>
            <td>
				<?php echo $tutupkasir;?>
            </td>
            <td>
				<?php echo $pengeluaran;?>
            </td>
            <td>
				<?php echo $untuk;?>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
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
								"mColumns": [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22],
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
		});

</script>