<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

/**
 * PreApproval Plan (Subscription Plan) Search resource.
 *
 * Represents the paginated result set returned when searching for subscription plans.
 * Contains matching plan records along with pagination metadata.
 *
 * @property array|object|null $paging Pagination info, mapped to {@see \MercadoPago\Resources\Common\Paging}.
 * @property array|object|null $results Plan results, mapped to {@see \MercadoPago\Resources\PreApprovalPlan\PreApprovalPlanListResult}.
 *
 * @see \MercadoPago\Client\PreApprovalPlan\PreApprovalPlanClient
 */
class PreApprovalPlanSearch extends MPResource
{
    /** Class mapper. */
    use Mapper;

    /** Search paging. */
    public array|object|null $paging;

    /** Search results. */
    public array|object|null $results;

    private $map = [
        "paging" => "MercadoPago\Resources\Common\Paging",
        "results" => "MercadoPago\Resources\PreApprovalPlan\PreApprovalPlanListResult",
    ];

    /**
     * Method responsible for getting map of entities.
     */
    public function getMap(): array
    {
        return $this->map;
    }
}
