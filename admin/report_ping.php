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
include '../config.php';
include 'head.php';


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
                                        											
										$tgl = $_POST['tgl'];
											$date = new DateTime($tgl);
											$newDate = $date->format('Y-m-d');
										$tgl2 = $_POST['tgl2'];
											$date2 = new DateTime($tgl2);
											$newDate2 = $date2->format('Y-m-d');
												
                                        
?>

 
				<div class="col-lg-12 col-md-offset-0">
					<div class="panel panel-primary">
                        <div class="panel-heading"><center><b>
                            Ping!!! Respon Kode  Resepsionis</b></center>
                        </div>
                        <div class="panel-body">

                            <!-- /.row (nested) -->

                            <div class="table-responsive">
                               <table class="table table-condensed table-stripped table-bordered" id="ping_rcp">
                                    <thead>
                                        <tr>
											<th>Tanggal</th>
                                            <th style="text-align:center">Outlet</th>
                                            <th style="text-align:center">Resepsionis</th>
                                            <th style="text-align:center">Login Pertama</th>
                                            <th style="text-align:center">Jika 8 Jam Kerja</th>
											<th style="text-align:center">Jika 12 Jam Kerja</th>									
																				
                                        </tr>                                        
                                    </thead>
                                    <tbody>
                                    
                                    <?php
                                        $qcek = mysqli_query($con, "select DATE_FORMAT(tgl_log, '%Y-%m-%d') as datei,TIME_FORMAT(tgl_log, '%H:%i:%s') as time,id_user,id_outlet from log_rcp where (DATE_FORMAT(tgl_log, '%Y-%m-%d') between '$newDate' and '$newDate2')");
                                        while ($rcek = mysqli_fetch_array($qcek)){  
										$datei=$rcek['datei'];
                                    ?>
                                        <tr class="odd gradeX">
											<td><?php echo $datei;?></td>
                                            <td><?php $outl=$rcek['id_outlet']; 
                                            echo $outl;?></td>
                                            <td>
                                            <?php $usr=$rcek['id_user'];
                                            echo $usr; ?></td>
                                            <td><?php echo $rcek['time'] ?></td>
                                            
                                            <td>
                                                        <?php

$cekpop = mysqli_query($con,"select * from poptime where time like '%$datei%'");
                                        $jpop= mysqli_num_rows($cekpop);
                                        $i=1;
                                        while($dpop = mysqli_fetch_array($cekpop)){
                                                $wpop[$i]= $dpop['time']; $i++;}
														
														
$i=1;
$cekping = mysqli_query($con,"select * from ping where waktu like '%$datei%' and resepsionis='$usr' and outlet='$outl'");
$jumlah= mysqli_num_rows ($cekping); 
while($dping = mysqli_fetch_array($cekping)){
        $wping[$i]= $dping['waktu'];
        $i++;
        }
$point=0;
$cekpop = mysqli_query($con,"select * from poptime where time like '%$datei%'");
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
        		"aaSorting": [[ 0, "asc" ]],
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
                        