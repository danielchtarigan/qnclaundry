<?php  
date_default_timezone_set('Asia/Makassar');
?>

<style>
    .info-outlet {
        margin: 20px 0;
    }
    .info-outlet p {
        line-height: 0.5;
    }
</style>

<div class="area-nota">
    <div style="max-width:80mm;margin:3mm;">
        <div align="center"><img width="80%" src="https://new.qnclaundry.com/logo 2017.bmp" /></div>
        <div style="font-size: 9pt; font-family: Tahoma;">
            <div class="struk-body nota-customer">

                <div class="info-outlet" align="center"></div>
            
                <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-size:10pt;">NOTA ORDER</span></strong></div>
                <svg class="barcode"></svg>
                <br>
                <table style="border-top: 1px dotted #000;width:100%;" id="info-user">
                    <tr>
                        <td>
                            <span style="float:left;font-size: 9pt;"><?= date('D, d M y H:i A'); ?></span>
                        </td>
                        <td>
                            <span style="float:right;font-size: 9pt;" id="user"></span>
                        </td>
                    </tr>
                </table>
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-customer"></table>
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-order"></table>	
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-extra"></table>			
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-total"></table>	
                <div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px;" id="info-estimasi"></div>		
                <table style="width:100%;border-top: 1px dashed #000;border-bottom: 1px dashed #000;font-size: 6pt;font-family: Tahoma;text-align: justify;">
                    <tr>
                        <td colspan="2">
                            Syarat dan ketentuan komplain klik:
                        </td>
                    </tr>
                    <tr valign="top"> 
                        <td style="text-align: center; font-size: 8pt">
                            www.qnclaundry.net/complaint 
                        </td>
                    </tr>

                    <tr valign="top">
                        <td style="text-align: center">
                            <img style="width: 10px" src="../../accounting/icon/hand-pointer.ico">
                        </td>
                    </tr>
                </table>

                <div style="width:100%;border-top: 1px dotted #000;font-size: 8pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-top:1px;text-align: center;">			    
                    Saya setuju dan telah  mengerti seluruh syarat dan ketentuan di QnCLaundry
                    <br><br><br><br><br><br>
                    <span id="customerSign" style="display: inline-block; line-height: 0;"></span>
                </div>
            </div>

            <div style="page-break-before:always;" class="struk-body">
                <table style="width:100%;" id="info-important" align="center"></table>
                <h2 id="outlet" style="font-weight: 3rem; margin-top: -4px; text-align: right"></h2>
                <table style="border-top: 1px dotted #000;width:100%;" id="info-user">
                    <tr>
                        <td>
                            <span style="float:left;font-size: 9pt;"><?= date('D, d M y H:i A'); ?></span>
                        </td>
                        <td>
                            <span style="float:right;font-size: 9pt;" id="user"></span>
                        </td>
                    </tr>
                </table>
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-customer"></table>
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-order"></table>	
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-extra"></table>			
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-total"></table>	
                <div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px;" id="info-estimasi"></div>	
                <br>
                <svg class="barcode"></svg>
            </div>

            <div style="page-break-before:always;" class="struk-body">
                <table style="width:100%;" id="info-important" align="center"></table>
                <h2 id="outlet" style="font-weight: 3rem; margin-top: -4px; text-align: right"></h2>
                <table style="border-top: 1px dotted #000;width:100%;" id="info-user">
                    <tr>
                        <td>
                            <span style="float:left;font-size: 9pt;"><?= date('D, d M y H:i A'); ?></span>
                        </td>
                        <td>
                            <span style="float:right;font-size: 9pt;" id="user"></span>
                        </td>
                    </tr>
                </table>
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-customer"></table>
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-order"></table>	
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-extra"></table>			
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-total"></table>	
                <div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px;" id="info-estimasi"></div>	
                <br>
                <svg class="barcode"></svg>
            </div>
        </div>
    </div>
</div>	


<script>
    let orderNumber = '<?= $_GET['id'] ?>';
    let today = '<?= date('D, d M y H:i A'); ?>';
    let dataOutlet = JSON.parse(localStorage.getItem("dataOutlet")).data;
    let dataOrder = JSON.parse(localStorage.getItem("dataOrder")).data;
        dataOrder = dataOrder.filter(item => item.orderNumber == orderNumber)[0];
    let dataCustomer = JSON.parse(localStorage.getItem("dataCustomer"));

    JsBarcode(".barcode", orderNumber, {
        height: 60,
    });

    $("#outlet").text("Outlet: "+ dataOutlet.outlet);
    $("#branch").text("Cabang: "+ dataOutlet.branch);
    $("#address").text("Alamat: Jl. "+ dataOutlet.address);
    $("#callCenter").text("Call Center: "+ dataOutlet.telpon);

    let divOutlet = `<div><p>Outlet: ${dataOutlet.outlet}<b></b></p><p>Alamat: ${dataOutlet.address}</p><p>Cabang: ${dataOutlet.branch}</p><p>Call Center: ${dataOutlet.telpon}</p></div>`;
    let divCustomer = `<tr><td>Nama</td><td>:</td><td>${dataCustomer.name}</td></tr><tr><td>No Pesanan</td><td>:</td><td>${dataOrder.orderNumber}</td></tr>`;

    let orderMainItem = dataOrder.items.filter(item => item.category != "Express" && item.category != "Delivery" && item.category != "Discount");
    let orderServiceItem = dataOrder.items.filter(item => item.category == "Express" || item.category == "Delivery" || item.category == "Discount");
    let orderDiscount = dataOrder.items.filter(item => item.category == "Discount");
    let orderExpress = dataOrder.items.filter(item => item.category == "Express");
    let orderDelivery = dataOrder.items.filter(item => item.category == "Delivery");

    $.each(orderMainItem, function (i, val) {  
        let qty = val.category == "Kiloan" ? parseFloat(val.isweight)+" kg" : parseFloat(val.quantity);
        let content = `<tr>${val.quantity}</td><td>${val.item} ${qty}</td><td align="right">${rupiah(val.total)}</td></tr>`;
        $(".struk-body #info-order").append(content);
    });

    $.each(orderDiscount, function (i, val) {
        let content = `<tr><td>&nbsp; &nbsp; &nbsp;</td><td><td>${val.item}</td><td align="right">(${rupiah(val.total*-1)})</td></tr>`;
        $(".struk-body #info-extra").append(content);
    });

    $.each(orderDelivery, function (i, val) {
        let content = `<tr><td>&nbsp; &nbsp; &nbsp;</td><td><td>${val.item}</td><td align="right">${rupiah(val.total*1)}</td></tr>`;
        $(".struk-body #info-extra").append(content);
    });

    let express = false;
    $.each(orderExpress, function (i, val) {
        express = val.item;
        let content = `<tr><td>&nbsp; &nbsp; &nbsp;</td><td><td>${val.item}</td><td align="right">${rupiah(val.total)}</td></tr>`;
        $(".struk-body #info-extra").append(content);
    });

    let divTotal = `<tr><td>Total</td><td align="right"><b>${rupiah(dataOrder.total)}</b></td></tr>`;
    $(".struk-body #info-total").append(divTotal);    

    let divEstimated;
    if (express == "express") {
        divEstimated = `<span>Estimasi: ${formatDateTimeId(setTimes(24))}</span>`;
        exp = "Express 24 Jam";
    } else if (express == "double_express") {
        divEstimated = `<span>Estimasi: ${formatDateTimeId(setTimes(12))}</span>`;
        exp = "Express 12 Jam";
    } else if (express == "triple_express") {
        divEstimated = `<span>Estimasi: ${formatDateTimeId(setTimes(6))}</span>`;
        exp = "Express 6 Jam";
    } else {
        divEstimated = `<span>Estimasi: ${formatDateTimeId(setTimes(3*24))}</span>`;
        exp = "";
    }

    let divImportant = `<tr><td width="50%"><h3>${exp}</h3></td><td align="right" width="50%"><h3>${today}</h3></td></tr>`;

    $(".info-outlet").html(divOutlet);
    $(".struk-body #info-customer").html(divCustomer);
    $("#info-user #user").text("Kasir: "+ userId);
    $(".struk-body #info-estimasi").html(divEstimated);
    $(".struk-body #outlet").text(dataOutlet.outlet);
    $(".struk-body #info-important").html(divImportant);
    $("#customerSign").text((dataCustomer.name).toUpperCase());

</script>
