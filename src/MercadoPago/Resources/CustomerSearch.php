<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** Customer Search class. */
class CustomerSearch extends MPResource
{
    /** Search paging. */
    public array $paging;

    /** Search results. */
    public array $results;
}
