<?php
session_start();

if (isset($_POST['title'])){
    require ('connection-db.php');
    
    $title = $_POST['title'];
    $user = $_SESSION['uid'];
    
    if (empty($title)){
        header("Location: index.php?mess=error");
    } else {
        
        $query= "INSERT INTO `Todo`(`title`,`user_fk`) VALUES ('$title','$user');";
            $res = mysqli_query($con , $query);
        
        if ($res)
        {
            header("Location: index.php?mess= success");
        } else {
            header("Location: index.php");
        }
        
    }
}




?>