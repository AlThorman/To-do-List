<?php

if (isset($_POST['id'])){
    require ('connection-db.php');
    
    $id = $_POST['id'];
    
    if (empty($id)){
        echo 'error';
    } else {
        
        $query= "SELECT id,checked FROM `Todo` WHERE id=$id";
            $res = mysqli_query($con , $query);
        
        $r = mysqli_fetch_assoc($res);
        $uid = $r['id'];
        $checked = $r['checked'];
        
        $uChecked = $checked ? 0 : 1;
        
        $query2= "UPDATE `Todo` SET checked=$uChecked WHERE id=$uid";
            $result = mysqli_query($con , $query2);
        
        
        if ($result)
        {
            echo $checked;
        } else {
            echo "error";
        }
        
    }
}





