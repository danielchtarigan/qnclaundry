<html>
<head>
<?php 
require "header.php";

?>
</head>
<body>
<div  class="container-fluid" style="width:500px;
   margin:0 auto; 
   position:relative; 
   border:3px solid rgba(0,0,0,0); 
   -webkit-border-radius:5px; 
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
 <h1>Cari Nota SPK</h1>

<div class="row">

	<div class="col-md-15 col-sm-15">
	<form id="form_input" method="POST" class="form-horizontal" action="spk2.php">	
	
	<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">No Nota</label>
  		 <div class="col-xs-4">
  		<input type="text" class="form-control" name="no_nota" id="no_nota"   required="true"/>
  		</div><label  class="control-label col-xs-4"><marquee behavior=alternate style=" color: #ff0000 ">Lihat Lagi</marquee>			</label>
	</div>

	<div class="form-group">
	<div class="col-xs-10" align="center" >
	<input type="submit" value="Cari" name="simpan" class="btn btn-primary">
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