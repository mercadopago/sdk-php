<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** PreApprovalPlanSearch class. */
class PreApprovalPlanSearch extends MPResource
{
    /** Search paging. */
    public array $paging;

    /** Search results. */
    public array $results;
}
