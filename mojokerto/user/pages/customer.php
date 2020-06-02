<?php
include "header.php"
?>

						<div class="panel-heading">
                            Data Pelanggan
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">								
                                    <form role="form">
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" placeholder="Search here.." name="key">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </form>
                                    <a href="add-customer.php"><button type="submit" class="btn btn-default">Add New</button></a>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>                                            
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($_GET['key'])){
										$key = $_GET['key'];
										$qcustomer = mysqli_query($con, "SELECT * FROM customer WHERE outlet='mojokerto' and (nama_customer like '%$key%' or alamat like '%$key%' or no_telp like '%$key%') limit 0,10");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){	
			                            if($rcustomer['lgn'] == '1'){
		                                    $lgn = rupiah($rcustomer['sisa_kuota']);
			                            }
			                            else
			                            {
	                                    $lgn = "";
    			                        }
																			
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $rcustomer['nama_customer']; ?></td>
                                            <td><?php echo $rcustomer['alamat']; ?></td>
                                            <td><?php echo $rcustomer['no_telp']; ?></td>                                           
                                            <td>
											 <?php
											
											$rajin = mysqli_query($con, "select * from reception where id_customer='$rcustomer[id]' and datediff(current_date(),DATE_FORMAT(tgl_ambil, '%Y-%m-%d')) <= 30");
											$rrajin = mysqli_fetch_array($rajin);
											$nrajin = mysqli_num_rows($rajin);
											if ($nrajin>0){
											?>											
                                             <a href="transaksi.php?id=<?php echo $rcustomer['id']; ?>" onclick="window.open('include/qa.php?id=<?php echo $rcustomer['id']; ?>')"><button type="button" class="btn btn-primary btn-xs">Proses</button></a>
                                             <?php
											}
											else{
											?>											
                                             <a href="transaksi.php?id=<?php echo $rcustomer['id']; ?>"><button type="button" class="btn btn-primary btn-xs">Proses</button></a>
                                             <?php
												}
                                             ?>
                                            </td>
                                        </tr>
									<?php	
										}
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
					