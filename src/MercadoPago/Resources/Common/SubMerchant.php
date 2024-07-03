<?php

namespace MercadoPago\Resources\Common;

/** Submerchant identification class. */
class SubMerchant
{
    /** Submerchant code. */
    public ?string $sub_merchant_id;

    /** Submerchant MCC according to Abecs decision and/or primary CNAE. */
    public ?string $mcc;

    /** Country where the submerchant is located. */
    public ?string $country;

    /** Street number where the submerchant is located. */
    public ?number $address_door_number;

    /**  CEP of the submerchant. */
    public ?string $zip;

    /** CPF or CNPJ identification of the submerchant. */
    public ?string $document_number;

    /** City where the submerchant is located. */
    public ?string $city;

    /** Street where the submerchant is located. */
    public ?string $address_street;

    /** Name of the submerchant . */
    public ?string $business_name;

    /** State where the submerchant is located . */
    public ?string $region_code_iso;

    /** Postal code of the submerchant . */
    public ?string $region_code;

    /** CPF or CNPJ number of the submerchant . */
    public ?string $document_type;

    /** Phone number of the submerchant . */
    public ?string $phone;

    /** Payment Facilitator URL . */
    public ?string $url;


}
