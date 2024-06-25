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

$productid = $_GET["id"];
?>

<!doctype html>
<html>

<head>
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin.css">
</head>

<body>

  <?php
  $productsData = $admin1->getProduct($productid);

  foreach ($productsData as $productData) {
  ?>
    <div class="d-flex justify-content-center">

      <form action="includes/productwijz.inc.php" method="post">
        <input type="hidden" name="id" value="<?php print $productid ?>">
        <div class="form-group">
          <label for="productname">Productnaam</label>
          <input type="productname" class="form-control" value="<?php print $productData["productname"] ?>" name="productname" placeholder="Productnaam">
        </div>
        <div class="form-group">
          <label for="productdesc">Productbeschrijving</label>
          <input type="productdesc" class="form-control" value="<?php print $productData["productdesc"] ?>" name="productdesc" placeholder="Productbeschrijving">
        </div>
        <div class="form-group">
          <label for="price">Prijs</label>
          <input type="number" class="form-control" value="<?php print $productData["price"] ?>" name="price" placeholder="Prijs">
        </div>
        <div class="form-group">
          <label for="btw">BTW</label>
          <input type="number" class="form-control" value="<?php print $productData["btw"] ?>" name="btw" placeholder="BTW">
        </div>
        <div class="form-group">
          <label for="voorraad">Voorraad</label>
          <input type="number" class="form-control" value="<?php print $productData["voorraad"] ?>" name="voorraad" placeholder="Voorraad">
        </div>
      <?php
    }
      ?>

      <button type="submit" name="submit" class="btn btn-primary">Wijzigingen opslaan</button>
      </form>


    </div>
</body>

</html>