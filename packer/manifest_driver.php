

<style type="text/css">

	#popup {
		visibility:visible;
		opacity: 1;
		width: 100%;
		height: 100%;
		position: fixed;
		background: rgba(0,0,0,.7);
		top: 0;
		left: 0;
		z-index: 9999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}

	#info {
		display: block;
		width: 400px;
		height: auto;
		border-radius: 8px;
		position: relative;
		padding: 10px;
		opacity: 0;
		z-index: 9999;
		box-shadow: 0 0 5px rgba(0,0,0,.4);
		text-align: center;
		margin: 15% auto;
		background: #000;
		border:2px solid #fff;
		font: normal 1em Cambria,Georgia,Serif;
		color: #fff;
		-webkit-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
		-moz-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
		box-shadow:0px 1px 3px rgba(0,0,0,0.4);		
		animation: 1s growin ease-in-out;;
		animation-fill-mode: forwards;

	}

	#info2 {
		width: 520px;
		height: auto;
		border-radius: 8px;
		position: relative;
		padding: 10px 30px;
		z-index: 9999;
		box-shadow: 0 0 5px rgba(0,0,0,.4);
		text-align: center;
		margin: 10% auto;
		background: #007558;
		border:2px solid #fff;
		font: normal 1em Cambria,Georgia,Serif;
		color: #fff;
		-webkit-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
		-moz-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
		box-shadow:0px 1px 3px rgba(0,0,0,0.4);		
	}

	
	.tombol-close {
		width: 20px;
		height: 20px;
		background: #007558;
		border-radius: 50%;
		border: 2px solid #fff;
		display: block;
		text-align: center;
		color: #000;
		text-decoration: none;
		position: absolute;
		top: -10px;
		right: -10px;
	}

	@keyframes growin {
		0% {
			opacity: 0;
			transform: scale(0.5);
		}
		100% {
			opacity: 1;
			transform: scale(1);
		}
	}



</style>

<script src="../js/jquery-1.11.0.js"></script>
<div id="pop" onmousemove="stopInt()"></div>




<div id="form_driver" style="display: none">
	<div id="popup">
		<div id="info2">
			<p style="font-size: 18px">Mohon tunggu sebentar..!</p>
		</div>		
	</div>
</div>
	

<script type="text/javascript">
	
	function tampilkan_form_driver() {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if(xhr.readyState === 4 && xhr.status === 200){
				document.getElementById('pop').innerHTML = xhr.responseText;
			}
		}
		xhr.open('GET','aktifkan_driver.php',true);
		xhr.send();

	}

	var start = setInterval(function(){tampilkan_form_driver()},1000);

	function stopInt(){
		clearInterval(start);
		$('#pop').hide();
		$('#form_driver').slideToggle('fast');
		$('#info2').load('form_manifest_driver.php');
	};



</script>
