<?php

namespace MercadoPago\Net;

/** MPResource class. */
class MPResource
{
    private $response;

    function setResponse(MPResponse $response): void
    {
        $this->response = $response;
    }

    function getResponse(): MPResponse
    {
        return $this->response;
    }
}
