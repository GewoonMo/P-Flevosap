<?php
// logout button DESTROYT DE SESSIE
session_start();
session_unset();
session_destroy();

header("location: ../index.php?error-none");