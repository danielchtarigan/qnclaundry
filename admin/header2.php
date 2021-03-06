<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
   <link href="../lib/css/bootstrap.min.css" rel="stylesheet">
   
   <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css" />
   <link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">
   <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables_themeroller.css" />
   <link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.yadcf.css">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
<?php
session_start();
     
 ?>
 </head>
  <body>
  
    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
         
            <ul class="nav navbar-nav">
            
              <li class=""><a href="update.php">Home</a></li>
               <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Edit<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="update.php">Data Reception</a></li>
               
			 <li><a href="data_operator.php">Data Operator</a></li>
                  <li><a href="data_setrika.php">Data Setrika</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
           
              <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
              <li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <!-- Main component for a primary marketing message or call to action -->
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <script src="../lib/js/jquery-2.1.3.min.js"></script>
  <script src="../lib/js/bootstrap.min.js"></script>
  <script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
  <script src="js/jquery.form.js"></script>
  <script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.yadcf.js"></script>
   
  </body>
</html>
