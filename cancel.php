<?php
include "partials/header.php";
include "classes/session.classes.php";
Session::start();
include "partials/nav.php";
?>

<html>

<head>
  <title>U heeft uw bestelling geannuleerd</title>
</head>

<body>
  <h1>U heeft uw bestelling geannuleerd</h1>
  <p>
    U heeft uw bestelling geannuleerd. Als u nog vragen heeft, kunt u
    <a href="mailto:orders@example.com">orders@example.com</a>.
  </p>

  <p>
    <a href="index.php">Terug naar de startpagina</a>
</body>

</html>