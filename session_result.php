<?php 
session_start();

if(empty($_SESSION['user_id'])){
	echo '
		<div id="data-data-popup3">
			<div id="info3">
		        <h1>SESSION HABIS</h1>
			</div>	
		</div>
	';
}


?>