<!DOCTYPE html>
<html>
<head>
<?php 
include "head.php";
?>

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../lib/themes/bootstrap/easyui.css">
<link rel="stylesheet" type="text/css" href="../lib/themes/icon.css">
<script type="text/javascript" src="../lib/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../lib/js/datagrid-filter.js"></script>
<script type="text/javascript">
		function doSearch(){
			$('#dg').datagrid('load',{
			no_faktur: $('#no_faktur').val()
			});
		}
$(function(){
			var dg = $('#dg').datagrid({
				filterBtnIconCls:'icon-filter'
			});
			dg.datagrid('enableFilter');
		});
		

	</script>	
</head>
<body>


<div class="col-md-4 col-md-offset-2" >
<a class="btn btn-info btn-sm active" href="report_void.php" role="button">Kembali untuk verifikasi</a>	
	<table id="dg" title="Inventory" class="easyui-datagrid" style="width:700px;height:800px"
			url="get_faktur_penjualan.php" pageList="[10,20,30,40,50,100,400,1000,2000,10000]"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="no_faktur" width="50">No Faktur</th>
				<th field="nama_outlet" width="50" sortable="true">Outlet</th>
				<th field="rcp" width="50">Resepsionis</th>
				<th field="tgl_transaksi" width="50">Tanggal</th>
				<th field="total" width="50">Total</th>
				<th field="cara_bayar" width="50">Cara Bayar</th>
				<th field="id_customer" width="50">Id Customer</th>
			</tr>
		</thead>
	</table>
	
	<div id="toolbar">
		
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove</a>
		
	<span>no faktur:</span>
		<input id="no_faktur"  style="line-height:26px;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
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
			<div class="fitem">
				<label>Cara Bayar:</label>
				<input name="cara_bayar" class="easyui-textbox" required="true">
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
						$.post('del_faktur_penjualan.php',{id:row.id},function(result){
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