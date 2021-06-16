<div class="my-panel">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div style="display: flex; justify-content: space-between; align-item: center">
                <strong style="padding: 6px 0">Daftar Outlet</strong>
                <button class="btn btn-active btn-primary" id="addOutlet" align="right">Tambah</button>
            </div>
        </div> 
        <div class="panel-body">
            <table class="table" id="table_outlet">
                <thead>
                    <tr>
                        <th width="10%">Id Outlet</th>
                        <th>Nama Outlet</th>
                        <th>Workshop</th>
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
        getBranch();

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
                    { "data": "workshop.name" },
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
                    { "data": null, "orderable": false, "searchable": false, render: function (data, type, row) {
                        return "<button class='btn btn-info btn-xs' align='center' id='editOutlet' data-id='"+ row.id_outlet +"'>Edit</button>";
                    }, },
                ],
            });
        }

        dataTable({});

        $(document).on("click", "#addOutlet", function () {  
            $(".modal .modal-title").attr("data-outlet", "").attr("data-branch", "");
            $(".modal .modal-body").load("include/add_outlet.html", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Tambah Outlet");
                $(".modal .modal-footer #saveOutlet").text("Simpan");

                let branches = JSON.parse(localStorage.getItem("branches"));
                let body = $("html body");

                body.find("#add_outlet #branch option").remove();

                $.each(branches, function (key, obj) {  
                    let content = $('<option></option>').attr('value', obj.branch).text(obj.branch);
                    $("#add_outlet #branch").append(content);
                });
                
                let branchPlaceholder = $("select#branch").attr("placeholder"), workshopPlaceholder = $("select#workshop").attr("placeholder");
                let branchDefault = '<option value="0" disabled selected="true">'+branchPlaceholder+'</option>', workshopDefault = '<option value="0" disabled selected="true">'+workshopPlaceholder+'</option>';                
                body.find("#add_outlet #branch").append(branchDefault);
                body.find("#add_outlet #workshop").append(workshopDefault);

                body.on("change", "#add_outlet #branch", function () {
                    branch = $(this).val();
                    workshopOptions(branches, branch);
                }); 

                $(".modal").modal("show");
            });
        });

        function workshopOptions(data, branch) {
            let body = $("html body");
            body.find("#add_outlet #workshop option").remove();
            branchSelected = $.grep(data, item => item.branch === branch);

            $.each(branchSelected[0].workshop, function (key, obj) {
                let content = $('<option></option>').attr('value', obj.id).text(obj.name);
                $("html body").find("#add_outlet #workshop").append(content);
            });
        }

        $(document).on("click", "#editOutlet", function () {  
            let table = $(document).find("#table_outlet").DataTable();
            let row = $(this).closest('tr');
            let tr = table.row(row).data();
            let body = $("html body");
            let branches = JSON.parse(localStorage.getItem("branches"));

            let id = $(this).data('id');
            $(".modal .modal-title").attr("data-outlet", id).attr("data-branch", tr.cabang);
            $(".modal .modal-body").load("include/add_outlet.html", function () {  
                $(".modal .modal-dialog").addClass("modal-sm");
                $(".modal .modal-title").text("Update Outlet");
                $(".modal .modal-footer #saveOutlet").text("Update");
                body.find("#add_outlet #branch option").remove();

                $.each(branches, function (key, obj) {  
                    let content = $('<option></option>').attr('value', obj.branch).text(obj.branch);
                    $("#add_outlet #branch").append(content);
                });

                let form = $(document).find("form#add_outlet"),
                    branch = form.find("#branch option[value='"+ tr.cabang +"']").attr('selected', true),
                    workshop = form.find("#workshop").append('<option value="'+tr.workshop.id+'" selected>'+ tr.workshop.name +'</option>'),
                    name = form.find("#name").val(tr.nama_outlet),
                    telp = form.find("#telp").val(tr.telpon),
                    address = form.find("#address").val(tr.alamat),
                    active = tr.status == 1 ? form.find("#active").prop('checked', true) : form.find("#active").prop('checked', false);

                body.on("change", "#add_outlet #branch", function () {
                    branch = $(this).val();
                    
                    workshopOptions(branches, branch);
                }); 

                $(".modal").modal("show");
            
            });
        });

        $(".modal .modal-footer #saveOutlet").on("click", function () {            
            let form = $(document).find("form#add_outlet"),
                branch = form.find("#branch").val(),
                workshopId = form.find("#workshop").val(),
                workshop = form.find("#workshop option[value="+workshopId+"]").text(),
                name = form.find("#name").val(),
                telp = form.find("#telp").val(),
                address = form.find("#address").val(),
                active = form.find("#active").is(":checked") == true ? 1 : 0;
            let data = {
                branch: branch,
                workshopId: workshopId,
                workshop: workshop,
                name: name,
                telp: telp,
                address: address,
                active: active
            };

            let valid = true;
            if (branch == null || name == "" || telp == "") {
                valid = false;
            }

            let outletIdtitle = $(".modal .modal-title").attr("data-outlet");

            if (valid) {
                $(document).find("#table_outlet").DataTable().ajax.reload();
                let url = outletIdtitle != "" ? "Outlet/update/"+outletIdtitle : "Outlet/store";
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

        $("html body").on("blur keyup keypress, #add_outlet #telp", function () {
            $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        function getBranch() {
            let token = $('meta[name=branch_token]').attr('content');
            $.ajax({
                url: apiURL + "Branch/lists",
                method: 'POST',
                beforeSend: function (xhr) {  
                    xhr.setRequestHeader("Authorization", token);
                    localStorage.removeItem("branches");
                },
                success: function (response) {
                    data = response.data;
                    localStorage.setItem("branches", JSON.stringify(data));
                }
            });
        }

    });

</script>