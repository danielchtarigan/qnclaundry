<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Total Kas Resepsionis
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                    <?php                      
                                    $qrcp = mysqli_query($con, "select * from user where level='reception' and aktif='Ya' order by name asc");
                                    while ($rrcp = mysqli_fetch_array($qrcp)){
                                    $reception = $rrcp['name'];
                                    ?>                                    
                                    <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i> <?php echo $reception; ?>
                                            <?php
                        $rcp = $reception;
                        $no = 31;
                        $tahun = date('Y');
                        $bulan = date('m');
                        $bersih = 0;
                        $tambah = 0;
                        $keluar = 0;
                        $setoran = 0;
                        $sesuai = 0;
                        for ($no; $no>1; $no--){
                            $tanggal = $tahun.'-'.$bulan.'-'.sprintf('%02s', $no);
                            $bersih2 = 0;
                            $tambah2 = 0;
                            $keluar2 = 0;
                            $setoran2 = 0;
                            $sesuai2 = 0;
                            $outlet = mysqli_query($con, "select * from outlet");
                            while ($rot = mysqli_fetch_array($outlet)){
                               $ot = $rot['nama_outlet'];
                               $q2 = mysqli_query($con, "select sum(jumlah) as total from cara_bayar where resepsionis='$rcp' and outlet='$ot' and tanggal_input like '%$tanggal%' and cara_bayar='Cash'");
                               $rq2 = mysqli_fetch_array($q2);
                               $bersih2=$bersih2+$rq2['total']; 
                                $tambahan = mysqli_query($con, "select sum(total) as tambah from faktur_penjualan where cara_bayar='cash' and jenis_transaksi<>'ritel' and tgl_transaksi like '%$tanggal%' and rcp='$rcp' and nama_outlet='$ot'");
                                $rtambahan = mysqli_fetch_array($tambahan);
                                $ntambahan = mysqli_num_rows($tambahan);
                                if ($ntambahan>0){
                                       $tmbh = $rtambahan['tambah'];
                                }
                                else{
                                    $tmbh = 0;
                                }
                                $tambah2 = $tambah2+$tmbh;
                                $pengeluaran = mysqli_query($con, "select sum(pengeluaran) as keluar from tutup_kasir where tanggal like '%$tanggal%' and reception='$rcp' and outlet='$ot'");
                                $rpengeluaran = mysqli_fetch_array($pengeluaran);
                                $npengeluaran = mysqli_num_rows($pengeluaran);
                                if ($npengeluaran>0){
                                   $klr = $rpengeluaran['keluar'];
                                }
                                else{
                                   $klr = 0;
                                }
                                $keluar2 = $keluar2+$klr;
                                $setor = mysqli_query($con, "select * from setoran_bank where reception = '$rcp' and outlet='$ot' and penerimaan1='$tanggal' and verifikasi='Terverifikasi'");
                                                        $rsetor = mysqli_fetch_array($setor);
                                                        $nsetor = mysqli_num_rows($setor);
                                if ($nsetor>0){
                                   $setr = $rsetor['setoran'];
                                }
                                else{
                                   $setr = 0;
                                }
                                $setoran2 = $setoran2+$setr;
                                $ids = $rsetor['id'];
                                                        $penyesuaian = mysqli_query($con, "select * from penyesuaian where id_setoran = '$ids'");
                                                    $rpenyesuaian = mysqli_fetch_array($penyesuaian);
                                                        $sesuai2 = $sesuai2+$rpenyesuaian['penyesuaian'];                                                           
                            }
                            $bersih = $bersih+$bersih2;
                            $tambah = $tambah+$tambah2;
                            $keluar = $keluar+$keluar2;
                            $setoran = $setoran+$setoran2;
                            $sesuai = $sesuai+$sesuai2;
}

                            $penerimaan = ($bersih+$tambah-$keluar-$setoran+$sesuai);
?>
                                            <span class="pull-right text-muted small"><em><?php echo rupiah($penerimaan); ?></em>
                                    </span>
                                </a> 
                                    <?php
                                    }                                    
                                    
                     ?>
                </div>
                            <!-- /.list-group -->
                            <a href="index.php?menu=setoran_bank" class="btn btn-default btn-block">View Transaction Detail</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->                   
                </div>
                <!-- /.col-lg-4 -->                                                   