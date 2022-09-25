<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "mini_project";
// Create connection
try {
  $conn = mysqli_connect($servername, $username, $password, $db_name);

} catch (\Throwable $th) {

  die("<h5><br>Connection failed to (  $db_name ) database</h5><br>");
}
