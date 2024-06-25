<?php
class Session
{
    public static function start()
    {
        if (!isset($_SESSION["userid"])) {
            header("location: login.php");
            exit();
        }
    }


    
    public static function admincheck($title)
    {
        if ($title != "admin") {
            header("location: index.php");
            exit();
        }
    }
}
