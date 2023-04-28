<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="../CSS/Homepage.css">
</head>

<body>
    <form action="HomePage.php" method="post">
        <nav>
            <ul>
                <li><a href="#"><button name="logout" class="custom-button">Logout</button></a></li>
                <li><a href="#">Post</a></li>
                <li ><a href="#">Check Posts</a></li>
                <li class="welcome">
                    <?php
                    session_start();
                    if (isset($_SESSION["blackcatusername"])) {
                        echo ("Welcome " . $_SESSION["blackcatusername"]."!");
                    } else {
                        @include 'CommonMethods.php';
                        AlertError("You have to login first!");
                        RedirectPage("./login.php");
                    }
                    ?>
                </li>
            </ul>

        </nav>
    </form>

    <br><br>
    <form action="postcat.php" method="post" enctype="multipart/form-data">
    <h2>post cat</h2>    
    
        <table>
            <tr>
                <th>Cat's Name</th>
                <th><input type="text" name="catname" placeholder="Enter your cat's name" required> </th>
            </tr>
            <tr>
                <th>Cat's Age</th>
                <th><input type="number" name="catage" placeholder="Enter your cat's age" required></th>
            </tr>
            <tr>
                <th>Cat's Color</th>
                <th><input type="text" name="catcolor" placeholder="Enter your cat's color" required></th>
            </tr>
            <tr>
                <th>Cat's Behaviour</th>
                <th><input type="text" name="catbehaviour" placeholder="Enter your cat's behaviour" required></th>
            </tr>
            <tr>
                <th>Select image to upload:</th>
                <th><input type="file" name="fileToUpload" id="fileToUpload" required></th>
            </tr>
            
        </table>
        
        
        <br>
        <input type="submit" value="Upload Image" name="submit" id="submitbtn" ><br>
    </form>
    <!-- <input type="button" name="logout" id="logout" placeholder="logout?"> -->
</body>

</html>

<!-- backend php -->
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