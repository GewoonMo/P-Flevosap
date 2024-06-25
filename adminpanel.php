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
<a href="edit.php?id=<?php echo $ProductCate['productCategoryID']; ?>" type="button" class="btn btn-primary btn-sm"><?php echo $ProductCate['name'];?></a>
<?php
}
?>

</div>
</body>

</html>

<?php



?>