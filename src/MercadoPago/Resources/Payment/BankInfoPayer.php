<?php

namespace MercadoPago\Resources\Payment;

/** BankInfoPayer class. */
class BankInfoPayer
{
    /** ID. */
    public ?string $id;

    /** Email. */
    public ?string $email;

    /** Account ID. */
    public ?string $account_id;

    /** Account long name. */
    public ?string $long_name;

    /** External account ID. */
    public ?string $external_account_id;

    /** Account Holder Name */
    public ?string $account_holder_name;

    /** Identification */
    public array|object|null $identification;
}
