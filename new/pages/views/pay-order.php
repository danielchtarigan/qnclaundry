<div id="myform">
    <div class="laundry-package show">
        <div class="table-overlays">
            <ul class="list-group invoice-customer" style="width: 100%">
                <li class="list-group-item">
                    <h4 class="list-group-item-heading">Informasi Pembayaran</h4>
                    <div class="list-group-item-body">
                        <div class="info-heading">
                            <table>
                                <tr>
                                    <td>No. Pembayaran</td>
                                    <td>:</td>
                                    <td id="salesInvoice">SI0732201206001</td>
                                </tr>
                                <tr>
                                    <td>ID Pelanggan</td>
                                    <td>:</td>
                                    <td id="customerId"></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Tagihan</td>
                                    <td>:</td>
                                    <td id="invoiceValue"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </li>
                <li class="list-group-item payment-method">
                    <h4 class="list-group-item-heading">Metode Pembayaran</h4>
                    <div class="list-group-item-body">
                        <div class="list-choose-method">
                            <h4 class="title-method">Dengan Cash</h4>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="cash"><label for="cash">Cash</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_cash" disabled="true" value="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="list-choose-method">
                            <h4 class="title-method">Dengan EDC</h4>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="edcbca"><label for="edcbca"> EDC BCA</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_edcbca" disabled="true" value="0" autocomplete="off">
                            </div>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="edcbri"><label for="edcbri"> EDC BRI</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_edcbri" disabled="true" value="0" autocomplete="off">
                            </div>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="edcbni"><label for="edcbni"> EDC BNI</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_edcbni" disabled="true" value="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="list-choose-method" id="paymentLangganan">
                            <h4 class="title-method">Dengan Kuota</h4>
                            <div class="select-input-item">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="kuota_kiloan"><label for="kuota_kiloan"> Kiloan</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_kuota_kiloan" disabled="true" value="0" readonly autocomplete="off">
                            </div>
                            <div class="select-input-item" style="display: none;">
                                <div class="select-item-h">
                                    <input type="checkbox" name="pay_method" id="kuota_potongan"><label for="kuota_potongan"> Potongan</label>
                                </div>
                                <input type="text" class="form-control" name="pay_value" id="value_kuota_potongan" disabled="true" autocomplete="off">
                            </div>
                            <small style="margin-top: 15px; display: block">Cat: Dengan memilih kuota, maka akan otomatis mengurangi kuota sekarang</small>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="f-horizontal" style="flex-direction: column">
            <div style="display: flex; justify-content: space-between; margin-top: 10px">
                <b id="labelPrice">Total Bayar</b><span id="totalPay">Rp 0</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px">
                <span id="labelPrice">Selisih Bayar</span><span id="differentPayment">Rp 0</span>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="savePayOrder"> <i class="ace-icon fa fa-save"></i> Bayar</button>
    </div>
</div>

<style lang="css">
    .list-group-item-body {
        margin-top: 14px;
    }

    .list-group-item-body>.info-heading>table {
        width: 100%;
    }

    .list-group-item-body>.info-heading>table td {
        line-height: 2;
    }

    .select-input-item,
    .select-item-h {
        display: flex;
        flex-direction: row;
    }

    .select-item-h {
        align-items: center;
        width: 50%;
    }

    .select-item-h label,
    .select-item-h input[type=checkbox] {
        margin: 0;
    }

    .select-item-h label {
        margin-left: 10px;
        width: 100%;
        cursor: pointer;
    }

    .title-method {
        font-size: 14px;
        font-weight: bold;
        color: seagreen;
    }

    .list-group-item-body .list-choose-method {
        /* background-color: salmon; */
    }

    .list-group-item-body .list-choose-method>.title-method {
        border-bottom: 1px solid #ddd;
        padding: 6px 0;
    }
    
</style>

<script>
    jQuery(function ($) {
        let invoiceNumber, payMethod, payValue, totalPay, finalPay = {}, dataPay = [], dataLangganan = [];
        let invoice = $(document).find("#orderCount").data('value');
        let customerId = '<?= $_GET['id'] ?>';        
        let langganan = $(document).find(".data-customer #langganan").text() == "Berlangganan" ? true : false;
        let membership = $(document).find(".data-customer #membership").text() == "Membership" ? true : false;
        $("#paymentLangganan").hide();

        let valueKiloan = 0;
        let kuotas = {};
        if (langganan) {
            $("#paymentLangganan").show();

            // Get Kuota Langganan
            let qkilos = $(document).find("#kuotaKiloan").data('value');            
            let qpieces = $(document).find("#kuotaPotongan").data('value');     

            getDataOrder = JSON.parse(localStorage.getItem("dataOrder")).data;
            dataOrderItem = [];
            $.each(getDataOrder, function (i, val) {
                $.each(val.items, function (i, val) {  
                    dataOrderItem.push(val);
                });
            });

            let orderKiloan = dataOrderItem.filter(item => item.category == "Kiloan");
            console.log(orderKiloan.length);

            if(orderKiloan.length > 0) {
                let totalKiloan = orderKiloan.reduce( function (a, b) { 
                    return parseInt(a) + parseInt(b.total);
                }, 0);
    
                let orderDiscount = dataOrderItem.filter(item => item.category == "Discount");
                let totalDiscount = orderDiscount.reduce( function (a, b) { 
                    return parseInt(a) + parseInt(b.total);
                }, 0);
    
                valueKiloan = totalDiscount + totalKiloan;
    
                let weightCounted = [];
                $.each(orderKiloan, function (i, val) {
                    let weight = val.item == "Cuci Kering" ? parseFloat(val.isweight * 0.56).toFixed(2) : (val.item == "Setrika" ? parseFloat(val.isweight * 0.44).toFixed(2) : parseFloat(val.isweight * 0.22).toFixed(2));
                    weightCounted.push(weight);
                });
    
                let kilosInvoice = weightCounted.reduce(function (a, b) {
                    return parseFloat(a) + parseFloat (b);
                });
    
                qKilosNow = parseFloat(qkilos - kilosInvoice).toFixed(2); 
                kuotas.kilo = qKilosNow;
            }
        }

        // Get OrderNumber
        let o = $(document).find(".order-number");
        let dataOrder = [];
        o.each(function (i, obj) {
            orderNumber = $(obj).data('id');
            let order = {};
            order.number = orderNumber;
            dataOrder.push(order);
        }); 

        getInvoiceNumber();

        function getInvoiceNumber() {
            getData("SalesInvoice/get_invoice_number/" + outlet, { }, function (data) {
                if (data.readyState == 0) {
                    $(".list-group-item-body .info-heading table").hide();
                    $(".payment-method").hide();
                    $(".invoice-customer .info-heading").html('<div id="load" align="center"><span></span></div>');
                }
                else {
                    $(".invoice-customer .list-group-item-body").find("#load").remove();
                    $(".payment-method").show();
                    
                    invoiceNumber = data['invoice_number'];

                    let content = $('<table><tr><td>No. Tagihan</td><td>:</td><td id="salesInvoice">'+ data['invoice_number'] +'</td></tr><tr><td>ID Pelanggan</td><td>:</td><td id="customerId"></td></tr><tr><td>Jumlah Tagihan</td><td>:</td><td id="invoiceValue"></td></tr></table>');
                    $(".invoice-customer .info-heading").append(content);

                    $(document).find("#invoiceValue").text(rupiah(invoice)).attr('data-value', invoice).css({
                        'font-weight': 'bold',
                        'color': 'red'
                    });
                    $(document).find("#customerId").text(customerId);

                    if (langganan) {
                        $("#paymentLangganan").show();
                    }
                }
            });
        }        

        function savePayment(finalPay) {
            getData("SalesInvoice/save_payment/" + customerId, { jsonData: JSON.stringify(finalPay) }, function (data) {
                dialog.dialog("close");                   
                if (data.readyState == 0) {
					$(".data-pesanan .data-body").html('<div id="load" align="center"><span></span></div>');

					localStorage.removeItem("dataOrder");
					$(document).find("#orderCount").data('value', 0);
					$(document).find("#orderCount").text('0 | '+ rupiah(0));
				}
				else {
                    localStorage.setItem("dataOrder", JSON.stringify({data: []}));
                    // getDataOrder();
                    // $(document).find("#reloadListPayments").trigger("click");
                    window.location.href = "";
				}
            });
        }

        function calculatePayment(data) {
            let total;
            total = data.reduce( function (a, b) { 
                return parseInt(a) + parseInt(b.value);
            }, 0);
            return total;
        }

        $(document).on("click", ".select-item-h input[name=pay_method]", function () {
            let id = $(this).attr('id');
            let disabled = $("#value_"+id).attr("disabled") === "disabled" ? true : false;
            $("#value_"+id).prop("disabled", !disabled);
            
            if ($("#value_"+id).attr("disabled") === "disabled") {
                $("#value_"+id).val(0);
                $("#value_"+id).data('value', 0);
                
                payValue = $("#value_"+id).val();      

                idMethod = id == "kuota_kiloan" ? "Kuota" : id;          

                dataMethod = dataPay.filter(e => e.method == idMethod);
                if (dataMethod.length > 0) {
                    idx = dataPay.map(e  => e.method).indexOf(idMethod);
                    dataPay.splice(idx, 1);
                }

                totalPay = calculatePayment(dataPay);
            
                $("#totalPay").text(rupiah(totalPay));

                $("#differentPayment").text(rupiah(invoice - totalPay));                
            }
            else {
                if (id == "kuota_kiloan") {
                    
                    $("#value_"+id).val(rupiah(valueKiloan));
                    $("#value_"+id).data('value', valueKiloan);
                    let payValueId = $(this).closest(".select-input-item").find("input[name=pay_value]").attr('id');
                    let payValue = $("#value_"+id).data('value');
                    let payMethod = "Kuota";

                    let pays = {};
                    pays.value_id = payValueId;
                    pays.method = payMethod;
                    pays.value = payValue;
                    
                    dataPay.push(pays);

                    console.log(dataPay);

                    totalPay = calculatePayment(dataPay);

                    dataLangganan.push(kuotas);
            
                    $("#totalPay").text(rupiah(totalPay));

                    $("#differentPayment").text(rupiah(invoice - totalPay));
                }
            }
        });

        $(document).on("keyup keypress blur", "input[name=pay_value]", function (event) {                
            $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $(document).on("click keyup", "input[name=pay_value]", function (event) {  
            let payValueId = $(this).attr('id');
            let payValue = $(this).val();
            let payMethod = $(this).closest(".select-input-item").find("input[name=pay_method]").attr('id');
                       
            let pays = {};
            pays.value_id = payValueId;
            pays.method = payMethod;
            pays.value = payValue;
            
            dataPay.push(pays);

            method = dataPay.filter(item => item.method == payMethod);
            if(method.length > 1) {
                id = dataPay.map(e  => e.method).indexOf(payMethod);
                dataPay.splice(id, 1);
            }

            totalPay = calculatePayment(dataPay);
            
            $("#totalPay").text(rupiah(totalPay));

            $("#differentPayment").text(rupiah(invoice - totalPay));

            console.log(dataPay);
            
            $(this).focus(function () {
                $(this).val(0);
            });

            $(this).blur(function () {
                $(this).val(rupiah(payValue));
            });
        });       
        
        $("#savePayOrder").on("click", function () {
            finalPay.invoice_number = invoiceNumber;
            finalPay.total_invoice = invoice;
            finalPay.total_pay = totalPay;
            finalPay.customer_id = customerId;
            finalPay.user = userId;
            finalPay.outlet = outlet;
            finalPay.type = "ritel";
            finalPay.item_package = "Retail";
            finalPay.data = dataPay;
            finalPay.data_order = dataOrder;
            finalPay.data_kuota = dataLangganan;
            finalPay.poin = 0; 

            if (membership) {
                finalPay.poin = parseInt(totalPay/25000);
            }

            payMethod = dataPay.map(e => e.method).join(", ");

            finalPay.method = payMethod;

            if (invoice === totalPay) {
                savePayment(finalPay);
                dialog.dialog("close");
            } else {
                alert("Jumlah pembayaran tidak sesuai");
            }
        });
    });
</script>