<?php 

    session_start();
    
    require('connection-db.php');

    if (isset($_SESSION['uid']))
    {
        $uid = $_SESSION['uid'];
        
        $verify = "select `access_token` FROM user WHERE uid='$uid'";
        $resu = mysqli_query($con , $verify);
        
        if (mysqli_num_rows ($resu) === 1)
    {
        $r = mysqli_fetch_assoc($resu);
            
        $auth_code = $r['access_token'];
            
            if ($auth_code !=$_COOKIE['PHPSESSID'])
            {
                header("Location: login.php");
                exit();
            }
        
    }
        else
    {
        header("Location: login.php");
         exit();
    }
    }

    else
    {
        header("Location: login.php");
         exit();
    }
    

?>




<!DOCTYPE html>
<html lang="en">
<head>
    
    <title> Todo List | Tarmeez </title>
    
    <meta charset="utf-8">
    <meta name="viewprot" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    
    <style>
    #imgg
{
    margin-top: 10px !important;
    margin-left: 120px !important;
    width: 20px !important;
    
}
    
    </style>
    
    </head>


<body>
    <div class="limiter">
		<div class="container-login100">
            <div class="wrap-login100">
    <div class="add-section">
    <form action="add.php" method="post" autocomplete="off">
    <?php if (isset($_GET['mess']) && $_GET['mess'] == "error"){ ?>
        <input type="text" name="title" placeholder="This is required"/>
        <button type="submit">Add a Task</button>
        
        <?php } else {?>
      <input type="text" name="title" placeholder="What Do You Need To Do"/>
        <button type="submit">Add a Task</button>
        
        
        
        
        
        
        <?php }?>
        </form>    
        
        </div>
        <?php
        $query = "SELECT * FROM Todo  WHERE user_fk='$uid'";
        $result = mysqli_query($con,$query);?>
        <div class="show-todo-section">
            <?php if (mysqli_num_rows ($result) <= 0 ) {?>
            
            
            
            </div>
            <?php } ?>
    
    
    
    <?php while ($row = mysqli_fetch_assoc($result)) 
{ ?>
    
        <div class="todo-item">  
        <span id="<?php echo $row['id'];?>" class="remove-to-do">x</span>
            <?php if($row['checked']) {?>
            <input type="checkbox" class="check-box" checked data-todo-id="<?php echo $row['id'];?>">
            <h2 class="checked"> <?php echo $row['title']?></h2>
            <br>
            <small>Created: <?php echo $row['date']?></small>
            
            <?php } else {?>
            <input type="checkbox" class="check-box" data-todo-id="<?php echo $row['id'];?>">
            <h2 class=""> <?php echo $row['title']?></h2>
            <br>
            <small>Created: <?php echo $row['date']?></small>
            <?php } ?>
        
        </div>
            <?php }?>
                
                <a href="logout.php">
                    <img alt="Logout" src="images/images.png" id="imgg">
                </a>
    </div>  
    </div>
    </div>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.remove-to-do').click(function(){
            const id = $(this).attr('id');
            
            $.post("remove.php",
            
            {
                id:id
            },
                (data) => {
                    
                if(data){
                    $(this).parent().hide(600);
                }
                        
                    
                }
            );
        });
        
        $('.check-box').click(function(e) {
            const id = $(this).attr('data-todo-id');
            
            $.post('check.php',
                   {
                id:id
            },
                   (data) => {
                if(data != "error"){
                   const h2 = $(this).next();
                    
                    if(data == 1){
                        console.log(data);
                        h2.removeClass('checked');
                        
                    } else {
                        h2.addClass('checked');
                    }
                    
                }
            }
                  
                  
                  );
            
        });
        
    });
    
    </script>
    
    </body>

</html>