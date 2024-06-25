<?php
// session_start();
class winkelwagen extends Dbh
{
    protected $cart;
    protected $total;
    protected $totalinc;
    protected $totalBtw;
    protected $postagecosts;


    public function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->cart = $_SESSION['cart'];
            $this->total = 0;
        } else {
            $this->cart = array();
        }
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function saveCart($cart)
    {
        $this->cart = $cart;
        $_SESSION['cart'] = $cart;
    }

    public function addProductToCart($stockItemID)
    {
        if (array_key_exists($stockItemID, $this->cart)) {
            $this->cart[$stockItemID] += 1;
        } else {
            $this->cart[$stockItemID] = 1;
        }
        $this->saveCart($this->cart);
    }

    public function getstockitemdetails($productID)
    {

        $sql = "SELECT * FROM `product` 
        WHERE productID = $productID";
        $stmt = $this->connect()->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function removeProductFromCart($stockItemID)
    {
        if (array_key_exists($stockItemID, $this->cart)) {
            unset($this->cart[$stockItemID]);
        }
        $this->saveCart($this->cart);
    }

    public function updateProductInCart($stockItemID, $aantal)
    {
        if (array_key_exists($stockItemID, $this->cart)) {
            $this->cart[$stockItemID] = $aantal;
        }
        $this->saveCart($this->cart);
    }


    public function getTotalExcBtw($prijs, $aantal)
    {
        $this->total += $prijs * $aantal;
        return $this->total;
    }


    // public function getTotal($prijs, $btw,  $aantal)
    // {
    //     $taxHoeveelheid = $prijs * $btw / 100;
    //     $this->total += ($prijs + $taxHoeveelheid) * $aantal;
    //     return $this->total;
    // }

    public function getBtw($prijs, $btw, $aantal)
    {
        $taxHoeveelheid = $prijs * $btw / 100 * $aantal;
        $this->totalBtw +=  $taxHoeveelheid;
        return $this->totalBtw;
    }

    public function getTotalIncBtw($totaal, $btw)
    {
        $this->totalinc = ($totaal + $btw);
        return $this->totalinc;
    }

    public function calculateCosts($totaalPrijs)
    {
        if ($totaalPrijs > 50) {
            $this->postagecosts = 0;
            $totaalPrijs += $this->postagecosts;
            return (0.00);
        } else {
            $this->postagecosts = 5;
            $totaalPrijs += $this->postagecosts;
            return (5.00);
        }
    }

    public function getTotalPrice($totaal, $verzendkosten)
    {
        $totaalPrijs = $totaal + $verzendkosten + $this->totalBtw;
        return $totaalPrijs;
    }
}
