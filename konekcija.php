<?php
  error_reporting(E_ALL | E_STRICT);
  ini_set("display_errors", true);
  ini_set("log_errors", true);


  $conn = new MySqli('localhost', 'root','','putovanje');
  $conn->set_charset("utf8");
 ?>
 