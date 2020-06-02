<?php
include 'header.php';
include '../config.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>Build CRUD DataGrid with jQuery EasyUI - jQuery EasyUI Demo</title>
	<link rel="stylesheet" type="text/css" href="../lib/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="../lib/themes/icon.css" />
<script type="text/javascript" src="../lib/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../lib/js/jquery.edatagrid.js"></script>
<script>
	
		$(function(){
			$('#tt').edatagrid({
				title:'Editable DataGrid',
				iconCls:'icon-edit',
				width:660,
				height:250,
				singleSelect:true,
				idField:'id',
				url: 'get_item.php',
				updateUrl: 'update_item.php',
				columns:[[
					{field:'nama_item',title:'berat',width:60},
					{field:'berat',title:'berat',width:60,editor:{
							type:'textbox',
							options:{required:true}
							}
							},
					{field:'kategory',title:'kategory',width:60,editor:{
							type:'textbox',
							options:{required:true}
							}
							},
{field:'harga_mjkt',title:'mjkt',width:60,editor:{
							type:'textbox',
							options:{required:true}
							}
							}
					
					
					
				]]
				
			});
		});
	</script>
</head>
<body>
	<h2>CRUD DataGrid</h2>
	<div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Double click the row to begin editing.</div>
	</div>
	
	<table id="tt" title="My Users" style="width:700px;height:250px"
			toolbar="#toolbar" pagination="false"
			rownumbers="true" fitColumns="true" singleSelect="true"></table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tt').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#tt').edatagrid('cancelRow')">Cancel</a>
	</div>
	
</body>
</html>