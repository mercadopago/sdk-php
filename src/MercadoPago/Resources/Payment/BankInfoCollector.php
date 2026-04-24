<?php

namespace MercadoPago\Resources\Payment;

/**
 * Represents the collector's (seller's) bank account details in a bank transfer payment.
 *
 * Nested within {@see BankInfo} to identify where the transferred funds are received.
 */
class BankInfoCollector
{
    /** Bank account identifier of the collector. */
    public ?string $account_id;

    /** Full display name of the bank account. */
    public ?string $long_name;

    /** Name of the account holder at the bank. */
    public ?string $account_holder_name;

    /** Transfer-specific account identifier used by the banking system. */
    public ?string $transfer_account_id;
}
