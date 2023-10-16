<?php
class connection
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
      echo '<script>alert("Database is not connected due to some technical error.")</script>'; 
      exit();
    }
  }
}
?>