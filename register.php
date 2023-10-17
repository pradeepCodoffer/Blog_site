<?php
    include "components/db.php";
    $db = new db_conn();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email =  mysqli_real_escape_string($db->conn,$_POST['email']);
        $name=  mysqli_real_escape_string($db->conn,$_POST['name']);
        $phone =  mysqli_real_escape_string($db->conn,$_POST['phone']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $register = $db->register($email,$name,$password,$phone);
        if($register){
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $name;
            header("location:index.php");
        }
    }
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <form name="regisForm" method="post" action="" onsubmit="return validation()">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
              <div id="emailWarn" class="form-text text-danger"></div>

            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name">
              <div id="nameWarn" class="form-text text-danger"></div>

            </div>
            <div class="mb-3">
              <label for="phoneNo" class="form-label">Phone Number</label>
              <input type="number" class="form-control" id="phoneNo" name="phoneNo">
              <div id="phoneNoWarn" class="form-text text-danger"></div>

            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">

            </div>
            <div class="mb-3">
              <label for="cPassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="cPassword" name="cPassword">
              <div id="cPassWarn" class="form-text text-danger"></div>

            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const validation = (e)=>{
            console.log("validation");
            const email = document.regisForm.email.value;
            const name = document.regisForm.name.value;
            const phoneNo = document.regisForm.phoneNo.value;
            const password = document.regisForm.password.value;
            const cPassword = document.regisForm.cPassword.value;
            document.getElementById('emailWarn').innerHTML = "";
            document.getElementById('nameWarn').innerHTML = "";
            document.getElementById('phoneNoWarn').innerHTML ="";
            document.getElementById('cPassWarn').innerHTML ="";
            document.getElementById('email').classList.remove('outline');
            document.getElementById('name').classList.remove('outline');
            document.getElementById('phoneNo').classList.remove('outline');
            document.getElementById('cPassword').classList.remove('outline');
            var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if(email.length>25 || email=="" || !email.match(validRegex)){
                document.getElementById('email').classList.add('outline');
                document.getElementById('emailWarn').innerHTML = "Email must not greater than 25 characters and cannot blank and it should be valid email.";
                return false;
            }
            
            if(name.length>25 || name==""){
                document.getElementById('name').classList.add('outline');
                document.getElementById('nameWarn').innerHTML = "Description must not be greater than 25 characters and cannot be blank.";
                return false;
            }
            
            if(phoneNo.length>11 || phoneNo==""){
                document.getElementById('phoneNo').classList.add('outline');
                document.getElementById('phoneNoWarn').innerHTML = "Title must not greater than 11 characters and cannot be blank.";
                return false;
            }
            if(password!=cPassword || password=="" || cPassword=="") {
                document.getElementById('password').classList.add('outline');
                document.getElementById('cPassword').classList.add('outline');
                document.getElementById('cPassWarn').innerHTML = "Must be same as Password and both the field cannot be blank.";
                return false;
            }
        }
    </script>
  </body>
</html>