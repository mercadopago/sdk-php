<?php

namespace MercadoPago\Resources\User;

/** Company class. */
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
