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

           <?php
             include 'nav.php';
           ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Order</h1>
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
 <input type="hidden" readonly class="form-control" autocomplete="off" name="sisa_kuota" id="sisa_kuota" value="<?php echo $sisa_kuota ?>" required/>
 <input type="hidden" readonly class="form-control" autocomplete="off" name="kuota_sekarang" id="kuota_sekarang" value="<?php echo $sisa_kuota ?>"  required="true"/>
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




      <div class="form-group">
      <label class="control-label col-xs-3" for="kiloan">Item</label>
	  <div class="col-xs-4" >
	  <input required name="itemklp" id="itemklp" class="easyui-combobox"
            name="language"
            data-options="
            valueField:'id',
            textField:'nama_item',
            panelHeight:'auto',
            onSelect: function(rec){

            var mbr=$('#mbr').val();
 			var lgn=$('#lgn').val();
            var jmbr=$('#jmbr').val();
 			$('#beratitem').textbox('setValue', rec.berat);

 			if((mbr == '1' && jmbr !='Red') || lgn=='1' ){
            $('#hargaitem').textbox('setValue', rec.harga_mjkt);
        	}else{
			$('#hargaitem').textbox('setValue', rec.harga_mjkt);
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
<input type="number" class="easyui-textbox" name="jumlahitem" id="jumlahitem" required />
</div><br>
     </div>
      <div class="form-group">
     	<label class="control-label col-xs-3" for="hargaitem">Harga</label>
	 <div class="col-xs-6" >
<input type="number" class="easyui-textbox" name="hargaitem" id="hargaitem" required />
<input type="hidden" readonly class="easyui-textbox" name="beratitem" id="beratitem" required />
</div><br>
     </div>

    <input type="button" value="simpan rincian" name="simpanordersementara" id="simpanordersementara"  class="btn btn-info">


     </fieldset>






                    <!-- /.panel -->
                </div>
  <div class="col-md-4 col-md-offset-0"  >
			<fieldset>
				<legend align="center" >
					<strong>
						Rincian Order
					</strong>
				</legend>
				<table id="dgrincian" class="easyui-datagrid" style="width:350px;height:200px"
			url="../fungsi/get_rincian_order.php" toolbar="#toolbar"
			fitColumns="true" singleSelect="true" rownumbers="false" pagination="false"
			>
					<thead>
						<tr>
							<th field="item" width="120">
								item
							</th>
							<th field="jumlah" width="40">
								jumlah
							</th>
							<th field="harga" width="50">
								harga
							</th>
							<th field="berat" width="50">
								berat
							</th>
							<th field="total" width="50">
								total
							</th>
						</tr>
					</thead>
				</table>
				<div id="toolbar">
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapusorder()">
						Hapus
					</a>
				</div>

				<div id="status">
				</div>

				<br>
				<form action="../fungsi/selesai_order.php" method="post">
					<div class="form-group">
						<label for="no_nota" class="control-label col-xs-4">
							No Nota
						</label>
						<input type="hidden" readonly class="form-control" autocomplete="off" name="email" id="email" value="<?php echo $r['email'] ?>" required/>


						<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
						<input type="hidden" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $r['nama_customer'] ?>" />
						<div class="col-xs-6" >
							<input type="text" class="form-control" value="Auto" autocomplete="off" name="no_nota" id="no_nota" onkeydown="return tabOnEnter(this,event)"  required="true"/>
						</div><br>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-4" for="jenis">
							Sub Total
						</label>
						<div class="col-xs-6" >
							<input type="number" class="form-control" name="subtotalorder" id="subtotalorder" readonly required />							
							<input type="hidden" class="form-control" name="maintotal" id="maintotal" readonly value="" />
						</div><br>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-4" for="voucher">
							voucher
						</label>
						<div class="col-xs-6" >
							<input autocomplete="off" type="text" class="form-control" name="voucher" id="voucher" onkeydown="return tabOnEnter(this,event)"/>
						</div>
						<span id="pesan">
						</span><br>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-4" for="diskon">
							Diskon
						</label>
						<div class="col-xs-6" >
							<input type="text" class="form-control" name="diskonrp" id="diskonrp" readonly />
							<input type="hidden" class="form-control" value="0" name="diskon" id="diskonrp" readonly />

						</div><br>
					</div>
					<div class="form-group">
                                                        <label class="control-label col-xs-4" for="berat">
                                                                Berat
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="text" class="form-control" name="berat" id="berat" value="" readonly />

                                                        </div><br>
                                        </div>
                                                
                                        <div class="form-group">
						<label class="control-label col-xs-4" for="totalorder" >
							Total
						</label>
						<div class="col-xs-6" >
							<input type="number" class="form-control" name="totalorder" id="totalorder" readonly required />

						</div><br>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-4" for="jenis">
							Jenis
						</label>
						<div class="col-xs-6" >
							<input type="text" class="form-control" name="jenis" id="jenis" readonly required />

						</div><br>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-3" for="express1">
							express
						</label>
						<select class="easyui-combobox" name="express1" id="express1" style="width:200px;">
							<option value="">--</option>
							<option value="1">Express</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-3" for="ket">
							Keterangan
						</label>
						<div class="col-xs-7" >
							<textarea type="text" class="form-control" name="ket" id="ket">
							</textarea><br>
						</div>
					</div>
					<input name="cuci" class="btn btn-warning" type="submit" id="cuci" value="Simpan Order">

				</form>

			</fieldset>
		</div>
            </div>
<div class="row">
                <div class="col-lg-4">

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
                <div class="col-lg-8">
                <fieldset>
				<legend align="center" >
					<strong>
						Belum Di Ambil
					</strong>
				</legend>
                	<table id="belumambil" class="display">
					<thead>
						<tr>
							<th>
								reprint
							</th>
							<th>
								Tanggal Masuk
							</th>
							<th>
								No Nota
							</th>
							<th>
								Nama Customer
							</th>
							<th>
								Cuci
							</th>
							<th>
								Setrika
							</th>
							<th>
								Packing
							</th>
							<th>
								kembali
							</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$query  = "SELECT * FROM reception where  ambil=false and id_customer='$id' ORDER BY tgl_input" ;
						$tampil = mysqli_query($mysqli, $query);


						while($data = mysqli_fetch_array($tampil)){
							?>
							<tr>
								<td>

									<a class="btn btn-xs btn-danger" href="../fungsi/reprint_order.php?no_nota=<?php echo $data['no_nota']; ?>">
										Reprint
									</a>
								</td>
								<td>
									<?php echo $data['tgl_input'];?>
								</td>
								<td>
									<?php echo $data['no_nota'];?>
								</td>
								<td>
									<?php echo $data['nama_customer'];?>
								</td>
								<td>
									<?php
									if($data['tgl_cuci'] <> "0000-00-00 00:00:00")
									{
										echo ''.$data['tgl_cuci'].'';
									}
									else
									{
										echo 'belum';
									};
									?>


								</td>
								<td>
									<?php
									if($data['tgl_setrika'] <> "0000-00-00 00:00:00")
									{
										echo ''.$data['tgl_setrika'].'';
									}
									else
									{
										echo 'belum';
									};
									?>
								</td>
								<td>
									<?php
									if($data['tgl_packing'] <> "0000-00-00 00:00:00")
									{
										echo ''.$data['tgl_packing'].'';
									}
									else
									{
										echo 'belum';
									};
									?>
								</td>
								<td>
									<?php
									if($data['tgl_kembali'] <> "0000-00-00 00:00:00")
									{
										echo ''.$data['tgl_kembali'].'';
									}
									else
									{
										echo 'belum';
									};
									?>
								</td>
							</tr>

							<?php
						}
						?>
					</tbody>
				</table>
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

<script type="text/javascript">
	//Check member
	var mbr1 = $("#mbr").val();
	if	(mbr1=='1'){
		$('.member').show();
		$('.bukanm').hide();
	}else{
		$('.member').hide();
		$('.bukanm').show();

	}

	//Check langganan
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
		<?php
			$outlets = explode(";",$mysqli->query("SELECT value FROM settings WHERE name='outlet_referral'")->fetch_array()[0]);
			if (in_array("mojokerto",$outlets) && $r['kode_terpakai']==1 && $r['diskon_terpakai']==0) {
			$cekreferral = $mysqli->query("SELECT COUNT(id) FROM reception WHERE id_customer='$id' AND lunas=0 AND voucher<>''");
			if ($cekreferral->fetch_array()[0]=='0') {?>
		$('#voucher').val('<?php echo $r['kode_referral_baru'];?>');
		<?php } else { ?>
			$('#voucher').val('');
		<?php } }?>
		
		$("#pesan").html('');
		//checkVoucher();

		$('.btkiloan').click(function(){
			$('#jenis').val('k');
			$('#itemklp').combobox('reload', '../fungsi/get_item_kiloan.php');
			$('#jumlahitem').textbox('readonly',true);
			getorder();
			$('#dgorder').datagrid('reload');
			getrincianorder();
			$('#dgrincian').datagrid('reload');
		});

		$('.btpotongan').click(function(){
			$('#jenis').val('p');
			$('#itemklp').combobox('reload', '../fungsi/get_item_potongan.php');
			$('#jumlahitem').textbox('readonly',false);
			getorder();
			$('#dgorder').datagrid('reload');
			getrincianorder();
			$('#dgrincian').datagrid('reload');
		});
	});

	$('#itemklp').combobox({
		filter: function(q, row){
			var opts = $(this).combobox('options');
			return row[opts.textField].toUpperCase().indexOf(q.toUpperCase()) >= 0;
		}

	});

	$('#itemklp').combobox({
		validType:'inList["#itemklp"]'
	});

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
	});

	$("#simpanordersementara").click(function()
	{
		id_item=$("#id_item").val();
		id_cs=$("#id_cs").val();
		jumlah=$("#jumlahitem").val();
		no_nota=$("#no_nota").val();
		berat=$("#beratitem").val();
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
			data:"jumlah="+jumlah+"&no_nota="+no_nota+"&total="+total+"&jenis_item="+jenis_item+"&id_cs="+id_cs+"&harga="+harga+"&berat="+berat,
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
				
				//checkVoucher();
				$('#voucher').val("");
				$('#diskon').val("");
				$('#diskonrp').val("");
				$("#pesan").html('');
				
			}
		});
	});


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
		});
	});


	function getrincianorder(){
		$('#dgrincian').datagrid('load',{
			id_customer: $('#id_cs').val()
		});
	}

	function getorder(){
		$('#dgorder').datagrid('load',{
			id_customer: $('#id_cs').val()
		});
	}

	function hapusorder(){
		var row = $('#dgrincian').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','Hapus rincian order?',function(r){
				if (r){
					$.post('../../../reception/del_detail_order.php',{id:row.id},function(result){
						if (result.success){
							$('#dgrincian').datagrid('reload');	// reload the user data
							//location.reload();
							$('#voucher').val("");							
							$('#diskon').val("");
							$('#diskonrp').val("");
							$("#pesan").html('');
							//checkVoucher();
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

	function voidorder(){
		var row = $('#dgorder').datagrid('getSelected');
		if (row){
			$.messager.confirm('Confirm','void order?',function(r){
				if (r){
					$.post('../../../reception/del_order.php',{no_nota:row.no_nota},function(result){
						if (result.success){
							$('#dgorder').datagrid('reload');	// reload the user data
							//location.reload();
							$('#voucher').val("");
							$('#diskon').val("");
							$('#diskonrp').val("");
							$("#pesan").html('');
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

	$('#dgrincian').datagrid({
		onLoadSuccess:function(data)
		{
			var data = $('#dgrincian').datagrid('getData');
			var rows = data.rows;
			var sum = 0;
			var berat = 0;

			for (var i=0; i < rows.length; i++)
			{
				sum+= parseInt( rows[i].total);
			}

			for (var i=0; i < rows.length; i++)
			{
				berat+= parseFloat( rows[i].berat);
			}

			// just to show if the sum is OK
			$('#berat').val(berat);
			$('#maintotal').val(sum);
			$('#subtotalorder').val(sum);
			$('#totalorder').val(sum);
			tottt=$("#subtotalorder").val();

			//if (tottt<30000){
			//	$("#voucher").attr("disabled","");
			//}else{
			//	$("#voucher").removeAttr('disabled','');
			//}

		}
	});

	$("#voucher").blur(function()
	{
		checkVoucher();
	});

	function checkVoucher() {
		var id_cs=$('#id_cs').val();
		var voucher=$("#voucher").val();

		$.ajax({
			url:"../fungsi/use_voucher.php",
			data:"voucher="+voucher+"&id_cs="+id_cs,
			success:function(msg)
			{
/*				if(msg!="0")
				{
					$("#pesan").html('voucher bisa digunakan');
					$("#voucher").css('border','3px #090 solid');
					$("#cuci").removeAttr('disabled','');
				}
				else if (!$("#voucher").val())
				{
					$("#voucher").css('border','1px #ccc solid');
					$("#pesan").html('');
				}
				else
				{
					$("#voucher").css('border','3px red solid');
					$("#pesan").html('voucher tidak bisa digunakan');
				}
				var persendiskon=parseInt(msg);
				var subtotal= parseInt($("#subtotalorder").val());
				var diskon = Math.floor(persendiskon/100 * subtotal);
				var total = subtotal - diskon;
				$("#totalorder").val(total);
				$("#diskonrp").val(diskon);
				$("#diskon").val(diskon);
*/
						data=msg.split("|");
						if (data[1]=='Referral') {
							$("#pesan").html('voucher Bisa digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}
						else if(data[1]!=0 && data[2]=='ld' && $("#maintotal").val()>=30000 )
						{
							$("#pesan").html('voucher Bisa digunakan');
							a=data[0];
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[3] < 10 && data[2]=='RV' && data[4]!=id_cust && mbr!=1 && $("#maintotal").val()>=30000)
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0];
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='ALL' && data[4]=='ALL' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='<?php echo $ot; ?>' && data[4]=='ALL' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='<?php echo $ot; ?>' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='<?php echo $ot; ?>' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='ALL' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Berkala' && data[3]=='ALL' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('voucher dapat digunakan');
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='ALL' && data[4]=='ALL' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='<?php echo $ot; ?>' && data[4]=='ALL' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='<?php echo $ot; ?>' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='<?php echo $ot; ?>' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='ALL' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Promo' && data[3]=='ALL' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#maintotal").val() >= parseFloat(data[5]) && $("#maintotal").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							c = Math.floor( a * b);
							d = parseInt(bb)- parseInt(c)
							$("#totalorder").val(d);
							$("#diskonrp").val(c);
							$("#diskon").val(a);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled',''); 
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='ALL' && data[4]=='ALL' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='<?php echo $ot; ?>' && data[4]=='ALL' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='<?php echo $ot; ?>' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='<?php echo $ot; ?>' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='ALL' && data[4]=='Potongan' && $("#jenis").val()=='p' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
						}else if(data[1]!=0 && data[2]=='Flat' && data[3]=='ALL' && data[4]=='Kiloan' && $("#jenis").val()=='k' && $("#berat").val() >= parseFloat(data[5]) && $("#berat").val() <= parseFloat(data[6]) )
						{
							$("#pesan").html('Kode Promo Dapat Digunakan');
							alert("INFO PENTING!!\nPersyaratan Promo ini : "+data[7]+"\nCara Pembayaran : "+data[8]);
							a=data[0]/100;
							b=$("#maintotal").val();
							bb=$("#subtotalorder").val();
							berat=$("#berat").val();
							c = Math.floor( data[0] * berat);
							dd = parseInt(b)- parseInt(c)
							d = parseInt(bb)- parseInt(dd)
							$("#totalorder").val(d);
							$("#diskonrp").val(dd);
							$("#diskon").val(dd);
							$("#voucher").css('border','3px #090 solid');
							$("#cuci").removeAttr('disabled','');
							
						}else
						{
							$("#pesan").html('voucher tidak dapat di gunakan');
							$("#voucher").css('border','3px #c33 solid');
							$("#diskon").val("");							
							$("#diskonrp").val("");							
							$("#totalorder").val(b);							
						}

			}
		});
	}

</script>
</html>
