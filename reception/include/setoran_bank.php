<div align="center">
	<h4 align="left">FORM SETORAN BANK</h4>
	<div id="pesan"></div>
	<div class="easyui-panel" title="Tutup Kasir" align="center" style="width:500px;padding:10px;">
		<form id="ff" action="p_setoran_bank.php" method="post" class="form-horizontal">
	<div class="form-group">
        <label class="control-label col-xs-3" for="jumlahitem">
        	Outlet
        </label>
        <div class="col-xs-9" >
    		<select class="form-control" name="nama_outlet" id="nama_outlet" required="true">
		        <option value="">--</option>
		    <?php 
    		$qoutlet = mysqli_query($con, "SELECT *FROM outlet WHERE nama_outlet<>'mojokerto'");
    		while($result = mysqli_fetch_array($qoutlet)){?>
		        <option value="<?php echo $result['nama_outlet']; ?> "><?php echo $result['nama_outlet']; ?></option>
            <?php } ?>
		   	</select>
         </div><br /><br>
    </div>
	<div class="form-group">
         <label class="control-label col-xs-3" for="jumlahitem">
         	Bank
         </label>
         <div class="col-xs-9" >
    		<select class="form-control" name="bank" id="bank" required="true">
		        <option value="">--</option>
		        <option value="BRI">BRI</option>
		        <option value="PERMATA">Permata</option>
		        <option value="DANAMON">Danamon</option>
		        <option value="BNI">bni</option>
				<option value="MANDIRI">Mandiri</option>
			 	<option value="BCA">BCA</option>
			  	<option value="BII">BII</option>
		   	</select>
                                                </div><br /><br>
                                        </div>

										<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Jumlah Setoran
                                                </label>
                                                <div class="col-xs-9" >
    <input type="number" autocomplete="off" class="form-control" name="setoran" id="setoran" required="true"/>
                                                </div><br /><br>
                                        </div>

										<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Tanggal Penerimaan
                                                </label>
                                                <div class="col-xs-9" >
    <input type="text" autocomplete="off" class="form-control" name="penerimaan1" id="tanggal1" required="true"/>
                                                </div><br /><br>
                                        </div>


										<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Keterangan
                                                </label>
                                                <div class="col-xs-9" >
  		<textarea class="form-control" name="keterangan" id="keterangan" required="true" ></textarea>
                                                </div><br /><br>
                                        </div>
		
		
										<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Kode Referensi
                                                </label>
                                                <div class="col-xs-9" >
    <input type="text" class="form-control" name="referensi" id="referensi" required="true"/>
                                                </div><br /><br>
                                        </div>

										<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        <input type="submit" name="test" id="test" value="Submit"></input>
                                                </label>
                                        </div>
		</form>
	</div>
	</div>
	
	<style scoped>
		.f1{
			width:200px;
		}
	</style>
<!-- 	<script type="text/javascript">
		$(function(){
			$('#ff').form({
				success:function(data){
					$.messager.alert('Info', data, 'info');
				$('#ff').form('clear');
				}
			});
		});
	</script>
	<script type="text/javascript">

	$(document).ready(function()
	{
		$('#test').click(function()
		{
			var jumlah = $('#setoran').val();
				
    		
			if (confirm("Simpan Data?"+"Jumlah :"+jumlah))
			{
				
			}else{
				return false;
			}
		});
		
		
	});
	
</script> -->

<script type="text/javascript">
	$(document).ready(function(){
		$('#ff').submit(function(){
			$.ajax({
				type: 'POST',
				url : $(this).attr('action'),
				data : $(this).serialize(),
				success : function(data){
					$('#pesan').html(data);				
				}
			})
			return false;
		});
	});	
</script>