<?php

namespace MercadoPago\Resources\User;

/**
 * User Bill Data resource.
 *
 * Contains the user's billing preferences, specifically whether
 * the user accepts credit notes for transactions.
 */
class BillData
{
    /** Indicates whether the user accepts credit notes (true/false). */
    public ?bool $accept_credit_note;
}
