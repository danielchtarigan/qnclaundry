<?php
include 'header.php';
include '../config.php';
$id=$_GET['id'];
$sql=$con->query("select * from customer WHERE id = '".$_GET['id']."'");
$r = $sql->fetch_assoc();
function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
?>
	<head>
		<title>Transaksi Langganan</title>
		<style type="text/css">
		
	/* GLOBAL STYLES
-------------------------------------------------- */
/* Padding below the footer and lighter body text */

body {
  padding-bottom: 40px;
  color: #5a5a5a;
}


/* CUSTOMIZE THE NAVBAR
-------------------------------------------------- */

/* Special class on .container surrounding .navbar, used for positioning it into place. */
.navbar-wrapper {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  z-index: 20;
}

/* Flip around the padding for proper display in narrow viewports */
.navbar-wrapper > .container {
  padding-right: 0;
  padding-left: 0;
}
.navbar-wrapper .navbar {
  padding-right: 15px;
  padding-left: 15px;
}
.navbar-wrapper .navbar .container {
  width: auto;
}


/* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

/* Carousel base class */
.carousel {
  height: 500px;
  margin-bottom: 60px;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
  z-index: 10;
}

/* Declare heights because of positioning of img element */
.carousel .item {
  height: 500px;
  background-color: #777;
}
.carousel-inner > .item > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 500px;
}


/* MARKETING CONTENT
-------------------------------------------------- */

/* Center align the text within the three columns below the carousel */
.marketing .col-lg-4 {
  margin-bottom: 20px;
  text-align: center;
}
.marketing h2 {
  font-weight: normal;
}
.marketing .col-lg-4 p {
  margin-right: 10px;
  margin-left: 10px;
}


/* Featurettes
------------------------- */

.featurette-divider {
  margin: 80px 0; /* Space out the Bootstrap <hr> more */
}

/* Thin out the marketing headings */
.featurette-heading {
  font-weight: 10;
  line-height: 1;
  letter-spacing: -1px;
}


/* RESPONSIVE CSS
-------------------------------------------------- */

@media (min-width: 768px) {
  /* Navbar positioning foo */
  .navbar-wrapper {
    margin-top: 20px;
  }
  .navbar-wrapper .container {
    padding-right: 15px;
    padding-left: 15px;
  }
  .navbar-wrapper .navbar {
    padding-right: 0;
    padding-left: 0;
  }

  /* The navbar becomes detached from the top, so we round the corners */
  .navbar-wrapper .navbar {
    border-radius: 4px;
  }

  /* Bump up size of carousel content */
  .carousel-caption p {
    margin-bottom: 20px;
    font-size: 21px;
    line-height: 1.4;
  }

  .featurette-heading {
    font-size: 50px;
  }
}

@media (min-width: 992px) {
  .featurette-heading {
    margin-top: 10px;
  }
}

</style>
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
                    $("#rincian").load("pk.php","op=dt_lgn&id_cs="+id_cs);
                    $("#customer").load("pk.php","op=customer&id_cs="+id_cs);
                                      
     	$("#add").click(function()
     	{
  					   
                        id_cs=$("#id_cs").val();
                        jumlah=$("#jumlah").val();
                        no_nota=$("#no_nota").val();
						sisa= $("#sisa").val();
						c = parseInt(sisa)+ parseInt(jumlah)
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
                            data:"op=tambah&id_cs="+id_cs+"&jumlah="+jumlah+"&no_nota="+no_nota+"&total="+total,
                            cache:false,
                            success:function(msg)
                            {
                                $('#status').html(msg);
                               
                                 $("#no_nota").val("");
                                $("#jumlah").val("");
                                $("#ket").val("");
                                $("#rincian").load("pk.php","op=dt_lgn&id_cs="+id_cs);
                                $("#customer").load("pk.php","op=customer&id_cs="+id_cs);
                                $('#status').hide();
                                  printout();
                                
                            }
                        })
                    })
                    
                 $("#no_nota").change(function(){
                        var no_nota=$("#no_nota").val();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=cek&no_nota="+no_nota,
                            success:function(data){
                                if(data==0){
                                    $("#pesan").html('no nota Bisa digunakan');
                                    $("#no_nota").css('border','3px #090 solid');
                                    $("#kurang").removeAttr('disabled','');
                                    $("#add").removeAttr('disabled','');
                                }else{
                                    $("#pesan").html('no nota sudah ada');
                                    $("#no_nota").css('border','3px #c33 solid');
                                    $("#kurang").attr("disabled","");
                                     $("#add").attr("disabled","");
                                
                                }
                            }
                        });
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
                                 $("#no_nota").val("");
                                $("#jumlah").val("");
                                $("#ket").val("");
                              
                                $("#rincian").load("pk.php","op=dt_lgn&id_cs="+id_cs);
                                $("#customer").load("pk.php","op=customer&id_cs="+id_cs);
                                $('#status').hide();
                                printout();
                            }
                        })
                    })
                    
 });
                    
     	
     </script>
     
     <script language="javascript">
function Clickheretoprint()
{ 
	var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("print1").innerHTML);
    newWindow.print(); 
}
</script>
  <fieldset>
<legend align="center" ><strong>Transaksi Langganan</strong></legend>    
 <div class="container marketing">
      <!-- Three columns of text below the carousel -->
     <div class="row equal">
     <div id="customer"></div>
     </div>
 </div>
     
     
       <!-- START THE FEATURETTES -->

     

      <div class="row featurette">
        <div class="col-md-4 col-md-offset-4" >
        <fieldset>

        <span id="status"></span>
  		<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
  
	</fieldset>
</div>
       
         
        </div>
        
       
           <div class="row featurette">
        <div class="col-md-6 col-md-offset-3">
<div id="test" style="margin-top: 20px">
<fieldset>

<legend align="center" ><strong>Rincian</strong></legend>
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
<div id="print1">
 <table id="rincian" class="table table-bordered" border="1">
</table>
</div>
</fieldset>
</div>
        </div>
        
      </div>
      </fieldset>

      <!-- /END THE FEATURETTES -->


