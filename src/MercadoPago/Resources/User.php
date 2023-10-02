<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/** User class. */
class User extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** The user's ID. */
    public ?int $id;

    /** The user's nickname. */
    public ?string $nickname;

    /** The registration date and time. */
    public ?string $registration_date;

    /** The user's first name. */
    public ?string $first_name;

    /** The user's last name. */
    public ?string $last_name;

    /** The user's gender. */
    public ?string $gender;

    /** The country ID (e.g., "BR" for Brazil). */
    public ?string $country_id;

    /** The user's email. */
    public ?string $email;

    /** User identification data. */
    public array|object|null $identification;

    /** User address data. */
    public array|object|null $address;

    /** User phone data. */
    public array|object|null $phone;

    /** User alternative phone data. */
    public array|object|null $alternative_phone;

    /** The user type (e.g., "normal"). */
    public ?string $user_type;

    /** User tags. */
    public ?array $tags;

    /** User logo. */
    public $logo;

    /** User points. */
    public ?int $points;

    /** The site ID (e.g., "MLB" for MercadoLibre Brazil). */
    public ?string $site_id;

    /** User permalink. */
    public ?string $permalink;

    /** Seller experience (e.g., "NEWBIE"). */
    public ?string $seller_experience;

    /** User bill data. */
    public array|object|null $bill_data;

    /** User seller reputation data. */
    public array|object|null $seller_reputation;

    /** User buyer reputation data. */
    public array|object|null $buyer_reputation;

    /** User status data. */
    public array|object|null $status;

    /** Secure email. */
    public ?string $secure_email;

    /** User company data. */
    public array|object|null $company;

    /** User credit data. */
    public array|object|null $credit;

    /** User context data. */
    public array|object|null $context;

    /** User registration identifiers. */
    public ?array $registration_identifiers;

    public $map = [
        "identification" => "MercadoPago\Resources\Common\Identification",
        "address" => "MercadoPago\Resources\User\Address",
        "phone" => "MercadoPago\Resources\User\Phone",
        "alternative_phone" => "MercadoPago\Resources\User\AlternativePhone",
        "bill_data" => "MercadoPago\Resources\User\BillData",
        "seller_reputation" => "MercadoPago\Resources\User\SellerReputation",
        "buyer_reputation" => "MercadoPago\Resources\User\BuyerReputation",
        "status" => "MercadoPago\Resources\User\Status",
        "company" => "MercadoPago\Resources\User\Company",
        "credit" => "MercadoPago\Resources\User\Credit",
        "context" => "MercadoPago\Resources\User\StaContextus",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
