<?php
    include "components/db.php";
    $db = new db_conn();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = mysqli_real_escape_string($db->conn,$_POST['email']);
        $password = $_POST['password'];
        $login = $db->loginData($email);
        if(password_verify($password,$login['password'])){
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['email'] = $login['email'];
            $_SESSION['username'] = $login['name'];
            header("location:index.php");
        }
        else{
            echo "<script>alert('Invalid Credentials')</script>";
        }
    }
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://nqwebdesign.com/wp-content/uploads/2020/01/blog-icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Login</title>
    <style>
        .outline{
            outline: 2px solid red;
        }
    </style>
  </head>
  <body>
    <?php
        require("components/navbar.php");
    ?>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Create New Account</h2>
        <form name="loginForm" method="post" action="" onsubmit="return validation()">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
              <div id="emailWarn" class="form-text text-danger"></div>
              
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <div id="passWarn" class="form-text text-danger"></div>
              
            </div>
            
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const validation = (e)=>{
            console.log("validation");
            const email = document.loginForm.email.value;
            const password = document.loginForm.password.value;
            document.getElementById('emailWarn').innerHTML = "";
            document.getElementById('passWarn').innerHTML ="";
            document.getElementById('email').classList.remove('outline');
            document.getElementById('password').classList.remove('outline');
            var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if(email=="" || !email.match(validRegex)){
                document.getElementById('email').classList.add('outline');
                document.getElementById('emailWarn').innerHTML = "Email cannot blank and it should be valid email.";
                return false;
            }
            if(password=="") {
                document.getElementById('password').classList.add('outline');
                document.getElementById('passWarn').innerHTML = "Password cannot be blank.";
                return false;
            }
        }
    </script>
  </body>
</html>