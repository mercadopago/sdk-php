<?php

namespace MercadoPago\Resources\Common;

/** Route class. */
class Route
{
    /** Departure city. */
    public ?string $departure;

    /**  Destination city. */
    public ?string $destination;

    /** Departure date and time. The valid format is as follows - "yyyy-MM-ddTHH:mm:ss.sssZ". Example - 2023-12-31T09:37:52.000-04:00.*/
    public ?string $departure_date_time;

    /** Arrival date and time. The valid format is as follows - "yyyy-MM-ddTHH:mm:ss.sssZ". Example - 2023-12-31T09:37:52.000-04:00.*/
    public ?string $arrival_date_time;

    /** Company name. */
    public ?string $company;
}
