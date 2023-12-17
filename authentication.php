<?php

if (!empty($_POST['username'])) {

    include_once 'controlers.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = stripcslashes($username);
    $password = stripcslashes($password);

    $qry = $con->query(' select count(*) from TblUsers where username ="'
        . strtoupper($username) . '" and password ="' . strtoupper($password) . '" ');
    foreach ($qry as $row) {
        echo  $row[0];
        if($row[0] == 1 ){
            open_session_user($row[0]);   
        }
    }

    function open_session_user($a_user)
    {
        session_start();
        $_SESSION['user'] = $a_user;
    }
}
