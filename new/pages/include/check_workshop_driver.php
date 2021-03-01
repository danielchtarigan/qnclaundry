
<div class="panel panel-success" id="panel_driver">
    <div class="panel-heading">
        <h2 class="panel-title">Checkout Outlet By Delivery</h2>
    </div>
    <div class="panel-body">
        <div id="getForm">
            <div class="alert alert-warning alert-dismissible">
                <strong>Peringatan!</strong> <span></span>
            </div>
            <form action="javascript:" id="form_driver_check">
                <div class="form-group">
                    <input type="text" class="form-control" name="sales_order" id="sales_order" placeholder="Scan nota di sini ..." autocomplete="off">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="list_order" id="list_order" cols="20" rows="8" style="resize: none;" readonly></textarea>
                    <input class="form-control" type="text" id="count_check" value="0" readonly style="width: 60px; text-align: center">
                </div>

                <input type="button" class="btn btn-success" id="submit" value="Submit">
                <input type="button" class="btn btn-default" id="cancel" value="Batal">
            </form>        
        </div>

    </div>
</div>


<style>   
    #panel_driver {
        width: 40%;
        margin: 165px;
    }
</style>

<script>
    jQuery(function ($) {
        
        let form = $("#form_driver_check"),
            list = form.find("#list_order");     
            count = form.find("#count_check");
        
        let deliveryId = $(".check_driver").attr("id-delivery");
        let deliveryName = $(".check_driver").attr("name-delivery");
        let check = $(".check_driver").attr("check");
        let checkType = check == "kotor" ? "in" : "out";
        let textHeader = check == "kotor" ? "Checkin Workshop Cucian Oleh "+deliveryName : "Checkout Workshop Cucian Oleh "+deliveryName;
        let sendId = check == "kotor" ? deliveryId : outletId;
        let timezone = getTimeZone();

        $("#panel_driver .panel-title").text(textHeader);

        $("#panel_driver .alert").hide();

        getData("LaundryTracker/getToCheckWorkshop/"+sendId, { checkType: checkType }, function (response) {
            if (response.readyState == 0) {
                $("#panel_driver .panel-body>div#getForm").hide();
                $("#panel_driver .panel-body").append($('<div id="load"><span></span></div>'));
            } else {
                $(".check_driver").css({
                    "display": "flex",
                    "z-index": "99"
                });

                $("#panel_driver .panel-body>div#load").remove();
                $("#panel_driver .panel-body>div#getForm").show();

                listOrder = [];
                $("#sales_order").on("keypress", function (e) {
                    salesOrder = $(this).val();
                    salesOrder = salesOrder.replace(/\s/g, '');
                    let cek = false, error = {};

                    error.message = "Nota tidak ditemukan, coba lacak status posisi terakhir nota";
                    if (e.which === 13) {                        
                        $.each(response.data, function(index, value) {
                            if(value.sales_order == salesOrder) {
                                if (checkType == "in") {
                                    cek = true;   
                                    listOrder.push({
                                        'sales_id': value.sales_order_id,
                                        'sales_order': value.sales_order
                                    });                           
                                } else {                                    
                                    if (value.packing == 0) {
                                        cek = false;
                                        error.message = "Nota belum dipacking";                                        
                                    } else {
                                        cek = true;
                                        listOrder.push({
                                            'sales_id': value.sales_order_id,
                                            'sales_order': value.sales_order
                                        });
                                    }
                                }
                            } 
                        });

                        if (cek) {                            
                            $("#panel_driver .alert").hide();
                        } else {
                            $("#panel_driver .alert span:last-child").text(error.message);
                            $("#panel_driver .alert").show();
                        }

                        thisListOrder = listOrder.filter(item => item.sales_order == salesOrder);

                        if(thisListOrder.length > 1) {
                            index = listOrder.map(el => el.sales_order).indexOf(salesOrder);
                            listOrder.splice(index, 1);
                        }

                        nota = [];
                        $.each(listOrder, function (i, val) {
                            nota.push(val.sales_order);
                        });

                        list.val(nota.join(" "));
                        
                        countCheck = nota.length;
                        count.val(countCheck);
                        $("#sales_order").val("");
                        
                    }

                });

                $("#form_driver_check #submit").on('click', function (e) {
                    e.preventDefault();
                    data = {};
                    data.workshop_id = outletId;
                    data.delivery_id = deliveryId;
                    data.user_id = user_id;
                    data.timezone = timezone;
                    data.list = listOrder;
                    data.check_type = checkType;
                    data.count = listOrder.length;

                    if (count.val() > 0) {
                        submitForm(data);
                    } else {
                        $("#panel_driver .alert span:last-child").text("tidak ada nota yang dimasukkan");
                        $("#panel_driver .alert").show();
                    }
                });

                $(document).on("click", "#panel_driver #cancel", function () {
                    driverId = deliveryId;

                    signOutDriver(driverId, checkType);
                });
            }
        });

        function submitForm(data) {
            getData("CheckWorkshopDelivery/store", data, function (response) {
                if(response.readyState == 0) {
                    $("#panel_driver .panel-body").html($('<div id="load"><span></span></div>'));
                } else {
                    $("#panel_driver .panel-body").html($('<button class="btn btn-default btn-block" id="close"><i class="fa fa-times" aria-hidden="true"></i> Tutup & Selesai</button>'));

                    $(document).on("click", "#panel_driver #close", function () {
                        driverId = deliveryId;

                        signOutDriver(driverId, checkType);
                    });

                    $(document).on("click", "#send_whatsapp", function () {
                        let d = new Date();
                        let year = d.getFullYear();
                        let month = ("0" + (d.getMonth() + 1)).slice(-2);
                        let date = ("0" + d.getDate()).slice(-2);
                        let hour = d.getHours();
                        let minute = d.getMinutes();
                        let fullDate = `${date}/${month}/${year} ${hour}:${minute}`;

                        let message = `*Checkout Outlet*\\nOutlet: ${outlet}\\\nTangal: ${fullDate}\\\nDaftar nota yang tercheckout:\\\n`;

                        nota = [];
                        $.each(response.sales_order, function (i, val) {
                            nota.push(val.sales_order);
                        });

                        message += nota.join("\\\n");
                        message += `\\\nJumlah: ${response.count}\\\n\\\nPengirim: ${deliveryName}`;

                        let data = {};
                        data.message = message;
                        let phone = $("body").find("input#phone").val();
                        data.phone = phone;
                        sendNotification(data);
                    });
                }
            });
        }

        // Kirim notifikasi ke nomor yang dienter
        function sendNotification(data) {
            console.log(data);
            getData("SendNotification/whatsapp", data, function (response) {
                console.log(response);
            });
        }

        // Tutup dan Selesai
        function signOutDriver(driverId, checkType) {
            window.sessionStorage.removeItem("log_driver");
            getData("Driver/signOut/"+driverId, { }, function (response) {
                if (response.readyState == 0) {
                    $("#panel_driver .panel-body").html($('<div id="load"><span></span></div>'));
                } else {
                    if (checkType == "in") {
                        window.location.href = "?menu=checkin_workshop";
                    } else {
                        window.location.href = "?menu=checkout_workshop";
                    }
                }
            });
        }


    })
</script>