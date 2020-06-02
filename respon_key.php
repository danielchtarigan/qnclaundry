
<label class="block clearfix">
	<span class="block input-icon input-icon-right">
		<input class="form-control" name="code" id="code" type="text" value="<?php echo substr($_GET['ot'],0,3).rand(111111,999999);?>" readonly>
	</span>
</label>

<label class="block clearfix">
	<span class="block input-icon input-icon-right">
		<input class="form-control" placeholder="Respon Key" name="key" type="text" value="" required>
	</span>
</label>