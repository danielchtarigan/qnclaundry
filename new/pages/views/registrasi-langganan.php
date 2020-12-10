<div id="myform">
    <!-- Registrasi Langganan -->
    <div class="laundry-package list-package show" title="Registrasi Berlangganan">
        <div>
            <h2 class="title">Daftar Paket Langganan</h2>
            <div class="table-overlays">
                <div class="list-package" id="listPackage">
                    <div class="list-group">
                        <a href="#" class="list-group-item" id="itemPackage">
                            <h4 class="list-group-item-heading">Hemat 30</h4>
                            <p class="list-group-item-text">
                                <b id="package" data-value="30">30 Kg</b> | <span id="days" data-value="30">30 Hari</span> |
                                <b style="color: red" id="price" data-value="265000">Rp 265.000</b>
                                <div class="description">
                                    <b>Deskripsi :</b>
                                    <ul>
                                        <li>Kuota hanya berlaku untuk laundry kiloan</li>
                                        <li>Kuota hanya bisa digunakan di cabang QnC Laundry terdekat</li>
                                        <li>Kuota akan hangus jika masa berlaku berakhir</li>
                                        <li>Berlaku akumulasi kuota jika membeli kuota baru sebelum masa berlaku berakhir</li>
                                    </ul>
                                </div>
                            </p>
                        </a>
                        <a href="#" class="list-group-item" id="itemPackage">
                            <h4 class="list-group-item-heading">Hemat 50</h4>
                            <p class="list-group-item-text">
                                <b id="package" data-value="50">50 Kg</b> | <span id="days" data-value="30">30 Hari</span> |
                                <b style="color: red" id="price" data-value="350000">Rp 350.000</b>
                                <div class="description">
                                    <b>Deskripsi :</b>
                                    <ul>
                                        <li>Kuota hanya berlaku untuk laundry kiloan</li>
                                        <li>Kuota hanya bisa digunakan di cabang QnC Laundry terdekat</li>
                                        <li>Kuota akan hangus jika masa berlaku berakhir</li>
                                        <li>Berlaku akumulasi kuota jika membeli kuota baru sebelum masa berlaku berakhir</li>
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
    let package, days, price, order = {}, data = [];
    let customerId = '<?= $_GET['id'] ?>';    

    $(".list-group-item").on("click", function () {
        $(this).addClass("active");
        package = $(this).find("#package").data('value');
        days = $(this).find("#days").data('value');
        price = $(this).find("#price").data('value');      

        $("#totalPrice, #totalPay").text(rupiah(price));

        $(".list-group-item").not(this).each(function () {
            $(this).removeClass("active");
            id = data.map(e  => e.package).indexOf(package);
            data.splice(id, 1);
        });
        
        order.customer = customerId;
        order.package = package;
        order.days = days;
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
        dataOrder = data[0];

        alert("Belum Siap");
        // if (payMethod !== undefined) {
        //     apiData("Langganan/save_langganan/" + customerId, { dataOrder }, function (data) {  
        //         console.log(data);
        //     });
        // }
    });
});

</script>