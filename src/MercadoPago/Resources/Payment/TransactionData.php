<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** TransactionData class. */
class TransactionData
{
    /** Class mapper. */
    use Mapper;

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

    /** E2E ID. */
    public $e2e_id;

    /** Infringement notification. */
    public $infringement_notification;

    private $map = [
        "bank_info" => "MercadoPago\Resources\Payment\BankInfo",
        "infringement_notification" => "MercadoPago\Resources\Payment\InfringementNotification",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
