<?php

namespace MercadoPago\Resources\Preference;

use MercadoPago\Serialization\Mapper;

/**
 * Preference Track resource.
 *
 * Represents a tracking pixel or conversion tag configuration for a checkout preference.
 * Supports Google Ads ("google_ad") and Facebook Pixel ("facebook_ad") tracking types,
 * enabling conversion measurement when buyers complete the checkout flow.
 *
 * @property array|object|null $values Track configuration values, mapped to {@see \MercadoPago\Resources\Preference\TrackValues}.
 */
class Track
{
    /** Class mapper. */
    use Mapper;

    /** Track type (google_ad or facebook_ad). */
    public ?string $type;

    /** Values according the track type. */
    public array|object|null $values;


    private $map = [
      "values" => "MercadoPago\Resources\Preference\TrackValues",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
