<?php

namespace MercadoPago\Net;

/** MPResource class. */
class MPResource
{
    private MPResponse $response;

    public function setResponse(MPResponse $response): void
    {
        $this->response = $response;
    }

    public function getResponse(): MPResponse
    {
        return $this->response;
    }
}
