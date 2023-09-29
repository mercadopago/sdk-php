<?php

namespace MercadoPago\Resources\Payment;

/** BankInfoCollector class. */
class BankInfoCollector
{
    /** Account ID. */
    public ?string $account_id;

    /** Account long name. */
    public ?string $long_name;

    /** Account holder name. */
    public ?string $account_holder_name;

    /** Transfer account ID. */
    public ?string $transfer_account_id;
}
