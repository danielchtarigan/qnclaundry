<?php 

include '../bs_data/sales_goods.php';
?>
<thead>
    <tr>
        <th>Tanggal</th>
        <th>Nama Outlet</th>
        <th>Nama Customer</th>
        <th>Nomor Faktur</th>
        <th>Dibuat Oleh</th>
        <th>Jumlah</th>
    </tr>
</thead>
<tbody>
    <?php 
    if(is_array($data)) 
    {
        foreach ($data as $key => $val) 
        {
            echo '
            <tr class="main">
                <td>'.date_format(date_create($val['order_date']), 'd/m/Y').'</td>
                <td>'.$val['outlet'].'</td>
                <td>'.customer($val['customer_id']).'</td>
                <td>
                    <a href="javascript:" data-id="'.$key.'" id="kk"">'.$key.'</a>
                </td>
                <td>'.$val['created_by'].'</td>
                <td>'.currency($val['amount']).'</td>      
            </tr>        
            ';

        } 
    }
    else 
    {
        echo '
        <tr>
            <td colspan="6" align="center">Data belum tersedia</td>
        </tr>
        ';
    }
        ?>
</tbody>
<tfoot>
    <tr>
        <th colspan="5" style="text-align:right">Total:</th>
        <th></th>
    </tr>
</tfoot>



<script>
    jQuery(function($) {

        $('tbody>tr').on('click', 'td>a', function () {
            var key = $(this).data('id');
            var td = $(this);
            var start = '<?= $_GET['start'] ?>';
            var end = '<?= $_GET['end'] ?>';
            var jar = '<?= $_GET['jar'] ?>';
            var data = {
                start:start,
                end:end,
                jar:jar,
                key:key
            };
            $.ajax({
                url: 'bs_data/sales_goods.php',
                data: data,
                dataType: 'html',
                success: function(resData) {
                    len = td.closest('tbody').find('tr.goods'+key).length;
                    if(len == 0) {
                        td.closest('tbody>tr').after(resData);
                    }
                    else  {
                        td.closest('tbody').find('tr.goods'+key).remove();
                    }
                } 
            })
        })
    })
</script>

