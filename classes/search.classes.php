<?php

include_once "config/dbh.classes.php";

class Search extends Dbh
{

    private $dbh;

    public function setDbh($dbh)
    {
        $this->dbh = $dbh;
    }


    public function binarySearch($array, $target)
    {
        $low = 0;
        $high = count($array) - 1;

        while ($low <= $high) {
            $mid = (int)(($low + $high) / 2);
            if ($array[$mid] < $target) {
                $low = $mid + 1;
            } elseif ($array[$mid] > $target) {
                $high = $mid - 1;
            } else {
                return $mid;
            }
        }

        return -1;
    }

    public function searchProduct($target)
    {
        $sql = "SELECT * FROM product WHERE productname LIKE '%$target%'";
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetchAll()) {
            return $row;
        }
    }
}
