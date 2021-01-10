<div class="my-panel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style="display: flex; justify-content: space-between; align-item: center">
                <strong style="padding: 6px 0">Daftar Cabang</strong>
                <button class="btn btn-active btn-primary" id="addBranch" align="right">Tambah</button>
            </div>
        </div> 
        <div class="panel-body">
            <table class="table" id="table_branch">
                <thead>
                    <tr>
                        <th width="10%">Id Cabang</th>
                        <th>Nama Cabang</th>
                        <th>Kota Cabang</th>
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
        <button type="button" class="btn btn-primary" id="saveBranch">Save changes</button>
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
			let table = $('#table_branch').DataTable({
				"processing": true,
				"ajax": {
					url: apiURL + "Branch/lists",
					type: "POST",
					data: data,
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
                    { "data": "id" },
                    { "data": "branch" },
                    { "data": "city" },
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
                        return "<button class='btn btn-info btn-xs' align='center' id='editBranch' data-id='"+ row.id +"'>Edit</button>";
                    }, },
                ],
            });
        }

        dataTable({});

        $(document).on("click", "#addBranch", function () {  
            $(".modal .modal-title").attr("data-outlet", "").attr("data-branch", "");
            $(".modal .modal-body").load("include/add_branch.php", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Tambah Cabang");
                $(".modal .modal-footer #saveBranch").text("Simpan");
                $(".modal").modal("show");
            });
        });

        $(document).on("click", "#editBranch", function () {  
            let table = $(document).find("#table_branch").DataTable();
            let row = $(this).closest('tr');
            let tr = table.row(row).data();

            let id = $(this).data('id');
            $(".modal .modal-title").attr("data-branch", id);
            $(".modal .modal-body").load("include/add_branch.php", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Update Cabang");
                $(".modal .modal-footer #saveBranch").text("Update");
                $(".modal").modal("show");

                let form = $(document).find("form#add_branch"),
                    name = form.find("#name").val(tr.branch),
                    city = form.find("#city").val(tr.city),
                    active = tr.status == 1 ? form.find("#active").prop('checked', true) : form.find("#active").prop('checked', false);
            });
        });

        $(".modal .modal-footer #saveBranch").on("click", function () {            
            let form = $(document).find("form#add_branch"),
                name = form.find("#name").val(),
                city = form.find("#city").val(),
                active = form.find("#active").is(":checked") == true ? 1 : 0;
            let data = {
                name: name,
                city: city,
                active: active
            };

            let valid = true;
            if (name == null || city == "") {
                valid = false;
            }

            let outletId = $(".modal .modal-title").attr("data-branch");

            if (valid) {
                let url = outletId != "" ? "Branch/update/"+outletId : "Branch/store";
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
                    $(document).find("#table_branch").DataTable().ajax.reload();
                }
            })
        }

    });

</script>