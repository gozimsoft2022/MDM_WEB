<?php
$begin_template="
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>M.D.M</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
        <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
    </head>
    <body>
     <div class='topnav'>
        <a href='credit.php'>الديون</a>
        <a href='user.php'>المستخدم</a>
        <a href='clients.php'>العملاء</a>
        <a href='about.php'>حول</a>
        <a id ='a_logout' href='controlers.php?logout' style='display:none;' >تسجيل الخروج</a>
      </div>
";

$str = "";
session_start();
if(!empty($_SESSION['id_user'])){
    $str =  " <Script> $(document).ready(function(){ $('#a_logout').show();}); </Script> " ;
}
 
$end_template = "
       <script src='js/main.js'></script>
       <script src='js/jquery-1.11.1.js'></script>
       <script src='js/myjs.js'></script> ".$str.
    " </body> </html>" ;