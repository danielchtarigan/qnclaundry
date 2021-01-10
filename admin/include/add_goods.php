<form class="form-horizontal form-style-x" action="" id="form_goods">
    <div class="form-group">
        <label for="branch">Cabang</label>
        <select class="form-control" name="branch" id="branch" placeholder="Pilih cabang">
        </select>
    </div>
    <div class="form-group">
        <label for="outlet">Outlet</label>
        <select class="form-control" name="outlet" id="outlet" placeholder="Pilih outlet">
        </select>
    </div>
    <div class="form-group">
        <label for="category">Kategori Barang</label>
        <select class="form-control" name="category" id="category" placeholder="--Pilih kategori barang--">
        </select>
    </div>
    <div class="form-group">
        <label for="name">Nama Barang</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Ketik nama barang" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="price">Harga</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="0" value="0" autocomplete="off">
    </div>
</form>

<style>
    .form-style-x {
        padding: 0 15px;
    }
</style>


<!-- <script>
    jQuery(function($) {    
        
        function getBranch() {
            let token = $('meta[name=branch_token]').attr('content');
            $.ajax({
                url: apiURL + "Branch/lists",
                method: 'POST',
                beforeSend: function (xhr) {  
                    xhr.setRequestHeader("Authorization", token);
                },
                success: function (response) {
                    data = response.data;
    
                    $("#add_outlet #branch option").remove();
    
                    $.each(data, function (key, obj) {  
                        let content = $('<option></option>').attr('value', obj.branch).text(obj.branch);
                        $("#add_outlet #branch").append(content);
                    });

                    let branch = $(".modal .modal-title").attr("data-branch");

                    if (branch != "") {
                        $("#add_outlet #branch option[value="+ branch +"]").attr('selected', true);
                    }
                }
            });
        }

        getBranch();

        let pl = $("select#branch").attr("placeholder");
        let content = '<option value="0" disabled selected="true">'+pl+'</option>';
        $("#add_outlet #branch").append(content);

        $("#add_outlet #telp").on("blur keyup keypress", function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        
    });
</script> -->