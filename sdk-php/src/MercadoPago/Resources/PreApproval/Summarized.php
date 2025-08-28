<?php

namespace MercadoPago\Resources\PreApproval;

/** Summarized class. */
class Summarized
{
    /** The number of quotas (or installments). */
    public ?int $quotas;

    /** The quantity that has been charged. */
    public ?int $charged_quantity;

    /** The quantity that is pending charge. */
    public ?int $pending_charge_quantity;

    /** The amount that has been charged. */
    public ?float $charged_amount;

    /** The amount that is pending charge. */
    public ?float $pending_charge_amount;

    /** The date of the last charge. */
    public ?string $last_charged_date;

    /** The amount of the last charge. */
    public ?float $last_charged_amount;

    /** The semaphore status. */
    public $semaphore;
}
