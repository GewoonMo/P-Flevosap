<?php
include "../config/dbh.classes.php";
include '../classes/search.classes.php';
include '../classes/products.classes.php';

if (isset($_POST['search'])) {
    $search = new Search();
    // $array =
    $target = $_POST['target'];
    $results = $search->searchProduct($target);

    if (empty($results)) {
        // print "het gezochte product is niet gevonden";
        header("Location: ../sappen.php?error=productnotfound");
    } else {
        foreach ($results as $result) {
            header("Location: ../sappen.php?search=" . $target . "");
            exit();
        }
    }
} else {
    header("Location: ../sappen.php");
    exit();
}
