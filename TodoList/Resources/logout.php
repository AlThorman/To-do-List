<?php

session_start();
include('connection-db.php');


  $uid = $_SESSION['uid'];

$del_query = "UPDATE `user` SET `access_token` = '' WHERE `uid`='$uid'";
$res = mysqli_query($con , $del_query);

        if ($res)
        {
           unset($_SESSION['uid']);
            session_destroy();
            header("Location: login.php");
            exit();
        }




?>

