<?php	
	if (!isset($_SESSION['user_id']) and !isset($_SESSION['level']))
	{
		?>
        <script type="text/javascript">
		 location.href="http://qnclaundry.com";
		</script>
<?php
	} else if ($_SESSION['level']!='delivery'){
	?>
        <script type="text/javascript">
         alert("Session habis, silahkan login kembali!");
		 location.href="http://qnclaundry.com";
		</script>
<?php
	}
	
?>