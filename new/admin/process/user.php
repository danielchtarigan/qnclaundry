<?php
include '../../config.php';
session_start();

$cabang = $_SESSION['cabang'];
$outlet =  $_SESSION['outlet'];

$userPost = (isset($_POST['submit'])) ? "register" : $_POST['userPost'];



switch ($userPost) {
	case 'register':

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$level = $_POST['level'];

		$sql = $con->query("SELECT * FROM user WHERE name='$_POST[username]'");
		if(mysqli_num_rows($sql)>0) {
			echo "Coba lagi dengan username lain";
		} else {
			
			$q = $con->query("INSERT INTO user (name,email,password,level,outlet,cabang,aktif,izinkan) VALUES ('$username','$email','$password','$level','$outlet','$cabang','Ya','setrika') ");

			header("location: ../?r=control&v=daftar-user");


		}

		break;

	case 'sunting':

		if(isset($_POST['sunting'])){

			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$level = $_POST['level'];
			$id = $_POST['id'];

			$q = $con->query("UPDATE user SET name='$username', email='$email', password='$password', level='$level' WHERE user_id='$id'");

			header("location: ../?r=control&v=daftar-user");
		}
		else {

			$id = $_POST['id'];

			$sql = $con->query("SELECT * FROM user WHERE user_id='$id'");
			$data = $sql->fetch_array();

			echo '
			<div class="tile">
		        <div class="tile-body">
		          <form class="form-horizontal" action="process/user.php" method="POST">
		            <div class="form-group row">
		              <label class="control-label col-md-3">Nama User</label>
		              <div class="col-md-8">
		                <input class="form-control col-md-8" type="text" placeholder="Enter username" name="username" required="true">
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
		                <input class="form-control col-md-8" type="password" placeholder="Enter password" name="password" required="">
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
		            <input class="form-control col-md-8 hide" type="text" name="userPost" value="sunting">
		            <input class="form-control col-md-8 hide" type="text" name="id" value="'.$id.'">
		            <div class="form-group row tile-footer">
		              <div class="col-md-8">
		                <button class="btn btn-primary" type="submit" name="sunting"><i class="fa fa-fw fa-lg fa-check-circle"></i>Sunting</button>&nbsp; &nbsp;<a class="btn btn-secondary cancel" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
		              </div>
		            </div>	                
		            
		          </form>		              
		        </div>
		      </div>
			';

			?>
			<script type="text/javascript">
				var username = '<?= $data['name'] ?>';
				var email = '<?= $data['email'] ?>';
				var password = '<?= $data['password'] ?>';
				var level = '<?= $data['level'] ?>';

				$('input[name=username]').val(username);
				$('input[name=email]').val(email);
				$('input[name=password]').val(password);
				$('input[name=level][value='+level+']').prop('checked', true);

				$('.hide').hide();

				$('.cancel').click(function(){
					window.location = "";
				})
			</script>

			<?php
		}

			

		break;
		

	case 'remove':

		$id = $_POST['id'];

		$sql = $con->query("UPDATE user SET aktif='tidak' WHERE user_id='$id'");
		header("location: ../?r=control&v=daftar-user");

		break;

	case 'cekname':

		if($_POST['username']!=""){
			$sql = $con->query("SELECT * FROM user WHERE name='$_POST[username]'");
			if(mysqli_num_rows($sql)>0) {
				echo "Coba lagi dengan username lain";
			} else {
				echo "Username tersedia";
			}
		}
		
		break;
}

