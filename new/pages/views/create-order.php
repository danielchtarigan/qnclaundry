<div id="myform" class="create-order">   

    <div class="choose-item sales-category show">
        <div class="overlay">
            <h2 class="title">Pilih Kategori Penjualan</h2>
            <div class="table-overlays">
                <div class="list-package">
                    <div class="list-group">
                        <a href="#" class="list-group-item" id="salesCategory">
                            <h4 class="list-group-item-heading">Laundry Kiloan</h4>
                            <p class="list-group-item-text">
                                <b id="value" data-value="1">Cucian dihitung per kilogram</b>
                            </p>
                        </a>
                        <a href="#" class="list-group-item" id="salesCategory">
                            <h4 class="list-group-item-heading">Laundry Potongan</h4>
                            <p class="list-group-item-text">
                            <b id="value" data-value="2">Cucian dihitung per lembar</b>
                            </p>
                        </a>
                        <a href="#" class="list-group-item" id="salesCategory">
                            <h4 class="list-group-item-heading">Barang Retail</h4>
                            <p class="list-group-item-text">
                                <b id="value" data-value="3">Barang yang dijual di outlet</b>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>              
        <button type="button" class="btn btn-primary" id="nextstep" disabled><i class="ace-icon fa fa-arrow-circle-right"></i> Berikutnya</button>
    </div>

    <div class="choose-item sales-item-kilo">
        <div class="overlay">
            <h2 class="title">Pilih Item Kiloan</h2>
            <div class="table-overlays">
                <div class="list-package">
                    <div class="list-group">
                        <a href="#" class="list-group-item" id="salesCategory">
                            <h4 class="list-group-item-heading">Cuci Kering</h4>
                            <p class="list-group-item-text">
                                <b id="value" data-value="1" class="text-red">Rp. 10.000</b>
                            </p>
                        </a>
                        <a href="#" class="list-group-item" id="salesCategory">
                            <h4 class="list-group-item-heading">Cuci Kering + Setrika</h4>
                            <p class="list-group-item-text">
                                <b id="value" data-value="2" class="text-red">Rp. 10.000 + Rp. 8.000</b>
                            </p>
                        </a>
                        <a href="#" class="list-group-item" id="salesCategory">
                            <h4 class="list-group-item-heading">Cuci Kering + Lipat</h4>
                            <p class="list-group-item-text">
                                <b id="value" data-value="3" class="text-red">Rp. 10.000 + Rp. 4.000</b>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>    
        <div class="f-horizontal column">
            <div class="flex-row">
                <div class="form-group col-md-3">
                    <label for="">Berat</label>
                    <input class="form-control" type="text" id="weight" autocomplete="off" disabled>
                </div>
                <div class="form-group col-md-9">
                    <label for="">Harga</label>
                    <input class="form-control" type="text" id="price" readonly>
                </div>
            </div>
        </div>          
        <button type="button" class="btn btn-primary" id="nextstep" disabled><i class="ace-icon fa fa-arrow-circle-right"></i> Berikutnya</button>
    </div>
</div>

<style>
    .text-red {
        color: red;
    }

    .f-horizontal {
        margin-top: -40px;
    }

    .f-horizontal.column {
        flex-direction: column;
    }

    .flex-row {
        display: flex;
        justify-content: space-between;
    }
</style>

<script type="text/javascript">
  jQuery(function ($) {
      let dataSales = [];
      let category, item, priceItem, weight, quantity;

      let ckPrice, sPrice, lPrice;
    
    $(".sales-category .list-group-item").on("click", function () {
        $(this).addClass("active");

        let val = $(this).find("#value").data("value");

        $(".list-group-item").not(this).each(function () {
            $(this).removeClass("active");
        });

        $(".sales-category #nextstep").prop("disabled", false);

        category = val;
    });


    $(".sales-category #nextstep").on("click", function (e) {
        e.preventDefault();

        $(".sales-category").removeClass("show");

        if (category === 1) {
            $(".sales-item-kilo").addClass("show");
        }
        else {
            console.log("Bukan Kiloan");
        }
    });


    $(".sales-item-kilo .list-group-item").on("click", function () {
        $(this).addClass("active");

        let val = $(this).find("#value").data("value");

        $(".list-group-item").not(this).each(function () {
            $(this).removeClass("active");
        });

        $(".sales-item-kilo #nextstep").prop("disabled", false);

        item = val;

        ckPrice = 10000;
        sPrice = 8000;
        lPrice = 4000;

        weight = 1;

        priceItem = val === 1 ? ckPrice : (val === 2 ? ckPrice + sPrice : ckPrice +lPrice);
        priceItem = parseFloat(priceItem.toString().replace(/\,/g, '.'));

        $(".sales-item-kilo").find("#weight").val(weight).attr("disabled", false);
        $(".sales-item-kilo").find("#price").val(priceItem);
    });

    $(".sales-item-kilo #weight").on("keypress keyup", function () {
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }

        weight = parseFloat($(this).val().toString().replace(/\,/g, '.'));

        priceItem = parseFloat(priceItem.toString().replace(/\,/g, '.')) * weight;

        $(".sales-item-kilo").find("#weight").val(weight).prop("disabled", false);
        $(".sales-item-kilo").find("#price").val(priceItem).attr("readonly", true);
    });

    $(".sales-item-kilo #nextstep").on("click", function (e) {
        e.preventDefault();

        console.log(item);
    });


  })
</script>