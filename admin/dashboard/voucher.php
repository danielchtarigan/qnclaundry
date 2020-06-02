<?php 
$tanggal1 = date('Y-m-d', strtotime('-7 day', strtotime(date('Y-m-d'))));
$tanggal2 = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

?>

<script src="js/dark-unica.js"></script>
<div id="tampil" style="min-width: 110px; height: 300px; margin: 50 auto;"></div>

<table id="voucher" class="hidden">
    <thead>
        <tr>
            <th></th>
            <th>Penggunaan</th>
            <th>Pengguna</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Cashback</th>            
            <td><?php 
            // $voucher = mysqli_query($con, "select COUNT(id_customer) as jumlah from reception where (voucher like '%25RB%' or voucher like '%50RB%') and lunas=1 and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2') ");
            // $qc = mysqli_fetch_assoc($voucher);
            // echo $qc['jumlah']  
            
            $voucher = mysqli_query($con, "SELECT COUNT(DISTINCT kode_voucher) as jumlah FROM using_voucher WHERE kode_voucher LIKE 'QCB%' AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_array($voucher);
            echo $qc['jumlah'];?>
            </td>
            <td><?php 
            // $voucher = mysqli_query($con, "select COUNT(DISTINCT id_customer) as jumlah from reception where (voucher like '%25RB%' or voucher like '%50RB%') and lunas=1 and DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            // $qc = mysqli_fetch_assoc($voucher);
            // echo $qc['jumlah']   
            
            $voucher = mysqli_query($con, "SELECT COUNT(DISTINCT id_customer) as jumlah FROM using_voucher WHERE kode_voucher LIKE 'QCB%' AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_array($voucher);
            echo $qc['jumlah'];?> 
            </td>
        </tr>
        <tr>
            <th>Recovery</th>
            <td><?php 
            // $voucher = mysqli_query($con, "select COUNT(id_customer) as jumlah from reception where (voucher like '%00RB%' or voucher like '%RCVQC%') and lunas=1 and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2') ");
            // $qc = mysqli_fetch_assoc($voucher);
            // echo $qc['jumlah']; 
            
            $voucher = mysqli_query($con, "SELECT COUNT(DISTINCT kode_voucher) as jumlah FROM using_voucher WHERE kode_voucher LIKE 'RCV%' AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_array($voucher);
            echo $qc['jumlah'];?>
            </td>
            <td><?php 
            // $voucher = mysqli_query($con, "select COUNT(DISTINCT id_customer) as jumlah from reception where (voucher like '%00RB%' or voucher like '%RCVQC%') and lunas=1 and DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            // $qc = mysqli_fetch_assoc($voucher);
            // echo $qc['jumlah'];
            
            $voucher = mysqli_query($con, "SELECT COUNT(DISTINCT id_customer) as jumlah FROM using_voucher WHERE kode_voucher LIKE 'RCV%' AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_array($voucher);
            echo $qc['jumlah'];?> 
            </td>
        </tr>
        <tr>
            <th>BNI</th>
            <td><?php 
            $voucher = mysqli_query($con, "select COUNT(id_customer) as jumlah from reception where (voucher like '%DBBNI%' or voucher like '%KKBNI%') and lunas=1 and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2') ");
            $qc = mysqli_fetch_assoc($voucher);
            echo $qc['jumlah'] ?>                
            </td>
            <td><?php 
            $voucher = mysqli_query($con, "select COUNT(DISTINCT id_customer) as jumlah from reception where (voucher like '%DBBNI%' or voucher like '%KKBNI%') and lunas=1 and DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_assoc($voucher);
            echo $qc['jumlah'] ?>                
            </td>
        </tr>
        <tr>
            <th>Voucher Diskon</th>
            <td><?php 
            $voucher = mysqli_query($con, "select COUNT(id_customer) as jumlah from reception where (voucher like '%D15%' or voucher like '%D25%' or voucher like '%D35%') and lunas=1 and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2') ");
            $qc = mysqli_fetch_assoc($voucher);
            echo $qc['jumlah'] ?>                
            </td>
            <td><?php 
            $voucher = mysqli_query($con, "select COUNT(DISTINCT id_customer) as jumlah from reception where (voucher like '%D15%' or voucher like '%D25%' or voucher like '%D35%') and lunas=1 and DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_assoc($voucher);
            echo $qc['jumlah'] ?>                
            </td>
        </tr>
        <tr>
            <th>SMS BC</th>
             <td><?php 
            $voucher = mysqli_query($con, "select COUNT(id_customer) as jumlah from reception where (voucher like '%SATUAN30%' OR voucher LIKE '%BC%' OR voucher LIKE 'LIKEANTANG') and lunas=1 and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2') ");
            $qc = mysqli_fetch_assoc($voucher);
            echo $qc['jumlah'] ?>                
            </td>
            <td><?php 
            $voucher = mysqli_query($con, "select COUNT(DISTINCT id_customer) as jumlah from reception where (voucher like '%SATUAN30%' OR voucher LIKE '%BC%' OR voucher LIKE 'LIKEANTANG') and lunas=1 and DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_assoc($voucher);
            echo $qc['jumlah'] ?>                
            </td>
        </tr>
        <tr>
            <th>MEDSOS</th>
             <td><?php 
            $voucher = mysqli_query($con, "select COUNT(id_customer) as jumlah from reception where (voucher like '%LIKEFB%' or voucher like '%MED%') and lunas=1 and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2') ");
            $qc = mysqli_fetch_assoc($voucher);
            echo $qc['jumlah'] ?>                
            </td>
            <td><?php 
            $voucher = mysqli_query($con, "select COUNT(DISTINCT id_customer) as jumlah from reception where (voucher like '%LIKEFB%' or voucher like '%MED%') and lunas=1 and DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_assoc($voucher);
            echo $qc['jumlah'] ?>                
            </td>
        </tr>
        <tr>
            <th>Trans dan Carrefour</th>
            <td><?php 
            // $voucher = mysqli_query($con, "select COUNT(id_customer) as jumlah from reception where (voucher like '%QCR%' or voucher like '%QTR%') and lunas=1 and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2') ");
            // $qc = mysqli_fetch_assoc($voucher);
            // echo $qc['jumlah']                
            $voucher = mysqli_query($con, "SELECT COUNT(DISTINCT kode_voucher) as jumlah FROM using_voucher WHERE (kode_voucher LIKE 'QTR%' OR kode_voucher LIKE 'QCR') AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_array($voucher);
            echo $qc['jumlah'];
            ?>
            </td>
            <td><?php 
            // $voucher = mysqli_query($con, "select COUNT(DISTINCT id_customer) as jumlah from reception where (voucher like '%QCR%' or voucher like '%QTR%') and lunas=1 and DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            // $qc = mysqli_fetch_assoc($voucher);
            // echo $qc['jumlah'] 
            $voucher = mysqli_query($con, "SELECT COUNT(DISTINCT id_customer) as jumlah FROM using_voucher WHERE (kode_voucher LIKE 'QTR%' OR kode_voucher LIKE 'QCR') AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$tanggal1' and '$tanggal2' ");
            $qc = mysqli_fetch_array($voucher);
            echo $qc['jumlah'];
            ?>                
            </td>
        </tr>
    </tbody>
</table>

<script type="text/javascript">
    Highcharts.chart('tampil', {
    data: {
        table: 'voucher'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: '<p style="font-size:10px"> Quantity</p>'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    }
});
</script>
