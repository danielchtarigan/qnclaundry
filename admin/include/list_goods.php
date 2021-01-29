<div class="my-panel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style="display: flex; justify-content: space-between; align-items: center">
                <strong style="padding: 6px 0">Daftar Barang & Jasa</strong>
                <button class="btn btn-active btn-primary" id="addgoods" align="right"><i class="fa fa-plus"></i> Tambah</button>
            </div>
        </div> 
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <button class="btn btn-success btn-md" id="info_list"><i class="fa fa-info"></i></button>
                    <button class="btn btn-success btn-md" id="copy_goods" style="display: none"><i class="fa fa-copy"></i> Salin Barang Ke</button>
                    <button class="btn btn-danger btn-md" id="remove_items" style="display: none"><i class="fa fa-trash-o"></i> Delete</button>
                </div>    
                <div class="col-lg-6 col-md-6">
                    <form action="" class="filter-select" id="filter_select">
                        <div class="form-group">
                            <select name="select_branch" id="select_branch" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="select_outlet" id="select_outlet" class="form-control">
                            </select>
                        </div>
                    </form>
                </div>    
            </div>
            <table class="table" id="table_goods">
                <thead>
                    <tr>
                        <th><input name="select_all" value="1" type="checkbox"></th>
                        <th>ID</th>
                        <th>Type Barang</th>
                        <th>Kategori Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="savegoods">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style>
    .my-panel {
        margin: -15px -15px -35px -15px;
    }

    form#filter_select {
        display: flex;
        justify-content: flex-end;
        align-items: right;
    }

    form#filter_select>.form-group {
        margin-right: 10px;
    }

    table#table_goods>tbody td, table#table_goods>tbody th {
        text-align: center;
    }

    table#table_goods>tbody td:nth-child(n+3) {
        text-align: left;
    }
</style>

<script>
    jQuery(function ($) {
        let user = '<?= $_SESSION['id'] ?>';
        let rows_selected = [];

        function dataTable(data) {
            let token = $('meta[name=branch_token]').attr('content');
			let table = $('#table_goods').DataTable({
                "order": [[ 1, 'asc' ]],
				"processing": true,
				"ajax": {
					url: apiURL + "ItemAdjustmentPrice/lists",
					type: "POST",
					data: data,
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
                    { 
                        "data": null, "width": "1%", "orderable": false, "searchable": false, "className": "dt-body-center",
                        "render": function (data, type, row) {
                            return '<input type="checkbox" data-id="'+ row.price_id +'">';
                        }, 
                    },
                    { "data": "id" },
                    { "data": "type" },
                    { "data": "category" },
                    { "data": "item" },
                    { "data": "price" },
                    { "data": null, "orderable": false, "searchable": false, render: function (data, type, row) {
                        return "<button class='btn btn-info btn-xs' align='center' id='editgoods' data-id='"+ row.id +"'>Edit</button>";
                    }, },
                ],
                "rowCallback": function(row, data){
                    // Get row ID
                    var rowId = data.price_id;

                    // If row ID is in the list of selected row IDs
                    if($.inArray(rowId, rows_selected) !== -1){
                        $(row).find('input[type="checkbox"]').prop('checked', true);
                        $(row).addClass('selected');
                    }
                },
                fnDrawCallback: function () {
                    len = this.api().page.info().recordsTotal;
                    if (len > 0) {
                        $("#copy_goods").show();
                    } else {
                        $("#copy_goods").hide();
                    }
                }
            });
        }

        $(document).on('click', '#table_goods tbody input[type="checkbox"]', function(e){
            let row = $(this).closest('tr');
            let rowId = $(this).data('id');
            let index = $.inArray(rowId, rows_selected);

            if(this.checked && index === -1){
                rows_selected.push(rowId);
            } else if (!this.checked && index !== -1){
                rows_selected.splice(index, 1);
            }
            
            if(this.checked){
                row.addClass('selected');
            } else {
                row.removeClass('selected');
            }
            
            if(rows_selected.length > 0) {
                $("#remove_items").show();
            } else  {
                $("#remove_items").hide();
            }            

            e.stopPropagation();
        });

        $(document).on('click', 'thead input[name="select_all"]', function(e){
            if(this.checked){
                $('#table_goods tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#table_goods tbody input[type="checkbox"]:checked').trigger('click');
            }

            e.stopPropagation();
        });

        let branch, outlet;
        branch = $('.filter-select #select_branch');
        outlet = $('.filter-select #select_outlet');

        $(document).on("click", "#remove_items", function (e) {  
            let data = { "id": rows_selected };

            let url = "ItemAdjustmentPrice/delete";
            getData(data, url, function (res) {
                $(document).find("#table_goods").DataTable().ajax.reload();
                if(res > 0) {
                    $(document).find("#table_goods").DataTable().destroy();
                    dataTable({ branch: branch.val(), outlet: outlet.val() });
                    $("#remove_items").hide();
                    rows_selected = [];
                }
            });

            e.stopPropagation();
        });

       // get detail branch outlet
        getData({ }, "Branch/details", function (response) {
            if (response.readyState !== 0) {
                let data = response.data;
                detailBranches("list", null, data);

                $(document).on("change", "#select_branch", function () {
                    $('#select_outlet>option').remove();
                    branches = branch.val().split("-");
                    detailBranches("list", branches[0], data);
                    $('#table_goods').DataTable().destroy();
                });

                $(document).on("change", "#select_outlet", function () {
                    $('#table_goods').DataTable().destroy();   
                    table = dataTable({ branch: branch.val(), outlet: outlet.val() });
                });

                // form               
                $(document).on("click", "#addgoods", function () {  
                    $(".modal .modal-title").attr("data-goods", "").attr("data-branch", "");
                    $(".modal .modal-body").load("include/add_goods.php", function () {  
                        $(".modal .modal-dialog").addClass("modal-sm");
                        $(".modal .modal-title").text("Tambah Barang");

                        button = $('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" id="savegoods">Simpan</button>');
                        $(".modal .modal-footer").html(button);

                        $(".modal .modal-footer #savegoods").text("Simpan").show();

                        detailBranches("form", null, data);

                        getDetailItems();

                        $(document).on("keyup keypress blur", "#price", function (event) {                
                            $(this).val($(this).val().replace(/[^0-9\.]/g,''));
                            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                                event.preventDefault();
                            }
                        });

                        $(".modal").modal("show");

                        $(document).on("change", "#branch", function () {
                            $('#outlet>option').remove();
                            branch = $("#form_goods #branch");
                            detailBranches("form", branch.val(), data);
                        });
                    });
                });

                // Copy Goods
                $(document).on("click", "#copy_goods", function () {  
                    let table = $(document).find("#table_goods").DataTable();
                    dataGoods = [];
                    $.each(table.data(), function (key, item) {
                        dataGoods.push({ item_id: item.id, price: item.price });
                    });

                    $(".modal .modal-body").load("include/copy_goods_to_outlet.php", function () {
                        $(".modal .modal-title").text("Salin Barang Ke");
                        $(".modal .modal-footer #savegoods").hide();

                        button = $('<button type="button" class="btn btn-primary" id="copygoods">Simpan</button>');
                        $(".modal .modal-footer").html(button);

                        detailBranches("copy", null, data);

                        $(".modal").modal("show");

                        $(document).on("change", "#branch", function () {
                            $('#outlet>option').remove();
                            branch = $("#copy_goods_to #branch");
                            detailBranches("copy", branch.val(), data);
                        });
                    });

                    $(document).on("click", "#copygoods", function () {
                        branch_id = $("#copy_goods_to #branch").val();
                        outlet_id = $("#copy_goods_to #outlet").val();
                        user_id = user;
                        
                        let datag = {};
                        datag.branch_id = branch_id;
                        datag.outlet_id = outlet_id;
                        datag.user_id = user_id;
                        datag.data = dataGoods;

                        valid = true;

                        if (branch_id == 0 || outlet_id == 0) {
                            valid = false;
                        }

                        if (valid) {
                            url = "ItemAdjustmentPrice/store_copy";
                            saveForm(datag, url);
                            detailBranches("form", null, data);
                            $(".modal").modal("hide");
                        }

                    });
                });

            }
        });
        
        function detailBranches(modul, branch_id, data) {
            let branches = data.map(item => ({ id: item.branch_id, name: item.branch })).filter((value, index, self) => 
                index === self.findIndex((t) => (t.id === value.id && t.name === value.name))
            );
            
            // daftar list
            if (modul == "list") {
                if (branch_id === null) {    
                    $('#select_branch').append('<option value="0">Pilih Cabang</option>');
                    $.each(branches, function (key, item) {
                        element = $('<option></option>').attr('value', item.id+"-"+item.name).text(item.name);
                        $('#select_branch').append(element);
                    });
                }
                else {
                    let outlets = $.grep(data, val => val.branch_id === branch_id);
                    $('#select_outlet').append('<option value="0">Pilih Outlet</option>');
                    $.each(outlets, function (key, item) {
                        element = $('<option></option>').attr('value', item.outlet_id).text(item.outlet);
                        $('#select_outlet').append(element);
                    });
                }           
            }

            // form
            if (modul == "form") {
                if (branch_id == null) {
                    $('#branch').append('<option value="0">Pilih Cabang</option>');
                    $.each(branches, function (key, item) {
                        element = $('<option></option>').attr('value', item.id).text(item.name);
                        $('#branch').append(element);
                    });
                }
                else {
                    let outlets = $.grep(data, val => val.branch_id === branch_id);
                    $('#outlet').append('<option value="0">Pilih Outlet</option>');
                    $.each(outlets, function (key, item) {
                        element = $('<option></option>').attr('value', item.outlet_id).text(item.outlet);
                        $('#outlet').append(element);
                    });
                }
            }

            //Copy Goods
            if (modul == "copy") {
                if (branch_id == null) {
                    $('#branch').append('<option value="0">Pilih Cabang</option>');
                    $.each(branches, function (key, item) {
                        element = $('<option></option>').attr('value', item.id).text(item.name);
                        $('#branch').append(element);
                    });
                }
                else {
                    let outlets = $.grep(data, val => val.branch_id === branch_id);
                    $('#outlet').append('<option value="0">Pilih Outlet</option>');
                    $.each(outlets, function (key, item) {
                        element = $('<option></option>').attr('value', item.outlet_id).text(item.outlet);
                        $('#outlet').append(element);
                    });
                }
            }
        }

        function getDetailItems() {
            getData({ }, "Items/details", function (response) {
                if (response.readyState !== 0) {
                    let data = response.data;
                    detailItems(null, data);
                }
            });
        }

        function detailItems(category, data) {
            let categories = data.map(item => ({ id: item.category_id, name: item.category })).filter((value, index, self) => 
                    index === self.findIndex((t) => (t.id === value.id && t.name === value.name)));

            $('#category').append('<option value="0">Pilih kategori barang</option>');
            $.each(categories, function (key, item) {
                element = $('<option></option>').attr('value', item.id).text(item.name);
                $('#category').append(element);
            });
        }

        function getData(data, url, result) {
            let token = $('meta[name=branch_token]').attr('content');
            $.ajax({
                url: apiURL + url,
                method: 'POST',
                data: data,
                beforeSend: function (xhr) {  
                    xhr.setRequestHeader("Authorization", token);
                    result(xhr);
                },
                success: function (response) {
                    result(response);
                }
            })
        }        

        $(document).on("click", "#editgoods", function () {  
            let table = $(document).find("#table_goods").DataTable();
            let row = $(this).closest('tr');
            let tr = table.row(row).data();

            let id = $(this).data('id');
            $(".modal .modal-title").attr("data-goods", id);
            $(".modal .modal-body").load("include/add_goods.php", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Update Barang");

                button = $('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary" id="savegoods">Update</button>');
                $(".modal .modal-footer").html(button);

                $(".modal .modal-footer #savegoods").text("Update").show();
                $(".modal").modal("show");

                branches = branch.val().split("-");

                let form = $(document).find("form#form_goods"),
                    branch_id = form.find("#branch").append('<option value="'+branches[0]+'" selected>'+ branches[1] +'</option>').attr("disabled", true);
                    outlet = form.find("#outlet").append('<option value="'+outlet.val()+'" selected>'+ outlet.val() +'</option>').attr("disabled", true);
                    category = form.find("#category").append('<option value="'+ tr.category +'" selected>'+ tr.category +'</option>').attr("disabled", true);
                    name = form.find("#name").val(tr.item),
                    price = form.find("#price").val(tr.price);
            });
        });

        $(document).on("click", ".modal .modal-footer #savegoods", function () {            
            let form = $(document).find("form#form_goods"),
                branch = form.find("#branch").val(),
                outlet = form.find("#outlet").val(),
                category = form.find("#category").val(),
                name = form.find("#name").val();
                price = form.find("#price").val();

            let data = {
                branch_id: branch,
                outlet_id: outlet,
                category_id: category,
                name: name,
                price: price,
                user_id: user,
            };

            let valid = true;
            if (branch == 0 || outlet == 0 || category == 0 || name == "" || price == "" || price == 0) {
                valid = false;
            }

            let goodsId = $(".modal .modal-title").attr("data-goods");

            if (valid) {
                let url = goodsId != "" ? "Items/update/"+goodsId : "Items/store";
                saveForm(data, url);
                $(".modal").modal("hide");
            }
        });

        function saveForm(data, url) {
            $(document).find("#table_goods").DataTable().ajax.reload();
            let token = $('meta[name=branch_token]').attr('content');
            $.ajax({
                url: apiURL + url,
                method: 'POST',
                data: data,
                beforeSend: function (xhr) {  
                    xhr.setRequestHeader("Authorization", token);
                },
                success: function (response) {
                    $(document).find("#table_goods").DataTable().ajax.reload();
                }
            })
        }

        $("#info_list").on("click", function () {
            $(".modal .modal-title").text("Informasi Daftar Barang");
            $(".modal .modal-body").html($('<p>Disini anda bisa mengatur harga franchise laundry QnC..!</p>'));
            $(".modal .modal-footer #savegoods").hide();
            $(".modal").modal("show");
        });

    });

</script>