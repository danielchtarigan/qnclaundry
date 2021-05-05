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

	.list-group-item-body {
        margin-top: 14px;
    }

    .list-group-item-body>.info-heading>table {
        width: 100%;
    }

    .list-group-item-body>.info-heading>table td {
        line-height: 2;
    }

    .select-input-item,
    .select-item-h {
        display: flex;
        flex-direction: row;
    }

    .select-item-h {
        align-items: center;
        width: 50%;
    }

    .select-item-h label,
    .select-item-h input[type=checkbox] {
        margin: 0;
    }

    .select-item-h label {
        margin-left: 10px;
        width: 100%;
        cursor: pointer;
    }

    .title-method {
        font-size: 14px;
        font-weight: bold;
        color: seagreen;
    }

    .list-group-item-body .list-choose-method {
        /* background-color: salmon; */
    }

    .list-group-item-body .list-choose-method>.title-method {
        border-bottom: 1px solid #ddd;
        padding: 6px 0;
    }

	/* style Nota */
	.areaPrintFaktur {
		display: none;
		position: absolute;
		width: 100%;
		top: 0;
		bottom: 0;
		background: rgba(0,0,0,.4);
		padding: 15px;
		z-index: -1;
	}

	.areaPrintFaktur>.content {
		display: none;
		max-width: 80mm;
		padding: 3mm;
		background-color: #fff;
	}

	.areaPrintFaktur>.content.show {
		display: block;
	}

	.areaPrintFaktur.active {
		display: block;
		z-index: 99;
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
				<div class="panel-footer">
					<div class="button-action">
						<div class="btn-group btn-group-justified" role="group" aria-label="...">
							<div class="btn-group" role="group">
								<span></span>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-success" id="reloadListPayments"><i class="fas fa-cash-register"></i> Reload</button>
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

<div id="areaPrintOrder" style="display: none"></div>	

<script type="text/javascript">
    jQuery(function ($) {
        let customerId = '<?= $_GET['id'] ?>', dataCustomer = [];
		customerId = customerId.toString();

		getCustomer();
		dataOutlet();
		orderInvoice();
		

		// paymentHistory();

		function getCustomer()
		{
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
						elLangganan = "<table style='margin-bottom: 8px'><tr><td style='font-weight: bold;' width='100%' id='langganan'>Berlangganan</td><td class='pull-right'><button type='button' class='btn btn-white btn-danger btn-sm no-border' id='offlgn'> <i class='fa fa-times' aria-hidden='true'></i></button></td></tr><tr><td id='kuotaKiloan' data-value='"+ data.kuota.kiloan +"'>"+ data.kuota.kiloan +" Kg (Cuci Kering Setrika)</td><td></td></tr><tr><td id='kuotaPotongan' data-value='"+ data.kuota.potongan +"'>"+ rupiah(data.kuota.potongan) +" (Potongan)</td><td></td></tr><tr><td>Aktif Sampai "+ data.kuota.expire +" (Masa aktif ini belum berlaku!)</td></tr></table>";
					} 
					else {
						elLangganan += '<div style="margin-bottom: 20px"><em>Belum Berlangganan</em></div>'; 
					}
					elLangganan += "<button type='button' class='btn btn-sm btn-success' id='regPackage'>Beli Paket</button>";				
	
					elMembership = "";
					if (data.membership == "Membership") {
						elMembership += "<table style='margin-bottom: 15px'><tr><td style='font-weight: bold;' width='100%' id='membership'>Membership</td><td class='pull-right'><button type='button' class='btn btn-white btn-danger btn-sm no-border'> <i class='fa fa-times' aria-hidden='true'></i></button></td></tr><tr><td style='font-style: oblique;color: #6878CC; font-weight: bolder'>"+ data.info_member.level +"</td><td></td></tr><tr><td style='font-size: 12pt; font-style: oblique; font-weight: bolder; color: #6878CC'><a href=''>"+ data.poin +" Poin Rewards</a></td><td></td></tr><tr><td>Aktif Sampai "+ data.info_member.expire_date +"</td></tr></table>"
					}
					else {
						elMembership += '<div style="margin-bottom: 20px"><em>Belum menjadi membership</em></div>'; 
						elMembership += "<button type='button' class='btn btn-sm btn-success' id='regMembership'>Membership</button>";
					}
	
					$(elLangganan).appendTo("#panel_langganan>.panel-body");
					$(elMembership).appendTo("#panel_membership>.panel-body");
	
				}
			});
		}

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
					$(".data-pesanan .data-body").html('<div id="load" align="center"><span></span></div>');

					localStorage.removeItem("dataOrder");
					$(document).find("#orderCount").data('value', 0);
					$(document).find("#orderCount").text('0 | '+ rupiah(0));
				}
				else {
					localStorage.setItem("dataOrder", JSON.stringify(data));
					getDataOrder();
				}
			});
		}		

		function orderInvoice() {
			getData("SalesOrder/order_invoice/" + customerId, { outlet: outlet }, function (data) {
				if (data.readyState == 0) {
					$(".data-pesanan .data-body").html('<div id="load" align="center"><span></span></div>');

					localStorage.removeItem("dataOrder");
					$(document).find("#orderCount").data('value', 0);
					$(document).find("#orderCount").text('0 | '+ rupiah(0));
				}
				else {
					localStorage.setItem("dataOrder", JSON.stringify(data));
					getDataOrder();
				}
			});
		}		
		
		// Dapatkan riwayat pembayaran
		function paymentHistory()
		{
			getData("SalesInvoice/get_payments_history/"+ customerId, { }, function (data) {
				if(data.readyState == 0) {
					localStorage.removeItem("dataFaktur");
					$(".data-pembayaran .data-body").html('<div id="load" align="center"><span></span></div>');
				}
				else{
					localStorage.setItem("dataFaktur", JSON.stringify(data));
					$(".data-pembayaran .data-body").find("#load").remove();

					$(".data-pembayaran .data-body").html('<div class="table-overlays"><div class="list-faktur"><ul class="list-group"></ul></div></div>');

					let mapData = data['data'];
					$.each(mapData, function (i, val) {
						let type = val.type == "ritel" ? "Retail" : val.type;
						let element = '<li class="list-group-item invoice-number" id="itemFaktur" data-value="'+val.faktur+'"><div style="display: flex; width: 100%; justify-content: space-between"><h4 class="list-group-item-heading">'+ val.faktur +'</h4><small>'+val.createDate+'</small></div><p class="list-group-item-text"><b>'+ toFirstWords(type) +'</b> | <b style="color: red">'+ rupiah(val.total) +'</b> | <span><i class="ace-icon fa fa-print" style="cursor: pointer; color: green" id="printFaktur"></i></span>';

						$(element).appendTo(".list-faktur>.list-group");
					});
					
				}
			})
		}

		function removeOrder(orderNumber) {
			getData("SalesOrder/remove_order/" + orderNumber, { customerId: customerId, outlet: outlet }, function (data) {
				if (data.readyState == 0) {
					$(".data-pesanan .data-body").html('<div id="load" align="center"><span></span></div>');

					localStorage.removeItem("dataOrder");
					$(document).find("#orderCount").data('value', 0);
					$(document).find("#orderCount").text('0 | '+ rupiah(0));
				}
				else {
					localStorage.setItem("dataOrder", JSON.stringify(data));
					getDataOrder();
				}
			});
		}

		$("#listOrder").on("click", function () {
			orderInvoice();
		});

		$("#reloadListPayments").on("click", function () {
			paymentHistory();
		});

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
			let url = urlView + "sales/salesOrder.php?id=" + customerId;
			let pItems = JSON.parse(localStorage.getItem("dataItem"));
			let customer = JSON.parse(localStorage.getItem("dataCustomer"));

			if (customer && pItems) {
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
			let invoiceNumber = $(this).closest(".invoice-number").data('value');
			// let url = urlView + "print-faktur.php?id=" + invoiceNumber;
			let url = "SalesInvoice/print_faktur/" + invoiceNumber;		

			apiData(url, {}, function (data) {

				if (data.readyState == 0) {
					$("body").append('<div class="areaPrintFaktur" id="areaPrintFaktur"><div class="content" style="margin: 3mm"><div align="center" class="nota-logo"><img width="80%" src="https://new.qnclaundry.com/logo 2017.bmp" /></div></div></div>');
					$(".areaPrintFaktur").addClass('active').append('<div id="load" align="center"><span style="margin-top: -100px"></span></div>');
					$(".areaPrintFaktur>.content").removeClass("show");
				}
				else {
					$(".areaPrintFaktur").find("#load").remove();
					// $(".areaPrintFaktur").removeClass("active");
					$(".areaPrintFaktur>.content").addClass("show");
					let createdDate = '<?= date('D, d M y H:i A'); ?>';
					let dataOutlet = JSON.parse(localStorage.getItem("dataOutlet")).data;
					let dataCustomer = JSON.parse(localStorage.getItem("dataCustomer"));
					let dataFaktur = JSON.parse(localStorage.getItem("dataFaktur")).data;
						dataFaktur = dataFaktur.filter(item => item.faktur == invoiceNumber)[0];
						fakturType = dataFaktur.type;
						totalFaktur = dataFaktur.total;

					let divContent = '<div style="font-size: 9pt; font-family: Tahoma;" class="content-nota"></div>';
					let divOutlet = `<div class="nota-outlet" align="center"><p style="line-height: 0.5;">Outlet: ${dataOutlet.outlet}<b></b></p><p style="line-height: 0.5;">${dataOutlet.address}</p><p style="line-height: 0.5;">Cabang: ${dataOutlet.branch}</p><p style="line-height: 0.5;">Call Center: ${dataOutlet.telpon}</p></div>`;
					let divTitle = '<div align="center" class="nota-title"><strong><span class="style3" style="font-family: arial;font-size:10pt;">NOTA PEMBAYARAN</span></strong></div>';
					let divIdNumber = `<div class="nota-number" align="center" style="margin-top: 5px"><strong>${invoiceNumber}</strong></div><br>`;

					let divCreated = '<table style="border-top: 1px dotted #000;width:100%;" id="nota-created">';
						divCreated += `<tr><td><span style="float:left;font-size: 9pt;">${createdDate}</span></td><td><span style="float:right;font-size: 9pt;" id="user">${userId}</span></td></tr>`;
						divCreated += `<tr><td style="float:left;font-size: 9pt;">Ket : &nbsp;</td><td style="float:left;font-size: 9pt;" id="fakturType">${fakturType}</td></tr>`;
						divCreated += '</table>';

					let divCustomer = '<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-customer">';
						divCustomer += `<tr><td>Nama</td><td>:</td><td>${dataCustomer.name}</td></tr><tr><td>No Telepon</td><td>:</td><td>${dataCustomer.telp}</td></tr>`;
						divCustomer += '</table>';

					let tableItem = '<table width="100%" class="table-item" style="font-size:9pt;border-top: 1px dotted #000;width:100%;">';
					if (dataFaktur.type == "ritel") {
						$.each(data.order, function (i, val) {
							tableItem += `<tr><td>&nbsp; &nbsp;</td><td>${val.order_number}</td><td>${rupiah(val.total)}</td></tr>`;
						});
					} else {
						tableItem += `<tr><td>&nbsp; &nbsp;</td><td>${dataFaktur.item_package}</td><td align="right">${rupiah(dataFaktur.total)}</td></tr>`;
					}
					tableItem += '</table>';

					let tableTotal = '<table style="font-size:9pt;border-top: 1px dotted #000; border-bottom: 1px dashed #000; width:100%;" id="info-total">';
						tableTotal += `<tr><td>&nbsp; &nbsp;</td><td align="right">Total</td><td>:</td><td align="right">${rupiah(totalFaktur)}</td></tr>`;
						tableTotal += `<tr><td>&nbsp; &nbsp;</td><td colspan="4" align="left" style="margin-top: 1.5em"><em>Cara Pembayaran</em></td></tr>`;
					if (dataFaktur.type = "ritel") {
						$.each(data.method, function (i, val) {  
							tableTotal += `<tr><td>&nbsp; &nbsp;</td><td align="right">${val.method}</td><td>:</td><td align="right">${rupiah(val.amount)}</td>`;
						});
					} else {
						tableTotal += `<tr><td>&nbsp; &nbsp;</td><td align="right">${dataFaktur.payMethod}</td><td>:</td><td align="right">${rupiah(dataFaktur.total)}</td>`;
					}
						tableTotal +='</table';

					let tableFinish = '<table style="font-size:8pt; width:100%; border-bottom: 1px solid; margin-top: 3px"><tr><td align="center">-- Terima Kasih Telah Mencuci di QnC Laundry --</td></tr></table>';
					
					$(".areaPrintFaktur>.content").append(divContent);
					$('.content-nota').append(divOutlet);
					$('.content-nota').append(divTitle);
					$('.content-nota').append(divIdNumber);
					$('.content-nota').append(divCreated);
					$('.content-nota').append(divCustomer);
					$('.content-nota').append(tableItem);
					$('.content-nota').append(tableTotal);
					$('.content-nota').append(tableFinish);
					
					let el = $(".areaPrintFaktur").html();
					$(document.body).html(el);
					window.print();
					$(".areaPrintFaktur").removeClass("active");
					$("body").find(".areaPrintFaktur").remove();
					location.reload();
				}
			});
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

<script src="views/sales/scripts.js"></script>