<?php

namespace MercadoPago\Resources\Preference;

use MercadoPago\Net\MPResource;

/** PreferePreferenceListResultnce class. */
class PreferenceListResult extends MPResource
{
    /** Preference ID. */
    public ?string $id;

    /** List of items to be paid. */
    public ?array $items;

    /** Client ID. */
    public ?string $client_id;

    /** Reference you can synchronize with your payment system. */
    public ?string $external_reference;

    /** True if a preference expires, false if not. */
    public ?bool $expires;

    /** Date when the preference will be active. */
    public ?string $expiration_date_from;

    /** Date when the preference will be expired. */
    public ?string $expiration_date_to;

    /** Collector ID. */
    public ?int $collector_id;

    /** Origin of the payment. Default value: NONE. */
    public ?string $marketplace;

    /** Operation type. */
    public ?string $operation_type;

    /** Configures which processing modes to use. */
    public ?array $processing_modes;

    /** Date of creation. */
    public ?string $date_created;

    /** Site ID. */
    public ?string $site_id;

    /** Product ID. */
    public ?string $product_id;

    /** Live mode. */
    public ?bool $live_mode;

    /** Last modified. */
    public ?string $last_updated;

    /** Purpose. */
    public ?string $purpose;

    /** Total amount. */
    public ?int $total_amount;

    /** Shipping mode. */
    public $shipping_mode;

    /** Sponsor ID. */
    public ?int $sponsor_id;

    /** Platform ID. */
    public ?string $platform_id;

    /** Payer ID. */
    public ?int $payer_id;

    /** Payer Email. */
    public ?string $payer_email;

    /** Integrator ID. */
    public ?string $integrator_id;

    /** Corporation ID. */
    public ?string $corporation_id;

    /** Concept ID. */
    public ?string $concept_id;
}
