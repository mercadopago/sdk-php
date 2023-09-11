<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** InvoiceSearch class. */
class InvoiceSearch extends MPResource
{
    /** Search paging. */
    public array $paging;

    /** Search results. */
    public array $results;
}
