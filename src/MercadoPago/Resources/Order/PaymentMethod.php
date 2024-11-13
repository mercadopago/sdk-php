<?php

/** API version: 5d077b6f-61b2-4b3a-8333-7a64ee547448 */

namespace MercadoPago\Resources\Order;

/** PaymentMethod class. */
class PaymentMethod
{
    /** Payment method ID. */
    public ?string $id;

    /** Payment method type. */
    public ?string $type;

    /** Card ID. */
    public ?string $card_id;

    /** Issuer ID. */
    public ?string $issuer_id;

    /** Token. */
    public ?string $token;

    /** Installments. */
    public ?int $installments;

    /** Statement descriptor. */
    public ?string $statement_descriptor;

    /** External resource URL. */
    public ?string $external_resource_url;

    /** Barcode content. */
    public ?string $barcode_content;

    /** Reference. */
    public ?string $reference;

    /** Verification code. */
    public ?string $verification_code;

    /** Financial institution. */
    public ?string $financial_institution;
}
