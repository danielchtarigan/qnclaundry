<html>
<head>

<?php

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
include "header.php";
include "../config.php";

$kemarin = date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d'))));

$quser = mysqli_query($con, "SELECT name FROM user WHERE jenis='superAdmin'");
$row = mysqli_fetch_row($quser);
$superAdmin = $row[0];

?>
</head>
<body>


<div class="container" style="width:1300px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:50px; margin-bottom:50px; color:#000000;">
	<ul class="nav nav-tabs">
		<li class="nav-item active" role="presentation"><a class="nav-link active" role="tab" data-toggle="tab" href="#makassar"><strong>MAKASSAR</strong></a></li>
		<li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#mojokerto"><strong>MOJOKERTO</strong></a></li>				
	</ul>

	<div class="tab-content">
		
		<div id="makassar" role="tabpanel" class="tab-pane active">
		    <?php require 'include/terlambat_makassar.php'; ?>
		</div>

		<div id="mojokerto" role="tabpanel" class="tab-pane">	
			<?php require 'include/terlambat_mojokerto.php'; ?>
		</div>		
		
	</div>
</div>
</body>
</html>
