<?php
header("Content-Type: text/xml");
echo "<?xml version='1.0' ?>";

echo "<result>";
echo "<name>".$name."</name>";
echo "<gender>".$gender."</gender>";
echo "</result>";
?>