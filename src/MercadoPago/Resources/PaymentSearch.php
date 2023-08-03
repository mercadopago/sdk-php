<?php

namespace MercadoPago\Resources;

use MercadoPago\Net\MPResource;
use MercadoPago\Serialization\Mapper;

class PaymentSearch extends MPResource
{
    public $paging;
    public $results;
}
