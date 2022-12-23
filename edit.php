<?php
require_once("./config.php");
if(isset($_POST["updatedtext"])){
    $ut=$_POST["updatedtext"];
    $id=$_POST["id"];
    $sql="update myfiles set fdata=\"".$ut."\" where id=".$id;
    //echo $sql;
    $conn->query($sql);
    header("location:index.php");


}
$id=$_GET["id"];
// echo $id;
$sql = "select * from myfiles where id=".$id;
$result = $conn->query($sql);
if (isset($result->num_rows) && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
       $data=$row["fdata"];
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <form class="container text-center p-4 " method="POST" >
        <input type="hidden" value="<?php echo $id ;?>" name="id">
    <textarea rows="10" cols="100" name="updatedtext">
    <?php
    echo "$data";
    ?>
    </textarea>
    <br>
    <input type="submit" value="SAVE" class="btn btn-success">
    </form>
    
    
</body>
</html>