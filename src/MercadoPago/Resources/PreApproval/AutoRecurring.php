<?php

namespace MercadoPago\Resources\PreApproval;

/** AutoRecurring class. */
class AutoRecurring
{
    /** Currency ID. */
    public ?string $currency_id;

    /** Recurring amount. */
    public ?float $transaction_amount;

    /** Recurring frequency. */
    public ?int $frequency;

    /** Recurring frequency type (days or months). */
    public ?string $frequency_type;

    /** Recurring start date. */
    public ?string $start_date;

    /** Recurring end date. */
    public ?string $end_date;

    /** Free trial. */
    public $free_trial;
}
