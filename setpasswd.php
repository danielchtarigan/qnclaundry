<script type="text/javascript">
 function validasi()
    {
        var new1 =document.forms["form1"]["new1"].value;
        var new2 =document.forms["form1"]["new2"].value;
		if (new1 != new2)
          {
          alert("Ulangi input password baru!");
          return false;
          };
	}
</script>

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Set your new password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="../changepasswd.php" method="post" onSubmit="return validasi()" id="form1" name="form1">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Old Password" name="old0" type="password" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="New Password" name="new1" type="password" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Re-Type Password" name="new2" type="password" required>
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>