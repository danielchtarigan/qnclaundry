			<div class="row">
                <div class="col-lg-8 col-md-offset-0">
                    <h1 class="page-header">Voucher Referral</h1>
                </div>
            </div>
            <?php
            $qdiskref = mysqli_query ($con, "SELECT value FROM settings WHERE name='diskon_referral_mojokerto'");
            $diskon = mysqli_fetch_array($qdiskref)[0];
            ?>
            			<div class="col-md-8 col-md-offset-0" >
            			<form action="save_diskon_referral.php" method="get" class="form-horizontal">
            				<br>
            				<div class="form-group">
            					<label for="no_nota" class="control-label col-xs-3" style="text-align:left">
            						Persen Diskon
            					</label>
            					<div class="col-xs-4">
            						<input type="text" name="diskon" value="<?php echo $diskon; ?>">
            					</div>
            					%
            				</div>
            				<button type="submit" class="btn btn-default">Save</button>
            			</form>
            			</div>

            <form action="save_sms_referral.php" class="form-horizontal">
            <?php
            $qsmsreferral = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_referral_mojokerto'");
            $smsreferral = mysqli_fetch_array($qsmsreferral)[0];
            ?>
            <div class="col-md-8" >
            	<br>
            	<div class="form-group">
            		<label for="no_nota" class="control-label col-xs-3" >
            			<p align="left">SMS Referral<br>
            				<small style="font-weight:normal"><b>[KODE]</b> akan otomatis diganti dengan kode referral dan <b>[DISKON]</b> akan diganti dengan persentase diskon</small>
            			</p>
            		</label>
            		<div class="col-xs-4">
            			<textarea name="sms_referral" id="sms_referral" cols="50" rows="10"><?php echo $smsreferral; ?></textarea>
            		</div>
            	</div>
            	<button type="submit" class="btn btn-default">Save SMS</button>
            </div>
            </form>
          </div>
          <!-- /#wrapper -->

          <script src="../../../lib/js/jquery-2.1.4.min.js"></script>
          <script src="../../../lib/js/bootstrap.min.js"></script>
          <script src="../../dist/js/metisMenu.js"></script>
          <script src="../../dist/js/sb-admin-2.js"></script>

      </body>

      </html>
