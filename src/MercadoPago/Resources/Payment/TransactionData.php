<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents transaction-level data generated at the point of interaction in the MercadoPago API.
 *
 * Contains QR code content, ticket URLs, and bank transfer details for
 * Pix, boleto, and other payment methods. Nested within {@see PointOfInteraction}.
 */
class TransactionData
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** QR code content string (e.g. Pix EMV payload). */
    public ?string $qr_code;

    /** Base64-encoded QR code image for rendering in the payer's UI. */
    public ?string $qr_code_base64;

    /** Unique transaction identifier within the point of interaction. */
    public ?string $transaction_id;

    /** Identifier of the bank transfer operation. */
    public ?int $bank_transfer_id;

    /** Numeric identifier of the financial institution processing the transfer. */
    public ?int $financial_institution;

    /** @var BankInfo|array|null Bank account details of payer and collector for bank transfers. */
    public array|object|null $bank_info;

    /** URL where the payer can view/download the payment ticket (e.g. boleto PDF). */
    public ?string $ticket_url;

    /** End-to-end identifier for Pix transactions, used for reconciliation. */
    public ?string $e2e_id;

    /** Indicates whether this is the first transaction in a CREDENTIAL_ON_FILE agreement. */
    public ?bool $first_transaction;

    /** Storage type for the credential-on-file agreement (e.g. "ON_DEMAND", "RECURRING"). */
    public ?string $storage;

    /** Initiator of the transaction in a CREDENTIAL_ON_FILE flow (e.g. "MERCHANT", "CUSTOMER"). */
    public ?string $transaction_initiator;

    /** @var TransactionDataReference|array|null Reference to the original stored-credential transaction. */
    public array|object|null $reference;

    private $map = [
        "bank_info" => "MercadoPago\Resources\Payment\BankInfo",
        "reference" => "MercadoPago\Resources\Payment\TransactionDataReference",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
