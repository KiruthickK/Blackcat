<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login!Signup</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="../CSS/CommonStyles.css">
    <script src="../JavaScripts/login.js"></script>
</head>

<body>
    <div>
        <nav>
            <ul>
                <li><button id="BtnLogIn" onclick="MakeSignUpVisible()">Sign Up?</button> <button id="BtnSgnUp" onclick="MakeLoginVisible()">Log in?</button></li>
                <li><a href="#">Home</a></li>
                <li><a href="#">About us</a></li>
            </ul>
        </nav>
    </div>
    <div id="maindiv" class="centerDiv">

        <br><br>
        <div id="login">
            <form action="login.php" method="post">
                <input type="email" name="email" placeholder="Email"><br><br>
                <input type="password" name="password" placeholder="Password"><br><br>
                <button name="login" class="button">Login</button>
            </form>
        </div><br>
        <div id="signup">
            <form action="login.php" method="post">
                <input type="text" name="signupname" placeholder="username"><br><br>
                <input type="number" name="age" placeholder="age"><br><br>
                <input type="number" name="phonenumber" placeholder="phone number"><br><br>
                <input type="email" name="email" placeholder="email"><br><br>
                <input type="password" name="signuppassword" placeholder="Password"><br><br>
                <input type="password" name="signuprepassword" placeholder="Re-enter password"><br><br>
                <button name="signup" class="button">Signup</button>
            </form>

        </div>
    </div>
    
       
</body>

<?php
@include 'DBConnection.php';
@include 'CommonMethods.php';
if (isset($_POST['login'])) {
    $Email = $_POST["email"];
    $password = $_POST["password"];
    if ($conn) {
        $SqlQuery = "SELECT * from USERS WHERE email = '$Email'";
        $result = mysqli_query($conn, $SqlQuery);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            if ($password == $row["password"]) {
                mysqli_close($conn);
                session_start();
                $_SESSION["blackcatusername"] = $row["name"];
                RedirectPage("HomePage.php");
            } else {
                AlertError("Password not matching");
            }
        } else {
            AlertError("User does exists!");
            RedirectPage("login.php");
        }
    } else {
        AlertError("Database error");
        RedirectPage("login.php");
    }
}
if (isset($_POST["signup"])) {
    $name = $_POST["signupname"];
    $age = intval($_POST["age"]);
    $phonenumber = $_POST["phonenumber"];
    $email = $_POST["email"];
    $signuppassword = $_POST["signuppassword"];
    $signuprepassword = $_POST["signuprepassword"];
    if ($signuppassword != $signuprepassword) {
        AlertError("Password does not matching");
        RedirectPage("login.php");
    } else {
        if($conn)
        {
            $sql = "INSERT INTO users VALUES('$name','$age','$phonenumber','$signuppassword','$email')";
            if(mysqli_query($conn,$sql))
            {
                session_start();
                $_SESSION["blackcatusername"] = $name;
                AlertMessage("Account created successfully!");
                RedirectPage("HomePage.php");
            }
            else
            {
                AlertError("Sorry account not created!");
                RedirectPage("login.php");
            }
            mysqli_close($conn);
        }
        else
        {
            AlertError("Database error");
            RedirectPage("login.php");
        }
    }


}
?>

</html>