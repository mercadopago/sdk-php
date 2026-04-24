<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents the payer's (buyer's) bank account details in a bank transfer payment.
 *
 * Nested within {@see BankInfo} to identify the source bank account
 * from which the funds were transferred.
 */
class BankInfoPayer
{
    /** Unique identifier of the payer in the banking context. */
    public ?string $id;

    /** Email address associated with the payer's bank account. */
    public ?string $email;

    /** Bank account identifier of the payer. */
    public ?string $account_id;

    /** Full display name of the payer's bank account. */
    public ?string $long_name;

    /** External identifier for the payer's account in third-party systems. */
    public ?string $external_account_id;

    /** Name of the account holder at the payer's bank. */
    public ?string $account_holder_name;

    /** @var \MercadoPago\Resources\Common\Identification|array|null Payer's identification document associated with the bank account. */
    public array|object|null $identification;
}
