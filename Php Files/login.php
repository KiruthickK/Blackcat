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
    <div id="maindiv" class="centerDiv">
        <button id="BtnLogIn" onclick="MakeSignUpVisible()">Sign Up?</button>
        <button id="BtnSgnUp" onclick="MakeLoginVisible()">Log in?</button>
        <br><br>
        <div id="login">
            <form action="login.php" method="post">
                <input type="email" name="email" placeholder="Email"><br><br>
                <input type="password" name="password" placeholder="Password"><br><br>
                <button name="login">Login</button>
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
                <button name="signup">Signup</button>
            </form>
        </div>
    </div>
</body>

<?php
@include 'DBConnection.php';
if (isset($_POST['login'])) {
    $Email = $_POST["email"];
    $password = $_POST["password"];
    if ($conn) {
        $SqlQuery = "SELECT password from USERS WHERE email = '$Email'";
        $result = mysqli_query($conn, $SqlQuery);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            if ($password == $row["password"]) {
                mysqli_close($conn);
                RedirectPage("../HomePage.html");
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
            $sql = "INSERT INTO USERS values('$name',$age,'$phonenumber',$password','$email')";
            if(mysqli_query($conn,$sql))
            {
                AlertMessage("Account created successfully!");
                RedirectPage("../HomePage.html");
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