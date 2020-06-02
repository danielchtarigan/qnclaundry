<div class="popup-wrapper" id="popup3">
	<div class="popup-container">
                        <div class="panel-heading">
                            Form Kiloan
                        </div>
<script type="text/javascript">
function itemxx(){
	var itemK = document.form1.itemklp.value;	
	var it = itemK.split("-");
	document.form1.harga.value = it[1];
	document.form1.item.value = it[0];
}


function hargayy(){
	var itemK = document.form1.itemklp.value;	
	var it = itemK.split("-");
//	document.form1.harga.value = it[1];
	if (document.form1.harga.value < it[1]){
		alert("Harga dibawah minimum!");
		document.form1.harga.value = it[1];
		}
}

</script>
<form method="get" id="form1" name="form1">
                                        <div class="form-group">
										  <input type="text" name="notanew" id="notanew" value="" class="form-control" placeholder="No Nota (Auto)"/>
									      <br />
                                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" />
                                        <input type="hidden" name="jenis" id="jenis" value="Kiloan" />
                                                <label class="control-label col-xs-3" for="Kiloan">
                                                   Item
                                                </label>
                                                <div class="col-xs-9" >
                                                   <select name="itemklp" id="itemklp" class="form-control" onchange="itemxx()">
                                                     <option value=""></option>
                                                    <?php
                                                    $qitem = mysqli_query($con, "select * from item_spk where jenis_item='k' and nama_item like '%Cuci Kering Setrika%'");
													while($ritem = mysqli_fetch_array($qitem)){
														if ($status=="member"){
													?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['disk']; ?>"><?php echo $ritem['nama_item']; ?></option>
                                                    <?php
														}
														else{
													?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['harga']; ?>"><?php echo $ritem['nama_item']; ?></option>
                                                    <?php
														}
													}
													?>
                                                   </select>
                                                </div><br><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Harga
                                                </label>
                                                <div class="col-xs-9" >
                                                <input type="hidden" name="item" id="item" class="form-control" placeholder="0" width="100%"/>
                                                <input type="text" id="harga" name="harga" class="form-control" placeholder="0" width="100%" onmousemove="hargayy()">
                                                </div><br /><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Ket Item
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="ket1" name="ket1" class="form-control" placeholder="keterangan item" width="100%" onfocus="hargayy()">
                                                </div><br /><br>
                                        </div>
                                        <a href="#popup4" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="Next" style="width:49%; background-color:#FFF; color:#6C0" name="simpanordersementara" id="simpanordersementara"/>
                                        </a>
                                        <a href="transaksi.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
        </form>
		<a class="popup-close" href="#popup2"><img src="back.png" />
        </a>
        <br />
    </div>
</div> 

<script>
	$("#simpanordersementara").click(function()
		{
			notanew=$("#notanew").val();
			id=$("#id").val();
			jenis=$("#jenis").val();
			item=$("#item").val();                       
			harga=$("#harga").val();                       
			ket1=$("#ket1").val();                                              
			$.ajax(
				{
					url:"act_order_kiloan1_tmp.php",
					data:"notanew="+notanew+"&id="+id+"&jenis="+jenis+"&item="+item+"&harga="+harga+"&ket1="+ket1,
					cache:false,
					success:function(msg)
					{
					}
				})
		})
</script>