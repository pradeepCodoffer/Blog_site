<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login']!=true){
    header('location: login.php');
}


?>


<?php
  include 'components/db.php';
  $db = new db_conn();
  $data;
  if(isset($_GET['view'])){
    $id = $_GET['view'];
    $data = $db->fetchOneData($id);
  }

  if(isset($_GET['like'])){
    $id = $_GET['like'];
    $email = $_SESSION['email'];
    $liked = $db->insertLike($email,$id);
    header('location: view.php?view='.$id.'');
  }
  
  if(isset($_GET['dislike'])){
    $id = $_GET['dislike'];
    $email = $_SESSION['email'];
    $liked = $db->deleteLike($email,$id);
    header('location: view.php?view='.$id.'');
  }

  $liked = false;
  if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $id = $_GET['view'];
    $isLiked = $db->fetchLikedInfo($id,$email);
    // var_dump( $isLiked);
    // exit();
    if($isLiked!=null){
      $liked = true;
    }
  }
  

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://nqwebdesign.com/wp-content/uploads/2020/01/blog-icon.png">
    <title>Blog - <?php echo $data['title'];?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require "components/navbar.php";
    ?>
    <div class="container my-5">

        <h1 class="text-center"><?php echo $data['title']; ?></h1>
        <div class=" text-center border border-2 mx-auto border-warning-subtle overflow-hidden my-5 d-flex justify-content-center" style="width: 400px; height: 300px; ">
          <img src="./images/<?php echo $data["img"]; ?>" class="img-fluid object-cover" alt="blog-img">
        </div>
        <div>
          <p class="text-justify" style="text-align: justify;"><?php echo $data['description'];?></p>
          <div class="d-flex justify-content-between py-3">
            <p class="fw-bold fs-4">Date:-<?php echo date('d-M-Y',strtotime($data['date'])); ?></p>
            <?php
            if(!$liked){
              echo '<div id = "like">
            <img style=" width:35px; " src="./assests/unlike.png" alt="likes" />
              <span class="card-text"><small class="text-body-secondary fw-bold">Like</small></span>
            </div>';
            }
            else{
              echo '<div id ="dislike">
            <img style=" width:35px; " src="./assests/like.png" alt="likes" />
              <span class="card-text"><small class="text-body-secondary fw-bold">Liked</small></span>
            </div>';
            }
            ?>
            <p class="fw-bold fs-4">By:-<?php echo $data['author']; ?></p>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
      const like = document.getElementById('like');
      like.addEventListener('click', function(e){
        const view = window.location.search;
        const urlParams = new URLSearchParams(view);
        const id = urlParams.get('view');
        window.location= `view.php?like=${id}`;
      });

      
    </script>
    <script>
      const disLike = document.getElementById('dislike');
      disLike.addEventListener('click', function(e){
        console.log("e");
        const view = window.location.search;
        const urlParams = new URLSearchParams(view);
        const id = urlParams.get('view');
        window.location= `view.php?dislike=${id}`;
      });
    </script>
  </body>
</html>