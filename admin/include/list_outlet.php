<div class="my-panel">
    <div class="panel panel-primary">
        <div class="panel-heading">Daftar Outlet</div> 
        <div class="panel-body">
            <button class="btn btn-active btn-primary" id="addOutlet" style="margin-bottom: 10px">Tambah</button>
            <table class="table" id="table_outlet">
                <thead>
                    <tr>
                        <th width="10%">Id Outlet</th>
                        <th>Nama Outlet</th>
                        <th>Cabang Outlet</th>
                        <th>Status</th>
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
        <button type="button" class="btn btn-primary" id="saveOutlet">Save changes</button>
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

        function dataTable(data) {
            let token = $('meta[name=branch_token]').attr('content');
			let table = $('#table_outlet').DataTable({
				"processing": true,
				"ajax": {
					url: apiURL + "Outlet/lists",
					type: "POST",
					data: data,
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
                    { "data": "id_outlet" },
                    { "data": "nama_outlet" },
                    { "data": "cabang" },
                    { "data": "status", render: function (data, type, row) {
                        if (data == true) {
                            act = "Active";
                            label = "label-success";
                        }
                        else {
                            act = "Not Active";
                            label = "label-danger";
                        }
                        return '<span class="label '+label+'">'+ act +'</span>';
                    }, },
                    { "data": null, render: function (data, type, row) {
                        return "<button class='btn btn-info btn-xs' align='center' id='editOutlet' data-id='"+ row.id_outlet +"'>Edit</button>";
                    }, },
                ],
            });
        }

        dataTable({});

        $(document).on("click", "#addOutlet", function () {  
            $(".modal .modal-title").attr("data-outlet", "").attr("data-branch", "");
            $(".modal .modal-body").load("include/add_outlet.php", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Tambah Outlet");
                $(".modal .modal-footer #saveOutlet").text("Simpan");
                $(".modal").modal("show");
            });
        });

        $(document).on("click", "#editOutlet", function () {  
            let table = $(document).find("#table_outlet").DataTable();
            let row = $(this).closest('tr');
            let tr = table.row(row).data();

            let id = $(this).data('id');
            $(".modal .modal-title").attr("data-outlet", id).attr("data-branch", tr.cabang);
            $(".modal .modal-body").load("include/add_outlet.php", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Update Outlet");
                $(".modal .modal-footer #saveOutlet").text("Update");
                $(".modal").modal("show");

                let form = $(document).find("form#add_outlet"),
                    branch = form.find("#branch").append('<option value="'+tr.cabang+'" selected>'+ tr.cabang +'</option>');
                    name = form.find("#name").val(tr.nama_outlet),
                    telp = form.find("#telp").val(tr.telpon),
                    address = form.find("#address").val(tr.alamat),
                    active = tr.status == 1 ? form.find("#active").prop('checked', true) : form.find("#active").prop('checked', false);
            });
        });

        $(".modal .modal-footer #saveOutlet").on("click", function () {            
            let form = $(document).find("form#add_outlet"),
                branch = form.find("#branch").val(),
                name = form.find("#name").val(),
                telp = form.find("#telp").val(),
                address = form.find("#address").val(),
                active = form.find("#active").is(":checked") == true ? 1 : 0;
            let data = {
                branch: branch,
                name: name,
                telp: telp,
                address: address,
                active: active
            };

            let valid = true;
            if (branch == null || name == "" || telp == "") {
                valid = false;
            }

            let outletId = $(".modal .modal-title").attr("data-outlet");

            if (valid) {
                let url = outletId != "" ? "Outlet/update/"+outletId : "Outlet/store";
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
                    $(document).find("#table_outlet").DataTable().ajax.reload();
                }
            })
        }

    });

</script>