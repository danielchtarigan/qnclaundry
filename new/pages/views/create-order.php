<div id="myform" class="create-order">   

    <div class="choose-item show">
        <div class="overlay">
            <h2 class="title">Pilihan Barang</h2>
            <div class="overlay-content">
                <form action="#" id="form_main_item">
                    <div class="form-group select-custom-a" id="select_category_main_item">
                        <label for="main_item_category">Kategori Barang</label>
                        <input type="text" class="form-control" id="main_item_category" name="category" placeholder="Ketik kategori barang" autocomplete="off">
                        <div class="select-option" id="select-option">
                        </div>
                    </div>
                    <div class="form-group select-custom-a" id="select_main_item">
                        <label for="main_item">Nama Barang</label>
                        <input type="text" class="form-control" id="main_item" name="item" placeholder="Ketik nama barang" autocomplete="off">
                        <div class="select-option" id="select-option">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="text" class="form-control" id="price" value="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="text" class="form-control" id="quantity" value="1" min="1" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label for="weight">Berat</label>
                                <input type="text" class="form-control" id="weight" value="1" min="1" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount">Jumlah</label>
                        <input type="text" class="form-control" id="amount" data-value="0" value="0" min="1000" readonly>
                    </div>
                </form>
            </div>
        </div>              
        <button type="button" class="btn btn-primary" id="saveMainItem"><i class="ace-icon fa fa-save"></i> Simpan</button>
    </div>

    <div class="extra-services">
        <div class="overlay">
            <h2 class="title">Pilihan Layanan</h2>
            <div class="overlay-content">
                <form action="#" id="form_service_item">
                    <div class="form-group select-custom-a" id="select_service_item_category">
                        <label for="service_item_category">Kategori Layanan</label>
                        <input type="text" class="form-control" id="service_item_category" name="category" placeholder="Ketik kategori layanan" autocomplete="off">
                        <div class="select-option" id="select-option">
                        </div>
                    </div>
                    <div class="form-group select-custom-a" id="select_service_item">
                        <label for="service_item">Nama Layanan</label>
                        <input type="text" class="form-control" id="service_item" name="item" placeholder="Ketik nama layanan" autocomplete="off">
                        <div class="select-option" id="select-option">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="text" class="form-control" id="price" name="price" value="0" data-value="0" autocomplete="off">
                    </div>
                </form>
            </div>
        </div>
        <div class="btn-group btn-group-justified" role="group" id="btnOptionService">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id="backShowOrder">Kembali</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-primary" id="saveServiceOrder">Simpan</button>
            </div>
        </div>
    </div>

    <div class="preview-order">
        <div class="overlay" style="height: 100%; padding-bottom: 25px;">
            <h2 class="title">Rincian Pesanan</h2>
            <div class="overlay-content" id="showOrder">
                <div class="detail-order">
                    <div class="detail-heading">
                        <table width="70%">
                            <tr>
                                <td>No.</td>
                                <td>: &nbsp;</td>
                                <td id="orderNumber" data-value=""></td>
                            </tr>
                            <tr>
                                <td>Nama Pelanggan</td>
                                <td>: &nbsp;</td>
                                <td id="customer">Bahrul Sukmah</td>
                            </tr>
                            <tr>
                                <td>Outlet</td>
                                <td>: &nbsp;</td>
                                <td id="outlet">Goa Ria</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>: &nbsp;</td>
                                <td id="nowDate">21/11/2020</td>
                            </tr>
                            <tr>
                                <td>Jam</td>
                                <td>: &nbsp;</td>
                                <td id="nowHour">12:40</td>
                            </tr>
                        </table>
                    </div>
                    <div class="detail-body">
                        <table width="80%" class="table-detail-item"></table>
                        <div class="clearfix"></div>
                    </div>
                    <div class="detail-footer">
                        <table width="60%" class="table-detail-item">
                            <tr>
                                <td>Sub Total</td>
                                <td>:</td>
                                <td align="right" id="subTotal" data-value="0">0</td>
                            </tr>
                            <tr>
                                <td>Diskon Promo</td>
                                <td>:</td>
                                <td align="right" id="discount" data-value="0">0</td>
                            </tr>
                        </table>
                        <div class="clearfix"></div>
                    </div>
                    <div class="btn btn-success btn-lg total">
                        <span>Total: </span><span id="totalOrder" data-value="0"></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="btn-group btn-group-justified" role="group" id="btnOrder">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id="addItem">Tambah Barang</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id="addDiscount">Diskon</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id="extraService">Extra Service</button>
            </div>
        </div>
        <div class="btn-group btn-group-justified" role="group" id="btnOrder">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-primary" id="saveOrder">Simpan & Cetak</button>
            </div>
        </div>
    </div>

    <div class="discount-order">
        <div>
            <h2 class="title">Diskon Pesanan</h2>
            <form action="#">
                <div class="form-group">
                    <label for="subTotal">Sub Total</label>
                    <input type="text" class="form-control" id="subTotal" value="0" data-value="0" readonly>
                </div>
                <div class="form-group">
                    <label for="voucher">Kode Voucher</label>
                    <input type="text" class="form-control" placeholder="Nomor kode voucher" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="discount">Diskon</label>
                    <input type="text" class="form-control" id="discount" readonly value="0" data-value="0" autocomplete="off" value="0">
                </div>
            </form>
        </div>
        <div class="btn-group btn-group-justified" role="group" id="btnOptionService">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id="backShowOrder">Kembali</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-primary" id="saveDiscount">Simpan</button>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
jQuery(function ($) {
    // Dapatkan informasi tentang pelanggan
    let customerId = '<?= $_GET['id'] ?>';
    let customer = $(document).find(".data-customer #customer").text();
    let customerMembership = $(document).find(".data-customer #membership").text();
    let customerSubsQuota = $(document).find(".data-customer #langganan").text();

    // Dekalarasikan data variabel pesanan barang
    let orderItem = [], orderAllItem = {};
    // let dataOrder = [], finalOrder = {}, orderNumber;

    // Form isian barang penjualan
    let formMainItem = $("#form_main_item"),
        mainItemCategory = formMainItem.find("#main_item_category"), 
        mainItem = formMainItem.find("#main_item"),
        mainItemPrice = formMainItem.find("#price"),
        mainItemQuantity = formMainItem.find("#quantity"),
        mainItemWeight = formMainItem.find("#weight"),
        mainItemTotalPrice = formMainItem.find("#amount"),
        mainItemFields = $( [] ).add( mainItemCategory ).add( mainItem ).add( mainItemPrice ).add( mainItemQuantity ).add( mainItemWeight ).add( mainItemTotalPrice );

    // Form isian extra service
    let formServiceItem = $("#form_service_item"),
        serviceItemCategory = formServiceItem.find("#service_item_category"),
        serviceItem = formServiceItem.find("#service_item"),
        serviceItemPrice = formServiceItem.find("#price");


    // Set Url item price
    let dataI = JSON.parse(localStorage.getItem("setItemPrice"));
    let urlItemPrice = (dataI.branch && dataI.outlet) ? "Items/get_price_outlet" : (dataI.branch && !dataI.outlet ? "Items/get_price_branch" : "Items/get_price_default"); 
    
    apiData(urlItemPrice, { branch: branch, outlet: outlet }, function (data) {
        if (data.readyState == 0) {
            formMainItem.hide();
            formMainItem.closest(".choose-item").find(".overlay-content").append($('<div id="load"><span></span></div>'));
        }
        else {
            formMainItem.show();
            formMainItem.closest(".choose-item").find(".overlay-content>#load").remove();

            option_items("select_category_main_item", null, null, data);
            option_items("select_service_item_category", null, null, data);

            $(document).on("click", "#select_category_main_item>#main_item_category", function () {
                let value = $(this).data('value');
                if (value != undefined) {
                    $("#select_category_main_item>#select-option>input, #select_category_main_item>#select-option>label").remove();
                    $(this).attr('readonly', true);
                    value = value.toLowerCase();
                    option_items("select_category_main_item", null, value, data);
                }
            });

            $(document).on("keyup keypress", "#select_category_main_item>#main_item_category", function () {
                $("#select_category_main_item>#select-option>input, #select_category_main_item>#select-option>label").remove();
                value = $(this).val();
                option_items("select_category_main_item", null, value, data);
            });

            $(document).on("keyup keypress", "#select_main_item>#main_item", function () {
                value = $(this).val();
                category = mainItemCategory.val();
                option_items("select_main_item", category, value, data);
            });

            $(document).on("click", "#select_category_main_item input[name=categories]", function () {
                mainItem.val("");
                mainItemPrice.val(0);
                mainItemTotalPrice.val(0);
                category = mainItemCategory.val();

                // Jika kategory barang adalah kiloan maka hanya kolom berat yang bisa diisi, sebaliknya
                if (category == "Kiloan") {
                    mainItemQuantity.attr('readonly', true).val(1);
                    mainItemWeight.attr('readonly', false);
                } else {
                    mainItemQuantity.attr('readonly', false);
                    mainItemWeight.attr('readonly', true).val(1);
                }

                // Ikuti berat yang sudah dibuat pada item pertama, jangan diaktifkan kolomnya
                if (orderItem.length > 0) {
                    if (category == "Kiloan") {
                        mainItemWeight.attr('readonly', true);
                    }
                }

                $("#select_category_main_item").removeClass("has-error");
                option_items("select_main_item", category, null, data);
            });

            $(document).on("click", "#select_main_item input[type=radio][name=items]", function () {
                mainItemPrice.val(0);
                let item = mainItem.val();
                $("#select_main_item").removeClass("has-error");      
                option_items("select_main_item", item, null, data);
            });

            // Untuk form extra service
            $(document).on("keyup keypress", "#select_service_item_category>#service_item_category", function () {
                $("#select_service_item_category>#select-option>input, #select_service_item_category>#select-option>label").remove();
                value = $(this).val();
                option_items("select_service_item_category", null, value, data);
            });

            $(document).on("click", "#select_service_item_category input[name=categories]", function () {
                serviceItem.val("");
                serviceItemPrice.val(0);
                $("#select_service_item>#select-option>input, #select_service_item>#select-option>label").remove();
                category = serviceItemCategory.val();
                $("#select_service_item_category").removeClass("has-error");
                option_items("select_service_item", category, null, data);
            });

            $(document).on("keyup keypress", "#select_service_item>#service_item", function () {
                $("#select_service_item>#select-option>input, #select_service_item>#select-option>label").remove();
                value = $(this).val();
                category = serviceItemCategory.val();
                option_items("select_service_item", category, value, data);
            });

            $(document).on("click", "#select_service_item input[type=radio][name=items]", function () {
                $("#select_service_item>#select-option>input, #select_service_item>#select-option>label").remove();
                serviceItemPrice.val(0);
                let item = serviceItem.val();
                $("#select_service_item").removeClass("has-error");     
                option_items("select_service_item", item, null, data);
            });
        }
    });

    // Dekalarasikan variable untuk dapatkan nilai total harga item
    let mainItemTotalData = {};
    mainItemTotalData.price = mainItemPrice.val();
    mainItemTotalData.qty = mainItemQuantity.val();
    mainItemTotalData.weight = mainItemWeight.val();
    
    // Dekalarasikan variable untuk dapatkan nilai total harga extra service
    let serviceItemTotalData = {};
    serviceItemTotalData.price = mainItemPrice.val();
    serviceItemTotalData.qty = mainItemQuantity.val();
    serviceItemTotalData.weight = mainItemWeight.val();

    function option_items(id, parentId, value, data) {
        let getDataItems = data['data'].filter(item => item.type != "Extra Service");
        let getDataService = data['data'].filter(item => item.type == "Extra Service");

        if (id == "select_category_main_item") {
            let map = getDataItems.reduce(function (result, item) {
                result[item.category] = result[item.category] || [];
                result[item.category].push({'name': item.item, 'price': item.price});
                return result;
            }, {});
            
            let categories = Object.keys(map);   
            
            if (value != null) {
                categories = categories.filter(item => item.toLowerCase().indexOf(value) > -1);
            }
    
            $.each(categories, function (i, val) {
                let content = $('<input type="radio" id="" name="categories"><label for=""></label>');
                $(content[0]).attr("value", val).attr("id", "cat"+(i+1));
                $(content[1]).attr("for", "cat"+(i+1)).text(val);

                $(document).find("#" + id + ">#select-option").append(content);
            });
        }

        if (id == "select_main_item") {
            $("#select_main_item>#select-option>input, #select_main_item>#select-option>label").remove();
            let items = $.grep(getDataItems, val => val.category === parentId);

            if (value != null) {
                items = items.filter(item => item.item.toLowerCase().indexOf(value) > -1);
            }
            
            $.each(items, function(i, val) {
                let content = $('<input type="radio" id="" name="items"><label for=""></label>');
                $(content[0]).attr("value", val.item).attr("id", "item"+(i+1));
                $(content[1]).attr("for", "item"+(i+1)).text(val.item);
                $(document).find("#" + id + ">#select-option").append(content);
            });

            let prices = $.grep(getDataItems, val => val.item === parentId)
            if (prices.length > 0) {
                mainItemPrice.val(prices[0].price);   

                mainItemTotalData.price = mainItemPrice.val();
                mainItemTotalData.qty = mainItemQuantity.val();
                mainItemTotalData.weight = mainItemWeight.val();
                mainItemTotalPrice.val(rupiah(calculation_input(mainItemTotalData)));
                mainItemTotalPrice.attr('data-value', calculation_input(mainItemTotalData));      
            }
        }

        // Untuk form select extra service
        if (id == "select_service_item_category") {
            let map = getDataService.reduce(function (result, item) {
                result[item.category] = result[item.category] || [];
                result[item.category].push({'name': item.item, 'price': item.price});
                return result;
            }, {});
            
            let categories = Object.keys(map);

            if (value != null) {
                categories = categories.filter(item => item.toLowerCase().indexOf(value) > -1);
            }

            $.each(categories, function (i, val) {
                let content = $('<input type="radio" id="" name="categories"><label for=""></label>');
                $(content[0]).attr("value", val).attr("id", "catService"+(i+1));
                $(content[1]).attr("for", "catService"+(i+1)).text(val);

                $(document).find("#" + id + ">#select-option").append(content);
            });
        }

        if (id == "select_service_item") {
            let items = $.grep(getDataService, val => val.category === parentId);

            if (value != null) {
                items = items.filter(item => item.item.toLowerCase().indexOf(value) > -1);
            }
            
            $.each(items, function(i, val) {
                let content = $('<input type="radio" id="" name="items"><label for=""></label>');
                $(content[0]).attr("value", val.item).attr("id", "itemService"+(i+1));
                $(content[1]).attr("for", "itemService"+(i+1)).text(val.item);
                $(document).find("#" + id + ">#select-option").append(content);
            });

            let prices = $.grep(getDataService, val => val.item === parentId)
            if (prices.length > 0) {
                serviceItemPrice.val(prices[0].price);
            }
        }
    }

    $(document).on("keyup", "#price, #quantity, #weight", function (event) {  
        mainItemTotalData.price = mainItemPrice.val();
        mainItemTotalData.qty = mainItemQuantity.val();
        mainItemTotalData.weight = mainItemWeight.val();
        mainItemTotalPrice.val(rupiah(calculation_input(mainItemTotalData)));
        mainItemTotalPrice.attr('data-value', calculation_input(mainItemTotalData));
    });

    // Kolom ini hanya diizinkan input angka dan titik
    $(document).on("keyup keypress blur", "#price, #quantity, #weight, #priceService", function (event) {                
        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    function selected(el) {
        $("body").on("click", ".select-option>input[type=radio]", function () {
            let selected = $("#"+el).parent().find(".select-option>input[type=radio]:checked").val();
            $("#"+el).val(selected);
            $(this).closest(".select-custom-a").find(".select-option").removeClass("active");
        })
    }

    $(".select-custom-a").each(function () {
        let id = $(this).find("input[type=text]").attr("id");
        $("#"+id).click(function () {
            $(this).closest(".select-custom-a").find(".select-option").addClass("active");
            $(this).closest(".select-custom-a").mouseleave(function () { 
                $(this).closest(".select-custom-a").find(".select-option").removeClass("active");
            });
            selected(id);
        });
    }); 
    
    function form_validation(field, value) {
        //
    }

    function validate(value, text) {
        if(value.val() == "" || value.val() == 0) {
            value.closest(".form-group").addClass("has-error");
            return false;
        }        
        return true;
    }

    function calculation_input(data) {
        price = (data.price == "") ? 0 : parseFloat(data.price.toString().replace(/\,/g, '.'));
        qty = (data.qty == "") ? 0 : parseFloat(data.qty.toString().replace(/\,/g, '.'));
        weight = (data.weight == "") ? 0 : parseFloat(data.weight.toString().replace(/\,/g, '.'));
        subtotal = price*qty*weight;
        return subtotal;
    }

    function save_order(data) {
        //
    }

    function detailOrder(orderItem, type) {
        let dataItem, dataService, totalItem, totalService;

        dataItem = orderItem.filter(item => item.type == "mainItem");
        totalItem = dataItem.reduce( function (a, b) { 
            return parseInt(a) + parseInt(b.amount);
        }, 0);

        dataService = orderItem.filter(item => item.type == "serviceItem");
        totalService = dataService.reduce( function (a, b) { 
            return parseInt(a) + parseInt(b.price);
        }, 0);

        let discMember = customerMembership == "Membership" ? 0.2 : 0;
        let member = totalItem * discMember;

        if (member > 0) {
            $(".detail-footer>.table-detail-item #discountMembership").closest("tr").remove();
            let contentMembership = '<tr><td id="discountMembership">Diskon Member</td><td>:</td><td align="right">('+ rupiah(member) +')</td></tr>';
            $(".detail-footer>.table-detail-item #subTotal").closest("tr").after(contentMembership);

            let dataId = "Diskon Membership";
            dataDiscount = orderItem.filter(item => item.item == dataId);

            if (dataDiscount.length > 0) {
                id = orderItem.map(e  => e.item).indexOf(dataId);
                orderItem.splice(id, 1);
            }

            let discounts = {};
            discounts.id = "discountmember" + orderItem.length;
            discounts.category = "Discount";
            discounts.item = "Diskon Membership";
            discounts.price = member * -1;
            discounts.qty = 1;
            discounts.amount = member * -1;
            discounts.weight = 0;
            discounts.type = "discount";
            orderItem.push(discounts);
        }

        if (type == "mainItem") {
            $(".detail-body>.table-detail-item").find("tr").remove();            

            $.each(dataItem, function (i, val) {
                let weight = val.category == "Kiloan" ? val.weight + ' Kg' : '';
                let tableBody = '<tr><td><a href="#" id="removeItem" data-id="'+ val.id +'"><i class="ace-icon fa fa-times"></i></a></td><td>'+ val.qty +'</td><td>'+ val.item + ' ' + weight +'</td><td align="right">'+ rupiah(val.amount) +'</td></tr>';
                $(".detail-body>.table-detail-item").append(tableBody);
            });

            $(".detail-footer>.table-detail-item").find("#subTotal").text(rupiah(totalItem));
            $(".discount-order").find("#subTotal").val(rupiah(totalItem));
            $(".discount-order").find("#subTotal").data('value', totalItem);

        }

        if (type == "serviceItem") {
            $(".detail-footer>.table-detail-item").find("tr.service").remove();

            $.each(dataService, function (i, val) {
                let tableBody = '<tr class="service"><td><a href="#" id="removeService" data-id="'+ val.id +'"><i class="ace-icon fa fa-times"></i></a> '+ val.item +'<td>:</td><td align="right">'+ rupiah(val.price) +'</td></tr>';
                $(".detail-footer>.table-detail-item").append(tableBody);
            });
        }

        $("#totalOrder").data('value', setTotal(orderItem));
        $("#totalOrder").text(rupiah(setTotal(orderItem)));

        setDataOrder(setTotal(orderItem), orderItem);
    }

    function setTotal(data) {
        let total;
        total = data.reduce( function (a, b) { 
            return parseInt(a) + parseInt(b.amount);
        }, 0);

        return total;
    }

    function setDataOrder(total, data) {
        discounts = data.filter(item => item.type == "discount");
        totalDiscount = discounts.reduce( function (a, b) { 
            return parseInt(a) + parseInt(b.amount);
        }, 0);

        orderAllItem = {};
        orderAllItem.total = total;
        orderAllItem.discount = totalDiscount * -1;
        orderAllItem.data = data;
    }
    
    let dataItemReady = false;
    $(document).on("click", "button#saveMainItem", function () {
        var valid = true;

        valid = valid && validate(mainItemCategory, "Kategori barang belum dipilih");
        valid = valid && validate(mainItem, "Barang belum dipilih");
        valid = valid && validate(mainItemPrice, "Kolom harga masih kosong");
        valid = valid && validate(mainItemQuantity, "Kolom quantity masih kosong");
        valid = valid && validate(mainItemWeight, "Kolom berat masih kosong");

        if (valid) {
            $(this).closest(".extra-services, .choose-item, .discount-order").removeClass("show");
            $(".preview-order").addClass("show");            

            let items = {};
            items.id = "mainItem" + orderItem.length;
            items.category = mainItemCategory.val();
            items.item = mainItem.val();
            items.price = mainItemPrice.val();
            items.qty = mainItemQuantity.val();
            items.weight = mainItemCategory.val() == "Kiloan" ? mainItemWeight.val() : 0;
            items.amount = mainItemPrice.val() * mainItemQuantity.val() * mainItemWeight.val();
            items.type = "mainItem";
            orderItem.push(items);

            detailOrder(orderItem, "mainItem");

            let date = new Date(),
                nowDate = (date.getDate()+"/"+(date.getMonth() + 1)+"/"+date.getFullYear()).toString(),
                nowHour = (date.getHours()+":"+("0" + date.getMinutes()).slice(-2)).toString();
            
            let dHeading = $(".detail-heading"),
                dBody = $(".detail-body");     

            orderNumber = dHeading.find("#orderNumber").data('value');

            if (orderNumber == "") {
                getData("SalesOrder/set_order_number/" + outlet, { }, function (data) {
                    if (data.readyState == 0) {
                        $(".detail-order").hide();
                        $(".detail-order").closest(".preview-order").find(".overlay-content").append($('<div id="load"><span></span></div>'));
                    }
                    else  {
                        $(".detail-order").closest(".preview-order").find("div>#load").remove();
                        $(".detail-order").show();

                        let getData = data;
                        orderNumber = getData.order_number;
                        dHeading.find("#orderNumber").text(getData.order_number).data('value', getData.order_number);
                        dHeading.find("#customer").text(customer);
                        dHeading.find("#outlet").text(outlet);
                        dHeading.find("#nowDate").text(nowDate);
                        dHeading.find("#nowHour").text(nowHour);

                        dataItemReady = true;
                    }
                });
            } 

            mainItemCategory.val("");
            mainItem.val("");
            mainItemPrice.val(0);
            mainItemQuantity.val(1);
            mainItemWeight.val(1);
            mainItemTotalPrice.val(0);
            mainItemTotalPrice.data('value', 0);
            serviceItemCategory.val("");
            serviceItem.val("");
            serviceItemPrice.val(0);
        }

        return valid;        
    });

    // Add Extra Service
    $(document).on("click", "#saveServiceOrder", function () {
        var valid = true;

        valid = valid && validate(serviceItemCategory, "Kategori layanan belum dipilih");
        valid = valid && validate(serviceItem, "Nama layanan dipilih");
        valid = valid && validate(serviceItemPrice, "Kolom harga masih kosong");

        if (valid) {
            $(this).closest(".extra-services, .choose-item, .discount-order").removeClass("show");
            $(".preview-order").addClass("show");

            let services = {};
            services.id = "serviceItem" + orderItem.length;
            services.category = serviceItemCategory.val();
            services.item = serviceItem.val();
            services.price = serviceItemPrice.val();
            services.qty = 1;
            services.amount = serviceItemPrice.val()*1;
            services.weight = 0;
            services.type = "serviceItem";
            orderItem.push(services);

            detailOrder(orderItem, "serviceItem");

            mainItemCategory.val("");
            mainItem.val("");
            mainItemPrice.val(0);
            mainItemQuantity.val(1);
            mainItemWeight.val(1);
            mainItemTotalPrice.val(0);
            mainItemTotalPrice.data('value', 0);
            serviceItemCategory.val("");
            serviceItem.val("");
            serviceItemPrice.val(0);
        }

        return valid;
    });

    // // Add Diskon Order
    // $(document).on("click", ".discount-order #saveDiscount", function () {
    //     alert("diskon");
    // });

    $(document).on("click", "#removeItem", function(e) {
        let dataId = $(this).data("id");
        id = orderItem.map(e  => e.id).indexOf(dataId);
        orderItem.splice(id, 1);
        detailOrder(orderItem, "mainItem");
        e.preventDefault();
    });

    $(document).on("click", "#removeService", function(e) {
        let dataId = $(this).data("id");
        id = orderItem.map(e  => e.id).indexOf(dataId);
        orderItem.splice(id, 1);
        detailOrder(orderItem, "serviceItem");
        e.preventDefault();
    });

    $(document).on("click", "#addItem", function () {   
        if (dataItemReady) {
            $(this).closest(".extra-services, .preview-order, .discount-order").removeClass("show");
            $(".choose-item").addClass("show");
            if(orderItem.length > 0) {
                if (orderItem[0].category == "Kiloan") {
                    mainItemWeight.val(orderItem[0].weight);
                    mainItemWeight.attr('readonly', true);
                }
                $(document).find("#select_category_main_item>input#main_item_category").attr("data-value", orderItem[0].category);
            }
        }
    });

    // $(document).on("click", "#addDiscount", function () {
    //     $(this).closest(".extra-services, .choose-item, .preview-order").removeClass("show");
    //     $(".discount-order").addClass("show");
    // });  

    $(document).on("click", "#extraService", function () {
        if (dataItemReady) {
            $(this).closest(".preview-order, .choose-item, .discount-order").removeClass("show");
            $(".extra-services").addClass("show");
        }
    });  

    $(document).on("click", "#backShowOrder", function () {
        $(this).closest(".extra-services, .choose-item, .discount-order").removeClass("show");
        $(".preview-order").addClass("show");
    });

    $(document).on("click", "#saveOrder", function () {  
        if (dataItemReady) {
            orderAllItem.order_number = orderNumber;
            orderAllItem.outlet = outlet;
            orderAllItem.branch = branch;
            orderAllItem.user = userId;
            orderAllItem.type = "p";
            orderAllItem.weight = 0;

            if(orderItem[0].category == "Kiloan") {
                orderAllItem.type = "k";
                orderAllItem.weight = orderItem[0].weight;
            }

            getData("SalesOrder/save_order/" + customerId, { jsonData: JSON.stringify(orderAllItem), outlet: outlet }, function (data) {
                dialog.dialog("close");
                if (data.readyState == 0) {
					$(".data-pesanan .data-body").html('<div id="load" align="center"><span></span></div>');

					localStorage.removeItem("dataOrder");
					$(document).find("#orderCount").data('value', 0);
					$(document).find("#orderCount").text('0 | '+ rupiah(0));
				}
				else {
					localStorage.setItem("dataOrder", JSON.stringify(data));
					getDataOrder();
				}
            });
        }
    });    
});
</script>