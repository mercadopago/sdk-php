<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * PreApproval (Subscription) Search resource.
 *
 * Represents the paginated result set returned when searching for subscriptions.
 * Contains matching subscription records along with pagination metadata.
 *
 * @property array|object|null $paging Pagination info, mapped to {@see \MercadoPago\Resources\Common\Paging}.
 * @property array|object|null $results Subscription results, mapped to {@see \MercadoPago\Resources\PreApproval\PreApprovalListResult}.
 *
 * @see \MercadoPago\Client\PreApproval\PreApprovalClient
 */
class PreApprovalSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search paging. */
    public array|object|null $paging;

    /** Search results. */
    public array|object|null $results;

    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "results" => "MercadoPago\Resources\PreApproval\PreApprovalListResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
