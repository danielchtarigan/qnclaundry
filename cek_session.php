

<style type="text/css">

	#data-data-popup3 {
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

	#info3 {
		display: block;
		width: 200px;
		height: auto;
		border-radius: 8px;
		position: relative;
		padding: 10px;
		opacity: 1;
		z-index: 9999;
		box-shadow: 0 0 5px rgba(0,0,0,.4);
		text-align: center;
		margin: 15% auto;
		background: #fff;
		border:2px solid #fff;
		font: normal 1em Cambria,Georgia,Serif;
		color: #000;
		-webkit-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
		-moz-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
		box-shadow:0px 1px 3px rgba(0,0,0,0.4);		

	}





</style>
<script src="../js/jquery-1.11.0.js"></script>
<div id="data-pop3" onmousemove="stopInt3()"></div>





<script type="text/javascript">
	
	function tampilkan_session() {
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if(xhr.readyState === 4 && xhr.status === 200){
				document.getElementById('data-pop3').innerHTML = xhr.responseText;
			}
		}
		xhr.open('GET','../session_result.php',true);
		xhr.send();

	}

	var start = setInterval(function(){tampilkan_session()},300000);

	function stopInt3(){
		clearInterval(start);
		window.location = "../logout.php";
	};



</script>

