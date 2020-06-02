<?php
include "../config.php";
$ot = $_SESSION['nama_outlet'];
?>
				<div class="col-lg-6" style="width:100%">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Kiloan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                        <form action="act_order_potongan_lanjutan.php" method="get" onSubmit="return validasi()" id="form1" name="form1">
                                        <input type="hidden" name="jenis" value="potongan" />
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="voucher">
                                                          No. Nota : <?php echo $_GET['nota'];?>
                                                          <input type="hidden" name="no_nota" value="<?php echo $_GET['nota'];?>" />
                                                        </label>
                                                        <div class="col-xs-9" >
                                                        </div>
                                                        <span id="pesan">
                                                        </span><br>
                                                </div>
                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Rincian
                                            </label>
                                            <div class="col-xs-9" >
                                                <label><input type="checkbox" id="deliver" name="deliver"> Delivery</label>                                                                                          
                                            </div>
                                            <br>
                                        </div>
                                        
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Parfum
                                            </label>
                                            <div class="col-xs-9" >
                                                <label><input type="radio" name="parfum" id="parfum" value="0" checked=""> Normal</label> 
                                                <label><input type="radio" name="parfum" id="parfum" value="extra"> Extra</label>
                                                <label><input type="radio" name="parfum" id="parfum" value="no"> No</label>
                                            </div>
                                            <br>
                                        </div>


                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Charge
                                            </label>
                                            <div class="col-xs-9" >
                                                <select class="form-control" id="charge" name="charge">
                                                    <option value="0">Pilih charge</option>

													<?php
        	                                         $qitem1 = mysqli_query($con, "select * from item_spk where jenis_item='p' and nama_item like '%express%'");
		  											 while ($ritem1 = mysqli_fetch_array($qitem1)){
                		                            ?>
                                                     <option value="<?php echo $ritem1['id']; ?>">
                                                       <?php echo $ritem1['nama_item']." - Rp.".$ritem1['harga']; ?>
                                                     </option>
												<?php 
												 }
?>                                                                        
                                                </select>                                          
                                            </div>
                                            <br>
                                        </div>
                                    
                                        <br>
                                </fieldset>

                                        <input type="hidden" readonly class="easyui-textbox" name="beratitem" id="beratitem" required />
                                                        <input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
                                                        <input type="hidden" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $r['nama_customer'] ?>" />

                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="voucher">
                                                                voucher
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input autocomplete="off" type="text" class="form-control" name="voucher" id="voucher"  onkeydown="return tabOnEnter(this,event)" />                                                               
                                                                <input type="hidden" class="form-control" autocomplete="off" name="id_cust" id="id_cust" value="<?php echo $r['id']; ?>" />
                                                        </div>
                                                        <span id="pesan">
                                                        </span><br><br>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="cabang">
                                                                Lgn/sub
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <select class="form-control" name="cabang" id="cabang">
                                                                        <option value="">
                                                                                --
                                                                        </option>
<?php
	                                         $qlgn = mysqli_query($con, "select * from qnc_lgn");
											 while ($rlgn = mysqli_fetch_array($qlgn)){
                                              ?>
                                                                        <option value="<?php echo $rlgn['nama_lgn']; ?>">
                                                                           <?php echo $rlgn['keterangan']; ?>
                                                                        </option>
												<?php 
												 }
?>                                                                        



                                                                </select>
                                                        </div><br><br>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="ket">
                                                                Keterangan
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <textarea type="text" class="form-control" name="ket" id="ket">
                                                                </textarea><br>
                                                        </div>
                                                </div>                                
                                        <input type="submit" value="Tambah" name="simpanordersementara" id="simpanordersementara">
                                      </form>

                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>