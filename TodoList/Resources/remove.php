<?php

if (isset($_POST['id'])){
    require ('connection-db.php');
    
    $id = $_POST['id'];
    
    if (empty($id)){
        echo 0;
    } else {
        
        $query= "DELETE FROM `Todo` WHERE id=$id";
            $res = mysqli_query($con , $query);
       
        if ($res)
        {
            echo 1;
        } else {
            echo 0;
        }
        
    }
}





