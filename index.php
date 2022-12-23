<?php

require_once("./config.php");

if (isset($_POST["upload"])) {
    $maxsize = 524288000; // 500MB
    $name = $_FILES['file2']['name'];
    $target_dir = "img/";
    $target_file2 = $_FILES["file2"]["name"];
    $filenameext = "a__" . time();

    // Select file type
    $videoFileType = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));

    $len1 = strlen($videoFileType);
    $target_file2 = substr($target_file2, 0, strpos($target_file2, "." . $videoFileType));
    $target_file2 = $target_dir . $target_file2 . $filenameext . "." . $videoFileType;
    // Valid file extensions
    $extensions_arr = array("png", "svg", "jpg", "jpeg", "txt");

    // Check extension
    if (in_array($videoFileType, $extensions_arr)) {
        // echo($target_file2);
        // Check file size
        if (($_FILES['file2']['size'] >= $maxsize) || ($_FILES["file2"]["size"] == 0)) {
            // echo "File too large. File must be less than 5MB.";
        } else {
            // Upload
            if (move_uploaded_file($_FILES['file2']['tmp_name'], $target_file2)) {
                // echo $target_file2;
                $myfile = fopen($target_file2, "r") or die("Unable to open file!");
                $txtupload = fread($myfile, filesize($target_file2));
                // echo $txtupload;
                fclose($myfile);
                $sql = "INSERT INTO myfiles(fname, fdata) VALUES (\"".$target_file2."\",\"".$txtupload."\")";
                // echo $sql;
                // $sql = "INSERT INTO product(title, price, productcode, brand, category, img1, img2, img3, size,detail) VALUES (\"" . $_POST['title'] . "\",\"" . $_POST['price'] . "\",\"" . $_POST['detail'] . "\",\"" . $target_file1 . "\",\"" . $target_file2 . "\",\"" . $target_file2 . "\",\"" . $_POST['category'] . "\",\"" . $_POST['description'] . "\",\"" . $_POST['uses'] . "\")";
                // $sql = "INSERT INTO product(title, price, productcode, brand, category, img1, img2, img3, size,details) VALUES (\"" . $title . "\",\"" . $price . "\",\"" . $productcode . "\",\"" . $brand . "\",\"" . $category . "\",\"" . $target_file1 . "\",\"" . $target_file2 . "\",\"" . $target_file2 . "\",\"" . $size . "\",\"" . $detail . "\");";
                // echo $sql;
                $result = $conn->query($sql);
            }
        }
    } else {
        //   echo "Invalid file extension.";
    }
}



?>


<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <form method="post" enctype='multipart/form-data' class="container text-center p-5">
        <input required type='file' name='file2' class="form-control" /><br>
        <input type="submit" name="upload" value="submit" class="btn btn-primary">
    </form>

    <hr>
    <div class="container p-4 row" >
        <?php
            $sql = "select * from myfiles";
            $result = $conn->query($sql);
            if (isset($result->num_rows) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { 
                    $id = $row["id"];
                    $fname = $row["fname"];
                    ?>
        <div class=" col-sm-6 p-4">
            <h3><?php echo $row["fname"];?></h3>
            <br>
            <p><?php echo $row["fdata"];?></p>
            <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-primary"> Edit</a>
            <a href="download.php?id=<?php echo $id; ?>" class="btn btn-primary"> Download</a>
            <a href="delete.php?fname=<?php echo $fname; ?>" class="btn btn-primary"> Delete</a>
        </div>

        <?php
                }
            }
        ?>
    </div>
</body>

</html>

