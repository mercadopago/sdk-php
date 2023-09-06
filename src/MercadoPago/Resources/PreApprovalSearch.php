<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** PreApprovalSearch class. */
class PreApprovalSearch extends MPResource
{
    /** Search paging. */
    public array $paging;

    /** Search results. */
    public array $results;
}
