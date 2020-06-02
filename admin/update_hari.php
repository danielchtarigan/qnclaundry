<html>
<?php
include 'header.php';
include '../config.php';
?>



        <script type="text/javascript">
            $('document').ready(function() {
                $('#btn').click(function() {
                	 var hari = $('#hari').val();
                    var data = 'hari='+ hari;
                    $.ajax({
                        type: 'POST',
                        url: "p_update_hari.php",
                        data: data,
                       success:function(msg)
                            {
                                $("#status").html(msg);
                        }
                    });
                });
            });
        </script>


<head>

</head>
<body>



<div class="row featurette"> 

<div class="col-md-4 col-md-offset-0" >
<marquee behavior=alternate style="font-size: 25px;color: #dfff00"  > <h1>Update Hari</h1></marquee>
		<label class="control-label col-xs-3" for="cari">Update Hari</label>
		<div class="col-xs-4">
  		<input  placeholder="update hari" class="form-control"  type="number" name="hari" id="hari" >
  		</div><br>
  		<input id="btn" class="btn btn-sm btn-danger" type="button" value="update"></td>
</div>
<div id="status"></div>
</div>














	<script type="text/javascript">
        $(function() {
            $("#cari").focus();
        });
    </script>

</body>
</html>


