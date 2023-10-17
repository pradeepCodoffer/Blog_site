<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!=true){
    header('location: login.php');
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" >
  </head>
  <body>
    <?php
    require "components/navbar.php";
    ?>
    <div class="container py-5">
        <h2 class="mb-4 text-center">List of Blogs</h2>
        <table id="example" class="display table table-dark table-striped" style="width:100%">
            <thead>
              <tr>
                <th scope="col">S.no</th>
                <th scope="col">Title</th>
                <th scope="col">About</th>
                <th scope="col">Author</th>
                <th scope="col">Posted on</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "components/db.php";
              $db = new db_conn();
              $blogs = $db->fetchData();
              $no = 1;
              while($blog = mysqli_fetch_assoc($blogs)){
              echo '<tr onclick="view('.$blog['id'].')">
                <th scope="row">'.$no.'</th>
                <td>'.$blog["title"].'</td>
                <td>'.substr($blog["description"],0,75).'...</td>
                <td>'.$blog["author"].'</td>
                <td>'.$blog["date"].'</td>
              </tr>';
              $no++;
              }
              ?>
            </tbody>
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
       $('#example').DataTable();
       function view(id){
        window.location = `view.php?view=${id}`;
       }
    </script>
  </body>
</html>