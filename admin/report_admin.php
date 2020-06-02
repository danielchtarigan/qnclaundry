<?php
include "../config.php";
include "header.php";
$op=$_SESSION['user_id'];


$tgl = $_POST['tgl'];
	$date = new DateTime($tgl);
	$newDate = $date->format('Y-m-d');
$tgl2 = $_POST['tgl2'];
	$date2 = new DateTime($tgl2);
	$newDate2 = $date2->format('Y-m-d');

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-12 col-lg-offset-0 main">	
<hr>
<div class="row">
<div class="col-xs-12" align="center">
	<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#admin">Pilih Tanggal</button>

<div class="modal fade" id="admin" tabindex="-1" role="dialog" aria-labelledby="isi petunjuk">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-tittle"  id="isiPetunjuk">Laporan Admin QnC</h3>
					</div>
					<div class="modal-body">
						<h4>Pencarian Tanggal</h4>
							<form class="form-inline" method="post" action="report_admin.php">
								<div class="form-group">
									<label for="date">Dari</label>
									<input type="date" class="form-control" name="tgl" id="tgl" placeholder="tanggal" required="true">
								</div>							
								<div class="form-group">
									<label for="date2">Sd</label>
									<input type="date" class="form-control" name="tgl2" id="tgl2" placeholder="tanggal" required="true">
								</div>
								<button type="submit" class="btn btn-succes" value="cari">Cari</button>
							</form>
					</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="col-xs-12" align="center">
	<h1 class="page-header">Laporan Admin QnC Laundry</h1>
	Tanggal <?php echo $newDate ;?> sampai <?php echo $newDate2; ?>
</div>
<div class="row">	
	<div class="col-xs-6">
		<div class="panel panel-default">
			<div class="table table-tripped table-bordered"><strong>Omset Order</strong></div><br>
					<table class="display" id="rincian">
						<thead>
						<tr>
							<th>Tanggal</th>
							<th>Cabang</th>	
							<td>Cara Bayar</td>
							<th>Banyak Order</th>
							<th>Jumlah (Rp)</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th colspan="4" style="text-align:right">Total:</th>
							<th style="text-align:right"></th>
						</tr>
						</tfoot>
						<tbody>
							<?php
							$sql = mysqli_query($con, "select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tgl,nama_outlet,cabang,cara_bayar,count(cabang) as ordercabang,sum(total_bayar) as omsetcabang, nama_reception FROM reception WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') AND cara_bayar<>'Void' AND cara_bayar<>'Reject' GROUP BY tgl,nama_outlet,cabang,cara_bayar ORDER BY tgl_input DESC") or die(mysqli_error());
							WHILE ($view = mysqli_fetch_array($sql)){	
								$tgl = $view['tgl'];
								$bayar = $view['cara_bayar'];
								$cabang = $view['cabang'];
								if(($cabang=='mojokerto'||$cabang=='') && ($view['nama_outlet'])=='mojokerto'){
									$cabang='Mojokerto';
								}
								else if(($cabang=='sub-abdesir'||$cabang=='sub-jappa' || $cabang=='Delivery') && $view['nama_reception']=='gerrysuper'){
									$cabang='Sub Agen';
								}
								else if($cabang=='Bontomene'){
									$cabang='Kost Executive';
								}
								else if($cabang=='Hotel Remcy'){
									$cabang='Guest InHouse';
								}		
								else if(($cabang==''||$cabang=='Toddopuli'||$cabang=='support'||$cabang=='Baruga'||$cabang=='Landak'||$cabang=='BTP'||$cabang=='DAYA'||$cabang=='Boulevard'||$cabang=='delivery') && ($view['nama_outlet'])!='mojokerto' && $bayar=='kuota'){
										$cabang='Langganan';
								}	
								else if(($cabang==''||$cabang=='Toddopuli'||$cabang=='support'||$cabang=='Baruga'||$cabang=='Landak'||$cabang=='BTP'||$cabang=='DAYA'||$cabang=='Boulevard'||$cabang=='delivery') && ($view['nama_outlet'])!='mojokerto' && $bayar!='kuota'){
										$cabang='Outlet';
								}
								if($bayar==''){
									$bayar='Piutang';
								}
								else if($bayar=='BRI, cash'){
									$bayar='BRI';
								}
								else if($bayar=='BNI, cash'){
									$bayar='BNI';
								}
								else if($bayar=='BCA, cash'){
									$bayar='BCA';
								}
								else if($bayar=='MANDIRI, cash'){
									$bayar='MANDIRI';
								}
															
							?>
						<tr>
							<td><?php echo $tgl?></td>
							<td><?php echo $cabang; ?></td>
							<td><?php echo $bayar; ?></td>
							<td style="text-align:right"><?php echo $view['ordercabang']?></td>
							<td style="text-align:right"><?php echo $view['omsetcabang']?></td>
						</tr>
						<?php
						}
						?>
						</tbody>								
					</table>
		</div>
	</div>
	
	<div class="col-xs-6">
		<div class="panel panel-default">
			<div class="table table-tripped table-bordered"><strong>Pengguna Voucher</strong></div><br>
					<table class="display" id="voucher">
						<thead>
						<tr>
							<th>Tanggal</th>
							<th>Kategori</th>
							<th>Voucher Aktif</th>							
							<th>Jumlah Terpakai</th>
							<th>Jumlah Pengguna</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th colspan="4" style="text-align:right">Total:</th>
							<th style="text-align:right"></th>
						</tr>
						</tfoot>
						<tbody>
							<?php
							$sql = mysqli_query($con, "select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tgl,nama_outlet,cabang,cara_bayar,voucher,count(voucher) as jumvoucher,COUNT(DISTINCT id_customer) as user FROM reception WHERE voucher<>'' and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') GROUP BY tgl,voucher ORDER BY tgl_input DESC") or die(mysqli_error());
							WHILE ($view = mysqli_fetch_array($sql)){	
								$tgl = $view['tgl'];								
								$vouc = $view['voucher'];
								
							$berkala = mysqli_query($con, "SELECT kode_voucher FROM voucher_berkala WHERE kode_voucher='$vouc'");
							$vberkala = mysqli_fetch_array($berkala);
							$disk = $vberkala['kode_voucher'];
							
							$kpromo = mysqli_query($con, "SELECT kode FROM kode_promo WHERE kode='$vouc'");
							$vpromo = mysqli_fetch_array($kpromo);
							$kpromo = $vpromo['kode'];

                                                        $mpromo = mysqli_query($con, "SELECT kode FROM mjk_kode_promo WHERE kode='$vouc'");
							$vmpromo = mysqli_fetch_array($mpromo);
							$kmpromo = $vmpromo['kode'];
							
							$pflat = mysqli_query($con, "SELECT kode FROM promo_flat WHERE kode='$vouc'");
							$vflat = mysqli_fetch_array($pflat);
							$flat = $vflat['kode'];
							
							$v = mysqli_query($con, "SELECT kode FROM voucher_rupiah WHERE kode = '$vouc'");
							$rupiah = mysqli_fetch_array($v);
							$rph = $rupiah['kode'];
							
							$v2 = mysqli_query($con, "SELECT kode FROM voucher_recovery WHERE kode='$vouc'");
							$recovery = mysqli_fetch_array($v2);
							$rcv = $recovery['kode'];
							
							$v3 = mysqli_query($con, "SELECT kode_referral_baru FROM customer WHERE kode_referral_baru='$vouc'");
							$referral = mysqli_fetch_array($v3);
							$rfr = $referral['kode_referral_baru'];
							
							IF ($disk){
								$promo = 'Berkala';
							}
							ELSE IF ($kpromo){
								$promo = 'Kode Promo';
							}
							ELSE IF ($flat){
								$promo = 'Promo Flat';
							}
							ELSE IF ($rph){
								$promo = 'Voucher Rupiah';
							}
							ELSE IF ($rcv){
								$promo = 'Recovery';
							}
							ELSE IF ($rfr){
								$promo = 'Referral';
							}
                                                        ELSE IF ($kmpromo){
								$promo = 'Kode Promo MJK';
							}
							
							
								
							?>
						<tr>
							<td><?php echo $tgl?></td>
							<td><?php echo  $promo?></td>
							<td><?php echo $vouc?></td>							
							<td style="text-align:right"><?php echo $view['jumvoucher']?></td>
							<td style="text-align:right"><?php echo $view['user']?></td>
						</tr>
						<?php
						}
						?>
						</tbody>								
					</table>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-xs-6">
		<div class="panel panel-default">
			<div class="table table-tripped table-bordered"><strong>Membership</strong></div><br>
					<table class="display" id="member">
						<thead>
						<tr>							
							<th>Tanggal</th>
							<th>Nama Customer</th>
							<th>Member</th>
							<th>Outlet</th>
							<th>Cara Bayar</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th colspan="2" style="text-align:right">Total:</th>
							<th colspan="3"></th>
						</tr>
						</tfoot>
						<tbody>
							<?php
							$sql = mysqli_query($con, "SELECT  DATE_FORMAT(faktur_penjualan.tgl_transaksi, '%Y-%m-%d') as tgl,faktur_penjualan.jenis_transaksi,customer.nama_customer,SUM(faktur_penjualan.total) as total,faktur_penjualan.nama_outlet,faktur_penjualan.cara_bayar FROM faktur_penjualan INNER JOIN customer ON faktur_penjualan.id_customer=customer.id WHERE (DATE_FORMAT(faktur_penjualan.tgl_transaksi, '%Y-%m-%d') between '$newDate' and '$newDate2') AND faktur_penjualan.jenis_transaksi='membership' GROUP BY tgl_transaksi,nama_outlet ORDER BY tgl_transaksi DESC") or die(mysqli_error());
							WHILE ($view = mysqli_fetch_array($sql)){	
								$tgl = $view['tgl'];
								$bayar = $view['cara_bayar'];
								$tot = $view['total'];								
								
							?>
						<tr>
							<td><?php echo $tgl?></td>
							<td><?php echo $view['nama_customer']?></td>
							<td style="text-align:right"><?php echo $tot;?></td>							
							<td><?php echo $view['nama_outlet']?></td>
							<td><?php echo $bayar?></td>
							<?php
							}
							?>
						</tr>						
						</tbody>					
					</table>
		</div>
	</div>
	
	<div class="col-xs-6">
		<div class="panel panel-default">
			<div class="table table-tripped table-bordered"><strong>Langganan</strong></div><br>
					<table class="display" id="langganan">
						<thead>
						<tr>							
							<th>Tanggal</th>
							<th>Nama Customer</th>
							<th>Langganan</th>
							<th>Outlet</th>
							<th>Cara Bayar</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th colspan="2" style="text-align:right">Total:</th>
							<th colspan="3"></th>
						</tr>
						</tfoot>
						<tbody>						
							<?php
							$sql = mysqli_query($con, "SELECT  DATE_FORMAT(faktur_penjualan.tgl_transaksi, '%Y-%m-%d') as tgl,faktur_penjualan.jenis_transaksi,customer.nama_customer,SUM(faktur_penjualan.total) as total,faktur_penjualan.nama_outlet,faktur_penjualan.cara_bayar FROM faktur_penjualan INNER JOIN customer ON faktur_penjualan.id_customer=customer.id WHERE (DATE_FORMAT(faktur_penjualan.tgl_transaksi, '%Y-%m-%d') between '$newDate' and '$newDate2') AND faktur_penjualan.jenis_transaksi='deposit' GROUP BY tgl_transaksi,nama_outlet ORDER BY tgl_transaksi DESC") or die(mysqli_error());
							WHILE ($view = mysqli_fetch_array($sql)){	
								$tgl = $view['tgl'];
								$bayar = $view['cara_bayar'];
								$tot = $view['total'];								
								
							?>
						<tr>
							<td><?php echo $tgl?></td>
							<td><?php echo $view['nama_customer']?></td>
							<td style="text-align:right"><?php echo $tot;?></td>							
							<td><?php echo $view['nama_outlet']?></td>
							<td><?php echo $bayar?></td>
							<?php
							}
							?>
						</tr>						
						</tbody>							
					</table>
		</div>
	</div>

</div>
					
					<script>
					$(document).ready(function(){
					$('#rincian').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
			dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets":1 },
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
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column(4 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	

	
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 1},	    
	    
	    ]);
		
		$('#voucher').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
			dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets":1 },
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
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column(4 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	

	
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 1},	    
	    
	    ]);
		
				$('#member').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
			dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets":1 },
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
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );			
			
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );				
			 
            // Update footer
            $( api.column(2 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );			
			
        },	

	
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}   
	    
	    ]);
		
		$('#langganan').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
			dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets":1 },
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
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );			
			
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );				
			 
            // Update footer
            $( api.column(2 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );			
			
        },	

	
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
			
		 
			
						
		});
	</script>
					
		
</div><!--/.main-->