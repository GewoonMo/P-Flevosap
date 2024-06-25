<?php
include "partials/header.php";
include "partials/nav.php";
?>

<!DOCTYPE html>
<html lang="NL">

<head>
    <link rel="stylesheet" href="assets/css/signup.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Registreren - Flevosap</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <form class="signup-form" action="includes/signup.inc.php" method="POST">
        <h3>Registreer u hier</h3>
        <label class="label" for="username">Email</label>
        <input type="email" class="inputfield" name="users_email" placeholder="Uw email">

        <label class="label" for="username">Gebruikersnaam</label>
        <input type="text" class="inputfield" name="uid" placeholder="Uw Gebruikersnaam">

        <label class="label" for="password">Wachtwoord</label>
        <input type="password" class="inputfield" name="pwd" placeholder="Uw Wachtwoord">

        <label class="label" for="password">Herhaal Wachtwoord</label>
        <input type="password" class="inputfield" name="pwdrepeat" placeholder="Herhaal wachtwoord">

        <button type="submit" class="formbtn" name="submit">Maak uw account aan</button>
        <div class="social">
            <div class="go"><a href="#"><i class="fas fa-key"></i> Wachtwoord vergeten?</a></div>
            <div class="fb"><a href="login.php"><i class="fas fa-sign-in-alt"></i></i> Al een account?</a></div>
        </div>
    </form>
</body>
<!-- <footer>
    <?php include "partials/footer.php"; ?>
</footer> -->

</html>