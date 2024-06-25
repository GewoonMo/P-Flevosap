<?php

class AccountController extends Account
{

    public function isDelivered($status)
    {
        return $status == 0 ? "Bezorgd: Nee" : "Bezorgd: Ja";
    }
}
