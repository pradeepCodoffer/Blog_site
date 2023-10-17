<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!=true){
    header('location: login.php');
}
include "components/db.php";

$db = new db_conn();
if (isset($_GET['delete']) && $_GET['img']) {
    $img = $_GET['img'];
    $id = $_GET['delete'];
    $delete = $db->delete($id);
    $target_dir = "images/";
    $target_file = $target_dir . $img;
    if (file_exists($target_file)) {
        unlink($target_file);
    }
    header("location: index.php");
    exit();
}

if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header('location:login.php');
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://nqwebdesign.com/wp-content/uploads/2020/01/blog-icon.png">

    <title>Coder Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

<?php
    require "components/navbar.php";
    
?>
    

    <!-- Header starts -->

    <div class="container py-4">
        <h1 class="text-center">Welcome to my Blogs</h1>
        <img src="https://www.codecademy.com/resources/blog/wp-content/uploads/2022/12/What-Is-Pair-Programming--1-1024x476.png"
            class="img-fluid" alt="heading image">
    </div>

    <!-- Header Ends -->

    <!-- Blog Card starts -->

    <div class="container">

        <h3 class="py-3">Our Blogs</h3>

        <?php

        $blogs = $db->fetchData();

        while ($blog = mysqli_fetch_assoc($blogs)) {
            echo '<div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center">
                    <img src="./images/'. $blog["img"]. '"
                        class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">' . $blog["title"] . '</h5>
                        <p class="card-text">' . substr($blog['description'], 0, 180) . '...</p>
                        <p class="card-text d-none">' . $blog['description'] . '</p>
                        <p class="card-text text-strong fw-bold"> By - ' . $blog['author'] . '</p>
                        <p class="card-text"><small class="text-body-secondary fw-bold">' . date('d-M-Y',strtotime($blog['date'])) . '</small></p>
                        <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="edit.php?update='.$blog['id'].'" class="edit btn btn-warning mx-2">Edit</a>
                            <button type="button" id=d' . $blog['id'] . ' class="delete '.$blog['img'].' btn btn-danger">Delete</button>
                            <a href="view.php?view='.$blog['id'].'" class="btn btn-info mx-2">View</a>
                        </div>
                        <div>
                            <img style=" width:35px; " src="./assests/like.png" alt="likes" />
                            <span class="card-text"><small class="text-body-secondary fw-bold">'.$blog['likes'].'</small></span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
  

deletes = document.getElementsByClassName('delete');
Array.from(deletes).forEach((element) => {
    element.addEventListener('click', (e) => {
        
        if(confirm("Are you sure you want to delete?")){
            list = e.target.classList[1];
            id = e.target.id.substring(1);
            console.log(list);
            window.location = `index.php?delete=${id}&img=${list}`;
        }
    })
})

    </script>
</body>

</html>