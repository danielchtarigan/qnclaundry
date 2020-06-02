<?php	
	if (!isset($_SESSION['user_id']) and !isset($_SESSION['level']) and !isset($_SESSION['nama_outlet']))
	{
		?>
        <script type="text/javascript">
		 location.href="http://qnclaundry.com";
		</script>
<?php
	}	
?>