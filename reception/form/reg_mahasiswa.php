<?php
include '../config.php';

$id = $_GET['id1'];
$sql  = $con->query("select * from customer WHERE id = '$id'");
$r    = $sql->fetch_assoc();
$ot   = $_SESSION['nama_outlet'];

?>		
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Registrasi Member Mahasiswa</strong></div>
				<div class="panel-body">					
					<form class="form-horizontal" action="act/reg_mahasiswa.php" method="post">
						<div class="form-group">
							<label for="telepon" class="control-label col-sm-3">ID</label>
							<div class="col-sm-6">
								<input type="number" class="form-control" id="idcst" name="idcst" value="<?php echo $r['id'];?>" required placeholder="">								
							</div>
						</div>
						<div class="form-group">
							<label for="telepon" class="control-label col-sm-3">No Telepon</label>
							<div class="col-sm-6">
								<input type="number" class="form-control" id="telepon" name="telepon" maxlength="13" value="<?php echo $r['no_telp'];?>" required placeholder="">								
							</div>
						</div>						
						<div class="form-group">
							<label for="nama" class="control-label col-sm-3">Nama</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $r['nama_customer'];?>"required placeholder="Nama Mahasiswa">								
							</div>
						</div>
						<div class="form-group">
							<label for="alamat" class="control-label col-sm-3">Alamat</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $r['alamat'];?>" required placeholder="tempat tinggal">								
							</div>
						</div>
						<div class="form-group">
							<label for="tl" class="control-label col-sm-3">Tanggal Lahir</label>
							<div class="col-sm-6">
								<input type="date" class="form-control" id="tl" name="tl" required placeholder="">								
							</div>
						</div>												
						<div class="form-group">
							<label for="sekolah" class="control-label col-sm-3">Perguruan Tinggi</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="sekolah" name="sekolah" required placeholder="nama perguruan tinggi">								
							</div>
						</div>
						<div class="form-group">
							<label for="stb" class="control-label col-sm-3">Nomor Stambuk</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" rows="3" id="stb" name="stb" placeholder="lihat di kartu mahasiswanya">								
							</div>
						</div>					
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<button type="submit" class="btn btn-success btn-md" id="kirim" name="kirim" >Kirim</button>						
								<button type="reset" class="btn btn-danger btn-md" id="reset">Reset</button>								
							</div>
						</div>
						
					</form>
				</div>
			</div>
			
				
					
				