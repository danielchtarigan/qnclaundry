                        <div class="panel-heading">
                            Support Ticket <a href="index.php?menu=add_ticket"><button type="button" class="btn btn-primary btn-xs">Add New Support Ticket</button></a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Title</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
					$qcustomer = mysqli_query($con, "select * from ticket where outlet='$ot'");
					while ($rcustomer = mysqli_fetch_array($qcustomer)){	
				    ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $rcustomer['kode']; ?></td>
                                            <td><?php echo $rcustomer['title']; ?></td>
                                            <td><?php echo $rcustomer['date']; ?></td>											 
                                            <td><?php echo $rcustomer['status']; ?></td>											 
                                        </tr>
				    <?php	
					}
				    ?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>