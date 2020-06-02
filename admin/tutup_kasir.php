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

<div  class="container-fluid" style="width:1200px;
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
   margin-bottom: 10px;   margin-top: 50px;

   ">
<div class="col-md-4 col-md-offset-0" >
	<table id="dg" title="Tutup Kasir" class="easyui-datagrid" style="width:1200px;height:500px"
			url="get_tutup_kasir.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="tanggal" width="50">Tanggal</th>
				<th field="reception" width="50">Reception</th>
				<th field="setoran_bersih" width="50">Tutup Kasir</th>
				<th field="edc_bca" width="50">edc bca</th>
				<th field="edc_bri" width="50">edc bri</th>
				<th field="edc_mandiri" width="50">edc mandiri</th>
				<th field="pengeluaran" width="50">Pengeluaran</th>
				<th field="bank" width="50">Bank</th>
				<th field="tgl_setor" width="50">Tanggal Setor</th>
				<th field="ket" width="50">Keterangan</th>

			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Setor ke bank</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Hapus</a>
	
	</div>
	</div>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Ket : diisi ok ketika setoran ama edc udah masuk ke bank</div>
		
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label>Setoran:</label>
				<input name="setoran_bersih" class="easyui-textbox" required="true">
			</div>

			<div class="fitem">
				<label>Bank:</label>
				<select id="bank" class="easyui-combobox" name="bank" style="width:200px;" required="true">
    <option value="bri">bri</option>
    <option value="permata">permata</option>
      <option value="danamon">danamon</option>
        <option value="bni">BNI</option>
          <option value="bii">BII</option>
</select>
			</div>
			<div class="fitem">
				<label>Tanggal Setor</label>
			<input id="tgl_setor" name="tgl_setor" required="true" class="easyui-datebox" data-options="formatter:myformatter,parser:myparser"></input>
				 <script type="text/javascript">
        function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
    </script>
    <script>
        $(function(){
            $('#tgl_setor').datebox().datebox('calendar').calendar({
                validator: function(date){
                    var now = new Date();
                    var d1 = new Date(now.getFullYear(), now.getMonth(), now.getDate()-10);
                    var d2 = new Date(now.getFullYear(), now.getMonth(), now.getDate()+10);
                    return d1<=date && date<=d2;
                }
            });
        });
    </script>
			</div>
			<div class="fitem">
				<label>Keterangan</label>
				<input name="ket" class="easyui-textarea" required="true">
			</div>
			
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<script type="text/javascript">
		var url;
		
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Setor Bank');
				$('#fm').form('load',row);
				url = 'edit_tutup_kasir.php?id='+row.id;
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
						$.post('del_tutupkasir.php',{id:row.id},function(result){
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