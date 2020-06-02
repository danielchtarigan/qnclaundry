<?php

/* If you have valid PRO License, make definition below active,
   so website knows it should unlock PRO functions.
   Just make sure you have added your servers to the list 
   in Manager Area (www.kopage.com/manager) */
   
define('kopagePRO',1);

/* By default, Kopage is a cPanel Website builder, 
   so if you're not using cPanel on your server, 
   make definition below active to disable cPanel-login process 
   
   Possible alternatives to cPanel login: 
   
		1 = only email/pin option
   		DA = DirectAdmin
		FTP = login with FTP user/pass
		WHMCS = will redirect to WHMCS, 
				this will also require WHMCS URL to be defined, 
				like define('whmcsLoginLink','http://ifastnet.com/portal');

   
   */
   
// define('noCPanelLogin','FTP');

?>
