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
<script type="text/javascript" src="../lib/js/datagrid-filter.js"></script>
<script type="text/javascript">
		
$(function(){
			var dg = $('#dg').datagrid({
				filterBtnIconCls:'icon-filter'
			});
			dg.datagrid('enableFilter');
		});
		

	</script>	
</head>
<body>

<div  class="container-fluid" style="width:800px;
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
   margin-bottom: 10px;
   ">
<div class="col-md-4 col-md-offset-0" >
	<table id="dg" title="ORDER" class="easyui-datagrid" style="width:700px;height:800px"
			url="get_order.php" pageList="[10,20,30,40,50,100,400,1000,2000,10000]"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="no_nota" width="50" sortable="true">No Nota</th>
				<th field="nama_customer" width="50" sortable="true">Customer</th>
				<th field="tgl_input"  width="50">Tgl</th>
				<th field="nama_outlet" width="50">Outlet</th>
				<th field="total_bayar" width="50">Total</th>
				<th field="lunas" width="50">Lunas</th>
				<th field="op_cuci" width="50">Cuci</th>
				<th field="user_setrika" width="50">Setrika</th>
				<th field="user_packing" width="50">Packing</th>
				
			</tr>
		</thead>
	</table>
	
	<div id="toolbar">
		
		<!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit</a>-->
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove</a>
	</div>
	</div>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Inventory Information</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label>no faktur:</label>
				<input name="no_faktur" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>Total:</label>
				<input name="total" class="easyui-textbox" required="true">
			</div>
			<div class="fitem">
				<label>RCP:</label>
				<input name="rcp" class="easyui-textbox" required="true">
			</div>
			
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','New User');
			$('#fm').form('clear');
			url = 'save_inventory.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit User');
				$('#fm').form('load',row);
				url = 'edit_faktur_penjualan.php?id='+row.id;
			}
		}
		function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
		}
		function destroyUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
					if (r){
						$.post('del_order.php',{id:row.id},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
		}
	</script>
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
		.fitem input{
			width:160px;
		}
	</style>
</body>
</html>