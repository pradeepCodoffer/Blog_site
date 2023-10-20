<?php

include "components/db.php";
$db = new db_conn();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['update'])){
        $id = $_GET['update'];
        $idData = $db->fetchOneData($id);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $img = $_POST['img'];
   
if($_FILES['image']['name'] != ""){
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $target_old_file = $target_dir . basename($_POST['img']);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (file_exists($target_old_file)) {
        unlink($target_old_file);
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        var_dump( $imageFileType);
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
    else{
        $img = time().".".$imageFileType;
        $file_tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($file_tmp, "images/". $img);
    }
}

  $id = $_POST['id'];
  $title = mysqli_real_escape_string($db->conn,$_POST['title']);
  $desc = mysqli_real_escape_string($db->conn,$_POST['desc']);
  $author = mysqli_real_escape_string($db->conn,$_POST['author']);
  $update = $db->update($id,$title, $desc, $author, $img);
  header("Location: index.php ");
  exit();    
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://nqwebdesign.com/wp-content/uploads/2020/01/blog-icon.png">
    <title>Update Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .outline {
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
            <form name="updateForm" method="post" action="" enctype="multipart/form-data" novalidate>


                <h2 class="text-center">Update Blog</h2>
                <input class="form-control" type="hidden" id="img" name="img" value="<?php echo $idData['img']; ?>">
                <input class="form-control" type="hidden" id="id" name="id" value="<?php echo $idData['id']; ?>">

                <div class="mb-3">
                    <label for="title" class="form-label">Blog Title</label>
                    <input type="text" class="form-control" id="title" name="title" maxlength="50"
                        value="<?php echo $idData['title']; ?>">
                    <div id="titleWarn" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Blog Description</label>
                    <textarea class="form-control" id="desc" name="desc" rows="8"
                        required><?php echo $idData['description']; ?></textarea>
                    <div id="descWarn" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" name="author" maxlength="15"
                        value="<?php echo $idData['author']; ?>" required>
                    <div id="authorWarn" class="form-text text-danger"></div>
                </div>
                <div class="mb-3 d-flex justify-content-start">
                    <div>
                        <label for="image" class="form-label">Choose Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        <div id="emailHelp" class="form-text text-danger">If You want to change Img than upload new
                            image otherwise keep it blank.</div>
                    </div>
                    <div class="mx-4 border border-2 border-success rounded overflow-hidden"
                        style="width:100px; height:100px;">
                        <img src="<?php echo "images/".$idData['img']?>" alt="img" style="height: 100px; width:100px;">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
    <script src="js/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function () {

            $("form").submit(function () {
                const title = $("#title").val();
                const desc = $("#desc").val();
                const author = $("#author").val();
                $("#titleWarn").text("");
                $("#descWarn").text("");
                $("#authorWarn").text("");
                $("#title").removeClass("outline");
                $("#desc").removeClass("outline");
                $("#author").removeClass("outline");
                if (title.length > 50 || title == "") {
                    $('#title').addClass('outline');
                    $('#titleWarn').text("Title must not greater than 50 characters and cannot blank.");
                    return false;
                }

                if (desc.length <= 150 || desc == null) {
                    $('#desc').addClass('outline');
                    $('#descWarn').text(
                        "Description must be greater than 150 characters and cannot be blank.");
                    return false;
                }

                if (author.length > 15 || author == "") {
                    $('#author').addClass('outline');
                    $('#authorWarn').text(
                        "Title must not greater than 15 characters and cannot be blank.");
                    return false;
                }


            })
        })
    </script>
</body>

</html>