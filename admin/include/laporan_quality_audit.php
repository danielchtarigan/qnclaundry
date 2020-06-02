                        <div class="panel-heading">
                            Laporan Quality Audit
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                        <div class="form-group input-group">
                                        	<input type="hidden" name="menu" value="quality_audit" />
                                            <input type="text" class="form-control" placeholder="Search here.." name="key">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <form role="form">
                                	<input type="hidden" name="menu" value="quality_audit" />

  				                <div class="form-group">
                                   <label class="control-label col-xs-2" for="voucher">Nama Karyawan</label>                                   <div class="col-xs-3" >
                                	<select name="karyawan" id="karyawan" class="form-control">
                                      <option value="">ALL</option>
                                      <?php
                                      $user = mysqli_query($con, "select * from user");
									  while ($ruser=mysqli_fetch_array($user)){
	                                  ?>
                                          <option value="<?php echo $ruser['name']; ?>"><?php echo $ruser['name'];?></option>
									  <?php
									  }
									  ?>
                                    </select>     
                                   </div>
                                   
                                </div>

<br /><br /><br /><br />
  				                <div class="form-group">
                                   <label class="control-label col-xs-2" for="voucher">Tanggal Awal</label>
		                <div class="form-group input-group date form_date col-md-2" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="padding-left:0px;">
	                    <input class="form-control" size="10" type="text" name="tgl_awal" id="tgl_awal">
					     <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>                    
                                </div>

   				                <div class="form-group">
                                   <label class="control-label col-xs-2" for="voucher">Tanggal Akhir</label>
		                				<div class="form-group input-group date form_date col-md-2" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="padding-left:0px;">
	                    <input class="form-control" size="10" type="text" name="tgl_akhir" id="tgl_akhir">
					     <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                				</div>                    
                                </div>



                                <div class="col-lg-3">
                                        <div class="form-group input-group">
											<input type="submit" class="btn btn-success btpotongan" value="Cari" />
                                        </div>
                                </div>
                            </form>

                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                            <br>
                            <div class="table-responsive">
                            <?php
							   if (isset($_GET['karyawan'])){																					
									if ($_GET['karyawan']<>''){											
?>

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Karyawan</th>
                                            <th>Level</th>
                                            <th>POIN</th>
                                            <th>Star</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$no = 1;
										$qcustomer = mysqli_query($con, "select * from user where level<>'admin' and level<>'reception' and name='$_GET[karyawan]' order by level");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $rcustomer['name']; ?></td>
                                            <td><?php echo $rcustomer['level']; ?></td>
                                            <td>
											<?php
											if ($rcustomer['level']=='operator'){
											$qhit = mysqli_query($con, "select *, avg(bersih) as avg_bersih, count(bersih) as c_bersih, sum(bersih) as t_bersih from quality_audit a, reception b where a.no_nota=b.no_nota and b.op_cuci='$rcustomer[name]' and a.tgl_input between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]'");
											$rhit = mysqli_fetch_array($qhit);											 
											$poin = round($rhit['avg_bersih'],2);
											}
											if ($rcustomer['level']=='setrika'){
											$qhit = mysqli_query($con, "select *, avg(rapi) as avg_rapi from quality_audit a, reception b where a.no_nota=b.no_nota and b.user_setrika='$rcustomer[name]' and a.tgl_input between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]'");
											$rhit = mysqli_fetch_array($qhit);											 
											$poin = round($rhit['avg_rapi'],2);
											}
											if ($rcustomer['level']=='packer'){
											$qhit = mysqli_query($con, "select *, avg(harum) as avg_harum from quality_audit a, reception b where a.no_nota=b.no_nota and b.user_packing='$rcustomer[name]' and a.tgl_input between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]'");
											$rhit = mysqli_fetch_array($qhit);											 
											$poin = round($rhit['avg_harum'],2);
											}
											if ($_GET['tgl_awal']>'2016-03-31'){
												$point = $poin;
											}
											else{
												$point = $poin/2;
											}
											echo $point;
											?>
                                            </td>
                                            <td align="left" style="background-image:url(image/star_back.jpg); background-position:center; background-repeat:no-repeat; padding-top:7px; padding-left:0px;" width="130px;" heigh="25px;">
                                            <?php
											if ($_GET['tgl_awal']>'2016-03-31'){
												$persen = $poin/5;
											}
											else{
												$persen = $poin/10;
											}
											if ($poin>0){
												$panjang = $persen*135;
												?>
                                                <div style="width:<?php echo $panjang; ?>px; text-align:left; float:left; background-image:url(image/star_show.jpg); height:25px; margin-left:0px;">&nbsp;
                                                </div>

                                                <?php
											}
                                            ?>
                                            </td>
                                        </tr>
									<?php
									$no++;	
										}
									?>
                                    </tbody>
                                </table>

<?php									}
									else{
?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Karyawan</th>
                                            <th>Level</th>
                                            <th>POIN</th>
                                            <th>Star</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$no = 1;
										$qcustomer = mysqli_query($con, "select * from user where level<>'admin' and level<>'reception' order by level");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $rcustomer['name']; ?></td>
                                            <td><?php echo $rcustomer['level']; ?></td>
                                            <td>
											<?php
											if ($rcustomer['level']=='operator'){
											$qhit = mysqli_query($con, "select *, avg(bersih) as avg_bersih, count(bersih) as c_bersih, sum(bersih) as t_bersih from quality_audit a, reception b where a.no_nota=b.no_nota and b.op_cuci='$rcustomer[name]' and a.tgl_input between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]'");
											$rhit = mysqli_fetch_array($qhit);											 
											$poin = round($rhit['avg_bersih'],2);
											}
											if ($rcustomer['level']=='setrika'){
											$qhit = mysqli_query($con, "select *, avg(rapi) as avg_rapi from quality_audit a, reception b where a.no_nota=b.no_nota and b.user_setrika='$rcustomer[name]' and a.tgl_input between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]'");
											$rhit = mysqli_fetch_array($qhit);											 
											$poin = round($rhit['avg_rapi'],2);
											}
											if ($rcustomer['level']=='packer'){
											$qhit = mysqli_query($con, "select *, avg(harum) as avg_harum from quality_audit a, reception b where a.no_nota=b.no_nota and b.user_packing='$rcustomer[name]' and a.tgl_input between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]'");
											$rhit = mysqli_fetch_array($qhit);											 
											$poin = round($rhit['avg_harum'],2);
											}
											if ($_GET['tgl_awal']>'2016-03-31'){
												$point = $poin;
											}
											else{
												$point = $poin/2;
											}
											echo $point;
											?>
                                            </td>
                                            <td align="left" style="background-image:url(image/star_back.jpg); background-position:center; background-repeat:no-repeat; padding-top:7px; padding-left:0px;" width="130px;" heigh="25px;">
                                            <?php
											if ($_GET['tgl_awal']>'2016-03-31'){
												$persen = $poin/5;
											}
											else{
												$persen = $poin/10;
											}
											if ($poin>0){
												$panjang = $persen*135;
												?>
                                                <div style="width:<?php echo $panjang; ?>px; text-align:left; float:left; background-image:url(image/star_show.jpg); height:25px; margin-left:0px;">&nbsp;
                                                </div>

                                                <?php
											}
                                            ?>
                                            </td>
                                        </tr>
									<?php
									$no++;	
										}
									?>
                                    </tbody>
                                </table>
<?php										
										}										
							   }
							?>
<!--
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Resepsionis</th>
                                            <th>No Nota</th>
                                            <th>Nama Customer</th>
                                            <th>Bersih</th>
                                            <th>Rapih</th>
                                            <th>Harum</th>
                                            <th>Jumlah</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										if (isset($_GET['key'])){
										$no = 1;
										$qcustomer = mysqli_query($con, "select * from quality_audit a, reception b where a.no_nota=b.no_nota and a.no_nota like '%$_GET[key]%' or a.nama_customer like '%$_GET[key]%' order by a.id desc limit 0,20");
										}
										else if (isset($_GET['karyawan'])){
										$no = 1;
										$qcustomer = mysqli_query($con, "select * from quality_audit a, reception b where a.no_nota=b.no_nota and b.op_cuci='$_GET[karyawan]' and b.op_pengering='$_GET[karyawan]' and b.user_setrika='$_GET[karyawan]' and b.user_packing='$_GET[karyawan]' and a.tgl_input between '$_GET[tgl_awal]' and '$_GET[tgl_akhir]' order by a.id desc limit 0,20");
										}
										else
										{
										$no = 1;
										$qcustomer = mysqli_query($con, "select * from quality_audit a, reception b where a.no_nota=b.no_nota order by a.id desc limit 0,20");
										}
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $rcustomer['user_input']; ?></td>
                                            <td><?php echo $rcustomer['no_nota']; ?></td>
                                            <td><?php echo $rcustomer['nama_customer']; ?></td>
                                            <td align="center">
											<?php echo $rcustomer['bersih']; ?><br />
                                            <?php echo $rcustomer['op_cuci']; ?>(Cuci)<br />
                                            <?php echo $rcustomer['op_pengering']; ?>(Kering)
                                            </td>
                                            <td align="center">
											<?php echo $rcustomer['rapi']; ?><br />
                                            <?php echo $rcustomer['user_setrika']; ?>(Setrika)<br />
                                            </td>
                                            <td align="center"><?php echo $rcustomer['harum']; ?><br />
                                            <?php echo $rcustomer['user_packing']; ?>(Packing)
                                            </td>
                                            <td><?php echo $rcustomer['jumlah']; ?></td>
                                            <td><?php echo $rcustomer['waktu']; ?></td>
                                        </tr>
									<?php
									$no++;	
										}
									?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
-->                        