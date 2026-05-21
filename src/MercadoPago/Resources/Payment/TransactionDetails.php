<?php

namespace MercadoPago\Resources\Payment;

use MercadoPago\Serialization\Mapper;

/**
 * Represents the financial details of a payment transaction in the MercadoPago API.
 *
 * Contains amounts (net, total, installment), payment processor references,
 * and offline payment data (barcode, digitable line). Nested within
 * {@see \MercadoPago\Resources\Payment}.
 */
class TransactionDetails
{
    /** Maps nested objects to their corresponding DTO classes. */
    use Mapper;

    /** Name or code of the financial institution that processed the payment. */
    public ?string $financial_institution;

    /** Net amount received by the seller after all fees are deducted. */
    public ?float $net_received_amount;

    /** Total amount paid by the buyer, including fees and taxes. */
    public ?float $total_paid_amount;

    /** Amount of each installment when paying in installments. */
    public ?float $installment_amount;

    /** Amount overpaid by the buyer (applies only to ticket/offline payment methods). */
    public ?float $overpaid_amount;

    /** URL to the payment resource on the processor's system (e.g. boleto PDF). */
    public ?string $external_resource_url;

    /**
     * Reference ID from the payment method processor.
     *
     * For credit card payments this is the USN (Unique Sequence Number).
     * For offline methods, it is the reference code to present at the cashier or ATM.
     */
    public ?string $payment_method_reference_id;

    /** Reference identifier assigned by the acquirer for reconciliation. */
    public ?string $acquirer_reference;

    /** Deferral period before the payment becomes payable to the seller. */
    public ?string $payable_deferral_period;

    /** Identifier of the bank transfer operation. */
    public ?string $bank_transfer_id;

    /** Transaction identifier within the payment processor. */
    public ?string $transaction_id;

    /** @var Barcode|array|null Barcode data for offline payment methods (e.g. boleto). */
    public array|object|null $barcode;

    /** Digitable line for boleto payments (typed barcode representation). */
    public ?string $digitable_line;

    /** Verification code for the payment transaction. */
    public ?string $verification_code;

    private $map = [
        "barcode" => "MercadoPago\Resources\Payment\Barcode",
    ];

    /**
    * Method responsible for getting map of entities.
    */
    public function getMap(): array
    {
        return $this->map;
    }
}
