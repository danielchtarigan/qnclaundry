function rupiah(int) {
    let rupiah = parseFloat(int, 10).toFixed().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1.").toString();
    return "Rp " + rupiah;
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