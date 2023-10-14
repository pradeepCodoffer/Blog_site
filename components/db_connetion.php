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
      echo 'Error connecting to' . mysqli_connect_error();
    }
  }
}
?>