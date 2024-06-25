<?php
include "partials/header.php";
include "classes/session.classes.php";
Session::start();
include 'classes/profile.classes.php';
include "partials/nav.php";

?>

<!DOCTYPE html>
<html lang="NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/profile.css">
    <title>Flevosap</title>
</head>

<body>
    <?php
    // $profile = new Account();
    $profile = $account->profileDetails();

    $sessionid = $_SESSION["userid"];

    if ($profile > 0) {

    ?>

        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <!-- <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
            </div> -->
                <div class="col-md-6 border-right">
                    <div class="p-4 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profielinstellingen</h4>
                        </div>
                        <form action="includes/profilewijzigen.inc.php" method="POST">
                            <div class="row mt-2">
                                <input type="hidden" name="id" value="<?php print $sessionid ?>">
                                <div class="col-md-6"><label class="labels">Voornaam</label><input type="text" name="voornaam" class="form-control" value="<?php print $profile['name']; ?>" placeholder="Voornaam" required></div>
                                <div class="col-md-6"><label class="labels">Achternaam</label><input type="text" name="achternaam" class="form-control" value="<?php print $profile['lastname']; ?>" placeholder="Achternaam" required></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12"><label class="labels">Email</label><input type="email" name="email" class="form-control" placeholder="Email" value="<?php print $profile['users_email']; ?>" required></div>
                                <div class="col-md-6"><label class="labels">Straat</label><input type="text" name="straat" class="form-control" placeholder="Straat" value="<?php print $profile['street']; ?>" required></div>
                                <div class="col-md-6"><label class="labels">Huisnummer</label><input type="text" name="huisnummer" class="form-control" value="<?php print $profile['houseNumber']; ?>" placeholder="Huisnummer" required></div>
                                <div class="col-md-6"><label class="labels">Postcode</label><input type="text" name="postcode" class="form-control" placeholder="Postcode" value="<?php print $profile['postalCode']; ?>" required></div>
                                <div class="col-md-6"><label class="labels">Plaats</label><input type="text" name="plaats" class="form-control" placeholder="district" value="<?php print $profile['district']; ?>" required></div>
                                <div class="col-md-12"><label class="labels">Land</label><input type="text" name="land" class="form-control" placeholder="country" value="<?php print $profile['country']; ?>" required></div>
                                <div class="col-md-12"><label class="labels">Telefoonnummer</label><input type="text" name="telefoonnummer" class="form-control" placeholder="Telefoonnummer" value="<?php print $profile['phoneNumber']; ?>" required></div>

                            </div>

                            <div class="mt-5 text-center"><input type="submit" name="submit" class="btn btn-primary profile-button" type="button" value="Gegevens wijzigen" style="width:100%"></button></div>
                    </div>
                    </form>

                </div>
                <div class="col-md-4">
                    <div class="p-4 py-5">
                        <div class="justify-content-between align-items-center mb-3">
                            <h3>Bezorgadres</h3>
                        </div>
                    </div>
                    <div class="p-3 py-5">
                        <div class="justify-content-between align-items-center experience">
                            <div class="row">
                                <div class="col-5"><strong>Naam:</strong></div>
                                <div class="col-7"><?php echo $profile['name'] . " " .  $profile['lastname'] ?></div>
                            </div>
                            <div class="row">
                                <div class="col-5"><strong>Email:</strong></div>
                                <div class="col-7"><?php echo $profile['users_email'] ?></div>
                            </div>
                            <div class="row">
                                <div class="col-5"><strong>Telefoonnummer:</strong></div>
                                <div class="col-7"><?php echo $profile['phoneNumber'] ?></div>
                            </div>
                            <div class="row">
                                <div class="col-5"><strong>Adres:</strong></div>
                                <div class="col-7"><?php echo $profile['street'] . " " .  $profile['houseNumber'] ?></div>
                            </div>
                            <div class="row">
                                <div class="col-5"><strong>Postcode:</strong></div>
                                <div class="col-7"><?php echo $profile['postalCode'] . " " .  $profile['district'] ?></div>
                            </div>
                            <div class="row">
                                <div class="col-5"><strong>Land:</strong></div>
                                <div class="col-7"><?php echo $profile['country'] ?></div>
                            </div>
                        </div><br>
                    </div>
                    <!-- <div class="mt-1 text-center"><button class="btn btn-primary profile-button" type="button" style="width:100%; height:10%; margin-bottom:5%;">Verwijder mijn account</button></div> -->
                </div>
            </div>
        </div>
        </div>
        </div>
</body>

</html>

<?php
    } else {
?>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <!-- <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
            </div> -->
            <div class="col-md-6 border-right">
                <div class="p-4 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profielinstellingen</h4>
                    </div>
                    <form action="includes/profiletoevoegen.inc.php" method="POST">
                        <div class="row mt-2">
                            <input type="hidden" name="id" value="<?php print $sessionid ?>">
                            <div class="col-md-6"><label class="labels">Voornaam</label><input type="text" name="voornaam" class="form-control" placeholder="Voornaam" required></div>
                            <div class="col-md-6"><label class="labels">Achternaam</label><input type="text" name="achternaam" class="form-control" placeholder="Achternaam" required></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Email</label><input type="email" name="email" class="form-control" placeholder="Email" required></div>
                            <div class="col-md-6"><label class="labels">Straat</label><input type="text" name="straat" class="form-control" placeholder="Straat" required></div>
                            <div class="col-md-6"><label class="labels">Huisnummer</label><input type="text" name="huisnummer" class="form-control" placeholder="Huisnummer" required></div>
                            <div class="col-md-6"><label class="labels">Postcode</label><input type="text" name="postcode" class="form-control" placeholder="Postcode" required></div>
                            <div class="col-md-6"><label class="labels">Plaats</label><input type="text" name="plaats" class="form-control" placeholder="Plaats" required></div>
                            <div class="col-md-12"><label class="labels">Land</label><input type="text" name="land" class="form-control" placeholder="Land" required></div>
                            <div class="col-md-12"><label class="labels">Telefoonnummer</label><input type="text" name="telefoonnummer" class="form-control" placeholder="Telefoonnummer" required></div>

                        </div>

                        <div class="mt-5 text-center"><input type="submit" name="submit" class="btn btn-primary profile-button" type="button" value="Gegevens wijzigen" style="width:100%"></button></div>
                </div>
                </form>

            </div>

            <div class="col-md-4">
                <div class="p-4 py-5">
                    <div class="justify-content-between align-items-center mb-3">
                        <h3>Bezorgadres</h3>
                    </div>
                    <h5>U heeft nog geen bezorgadres ingevuld !</h5>
                </div>
            </div>


            </body>

            </html>


        <?php
    }
        ?>