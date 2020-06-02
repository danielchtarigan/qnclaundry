<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

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

	<script type="text/javascript" src="../lib/js/jquery.edatagrid.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#dg').edatagrid({
				url: 'get_void.php',
				updateUrl: 'update_void.php'
			});
		});
	</script>
</head>
<body>
	
	<table id="dg" title="My Users" style="width:700px;height:250px"
			toolbar="#toolbar" pagination="true" idField="id"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="no_nota" width="50" editor="{type:'validatebox',options:{required:true}}">no nota</th>
				<th field="tanggal" width="50" editor="{type:'validatebox',options:{required:true}}">tanggal</th>
				<th field="sebab" width="50" editor="text">sebab</th>
				<th field="jenis" width="50" editor="text">jenis</th>
<th field="status" width="50" editor="text">status</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>
	
</body>
</html>