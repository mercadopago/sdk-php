<?php

namespace MercadoPago\Resources\Preference;

use MercadoPago\Serialization\Mapper;

/** Track class. */
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
