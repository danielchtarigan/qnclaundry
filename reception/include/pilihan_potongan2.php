<?php
include '../../config.php';
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d h:i:s");	 
?>
									<form method="get" name="form10" id="form10">
                                        <div class="form-group">                                        
                                            	<input type="text" name="notanew10" id="notanew10" value="" class="form-control" placeholder="No Nota (Auto)"/>      											
                                        </div>
                                        <div class="form-group">                                        
                                                <label class="control-label col-xs-3" for="Kiloan">
                                                   Item
                                                </label>
                                                <div class="col-xs-9" >
													<?php
													$cek = mysqli_query($con, "select * from customer where id='$_GET[id]'");											
													$rsql = mysqli_fetch_array($cek);
													if ($rsql['member']==1 && $rsql['tgl_akhir'] >= $jam1  ){
													?>
													<select name="itemklp10" class="form-control" id="itemklp10" onchange="fitem10()">
													<option value="">Pilih Item</option>
													<?php													 
														$cek_tmp = mysqli_query($con, "select * from order_potongan_tmp where id_customer='$_GET[id]' order by id desc limit 0,1");														
														$ncek_tmp = mysqli_num_rows($cek_tmp);
														if ($ncek_tmp > 0){
															$rcek_tmp = mysqli_fetch_array($cek_tmp);
															$newkat = mysqli_query($con, "select * from item_spk where nama_item='$rcek_tmp[item]'");											
															$rnew_kat = mysqli_fetch_array($newkat);
															$qkat = mysqli_query($con, "select * from item_spk where jenis_item='p' and kategory='$rnew_kat[kategory]' and kategory<>'' group by kategory order by kategory asc");
														}
														else{
															$qkat = mysqli_query($con, "select * from item_spk where kategory<>'' and jenis_item='p' group by kategory order by kategory asc");
														}
														
														while ($rkat = mysqli_fetch_array($qkat)){
															if ($rkat['kategory']=='5'){
																$kategorynew = 'Bedding';																
															}
															else if ($rkat['kategory']=='6'){
																$kategorynew = 'Chlothes';																
															}
															else if ($rkat['kategory']=='7'){
																$kategorynew = 'Doll';																
															}
															else if ($rkat['kategory']=='8'){
																$kategorynew = 'Gordyn';																
															}
															else if ($rkat['kategory']=='9'){
																$kategorynew = 'Carpet';																
															}
															else{
																$kategorynew = 'Other';																
															}															
															?>
															<option value="" disabled><?php echo $kategorynew; ?></option>														
															<?php
															$qkatkat = mysqli_query($con, "select * from item_spk where kategory='$rkat[kategory]'");
															while ($rkatkat = mysqli_fetch_array($qkatkat)){
															?>
															<option value="<?php echo $rkatkat['nama_item']."-".$rkatkat['disk']; ?>"><?php echo "&nbsp&nbsp&nbsp".$rkatkat['nama_item']; ?></option>
															<?php														
															}
												        }
													?>
													</select>
													<?php	
													}
													else if ($rsql['lgn']==1){
													?>
													<select name="itemklp10" class="form-control" id="itemklp10" onchange="fitem10()">
                                                 	<option value=""></option>													
													<?php													 
														$cek_tmp = mysqli_query($con, "select * from order_potongan_tmp where id_customer='$_GET[id]' order by id desc limit 0,1");														
														$ncek_tmp = mysqli_num_rows($cek_tmp);
														if ($ncek_tmp > 0){
															$rcek_tmp = mysqli_fetch_array($cek_tmp);
															$newkat = mysqli_query($con, "select * from item_spk where nama_item='$rcek_tmp[item]'");											
															$rnew_kat = mysqli_fetch_array($newkat);
															$qkat = mysqli_query($con, "select * from item_spk where jenis_item='p' and kategory='$rnew_kat[kategory]' and kategory<>'' group by kategory order by kategory asc");
														}
														else{
															$qkat = mysqli_query($con, "select * from item_spk where kategory<>'' and jenis_item='p' group by kategory order by kategory asc");
														}
														
														while ($rkat = mysqli_fetch_array($qkat)){
															if ($rkat['kategory']=='5'){
																$kategorynew = 'Bedding';																
															}
															else if ($rkat['kategory']=='6'){
																$kategorynew = 'Chlothes';																
															}
															else if ($rkat['kategory']=='7'){
																$kategorynew = 'Doll';																
															}
															else if ($rkat['kategory']=='8'){
																$kategorynew = 'Gordyn';																
															}
															else if ($rkat['kategory']=='9'){
																$kategorynew = 'Carpet';																
															}
															else{
																$kategorynew = 'Other';																
															}															
															?>
															<option value="" disabled><?php echo $kategorynew; ?></option>														
															<?php
															$qkatkat = mysqli_query($con, "select * from item_spk where kategory='$rkat[kategory]'");
															while ($rkatkat = mysqli_fetch_array($qkatkat)){
																if($rkatkat['pot_lgn']==82){
																	$hargak = $rkatkat['harga']*0.82;
																}else{
																	$hargak = $rkatkat['harga'];
																}
															?>
															<option value="<?php echo $rkatkat['nama_item']."-".$hargak; ?>"><?php echo "&nbsp&nbsp&nbsp".$rkatkat['nama_item']; ?></option>
															<?php														
															}
												        }
													?>
													</select>
													<?php	
													}
													else
													{
													?>													
													<select name="itemklp10" class="form-control" id="itemklp10" onchange="fitem10()">
                                                 	<option value=""></option>													
													<?php													 
														$cek_tmp = mysqli_query($con, "select * from order_potongan_tmp where id_customer='$_GET[id]' order by id desc limit 0,1");														
														$ncek_tmp = mysqli_num_rows($cek_tmp);
														if ($ncek_tmp > 0){
															$rcek_tmp = mysqli_fetch_array($cek_tmp);
															$newkat = mysqli_query($con, "select * from item_spk where nama_item='$rcek_tmp[item]'");											
															$rnew_kat = mysqli_fetch_array($newkat);
															$qkat = mysqli_query($con, "select * from item_spk where jenis_item='p' and kategory='$rnew_kat[kategory]' and kategory<>'' group by kategory order by kategory asc");
														}
														else{
															$qkat = mysqli_query($con, "select * from item_spk where kategory<>'' and jenis_item='p' group by kategory order by kategory asc");
														}
														
														while ($rkat = mysqli_fetch_array($qkat)){
															if ($rkat['kategory']=='5'){
																$kategorynew = 'Bedding';																
															}
															else if ($rkat['kategory']=='6'){
																$kategorynew = 'Chlothes';																
															}
															else if ($rkat['kategory']=='7'){
																$kategorynew = 'Doll';																
															}
															else if ($rkat['kategory']=='8'){
																$kategorynew = 'Gordyn';																
															}
															else if ($rkat['kategory']=='9'){
																$kategorynew = 'Carpet';																
															}
															else{
																$kategorynew = 'Other';																
															}															
															?>
															<option value="" disabled><?php echo $kategorynew; ?></option>														
															<?php
															$qkatkat = mysqli_query($con, "select * from item_spk where kategory='$rkat[kategory]'");
															while ($rkatkat = mysqli_fetch_array($qkatkat)){
																
																//cek customer vide view
																$sqlvv = mysqli_query($con, "SELECT * FROM customer WHERE id='$_GET[id]' AND alamat LIKE '%vida view%'");
																$rview = mysqli_fetch_array($sqlvv);
																$nView = mysqli_num_rows($sqlvv);

																if($nView>0){
																	if($rkatkat['id']=="2"){
																		$hargaItem = 15000;
																	}
																	else if($rkatkat['id']=="4" OR $rkatkat['id']=="3"){
																		$hargaItem = 12000;
																	}
																	else {
																		$hargaItem = $rkatkat['harga'];
																	}
																} else {
																	$hargaItem = $rkatkat['harga'];
																}

															?>
															<option value="<?php echo $rkatkat['nama_item']."-".$hargaItem; ?>"><?php echo "&nbsp&nbsp&nbsp".$rkatkat['nama_item']; ?></option>
															<?php														
															}
												        }
													?>
													</select>
													<?php
													}
													?>
                                                </div><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Harga Satuan
                                                </label>
                                                <div class="col-xs-9" >
                                                <input type="hidden" name="item10" id="item10"/>
                                                <input type="text" id="harga10" name="harga10" class="form-control" placeholder="0" width="100%" required="required" onmousemove="fharga10()">
                                                </div><br />
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Jumlah
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="jumlah10" name="jumlah10" class="form-control" value='1' width="100%" onfocus="fharga10()" required="required">
                                                </div><br />
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Ket Item
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="ket10" name="ket10" class="form-control" placeholder="keterangan item" width="100%">
                                                </div><br /><br>
                                        </div>
                                        <input type="hidden" name="jenis" id="jenis" value="<?php echo $_GET['jenis'];?>" />
										<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $_GET['id'] ?>" />
                                         <a href="#popup10" class="popup-link">
                                          <input type="button" name="buttonpotongan2" id="buttonpotongan2" class="btn btn-success btkiloan" value="Save Item" style="width:49%; background-color:#FFF; color:#6C0;"/>
										 </a>
                                         <a href="batal_order.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                          <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                         </a>                                      
										 <br><br>
								</form>
<script>
							
		$("#buttonpotongan2").click(function()
		{
			notanew10=$("#notanew10").val();
			id=$("#id").val();
			jenis=$("#jenis").val();
			item10=$("#item10").val();                       
			harga10=$("#harga10").val();                       
			jumlah10=$("#jumlah10").val();                       
			ket10=$("#ket10").val(); 
			$.ajax(
				{
					url:"act_order_potongan_lanjutan1_tmp.php",
					data:"notanew="+notanew10+"&id="+id+"&jenis="+jenis+"&item="+item10+"&harga="+harga10+"&jumlah="+jumlah10+"&ket1="+ket10,
					cache:false,
					success:function(data)
					{
						
					}
				});									
		})
				
</script>