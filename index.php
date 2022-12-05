<?php
if (isset($_POST['submit'])) {
    /*$file = $_FILES['upload']['name'];
    $temp = $_FILES['upload']['tmp_name'];
    $folder = "image/";

    $con = mysqli_connect('localhost', 'root', '', 'test');
    $ins = "INSERT INTO upload (file) VALUES ('$file')";
    $qry = mysqli_query($con, $ins);
    move_uploaded_file($temp, "$folder" . $file);*/


    $target_dir = "image/";
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    /*if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["upload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "<script>alert('File is not an image.')</script>";
            $uploadOk = 0;
        }
    }*/

    // Check if file already exists
    if (file_exists($target_file)) {
        echo ",script>alert('Sorry, file already exists.')</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["upload"]["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.')</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["upload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<form action="#" method="post" enctype="multipart/form-data">
    <input type="file" name="upload" />
    <input type="submit" name="submit" />
</form>