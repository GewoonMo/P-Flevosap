<?php
    session_start();
    require "fpdf/fpdf.php";
    include_once 'classes/profile.classes.php';
    include_once 'classes/profile-contr.classes.php';
    include_once "classes/cart-contr.classes.php";
    include_once "classes/factuur-contr.php";

    $ordersValue = $account->OrderDetails();
    $profileValue = $account->profileDetails();
    $winkelwagen = new winkelwagen();
    $winkelwageninfo = $winkelwagen->getCart();
?>

<?php
    $factuur = new Factuur();
    $order = $factuur->getFactuur($_GET['orderID']);

    $pdf = new FPDF();
    define('EURO',chr(128));
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Image('assets/images/algemeen/Logo-header-home.png',170,6,30);
    $pdf->Cell(40,10,'Factuur - Flevosap');
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $date = date_create($order['orderDate']);
    $order['orderDate'] = date_format($date, 'd-m-Y H:i:s');
    $pdf->Cell(40,20,'Bestelnummer: ' . $order['orderID']);
    $pdf->Cell(40,20,'Besteldatum: ' . $order['orderDate']);
    $pdf->Ln();

    // gegevens van de klant
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,5,'Bezorgadres:');
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,5,'Naam: ' . $order['name'] . ' ' . $order['lastname']);
    $pdf->Ln();
    $pdf->Cell(40,5,'Adres: ' . $order['street'] . ' ' . $order['houseNumber']);
    $pdf->Ln();
    $pdf->Cell(40,5,'Postcode: ' . $order['postalCode']);
    $pdf->Ln();
    $pdf->Cell(40,5,'Plaats: ' . $order['district']);
    $pdf->Ln();
    $pdf->Cell(40,5,'Land: ' . $order['country']);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();


    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,5,'Bestelde producten:');
    // producten
    foreach ($ordersValue as $ordervalue) {
    $btw = $winkelwagen->getBtw($ordervalue['price'], $ordervalue['btw'], $ordervalue['quantity']);
    $totaal = $winkelwagen->getTotalExcBtw($ordervalue['price'], $ordervalue['quantity']);
    $verzendkosten = $winkelwagen->calculateCosts($totaal);
    $totaalprijs = $winkelwagen->getTotalPrice($totaal, $verzendkosten);


    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(40,5,'Productnummer: ' . $ordervalue['productID']);
    $pdf->Ln();
    $pdf->Cell(40,5,'Productnaam: ' . $ordervalue['productname']);
    $pdf->Ln();
    $pdf->Cell(40,5,'Aantal: ' . $ordervalue['quantity']);
    $pdf->Ln();
    }
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(40,5,'Kostenoverzicht:');
    $pdf->SetFont('Arial','',12);
    $pdf->Ln();
    $pdf->Cell(40,5,'Totaal kosten(exc btw): '.EURO. round($totaal, 2));
    $pdf->Ln();
    $pdf->Cell(40,5,'Btw: '.EURO. round($btw, 2));
    $pdf->Ln();
    $pdf->Cell(40,5,'Verzendkosten: ' .EURO. round($verzendkosten, 2));
    $pdf->Ln();
    $pdf->Cell(40,5,'Totaal kosten(inc btw):  ' .EURO. round($totaalprijs, 2));
    $pdf->Ln();
    $pdf->Cell(40,5,'Betaalmethode: ' .$order['betaalMethode']);
    $pdf->Output();
?>