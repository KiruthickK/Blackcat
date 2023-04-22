<?php
function AlertError($msg)
{
    echo ("
            <script>
                alert(\"Sorry, $msg\");
            </script>
        ");
}
function AlertMessage($msg)
{
    echo ("
            <script>
                alert(\"$msg\");
            </script>
        ");
}
function RedirectPage($page)
{
    echo ("
            <script>
                window.location.href=\"$page\";
            </script>
        ");
}


?>