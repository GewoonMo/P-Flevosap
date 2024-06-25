<?php
include "partials/header.php";
include "partials/nav.php";

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($url, 'signup=success') !== false) {
    echo "<script>alert('Controleer uw e-mail om uw account te verifiëren!');</script>";
}
?>

<!DOCTYPE html>
<html lang="NL">

<head>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Login - Flevosap</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <!-- <img src="./assets/images/algemeen/image.png" alt="banner" style="width: 100%; height: 50%; margin-bottom: 25%;"> -->
    <form class="login-form" action="includes/login.inc.php" method="POST">
        <h3>Log hier in</h3>
        <label class="label" for="username">Email</label>
        <input type="text" name="email" class="inputfield" placeholder=" Uw Email" id="email">

        <label class="label" for="password">Wachtwoord</label>
        <input type="password" name="pwd" class="inputfield" placeholder="Uw Wachtwoord" id="wachtwoord">

        <button type="submit" class="formbtn" name="submit">Log In</button>
        <div class="social">
            <div class="go"><a href="#"><i class="fas fa-key"></i> Wachtwoord vergeten?</a></div>
            <div class="fb"><a href="signup.php"><i class="fas fa-key"></i> Een account aan maken?</a></div>
        </div>
    </form>
</body>
<!-- <footer>
    <?php include "partials/footer.php"; ?>
</footer> -->

</html>