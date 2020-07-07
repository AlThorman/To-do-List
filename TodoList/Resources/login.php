
    

<?php 
session_start();



include('connection-db.php'); 

$error = 0;
$mess = 0;
if (isset($_POST['login']))
{
    
    $uid = $_POST['uid'];
    $pwd = md5($_POST['pwd']);
    
    $query = "select * FROM user WHERE uid='$uid' and password = '$pwd'";
    $result = mysqli_query($con , $query);
    
    
    if (mysqli_num_rows ($result) === 1)
    {
        session_regenerate_id();
        $auth_code = session_id();
        
        $_SESSION['uid'] = $uid;
        
        $auth_query = "UPDATE `user` SET `access_token` = '$auth_code' WHERE `uid`='$uid'";
        $res = mysqli_query($con , $auth_query);
        
        if ($res)
        {
           header("Location: index.php");
            exit();
        }
        
    }
    
    
    
    else
    {
        $error = 1;
    }
    
}

if (isset($_POST['register']))
{
    
    $id = $_POST['uid'];
    $pass = md5($_POST['pwd']);
    
    
        $add = "INSERT INTO `user`(`uid`,`password`) VALUES ('$id','$pass')";
        $resu = mysqli_query($con , $add);
        
        if ($resu)
        {
           $mess = 1;
            
        }
    
    
}








?>


<html>
    
    <head>
        <title> Login | Tarmeez </title>
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    
    </head>
<body>
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
    <form id="contact" name="add" method="POST" action="login.php" class="login100-form validate-form">
        <span class="login100-form-title p-b-26">
						Welcome
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

        
                    
                    <div class="wrap-input100 validate-input">
                    <input type="text" name="uid" id="uid" class="input100" placeholder="Username">
                        <span class="focus-input100"></span>
					</div>
        
                    <div class="wrap-input100 validate-input">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
       
                      <input type="password" name="pwd" id="pwd" class="input100" placeholder="Password">
                        <span class="focus-input100"></span>
					</div>
        
                            
                            
                            <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" value="Login" name="login">
								Login
							</button>
						</div>
					</div>
                            <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" value="Register" name="register">
								Register
							</button>
						</div>
					</div>
                            
                                
                            
   </form>
                <br>
                                                      
        <?php if(isset($error) and $error == 1){?>
        
                
                <div class="alert alert-danger" role="alert">
                    Incorrect Username / Password. Please Try Again.
                    </div>
                
        <?php } ?>
        
    <?php if(isset($error) and $mess == 1){?>
        
          
                <div class="alert alert-success" role="alert">
                    You Have Registered Successfully
                    </div>
                
        <?php } ?>
    


</div>
    </div>
    </div>
</body>
    
</html>