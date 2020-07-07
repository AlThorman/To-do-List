<?php

$host = 'localhost';
$user = 'AlThorman';
$pwd = '12345678';
$db = 'Tarmeez';
$port = '8888';

$con = mysqli_connect($host,$user,$pwd,$db,$port);

if(mysqli_connect_errno($con)) 
    
   { echo mysqli_connect_error();  } 


?>

