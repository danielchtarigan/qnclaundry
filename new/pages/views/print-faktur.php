<style>
    .info-outlet {
        margin: 20px 0;
    }
    .info-outlet p {
        line-height: 0.5;
    }
</style>

<div class="area-nota">
    <div style="max-width:80mm;margin:3mm;">
        <div align="center"><img width="80%" src="../../new/logo 2017.bmp" /></div>
        <div style="font-size: 9pt; font-family: Tahoma;">
            <div class="struk-body nota-customer">

                <div class="info-outlet" align="center"></div>
            
                <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-size:10pt;">NOTA PEMBAYARAN</span></strong></div>
                <div align="center" style="margin-top: 5px"><strong><?php echo $_GET['id'] ?></strong></div>
                <br>
                <table style="border-top: 1px dotted #000;width:100%;" id="info-user">
                    <tr>
                        <td>
                            <span style="float:left;font-size: 9pt;"><?= date('D, d M y H:i A'); ?></span>
                        </td>
                        <td>
                            <span style="float:right;font-size: 9pt;" id="user"></span>
                        </td>
                    </tr>
                    <tr>
                        <td style="float:left;font-size: 9pt;">Ket : &nbsp;</td>
                        <td style="float:left;font-size: 9pt;" id="fakturType"></td>
		           </tr>
                </table>
                <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-customer"></table>
                 <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;" id="info-order"></table>
                 <table style="font-size:9pt;border-top: 1px dotted #000; border-bottom: 1px dashed #000; width:100%;" id="info-total"></table>
                 <table style="font-size:8pt; width:100%; border-bottom: 1px solid; margin-top: 1px">
					<tr>
						<td align="center">-- Terima Kasih Telah Mencuci di QnC Laundry --</td>
					</tr>
				</table>
            </div>
        </div>
    </div>
</div>	

<script>
    let faktur = '<?= $_GET['id'] ?>';
    let today = '<?= date('D, d M y H:i A'); ?>';
    let dataOutlet = JSON.parse(localStorage.getItem("dataOutlet")).data;
    let dataCustomer = JSON.parse(localStorage.getItem("dataCustomer"));
    let dataFaktur = JSON.parse(localStorage.getItem("dataFaktur")).data;
        dataFaktur = dataFaktur.filter(item => item.faktur == faktur)[0];
        fakturType = dataFaktur.type;
        totalFaktur = dataFaktur.total;

    let divTotal = `<tr><td>&nbsp; &nbsp;</td><td align="right">Total</td><td>:</td><td align="right">${rupiah(totalFaktur)}</td></tr>`;
        divTotal += `<tr><td>&nbsp; &nbsp;</td><td colspan="4" align="left" style="margin-top: 1.5em"><em>Cara Pembayaran</em></td></tr>`;
    
    if (fakturType == "ritel") {
        $.each(dataFaktur.order, function (i, val) {
            let content = `<tr><td>&nbsp; &nbsp;</td><td>${val.order_number}</td><td align="right">${rupiah(val.total)}</td></tr>`;
            $(".struk-body #info-order").append(content);
        });

        $.each(dataFaktur.method, function (i, val) {  
            divTotal += `<tr><td>&nbsp; &nbsp;</td><td align="right">${val.method}</td><td>:</td><td align="right">${rupiah(val.amount)}</td>`;
        });
    } else {
        let content = `<tr><td>&nbsp; &nbsp;</td><td>${dataFaktur.item_package}</td><td align="right">${rupiah(dataFaktur.total)}</td></tr>`;
        $(".struk-body #info-order").append(content);

        divTotal += `<tr><td>&nbsp; &nbsp;</td><td align="right">${dataFaktur.payMethod}</td><td>:</td><td align="right">${rupiah(dataFaktur.total)}</td>`;
    }

    $(".struk-body #info-total").append(divTotal);

    

    $("#info-user #user").text("Kasir: "+ userId);
    $("#fakturType").text(toFirstWorlds(fakturType));

    let divOutlet = `<div><p>Outlet: ${dataOutlet.outlet}<b></b></p><p>Alamat: ${dataOutlet.address}</p><p>Cabang: ${dataOutlet.branch}</p><p>Call Center: ${dataOutlet.telpon}</p></div>`;
    $(".info-outlet").html(divOutlet);
    let divCustomer = `<tr><td>Nama</td><td>:</td><td>${dataCustomer.name}</td></tr><tr><td>No Telepon</td><td>:</td><td>${dataCustomer.telp}</td></tr>`;

    $(".struk-body #info-customer").html(divCustomer);


</script>