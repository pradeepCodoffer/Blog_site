<?php

class db_conn
{
  public $serverName = "localhost";
  public $user = "root";
  public $pass = "";
  public $database = "blog";
  public $conn;

  function __construct()
  {
    $this->conn = mysqli_connect($this->serverName, $this->user, $this->pass, $this->database);
    if (mysqli_connect_errno()) {
      echo 'Error connecting to' . mysqli_connect_error();
    }
  }

  public function insert($title, $description, $author)
  {
    $sql = "INSERT INTO `blog_list` (`title`, `description`, `author`, `date`) VALUES ('$title', '$description','$author', current_timestamp())";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      echo "Your data is inserted successfully.";
    } else {
      echo 'An error occurred - data is not inserted' .  mysqli_error($this->conn);
    }
  }
  public function fetchData()
  {
    $sql = "SELECT * FROM `blog_list`";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      return $result;
    } else {
      echo "An error occurred - data is not read.";
    }
  }
  public function update($id, $title, $description, $author)
  {

    $sql = "UPDATE `blog_list` SET `title` = '$title', `description` = '$description' , `author` = '$author' WHERE `blog_list`.`id` = '$id'";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      echo "data is  updated successfully";
    } else {
      echo "data is not updated successfully";
    }
  }
  public function delete($id)
  {
    $sql = "DELETE FROM blog_list WHERE `blog_list`.`id` = '$id'";
    $result = mysqli_query($this->conn, $sql);
    if ($result) {
      echo "deleted successfully";
    } else {
      echo "data is not deleted successfully";
    }
  }
}