<?php

include "components/db.php";
$db = new db_conn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $img;
if(isset($_FILES['image'])){
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $img = $file_name;

    move_uploaded_file($file_tmp, "images/". $file_name);
}

  $title = $_POST['title'];
  $desc = $_POST['desc'];
  $author = $_POST['author'];
  $insert = $db->insert($title, $desc, $author, $img);
  header("Location: index.php ");
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
</head>

<body>

<?php
    require "components/navbar.php";
?>
    <div class=" bg-danger-subtle">
        <div class="container py-5">
            <form method="post" action="" enctype="multipart/form-data">

                <input type="hidden" name="submit">

                <h2 class="text-center">Create a new blog</h2>

                <div class="mb-3">
                    <label for="title" class="form-label">Blog Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Blog Description</label>
                    <textarea class="form-control" id="desc" name="desc" rows="8"></textarea>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Choose Image</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
            </form>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>