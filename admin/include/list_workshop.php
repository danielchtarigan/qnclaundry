<div class="my-panel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style="display: flex; justify-content: space-between; align-items: center">
                <strong style="padding: 6px 0">Daftar Workshop</strong>
                <button class="btn btn-active btn-primary" id="addworkshop" align="right">Tambah</button>
            </div>
        </div> 
        <div class="panel-body">
            <table class="table" id="table_workshop">
                <thead>
                    <tr>
                        <th width="10%">Id</th>
                        <th>Nama Workshop</th>
                        <th>Cabang Workshop</th>
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
        <button type="button" class="btn btn-primary" id="saveworkshop">Save changes</button>
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
			let table = $('#table_workshop').DataTable({
				"processing": true,
				"ajax": {
					url: apiURL + "Workshop/lists",
					type: "POST",
					data: data,
					beforeSend: function (xhr) {
						xhr.setRequestHeader("Authorization", token)
					}
				},
				"columns": [
                    { "data": "id" },
                    { "data": "workshop" },
                    { "data": "branch" },
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
                        return "<button class='btn btn-info btn-xs' align='center' id='editworkshop' data-id='"+ row.id +"'>Edit</button>";
                    }, },
                ],
            });
        }

        dataTable({});

        $(document).on("click", "#addworkshop", function () {  
            $(".modal .modal-title").attr("data-workshop", "").attr("data-branch", "");
            $(".modal .modal-body").load("include/add_workshop.php", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Tambah Workshop");
                $(".modal .modal-footer #saveworkshop").text("Simpan");
                $(".modal").modal("show");
            });
        });

        $(document).on("click", "#editworkshop", function () {  
            let table = $(document).find("#table_workshop").DataTable();
            let row = $(this).closest('tr');
            let tr = table.row(row).data();

            let id = $(this).data('id');
            $(".modal .modal-title").attr("data-workshop", id).attr("data-branch", tr.branch_id);
            $(".modal .modal-body").load("include/add_workshop.php", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Update Workshop");
                $(".modal .modal-footer #saveworkshop").text("Update");
                $(".modal").modal("show");

                let form = $(document).find("form#add_workshop"),
                    branch_id = form.find("#branch").append('<option value="'+tr.branch_id+'" selected>'+ tr.branch +'</option>');
                    name = form.find("#name").val(tr.workshop),
                    address = form.find("#address").val(tr.address),
                    active = tr.status == 1 ? form.find("#active").prop('checked', true) : form.find("#active").prop('checked', false);
            });
        });

        $(".modal .modal-footer #saveworkshop").on("click", function () {            
            let form = $(document).find("form#add_workshop"),
                branch = form.find("#branch").val(),
                name = form.find("#name").val(),
                address = form.find("#address").val(),
                active = form.find("#active").is(":checked") == true ? 1 : 0;
            let data = {
                branch_id: branch,
                name: name,
                address: address,
                active: active
            };

            let valid = true;
            if (branch == null || name == "") {
                valid = false;
            }

            let workshopId = $(".modal .modal-title").attr("data-workshop");

            if (valid) {
                let url = workshopId != "" ? "workshop/update/"+workshopId : "workshop/store";
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
                    $(document).find("#table_workshop").DataTable().ajax.reload();
                }
            })
        }

    });

</script>