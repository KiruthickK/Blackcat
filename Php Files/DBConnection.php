<?php
    $ServerName = "localhost";
    $database = "blackcat";
    $DBUser = "root";
    $DBPassword = "root";
    $conn = mysqli_connect($ServerName,$DBUser,$DBPassword,$database);
    function AlertError($msg)
    {
        echo("
            <script>
                alert(\"Sorry, $msg\");
            </script>
        ");
    }
    function AlertMessage($msg)
    {
        echo("
            <script>
                alert(\"$msg\");
            </script>
        "); 
    }
    function RedirectPage($page)
    {
        echo("
            <script>
                window.location.href=\"$page\";
            </script>
        ");
    }
?>