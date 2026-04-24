<?php

namespace MercadoPago\Resources\Common;

/**
 * Represents a sub-merchant (payment facilitator participant) in the MercadoPago API.
 *
 * Contains identification and location data for the sub-merchant receiving the payment
 * in a payment facilitator (PayFac) model. Sent within {@see \MercadoPago\Resources\Payment\ForwardData}
 * to comply with card brand and regulatory requirements.
 */
class SubMerchant
{
    /** Unique identifier assigned to the sub-merchant by the payment facilitator. */
    public ?string $sub_merchant_id;

    /** Merchant Category Code (MCC) per ABECS/CNAE classification. */
    public ?string $mcc;

    /** ISO 3166-1 country code where the sub-merchant operates. */
    public ?string $country;

    /** Street/door number of the sub-merchant's address. */
    public ?number $address_door_number;

    /** Postal code (CEP) of the sub-merchant's address. */
    public ?string $zip;

    /** Tax identification number of the sub-merchant (e.g. CPF or CNPJ). */
    public ?string $document_number;

    /** City where the sub-merchant is located. */
    public ?string $city;

    /** Street name of the sub-merchant's address. */
    public ?string $address_street;

    /** Registered business name of the sub-merchant. */
    public ?string $business_name;

    /** ISO state/region code where the sub-merchant is located. */
    public ?string $region_code_iso;

    /** Region or state code of the sub-merchant. */
    public ?string $region_code;

    /** Type of identification document (e.g. "CPF", "CNPJ"). */
    public ?string $document_type;

    /** Contact phone number of the sub-merchant. */
    public ?string $phone;

    /** URL of the payment facilitator or sub-merchant website. */
    public ?string $url;


}
