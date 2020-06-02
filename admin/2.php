<?php
include "header.php";
include '../config.php';
?>
<div  style=" margin-top:100px;margin-bottom:50px; color:#000000;">
<form action="up.php" method="post">
  									<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
									<input name="delete" type="submit" id="delete" value="Update">									
										<thead>
										  <tr>
												<th></th>
												<th>id</th>
												<th>tgl masuk</th>
												<th>no_nota</th>
												<th>cuci</th>
												<th>pengering</th>
												<th>setrika</th>
												<th>packing</th>
												<th>kembali</th>
												
										
												<th></th>
										   </tr>
										</thead>
										<tbody>
													<?php
													$user_query = mysqli_query($con,"select * from reception where kembali=false or pengering=false")or die(mysql_error());
													while($row = mysqli_fetch_array($user_query)){
													$id = $row['id'];
													?>
									
												<tr>
												<td width="30">
												<input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
												<td><?php echo $row['id']; ?></td>
												<td><?php echo $row['tgl_input']; ?></td>
	
												<td><?php echo $row['no_nota']; ?></td>
												<td><?php echo $row['cuci']; ?></td>
												<td><?php echo $row['pengering']; ?></td>
												<td><?php echo $row['setrika']; ?></td>
												<td><?php echo $row['packing']; ?></td>
												<td><?php echo $row['kembali']; ?></td>
												
											    
												<td width="120">
												<a rel="tooltip"  title="Edit Client" id="e<?php echo $id; ?>" href="edit_client.php<?php echo '?id='.$id; ?>"  data-toggle="modal" class="btn btn-success"><i class="icon-pencil icon-large"> Edit Info</i></a>
												</td>
		
									
												</tr>
												<?php } ?>
										</tbody>
																		
									</table>
									
									</form>
									</div>