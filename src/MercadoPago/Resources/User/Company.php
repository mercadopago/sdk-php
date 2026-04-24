<?php

namespace MercadoPago\Resources\User;

/**
 * User Company resource.
 *
 * Represents the business/company information associated with a user account,
 * including brand name, corporate name, tax identifiers, and payment descriptor.
 */
class Company
{
    /** The brand name of the company. */
    public ?string $brand_name;

    /** The city tax ID of the company. */
    public ?string $city_tax_id;

    /** The corporate name of the company. */
    public ?string $corporate_name;

    /** The identification of the company. */
    public ?string $identification;

    /** The state tax ID of the company. */
    public ?string $state_tax_id;

    /** The customer type ID of the company (e.g., "CO"). */
    public ?string $cust_type_id;

    /** The soft descriptor of the company. */
    public ?string $soft_descriptor;
}
