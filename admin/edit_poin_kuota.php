<?php
///rupiah adalah fungsi yang nantinya akan kita panggil
     function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
     session_start();

$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

?>
<?php
include "../config.php";
$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='up_cst_lgn')
{
	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
    $id=$_GET['id'];
    $kuota=$_GET['kuota'];
    
    
    $tambah=mysqli_query($con," update customer set lgn=1,sisa_kuota='$kuota' WHERE id='$id'");
       
    if($tambah)
    {
       echo "sukses";
     
    }else
    {
        echo "ERROR";
    }
}

elseif($op=='up_cst_member')
{
	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
    $id=$_GET['id'];
    $jenis=$_GET['jenis'];
    $tgl_join=$_GET['tgl_join'];
    $tgl_akhir=$_GET['tgl_akhir'];
    $poin=$_GET['poin'];
    
    
    
    $tambah=mysqli_query($con," update customer set member=1 ,poin='$poin', jenis_member='$jenis',tgl_join='$tgl_join',tgl_akhir='$tgl_akhir' WHERE id='$id'");
       
    if($tambah)
    {
       echo "sukses";
    }else
    {
        echo "ERROR";
    }
}  
?>

