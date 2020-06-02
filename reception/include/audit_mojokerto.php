                        <div class="panel-heading">
                            <strong><a href='index.php?menu=audit'>MAKASSAR</a></strong> |
                            <strong><a href='index.php?menu=audit_mojokerto'>MOJOKERTO</a></strong> |
							<strong><a href='index.php?menu=audithariini'>QUALITY AUDIT HARI INI</a></strong>
                        </div>
                        <div class="panel-body">
                            <!-- /.row (nested) -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Tangal Packing</th>
                                            <th>No. Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										$tgl_ambil = date('Y-m-d h:i:s',strtotime('-144 hours'));
                                    	$qcustomer = mysqli_query($con, "select * from reception a, customer b where a.id_customer=b.id and a.nama_outlet='mojokerto' and a.tgl_packing>='$tgl_ambil' order by rand() limit 0,20");
										while ($rcustomer = mysqli_fetch_array($qcustomer)){
											$qcs = mysqli_query($con, "select * from quality_audit where no_nota='$rcustomer[no_nota]'");
											$ncs = mysqli_num_rows($qcs);
											if ($ncs>0){
											}
											else{
										?>
                                        <tr class="odd gradeX">
                                            <td><a href="index.php?menu=qualityaudit&cari=<?php echo $rcustomer['no_nota']; ?>"><?php echo $rcustomer['nama_customer']; ?></a></td>
                                            <td><?php echo $rcustomer['alamat']; ?></td>
                                            <td><?php echo $rcustomer['no_telp']; ?></td>
                                            <td><?php echo $rcustomer['tgl_packing']; ?></td>                                            
											<td><?php echo $rcustomer['no_nota']; ?></td>                                            
                                        </tr>
										<?php	
											}
										}
										?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>