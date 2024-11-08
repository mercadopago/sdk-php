<?php

namespace MercadoPago\Resources\Order;

/** Route class. */
class Route
{
    /** Departure. */
    public ?string $departure;

    /** Destination. */
    public ?string $destination;

    /** Departure date time. */
    public ?string $departure_date_time;

    /** Arrival date time. */
    public ?string $arrival_date_time;

    /** Company. */
    public ?string $company;
}
