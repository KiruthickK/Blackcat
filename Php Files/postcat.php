<?php
@include 'CommonMethods.php';
@include 'DBConnection.php';
session_start();
$username = null;
if (isset($_SESSION["blackcatusername"])) {
  $username = $_SESSION["blackcatusername"];
}
$age = $_POST["catage"];
$catname = $_POST["catname"];
$target_dir = "../Images/Usercats/" . $username;
$catbehaviour = $_POST["catbehaviour"];
$catcolor = $_POST["catcolor"];
// echo ("<script>alert(\"Hello".$target_dir."hi\");</script>");

// $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$new_name = $target_dir. "/" . $catname . "." . $imageFileType;
if (!file_exists($target_dir)) {
    mkdir($target_dir,0777, true);
    AlertMessage("Directory created for user!");
}
if(file_exists($new_name))
{
  AlertMessage("This cat already has its photo uploaded here!");
  RedirectPage("HomePage.php");
}
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  if($catname == null || $username == null)
  {
    AlertError("Inputs have to be filled !");
    RedirectPage("HomePage.php");
  }
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  AlertMessage("A image has already been there with this cat name, you can upload with another name!");
  RedirectPage("HomePage.php");
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_name)) {
    if ($conn) {
      $SqlQuery = "INSERT INTO CATS VALUES('$catname',$age,'$catcolor','$catbehaviour','$username')";
      if (mysqli_query($conn, $SqlQuery)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        AlertMessage("Cat photo uploaded successfully!");
        RedirectPage("HomePage.php");
      } else {
          AlertError("User does exists!");
          RedirectPage("HomePage.php");
      }
  } else {
      AlertError("Database error");
      RedirectPage("HomePage.php");
  }
    
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>