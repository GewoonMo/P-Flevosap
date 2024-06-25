<?php

include "../classes/adminpanel-contr.classes.php";

if (isset($_POST["submit"])) {
    // POST DE WOORD UID PWD IN DATABASE   
    $id = $_POST["users_id"];
    $naam = $_POST["users_uid"];
    $email = $_POST["users_email"];
    $rol = $_POST["rol"];
    $Email_verified = $_POST["Email_verified"];

    $gegevenswijzigen = new Adminpanel();
    $gegevenswijzigen->changeUserdata($id, $naam, $email, $Email_verified,  $rol);

    // Word terug gestuurd naar voorkant pagina
    header("Location: ../adminusers.php?changed=success");
    exit();
}

$gegevenswijzigen = new Adminpanel();
$userid = $_GET["id"];
$gegevenswijzigen->deleteUserAdmin($userid);
header("Location: ../adminusers.php?changed=success");
exit();
