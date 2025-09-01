<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Serialization\Mapper;

/** Status class. */
class Status
{
    /** Class mapper. */
    use Mapper;

    /** User billing status data. */
    public array|object|null $billing;

    /** User buy status data. */
    public array|object|null $buy;

    /** Indicates whether the user's email has been confirmed (true/false). */
    public ?bool $confirmed_email;

    /** User shopping cart status data. */
    public array|object|null $shopping_cart;

    /** Indicates whether immediate payment is enabled (true/false). */
    public ?bool $immediate_payment;

    /** User list status data. */
    public array|object|null $list;

    /** Indicates the MercadoEnvios status. */
    public ?string $mercadoenvios;

    /** Indicates the MercadoPago account type (e.g., "personal"). */
    public ?string $mercadopago_account_type;

    /** Indicates whether MercadoPago credit card is accepted (true/false). */
    public ?bool $mercadopago_tc_accepted;

    /** Required action. */
    public $required_action;

    /** User sell status data. */
    public array|object|null $sell;

    /** Site status (e.g., "active"). */
    public ?string $site_status;

    /** User type. */
    public ?string $user_type;

    public $map = [
        "billing" => "MercadoPago\Resources\User\StatusBilling",
        "buy" => "MercadoPago\Resources\User\StatusList",
        "shopping_cart" => "MercadoPago\Resources\User\StatusShoppingCart",
        "list" => "MercadoPago\Resources\User\StatusList",
        "sell" => "MercadoPago\Resources\User\StatusList",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
