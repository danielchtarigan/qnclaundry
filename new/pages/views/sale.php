<?php 
$id = $_GET['id'];
?>

<style>
	.content-main {
		margin: -35px -20px;
		padding: 15px 0;
		height: 100vh;
		overflow: auto;
	}

	.content-main::-webkit-scrollbar {
		width: 0;
	}

	.panel-260 {
		display: flex;
		margin: 0;
	}

	.panel-y-auto {
		height: auto !important;	
		width: 100%;	
		margin-bottom: 15px;
	}

	.panel-y-auto .panel {
		height: 100%;
		display: flex !important;
		flex-direction: column;
		justify-content: space-between;
	}

	.panel-y-auto .panel>.panel-body, .panel-y-auto .panel>.panel-body>div {
		height: calc(100% - 50px);
	}

	.panel-260 .panel-body .data-body {
		height: 100% !important;		
		margin-bottom: -28px;
		width: 100%;
	}

    .data-heading {
        font-weight: bold;
        font-size: 12pt;
        margin-bottom: 10px;
    }

	.data-body {
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		width: 300px;
		height: 300px;
	}

	/* .informasi-customer {
		display: flex;
		flex-direction: column;
	} */

	.data-body>.informasi-customer>div {
		/* margin-bottom: 6px; */
	}

	.btn-group>.btn {
		box-shadow: inset 0 0 6px rgba(0,0,0.4) !important;
		overflow: hidden;
	}

	.separated {
		border: 1px solid rgba(0,0,0,.4);
		margin: 4px 0 8px 0;
	}

	.select-custom {
		position: absolute;
		width: calc(100% - 25px);
		max-height: 120px;
		overflow: auto;
		background-color: #2ea32e;
		padding: 0 !important;
		transition: all .5s ease-in-out;
		opacity: 0;
		z-index: -1;
	}

	.select-custom>input[type="radio"] {
		display: none;
	}

	.select-custom>label {
		padding: 4px 8px;
		margin: 0;
		cursor: pointer;
	}

	.select-custom>label:hover {
		background-color: #6cf06c;
	}

	.panel-no-border {
		border: none;
		margin-bottom: 15px;
	}

	@media only screen and (max-width: 768px) {
		.panel-260 {
			flex-direction: column;
			margin-bottom: 0;
		}

		.panel-260 .panel-body .data-body {
			margin-bottom: 0;
		}

		.panel-y-auto {
			margin-bottom: -10px;
		}
	}
</style>

<div class="content-main">
	<div class="row panel-260">
		<div class="col-lg-4 col-md-6 panel-y-auto">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="data-customer">
						<div class="black lighter smaller data-heading">
							<span><i class="ace-icon fa fa-list-alt smaller-90"></i> Informasi Pelanggan</span>
						</div>
						<div class="data-body">
							<div class="table-overlays">
								<div class="panel-list">
									<div class="panel panel-default panel-no-border" id="panel_data">
										<div class="panel-body">
										</div>
									</div>
									<div class="panel panel-default panel-no-border" id="panel_langganan">
										<div class="panel-body">
										</div>
									</div>
									<div class="panel panel-default panel-no-border" id="panel_membership">
										<div class="panel-body">
										</div>
									</div>
								</div>
							</div>												
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="button-action">
						<div class="btn-group btn-group-justified" role="group" aria-label="...">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-success" id="createOrder">Buat Pesanan</button>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-success" id="listOrder">Daftar Pesanan</button>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-success" id="takeLaundry">Pengambilan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="col-lg-4 col-md-6 panel-y-auto">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="data-pesanan">
						<div class="black lighter smaller data-heading">
							<span><i class="ace-icon fa fa-list-alt smaller-90"></i> Daftar Pesanan</span>
						</div>
						<div class="data-body">
							<div class="list-order">
								<div class="list-group" style="width: 100%;"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="button-action">
						<div class="btn-group btn-group-justified" role="group" aria-label="...">
							<div class="btn-group" role="group">
								<span>Jumlah: <b id="orderCount" data-value="0"></b></span>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-success" id="payOrder"><i class="fas fa-cash-register"></i> Bayar Pesanan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="col-lg-4 col-md-6 panel-y-auto">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="data-pembayaran">
						<div class="black lighter smaller data-heading">
							<span><i class="ace-icon fa fa-list-alt smaller-90"></i> Daftar Pembayaran</span>
						</div>
						<div class="data-body">
							<div class="table-overlays">
								<div class="list-faktur">
									<ul class="list-group">
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- div to show create-order -->
<div id="dialog-form" title="">
	<div class="choose-item show">
        <div>
            <h2 class="title">Pilihan Barang</h2>
            <form action="#" id="select-item">
                <div class="form-group select-custom-a" id="select-custom-a">
                    <label for="category-item">Kategori Barang</label>
                    <input type="text" class="form-control" id="category-item" name="category-item" placeholder="Ketik kategori barang" autocomplete="off">
                    <div class="select-option" id="select-option">
                        <input type="radio" class="" id="category1" name="category" value="category1" checked=""><label for="category1">Kategori 1</label>
                        <input type="radio" class="" id="category2" name="category" value="category2"><label for="category2">Kategori 2</label>
                        <input type="radio" class="" id="category3" name="category" value="category3"><label for="category3">Kategoriy 3</label>
                        <input type="radio" class="" id="category4" name="category" value="category4"><label for="category4">Kategori 4</label>
                    </div>
                </div>
                <div class="form-group select-custom-a" id="select-custom-a">
                    <label for="item">Nama Barang</label>
                    <input type="text" class="form-control" id="item" name="item" placeholder="Ketik nama barang" autocomplete="off">
                    <div class="select-option" id="select-option">
                        <input type="radio" class="" id="item1" name="item" value="item1" checked=""><label for="item1">Barang 1</label>
                        <input type="radio" class="" id="item2" name="item" value="item2"><label for="item2">Barang 2</label>
                        <input type="radio" class="" id="item3" name="item" value="item3"><label for="item3">Barang 3</label>
                        <input type="radio" class="" id="item4" name="item" value="item4"><label for="item4">Barang 4</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="text" class="form-control" id="price" value="0">
                </div>
                <div class="form-group">
                    <label for="quantity">Jumlah</label>
                    <input type="text" class="form-control" id="quantity" value="1" min="1">
                </div>
                <div class="form-group">
                    <label for="amount">Sub Total</label>
                    <input type="text" class="form-control" id="amount" value="0" min="1000">
                </div>
                <button type="button" class="btn btn-primary btn-sm" id="showOrder"><i class="ace-icon fa fa-arrow-circle-right"></i> Simpan</button>
            </div>
        </form>
	</div> 
	
	
</div>

<div id="areaPrintOrder" style="display: none;">
	Ini adalah halaman untuk cetak nota
</div>	

<script type="text/javascript">
    jQuery(function ($) {
        let customerId = '<?= $_GET['id'] ?>', dataCustomer = [];
		customerId = customerId.toString();

		listOrders();
		paymentHistory();
		dataOutlet();

        getData("Customer/show/" + customerId, {}, function (data) {
			
			if (data.readyState == 0) {
				localStorage.removeItem("dataCustomer");
				$(".data-customer .data-body").append('<div id="load" align="center"><span></span></div>');
				$(".data-customer .data-body>.table-overlays").hide();
			}
			else {
				dataCustomer.push(data);
				localStorage.setItem("dataCustomer", JSON.stringify(data));

				$(".data-customer .data-body").find("#load").remove();
				$(".data-customer .data-body>.table-overlays").show();
				$(".data-customer .data-body .panel-list #panel_data>.panel-body").append("<table><tr><td id='customer'>"+ data.name +"</td><td> &nbsp; | &nbsp; </td><td>"+ data.telp +"</td></tr><tr><td colspan='3'>" + data.address + "</td></tr><tr><td colspan='3'><a href='#' id='edit_data'>Ubah Data</a></td></tr></table>");

				let elLangganan = "";
				if (data.langganan == "Langganan") {
					elLangganan = "<table style='margin-bottom: 8px'><tr><td style='font-weight: bold;' width='100%' id='langganan'>Berlangganan</td><td class='pull-right'><button type='button' class='btn btn-white btn-danger btn-sm no-border' id='offlgn'> <i class='fa fa-times' aria-hidden='true'></i></button></td></tr><tr><td id='kuotaKiloan' data-value='"+ data.kuota.kiloan +"'>"+ data.kuota.kiloan +" Kg (Cuci Kering Setrika)</td><td></td></tr><tr><td id='kuotaPotongan' data-value='"+ data.kuota.potongan +"'>"+ rupiah(data.kuota.potongan) +" (Potongan)</td><td></td></tr><tr><td>Aktif Sampai "+ data.kuota.expire +"</td></tr></table>";
				} 
				else {
					elLangganan += '<div style="margin-bottom: 20px"><em>Belum Berlangganan</em></div>'; 
				}
				elLangganan += "<button type='button' class='btn btn-sm btn-success' id='regPackage'>Beli Paket</button>";				

				elMembership = "";
				if (data.membership == "Membership") {
					elMembership += "<table style='margin-bottom: 15px'><tr><td style='font-weight: bold;' width='100%' id='membership'>Membership</td><td class='pull-right'><button type='button' class='btn btn-white btn-danger btn-sm no-border'> <i class='fa fa-times' aria-hidden='true'></i></button></td></tr><tr><td style='font-style: oblique;color: #6878CC; font-weight: bolder'>Blue6Bulan</td><td></td></tr><tr><td style='font-size: 12pt; font-style: oblique; font-weight: bolder; color: #6878CC'><a href=''>12 Poin Rewards</a></td><td></td></tr><tr><td>Aktif Sampai xx/xx/xxxx</td></tr></table>"
				}
				else {
					elMembership += '<div style="margin-bottom: 20px"><em>Belum menjadi membership</em></div>'; 
					elMembership += "<button type='button' class='btn btn-sm btn-success' id='regMembership'>Membership</button>";
				}

				$(elLangganan).appendTo("#panel_langganan>.panel-body");
				$(elMembership).appendTo("#panel_membership>.panel-body");

			}
        });

		function dataOutlet() {
			apiData("Outlet/"+ outlet, { }, function (data) {
				if (data.readyState == 0) {
					localStorage.removeItem("dataOutlet");
				}
				else {
					localStorage.setItem("dataOutlet", JSON.stringify(data));
				}
			});
		}

		function listOrders() {
			getData("SalesOrder/list_order_created/" + customerId, { outlet: outlet }, function (data) {
				if (data.readyState == 0) {
					$(".data-pesanan .data-body").append('<div id="load" align="center"><span></span></div>');
					$(".data-pesanan .data-body>.list-order>.list-group").remove();

					localStorage.removeItem("dataOrder");
					$(document).find("#orderCount").data('value', 0);
					$(document).find("#orderCount").text('0 | '+ rupiah(0));
				}
				else {
					$(".data-pesanan .data-body").find("#load").remove();

					localStorage.setItem("dataOrder", JSON.stringify(data));

					let getData = data['data'];

					let items = [];

					if (getData.length > 0) {
						$(".data-pesanan .data-body>.list-order").append($('<ul class="list-group"></ul>'));
						$.each(getData, function (i, val) {
							let content = $('<li href="#" class="list-group-item order-number" data-id="'+val.orderNumber+'" id="orderNumber" data-kilos="'+ val.kilos +'">'+ val.orderNumber +' | <span style="color: green">' + rupiah(val.total) + '</span> | <span style="display: inline-block; text-align: right"><i class="ace-icon fa fa-trash-o" style="cursor: pointer; color: red" id="removeOrder"></i> &nbsp;<i class="ace-icon fa fa-print" style="cursor: pointer; color: green" id="showPrintAreaOrder"></i></span></li>');
							$(".data-pesanan .data-body>.list-order>.list-group").append(content);

							$.each(val.items, function (i, val) {
								items.push(val);
							});
						});
					} else {
						$(".data-pesanan .data-body>.list-order").html('<span>Belum ada pesanan</span>');
					}

					items = items.filter(v => v.category == "Kiloan");
					if (items.length > 0) {
						$.each(items, function (i, val) {
							let content = $('<div class="list-items" style="display: none"><div class="item-kiloan"><span id="item">'+ val.item +'</span><span id="quantity">'+ val.quantity +'</span><span id="weight">' + val.isweight + '</span><span id="total">' + val.total + '</span></div></div>');
							$(".data-pesanan .data-body>.list-order>.list-group").append(content);
						});
					}

					amount = getData.reduce( function (a, b) { 
						return parseInt(a) + parseInt(b.total);
					}, 0);

					$(document).find("#orderCount").data('value', amount);
					$(document).find("#orderCount").text(getData.length +' | '+ rupiah(amount));
				}
			});
		}
		
		// Dapatkan riwayat pembayaran
		function paymentHistory()
		{
			getData("SalesInvoice/get_payments_history/"+ customerId, { }, function (data) {
				if(data.readyState == 0) {
					$(".data-pembayaran .data-body").append('<div id="load" align="center"><span></span></div>');
					$(".data-pembayaran .data-body>.table-overlays").hide();
				}
				else{
					$(".data-pembayaran .data-body").find("#load").remove();
					$(".data-pembayaran .data-body>.table-overlays").show();

					let mapData = data['data'];
					$.each(mapData, function (i, val) {
						let type = val.type == "ritel" ? "Retail" : val.type;
						let element = '<li class="list-group-item" id="itemFaktur" data-value="'+val.faktur+'"><div style="display: flex; width: 100%; justify-content: space-between"><h4 class="list-group-item-heading">'+ val.faktur +'</h4><small>'+val.createDate+'</small></div><p class="list-group-item-text"><b>'+ type +'</b> | <b style="color: red">'+ rupiah(val.total) +'</b> | <span><i class="ace-icon fa fa-print" style="cursor: pointer; color: green" id="printFaktur"></i></span></p></li>';
						$(element).appendTo(".list-faktur>.list-group");
					});
					
				}
			})
		}

		function removeOrder(orderNumber) {
			getData("SalesOrder/remove_order/" + orderNumber, { }, function (data) {
				if (data.readyState == 0) {
					$(document).find(".data-pesanan .data-body>.list-order").html('<div id="load" align="center"><span></span></div>');
					$(document).find(".data-pesanan .data-body>.list-order>.list-group").remove();
				}
				else {
					if (data > 0) {
						listOrders();
					}
				}
			});
		}

		$("#listOrder").on("click", function () {
			listOrders();
		})

		$(document).on("click", "#removeOrder", function () {
			let id = $(this).closest("li").data('id');
			if (confirm("Yakin ingin menghapus pesanan ini?")) {
				removeOrder(id);
			}
		});

		// $(document).on("click", "#printOrder", function () {
		// 	let id = $(this).closest("li").data('id');
		// 	window.open('document/print_order.php?id='+id,'page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes');
		// });

		// Button action page
		function form() {
			alert("submit");
		}		

		dialog = $( "#dialog-form" ).dialog({
			autoOpen: false,
			height: "auto",
			width: "auto",
			resizable: false,
			show: { effect: "fade", duration: 600 },
			position : { my: "center", at: "center", of: window},
			modal: true,
			close: function() {
				//
			}
		});

		// let urlView = "https://new.qnclaundry/pages/views/";
		let urlView = "views/";

		$(document).on("click", "#regPackage", function () {
			let url = urlView + "registrasi-langganan.php?id=" + customerId;

			$("#dialog-form").load(url, function () {
				let el = $(this).children().length;
				dialog.dialog("option", "title", "Registrasi Langganan");
				dialog.dialog("open");
			});
		});

		$(document).on("click", "#regMembership", function () {
			let url = urlView + "registrasi-membership.php?id=" + customerId;

			$("#dialog-form").load(url, function () {
				let el = $(this).children().length;
				dialog.dialog("option", "title", "Registrasi Membership");
				dialog.dialog("open");
			});
		});

		$('#createOrder').on("click", function () {
			let url = urlView + "create-order.php?id=" + customerId;

			if (dataCustomer.length > 0) {
				$("#dialog-form").load(url, function () {
					let el = $(this).children().length;
					dialog.dialog("option", "title", "Buat Pesanan");
					dialog.dialog("open");
				});
			}

		});


		$(document).on("click", "#payOrder", function () {
			let url = urlView + "pay-order.php?id=" + customerId;

			if (localStorage.getItem("dataOrder") !== null) {
				$("#dialog-form").load(url, function () {
					let el = $(this).children().length;
					dialog.dialog("option", "title", "Pembayaran Pesanan");
					dialog.dialog("open");
				});
			}

			else {
				alert("Tidak ada pesanan yang akan dibayar!");
			}

		});

		$("#takeLaundry").on("click", function () {
			let url = urlView + "laundry-already.php?id="+customerId;			

			$("#dialog-form").load(url, function () {
				let el = $(this).children().length;
				dialog.dialog("option", "title", "Cucian Selesai");
				dialog.dialog("open");
			});
		});		

		$(document).on("click", "#showPrintAreaOrder", function () {
			let orderNumber = $(this).closest(".order-number").data('id');
			let url = urlView + "print-order.php?id=" + orderNumber;

			$("#areaPrintOrder").load(url, function () {  
				el = $(this).html();
				printArea(el);
			});
		});		

		$(document).on("click", "#printFaktur", function () {
			alert("Maaf, fungsi belum bisa digunakan..");
		});

        function printArea(elprintArea){
			let mainPage = document.body.innerHTML;
			document.body.innerHTML = elprintArea;
			window.print();
			// document.body.innerHTML = mainPage;
			location.reload();
		};
    });
</script>

