                        <div class="panel-heading">
                            Data Pengambilan Nota
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="index.php" method="get">
                                        <div class="form-group input-group">
                                        <input type="hidden" name="id" value="<?php echo  $_GET['id']; ?>" />
                                        <input type="hidden" name="menu" value="ambil" />
                                            <input type="text" class="form-control" placeholder="Search here.." name="key">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No Scan</th>
                                            <th>No Nota</th>
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($_GET['key'])){
										$key = $_GET['key'];
										$qcustomer = mysqli_query($con, "select * from reception where ambil='0' and packing='1' and no_nota='$key' or new_nota='$key'");
										$rcustomer = mysqli_fetch_array($qcustomer);
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $key; ?></td>
                                            <td><?php echo $rcustomer['no_nota']; ?></td>
                                            <td>
                                             <a href="save_ambil.php?no_nota=<?php echo $rcustomer['no_nota']; ?>"><button type="button" class="btn btn-primary btn-xs">Proses</button></a>
                                            </td>
                                        </tr>
									<?php	
										}
									else{
									?>
                                        <tr class="odd gradeX">
                                            <td colspan="6" align="center">.. Data Tidak Ada ..</td>
                                        </tr>
                                     <?php
									 }
									 ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                       