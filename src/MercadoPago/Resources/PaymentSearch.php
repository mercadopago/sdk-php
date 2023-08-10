<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;

/** PaymentSearch class. */
class PaymentSearch extends MPResource
{
    /** Search paging. */
    public array $paging;

    /** Search results. */
    public array $results;
}
