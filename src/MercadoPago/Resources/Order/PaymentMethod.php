<?php

/** API version: b950ae02-4f49-4686-9ad3-7929b21b6495 */

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

    /** Qr Code */
    public ?string $qr_code;

    /** Qr Code Base64 */
    public ?string $qr_code_base64;

    /** Digitable Line */
    public ?string $digitable_line;
}
