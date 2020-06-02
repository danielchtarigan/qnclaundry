<?php
include '../config.php';
include 'head.php';

if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];
} else{
	$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y-m').'-25';
}
?>


<script type="text/javascript">
		$(document).ready(function(){
			$('#datasetoran').dataTable({
			"order": [[ 0,"asc" ]],
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12,13],
                            "oSelectorOpts": { filter: 'applied', order: 'current' },
                            'sFileName': 'Setoran Bank.xls',
                            'sButtonText': 'Simpan Ke Excel'
                        },

                    ]
                },
	                "columnDefs": [
	                    {
	                        "targets": [0],
	                        "visible": true,
	                        "searchable": true,"width":"4px",
	                    }, { "width": "12%", "targets": 0 }, { "width": "10%", "targets": [1] },{ "width": "10%", "targets": 2 }, { "width": "10%", "targets": 4 },{ "width": "10%", "targets": 5 },{ "width": "8%", "targets": 7 }, { "width": "8%", "targets": 8 }
	                ],
	                "bAutoWidth": false,
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],					
				});

		});
	</script>

                        
                        <?php
                        include 'cari2.php';
                        
						$tgl = $startDate;
						$date = new DateTime($tgl);
						$newDate = $date->format('Y-m-d');
						$tgl2 = $endDate;
						$date2 = new DateTime($tgl2);
						$newDate2 = $date2->format('Y-m-d');
											
                        // if (isset($_GET['resepsionis'])){
                        //    include "include/laporan_setoran_bank_resepsionis.php";
                        // }
                        // else if (isset($_GET['outlet'])){
                        //    include "include/laporan_setoran_bank_outlet.php";
                        // }
                        // else{
                        ?>                                       
                        <legend align="center">Setoran Bank</legend>
                            <div class="table-responsive" style="overflow-x:auto">
                                <table class="table table-striped table-bordered table-hover" id="datasetoran" style="font-size:9px;">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Pemasukan</th>
                                            <th>RCP Lunas</th>
                                            <th>Outlet</th>
                                            <th>Pendapatan CASH</th>
                                            <th>Pengeluaran</th>
                                            <th>Pengeluaran Untuk</th>
                                            <th>Nilai Tutup Kasir</th>
                                            <th>Jumlah Setoran</th>
                                            <th>Tanggal Setor</th>
                                            <th>BANK</th>
                                            <th>Kode Referensi</th>
                                            <th>Penyesuaian</th>
                                            <th>Keterangan Penyesuaian</th>
                                            <th>Selisih</th>
                                            <th>Status Verifikasi</th>
                                            <th>OP Verifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php										
												$q1 = mysqli_query($con, "select * from outlet WHERE nama_outlet<>'mojokerto'");
												while ($rq1 = mysqli_fetch_array($q1)){
													$cekrcp = mysqli_query($con, "select DATE_FORMAT(tgl_lunas, '%Y-%m-%d') as tanggal,rcp_lunas,nama_outlet from reception where (DATE_FORMAT(tgl_lunas, '%Y-%m-%d') between '$newDate' and '$newDate2') and nama_outlet='$rq1[nama_outlet]' group by DATE_FORMAT(tgl_lunas, '%Y-%m-%d'),rcp_lunas order by DATE_FORMAT(tgl_lunas, '%Y-%m-%d') DESC");
													$ncek = mysqli_num_rows($cekrcp);
													if ($ncek>0){
													while ($rcekrcp = mysqli_fetch_array($cekrcp)){
													$rcp = $rcekrcp['rcp_lunas'];
													$tanggal = $rcekrcp['tanggal'];
													$ot = $rq1['nama_outlet'];
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $tanggal; ?></td>
                                            <td><?php echo $rcp; ?></td>
                                            <td><?php echo $ot; ?></td>
                                            <?php
                                            $cash = mysqli_query($con, "select sum(jumlah) as cas from cara_bayar where resepsionis='$rcp' and outlet='$ot' and tanggal_input like '%$tanggal%' and (cara_bayar='Cash' or cara_bayar='cash')");
						$rcash = mysqli_fetch_array($cash);
						$tambahan = mysqli_query($con, "select sum(total) as tambah from faktur_penjualan where cara_bayar like '%cash%' and jenis_transaksi<>'ritel' and tgl_transaksi like '%$tanggal%' and rcp='$rcp' and nama_outlet='$ot'");
						$rtambahan = mysqli_fetch_array($tambahan);
						$ntambahan = mysqli_num_rows($tambahan);
						if ($ntambahan>0){
						   $tmbh = $rtambahan['tambah'];
						}
						else{
						   $tmbh = 0;
						}
						$pengeluaran = mysqli_query($con, "select sum(pengeluaran) as keluar from tutup_kasir where tanggal like '%$tanggal%' and reception='$rcp' and outlet='$ot'");
											$rpengeluaran = mysqli_fetch_array($pengeluaran);
											$npengeluaran = mysqli_num_rows($pengeluaran);
											if ($npengeluaran>0){
											   $klr = $rpengeluaran['keluar'];
											}
											else{
											   $klr = 0;
											}
						$penerimaan = $rcash['cas']+$tmbh-$klr;
						?>
                                            
                                            <td><?php echo rupiah($penerimaan); ?></td>
                                            <?php
                                             $kasir = mysqli_query($con, "select * from tutup_kasir where tanggal like '%$tanggal%' and reception='$rcp' and outlet='$ot'");
                                             $rkasir = mysqli_fetch_array($kasir);
                                            ?>                                            
                                            <td><?php echo rupiah($rkasir['pengeluaran']); ?></td>  
                                            <td><?php echo $rkasir['untuk']; ?></td> 
                                            <td><?php echo rupiah($rkasir['setoran_bersih']); ?></td>
                                            <?php
                                             $setor = mysqli_query($con, "select * from setoran_bank where reception = '$rcp' and outlet='$ot' and penerimaan1='$tanggal'");
                                             $rsetor = mysqli_fetch_array($setor);
                                            ?>                                            
                                            <td><?php echo rupiah($rsetor['setoran']); ?></td>
                                            <td><?php echo substr($rsetor['tanggal'],0,10); ?></td>
                                            <td><?php echo $rsetor['bank']; ?></td>
                                            <td><?php echo $rsetor['kode_referensi']; ?></td>
                                            <?php
                                            $ids = $rsetor['id'];
                                            $penyesuaian = mysqli_query($con, "select * from penyesuaian where id_setoran = '$ids'");
                                             $rpenyesuaian = mysqli_fetch_array($penyesuaian);
                                             $sesuai = $rpenyesuaian['penyesuaian'];
                                            ?>                                            
                                            <td>
                                            <?php 
                                            if ($rsetor['setoran']==0){
                                            }
                                            else{
                                            if ($sesuai==0){
                                            ?>
                                            <a href="index.php?menu=penyesuaian&ids=<?php echo $ids; ?>&rcp=<?php echo $rcp; ?>" onClick="return confirm('Apakah anda telah mengecek mutasi bank?')" ><button type="button" class="btn btn-primary btn-xs" style="background-color:#666666; border-color:#666666;" id="test" name="test">Proses</button></a>
                                            <?php
                                            }
                                            else{
                                            	echo rupiah($sesuai);
                                            }
                                            }
                                            ?></td>
                                            <td><?php echo $rpenyesuaian['keterangan'].' - '.$rpenyesuaian['op_penyesuaian']; ?></td>
                                            <td><?php echo rupiah($rsetor['setoran']-$penerimaan+$sesuai); ?></td>
                               	            <td align="center" style="vertical-align:middle;">
                                            <?php 

                                            if ($rsetor['setoran']==0){
                                            }
                                            else{
											if ($rsetor['verifikasi']=='Belum'){
											?>
                                            <a href="act/act_verifikasi.php?id=<?php echo $ids; ?>" onClick="return confirm('Apakah anda telah mengecek mutasi bank?')" ><button type="button" class="btn btn-primary btn-xs" style="background-color:#F00; border-color:#F00;" id="test" name="test">Proses</button></a>
											<?php
											} 
											else{
											?>
                                            <button type="button" class="btn btn-info btn-circle;"><i class="fa fa-check"></i></button>
                                            <?php
                                            }
                                            }
											?>
<script type="text/javascript">
	function very()
	{
	jawab = confirm("Apakah anda telah mengecek mutasi bank?");
        if (jawab == true) {
            return true;
        } else {
            return false;
        }
	};	
</script>
											</td>
                                            <td><?php echo $rsetor['op_verifikasi']; ?></td>
                                        </tr>
									<?php
									}
													}
											}
										// }
									?>
                                    </tbody>
                                </table>
                            </div>
                
