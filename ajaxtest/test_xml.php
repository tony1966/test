<?php
header("Content-Type: text/xml");
$user=$_REQUEST["user"];              
$pwd=$_REQUEST["pwd"];
$response="<?xml version='1.0' ?>".
          "<result>".
          "<user>".$user."</user>".
          "<pwd>".$pwd."</pwd>".
          "</result>";
echo $response;
?>
