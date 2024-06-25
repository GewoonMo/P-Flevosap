<?php
session_start();
include "classes/adminpanel-contr.classes.php";
include "classes/session.classes.php";
include "partials/adminnav.php";
$admin1 = new Adminpanel;


$uid = $_SESSION["userid"];

$adminnav = $admin1->idGet($uid);
foreach ($adminnav as $admin2) {
    $title = $admin2["rol"];
}

Session::admincheck($title);


?>

<!doctype html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <div class="d-flex justify-content-center">

        <?php

        $admin = new Adminpanel;
        $ProductCat = $admin->getProductCategory();

        foreach ($ProductCat as $ProductCate) {
        ?>
            <a href="edit.php?id=<?php echo $ProductCate['productCategoryID']; ?>" type="button" class="btn btn-primary btn-sm"><?php echo $ProductCate['name']; ?></a>
        <?php
        }
        ?>

    </div>
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="row mt-4">

                    <div class="col-md-12" id="hide">

                    </div>

                    <div class="col-md-12 p-0">

                        <table class="table table-dark">

                            <thead>

                                <tr>

                                    <th>Id</th>

                                    <th>Categorie ID</th>

                                    <th>Product naam</th>

                                    <th>Product beschrijving</th>

                                    <th>Productprijs</th>

                                    <th>BTW</th>

                                    <th>Voorraad</th>

                                    <th>Wijzigen</th>

                                    <th>Verwijderen</th>


                                </tr>

                            </thead>

                            <tbody>

                                <?php

                                $admin = new Adminpanel;
                                $ProductsData = $admin->getProductData();

                                foreach ($ProductsData as $ProductData) {
                                ?>


                                    <tr>

                                        <td><?php echo  $ProductData['productID']; ?></td>

                                        <td><?php echo $ProductData['productCategoryID']; ?></td>

                                        <td><?php echo $ProductData['productname'];; ?></td>

                                        <td><?php echo $ProductData['productdesc'];; ?></td>

                                        <td><?php echo $ProductData['price'];; ?></td>

                                        <td><?php echo $ProductData['btw'];; ?></td>

                                        <td><?php echo $ProductData['voorraad'];; ?></td>


                                        <td>

                                            <a href="adminproductsform.php?id=<?php echo $ProductData['productID']; ?>" type=" button" class="btn btn-primary btn-sm">Wijzigen</a>

                                        </td>

                                        <td>

                                            <a href="includes/productwijz.inc.php?id=<?php echo $ProductData['productID']; ?>" type="button" class="btn btn-danger btn-sm">Verwijderen</a>

                                        </td>

                                    </tr>
                                <?php
                                }
                                ?>


                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </section>

    </div>
</body>

</html>

<?php



?>