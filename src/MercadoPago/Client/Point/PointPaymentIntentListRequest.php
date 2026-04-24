<?php

namespace MercadoPago\Client\Point;

/**
 * Request payload for listing payment intent events within a date range.
 *
 * @see PointClient::getPaymentIntentList()
 */
class PointPaymentIntentListRequest
{
    /** Start date for the filter range (ISO 8601 format). */
    public string $start_date;

    /** End date for the filter range (ISO 8601 format). */
    public string $end_date;

    public function getParameters(): array
    {
        return [
            "startDate" => $this->start_date,
            "endDate" => $this->end_date,
        ];
    }
}
