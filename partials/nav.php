<!DOCTYPE html>
<html lang="NL">

<head>
    <link rel="stylesheet" href="assets/css/nav.css">
</head>

<nav class="navbar navbar-expand-md navbar-light bg-customcolor shadow">
    <a class="navbar-brand mr-3" href="index.php">
        <img src="assets/images/algemeen/Logo-header-home.png" alt="Flevosap" height="100" width="150" style="max-height: 120px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse custom-shit" id="navbarNav">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-custom" href="boomgaard.php">Boomgaard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-custom" href="indefles.php">In de fles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-custom" href="hmmm.php">Hmmm</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-custom" href=" sappen.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sappen

                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="products-vsap.php">Vruchtensap</a>
                    <a class="dropdown-item " href="products-gsap.php">Groentensap</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-custom" href=" horeca.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Horeca

                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="products-v2sap.php">Vruchtensap</a>
                    <a class="dropdown-item " href="products-ssap.php">Smoothiesap</a>
                    <a class="dropdown-item " href="products-isap.php">Ijs</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-custom" href="nieuws.php">Nieuws</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <div class="d-none d-sm-block" style="border-right: 1px solid #ccc; height: 100px;"></div>
        </ul>
        <ul class="navbar-nav">

            <li class="nav-item my-element">
                <form class="form-inline my-2 my-lg-0 nav-text" method="post" action="includes/search.inc.php">
                    <input class="form-control mr-sm-2" type="search" name="target" placeholder="Zoek product" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Zoek</button>
                </form>
            </li>
            <li class="nav-item">
                <a class="nav-link text-custom" href="cartpage.php">Winkelwagen</a>
            </li>
            <?php
            include_once "classes/adminpanel-contr.classes.php";
            $admin1 = new Adminpanel;
            if (isset($_SESSION["userid"])) {
                $id = $_SESSION["userid"];
                $adminnav = $admin1->idGet($id);
                if (isset($_SESSION["userid"])) {
                    foreach ($adminnav as $admin2) {
                        $title = $admin2["rol"];
                    }
                }
                // print $title;
                // if (isset($_SESSION["userid"])) {
                if ($title === "admin") {
            ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-custom" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welkom terug, <strong> <?php echo $_SESSION["users_uid"] ?> </strong>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item " href="myorders.php">Mijn bestellingen</a>
                            <a class="dropdown-item " href="myaccount.php">Mijn account</a>
                            <a class="dropdown-item" href="adminpanel.php">Admin panel</a>
                            <a class="dropdown-item" href="includes/logout.inc.php">Uitloggen</a>

                    </li>
                    <!-- <a id="nav-text" href="cartpage.php">cart</a> -->
                <?php
                } elseif ($title === "klant") {
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-custom" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welkom terug, <strong> <?php echo $_SESSION["users_uid"] ?> </strong>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item " href="myorders.php">Mijn bestellingen</a>
                            <a class="dropdown-item " href="myaccount.php">Mijn account</a>
                            <a class="dropdown-item" href="includes/logout.inc.php">Uitloggen</a>

                    </li>
                <?php
                }
            } else {
                ?>
                <li class="nav-item">
                    <a class="nav-link text-custom" href="login.php">Inloggen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-custom" href="signup.php">Registreren</a>
                </li>


            <?php
            }
            ?>
        </ul>
    </div>

</nav>

</html>