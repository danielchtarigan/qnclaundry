<?php 

include '../../config.php';


if($_GET['level']=="blue") { 
    if($_GET['cabang']=="Mojokerto"){
        ?>
    	<label class="control-label col-xs-12 col-md-5 "> Pilih Harga</label>
    	<div class="col-md-7">
    		<select class="form-control" placeholder="Click to Choose..." id="harga3">
    			<option value=""></option>
    			<option value="3">Rp 100,000 - 3 Bulan</option>
    			<option value="6">Rp 150,000 - 6 Bulan</option>
    			<option value="12">Rp 200,000 - 12 Bulan</option>		
    		</select>
    	</div>	
    <?php
    }
    else {
        ?>
    	<label class="control-label col-xs-12 col-md-5 "> Pilih Harga</label>
    	<div class="col-md-7">
    		<select class="form-control" placeholder="Click to Choose..." id="harga3">
    			<option value="3">Rp 100,000 - 3 Bulan</option>
    			<option value="6">Rp 150,000 - 6 Bulan</option>
    			<option value="12">Rp 250,000 - 12 Bulan</option>		
    		</select>
    	</div>	
    <?php
    }
    
} else { ?>
	<label class="control-label col-xs-12 col-md-5 "> Harga</label>
	<div class="col-md-7">
		<input type="text" value="100000" readonly="true">
	</div>	
<?php
}
?>





	