<?php
include 'db_connetion.php';
class db_conn extends connection
{
  public function insert($title, $description, $author, $img)
  {
    $sql = "INSERT INTO `blog_list` (`title`, `description`, `author`, `date`, `img`) VALUES ('$title', '$description','$author', current_timestamp(), '$img')";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      echo "Your data is inserted successfully.";
    } else {
      echo '<script>alert("Data is not inserted due to some technical error.")</script>';
      header("location:index.php");
      exit();
    }
  }
  public function fetchData()
  {
    $sql = "SELECT * FROM `blog_list`";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      return $result;
    } else {
      echo '<script>alert("Data is not fetched due to some technical error.")</script>'; 
      // header("location:index.php");
      exit();
    }
  }
  public function fetchLimitData($set)
  {
    $sql = "SELECT * FROM `blog_list` LIMIT 5 OFFSET $set";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      return $result;
    } else {
      echo '<script>alert("Data is not fetched due to some technical error.")</script>'; 
      // header("location:index.php");
      exit();
    }
  }
  public function countBlogs()
  {
    $sql = "SELECT COUNT(id) FROM `blog_list`";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      return $result;
    } else {
      print_r($result);
      echo '<script>alert("Data is not fetched due to some technical error.")</script>'; 
      // header("location:index.php");
      exit();
    }
  }
  public function fetchOneData($id)
  {
    $sql = "SELECT * FROM `blog_list` WHERE `blog_list`.`id` = '$id'";
    $result = mysqli_query($this->conn, $sql);
    if ($result->num_rows==1) {
      $row = $result->fetch_assoc();
      return $row;
    } else {
      echo '<script>alert("Data is not updated due to some technical error.")</script>';
      header("location:index.php");
    }
  }
  public function update($id, $title, $description, $author, $img)
  {

    $sql = "UPDATE `blog_list` SET `title` = '$title', `description` = '$description' , `author` = '$author', `img` = '$img' WHERE `blog_list`.`id` = '$id'";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      echo "data is  updated successfully";
    } else {
      echo '<script>alert("Data is not updated due to some technical error.")</script>';
      exit();
    }
  }
  
  public function delete($id)
  {
    $sql = "DELETE FROM blog_list WHERE `blog_list`.`id` = '$id'";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      echo "deleted successfully";
    } else {
      echo '<script>await alert("Data is not deleted due to some technical error.")</script>';
      exit();
    }
  }

  public function register($email, $name, $password, $phoneNo)
  {
    $sql = "INSERT INTO `users` (`email`, `name`, `password`, `phone`, `date`) VALUES ('$email', '$name','$password','$phoneNo', current_timestamp())";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      echo "User Registered successfully.";
      return true;
    } else {
      echo '<script>alert("User is already Exist.")</script>';
      return false;
      // header("location:register.php");
      // exit();
    }
  }
  public function loginData($email)
  {
    $sql = "SELECT * FROM `users` WHERE `users`.`email` = '$email'";
    $result = mysqli_query($this->conn, $sql);
    if ($result->num_rows==1) {
      $row = $result->fetch_assoc();
      return $row;
    } else {
      echo '<script>alert("Not able to login.")</script>';

      header("location:login.php");
      exit();
    }
  }
  public function insertLike($email, $id)
  {
    $sql = "INSERT INTO `liked` (`userEmail`, `blogId`) VALUES ('$email','$id')";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      echo "Your data is inserted successfully.";
    } else {
      echo '<script>alert("Data is not inserted due to some technical error.")</script>';
      header("location:index.php");
      exit();
    }
  }
  
  public function deleteLike($email, $id)
  {
    $sql = $sql = "DELETE FROM liked WHERE `userEmail` = '$email' AND `blogId` = '$id'";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      echo "Your data is deleted successfully.";
    } else {
      echo '<script>alert("Data is not inserted due to some technical error.")</script>';
      header("location:index.php");
      exit();
    }
  }

  public function fetchLikedInfo($id,$email)
  {
    $sql = "SELECT * FROM `liked` WHERE `blogId` = '$id' AND `userEmail` = '$email'";
    $result = mysqli_query($this->conn, $sql);
    if ($result->num_rows==1) {
      
      $row = $result->fetch_assoc();
      return $row;
    }
  } 
  public function totalLikes($id)
  {
    $sql = "SELECT * FROM blog_list INNER JOIN liked ON blog_list.id=liked.blogId WHERE blogId='$id'";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      $total_data = mysqli_num_rows($result);  
      return $total_data;
    }
  }
}