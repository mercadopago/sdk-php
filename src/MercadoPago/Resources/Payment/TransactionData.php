<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/** TransactionData class. */
class TransactionData
{
    /** Class mapper. */
    use Mapper;

    /** QR code. */
    public ?string $qr_code;

    /** QR code image in Base 64. */
    public ?string $qr_code_base64;

    /** Transaction ID. */
    public ?string $transaction_id;

    /** Bank transfer ID. */
    public ?int $bank_transfer_id;

    /** Financial institution. */
    public ?int $financial_institution;

    /** Bank info. */
    public array|object|null $bank_info;

    /** Ticket Url. */
    public ?string $ticket_url;

    /** E2E ID. */
    public ?string $e2e_id;

    private $map = [
        "bank_info" => "MercadoPago\Resources\Payment\BankInfo",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
