<?php

namespace MercadoPago\Resources\Payment;

/** TransactionDetails class. */
class TransactionDetails
{
    /** External financial institution identifier. */
    public ?string $financial_institution;

    /** Amount received by the seller. */
    public ?float $net_received_amount;

    /** Total amount paid by the buyer (includes fees). */
    public ?float $total_paid_amount;

    /** Total installments amount. */
    public ?float $installment_amount;

    /** Amount overpaid (only for tickets). */
    public ?float $overpaid_amount;

    /** Identifies the resource in the payment processor. */
    public ?string $external_resource_url;

    /**
     * For credit card payments is the USN. For offline payment methods, is the reference to give to
     * the cashier or to input into the ATM.
     */
    public ?string $payment_method_reference_id;

    /** Acquirer Reference. */
    public ?string $acquirer_reference;

    /** Payable deferral period. */
    public ?string $payable_deferral_period;

    /** Bank transfer ID. */
    public ?string $bank_transfer_id;

    /** Transaction ID. */
    public ?string $transaction_id;
}
