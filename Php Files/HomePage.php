<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
</head>

<body onload="CheckUser()">
    <?php
    session_start();
    if (isset($_SESSION["blackcatusername"])) {
        echo ("Welcome " . $_SESSION["blackcatusername"]);
    } else {
        @include 'CommonMethods.php';
        AlertError("You have to login first!");
        RedirectPage("./login.php");
    }
    ?>
    <form action="HomePage.php" method="post">
        <!-- <input type="button" name="logout" id="logout" placeholder="logout?"> -->
        <button name="logout">Logout</button>
    </form>
    <?php
    @include 'CommonMethods.php';
    if (isset($_POST["logout"])) {
        // session_start();
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
        RedirectPage("./login.php");
    }
    ?>
    <form action="Php Files/postcat.php" method="post" enctype="multipart/form-data">
        post cat
        <input type="text" name="username" placeholder="Enter username">
        <input type="text" name="catname" placeholder="Enter your cat name"> Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>

</html>