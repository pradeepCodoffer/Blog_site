<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!=true){
    header('location: login.php');
}
?>


<?php

include "components/db.php";
$db = new db_conn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $img ="";
if(isset($_FILES['image'])){
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
    else{
        $file_tmp = $_FILES['image']['tmp_name'];
        $img = time().".".$imageFileType; 
        move_uploaded_file($file_tmp, "images/". $img);
    }
}

  $title = mysqli_real_escape_string($db->conn,$_POST['title']);
  $desc = mysqli_real_escape_string($db->conn,$_POST['desc']);
  $author = mysqli_real_escape_string($db->conn,$_POST['author']);
  $insert = $db->insert($title, $desc, $author, $img);
  header("Location: index.php");
  exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://nqwebdesign.com/wp-content/uploads/2020/01/blog-icon.png">
    <title>Create Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            .outline{
                outline: 4px solid red;
            }
        </style>
</head>

<body>

<?php
    require "components/navbar.php";
?>
    <div class=" bg-success-subtle">
        <div class="container py-5">
            <form name="insertForm" method="post" action="" enctype="multipart/form-data" novalidate>

                <input type="hidden" name="submit">

                <h2 class="text-center">Create a new blog</h2>

                <div class="mb-3">
                    <label for="title" class="form-label">Blog Title</label>
                    <input type="text" class="form-control" maxlength="50" id="title" name="title" >
                    <div id="titleWarn" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Blog Description</label>
                    <textarea class="form-control " id="desc" name="desc" rows="8"></textarea>
                    <div id="descWarn" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" maxlength="15" id="author" name="author" >
                    <div id="authorWarn" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Choose Image</label>
                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
            </form>

        </div>
    </div>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function(){
            
            $("form").submit(function(){
                const title = $("#title").val();
                const desc = $("#desc").val();
                const author = $("#author").val();
                $("#titleWarn").text("");
                $("#descWarn").text("");
                $("#authorWarn").text("");
                $("#title").removeClass("outline");
                $("#desc").removeClass("outline");
                $("#author").removeClass("outline");
            if(title.length>50 || title==""){
                $('#title').addClass('outline');
                $('#titleWarn').text("Title must not greater than 50 characters and cannot blank.");
                return false;
            }
            
            if(desc.length<=150 || desc==null){
                $('#desc').addClass('outline');
                $('#descWarn').text("Description must be greater than 150 characters and cannot be blank.");
                return false;
            }
            
            if(author.length>15 || author==""){
                $('#author').addClass('outline');
                $('#authorWarn').text("Title must not greater than 15 characters and cannot be blank.");
                return false;
            }
        
            
        })
    })
        // const validation = (e)=>{
        //     const title = document.insertForm.title.value;
        //     const desc = document.insertForm.desc.value;
        //     const author = document.insertForm.author.value;
        //     document.getElementById('titleWarn').innerHTML = "";
        //     document.getElementById('descWarn').innerHTML = "";
        //     document.getElementById('authorWarn').innerHTML ="";
        //     document.getElementById('title').classList.remove('outline');
        //     document.getElementById('desc').classList.remove('outline');
        //     document.getElementById('author').classList.remove('outline');
        //     if(title.length>50 || title==""){
        //         document.getElementById('title').classList.add('outline');
        //         document.getElementById('titleWarn').innerHTML = "Title must not greater than 50 characters and cannot blank.";
        //         return false;
        //     }
            
        //     if(desc.length<=150 || desc==null){
        //         document.getElementById('desc').classList.add('outline');
        //         document.getElementById('descWarn').innerHTML = "Description must be greater than 150 characters and cannot be blank.";
        //         return false;
        //     }
            
        //     if(author.length>15 || author==""){
        //         document.getElementById('author').classList.add('outline');
        //         document.getElementById('authorWarn').innerHTML = "Title must not greater than 15 characters and cannot be blank.";
        //         return false;
        //     }
        // }
    </script>
</body>

</html>