<form class="form-horizontal form-style-x" action="" id="add_workshop">
    <div class="form-group">
        <div class="checkbox">
            <label for="active" style="font-weight: bold">
                <input type="checkbox" id="active" checked="true"> Active
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="branch">Cabang</label>
        <select class="form-control" name="branch" id="branch" placeholder="Pilih cabang">
        </select>
    </div>
    <div class="form-group">
        <label for="name">Nama workshop</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Ketik nama workshop baru" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="address">Alamat</label>
        <textarea class="form-control" name="address" id="address" cols="" rows="4" style="resize: none"></textarea>
    </div>
</form>

<style>
    .form-style-x {
        padding: 0 15px;
    }
</style>


<script>
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
    
                    $("#add_workshop #branch option").remove();
    
                    $.each(data, function (key, obj) {  
                        let content = $('<option></option>').attr('value', obj.id).text(obj.branch);
                        $("#add_workshop #branch").append(content);
                    });

                    let branch = $(".modal .modal-title").attr("data-branch");

                    if (branch != "") {
                        $("#add_workshop #branch option[value="+ branch +"]").attr('selected', true);
                    }
                }
            });
        }

        getBranch();

        let pl = $("select#branch").attr("placeholder");
        let content = '<option value="0" disabled selected="true">'+pl+'</option>';
        $("#add_workshop #branch").append(content);

        $("#add_workshop #telp").on("blur keyup keypress", function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        
    });
</script>