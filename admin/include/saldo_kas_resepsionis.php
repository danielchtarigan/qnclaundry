
<div class="col-md-12">
    <div class="">
        <div class="col-md-3">
            <input class="form-control" type="text" name="start" id="start" value="<?= date('Y-m-d') ?>" placeholder="Tanggal Awal">
        </div>
        <div class="col-md-3">
            <input class="form-control" type="text" name="end" id="end" value="<?= date('Y-m-d') ?>" placeholder="Tanggal Akhir">
        </div>
        <div class="col-md-3">
           
        <select class="form-control" id="pilih_nama" name="pilih_nama">
            <option value="--Pilih Nama Resepsionis--">--Pilih Nama Resepsionis--</option>
            <?php 
            $query = mysqli_query($con, "SELECT name,cabang FROM user WHERE level='reception' AND aktif='Ya' AND cabang<>'' GROUP BY cabang,name ORDER BY cabang,name ASC");
            while($row = mysqli_fetch_row($query)){
                $jar = strtoupper($row[1]);
                if($row[1]=="makassar") {
                    echo '<option value="'.$row[0].'">'.ucwords($row[0]).' | '.$jar.'</option>';
                } else {
                    echo '<option value="'.$row[0].'" style="color: #0459ed; background-color: #f0f8ff">'.ucwords($row[0]).' | '.$jar.'</option>';
                }
            	
            }
            ?>
        </select> 
        </div>
        <div class="col-md-3">
            <button class="btn btn-md btn-primary" id="btn1" name="btn1">Cek Saldo</button>
        </div>
        
    </div>  
    
</div>

<div class="col-md-12" id="idn" align="center" style="margin-top: 25px"></div>
    



<script type="text/javascript">
	$(document).ready(function(){
		$("#start").datepicker({
            dateFormat:'yy-mm-dd',
        });

        $("#end").datepicker({
            dateFormat:'yy-mm-dd'
        });

		$("#btn1").click(function(){
			var pilih_nama = $("#pilih_nama").val();
			var start = $("#start").val();
			var end = $("#end").val();
			$.ajax({
				url : "data_kas.php",
				type : "GET",
				data : {pilih_nama : pilih_nama, start : start, end : end},
				beforeSend : function(){
					$("#idn").html("Sedang Memuat....");
				},
				success : function(data){
					$("#idn").html(data);
				}
			})
		})
	})
</script>



		