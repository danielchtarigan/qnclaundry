<!DOCTYPE html>
<html lang="en">

<head>
 <?php
include '../../../config.php';
date_default_timezone_set('Asia/Makassar');
$jam1=date("Y-m-d");
$id=$_GET['id'];
$sql=$con->query("select * from customer WHERE id = '$id'");
$r = $sql->fetch_assoc();
$ot='mojokerto';
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

function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
     
	$query = "SELECT max(no_faktur) AS last FROM faktur_penjualan  WHERE nama_outlet='$ot' LIMIT 1";
$hasil = mysqli_query($con,$query);
$k  = mysqli_fetch_array($hasil);
$no_urut = $k['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//fCDW000001
$terakhir = (int)substr($no_urut, 4, 6);
// nomor urut ditambah 1
$nextNoUrut = $terakhir + 1;


	$char="FMJK";
	


// membuat format nomor transaksi berikutnya
$no_faktur= $char.sprintf('%06s', $nextNoUrut);

?>
	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QUICK &' CLEAN ADMIN</title>

    <link href="../../../lib/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../dist/css/metisMenu.css" rel="stylesheet">
	<link href="../../dist/css/timeline.css" rel="stylesheet">
	<link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


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
           
	<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
  

	<input type="hidden" readonly="true" class="form-control" autocomplete="off" name="jumlahpoin" id="jumlahpoin" value="<?php echo $r['poin'] ?>" required="true"/>
  	
  	<input type="hidden" readonly="true" class="form-control" autocomplete="off" name="kali" id="kali" value="<?php echo $kl ?>" required="true"/>
  	<input type="hidden" readonly="true" class="form-control" autocomplete="off" name="tambahpoin" id="tambahpoin" required="true"/>
  	<input type="hidden" readonly="true" class="form-control" autocomplete="off" name="totalpoin" id="totalpoin" required="true"/>
 <input type="hidden" class="form-control" name="lgn" id="lgn" value="<?php echo $lg ?>"/>

 <input type="hidden" readonly="true" class="form-control" autocomplete="off" name="sisa_kuota" id="sisa_kuota" value="<?php echo $sisa_kuota ?>" required="true"/>
<input type="hidden" readonly="true" class="form-control" autocomplete="off" name="kuota_sekarang" id="kuota_sekarang" value="<?php echo $sisa_kuota ?>"  required="true"/>

<input type="hidden" readonly="true" class="form-control" autocomplete="off" name="kuota_sekarang_tambah" id="kuota_sekarang_tambah" required="true"/>


<fieldset>
<legend align="center" ><strong>Transaksi Pembayaran</strong></legend>
<div class="row featurette"> 
<div class="col-md-4 col-md-offset-0" >
<div id="printdp"></div>
<div id="printmbr"></div>
1. Pilih nomer nota di kolom pilih piutang.<br>
2. Klik Simpan, tunggu sampe selesai loading.<br>
3. Jika lebih dari 2 nota pilih lagi di pilih piutang,klik lagi simpan.<br>
4. Klik Bayar.<br>
5. Klik hapus jika ada yang salah.<br>
</div>
<div class="col-md-4 col-md-offset-0" >
<div class="langganan">
<label class="control-label col-xs-10 col-xs-offset-0">Kuota : <font color="#09f744" size="8"><?php echo rupiah($r['sisa_kuota']) ?></font></label>
 
</div>
</div>
<div class="col-md-4 col-md-offset-0" >
<label class="control-label col-xs-10 col-xs-offset-0">Nama Customer : <?php echo $r['nama_customer'] ?></label>
 	   <label class="control-label col-xs-10 col-xs-offset-0">Alamat : <?php echo $r['alamat'] ?> </label>
	   <label class="control-label col-xs-10 col-xs-offset-0">No Telp : <?php echo $r['no_telp'] ?></label>
       <label class="control-label col-xs-10 col-xs-offset-0">Email: <?php echo $r['email'] ?></label>
<div class="member"> 




<label class="control-label col-xs-10 col-xs-offset-0">Tangal Join : <?php echo $r['tgl_join'] ?></label>
<label class="control-label col-xs-10 col-xs-offset-0">Tangal Akhir : <?php echo $r['tgl_akhir'] ?></label>
<label class="control-label col-xs-10 col-xs-offset-0">Total POIN : <font color="#09f744" size="8"><?php echo $r['poin'] ?></font> </label>
<input type="hidden" class="form-control" name="mbr" id="mbr" value="<?php echo $mb ?>"/>
<input type="hidden" class="form-control" name="jmbr" id="jmbr" value="<?php echo $r['jenis_member'] ?>"/>

</div>

</div>    
     </div>
       <!-- START THE FEATURETTES -->

     

<div class="row featurette"> 

<div class="col-md-4 col-md-offset-0" >


 </div>
      
      
<div class="col-md-4 col-md-offset-0"  >
      <fieldset>
      
      <input type="hidden" readonly="true" class="form-control" autocomplete="off" name="email" id="email" value="<?php echo $r['email'] ?>" required="true"/>
      
  		<input type="hidden" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $r['nama_customer'] ?>" />
  	
</fieldset>
</div>

<div class="col-md-4 col-md-offset-0">

</div>
       
</div>
<div class="row featurette">
<div class="col-md-4 col-md-offset-0">
<fieldset>
<legend align="center" ><strong>Belum Lunas</strong></legend>
<table id="piutang" class="table table-bordered">
</table>
</fieldset>
</div>


 

<div class="col-md-4 col-md-offset-0">


<fieldset>
<legend align="center" ><strong>Pilih Piutang</strong></legend>

<div id="printbayar"></div>
 <input name="nota" id="nota" class="easyui-combobox" 
            name="language"
            data-options="
                    url:'../../../reception/get_piutang.php?id=<?php echo $id ?>',
                    method:'get',
                    valueField:'no_nota',
                    textField:'no_nota',
                    panelHeight:'auto',
        onSelect: function(rec){
        	
                   $('#cc').textbox('setValue', rec.total_bayar);
        }
                  ">
            <input id="cc" class="easyui-textbox" readonly="true" >
            <input type="button" value="simpan" name="tambah" id="tambah" class="btn btn-danger">
  <table id="dgrincianbayar" class="easyui-datagrid" style="width:300px;height:350px"
			url="../../../reception/get_rincian_faktur.php"  toolbar="#tb"
			fitColumns="true" singleSelect="true" rownumbers="false" pagination="false"
			 >
		<thead>
			<tr>
				<th field="no_nota" width="50">no nota</th>
				<th field="jumlah" width="50">total</th>
			</tr>
		</thead>
	</table> 
	 <div id="tb">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusrincianbayar()">Hapus Rincian</a>
	</div>         
            
        
            
            
            
            
            
 
 
 
 
 

</fieldset>
</div>



<div class="col-md-4 col-md-offset-0"  >
<fieldset>
<legend align="center" ><strong>Pembayaran</strong></legend>
 <form method="post" action="" id="form-input2" class="form-horizontal">
 <div class="form-group ">
  		<label class="control-label col-xs-3" for="hp">No faktur</label><div class="col-xs-4"> 
  		<input type="text"  class="form-control" autocomplete="off" name="no_faktur" id="no_faktur" required="true">
		</div></div>
 <div class="form-group">
    <label for="no_nota" class="control-label col-xs-3">Total Piutang</label>
  	<div class="col-xs-4" > 
  	
  	<input type="text" class="form-control" disabled="true" autocomplete="off" name="tt" id="tt" required="true"/>
  	</div><br>
</div>
  <div class="form-group"> 
     	<label class="control-label col-xs-3" for="carabayar">Cara Bayar</label>
	 <div class="col-xs-4" >
	<select class="form-control" name="carabayar" id="carabayar">
        <option value="cash">Cash</option>
        <option value="edcbca">Edc BCA</option>
        <option value="edcmandiri">Edc Mandiri</option>
        <option value="edcbri">Edc BRI</option>
 <option value="voucher3kg">voucher 3 kg</option>
 <option value="voucher5kg">voucher 5 kg</option>

         <option value="kuota">Kuota</option>

    </select>
</div><br>
     </div>
 <div class="form-group">
    <label for="no_nota" class="control-label col-xs-3">Total Bayar</label>
  	<div class="col-xs-4" >   	
  	<input type="text" class="form-control" autocomplete="off" name="by" id="by" required="true"/>
  	</div><br>
</div>
<div class="form-group">

    <label for="no_nota" class="control-label col-xs-3">Sisa</label>
  	<div class="col-xs-4" >   	
  	<input type="text" class="form-control" autocomplete="off" name="ss" id="ss" />
  	</div><br>
</div>

<input type="button" class="btn btn-success" id="bayar" name="bayar" value="Bayar"/>
</form>
</fieldset>
</div>
</div>
</fieldset>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="../../../lib/js/jquery-2.1.4.min.js"></script>
    <script src="../../../lib/js/bootstrap.min.js"></script>
    <script src="../../dist/js/metisMenu.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
<script type="text/javascript" src="../../../lib/js/jquery.easyui.min.js"></script>
</body>
<script type="text/javascript">
		$(document).ready(function(){
        $('#no_faktur').val('<?php echo $no_faktur ?>');

        
  //Ketika elemen class tampil di klik maka elemen class gambar tampil
        $('#new').click(function(){
			
        $('#readnota').val();
        alert(noo)
        });
  			
	});
</script>

<script>
  var mbr1 = $("#mbr").val();
	if	( mbr1=='1'){
		$('.member').show(); 
	}else{
		$('.member').hide();
	}
</script>

<script>
  var lg = $("#lgn").val();
	if	( lg=='1'){
		$('.langganan').show();
		$('.btdeposit').removeAttr("style");
		 
	}else{
		$('.langganan').hide();
		$("#carabayar option[value='kuota']").remove();
	}
	
</script>
<script type="text/javascript">
		function filter(){
			$('#dgrincianbayar').datagrid('load',{
				no_faktur: $('#no_faktur').val(),
				id_customer: $('#id_cs').val()
				
				
			});
		}
	</script>
<script>
	$('#dgrincianbayar').datagrid({
	onLoadSuccess:function(data) {
	var data = $('#dgrincianbayar').datagrid('getData');
  var rows = data.rows;
  var sum = 0;
 
  for (i=0; i < rows.length; i++) {
       sum+= parseInt( rows[i].jumlah);}
	 
  // just to show if the sum is OK
 $('#tt').val(sum);
	}
})
</script>



<script>
     
        //mendeksripsikan variabel yang akan digunakan
               
                var id_cs;
                var jumlah;
                var total;
                var no_nota;
                 var no_nota1;
                var jenis_item;
    $(function(){
    				$("#jumlah").focus();
                    id_cs=$("#id_cs").val();
                    no_nota=$("#no_nota").val();
                    $("#rincian").load("pk_customer.php","op=rincian_penjualan&id_cs="+id_cs+"&no_nota="+no_nota);
                    $("#rincianorder").load("rincian_order.php","id_cs="+id_cs);
                    $("#customer").load("pk_customer.php","op=customer&id_cs="+id_cs);
                    $("#piutang").load("pk_customer.php","op=piutang&id_cs="+id_cs); 
                    
                    
                    
                    
                                  
     	            
              
                   
                             
                   
                   
                    
 });
                    
     	
     </script> 
     <script>
     	  $("#bayar").click(function()
     	{
     		
  		
                        id_cs=$("#id_cs").val();
                        nofaktur=$("#no_faktur").val();
                        tt=$("#tt").val();
                        var no_nota1=$('#readnota').val();
                        by=$("#by").val();
                        carabayar=$("#carabayar").val();
                        jumlahpoin=$("#jumlahpoin").val();
                        kuota_sekarang=$("#kuota_sekarang").val();
        
        if(carabayar=="kuota"){
	  	b = 0;
		$("#tambahpoin").val(b);
		poin= $("#tambahpoin").val();
		c = parseInt(jumlahpoin)+ parseInt(poin)
		$("#totalpoin").val(c);
		totalpoin= $("#totalpoin").val();
	  	
	  ``}else{
	  	a =$("#kali").val();
		b = Math.floor( tt * a);
		$("#tambahpoin").val(b);
		poin= $("#tambahpoin").val();
		c = parseInt(jumlahpoin)+ parseInt(poin)
		$("#totalpoin").val(c);
		totalpoin= $("#totalpoin").val();
	  	
	  	}
        
        
                        
                        
                        
                        
                        
                if ( by == "" ){
				alert("Jumlah bayar Masih Kosong");
				$("#by").focus();
				return false;
			}

				if ( tt == "" ){
				alert("total bayar kosong");
				$("#tt").focus();
				return false;
				}
			

 $.ajax({
                            url:"../fungsi/bayar.php",
                            data:"id_cs="+id_cs+"&tt="+tt+"&carabayar="+carabayar+"&totalpoin="+totalpoin+"&poin="+poin+"&kuota_sekarang="+kuota_sekarang+"&no_faktur="+nofaktur+"&no_nota1="+no_nota1,
                            cache:false,
                            success:function(msg)
                            {
                                $("#printbayar").html(msg);
                                $("#jumlah").val("");
                                $("#ket").val("");
                                $("#customer").load("pk_customer.php","op=customerspk&id_cs="+id_cs);
                   				$("#rincian").load("pk_customer.php","op=rincian_penjualan&id_cs="+id_cs+"&no_nota="+no_nota);
                   				$("#rincianorder").load("rincian_order.php","id_cs="+id_cs);
                   				$("#piutang").load("pk_customer.php","op=piutang&id_cs="+id_cs);
                   				
                   				
                            }
                        })
                         
                   }) 
                   
                   
     </script>
     <script>
     	
                    $("#tambah").click(function(){
            			
                        no_nota=$('#nota').combobox('getValue');
                        no_faktur=$('#no_faktur').val();
                        total=$('#cc').val();
                        id_cs=$('#id_cs').val();
                        
                             if(no_nota==""){
                            alert("Kode Barang Harus diisi");
                           $('#nota').next().find('input').focus()
                           $('#nota').combobox('reload');
                          $('#dgrincianbayar').datagrid('reload');  
                            exit();
                            	
                            }                                           
                        
                        
                        $.ajax({
                            url:"../../../reception/bayar_sementara.php",
                            data:"no_nota="+no_nota+"&no_faktur="+no_faktur+"&total="+total+"&id_cs="+id_cs,
                            cache:false,
                            success:function(msg)
                            {
                            filter()
                          	$('#nota').combobox('reload')
                          	$('#dgrincianbayar').datagrid('reload')
                    		
                            }
                        })
                   })
                     
     </script>
     <script>
	 var tt;
    var by;
               
     	$("#by").keyup(function(e)
     	{
     		
     	    tt=$("#tt").val();
            by=$("#by").val();
           
			c = parseInt(by)- parseInt(tt);
			$("#ss").val(c);
			 if(c < 0){
			 	$("#bayar").attr("disabled","");
			 }else{
			 $("#bayar").removeAttr('disabled','');

			 }
			 
		});	
     </script>
 <script>
 $("#carabayar").change(function(){
     var carabayar = $("#carabayar").val();
     var tt= $("#tt").val();
     if(carabayar=="edcbca" || carabayar=="edcmandiri" || carabayar=="edcbri" || carabayar=="kuota"){
	  	$("#by").val("0");
	  	 $("#by").attr("disabled","");
	  }else{
	  	$("#by").val("");
	  	 $("#by").removeAttr('disabled','');
	  }
	   if(carabayar=="kuota"){
	  	sisa_kuota= $("#sisa_kuota").val();
		c = parseInt(sisa_kuota)- parseInt(tt)
	    $("#kuota_sekarang").val(c);
		
	  }else{
	  	sisa_kuota1= $("#sisa_kuota").val();
	  	$("#kuota_sekarang").val(sisa_kuota1);
	  }
	  
	  
	   
    });
</script>
<script>
	 $(function () {
//Box Konfirmasi Hapus
            $('#konfirm-box').dialog({
                modal: true,
                autoOpen: false,
                show: "Bounce",
                hide: "explode",
                title: "Konfirmasi",
                buttons: {
  
                    "Ya": function () {
  jQuery.ajax({
  type: "POST",
  url: "../../../reception/dell_detail_jual.php",
  data: 'id=' +id,
  success: function(){
  $('#'+id).animate({ backgroundColor: "#fbc7c7" }, "fast")
  .animate({ opacity: "hide" }, "slow");
  }
  });
                    $(this).dialog("close");
                    },
 
                    "Batal": function () {
  //jika memilih tombol batal
                    $(this).dialog("close");
   
                    }
                }
            });
 
//Tombol hapus diklik
            $('.hapus').click(function () {
                $('#konfirm-box').dialog("open");
 //ambil nomor id
                id = $(this).attr('id');
            });
        });
</script>


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
		var url;
		function hapusrincianbayar(){
			var row = $('#dgrincianbayar').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','void order?',function(r){
					if (r){
						$.post('../../../reception/del_rincian_bayar.php',{id:row.id},function(result){
							if (result.success){
								$('#dgrincianbayar').datagrid('reload');	// reload the user data
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
     function printout() {
	 var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("printbayar").innerHTML);
    newWindow.print();
    
}
    </script>
    <script>
	$('#nota').combobox({
       validType:'inList["#nota"]'
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
</html>
