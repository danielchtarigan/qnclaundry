<legend class="">DATA MEMBERSHIP</legend>


<div style="margin-bottom: 20px">
	<button id="cek" type="button" class="hide" style="background-color: white; color: red" title="">
		Nonaktifkan</i>
	</button>
	<span id="n"></span>
</div>

<table class="table table-condensed table-hover table-striped table-bordered">
	<thead>
		<tr>
			<th><input align="center" type="checkbox" value="All" class="chekboxes" name="" title="Pilih semua"></th>
			<th>Nama Customer</th>
			<th>Level</th>
			<th>Tanggal Aktif</th>
			<th>Tanggal Berakhir</th>
			<th>Diaktifkan Oleh</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$sql = $con-> query("SELECT * FROM membership a, customer b WHERE a.customer_id=b.id");
		while($dataMember = $sql-> fetch_array())
		{
			echo '
			<tr>
				<td style="vertical-align: middle; text-align: center"><input class="act" type="checkbox" name="id[]" value="'.$dataMember['customer_id'].'"></td>
				<td>'.$dataMember['nama_customer'].'</td>
				<td>'.$dataMember['level'].' '.$dataMember['poin'].'</td>
				<td>'.$dataMember['join_date'].'</td>
				<td>'.$dataMember['expire_date'].'</td>
				<td>'.$dataMember['user_allow'].'</td>
			</tr>
			';
		}

		?>
	</tbody>
</table>


<script type="text/javascript">
	$('.chekboxes').change(function(){
    	$('.act').prop('checked', $(this).prop('checked'));
    });

    $(".act, .chekboxes").change(function(){
	    	var n = $(".act:checked").length;
	    	if(n>0) {
	    		$('#cek').removeClass('hide');
	    		$('#n').html(n+" dipilih");
	    	} 
	    	else {
	    		$('#cek').addClass('hide');
	    		$('#n').html("");
	    	}

		    
	    });
</script>