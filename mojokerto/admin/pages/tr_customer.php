<!DOCTYPE html>
<html lang="en">

<head>
	<?php 
	include '../../configurasi/koneksi.php';
date_default_timezone_set('Asia/Makassar');
$jam1=date("Y-m-d");
function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
$id=$_GET['id'];     
     $sql=$mysqli->query("select * from customer WHERE id = '$id'");
	$r = $sql->fetch_assoc();
if ($r['member']=='1' && $r['tgl_akhir'] >= $jam1  ){
	$mb="1";
	$kl="0.00004";
}else{
	$mb="0";
	$kl="0";
}
if ($r['lgn']=='1'){
	$lg="1";
	$sisa_kuota=$r['sisa_kuota'];
}else{
	$lg="0";
	$sisa_kuota="";
}
	
	
	$query =$mysqli->query("SELECT max(no_so) AS last FROM reception WHERE nama_outlet='mojokerto' LIMIT 1");

$data  =$query->fetch_array();
$lastNoTransaksi = $data['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//soCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 5, 6);
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;

$char = "SDMJK";

// membuat format nomor transaksi berikutnya
$noso = $char.sprintf('%06s', $nextNoUrut1);


$query =$mysqli->query("SELECT max(no_faktur) AS last FROM faktur_penjualan  WHERE nama_outlet='mojokerto' LIMIT 1");

$k  =$query->fetch_array();
$no_urut = $k['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//fCDW000001
$terakhir = (int)substr($no_urut, 4, 6);
// nomor urut ditambah 1
$nextNoUrut = $terakhir + 1;
$char="FMJK";
	


// membuat format nomor transaksi berikutnya
$nofaktur= $char.sprintf('%06s', $nextNoUrut);

	
	
	
	
	
	
	
	?>
    


  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUICK &' CLEAN ADMIN</title>

    <link href="../../../lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../dist/css/metisMenu.css" rel="stylesheet">
	
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="../../../lib/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="../../../lib/css/jquery.dataTables_themeroller.css" />
<link rel="stylesheet" type="text/css" href="../../../lib/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="../../../lib/css/dataTables.tableTools.css">
<link rel="stylesheet" type="text/css" href="../../../lib/css//dataTables.tableTools.css">

<link rel="stylesheet" type="text/css" href="../../../lib/themes/bootstrap/easyui.css" />
<link rel="stylesheet" type="text/css" href="../../../lib/themes/icon.css" />



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
     
          <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                   
                  
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                  
                
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                               
                            
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>Reception<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="d_customer.php">Input Data</a>
                                </li>
                                <li>
                                    <a href="workshop.php">Dari Workshop</a>
                                </li>
                               <li>
                                    <a href="ambil_customer.php">Pengambilan</a>
                                </li>
                               
                                <li>
                                    <a href="tutup_kasir.php">Tutup Kasir</a>
                                </li>
                                <li>
                                    <a href="setoran_bank.php">setoran bank</a>
                                </li>
                                <li>
                                    <a href="stok_opname.php">Stok Opname</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                          <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i>Operasional<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="cuci.php">Cuci</a>
                                </li>
                                
                                <li>
                                    <a href="pengering.php">pengering</a>
                                </li>
                                <li>
                                    <a href="setrika.php">Setrika Ritel</a>
                                </li>
                                
                                <li>
                                    <a href="packing.php">Packing</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        
                        
                        
                        
                        
                        
                         <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Laporan Reception<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               
                                <li>
                                    <a href="setoran_bank.php">Setoran Bank</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                 
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
     
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables Cucian</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Data Customer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              
                                      <label class="control-label col-xs-13 col-xs-offset-0">Nama Customer : <?php echo $r['nama_customer'] ?></label><br>
 	   <label class="control-label col-xs-13 col-xs-offset-0">Alamat : <?php echo $r['alamat'] ?> </label><br>
	   <label class="control-label col-xs-13 col-xs-offset-0">No Telp : <?php echo $r['no_telp'] ?></label><br>
       <label class="control-label col-xs-13 col-xs-offset-0">Email: <?php echo $r['email'] ?></label> <br>     
                              
                              
                            </div>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Data Customer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              
                                      <div class="member"> 
<label class="control-label col-xs-10 col-xs-offset-0">Tangal Join : <?php echo $r['tgl_join'] ?></label>
<label class="control-label col-xs-10 col-xs-offset-0">Tangal Akhir : <?php echo $r['tgl_akhir'] ?></label>
<label class="control-label col-xs-10 col-xs-offset-0">Total POIN : <font color="#09f744" size="8"><?php echo $r['poin'] ?></font> </label>
<input type="hidden" class="form-control" name="mbr" id="mbr" value="<?php echo $mb ?>"/>
<input type="hidden" class="form-control" name="jmbr" id="jmbr" value="<?php echo $r['jenis_member'] ?>"/>
</div>
<div class="bukanm">
<strong>Belum Jadi Member. Segera Tawarkan Member</strong>
</div>   
                              
                              
                            </div>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Data Customer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                              
                                    <div class="langganan">
<label class="control-label col-xs-10 col-xs-offset-0">Kuota : <font color="#09f744" size="8"><?php echo rupiah($r['sisa_kuota']) ?></font></label>
 <input type="hidden" class="form-control" name="lgn" id="lgn" value="<?php echo $lg ?>"/>
 <input type="hidden" readonly="true" class="form-control" autocomplete="off" name="sisa_kuota" id="sisa_kuota" value="<?php echo $sisa_kuota ?>" required="true"/>
 <input type="hidden" readonly="true" class="form-control" autocomplete="off" name="kuota_sekarang" id="kuota_sekarang" value="<?php echo $sisa_kuota ?>"  required="true"/>
</div>
 <div class="beluml"><strong>Belum Jadi Langganan. Segera Tawarkan Langganan. Antar Jemput Gratis. Kuota Lebih banyak</strong></div>

                                            
                              
                              
                            </div>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
                
                
                
                
                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           <br></br> <input type="button" class="btn btn-info btkiloan" value="kiloan"/>
 <input type="button" class="btn btn-danger btpotongan" value="Potongan"/>
        <div class="row featurette"> 
            <div class="col-md-8 col-md-offset-0" >
                   
                       
   <fieldset>
      <legend align="center" ><strong>Input</strong></legend>
     
   
  	<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
  	<input type="hidden" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $r['nama_customer'] ?>" />
  	<input type="hidden" class="form-control" name="jenis" id="jenis" />
  	 <div class="form-group"> 
  	  <label class="control-label col-xs-2" for="no_nota">No Nota</label>
  	<div class="col-xs-8" >   	
  	<input type="text" class="form-control" autocomplete="off" name="no_nota" id="no_nota" onkeydown="return tabOnEnter(this,event)"  required="true"/>
  	</div><br></div>
  	
  	
      <div class="form-group"> 
      <label class="control-label col-xs-3" for="kiloan">Item</label>
	  <div class="col-xs-4" >
	  <input required="true" name="itemklp" id="itemklp" class="easyui-combobox" 
            name="language"
            data-options="
            valueField:'id',
            textField:'nama_item',
            panelHeight:'auto',
            onSelect: function(rec){
            
            var mbr=$('#mbr').val();
 			var lgn=$('#lgn').val();
            var jmbr=$('#jmbr').val();
 			
 			
 			if((mbr == '1' && jmbr !='Red') || lgn=='1' ){
            $('#hargaitem').textbox('setValue', rec.disk);
        	}else{
			$('#hargaitem').textbox('setValue', rec.harga);
			}
			
			if(rec.id == '186'){
			$('#hargaitem').textbox('readonly',false);
        	}else{
			$('#hargaitem').textbox('readonly',true);
			}
			
			if(rec.id == '183' || rec.id == '184'){
			$('#express1').combobox('setValue','1');
        	}
			
        	
        	}
            "> 
	
</div><br>    </div>
     <div class="form-group"> 
     	<label class="control-label col-xs-3" for="jumlahitem">Ket Item</label>
	 <div class="col-xs-6" >
<input type="text" id="ket1" name="ket1" class="easyui-textbox" placeholder="keterangan item">
	</div><br>
     </div>
      
 
     
      <div class="form-group"> 
     	<label class="control-label col-xs-3" for="jumlahitem">jumlah</label>
	 <div class="col-xs-6" >
	 <input type="hidden" id="total" name="total" />
<input type="number" class="easyui-textbox" name="jumlahitem" id="jumlahitem" required="true" />
</div><br>
     </div>
      <div class="form-group"> 
     	<label class="control-label col-xs-3" for="hargaitem">Harga</label>
	 <div class="col-xs-6" >
<input type="number" class="easyui-textbox" name="hargaitem" id="hargaitem" required="true" />
</div><br>
     </div>

    <input type="button" value="simpan rincian" name="simpanordersementara" id="simpanordersementara"  class="btn btn-info">
      
     </fieldset>

	
                              
                              
                              
                     
                    <!-- /.panel -->
                </div>
                 <div class="col-md-4 col-md-offset-0" >
                <!-- /.col-lg-6 -->
          
 <fieldset>
    <legend align="center" ><strong>Rincian Order</strong></legend>
      <table id="dgrincian" class="easyui-datagrid" style="width:350px;height:200px"
			url="../fungsi/get_rincian_order.php" toolbar="#toolbar"
			fitColumns="true" singleSelect="true" rownumbers="false" pagination="false"
			>
		<thead>
			<tr>
				<th field="no_nota" width="140">no nota</th>
				<th field="item" width="120">item</th>
				<th field="jumlah" width="20">jumlah</th>
				<th field="harga" width="50">harga</th>
				<th field="total" width="50">total</th>
			</tr>
		</thead>
	</table>            
      <div id="toolbar">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusorder()">Hapus</a>
	</div> 
<input type="hidden" readonly="true" class="form-control" autocomplete="off" name="email" id="email" value="<?php echo $r['email'] ?>" required="true"/>

     <div id="status"></div>
<div id="printorder"></div> 
<br>     <div class="form-group"> 
     	<label class="control-label col-xs-3" for="express1">express</label>
     <select class="easyui-combobox" name="express1" id="express1" style="width:200px;">
		<option value="">--</option>
		<option value="1">Express</option>
		
		</select>
		</div>
     <div class="form-group"> 
     	<label class="control-label col-xs-3" for="cabang">lgn/sub</label>
	 <div class="col-xs-6" >
	<select class="form-control" name="cabang" id="cabang">
        <option value="">--</option>
        <option value="lgn">Langganan</option>
 <option value="dlv">Delivery</option>
        <option value="sub-pendidikan">sub-pendidikan</option>
        <option value="sub-tello">sub-tello</option>
                <option value="sub-Tamangapa">sub-Tamangapa</option>
        <option value="sub-abdesir">sub-abdesir</option>
        <option value="sub-jappa">sub-jappa</option>
        <option value="sub-manggarupi">sub-manggarupi</option>
        <option value="sub-h.bau">sub-h.bau</option>
 <option value="sub-alaudin">sub-alaudin</option>
 <option value="sub-perintis">sub-perintis</option>

        
        
    </select>
</div><br>
     </div>
	
	<div class="form-group"> 
	<label class="control-label col-xs-3" for="ket">Keterangan</label>
	<div class="col-xs-7" >
  	<textarea type="text" class="form-control" name="ket" id="ket"></textarea><br>
	</div></div>
	<input name="selesaiorder" class="btn btn-warning" type="submit" id="selesaiorder" value="Simpan Order" >	
	</fieldset>       

                <!-- /.col-lg-6 -->
                </div>
            </div>
<div class="row">
                <div class="col-lg-12">
                
                <fieldset>
    <legend align="center" ><strong>Daftar Order</strong></legend>
<table id="dgorder" class="easyui-datagrid" style="width:350px;height:200px"
			url="../../../reception/get_order.php" toolbar="#tb"
			fitColumns="true" singleSelect="true" rownumbers="false" pagination="false"
			>
		<thead>
			<tr>
				<th field="no_nota" width="50">no nota</th>
				<th field="tgl_input" width="50">tanggal</th>
				<th field="total_bayar" width="50">total</th>
				
			</tr>
		</thead>
	</table>            
      <div id="tb">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="voidorder()">Void Order</a>
	</div> <br>
	
	<a  class="btn btn-success" href="transaksi_pembayaran.php?id=<?php echo $r['id']; ?>">Pembayaran</a>

</fieldset>
                
                </div>
</div>



          </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>



	<script src="../../../lib/js/jquery-2.1.3.min.js"></script>
    <script src="../../../lib/js/bootstrap.min.js"></script>
    <script src="../../dist/js/metisMenu.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>

<script type="text/javascript" language="javascript" src="../../../lib/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="../../../lib/js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="../../../lib/js/dataTables.tableTools.js"></script>
<script type="text/javascript" src="../../../lib/js/jquery.easyui.min.js"></script>

<script>
  var mbr1 = $("#mbr").val();
	if	( mbr1=='1'){
		$('.member').show();
		$('.bukanm').hide(); 
	}else{
		$('.member').hide();
		$('.bukanm').show();
		
	}
	
</script>
<script>
  var lg = $("#lgn").val();
	if	( lg=='1'){
		$('.langganan').show();
		$('.beluml').hide(); 
		$('.btdeposit').removeAttr("style");
		 
	}else{
		$('.langganan').hide();
		$('.beluml').show(); 
		$("#carabayar option[value='kuota']").remove();
	}
	
</script>
<script>
 $(document).ready(function(){
 		       	$('#jumlahitem').textbox('setValue','1');
 		 getorder();
        $('#dgorder').datagrid('reload');  
        getrincianorder();
        $('#dgrincian').datagrid('reload');
        oTable = $('#belumambil').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50
				
			});		
  //Ketika elemen class tampil di klik maka elemen class gambar tampil
        
         $('.btkiloan').click(function(){
        $('#no_nota').val('$noso');
        $('#no_nota').val('<?php echo $noso?>');
        $('#jenis').val('k');
        $('#itemklp').combobox('reload', '../fungsi/get_item_kiloan.php');
        $('#jumlahitem').textbox('readonly',true);
        getorder();
        $('#dgorder').datagrid('reload');  
        getrincianorder();
        $('#dgrincian').datagrid('reload');  
        
        
        
        });
                                
        $('.btpotongan').click(function(){
        $('#no_nota').val('$noso');
		$('#no_nota').val('<?php echo $noso?>');
        $('#jenis').val('p');
        $('#itemklp').combobox('reload', '../fungsi/get_item_potongan.php');
        $('#jumlahitem').textbox('readonly',false);
		getorder();
        $('#dgorder').datagrid('reload');  
        getrincianorder();
        $('#dgrincian').datagrid('reload');  
        
        
        });
		
		                        
		
 });
 </script>
 <script>
$('#itemklp').combobox({
	filter: function(q, row){
		var opts = $(this).combobox('options');
		 return row[opts.textField].toUpperCase().indexOf(q.toUpperCase()) >= 0;
	}
 
});
</script>
<script>
	$('#itemklp').combobox({
       validType:'inList["#itemklp"]'
});
</script>
<script>
	$.extend($.fn.validatebox.defaults.rules,{
       inList:{
              validator:function(value,param){
                     var c = $(param[0]);
                     var opts = c.combobox('options');
                     var data = c.combobox('getData');
                     var exists = false;
                     for(var i=0; i<data.length; i++){
                            if (value == data[i][opts.textField]){
                                   exists = true;
                                   break;
                            }
                     }
                     return exists;
              },
              message:'item tidak ada.'
       }
})
</script>
<script>
$("#simpanordersementara").click(function()
     	{
  					   id_item=$("#id_item").val();
                       id_cs=$("#id_cs").val();
                       jumlah=$("#jumlahitem").val();
                       no_nota=$("#no_nota").val();
                       itm=$("#itemklp").combobox('getValue');
                      
                       jenis_item=$("#itemklp").combobox('getText')+" "+$("#ket1").val();
                        if ( id_item == '186' ){
						harga= $("#hargalain").val();
						}else{
							harga= $("#hargaitem").val();
						}
						
                        
						
						c = harga*jumlah;
					    $("#total").val(c);
						total= $("#total").val();
				if ( jumlah == "" ){
				alert("Jumlah Masih Kosong");
				$("#jumlah").focus();
				return false;
			} else if ( no_nota == "" ){
				alert("No Masih Kosong");
				$("#no_nota").focus();
				return false;
			}else if ( itm == "" ){
				alert("Item belum ada");
				$('#itemklp').next().find('input').focus()
				return false;
			}
			
			
			
			
			
			$.ajax({
            url:"../fungsi/simpan_order_sementara.php",
            data:"jumlah="+jumlah+"&no_nota="+no_nota+"&total="+total+"&jenis_item="+jenis_item+"&id_cs="+id_cs+"&harga="+harga,
                            cache:false,
                            success:function(msg)
                            {
                                $('#status').html(msg);
                                $("#jumlah").val("1");
                                $("#ket").val("");
                                $("#rincian").load("pk_customer.php","op=rincian_penjualan&id_cs="+id_cs+"&no_nota="+no_nota);
                                $("#rincianorder").load("rincian_order.php","id_cs="+id_cs);
                                $("#piutang").load("pk_customer.php","op=piutang&id_cs="+id_cs);
                                $("#customer").load("pk_customer.php","op=customer&id_cs="+id_cs);
                                $('#status').hide();
                                $("#modal-potongan").modal('hide');
					          getorder();
					        $('#dgorder').datagrid('reload');  
					        getrincianorder();
					        $('#dgrincian').datagrid('reload');  
        
                                $('#hargaitem').textbox('clear');
                                $('#itemklp').combobox('clear');
                                
                            }
                        })
                    })
                   
                   
</script> 
<script>
	   $("#selesaiorder").click(function()
     		{
     				no_nota=$("#no_nota").val();
                    id_cs=$("#id_cs").val();
                    nama_customer=$("#nama_customer").val();
					jenis=$("#jenis").val();
                    express=$("#express1").val();
                    cabang=$("#cabang").val();
                    ket=$("#ket").val();
                      
						$.ajax({
                            url:"../fungsi/selesai_order.php",
                            data:"no_nota="+no_nota+"&id_cs="+id_cs+"&nama_customer="+nama_customer+"&jenis="+jenis+"&express="+express+"&cabang="+cabang+"&ket="+ket,
                            cache:false,
                            success:function(msg)
                            {
                                $("#printorder").html(msg);
                                $("#no_nota").val("");
                                $("#jumlah").val("");
                                $("#ket").val("");
                                $("#customer").load("pk_customer.php","op=customerspk&id_cs="+id_cs);
                   				$("#rincian").load("pk_customer.php","op=rincian_spk&id_cs="+id_cs+"&no_nota="+no_nota);
                   				$("#piutang").load("pk_customer.php","op=piutang&id_cs="+id_cs);
                              
                             	
                             	  
                                
                                
                            }
                        })
                       
                    })
                    
	
</script> 
<script type="text/javascript">
		function getrincianorder(){
			$('#dgrincian').datagrid('load',{
				no_nota: $('#no_nota').val(),
				id_customer: $('#id_cs').val()
				
				
			});
		}
		function getorder(){
			$('#dgorder').datagrid('load',{
				
				id_customer: $('#id_cs').val()
				
				
			});
		}
		
	</script>
<script type="text/javascript">
		var url;
		function hapusorder(){
			var row = $('#dgrincian').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Hapus rincian order?',function(r){
					if (r){
						$.post('../../../reception/del_detail_order.php',{id:row.id},function(result){
							if (result.success){
								$('#dgrincian').datagrid('reload');	// reload the user data
                                                                
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
<script type="text/javascript">
		var url;
		function voidorder(){
			var row = $('#dgorder').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','void order?',function(r){
					if (r){
						$.post('../../../reception/del_order.php',{no_nota:row.no_nota},function(result){
							if (result.success){
								$('#dgorder').datagrid('reload');	// reload the user data
location.reload();
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
</html>
