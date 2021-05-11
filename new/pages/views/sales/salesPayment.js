jQuery(function ($) {
    
    let dataCustomer = JSON.parse(localStorage.getItem("dataCustomer"));
    if (dataCustomer) {
        let invoiceNumber, payMethod, payValue, totalPay, finalPay = {}, dataPay = [], dataLangganan = [];
        let invoice = $(document).find("#orderCount").data('value');
        customerId = dataCustomer.id;
        customerPhone = dataCustomer.telp;
        langganan = dataCustomer.lgn;
        membership = dataCustomer.mbr;
        $("html body").find("#paymentLangganan").hide();

        let valueKiloan = 0;
        let kuotas = {};
        if (langganan.length > 0) {
            $("html body").find("#paymentLangganan").show();
    
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
            let totalKiloan = 0; totalDiscount = 0;
            if(orderKiloan.length > 0) {
                totalKiloan = orderKiloan.reduce( function (a, b) { 
                    return parseInt(a) + parseInt(b.total);
                }, 0);
    
                let orderDiscount = dataOrderItem.filter(item => item.category == "Discount");
                totalDiscount = orderDiscount.reduce( function (a, b) { 
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
    
        $(document).find("#invoiceValue").text(rupiah(invoice)).attr('data-value', invoice).css({
            'font-weight': 'bold',
            'color': 'red'
        });
    
        $(document).find("#customerId").text(customerId);
    
        if (langganan) {
            $("#paymentLangganan").show();
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

                    if (finalPay.data_kuota.length > 0) {
                        dataCustomer.lgn[0].kiloan = finalPay.data_kuota[0].kilo;
                        localStorage.dataCustomer = JSON.stringify(dataCustomer);
                    }

                    $(".data-pesanan .data-body").find("#load").remove();
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
    
            $(this).focus(function () {
                $(this).val(0);
            });
    
            $(this).blur(function () {
                $(this).val(rupiah(payValue));
            });
        });       
    
        $("#savePayOrder").on("click", function () {
            finalPay.timezone = getTimeZone();
            finalPay.invoice_number = invoiceNumber;
            finalPay.total_invoice = invoice;
            finalPay.total_pay = totalPay;
            finalPay.customer_id = customerId;
            finalPay.phone = customerPhone;
            finalPay.user = userId;
            finalPay.outlet = outlet;
            finalPay.type = "ritel";
            finalPay.item_package = "Retail";
            finalPay.data = dataPay;
            finalPay.data_order = dataOrder;
            finalPay.data_kuota = dataLangganan;
            finalPay.poin = 0;
    
            if (membership.length > 0) {
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
    }
        
});