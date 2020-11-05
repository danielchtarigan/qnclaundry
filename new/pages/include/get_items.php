<select class="select-custom" name="category" id="category" placeholder="Pilih Kategori"></select>
<select class="select-custom" name="item" id="item" placeholder="Pilih Item"></select>
<input type="text" id="price">

<div class="map"></div>

<script>
    jQuery(function ($) {
        // Select Custom
        $(".select-custom").each(function (index) {
            let value = $(this).attr("placeholder");
            $(this).append($("<option></option>").attr("disabled", true).attr("selected", true).text(value));
        })

        // Get authorization value to get permission on send to api
        let token = $('meta[name=branch_token]').attr('content');

        // Load data from database
        function get_items(url, token, response) {            
            $.ajax({
                url: url,
                method: "GET",
                data: "kota=Jakarta",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", token)
                },  
                success: function (res) {
                    let data = res['data'];
                    response(data);
                },
            });
        }

        // Proccess Data
        get_items(apiURL + "Items", token, function(data) {
            selected_item("category");
            function selected_item(id, parent_id) {
                if (id == "category") {
                    let map = data.reduce(function (result, item) {
                        result[item.category] = result[item.category] || [];
                        result[item.category].push({'name': item.name, 'price': item.price});
                        return result;
                    }, {});

                    $.each(Object.keys(map), function (i, val) {
                        $("#"+id).append($("<option></option>").attr("value", val).text(val));
                    });
                }
                else {                    
                    let items = $.grep(data, val => val.category === parent_id);
                    $.each(items, function(i, val) {
                        $("#"+id).append($("<option></option>").attr("value", val.name).text(val.name));   
                    })
                    
                    let prices = $.grep(data, val => val.name === parent_id)
                    if (prices.length > 0) {
                        $("#price").val(prices[0].price);
                    }
                }
            }    

            $("#category").on("change", function () {
                $("#item").find("option").remove();
                $("#item").append("<option selected disabled>Pilih Item</option>");
                $("#price").val("")
                let parent_id = $(this).val();
                selected_item("item", parent_id);
            })

            $("#item").on("change", function () {
                $("#price").val("");
                let parent_id = $(this).val();
                selected_item("item", parent_id);
            })
        })
    })
</script>
