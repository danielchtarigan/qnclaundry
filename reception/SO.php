<html>
<head>
<?php 
require "header.php";
include "../config.php"; 
?>
<style>
	#msg {
    color: red;
    display: none;
    float: right;
}
	
</style>

<script type="text/javascript">
$(function() {
                if (localStorage) {
                    var content = localStorage.getItem("autoSave");
                    if(content) {
                        $("#no_nota").text(content);
                        
                    }
                }

                $("#no_nota").autoSave(function() {
                    var time = showTime();
                    $("#msg").text("Draft Autosaved " + time).show();
                }, 2000);

                $("#refresh").click(function() {
                    location.reload();
                });
                

                $("#clear").click(function() {
                    localStorage.clear();
                    location.reload();
                });

                function showTime() {
                	var timeNow = Date();
                	
                    
                    return timeNow;
                }
            });
        </script>
</head>
<body><div class="container" style="width:600px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:0px; margin-bottom:70px; color:#000000;">

<div class="row">
    <div class="col-lg-10">
        <div class="page-header">
            <h1>Form SO</h1>
            
        </div>
    </div>
</div>


<?php  
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

if(isset($_POST['simpan']))
{
$to      = 'setyawanrooney@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'Reply-To: <admin@qnclaundry.com>' . "\r\n" ;
@mail($to, $subject, $message, $headers);



	
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
if(mysqli_query($con,"insert into so(tgl_so,user_so,outlet,no_nota) VALUES('$jam','$us','$ot','$no_nota')"))

echo '<font color="green" size=5>Data Berhasil di Input</font>';


else
echo "Data Gagal Di Input";
}
?>



<div class="row">
	<div class="col-md-15 col-sm-15">
	<form id="form_input" method="POST" class="form-horizontal">	
	<div class="form-group">
	 <div class="col-xs-10" align="center" >
	<input type="button" value="clear" id="clear" class="btn btn-danger">
	
	</div>
	</div>
	<div class="form-group">
	 <div class="col-xs-10" align="center" >
	<span id="msg"></span>
	</div>
	</div>

	<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">No Nota (wajib diisi)</label>
  		 <div class="col-xs-4">
  		<textarea rows="25"  type="text" class="form-control" name="no_nota" id="no_nota" required="true"></textarea>
  		</div>
		</div>

		
	<div class="form-group">
	 <div class="col-xs-10" align="center" >
	<input type="submit" value="Simpan" name="simpan" class="btn btn-primary">
	</div>
	</div>
	</form>
	</div>

</div>
</div>

<script>
	function getNextElement(field) {
    var form = field.form;
    for ( var e = 0; e < form.elements.length; e++) {
        if (field == form.elements[e]) {
            break;
        }
    }
    return form.elements[++e % form.elements.length];
}

function tabOnEnter(field, evt) {
if (evt.keyCode === 13) {
        if (evt.preventDefault) {
            evt.preventDefault();
        } else if (evt.stopPropagation) {
            evt.stopPropagation();
        } else {
            evt.returnValue = false;
        }
        getNextElement(field).focus();
        return false;
    } else {
        return true;
    }
}
		
		
	</script>
	<script type="text/javascript">
        $(function() {
            $("#no_nota").focus();
        });
    </script>
</body>
</html>