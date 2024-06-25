<?php
include "partials/header.php";
include "classes/session.classes.php";
Session::start();
include "partials/nav.php";
include 'classes/profile.classes.php';
include "classes/cart-contr.classes.php";

$winkelwagen = new winkelwagen();
$winkelwageninfo = $winkelwagen->getCart();
?>

<!DOCTYPE html>
<html lang="NL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/cartpage.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">

    <title>Afrekenen - Flevosap</title>
    <!-- <meta http-equiv="refresh" content="10"> -->
    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

</head>

<body>

    <?php


    if (!empty($winkelwageninfo)) {

    ?>
        <!doctype html>
        <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
        </head>

        <body>
            <div class="container mt-5">
                <div class="col-md-8">
                    <div class="row mb-3">

                        <div class="col-4 text-left">
                            <h4>Flevosap - Winkelmand</h4>
                        </div>
                        <div class="col-4  text-left">
                            <button type="button" class="btn  btn-outline-success btn-sm" onclick="history.back()">
                                < Terug</button>
                        </div>
                    </div>
                </div>
                <!-- <h2> Flevosap - Winkelmand </h2> -->

                <div class="row ms-auto">
                    <div class="col-sm-4 order-md-3 mb-4 custom-margin float-right">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="mb-3 ">Mijn winkelmand</span>
                            <span class="badge badge-secondary badge-pill custom-badge-color"><?php echo count($winkelwageninfo); ?></span>
                        </h4>
                        <ul class="list-group mb-3">
                            <?php
                            foreach ($winkelwageninfo as $key => $value) {
                                $aantal = $value;
                                $productID = $key;
                                $producten = $winkelwagen->getstockitemdetails($productID);
                                foreach ($producten as $product) {

                                    $btw = $winkelwagen->getBtw($product['price'], $product['btw'], $aantal);
                                    $totaal = $winkelwagen->getTotalExcBtw($product['price'], $aantal);
                                    $totaalIncBtw = $winkelwagen->getTotalIncBtw($totaal, $btw);
                                    $verzendkosten = $winkelwagen->calculateCosts($totaalIncBtw);
                                    $totaalprijs = $winkelwagen->getTotalPrice($totaal, $verzendkosten);



                            ?>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                
                
                                
                                            <?php
                                            if ($product['productCategoryID'] == 1) {
                                                echo '<img src=assets/images/sappen/vruchtensap/' . $product['image'] . '  alt=" image" class="mr-3" style="width: 50px; height: 50px;"/>';
                                            } elseif($product['productCategoryID'] == 2){
                                                echo '<img src=assets/images/sappen/groentensap/' . $product['image'] . '  alt=" image" class="mr-3" style="width: 50px; height: 50px;"/>';
                                            } elseif($product['productCategoryID'] == 3) {
                                            echo '<img src=assets/images/horeca/vruchtensap/' . $product['image'] . '  alt=" image" class="mr-3" style="width: 50px; height: 50px;"/>';
                                            }elseif($product['productCategoryID'] == 4){
                                            echo '<img src=assets/images/horeca/smoothiesap/' . $product['image'] . ' alt=" image" class="mr-3" style="width: 50px; height: 50px;"/>';
                                            }elseif($product['productCategoryID'] == 5){
                                                echo '<img src=assets/images/horeca/ijsjes/' . $product['image'] . ' alt=" image" class="mr-3" style="width: 50px; height: 50px;" />';
                                            } 

                                            ?>

                                        <div>
                                            <h6 class="my-0"><?php print $product["productname"] ?></h6>

                                            <small class="text-muted"><?php print "Aantal van het product " . $aantal ?></small>
                                        </div>
                                        <span class="text-muted"><?php print "€ " . $product["price"] ?></span>
                                    </li>
                            <?php
                                    // $alleitems = $winkelwagen->getCart();
                                    $productname =  $product["productname"];
                                    $image_url = $product['image'];
                                }
                            }
                            ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Aantal btw(9%)</span>
                                <strong><?php print sprintf("€ %0.2f", $btw) ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Verzendkosten: </span>
                                <strong><?php print sprintf("€ %0.2f",  $verzendkosten) ?></strong>
                            </li>
                            <br>
                            <li class="list-group-item d-flex justify-content-between">

                                <span>Totaal bedrag inc btw: </span>
                                <strong><?php print sprintf("€ %0.2f",  $totaalprijs) ?></strong>
                            </li>
                        </ul>

                        <form class="card p-2">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Promo code">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-success">Redeem</button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-5 order-md-1 mb-custom">
                    <h4 class="d-flex justify-content-between align-items-center mb-3 ">
                        <span class="mb-3">Factuur Adres</span>
                    </h4>
                    <?php
                    $sessionid = $_SESSION['userid'];
                    $profile = $account->profileDetails();

                    $sessionid = $_SESSION["userid"];
                
                if ($profile > 0) {
    ?>
                    <form action="includes/checkout.inc.php" method="POST">
                        <div class="row mt-2 mt-auto">
                            <input type="hidden" name="id" value="<?php print $sessionid ?>">
                            <input type="hidden" name="totprijs" value="<?php print $totaalprijs ?>">
                            <input type="hidden" name="productname" value="<?php print $productname ?>">
                            <input type="hidden" name="image_url" value="<?php print $image_url ?>">
                            <div class="col-md-6 "><label class="labels">Voornaam</label><input type="text" name="voornaam"  value="<?php print $profile['name']; ?>" class="form-control" placeholder="Voornaam" required ></div>
                            <div class="col-md-6"><label class="labels">Achternaam</label><input type="text" name="achternaam" value="<?php print $profile['lastname']; ?>" class="form-control" placeholder="Achternaam" required></div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12"><label class="labels">Email</label><input type="email" name="email" value="<?php print $profile['users_email']; ?>" class="form-control" placeholder="Email" required></div>
                            <div class="col-md-6"><label class="labels">Straat</label><input type="text" name="straat" value="<?php print $profile['street']; ?>" class="form-control" placeholder="Straat" required></div>
                            <div class="col-md-6"><label class="labels">Huisnummer</label><input type="text" name="huisnummer" value="<?php print $profile['houseNumber']; ?>" class="form-control" placeholder="Huisnummer" required></div>
                            <div class="col-md-6"><label class="labels">Postcode</label><input type="text" name="postcode" value="<?php print $profile['postalCode']; ?>" class="form-control" placeholder="Postcode" required></div>
                            <div class="col-md-6"><label class="labels">Plaats</label><input type="text" name="plaats" value="<?php print $profile['district']; ?>" class="form-control" placeholder="Plaats" required></div>
                            <div class="col-md-12"><label class="labels">Land</label><input type="text" name="land" value="<?php print $profile['country']; ?>" class="form-control" placeholder="Land" required></div>
                            <div class="col-md-12"><label class="labels">Telefoonnummer</label><input type="text" name="telefoonnummer" value="<?php print $profile['phoneNumber']; ?>"  class="form-control" placeholder="Telefoonnummer" required></div>
                        </div>
                </div>
                <?php
                    }else{
                        ?>
                           <form action="includes/checkout.inc.php" method="POST">
                        <div class="row mt-2 mt-auto">
                            <input type="hidden" name="id" value="<?php print $sessionid ?>">
                            <input type="hidden" name="totprijs" value="<?php print $totaalprijs ?>">
                            <input type="hidden" name="productname" value="<?php print $productname ?>">
                            <input type="hidden" name="image_url" value="<?php print $image_url ?>">
                            <div class="col-md-6 "><label class="labels">Voornaam</label><input type="text" name="voornaam" class="form-control" placeholder="Voornaam" required></div>
                            <div class="col-md-6"><label class="labels">Achternaam</label><input type="text" name="achternaam" class="form-control" placeholder="Achternaam" required></div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12"><label class="labels">Email</label><input type="email" name="email" class="form-control" placeholder="Email" required></div>
                            <div class="col-md-6"><label class="labels">Straat</label><input type="text" name="straat" class="form-control" placeholder="Straat" required></div>
                            <div class="col-md-6"><label class="labels">Huisnummer</label><input type="text" name="huisnummer" class="form-control" placeholder="Huisnummer" required></div>
                            <div class="col-md-6"><label class="labels">Postcode</label><input type="text" name="postcode" class="form-control" placeholder="Postcode" required></div>
                            <div class="col-md-6"><label class="labels">Plaats</label><input type="text" name="plaats" class="form-control" placeholder="Plaats" required></div>
                            <div class="col-md-12"><label class="labels">Land</label><input type="text" name="land" class="form-control" placeholder="Land" required></div>
                            <div class="col-md-12"><label class="labels">Telefoonnummer</label><input type="text" name="telefoonnummer" class="form-control" placeholder="Telefoonnummer" required></div>
                        </div>
                    </div>
                        <?php
                    }
                ?>
            </div>
            <button class="btn btn-outline-success btn-lg btn-block border mt-5" type="submit">Bestellen en betalen</button>
            </form>
            </div>

        </body>

        </html>
    <?php

        include "partials/footer.php";
    } else {
    ?>
        <div class="emptycart" style=" text-align:center; margin-top:5%;">
            <img src="assets/images/algemeen/leeg_winkelwagen.jpg" alt="winkelwagen leeg" style="width: 20%; height: 20%;">
            <h3>Uw winkelwagentje is leeg</h3>
            <h3>Probeer het later nog is</h3> <br>
            <div class="col-50">
                <input type="button" class="btn btn-outline-success my-2 my-sm-0" onclick="location.href='sappen.php';" value="Zoek door onze producten heen" />
            </div>
        </div>


    <?php
    }
    ?>