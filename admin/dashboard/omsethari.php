<?php
include 'hari.php';
?>

<script src="js/sand-signika.js"></script>	
<div id="container" style="min-width: 240px; height: 260px; margin: 0 auto"></div>

<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'areaspline'
    },
    title: {
        text: 'Omset Harian setelah dikurangi pengeluaran'
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
            '<?php echo date('l', strtotime('-6 day', strtotime(date('Y-m-d')))).'<br>'.date('d M Y', strtotime('-6 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('l', strtotime('-5 day', strtotime(date('Y-m-d')))).'<br>'.date('d M Y', strtotime('-5 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('l', strtotime('-4 day', strtotime(date('Y-m-d')))).'<br>'.date('d M Y', strtotime('-4 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('l', strtotime('-3 day', strtotime(date('Y-m-d')))).'<br>'.date('d M Y', strtotime('-3 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('l', strtotime('-2 day', strtotime(date('Y-m-d')))).'<br>'.date('d M Y', strtotime('-2 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('l', strtotime('-1 day', strtotime(date('Y-m-d')))).'<br>'.date('d M Y', strtotime('-1 day', strtotime(date('Y-m-d')))); ?>',
            '<?php echo date('l').'<br>'.date('d M Y'); ?>'                        
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
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet13 ?></p>',
        data: [<?php echo hasil($day7,$outlet13);?>,<?php echo hasil($day6,$outlet13);?>,<?php echo hasil($day5,$outlet13);?>, <?php echo hasil($day4,$outlet13);?>, <?php echo hasil($day3,$outlet13);?>, <?php echo hasil($day2,$outlet13);?>, <?php echo hasil($day1,$outlet13);?>]
    }, {
        name: '<p style="font-size:10px"><?php echo $outlet14 ?></p>',
        data: [<?php echo hasil($day7,$outlet14);?>,<?php echo hasil($day6,$outlet14);?>,<?php echo hasil($day5,$outlet14);?>, <?php echo hasil($day4,$outlet14);?>, <?php echo hasil($day3,$outlet14);?>, <?php echo hasil($day2,$outlet14);?>, <?php echo hasil($day1,$outlet14);?>]
    }
	]
});
</script>

