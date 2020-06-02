<?php

 session_start();
 unset($_SESSION['level']);
 unset($_SESSION['name']);
 unset($_SESSION['nama_outlet']);

 
 header("location:index.php");
 
 ?>