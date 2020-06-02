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
                        <div class="panel-heading"><center><b>
                            LAPORAN RESPON CODE RECEPTIONIST HARI INI </b></center>
                        </div>
                        <div class="panel-body">

                            <!-- /.row (nested) -->

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" valign="center">Outlet<br>&nbsp</th>
                                            <th rowspan="2" class="dua">Receptionist<br>&nbsp</th>
                                            <th rowspan="2">Waktu<br> Login Pertama</th>
                                            <th colspan="2">Challenge Code</th>
                                        </tr>
                                        <tr><th>8 Jam</th><th>12 Jam</th></tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php
                                        $qcek = mysqli_query($con, "select * from log_rcp where tgl_log like '%$date%'");
                                        while ($rcek = mysqli_fetch_array($qcek)){  
                                    ?>
                                        <tr class="odd gradeX">
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
<?php
/*$todayDate = date("Y-m-d");// tanggal sekarang

echo "Hari ini: ".$todayDate."<br>";
$now = strtotime(date("Y-m-d"));

echo "<br>";

$date = date('Y-m-d', strtotime('-1 day', $now));
echo "Setelah menambahkan 1 hari = ".$date."<br>";
$addMonth = 5;

//Tambahkan variabel menambahkan Bulan untuk hari ini
$date2 = date('Y-m-d', strtotime('+'.$addMonth.' month', $now));
echo "Setelah menambahkan $addMonth bulan = ".$date2."<br>";

//Tambahkan 6 tahun ke hari
$date3 = date('Y-m-d', strtotime('+6 year', $now));
echo "Setelah menambahkan 6 year = ".$date3."<br>";*/
$now = strtotime(date("Y-m-d"));
$date = date('Y-m-d', strtotime('-1 day', $now));
                                        $cekpop = mysqli_query($con,"select * from poptime where time like '%$date%'");
                                        $jpop= mysqli_num_rows($cekpop);
                                        $i=1;
                                        while($dpop = mysqli_fetch_array($cekpop)){
                                                $wpop[$i]= $dpop['time']; $i++;}
?>
                        <div class="panel-heading"><center><b>
                            LAPORAN RESPON CODE RECEPTIONIST KEMARIN</b></center>
                        </div>
                        <div class="panel-body">

                            <!-- /.row (nested) -->

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Outlet<br>&nbsp</th>
                                            <th rowspan="2">Receptionist<br>&nbsp</th>
                                            <th rowspan="2">Waktu Login Pertama</th>
                                            <th colspan="2">Challenge Code</th>
                                            <th rowspan="2"> Waktu<br> Tutup Kasir</th>
                                        </tr>
                                        <tr><th>8 Jam</th><th>12 Jam</th></tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $qcek = mysqli_query($con, "select * from log_rcp where tgl_log like '%$date%'");
                                        while ($rcek = mysqli_fetch_array($qcek)){  
                                    ?>
                                        <tr class="odd gradeX">
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
                                            <td>
                                            <?php
                                            $qtk = mysqli_query($con, "select * from tutup_kasir where tanggal like '%$date%' and reception='$usr' and outlet='$outl'");
                                            $rtk = mysqli_fetch_array($qtk);
                                            if (mysqli_num_rows($qtk)>0) 
                                                 echo substr($rtk[1], 11,8);
                                            else echo '-'; 
                                            
                                            ?>
                                            </td>
                                        </tr>
                                    <?php   
                                        }
                                     ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
