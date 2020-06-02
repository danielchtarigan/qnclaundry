<!DOCTYPE html>
<html>
<head>
<?php 
include "header.php";

?>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../lib/themes/bootstrap/easyui.css">
<link rel="stylesheet" type="text/css" href="../lib/themes/icon.css">
<script type="text/javascript" src="../lib/js/jquery.easyui.min.js"></script>
	
</head>
<body>
<div align="center">
	<h2>FORM ORDER VOID</h2>
	<div class="easyui-panel" title="ORDER" align="center" style="width:500px;padding:10px;">
		<form id="ff" action="p_order_void.php" method="post" class="form-horizontal">
		<table>
	<div class="form-group"><label for="no_nota" class="control-label col-xs-3">Jenis</label><div class="col-xs-4">
          <select class="form-control" name="jenis" id="jenis" required="true">
          <option value="">--</option>
        <option value="void">Void</option>
        <option value="edit">Edit</option>
        
   	</select>
   	</div>
   	</div>
		
   	
<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">No Nota</label>
  		 <div class="col-xs-8">
  		<input type="text" autocomplete="off" class="form-control" name="no_nota" id="no_nota"   onkeydown="return tabOnEnter(this,event)"required="true"/>
  		</div>
		</div>
		<div class="form-group">
  		<label for="no_nota" class="control-label col-xs-3">Alasan Void</label>
  		 <div class="col-xs-8">
  		<textarea type="text" class="form-control" name="sebab" id="sebab"   onkeydown="return tabOnEnter(this,event)"required="true" ></textarea>
  		</div>
		</div>
		<tr>
					<td></td>
					<td><input type="submit" value="Submit"></input></td>
					
				</tr>
			</table>
		</form>
	</div>
	</div>
	
	<style scoped>
		.f1{
			width:200px;
		}
	</style>
	<script type="text/javascript">
		$(function(){
			$('#ff').form({
				success:function(data){
					$.messager.alert('Info', data, 'info');
				$('#ff').form('clear');
				}
			});
		});
	</script>
	
</body>
</html>