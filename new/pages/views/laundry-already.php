<div id="myform">
    <!-- Pengambilan -->
    <div class="laundry-already show" title="Laundry Selesai">
        <div>
            <h2 class="title">Daftar Cucian Selesai</h2>
            <div class="table-overlays" id="listLaundryHasReady"></div>
        </div>
        <button type="button" class="btn btn-primary"> <i class="ace-icon fa fa-save"></i> Ambil</button>
    </div>
</div>

<script>
jQuery(function ($) {
    let customerId, outletId, branchId, dataLaundry = [];
    customerId = '<?= $_GET['id'] ?>';

    getData("SalesOrder/laundry_already/"+ customerId, { }, function (data) {
        if (data.readyState == 0) {
            $(".laundry-already").find(".table-overlays").hide();
            let height = $(".laundry-already").find(".table-overlays").height();
            $(".laundry-already>div>.title").append($('<div id="load" align="center"><span style="margin-top: 100px"></span></div>'));
        }
        else {
            $(".laundry-already>div>.title").find("div#load").remove();
            $(".laundry-already").find(".table-overlays").show();
            let getData = data['data'];

            $.each(getData, function (index, value) {
                let content = '<div class="item-table-x"><input type="checkbox" id="item'+ index +'" value="'+ value.order_number +'"><label for="item'+ index +'"><table width="100%"><tr><td>No Pesanan</td><td>:</td><td>'+ value.order_number +'</td></tr><tr><td>Jenis</td><td>:</td><td>'+ value.order_type +'</td></tr><tr><td>Jumlah Item</td><td>:</td><td>'+ value.quantity +'</td></tr><tr><td>Tanggal Masuk</td><td>:</td><td>'+ value.order_date +'</td></tr><tr><td>Outlet</td><td>:</td><td>'+ value.outlet +'</td></tr></table></label></div>';
                $("#listLaundryHasReady").append(content);
            });
        }
    });

    $(document).on("click", "#listLaundryHasReady input[type=checkbox]", function () {
        let el = $(this).is(":checked");
        let order = {};
        orderNumber = $(this).val();
        if (el) {
            $(this).closest("#listLaundryHasReady>div").addClass("active");
            order.number = orderNumber;
            dataLaundry.push(order);
        }
        else {
            $(this).closest("#listLaundryHasReady>div").removeClass("active");
            id = dataLaundry.map(e  => e.number).indexOf(orderNumber);
            dataLaundry.splice(id, 1);
        }
    })

});
</script>