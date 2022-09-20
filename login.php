<?php

$login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){

    require 'partial/_db_connect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];

        // $sql = "Select * from users where username='$username' AND password='$password'";
        $sql = "Select * from users where username='$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            while($row=mysqli_fetch_assoc($result)){
                if(password_verify($password,$row['password'])){
                    $login = true;
                    session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['username']=$username;
                    header("location: welcome.php");                
                }
                else{
                    $showError = true;
                }
                
            }
        }

    else{
        $showError = true;
        // echo "Password do not match";
    }
    
}
?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Login</title>
    </head>
    <body>
        <?php require 'partial/_nav.php'; 
        if($login){

            echo'
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are successfully logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if($showError){

            echo'
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Email or Password do not match.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <div class="container">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center my-5">Log in to continue</h2>
                <form action="/Login_system/login.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Email or Username</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Log in</button>
                </form>
            </div>
        </div>





        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>