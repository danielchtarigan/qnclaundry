<div id="myform">
    <!-- Pengambilan -->
    <div class="laundry-already show" title="Laundry Selesai" id="laundryTaken">
        <div>
            <h2 class="title">Daftar Cucian Selesai</h2>
            <div class="table-overlays" id="listLaundryHasReady"></div>
        </div>
        <button type="button" class="btn btn-primary"> <i class="ace-icon fa fa-save"></i> Ambil</button>
    </div>
</div>

<script>
jQuery(function ($) {
    let outletId, branchId, laundries = [];

    let customer = JSON.parse(localStorage.getItem("dataCustomer"));
    customerId = customer.id;

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
                let content = '<div class="item-table-x"><input type="checkbox" id="item'+ index +'" data-value="'+ value.id +'" value="'+ value.order_number +'"><label for="item'+ index +'"><table width="100%"><tr><td>No Pesanan</td><td>:</td><td>'+ value.order_number +'</td></tr><tr><td>Jenis</td><td>:</td><td>'+ value.order_type +'</td></tr><tr><td>Jumlah Item</td><td>:</td><td>'+ value.quantity +'</td></tr><tr><td>Tanggal Masuk</td><td>:</td><td>'+ value.order_date +'</td></tr><tr><td>Outlet</td><td>:</td><td>'+ value.outlet +'</td></tr></table></label></div>';
                $("#listLaundryHasReady").append(content);
            });

            $(document).on("click", "#listLaundryHasReady input[type=checkbox]", function () {
                let el = $(this).is(":checked");
                let order = {};
                orderId = $(this).data("value");
                if (el) {
                    $(this).closest("#listLaundryHasReady>div").addClass("active");
                    order.id = orderId;
                    newData = $.grep(getData, item => item.id == orderId);
                    laundries.push(newData[0]);

                }
                else {
                    $(this).closest("#listLaundryHasReady>div").removeClass("active");
                    id = laundries.map(e => e.id).indexOf(orderId);
                    laundries.splice(id, 1);
                }
            });
        }
    });

    $("#laundryTaken").on("click", "button", function () {
        let data = {};
        data.data = laundries;
        data.user = userId;
        data.timezone = getTimeZone();

        apiData("SalesOrder/handover_customer", data, function (res) {
            if (res.readyState === 0) {
                dialog.dialog("close");
				$("body").append('<div class="areaPrintFaktur" id="areaPrintFaktur"></div>');
				$(".areaPrintFaktur").addClass('active').append('<div id="load" align="center"><span style="margin-top: -100px"></span></div>');
            } else {
                $(".areaPrintFaktur").find("#load").remove();

                proofReturn(customer, laundries);
            }
        })
    });

    function proofReturn(customer, data) 
    {
        let date = new Date(),
            nowDate = (date.getDate()+"/"+("0" + (date.getMonth() + 1)).slice(-2)+"/"+date.getFullYear()).toString(),
            nowHour = (date.getHours()+":"+("0" + date.getMinutes()).slice(-2)).toString();

        divStruk = '<div class="struk"></div>';
        divHeader = `<div class="struk-header" align="center"><h3>QNCLAUNDRY ${branch.toUpperCase()} <br> OUTLET ${outlet.toUpperCase()} <br> Telp. 08114443180</h3><h5>Bukti Pengembalian Laundry</h5></div>`;
        divContent = `<div class="struk-content"><table class="table info-customer"></table><p>Daftar Pengembalian Nota</p><ul class="list-group"></ul><div class="struk-message"><span>Nb. :</span><p>"Komplain cucian dilayani maksimal 3 hari setelah pengembalian laundry"</p></div></div>`;

        divCustomer = `<tr><td>Nama Pelanggan</td><td>:</td><td>${customer.name}</td></tr><tr><td>No. Telp</td><td>:</td><td>${customer.telp}</td></tr>`;

        divSign = `<div class="struk-sign"><div class="sign"><span>Disiapkan Oleh</span><br><br><span>${userId}</span></div><div class="sign"><span>Dikirim Oleh</span><br><br><span>-----------</span></div><div class="sign"><span>Diterima Oleh</span><br><br><span>----------</span></div></div><p style="font-size: 7pt; margin-top: 3mm">Dicetak tanggal : ${nowDate} ${nowHour}</p>`;

        $("html body").find(".areaPrintFaktur").append(divStruk);
        $(".struk").append(divHeader).append(divContent).append(divSign);
        $(".info-customer").append(divCustomer);

        $.each(data, function (i, val) {
            divList = `<li class="list-group-item" id="item${i}"><h4 class="list-group-item-heading">${i+1}. ${val.order_number} : ${val.quantity} Pcs</h4></li>`;
            
            $("ul.list-group").append(divList);
            
            $.each(val.detail, function (j, valj) {
                unit = val.order_type === "Kiloan" ? "Kg" : "Pcs";
                quantity = val.order_type === "Kiloan" ? (valj.isweight).toString().replace(/\./g, ',') : (valj.quantity).toString().replace(/\./g, '');
                detail = `<p class="list-group-item-text">&nbsp; &nbsp; ${quantity} ${unit} ${valj.item}</p>`;
                $(".list-group-item#item"+i).append(detail);
            });

            
        });

        let el = $(".areaPrintFaktur").html();
        document.body.innerHTML = el;
        window.print();
        $(".areaPrintFaktur").removeClass("active");
        $("body").find(".areaPrintFaktur").remove();
        location.reload();
    }

});
</script>