<!DOCTYPE html>
<html lang="en">
<?php
@include 'DBConnection.php';
@include 'CommonMethods.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="../CSS/Homepage.css">
    <script src="../JavaScripts/Homepage.js"></script>
</head>

<body>
    <form action="HomePage.php" method="post">
        <nav>
            <ul>
                <li><a href="#"><button name="logout" class="custom-button">Logout</button></a></li>
                <li><a href="#postcat">Post</a></li>
                <li><a href="#displaycats">Check Posts</a></li>
                <li class="welcome">
                    <?php
                    session_start();
                    if (isset($_SESSION["blackcatusername"])) {
                        echo ("Welcome " . $_SESSION["blackcatusername"] . "!");
                    } else {
                        AlertError("You have to login first!");
                        RedirectPage("./login.php");
                    }
                    ?>
                </li>
            </ul>

        </nav>
    </form>
    <div id="maindiv">
        <br><br>
        <div class="oddd">
            <form action="HomePage.php" method="post" class="allform">
                <h2>Filter Cats</h2>
                <select name="filter" id="">
                    <option value="">Select an option</option>

                    <optgroup label="color">
                        <option value="white">white</option>
                        <option value="black">black</option>
                    </optgroup>
                    <optgroup label="behaviour">
                        <option value="calm">calm</option>
                        <option value="naughty">naughty</option>
                    </optgroup>
                    <optgroup label="age">
                        <option value="1">below 1</option>
                        <option value="2">above 1</option>
                    </optgroup>
                    <option value="yourcats">your cats</option>
                </select><br><br>
                <input type="button" name="filterssearch" value="Apply filter">
                <?php
                if (isset($_POST["filterssearch"])) {
                    $filter = $_POST["filter"];
                    $sql = "";
                    if ($filter == "1" or $filter == "2") {
                        if ($filter == "1") {
                            $sql = "SELECT * FROM CATS WHERE AGE <= 1";
                        } else {
                            $sql = "SELECT * FROM CATS WHERE AGE > 1";
                        }
                    } else if ($filter == "white" or $filter == "black") {
                        $sql = "SELECT * FROM CATS WHERE color = '$filter'";
                    } else if ($filter == "calm" or $filter == "naughty") {
                        $sql = "SELECT * FROM CATS WHERE behaviour = '$filter'";
                    } else if ($filter == "yourcats") {
                        echo "<h2>These are your cats!<h2>";
                        $sql = "SELECT * FROM CATS WHERE owner = '" . $_SESSION['blackcatusername'] . "'";
                    }
                    else
                    {
                        echo"Please provide a valid selection";
                        RedirectPage("HomePage.php");
                    }

                    if ($conn) {
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result)) {
                            echo ("
                <h2>Applied Filter</h2>
    <table>
        <tr>
            <th>Cat Name</th>
            <th>Cat Photo</th>
            <th>Age</th>
            <th>Behaviour</th>
            <th>color</th>
        </tr>
    ");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row["name"] . "</td><td><a href = \"..\Images\Usercats\\" . $row["owner"] . "\\" . $row["name"] . "." . $row["imagetype"]."\" target=\"blank\" alt=".$row["name"]."><img src=\"..\Images\Usercats\\" . $row["owner"] . "\\" . $row["name"] . "." . $row["imagetype"] . "\" class =\"images-cat\"alt=\"" . $row["name"] . " \"></a></td>";
                                echo "<td>" . $row["age"] . "</td><td>" . $row["behaviour"] . "</td><td>" . $row["color"] . "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<h2>No cats found from applied filter</h2>";
                        }
                    } else {
                        AlertError("Database error");
                        RedirectPage("HomePage.php");
                    }
                }
                ?>
            </form>
        </div>
        <br><br>
        <div class="evenn">
            <form action="HomePage.php" method="post" enctype="multipart/form-data" id="displaycats" class="allform">
                <h2>Cat posts</h2>


                <div id="allcatphotos">
                    <?php
                    if ($conn) {
                        $sql = "SELECT * FROM cats";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result)) {
                            echo ("
                            <h2> All cat photos</h2>
        <table>
            <tr>
                <th>Cat Name</th>
                <th>Cat Photo</th>
                <th>Age</th>
                <th>Behaviour</th>
                <th>color</th>
            </tr>
        ");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row["name"] . "</td><td><a href = \"..\Images\Usercats\\" . $row["owner"] . "\\" . $row["name"] . "." . $row["imagetype"]."\" target=\"blank\" alt=".$row["name"]."><img src=\"..\Images\Usercats\\" . $row["owner"] . "\\" . $row["name"] . "." . $row["imagetype"] . "\" class =\"images-cat\"alt=\"" . $row["name"] . " \"></a></td>";
                                echo "<td>" . $row["age"] . "</td><td>" . $row["behaviour"] . "</td><td>" . $row["color"] . "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<h2>No cat photos have been posted. Be the first one to post your cat's photo</h2>";
                        }
                    } else {
                        AlertError("Database error");
                        RedirectPage("HomePage.php");
                    }
                    ?>
                </div>

            </form>
        </div>
        <br><br>
        <div class="oddd">
            <br><br>
            <form action="postcat.php" method="post" enctype="multipart/form-data" id="postcat" class="allform">
                <h2>post cat photos</h2>

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
                        <th>
                            <input type="text" name="catcolor" placeholder="Enter your cat's color" required>
                        </th>
                    </tr>
                    <tr>
                        <th>Cat's Behaviour</th>
                        <th><input type="text" name="catbehaviour" placeholder="Enter your cat's behaviour" required>
                        </th>
                    </tr>
                    <tr>
                        <th>Select image to upload:</th>
                        <th><input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" required></th>
                    </tr>

                </table>


                <br>
                <input type="submit" value="Upload Image" name="submit" id="submitbtn"><br>
            </form>
        </div>
        <!-- <input type="button" name="logout" id="logout" placeholder="logout?"> -->
    </div>
</body>

</html>

<!-- backend php -->
<?php
if (isset($_POST["logout"])) {
    // session_start();
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    RedirectPage("./login.php");
}
?>