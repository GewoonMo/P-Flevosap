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
    <div id="wrapper" class="clearfix">

        <section id="page-title">

            <div class="container clearfix hed">


            </div>

        </section>

        <div class="col-md-12 hed">



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

                                        <th>Username</th>

                                        <th>Email</th>

                                        <th>Email verified</th>

                                        <th>Rol</th>

                                        <th>Wijzigen</th>

                                        <th>Verwijderen</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    $admin = new Adminpanel;
                                    $UsersData = $admin->getUserData();


                                    foreach ($UsersData as $UserData) {
                                    ?>


                                        <tr>

                                            <td><?php echo  $UserData['users_id']; ?></td>

                                            <td><?php echo $UserData['users_uid']; ?></td>

                                            <td><?php echo $UserData['users_email'];; ?></td>

                                            <td><?php echo $UserData['emailVerified'];; ?></td>

                                            <td><?php echo $UserData['rol'];; ?></td>

                                            <td>

                                                <a href="adminusersform.php?id=<?php echo $UserData['users_id']; ?>" type="button" class="btn btn-primary btn-sm">Wijzigen</a>

                                            </td>

                                            <td>

                                                <a href="includes/userswijz.inc.php?id=<?php echo $UserData['users_id']; ?>" type="button" data-target="#myModal" id="del" class="btn btn-danger btn-sm">Verwijderen</a>

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