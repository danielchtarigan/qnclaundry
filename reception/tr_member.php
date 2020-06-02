<?php
include 'header.php';
include '../config.php';
$id=$_GET['id'];
$sql=$con->query("select * from customer WHERE id = '".$_GET['id']."'");
$r = $sql->fetch_assoc();
?>
<html>
	<head>
		<title>Member</title>
		</head>
<script type="text/javascript">
     function printout() {

    var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("status").innerHTML);
    newWindow.print();
}
    </script>

     <script>
     
        //mendeksripsikan variabel yang akan digunakan
               
                var id_cs;
                var jumlah;
                var total;
    $(function(){
                    id_cs=$("#id_cs").val();
                    $("#rc_member").load("pk.php","op=rc_member&id_cs="+id_cs);
                    $("#member").load("pk.php","op=member&id_cs="+id_cs);
                       
     	$("#add").click(function()
     	{  					   
                        id_cs=$("#id_cs").val();
                        jumlah=$("#jumlah").val();
                        no_nota=$("#no_nota").val();
						sisa= $("#sisa").val();
						
						a =0.00004;
						b = Math.floor( jumlah * a);
						$("#poin").val(b);
						poin= $("#poin").val();
						
						
						c = parseInt(sisa)+ parseInt(poin)
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
			}$.ajax({
                            url:"pk.php",
                            data:"op=tambahpoin&id_cs="+id_cs+"&jumlah="+jumlah+"&no_nota="+no_nota+"&total="+total+"&poin="+poin,
                            cache:false,
                            success:function(msg)
                            {
                                $('#status').html(msg);
                                $("#no_nota").val("");
                                $("#jumlah").val("");
                                $("#ket").val("");
                                $("#poin").val("");
                                $("#total").val("");
                                 printout();
                                $("#rc_member").load("pk.php","op=rc_member&id_cs="+id_cs);
                    			$("#member").load("pk.php","op=member&id_cs="+id_cs);
                                $('#status').hide();
                               
                                
                            }
                        })
                    })
                    $("#kurang").click(function()
     	{
  					   
                        id_cs=$("#id_cs").val();
                        jumlah=$("#jumlah").val();
                        no_nota=$("#no_nota").val();
						sisa= $("#sisa").val();
						c = parseInt(sisa)- parseInt(jumlah)
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
			}
								
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=kurang&id_cs="+id_cs+"&jumlah="+jumlah+"&no_nota="+no_nota+"&total="+total,
                            cache:false,
                            success:function(msg)
                            {
                                $('#status').html(msg);
                                $("#loading").hide();
                                $("#barang").load("pk.php","op=dt_lgn&id_cs="+id_cs);
                                $("#customer").load("pk.php","op=customer&id_cs="+id_cs);
                            }
                        })
                    })
                    
 });
                    
     	
     </script>
     
 <div class="container marketing">
      <!-- Three columns of text below the carousel -->
     <div class="row equal">
     <div id="member"></div>
     </div>
 </div>
     
     
       <!-- START THE FEATURETTES -->

     

      <div class="row featurette">
        <div class="col-md-4 col-md-offset-4" >
        <fieldset>
<legend align="center" ><strong>Input</strong></legend>
        <span id="status"></span>
      
  		<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
	</div></div>
	</fieldset>
</div>
       
         
        </div>
        
       
           <div class="row featurette">
        <div class="col-md-6 col-md-offset-3">
<div id="test" style="margin-top: 20px">
<fieldset>

<legend align="center" ><strong>Rincian</strong></legend>
 <table id="rc_member" class="table table-bordered">
</table>
</fieldset>
</div>
        </div>
        
      </div>

      <!-- /END THE FEATURETTES -->


