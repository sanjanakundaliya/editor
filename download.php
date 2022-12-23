<?php
require_once("./config.php");
$id = $_GET["id"];
$sql = "select * from myfiles where id=".$id;
$result = $conn->query($sql);
if (isset($result->num_rows) && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
       $data=$row["fdata"];
       $fname = $row["fname"];
    }
}


$file = $fname;
$txt = fopen($file, "w") or die("Unable to open file!");
fwrite($txt, $data);
fclose($txt);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
header("Content-Type: text/plain");
readfile($file);
?>