<?php
include "../config.php";
include "header.php";
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-12 col-lg-offset-0 main">	
<hr>
<div class="row">
<div class="col-xs-12" align="center">
	<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#petunjuk">Cari Laporan</button>

<div class="modal fade" id="petunjuk" tabindex="-1" role="dialog" aria-labelledby="isi petunjuk">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-tittle"  id="isiPetunjuk">Laporan Admin QnC</h3>
					</div>
					<div class="modal-body">
						<h4>Pencarian Tanggal</h4>
							<form class="form-inline" method="post" action="report_admin.php">
								<div class="form-group">
									<label for="date">Dari</label>
									<input type="date" class="form-control" name="tgl" id="tgl" placeholder="tanggal" required="true">
								</div>							
								<div class="form-group">
									<label for="date2">Sd</label>
									<input type="date" class="form-control" name="tgl2" id="tgl2" placeholder="tanggal" required="true">
								</div>
								<button type="submit" class="btn btn-succes" value="cari">Cari</button>
							</form>
					</div>
			</div>
		</div>
	</div>
</div>
</div>					
		
</div><!--/.main-->