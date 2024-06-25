<?php
include "config/dbh.classes.php";
class StripePayment extends Dbh
{
    private $stripe;
    private $secret_key = 'sk_test_51MUWIXGjre2djKXP5EG6JRyAlVfCkwsSPAC3v43SHMGtOYaZwir5LxFlXjJGzKtny91H2DIr9R3EAWpW9Zi91MEP007iU5rBLn';

    public function __construct()
    {
        require '../vendor/autoload.php';
        $this->stripe = new \Stripe\StripeClient($this->secret_key);
    }


    public function insertCustomerDataCheckout($id, $name, $lastName, $email, $phoneNumber, $street, $houseNumber, $postalCode, $district, $country)
    {
        $stmt = $this->connect()->prepare('UPDATE users set users_email = :usersemail  
     WHERE users_id = :userid');
        $stmt->execute(array(':userid' => $id, ':usersemail' => $email));

        $stmt = $this->connect()->prepare('INSERT INTO customer (userid, name, lastname, phoneNumber, street, houseNumber, postalCode, district, country) VALUES (:userid, :userName, :lastname, :phoneNumber, :street, :houseNumber, :postalCode, :district, :country)');
        $stmt->execute(array(':userid' => $id, ':userName' => $name, ':lastname' => $lastName, ':phoneNumber' => $phoneNumber, ':street' => $street, ':houseNumber' => $houseNumber, ':postalCode' => $postalCode, ':district' => $district, ':country' => $country));
    }


    public function createCheckoutSession($totaal, $productname)
    {
        $checkout_session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['ideal'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' =>  $productname,
                    ],
                    'unit_amount' => $totaal,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost/p-flevosap/succes.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://localhost/p-flevosap/cancel.php',
        ]);



        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
    }
}
