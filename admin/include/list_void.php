<div class="my-panel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style="display: flex; justify-content: space-between; align-item: center">
                <strong style="padding: 6px 0">Void Order</strong>
                <button class="btn btn-active btn-primary" id="addVoid" align="right">Tambah</button>
            </div>
        </div> 
        <div class="panel-body">
            <form action="" class="filter-select form-inline" id="filter_select">
                <div class="form-group">
                    <input type="text" class="form-control" name="startDate" id="startDate">
                </div>
                <div class="form-group">
                    <label for="">Sampai</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="endDate" id="endDate">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <br>
            <table class="table" id="table_void">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>No Faktur</th>
                        <th width="10%">Nomor Order</th>
                        <th>Nilai Order</th>
                        <th>User Order</th>
                        <th>Status</th>
                        <th>Memo</th>
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
        <button type="button" class="btn btn-primary" id="saveVoid">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style>
    .my-panel {
        margin: -15px -15px -35px -15px;
    }
</style>

<script>
    jQuery(function ($) {
        
        let date = new Date();
        nowDate = (date.getFullYear()+"-"+ ("0" + (date.getMonth() + 1)).slice(-2)+"-"+ ("0" + date.getDate()).slice(-2)).toString();
        
        $("#startDate, #endDate").val(nowDate).datepicker({
            dateFormat: "yy-mm-dd"
        });

        dataTable({ "startDate": nowDate, "endDate": nowDate });

        $("#filter_select").on("submit", function (e) {
            e.preventDefault();
            startDate = $("#startDate").val();
            endDate = $("#endDate").val();
            $('#table_void').DataTable().destroy();
            dataTable({ "startDate": startDate, "endDate": endDate });
        })

        function dataTable(data) {
            let token = $('meta[name=branch_token]').attr('content');
			let table = $('#table_void').DataTable({
				"processing": true,
				"ajax": {
					url: apiURL + "OrderVoid",
					type: "POST",
					data: data,
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
                    { "data": "created_at"},
                    { "data": "faktur"},
                    { "data": "no_order" },
                    { "data": "total_order", render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ) },
                    { "data": "user_order" },
                    { "data": "status"},
                    { "data": "memo"},
                    { "data": null, "orderable": false, "searchable": false, render: function (data, type, row) {
                        return "<button class='btn btn-info btn-xs' align='center' id='editOutlet' data-id='"+ row.id_outlet +"'>Edit</button>";
                    }, },
                ],
            });
        }

        let dataSales;

        $(document).on("click", "#searchFaktur", function (e) {
            e.preventDefault();
            $(document).find("#add_void #order option").remove();
            let val = $(document).find("input#faktur").val();
            let token = $('meta[name=branch_token]').attr('content');
            $.ajax({
                url: apiURL + "SalesOrder/faktur/"+val,
                method: 'POST',
                beforeSend: function (xhr) {  
                    xhr.setRequestHeader("Authorization", token);
                    $(document).find("#add_void #order").append($('<option></option>').attr('value', 0).text('Pilih nomor order')).prop('disabled', false);
                },
                success: function (response) {
                    dataSales = response;
                    $.each(response, function (key, obj) {  
                        let content = $('<option></option>').attr('value', obj.orderNumber).text(obj.orderNumber);
                        $(document).find("#add_void #order").append(content);
                    });

                }
            });
        });

        $(document).on("change", "#add_void #order", function () {
            val = $(this).val();
            getObject = $.grep(dataSales, e => e.orderNumber == val)[0];

            $(document).find("#add_void #totalOrder").val(getObject.totalOrder);
            $(document).find("#add_void #userOrder").val(getObject.userOrder);
            $(document).find("#add_void #outletOrder").val(getObject.outletOrder);
        })

        $(document).on("click", "#addVoid", function () {  
            $(".modal .modal-body").load("include/add_void.html", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Tambah Void");
                $(".modal .modal-footer #saveVoid").text("Simpan");

                let body = $("html body");
                $(".modal").modal("show");
            });
        });

        $(document).on("click", "#editOutlet", function () {  
            let table = $(document).find("#table_void").DataTable();
            let row = $(this).closest('tr');
            let tr = table.row(row).data();
            let body = $("html body");

            let id = $(this).data('id');
            $(".modal .modal-body").load("include/add_void.html", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Edit Void");
                $(".modal .modal-footer #saveVoid").text("Update");

                $(document).find("form#add_void").find("#searchFaktur").prop('disabled', true);
                let form = $(document).find("form#add_void"),
                    faktur = form.find("#faktur").val(tr.faktur).prop('disabled', true),
                    orderNumber = form.find("#order").append('<option value="'+tr.no_order+'" selected>'+ tr.no_order +'</option>'),
                    totalOrder = form.find("#totalOrder").val(tr.total_order),
                    userOrder = form.find("#userOrder").val(tr.user_order),
                    status = form.find("#status").val(tr.status),
                    memo = form.find("#memo").val(tr.memo);

                $(".modal").modal("show");
            });
        });

        $(".modal .modal-footer #saveVoid").on("click", function () {            
            let form = $(document).find("form#add_void"),
                faktur = form.find("#faktur").val(),
                orderNumber = form.find("#order").val(),
                totalOrder = form.find("#totalOrder").val(),
                userOrder = form.find("#userOrder").val(),
                outletOrder = form.find("#outletOrder").val(),
                status = form.find("#status").val(),
                memo = form.find("#memo").val()
            let data = {
                faktur: faktur,
                order_number: orderNumber,
                total_order: totalOrder,
                user_order : userOrder,
                outlet_order: outletOrder,
                status: status,
                memo: memo,
                user: user_id,
                to_date: (date.getFullYear()+"-"+ ("0" + (date.getMonth() + 1)).slice(-2)+"-"+ ("0" + date.getDate()).slice(-2) + " " + ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2)).toString()
            };

            let valid = true;
            if (faktur == null || orderNumber == "" || status == "") {
                valid = false;
            }

            let formTitle = $(".modal .modal-title").text();

            if (valid) {
                $(document).find("#table_void").DataTable().ajax.reload();
                let url = formTitle == "Edit Void" ? "OrderVoid/update/" + orderNumber : "OrderVoid/store";
                saveForm(data, url);
                $(".modal").modal("hide");
            }
        });

        function saveForm(data, url) {
            let token = $('meta[name=branch_token]').attr('content');
            $.ajax({
                url: apiURL + url,
                method: 'POST',
                data: data,
                beforeSend: function (xhr) {  
                    xhr.setRequestHeader("Authorization", token);
                },
                success: function (response) {
                    $(document).find("#table_void").DataTable().ajax.reload();
                }
            })
        }

    });

</script>