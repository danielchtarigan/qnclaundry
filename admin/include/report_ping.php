<style>
th,td{
    text-align: center;
    width: 16%;
    vertical-align: top;
}
td.dua{
vertical-align:text-top;
}
td.kiri{
    text-align: left;
}
</style>
<?php


        function selisih($jm,$jk){   
          $pop_time = substr($jm,11);
          $ping_time = substr($jk,11);   
          list($H,$m,$s)=explode(":",$pop_time );
          $dtawal=mktime($H,$m,$s,"1","1","1");
          list($H,$m,$s)=explode(":",$ping_time );
          $dtakhir=mktime($H,$m,$s,"1","1","1");
          $dtselisih=$dtakhir-$dtawal;
          return $dtselisih;
        }
                                        											
												date_default_timezone_set('Asia/Makassar');
                                        $date = date("Y-m-d");
                                        $cekpop = mysqli_query($con,"select * from poptime where time like '%$date%'");
                                        $jpop= mysqli_num_rows($cekpop);
                                        $i=1;
                                        while($dpop = mysqli_fetch_array($cekpop)){
                                                $wpop[$i]= $dpop['time']; $i++;}
?>
<div class="col-md-6">
<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#petunjuk">Pilih Tanggal</button>

<div class="modal fade" id="petunjuk" tabindex="-1" role="dialog" aria-labelledby="isi petunjuk">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-tittle"  id="isiPetunjuk">Respon Kode Resepsionis</h3>
					</div>
					<div class="modal-body">
						<h4>Pencarian Tanggal</h4>
							<form class="form-inline" method="post" action="report_ping.php">
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
<br>



				<div class="col-lg-12 col-md-offset-0">
					<div class="panel panel-success">
                        <div class="panel-heading"><center><b>
                            Respons Kode Resepsionis Ping!!!</b></center>
                        </div>
                        <div class="panel-body">

                            <!-- /.row (nested) -->

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="ping_rcp">
                                    <thead>
                                        <tr>
											<th rowspan="2" valign="center">Tanggal<br>&nbsp</th>
                                            <th rowspan="2" valign="center">Outlet<br>&nbsp</th>
                                            <th rowspan="2" class="dua">Resepsionis<br>&nbsp</th>
                                            <th rowspan="2">Waktu<br> Login Pertama</th>
                                            <th colspan="2">Challenge Code</th>
                                        </tr>
                                        <tr><th>8 Jam</th>
											<th>12 Jam</th>
										</tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
                                        $qcek = mysqli_query($con, "select * from log_rcp where tgl_log like '%$date%'");
                                        while ($rcek = mysqli_fetch_array($qcek)){  
                                    ?>
                                        <tr class="odd gradeX">
											<td><?php echo $date;?></td>
                                            <td><?php $outl=$rcek['id_outlet']; 
                                            echo $outl;?></td>
                                            <td class="kiri">
                                            <?php $usr=$rcek['id_user'];
                                            echo $usr; ?></td>
                                            <td><?php echo substr($rcek['tgl_log'],11,8) ?></td>
                                            
                                            <td>
                                                        <?php


$i=1;
$cekping = mysqli_query($con,"select * from ping where waktu like '%$date%' and resepsionis='$usr' and outlet='$outl'");
$jumlah= mysqli_num_rows ($cekping); 
while($dping = mysqli_fetch_array($cekping)){
        $wping[$i]= $dping['waktu'];
        $i++;
        }
$point=0;
$cekpop = mysqli_query($con,"select * from poptime where time like '%$date%'");
for($i=1;$i<=$jpop;$i++){
        $ya=0;
        for($j=1;$j<=$jumlah;$j++){
          if ($wping[$j]>=$wpop[$i]){
          $sl=selisih($wpop[$i],$wping[$j]);
          if($sl<900) $ya=1;}
        }
        $point+=$ya;
        }
$persen=$point/12*100;
$persen2=$point/18*100;
if($persen>100) $persen=100;
if($persen2>100) $persen2=100;
 echo number_format($persen,2)."%";  
        ?>
                                            </td>
                                            <td><?php echo number_format($persen2,2)."%"; ?></td>
                                        </tr>
                                    <?php   
                                        }
                                     ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
					</div>
				</div>


<script type="text/javascript">
$(document).ready(function(){
			$('#ping_rcp').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
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
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	
        		"aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 15}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy/mm/dd"
	    },
	   
	    {column_number : 1},	    {column_number : 2}

	    
	    ]); 
		
		

		});
	</script>
                        