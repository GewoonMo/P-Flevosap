<?php
$emailverify = $_GET["email"];

include "../classes/verifylink.classes.php";
include "../classes/verifylink-contr.classes.php";

$accverify = new verifycontr($emailverify);  

// Running error handlers and user signup
$accverify->actuate();
header("location: ../login.php");