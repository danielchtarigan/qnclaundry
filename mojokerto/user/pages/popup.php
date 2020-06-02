	<link rel="stylesheet" type="text/css" href="../css/demo.css">
	<style type="text/css">
	#popup {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}

	@media (min-width: 768px){
		.popup-container {
			width:600px;
		}
	}
	@media (max-width: 767px){
		.popup-container {
			width:100%;
		}
	}
	.popup-container {
		position: relative;
		margin:7% auto;
		padding:30px 50px;
		background-color: #6C0;
		color:#fff;
		border-radius: 3px;
	}

	a.popup-close {
		position: absolute;
		right:550px;
		font-size: 20px;
		text-decoration: none;
		line-height: 1;
		color:#333;
	}

	/* style untuk isi popup */


	.popup-form {
		margin:10px auto;
	}
		.popup-form h2 {
			margin-bottom: 5px;
			font-size: 37px;
			text-transform: uppercase;
		}
		.popup-form .input-group {
			margin:10px auto;
		}
			.popup-form .input-group input {
				padding:17px;
				text-align: center;
				margin-bottom: 10px;
				border-radius:3px;
				font-size: 16px; 
				display: block;
				width: 100%;
			}
			.popup-form .input-group input:focus {
				outline-color:#FB8833; 
			}
			.popup-form .input-group input[type="email"] {
				border:0px;
				position: relative;
			}
			.popup-form .input-group input[type="submit"] {
				background-color: #FB8833;
				color: #fff;
				border: 0;
				cursor: pointer;
			}
			.popup-form .input-group input[type="submit"]:focus {
				box-shadow: inset 0 3px 7px 3px #ea7722;
			}
	/* end isi form */
	</style>
    
    <style type="text/css">
	#popup1 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup1:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}

	#popup2 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup2:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}

	#popup3 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup3:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup4 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup4:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup5 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup5:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup6 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup6:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup7 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup7:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup8 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup8:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup9 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup9:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup10 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup10:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:10px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup11 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup11:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup12 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup12:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}
	
	#popup20 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup20:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup21 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup21:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}


	#popup22 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup22:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}
	
	#popup13 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup13:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}
	
	#popup14 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup14:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}
	
	#popup19 {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popup19:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:100px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}	

	#popupaudit {
		visibility: hidden;
		opacity: 0;
		margin-top: -200px;
	}
	#popupaudit:target {
		visibility:visible;
		opacity: 1;
		position: fixed;
		top:50px;
		left:600px;
		right:0;
		bottom:0;
		margin:0;
		z-index: 99999999999;
		-webkit-transition:all 1s;
		-moz-transition:all 1s;
		transition:all 1s;
	}	
	
	
	</style>
    