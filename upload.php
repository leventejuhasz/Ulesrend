<?php   

if(isset($_FILES["fileToUpload"])){

$target_dir = "uploads/";
echo $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);



if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

}
}

?>

<!DOCTYPE html>
<html >
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
   

</html>
