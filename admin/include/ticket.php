<?php
if (isset($_GET['kode'])){
$kode = $_GET['kode'];
?>
<div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Chat Support Ticket No. <?php echo $kode; ?>
                            <div class="btn-group pull-right">
<!--
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i> Refresh
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-check-circle fa-fw"></i> Available
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-times fa-fw"></i> Busy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-clock-o fa-fw"></i> Away
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                        </a>
                                    </li>
                                </ul>
-->
                            </div>
                        </div>
                        <div class="panel-body">
                            <ul class="chat">
                                <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                        <img  src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">Jack Sparrow</strong>
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 12 mins ago
                                            </small>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                                <li class="right clearfix">
                                    <span class="chat-img pull-right">
                                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> 13 mins ago</small>
                                            <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                        </div>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                        </p>
                                    </div>
                                </li>
                            </ul>
</div>
<div class="panel-footer">
                            <form action="">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat">
                                        Send
                                    </button>
                                </span>
                            </div>
                            </form>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
<?php
}
?>
                        <div class="panel-heading">
                            <strong>All Ticket</strong>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Kode Ticket</th>
                                            <th>Outlet</th>
                                            <th>Title</th>
                                            <th>Tanggal</th>
                                            <th>Resepsionis</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
					$qcustomer = mysqli_query($con, "select * from ticket order by status");
					while ($rcustomer = mysqli_fetch_array($qcustomer)){	
					?>					
                                        <tr class="odd gradeX">
                                            <td><a href="index.php?menu=ticket&kode=<?php echo $rcustomer['kode']; ?>"><?php echo $rcustomer['kode']; ?></a></td>
                                            <td><?php echo $rcustomer['outlet']; ?></td>
                                            <td><?php echo $rcustomer['title']; ?></td>
                                            <td><?php echo $rcustomer['date']; ?></td>
                                            <td><?php echo $rcustomer['rcp']; ?></td>
                                            <td><?php echo $rcustomer['status']; ?></td>                                            
                                        </tr>
                                        
					<?php	
					}
					?>
                                    </tbody>
                                </table>
                            </div>                            
                        </div>