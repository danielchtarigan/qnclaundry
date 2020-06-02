<style type="text/css">
	th{
		text-align: center
	}
</style>

<div class="app-title">
<div>
  <h1><i class="fa fa-laptop"></i> Control</h1>
  <p>User </p>
</div>
<ul class="app-breadcrumb breadcrumb side">
  <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
  <li class="breadcrumb-item">Control</li>
  <li class="breadcrumb-item active"><a href="#">Daftar User</a></li>
</ul>
</div>

 <div class="row user" style="margin-top: -20px">
 	<div class="col-md-3">
       <div class="tile p-0">
  		<ul class="nav nav-tabs user-tabs flex-column">
          <li class="nav-item"><a class="nav-link active" href="#daftar" data-toggle="tab"><h5>Daftar User</h5></a></li>
          <li class="nav-item"><a class="nav-link" href="#tambah" data-toggle="tab"><h5>Tambah User</h5></a></li>
        </ul>
		</div>
    </div>

    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="daftar">
            	<div class="tile user-settings">
			      <div class="table-responsive" style="overflow-x:auto">
					<table class="table table-striped table-condensed" id="" style="width: 100%; margin:0 auto;">
						<thead>
							<tr>
								<th width="10%">User Id</th>
								<th>Nama User</th>
								<th width="25%">Email</th>
								<th>Level</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sql = $con->query("SELECT * FROM user WHERE cabang='$cabang' AND outlet='$outlet' AND aktif='Ya'");
							while($data = $sql->fetch_array()){
								$level = ($data['level']=="admin2") ? "Admin" : ucwords($data['level']);
								echo '
								<tr>
									<td>'.$data['user_id'].'</td>
									<td>'.$data['name'].'</td>
									<td>'.$data['email'].'</td>
									<td>'.$level.'</td>
									<td align="center"><a href="#" class="btn btn-sm btn-primary sunting" title="Sunting" id="'.$data['user_id'].'"><i class="app-menu__icon fa fa-edit"></i></a> <a href="#" class="btn btn-sm btn-danger remove" title="Hapus" id="'.$data['user_id'].'"><i class="app-menu__icon fa fa-times"></i></a></td>
								</tr>
								';

							}

							?>	
						</tbody>
					</table>
				 </div>	
				</div>  
			</div>

			<div class="tab-pane fade" id="tambah">
				
				<div class="tile">
		            <div class="tile-body">
		              <form class="form-horizontal" action="process/user.php" method="POST">
		                <div class="form-group row">
		                  <label class="control-label col-md-3">Nama User</label>
		                  <div class="col-md-8">
		                    <input class="form-control col-md-8" type="text" placeholder="Enter username" name="username" required="true" autocomplete="off">
		                    <span id="g"></span>
		                  </div>
		                  
		                </div>
		                <div class="form-group row">
		                  <label class="control-label col-md-3">Email</label>
		                  <div class="col-md-8">
		                    <input class="form-control col-md-8" type="email" placeholder="Enter email address" name="email">
		                  </div>
		                </div>
		                <div class="form-group row">
		                  <label class="control-label col-md-3">Password</label>
		                  <div class="col-md-8">
		                    <input class="form-control col-md-8" type="password" placeholder="Enter password" name="password" required="" autocomplete="off">
		                  </div>
		                </div>		               
		                <div class="form-group row">
		                  <label class="control-label col-md-3">Level</label>
		                  <div class="col-md-9">
		                  	<div class="animated-radio-button">
		                      <label class="form-check-label">
		                        <input class="form-check-input" type="radio" name="level" required="" value="admin2"><span class="label-text">Admin</span>
		                      </label>
		                    </div>
		                    <div class="animated-radio-button">
		                      <label class="form-check-label">
		                        <input class="form-check-input" type="radio" name="level" required="" value="reception"><span class="label-text">Reception</span>
		                      </label>
		                    </div>
		                    <div class="animated-radio-button">
		                      <label class="form-check-label">
		                        <input class="form-check-input" type="radio" name="level" required="" value="mitra"><span class="label-text">Mitra</span>
		                      </label>
		                    </div>
		                    <div class="animated-radio-button">
		                      <label class="form-check-label">
		                        <input class="form-check-input" type="radio" name="level" required="" value="setrika"><span class="label-text">Setrika</span>
		                      </label>
		                    </div>
		                  </div>
		                </div>	

		                <div class="form-group row tile-footer">
		                  <div class="col-md-8">
		                    <button class="btn btn-success" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>
		                  </div>
		                </div>	                
		                
		              </form>		              
		            </div>
		          </div>

			</div>

		</div>    
	</div>
</div>


<script type="text/javascript" src="js/plugins/sweetalert.min.js"></script>
<script type="text/javascript">
	$(function(){

		$('input[name=username]').blur(function(){

			username = $(this).val();			

			$.ajax({
				data 	: "username="+username+"&userPost=cekname",
				type 	: "POST",
				url 	: "process/user.php",
				success : function(data){
					if(data=="Username tersedia"){
						$('#g').text(data).css( "display", "inline" ).css('color', 'green').fadeOut( 1000 );
					}
					else {
						$('#g').text(data).css( "display", "inline" ).css('color', 'red');
					}
					
				}
			})			

		});

		$('.sunting').click(function(){
			id = $(this).attr('id');

			$.ajax({
				data 	: 'id='+id+'&userPost=sunting',
				type 	: 'POST',
				url 	: 'process/user.php',
				success : function(data){
					$('#daftar').html(data);
				}

			})

		});

		$('.remove').click(function(){
			id = $(this).attr('id');
	      	swal({
	      		title: "Anda yakin?",
	      		text: "Anda tidak bisa mengembalikan user ini lagi!",
	      		type: "warning",
	      		showCancelButton: true,
	      		confirmButtonText: "Ya, hapus user ini!",
	      		cancelButtonText: "Tidak, Batalkan!",
	      		closeOnConfirm: false,
	      		closeOnCancel: false
	      	}, function(isConfirm) {
	      		if (isConfirm) {

					$.ajax({
						data 	: 'id='+id+'&userPost=remove',
						type 	: 'POST',
						url 	: 'process/user.php',
						success : function(data){
							swal("Terhapus!", "User berhasil dihapus.", "success");
							window.location = "?r=control&v=daftar-user";
						}

					});
	      			
	      		} else {
	      			swal("Dibatalkan", "User tidak jadi dihapus :)", "error");
	      		}
	      	});
	      });
	})
</script>