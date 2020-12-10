<div id="myform">
    <!-- Registrasi Langganan -->
    <div class="laundry-package list-package show" title="Registrasi Membership">
        <div>
            <h2 class="title">Daftar Level Membership</h2>
            <div class="table-overlays">
                <div class="list-package" id="listPackage">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading" id="level" data-value="red">RED</h4>
                            <p class="list-group-item-text">
                                <b id="discount" data-value="20">Diskon 20%</b> | <span id="months" data-value="12">12 Bulan</span> |
                                <b style="color: red" id="price" data-value="100000">Rp 100.000</b>
                                <div class="description">
                                    <b>Deskripsi :</b>
                                    <ul>
                                        <li>Setiap transaksi mendapatkan diskon 20%</li>
                                        <li>Berlaku untuk laundry potongan dan kiloan</li>
                                        <li>Masa aktif hingga 3 bulan</li>
                                        <li>Hanya berlaku di semua outlet yang terdaftar pada cabang ini</li>
                                    </ul>
                                </div>
                            </p>
                        </a>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading" id="level" data-value="blue3">BLUE 3 Bulan</h4>
                            <p class="list-group-item-text">
                                <b id="discount" data-value="20">Diskon 20%</b> | <span id="months" data-value="3">3 Bulan</span> |
                                <b style="color: red" id="price" data-value="100000">Rp 100.000</b>
                                <div class="description">
                                    <b>Deskripsi :</b>
                                    <ul>
                                        <li>Setiap transaksi mendapatkan diskon 20%</li>
                                        <li>Setiap transaksi minimal Rp 25.000 dapat 1 poin</li>
                                        <li>Poin yang terkumpul dapat ditukarkan dengan hadiah menarik</li>
                                        <li>Poin bisa ditukar dengan laundry gratis atau lainnya</li>
                                        <li>Berlaku untuk laundry potongan dan kiloan</li>
                                        <li>Masa aktif hingga 3 bulan</li>
                                        <li>Hanya berlaku di semua outlet yang terdaftar pada cabang ini</li>
                                    </ul>
                                </div>
                            </p>
                        </a>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading" id="level" data-value="blue6">BLUE 6 Bulan</h4>
                            <p class="list-group-item-text">
                                <b id="discount" data-value="20">Diskon 20%</b> | <span id="months" data-value="6">6 Bulan</span> |
                                <b style="color: red" id="price" data-value="150000">Rp 150.000</b>
                                <div class="description">
                                    <b>Deskripsi :</b>
                                    <ul>
                                        <li>Setiap transaksi mendapatkan diskon 20%</li>
                                        <li>Mendapat kesempatan kumpul poin</li>
                                        <li>Setiap transaksi minimal Rp 25.000 dapat 1 poin</li>
                                        <li>Poin bisa ditukar dengan laundry gratis atau lainnya</li>
                                        <li>Berlaku untuk laundry potongan dan kiloan</li>
                                        <li>Masa aktif hingga 3 bulan</li>
                                        <li>Hanya berlaku di semua outlet yang terdaftar pada cabang ini</li>
                                    </ul>
                                </div>
                            </p>
                        </a>
                        <a href="#" class="list-group-item">
                            <h4 class="list-group-item-heading" id="level" data-value="blue12">BLUE 12 Bulan</h4>
                            <p class="list-group-item-text">
                                <b id="discount" data-value="20">Diskon 20%</b> | <span id="months" data-value="12">12 Bulan</span> |
                                <b style="color: red" id="price" data-value="250000">Rp 250.000</b>
                                <div class="description">
                                    <b>Deskripsi :</b>
                                    <ul>
                                        <li>Setiap transaksi mendapatkan diskon 20%</li>
                                        <li>Mendapat kesempatan kumpul poin</li>
                                        <li>Setiap transaksi minimal Rp 25.000 dapat 1 poin</li>
                                        <li>Poin bisa ditukar dengan laundry gratis atau lainnya</li>
                                        <li>Berlaku untuk laundry potongan dan kiloan</li>
                                        <li>Masa aktif hingga 3 bulan</li>
                                        <li>Hanya berlaku di semua outlet yang terdaftar pada cabang ini</li>
                                    </ul>
                                </div>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="f-horizontal">
            <b id="labelPrice">Total Harga</b><b id="totalPrice">Rp 0</b>
        </div>
        <button type="button" class="btn btn-primary" id="buyOrder"> <i class="ace-icon fa fa-save"></i> Beli</button>
    </div>

    <div class="laundry-package pay-package" title="Registrasi Berlangganan">
        <div>
            <h2 class="title">Pembayaran</h2>
            <div class="table-overlays">
                <div class="panel panel-default panel-f">
                    <div class="panel-heading"><h3 class="panel-title">Cash</h3></div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="radio" class="form-control" id="cash" name="pay-method" value="cash">
                            <label for="cash">Cash</label>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default panel-f">
                    <div class="panel-heading">
                        <h3 class="panel-title">EDC</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="radio" class="form-control" id="edc_bca" name="pay-method" value="BCA">
                            <label for="edc_bca">BCA</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" class="form-control" id="edc_bni" name="pay-method" value="BNI">
                            <label for="edc_bni">BNI</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" class="form-control" id="edc_bri" name="pay-method" value="BRI">
                            <label for="edc_bri">BRI</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" class="form-control" id="edc_mandiri" name="pay-method" value="Mandiri">
                            <label for="edc_mandiri">Mandiri</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="f-horizontal">
            <b id="labelPrice">Total Bayar</b><b id="totalPay">Rp 0</b>
        </div>
        <button type="button" class="btn btn-primary" id="payPackage"> <i class="ace-icon fa fa-save"></i> Bayar</button>
    </div>
</div>

<script>
jQuery(function ($) {
    let level, months, price, order = {}, data = [];
    let customerId = '<?= $_GET['id'] ?>';    

    $(".list-group-item").on("click", function () {
        $(this).addClass("active");
        level = $(this).find("#level").data('value');
        months = $(this).find("#months").data('value');
        price = $(this).find("#price").data('value');

        $("#totalPrice, #totalPay").text(rupiah(price));

        $(".list-group-item").not(this).each(function () {
            $(this).removeClass("active");
            id = data.map(e  => e.level).indexOf(level);
            data.splice(id, 1);
        });
        
        order.customer = customerId;
        order.level = level;
        order.months = months;
        order.price = price;        
        data.push(order);
    });

    $("#buyOrder").on("click", function () {
        if (data.length > 0) {
            $(".list-package").removeClass("show");
            $(".pay-package").addClass("show");
        }
    });

    $("#payPackage").on("click", function () {
        let payMethod = $("input[name='pay-method']:checked").val();
        order.payment = payMethod;
        $dataOrder = data[0];

        alert("Belum siap digunakan");

    });
});

</script>