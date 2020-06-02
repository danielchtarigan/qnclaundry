<?php
include '../../config.php';
mysqli_query($con,"DELETE FROM delivery WHERE id_customer='$_GET[id]' AND no_faktur IS NULL AND jenis_permintaan='Antar' ORDER BY tgl_input DESC LIMIT 1");
?>

<script type="text/javascript">
 location.href="../index.php?id=<?php echo $_GET['id']; ?>&selesai=ya";
</script>
