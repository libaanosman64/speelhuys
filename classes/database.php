<?php 
class Database
{

public static function start()
{
 $dbServerName = "127.0.0.1";
 $dbUsername= "root"; 
 $dbPassword ="";
 $dbName = "speelhuys"; 
 $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);
 if ($conn ->connect_error) 
    { 
        die("Connection failed: " . $conn->connect_error);
    }
  return $conn;
 }
 
}
?>