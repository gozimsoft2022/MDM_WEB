<?php
include_once "const.php";
$path_db = PATH_DB  ;

$con = new PDO($path_db);
if (!$con) {
    $is_con = false;
} else {
    $is_con = true;
}
 