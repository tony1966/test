<?php
header("Content-Type: application/json");
$response=array(
  'S01' => Array('English' => 78, 'Chinese' => 89, 'Math' => 65),
  'S02' => Array('English' => 98, 'Chinese' => 56, 'Math' => 79),
  'S03' => Array('English' => 66, 'Chinese' => 89, 'Math' => 87),
  );
echo json_encode($response);
?>
