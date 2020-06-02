<?php 

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$day = date('l');
$month = date('M');

$day1 = date('w Y-m-d');
$day2 = date('w Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
$day3 = date('w Y-m-d', strtotime('-2 day', strtotime(date('Y-m-d'))));
$day4 = date('w Y-m-d', strtotime('-3 day', strtotime(date('Y-m-d'))));
$day5 = date('w Y-m-d', strtotime('-4 day', strtotime(date('Y-m-d'))));
$day6 = date('w Y-m-d', strtotime('-5 day', strtotime(date('Y-m-d'))));
$day7 = date('w Y-m-d', strtotime('-6 day', strtotime(date('Y-m-d'))));

$outlet1 = "Toddopuli";
$outlet2 = "Landak";
$outlet3 = "Baruga";
$outlet4 = "Boulevard";
$outlet5 = "DAYA";
$outlet6 = "BTP";
$outlet7 = "Graha Pena";
$outlet8 = "Trans Studio Mall";
$outlet9 = "Sungai Saddang";
$outlet10 = "Royal Apartment"; 
$outlet11 = "Antang";
$outlet12 = "support";




switch ($day){
    case "Sunday" : $hari = "Sun"; break;
    case "Monday" : $hari = "Mon"; break;
    case "Tuesday" : $hari = "Tue"; break;
    case "Wednesday" : $hari = "Wed"; break;
    case "Thursday" : $hari = "Thur"; break;
    case "Friday" : $hari = "Fri"; break;
    case "Saturday" : $hari = "Sat"; break;
}

switch ($month){
    case "Jan" : $bulan = "Januari"; break;
    case "Feb" : $bulan = "Februari"; break;
    case "Mar" : $bulan = "Maret"; break;
    case "Apr" : $bulan = "April"; break;
    case "Mei" : $bulan = "Mei"; break;
    case "Jun" : $bulan = "Juni"; break;
    case "Jul" : $bulan = "Juli"; break;
    case "Aug" : $bulan = "Agustus"; break;
    case "Sep" : $bulan = "September"; break;
    case "Okt" : $bulan = "Oktober"; break;
    case "Nov" : $bulan = "November"; break;
    case "Des" : $bulan = "Desember"; break;
}


function pembayaran_outlet($day1,$outlet1){
    global $con;
    $query = mysqli_query($con, "select sum(total) as toddopuli from faktur_penjualan where date_format(tgl_transaksi, '%w %Y-%m-%d')='$day1' and cara_bayar<>'kuota' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' and nama_outlet='$outlet1'");
    $data = mysqli_fetch_row($query);
    return $data[0];
}

function pengeluaran_outlet($day1,$outlet1){
    global $con;
    $query = mysqli_query($con, "select sum(pengeluaran) as keluar from tutup_kasir where DATE_FORMAT(tanggal, '%w %Y-%m-%d')='$day1' and outlet='$outlet1'");
    $data = mysqli_fetch_row($query);
    return $data[0];
}

function cashback_outlet($day1,$outlet1){
    global $con;
    $query = mysqli_query($con, "select sum(jumlah) as toddopuli from cara_bayar where date_format(tanggal_input, '%w %Y-%m-%d')='$day1' and cara_bayar='cashback' and outlet='$outlet1'");
    $data = mysqli_fetch_row($query);
    return $data[0];
}

function hasil($day1,$outlet1){
    $data = pembayaran_outlet($day1,$outlet1)-cashback_outlet($day1,$outlet1)-pengeluaran_outlet($day1,$outlet1);
    return $data;
}


?>



<script src="../admin/js/sand-signika.js"></script>  
<div id="container" style="min-width: 240px; height: 260px; margin: 0 auto"></div>

<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: ''
    },
    legend: {
        layout: 'horizontal',
        align: 'left',
        verticalAlign: 'top',
        x: 100,
        y: 20,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
        categories: [                     
            '<?php echo date('D', strtotime('-6 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('D', strtotime('-5 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('D', strtotime('-4 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('D', strtotime('-3 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('D', strtotime('-2 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('D', strtotime('-1 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('D'); ?>'                        
        ],
        plotBands: [{ // visualize the weekend
            from: 4.5,
            to: 6.5,
            color: 'rgba(68, 170, 213, .2)'
        }]
    },
    yAxis: {
        title: {
            text: 'Omset (Rupiah)'
        }
    },
    tooltip: {
        shared: true,
        valueSuffix: ' '
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        areaspline: {
            fillOpacity: 0.5
        }
    },
    series: [{
        name: '<p style="font-size:10px"><?php echo $outlet1 ?></p>',
        data: [<?php echo hasil($day7,$outlet1);?>,<?php echo hasil($day6,$outlet1);?>,<?php echo hasil($day5,$outlet1);?>, <?php echo hasil($day4,$outlet1);?>, <?php echo hasil($day3,$outlet1);?>, <?php echo hasil($day2,$outlet1);?>, <?php echo hasil($day1,$outlet1);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet2 ?></p>',
        data: [<?php echo hasil($day7,$outlet2);?>,<?php echo hasil($day6,$outlet2);?>,<?php echo hasil($day5,$outlet2);?>, <?php echo hasil($day4,$outlet2);?>, <?php echo hasil($day3,$outlet2);?>, <?php echo hasil($day2,$outlet2);?>, <?php echo hasil($day1,$outlet2);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet3 ?></p>',
        data: [<?php echo hasil($day7,$outlet3);?>,<?php echo hasil($day6,$outlet3);?>,<?php echo hasil($day5,$outlet3);?>, <?php echo hasil($day4,$outlet3);?>, <?php echo hasil($day3,$outlet3);?>, <?php echo hasil($day2,$outlet3);?>, <?php echo hasil($day1,$outlet3);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet4 ?></p>',
        data: [<?php echo hasil($day7,$outlet4);?>,<?php echo hasil($day6,$outlet4);?>,<?php echo hasil($day5,$outlet4);?>, <?php echo hasil($day4,$outlet4);?>, <?php echo hasil($day3,$outlet4);?>, <?php echo hasil($day2,$outlet4);?>, <?php echo hasil($day1,$outlet4);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet5 ?></p>',
        data: [<?php echo hasil($day7,$outlet5);?>,<?php echo hasil($day6,$outlet5);?>,<?php echo hasil($day5,$outlet5);?>, <?php echo hasil($day4,$outlet5);?>, <?php echo hasil($day3,$outlet5);?>, <?php echo hasil($day2,$outlet5);?>, <?php echo hasil($day1,$outlet5);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet6 ?></p>',
        data: [<?php echo hasil($day7,$outlet6);?>,<?php echo hasil($day6,$outlet6);?>,<?php echo hasil($day5,$outlet6);?>, <?php echo hasil($day4,$outlet6);?>, <?php echo hasil($day3,$outlet6);?>, <?php echo hasil($day2,$outlet6);?>, <?php echo hasil($day1,$outlet6);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet7 ?></p>',
        data: [<?php echo hasil($day7,$outlet7);?>,<?php echo hasil($day6,$outlet7);?>,<?php echo hasil($day5,$outlet7);?>, <?php echo hasil($day4,$outlet7);?>, <?php echo hasil($day3,$outlet7);?>, <?php echo hasil($day2,$outlet7);?>, <?php echo hasil($day1,$outlet7);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet8 ?></p>',
        data: [<?php echo hasil($day7,$outlet8);?>,<?php echo hasil($day6,$outlet8);?>,<?php echo hasil($day5,$outlet8);?>, <?php echo hasil($day4,$outlet8);?>, <?php echo hasil($day3,$outlet8);?>, <?php echo hasil($day2,$outlet8);?>, <?php echo hasil($day1,$outlet8);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet9 ?></p>',
        data: [<?php echo hasil($day7,$outlet9);?>,<?php echo hasil($day6,$outlet9);?>,<?php echo hasil($day5,$outlet9);?>, <?php echo hasil($day4,$outlet9);?>, <?php echo hasil($day3,$outlet9);?>, <?php echo hasil($day2,$outlet9);?>, <?php echo hasil($day1,$outlet9);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet10 ?></p>',
        data: [<?php echo hasil($day7,$outlet10);?>,<?php echo hasil($day6,$outlet10);?>,<?php echo hasil($day5,$outlet10);?>, <?php echo hasil($day4,$outlet10);?>, <?php echo hasil($day3,$outlet10);?>, <?php echo hasil($day2,$outlet10);?>, <?php echo hasil($day1,$outlet10);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet11 ?></p>',
        data: [<?php echo hasil($day7,$outlet11);?>,<?php echo hasil($day6,$outlet11);?>,<?php echo hasil($day5,$outlet11);?>, <?php echo hasil($day4,$outlet11);?>, <?php echo hasil($day3,$outlet11);?>, <?php echo hasil($day2,$outlet11);?>, <?php echo hasil($day1,$outlet11);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet12 ?></p>',
        data: [<?php echo hasil($day7,$outlet12);?>,<?php echo hasil($day6,$outlet12);?>,<?php echo hasil($day5,$outlet12);?>, <?php echo hasil($day4,$outlet12);?>, <?php echo hasil($day3,$outlet12);?>, <?php echo hasil($day2,$outlet12);?>, <?php echo hasil($day1,$outlet12);?>]
    }
    ]
});
</script>