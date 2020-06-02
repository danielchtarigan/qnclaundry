<link rel="stylesheet" type="text/css" href="../css/demo.css">
<style type="text/css">
.popup-wrapper {
	/*display: none;*/
	visibility: hidden;
	opacity: 0;
	margin-top: -200px;
}
.popup-wrapper:target {
	/*display: block;*/
	visibility: visible;
	opacity: 1;
	position: fixed;
	top:100px;
	left:600px;
	right:0;
	bottom:0;
	margin:0;
	z-index: 99;
	-webkit-transition:all 1s;
	-moz-transition:all 1s;
	transition:all 1s;
}
.popup-wrapper#popupdelivery {
	/*display: none;*/
	position: absolute;
	top: 50px;
	left: 50px;
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
		font-size: 28px;
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
