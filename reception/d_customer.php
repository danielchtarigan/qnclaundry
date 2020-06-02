<?php
include 'header.php';
include '../config.php';
function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
?>
<script>
	$(document).ready(function()
		{
			$('#tbl_cst').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 50
				
			});

		});
</script>
<div class="container" style="margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4); margin-top:10px;  margin-bottom:70px; color:#000000;
     padding-top:20px;">
    <button class="btn btn-md  btn-success" data-id='0' data-toggle="modal" data-target="#tambah-customer" style="float:right;">
            Tambah Data
    </button>
    <br /><br />
    <div id="printmbr">
    </div>
    <table id="tbl_cst" class="display dataTable no-footer">
            <thead>
                    <tr>
                            <th>
                                    Nama
                            </th>
                            <th>
                                    Alamat
                            </th>
                            <th>
                                    No Telp
                            </th>
                            <th>
                                    Member
                            </th>
                            <th>
                                    Langganan
                            </th>
                            <th>
                                    Pilih
                            </th>
                    </tr>
            </thead>
            <tbody>
                    <?php
                    $query = "SELECT * FROM customer";
                    $tampil= mysqli_query($con, $query);
                    while($r = mysqli_fetch_array($tampil)){
                            if($r['member'] == '1'){
                                    $member = $r['jenis_member'];
                            }
                            else
                            {
                                    $member = "";
                            }
                            if($r['lgn'] == '1'){
                                    $lgn = rupiah($r['sisa_kuota']);
                            }
                            else
                            {
                                    $lgn = "";
                            }
                            ?>
                            <tr>
                                    <td>
                                            <?php echo $r['nama_customer']; ?>
                                    </td>
                                    <td>
                                            <?php echo $r['alamat']; ?>
                                    </td>
                                    <td>
                                            <?php echo $r['no_telp']; ?>
                                    </td>
                                    <td>
                                            <?php echo $member ?>
                                    </td>
                                    <td>
                                            <?php echo $lgn ?>
                                    </td>
                                    <td style="text-align:center;width:200px">

                                            <a class="btn btn-sm btn-success" href="tr_customer.php?id=<?php echo $r['id']; ?>">
                                                    pilih
                                            </a>
                                    </td>
                            </tr>
                            <?php
                    }
                    ?>
            </tbody>
    </table>
    <!-- Modal tambah data -->
    <div id="tambah-customer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                    <div class="modal-content">

                            <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">
                                                    &times;
                                            </span>
                                    </button>
                                    <h4 class="modal-title">
                                            Tambah Customer
                                    </h4>
                            </div>

                            <div class="modal-body">

                                    <fieldset>
                                            <div class="form-group">
                                                    <label for="Notelp">
                                                            No Telp
                                                    </label>
                                                    <span id="pesan">
                                                    </span>
                                                    <input type="number"  autocomplete="off" name="no_telp1" id="no_telp1" class="form-control" placeholder="Masukkan no telp">

                                            </div>
                                            <span id="user-result">
                                            </span>
                                            <div class="form-group">
                                                    <label for="nama_customer">
                                                            Nama Customer
                                                    </label>
                                                    <input type="text" autocomplete="off" name="nama_customer1" id="nama_customer1" class="form-control" placeholder="Masukkan nama customer">
                                            </div>

                                            <div class="form-group">
                                                    <label for="alamat">
                                                            alamat
                                                    </label>
                                                    <input type="text" autocomplete="off" name="alamat1" id="alamat1" class="form-control" placeholder="Masukkan Alamat">
                                            </div>
                                            <div class="form-group">
                                                    <label for="info">
                                                            Tau QuicknClean dari?
                                                    </label>
                                                    <select name="info" id="info" class="form-control">
                                                            <option value="">
                                                                    --
                                                            </option>
                                                            <option value="brosur">
                                                                    brosur
                                                            </option>
                                                            <option value="spanduk">
                                                                    spanduk
                                                            </option>
                                                            <option value="teman">
                                                                    Teman
                                                            </option>


                                                    </select>
                                            </div>

                                    </fieldset>



                            </div>

                            <div class="modal-footer">
                                    <button class="btn btn-success" id="addcustomer" class="btn">
                                            Tambah
                                    </button>
                                    <button class="btn btn-default" data-dismiss="modal">
                                            <i class="fa fa-close">
                                            </i>Batal
                                    </button>
                            </div>



                    </div>
            </div>
    </div>
</div>
<script>
	var id;
	var nama_customer;
	var jenis;
	var tgl_join;
	var tgl_akhir;
	var alamat1;
	var no_telp1;
	var nama_customer1;
	var info;

	$("#no_telp1").change(function()
		{
			var no_telp=$("#no_telp1").val();

			$.ajax(
				{
					url:"pk.php",
					data:"op=telp&no_telp="+no_telp,
					success:function(data)
					{
						if(data==0)
						{
							$("#pesan").html('no telp Bisa digunakan');
							$("#no_telp1").css('border','3px #090 solid');
							$("#addcustomer").removeAttr('disabled','');

						}else
						{
							$("#pesan").html('no telp sudah ada');
							$("#no_telp1").css('border','3px #c33 solid');
							$("#addcustomer").attr("disabled","");


						}
					}
				});
		})

	$(function()
		{
			$("#addcustomer").click(function()
				{


					nama_customer1=$("#nama_customer1").val();
					alamat1=$("#alamat1").val();
					no_telp1=$("#no_telp1").val();
					info=$("#info").val();


					if ( nama_customer1 == "" )
					{
						alert("Nama Masih Kosong");
						$("#nama_customer1").focus();
						return false;
					} else if ( alamat1 == "" )
					{
						alert("alamat Masih Kosong");
						$("#alamat1").focus();
						return false;
					}else if ( no_telp1 == "" )
					{
						alert("no telp Masih Kosong");
						$("#no_telp1").focus();
						return false;
					}else if ( info == "" )
					{
						alert("info Masih Kosong");
						$("#info").focus();
						return false;
					}

					$.ajax(
						{
							url:"add_customer.php",
							data:"nama_customer1="+nama_customer1+"&alamat1="+alamat1+"&no_telp1="+no_telp1+"&info="+info,

							success:function(msg)
							{

								$("#tambah-customer").modal('hide');
								location.reload();

							}
						})

				})

		});


</script>
