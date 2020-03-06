<?php
header("Content-Type: application/json");
$user=$_REQUEST["user"];              
$pwd=$_REQUEST["pwd"];
$response=array(
  'user' => 'tony',
  'pwd' => '123'
  );
echo json_encode($response);
?>
