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
      echo '<script>alert("Data is not deleted due to some technical error.")</script>';
      exit();
    }
  }
}