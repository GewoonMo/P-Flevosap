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

$userid = $_GET["id"];
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
  $UsersData = $admin1->getUserDataInfo($userid);

  foreach ($UsersData as $UserData) {
  ?>
    <div class="d-flex justify-content-center mt-5">

      <form action="includes/userswijz.inc.php" method="POST">
        <input type="hidden" name="users_id" value="<?php print $userid ?>">
        <div class="form-group">
          <label for="users_email">Email</label>
          <input type="email" class="form-control" name="users_email" value="<?php print $UserData["users_email"] ?>" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="users_uid">Gebruikersnaam</label>
          <input type="text" class="form-control" name="users_uid" value="<?php print $UserData["users_uid"] ?>" placeholder="Gebruikersnaam">
        </div>
        <div class="form-group">
          <label for="Email_verified">Email verified</label>
          <input type="number" class="form-control" min="0" max="1" value="<?php print $UserData["emailVerified"] ?>" name="Email_verified" placeholder="Email_verified">
        </div>
        <div class="form-group">
          <label for="rol">Rol</label>
          <select class="form-control" name="rol">
            <option>klant</option>
            <option>admin</option>
          </select>
        </div>
      <?php
    }
      ?>
      <button type="submit" name="submit" class="btn btn-primary">Wijzigingen opslaan</button>
      </form>


    </div>
</body>

</html>