<?php

namespace MercadoPago\Resources\Payment;

/** BankInfo class. */
class BankInfo
{
    /** Payer info. */
    public $payer;

    /** Collector info. */
    public $collector;

    /** Is same bank account owner. */
    public $is_same_bank_account_owner;

    /**
     * Method responsible for mapping class attributes.
     */
    public static function map(string $field)
    {
        $map = [
            "payer" => "MercadoPago\Resources\Payment\BankInfoPayer",
            "collector" => "MercadoPago\Resources\Payment\BankInfoCollector",
        ];

        foreach ($map as $key => $value) {
            if ($key === $field) {
                return $value;
            }
        }
    }
}
