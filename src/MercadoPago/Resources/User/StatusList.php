<?php

namespace MercadoPago\Resources\User;

use MercadoPago\Serialization\Mapper;

/**
 * User Status List resource.
 *
 * Represents the permission status for a specific user action (buy, sell, or list),
 * including whether the action is allowed, any restriction codes, and immediate
 * payment requirements.
 *
 * @property array|object|null $immediate_payment Immediate payment config, mapped to {@see \MercadoPago\Resources\User\StatusBuyImmediatePayment}.
 */
class StatusList
{
    /** Class mapper. */
    use Mapper;

    /** Indicates whether buying is allowed (true/false). */
    public ?bool $allow;

    /** Buy status codes. */
    public array|object|null $codes;

    /** User immediate payment data for buying. */
    public array|object|null $immediate_payment;

    public $map = [
        "immediate_payment" => "MercadoPago\Resources\User\StatusBuyImmediatePayment",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
