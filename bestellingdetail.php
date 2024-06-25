<?php
include 'classes/profile.classes.php';
include 'classes/profile-contr.classes.php';
include "classes/cart-contr.classes.php";
include "partials/header.php";
include "partials/nav.php";

if (!isset($_SESSION["userid"])) {
    header("location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="NL">

<body style="background: rgb(208, 56, 42)" ;>
    <?php
        $ordersValue = $account->OrderDetails();
        $profileValue = $account->profileDetails();
        $winkelwagen = new winkelwagen();
        $winkelwageninfo = $winkelwagen->getCart();
    ?>

    <div class="container rounded bg-white mt-5 mb-5 p-4 py-5 w-100">
        <div class="col-md-12">
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-6 text-right">
                    <h4 class="text-right">Mijn bestellingen</h4>
                </div>
                <div class="col-6">
                    <button type="button" class="btn  btn-outline-success btn-sm" onclick="history.back()">
                        < Terug</button>
                </div>
            </div>
        </div>

        <?php
        foreach ($ordersValue as $ordervalue) {
            $order = new AccountController($ordervalue['status']);
            $orderID = $ordervalue['orderID'];
        }
        ?>

        <div class="p-4 py-2">
            <div class="d-flex justify-content-between align-items-center experience">
                <h1>Bestelling <?php echo  $orderID ?></h1>
            </div>
            <?php
            foreach ($ordersValue as $ordervalue) {
                $btw = $winkelwagen->getBtw($ordervalue['price'], $ordervalue['btw'], $ordervalue['quantity']);
                $totaal = $winkelwagen->getTotalExcBtw($ordervalue['price'], $ordervalue['quantity']);
                $verzendkosten = $winkelwagen->calculateCosts($totaal);
                $totaalprijs = $winkelwagen->getTotalPrice($totaal, $verzendkosten);
            ?>
                <div class="container mt-5 mb-3 border">
                    <div class="row">
                        <div class="col-4 justify-content-center mt-3 mb-3 rounded">
                   
                                   <?php
                                            if ($ordervalue['productCategoryID'] == 1) {
                                                echo '<img src=assets/images/sappen/vruchtensap/' . $ordervalue['image'] . ' alt="Louvre" class="mr-3 custom-img-bestelling "/>';
                                            } elseif($ordervalue['productCategoryID'] == 2){
                                                echo '<img src=assets/images/sappen/groentensap/' . $ordervalue['image'] . ' alt="Louvre" class="mr-3 custom-img-bestelling"/>';
                                            } elseif($ordervalue['productCategoryID'] == 3) {
                                            echo '<img src=assets/images/horeca/vruchtensap/' . $ordervalue['image'] . ' alt="Louvre" class="mr-3 custom-img-bestelling "/>';
                                            }elseif($ordervalue['productCategoryID'] == 4){
                                            echo '<img src=assets/images/horeca/smoothiesap/' . $ordervalue['image'] . ' alt="Louvre" class="mr-3 custom-img-bestelling "/>';
                                            }elseif($ordervalue['productCategoryID'] == 5){
                                                echo '<img src=assets/images/horeca/ijsjes/' . $ordervalue['image'] . ' alt="Louvre" class="mr-3 custom-img-bestelling "/>';
                                            } 

                                            ?>
                        </div>
                        <div class="col-8 mt-3">

                            <p class="font-weight-bold font-size-5 reduce-spacing "><?php echo "Productnaam: " . $ordervalue['productname'] ?></p>
                            <p><?php echo "Prijs € " . $ordervalue['price'] ?></p>
                            <p><?php echo "Aantal: " . $ordervalue['quantity'] ?></p>
                            <p>Verkoper: Flevosap</p>
                            <p><?php echo $order->isDelivered($ordervalue['price']) ?> </p>
                            <!-- <button type="button" class="btn btn-primary">Button</button> -->
                        </div>

                    </div>
                </div>
            <?php
            }
            // include "partials/footer.php";
            ?>
            <div class=" container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Details bestelling </h2>
                        <h6 class="font-weight-bold">Bezorgadres</h6>
                        <p class="reduce-spacing"><?php echo $ordervalue['name'] . " " .  $ordervalue['lastname'] ?></p>
                        <p class="reduce-spacing"><?php echo $ordervalue['street'] . " " .  $ordervalue['houseNumber'] ?></p>
                        <p class="reduce-spacing"><?php echo $ordervalue['postalCode'] . " " .  $ordervalue['district'] ?></p>
                        <p class="reduce-spacing"><?php echo $ordervalue['country'] ?></p>

                    </div>
                    <div class="col-md-6">
                        <h2>Kostenoverzicht</h2>
                        <div class="row">
                            <div class="col-5"><strong>Totaal kosten(exc btw):</strong></div>
                            <div class="col-7"><?php print sprintf("€ %0.2f",  $totaal) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-5"><strong>Btw:</strong></div>
                            <div class="col-7"><?php print sprintf("€ %0.2f",   $btw) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-5"><strong>Verzendkosten:</strong></div>
                            <div class="col-7"><?php print sprintf("€ %0.2f", $verzendkosten) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-4"><strong>-------------</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-5"><strong>Totaal kosten(inc btw):</strong></div>
                            <div class="col-7"><?php print sprintf("€ %0.2f",  $totaalprijs) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-5"><strong>Betaalmethode:</strong></div>
                            <div class="col-7"><?php echo $ordervalue['betaalMethode'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-7"><a href="factuur.php?controller=account&action=generatePDF&orderID=<?php echo $orderID ?>" class="btn btn-primary">Factuur PDF</a></div>
                    </div>
    </body>
</html>