<?php
require_once("./config.php");
$name= $_GET['fname'];
unlink($name);
$sql="Delete from myfiles where fname=\"".$name."\"";
$conn->query($sql);
header("location:index.php")
// PHP program to delete a file named gfg.txt
// using unlink() function
// Use unlink() function to delete a file
// if(!unlink($name)) {
//     echo ("$file_pointer cannot be deleted due to an error");
// }
// else {
//     echo ("$file_pointer has been deleted");
// } 
?>