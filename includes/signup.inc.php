<?php

if (isset($_POST["submit"])) {
    // grabing the data
    $email = $_POST["users_email"];
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    // Instantiate SignupContr class
    include "../config/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    include '../classes/mail.classes.php';
    $signup = new SignupContr($email, $uid, $pwd, $pwdRepeat);

    $senderName = "Flevosap";
    $senderEmail = "flevosapinc@gmail.com";
    $senderEmailPassword = "pluklzsavcdhyuue";
    $recieverEmail = "$email";
    $subject = "Please click here in this mail for activating your account";
    $body = "http://localhost/p-flevosap/includes/verifylink.inc.php?email=$email";
    $mailer = new Mail($senderName, $senderEmail, $senderEmailPassword);
    $mailer->sendMail($recieverEmail, $subject, $body);




    // Running error handlers and user signup
    $signup->signupUser();






    // Going to back to front page
    header("location: ../login.php?signup=success");
}
