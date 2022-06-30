<?php

namespace MercadoPago\Resources\Payment;

/** TransactionData class. */
class TransactionData
{
    /** QR code. */
    public $qr_code;

    /** QR code image in Base 64. */
    public $qr_code_base64;

    /** Transaction ID. */
    public $transaction_id;

    /** Bank transfer ID. */
    public $bank_transfer_id;

    /** Financial institution. */
    public $financial_institution;

    /** Bank info. */
    public $bank_info;

    /** Ticket Url. */
    public $ticket_url;

    /**
     * Method responsible for mapping class attributes.
     */
    public static function map(string $field)
    {
        $map = [
            "bank_info" => "MercadoPago\Resources\Payment\BankInfo",
        ];

        foreach ($map as $key => $value) {
            if ($key === $field) {
                return $value;
            }
        }
    }
}
