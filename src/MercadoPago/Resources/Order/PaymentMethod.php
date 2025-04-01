<?php

/** API version: 7d364c51-04c7-45e3-af61-f82423bcc39c */

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

    /** Token. */
    public ?string $token;

    /** Installments. */
    public ?int $installments;

    /** Statement descriptor. */
    public ?string $statement_descriptor;

    /** Ticket URL. */
    public ?string $ticket_url;

    /** Barcode content. */
    public ?string $barcode_content;

    /** Reference. */
    public ?string $reference;

    /** Reference ID. */
    public ?string $reference_id;

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
