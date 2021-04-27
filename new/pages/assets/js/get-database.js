function rupiah(int) {
    let rupiah = parseFloat(int, 10).toFixed().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1.").toString();
    return "Rp " + rupiah;
}

function getTimeZone() {
    let timezoneName = Intl.DateTimeFormat().resolvedOptions().timeZone;
    return timezoneName;
}

function toFirstWords(str) {
    return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
        return letter.toUpperCase();
    });
}

function getData(url, data, result) {
    let token = $('meta[name=branch_token]').attr('content');
    $.ajax({
        url: apiURL + url,
        type: "POST",
        data: data,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", token);
            result(xhr);
        },
        success: function(response) {
            result(response);
        }
    });
};

function apiData(url, data, result) {
    let token = $('meta[name=branch_token]').attr('content');
    $.ajax({
        url: apiURL + url,
        type: "POST",
        data: data,
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", token);
            result(xhr);
        },
        success: function(response) {
            result(response);
        }
    });
};

function getDataOrder() {
    let data = localStorage.getItem("dataOrder");
    let getData = JSON.parse(data)['data'];

    let items = [];

    if (getData.length > 0) {
        $(".data-pesanan .data-body").html('<div class="list-order"><div class="list-group" style="width: 100%;"></div></div>');
        $(".data-pesanan .data-body").append($('<ul class="list-group"></ul>'));
        $.each(getData, function (i, val) {
            let content = $('<li href="#" class="list-group-item order-number" data-id="'+val.orderNumber+'" id="orderNumber" data-kilos="'+ val.kilos +'">'+ val.orderNumber +' | <span style="color: green">' + rupiah(val.total) + '</span> | <span style="display: inline-block; text-align: right"><i class="ace-icon fa fa-trash-o" style="cursor: pointer; color: red" id="removeOrder"></i> &nbsp;<i class="ace-icon fa fa-print" style="cursor: pointer; color: green" id="showPrintAreaOrder"></i></span></li>');
            $(".data-pesanan .data-body>.list-order>.list-group").append(content);

            $.each(val.items, function (i, val) {
                items.push(val);
            });
        });
    } else {
        $(".data-pesanan .data-body").html('<div class="list-order"><span>Belum ada pesanan</span></div>');
    }

    items = items.filter(v => v.category == "Kiloan");
    if (items.length > 0) {
        $.each(items, function (i, val) {
            let content = $('<div class="list-items" style="display: none"><div class="item-kiloan"><span id="item">'+ val.item +'</span><span id="quantity">'+ val.quantity +'</span><span id="weight">' + val.isweight + '</span><span id="total">' + val.total + '</span></div></div>');
            $(".data-pesanan .data-body>.list-order>.list-group").append(content);
        });
    }

    amount = getData.reduce( function (a, b) { 
        return parseInt(a) + parseInt(b.total);
    }, 0);

    $(document).find("#orderCount").data('value', amount);
    $(document).find("#orderCount").text(getData.length +' | '+ rupiah(amount));
}