<?php
include "partials/header.php";
include "classes/session.classes.php";
Session::start();
include 'classes/profile.classes.php';
include "partials/nav.php";


?>

<!DOCTYPE html>
<html lang="NL">

<body style="background: rgb(208, 56, 42)" ;>
    <?php
    $ordersValue = $account->profileOrderDetails();

    $customersData = $account->profileDetail();

    if ($customersData != false) {
        foreach ($customersData as $customerData) {
            $customID = $customerData["customerID"];
        }
        $ordersValuess = $account->profileOrderCheck($customID);
    } else {
        $ordersValuess = false;
    }
    // if the customer has a  order show me the order
    if ($ordersValuess != false) {

    ?>

        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-10">
                    <div class="p-4 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Mijn bestellingen</h4>
                        </div>
                    </div>
                    <?php

                    $displayed_order_ids = [];

                    foreach ($ordersValuess as $ordervalue) {

                        //timetamp change but keep the time
                        $date = date_create($ordervalue['orderDate']);
                        $ordervalue['orderDate'] = date_format($date, 'd-m-Y H:i:s');
                    ?>
                        <div class="p-4 py-2">
                            <?php
                            if (!in_array($ordervalue['orderID'], $displayed_order_ids)) {
                                $displayed_order_ids[] = $ordervalue['orderID'];
                            ?>
                                <div class="d-flex justify-content-between align-items-center experience">
                                    <span><?php
                                            echo "Bestelnummer: " .  $ordervalue['orderID'] . " | " .  "Besteldatum: " .  $ordervalue['orderDate'];
                                            ?>
                                    </span>
                                </div>
                                <hr>
                            <?php
                            }
                            ?>

                            <div class="container-sm rounded bg-custom-color mt-4 mb-4 shadow-lg p-3">
                                <a href="bestellingdetail.php?orderID=<?php print $ordervalue['orderID'];  ?>" class="text-reset text-decoration-none">
                                    <div class="row">
                                        <div class="col-4 rounded">
                                            <?php
                                            if ($ordervalue['productCategoryID'] == 1) {
                                                echo '<img src=assets/images/sappen/vruchtensap/' . $ordervalue['image'] . ' alt="vruchtensap" class="mr-3 custom-img" "/>';
                                            } elseif ($ordervalue['productCategoryID'] == 2) {
                                                echo '<img src=assets/images/sappen/groentensap/' . $ordervalue['image'] . ' alt="groentensap" class="mr-3 custom-img" "/>';
                                            } elseif ($ordervalue['productCategoryID'] == 3) {
                                                echo '<img src=assets/images/horeca/vruchtensap/' . $ordervalue['image'] . ' alt="vruchtensap" class="mr-3 custom-img" "/>';
                                            } elseif ($ordervalue['productCategoryID'] == 4) {
                                                echo '<img src=assets/images/horeca/smoothiesap/' . $ordervalue['image'] . ' alt="smoothiesap" class="mr-3 custom-img" "/>';
                                            } elseif ($ordervalue['productCategoryID'] == 5) {
                                                echo '<img src=assets/images/horeca/ijsjes/' . $ordervalue['image'] . ' alt="ijsjes" class="mr-3 custom-img" "/>';
                                            }

                                            ?>




                                        </div>
                                        <div class="col-4 rounded  mx-auto my-auto">
                                            <p class="font-size-14 font-weight-bold">
                                                <?php echo $ordervalue['productname'] ?>
                                            </p>
                                        </div>
                                        <div class="col-4 text-center mx-auto my-auto">
                                            <button type="button" href="bestellingdetail.php?orderID=<?php print $ordervalue['orderID'];  ?>" class="btn  btn-outline-success btn-sm btn-group float-right">
                                                <i class="fas fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    // echo 'U heeft nog geen orders geplaatst';
                    ?>
                    <div class="container rounded bg-white custom_css">
                        <div class="emptycart" style=" text-align:center; margin-top:5%;">
                            <img src="assets/images/algemeen/leeg_winkelwagen.jpg" alt="winkelwagen leeg" style="width: 20%; height: 20%;">
                            <h3 class="font-weight-bold">U heeft nog geen bestelling geplaats.</h3>
                            <h6> Wilt u een bestelling plaatsen?</h6> <br>
                            <div class="col-50">
                                <input type="button" class="btn btn-outline-success my-2 my-sm-0" onclick="location.href='sappen.php';" value="Zoek door onze producten heen" />
                            </div>
                        </div>
                    </div>
                <?php
                }

                ?>
                </div>
</body>

</html>

<?php
// include "partials/footer.php";
?>