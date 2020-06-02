<?php
include 'head.php';
include 'charthc.php';
include 'mingguan.php';
echo '<p style="text-align:center; font-weight:bold; font-size:18px">Sekarang berjalan Minggu ke '.idate('W', mktime(0, 0, 0, $bln, $tgl, $thn)).' Tahun '.$thn.'</p><br>';
?>

<strong><center>1 Week = Sunday - Saturday</center></strong>
<script src="js/dark-green.js"></script>	
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: 'Linechart Omset Mingguan'
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    xAxis: {
        categories: [            
            '<?php echo 'Minggu ke '.idate('W', mktime(0, 0, 0, $bln5, $tgl5, $thn5)).' '.$thn5;?>',
            '<?php echo 'Minggu ke '.idate('W', mktime(0, 0, 0, $bln4, $tgl4, $thn4)).' '.$thn4;?>',
            '<?php echo 'Minggu ke '.idate('W', mktime(0, 0, 0, $bln3, $tgl3, $thn3)).' '.$thn3;?>',
            '<?php echo 'Minggu ke '.idate('W', mktime(0, 0, 0, $bln2, $tgl2, $thn2)).' '.$thn2;?>',
            '<?php echo 'Minggu ke '.idate('W', mktime(0, 0, 0, $bln, $tgl, $thn)).' '.$thn;?>'
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
        name: 'ALL Outlet',
        data: [<?php echo $all5;?>, <?php echo $all4;?>, <?php echo $all3;?>, <?php echo $all2;?>, <?php echo $all;?>]
    }, {
        name: 'Toddopuli',
        data: [<?php echo $tdl5;?>, <?php echo $tdl4;?>, <?php echo $tdl3;?>, <?php echo $tdl2;?>, <?php echo $tdl;?>]
    }, {
        name: 'Landak',
        data: [<?php echo $ld5;?>, <?php echo $ld4;?>, <?php echo $ld3;?>, <?php echo $ld2;?>, <?php echo $ld;?>]
    },{
        name: 'Baruga',
        data: [<?php echo $bg5;?>, <?php echo $bg4;?>, <?php echo $bg3;?>, <?php echo $bg2;?>, <?php echo $bg;?>]
    },{
        name: 'Boulevard',
        data: [<?php echo $bv5;?>, <?php echo $bv4;?>, <?php echo $bv3;?>, <?php echo $bv2;?>, <?php echo $bv;?>]
    },{
        name: 'TSM',
        data: [<?php echo $ts5;?>, <?php echo $ts4;?>, <?php echo $ts3;?>, <?php echo $ts2;?>, <?php echo $ts;?>]
    },{
        name: 'Graha Pena',
        data: [<?php echo $gp5;?>, <?php echo $gp4;?>, <?php echo $gp3;?>, <?php echo $gp2;?>, <?php echo $gp;?>]
    },{
        name: 'BTP',
        data: [<?php echo $bp5;?>, <?php echo $bp4;?>, <?php echo $bp3;?>, <?php echo $bp2;?>, <?php echo $bp;?>]
    },{
        name: 'DAYA',
        data: [<?php echo $dy5;?>, <?php echo $dy4;?>, <?php echo $dy3;?>, <?php echo $dy2;?>, <?php echo $dy;?>]
    },{
        name: 'Support',
        data: [<?php echo $sp5;?>, <?php echo $sp4;?>, <?php echo $sp3;?>, <?php echo $sp2;?>, <?php echo $sp;?>]
    }
	]
});
</script>