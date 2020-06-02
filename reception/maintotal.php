<div class="form-group">
                                                
<label class="control-label col-xs-3" for="jenis">
Main Total
</label>
                                                        <div class="col-xs-9" >
<?php
include '../config.php';
	$st = mysqli_query($con, "select sum(total) as main, sum(berat) as berat from rincian_order_temp where id_customer='$_GET[id]' and item not like '%expres%'");
	$rst = mysqli_fetch_array($st);
?>
<input type="text" class="form-control" name="maintotal" id="maintotal" readonly value="<?php echo $rst['main']; ?>" />
                                                        </div><br><br>
</div>
                                                
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="berat">
                                                                Berat Cucian
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input type="text" class="form-control" name="berat" id="berat" value="<?php echo $rst['berat']; ?>" readonly />

                                                        </div><br><br>
                                                </div>