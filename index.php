<?php
include "db.php";

$db = new db_conn();
if (isset($_POST['update'])) {
    $id = $_POST['update'];
    $title = $_POST['eTitle'];
    $desc = $_POST['eDesc'];
    $author = $_POST['eAuthor'];
    $insert = $db->update($id, $title, $desc, $author);
    header("Location: index.php ");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = $db->delete($id);
    header("Location: index.php ");
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Coder Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <!-- Navbar starts -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Coder Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_blog.php">Create Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Navbar ends -->

    <!-- Header starts -->

    <div class="container py-4">
        <h1 class="text-center">Welcome to my BLog</h1>
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
                <div class="col-md-4">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">' . $blog["title"] . '</h5>
                        <p class="card-text">' . substr($blog['description'], 0, 180) . '...</p>
                        <p class="card-text d-none">' . $blog['description'] . '</p>
                        <p class="card-text text-strong"> By - ' . $blog['author'] . '</p>
                        <p class="card-text"><small class="text-body-secondary">' . $blog["date"] . '</small></p>
                        <div class="d-flex">
                        <button type="button" id=' . $blog['id'] . ' class="edit btn btn-info mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        <button type="button" id=d' . $blog['id'] . ' class="delete btn btn-danger">Delete</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>

    </div>

    <!-- Modal starts -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">

                        <input type="hidden" name="update" id="update">

                        <h2 class="text-center">Update a Your blog</h2>

                        <div class="mb-3">
                            <label for="eTitle" class="form-label">Blog Title</label>
                            <input type="text" class="form-control" id="eTitle" name="eTitle">
                        </div>
                        <div class="mb-3">
                            <label for="eDesc" class="form-label">Blog Description</label>
                            <textarea class="form-control" id="eDesc" name="eDesc" rows="8"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="eAuthor" class="form-label">Author</label>
                            <input type="text" class="form-control" id="eAuthor" name="eAuthor">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal ends -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>