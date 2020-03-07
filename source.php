<?php
$file=file_get_contents($_GET["file"]);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $_GET["file"] ?></title>
</head>
<body>
<xmp>
<?php echo $file; ?>
</xmp>
</body>
</html>