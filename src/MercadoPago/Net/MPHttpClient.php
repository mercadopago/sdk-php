<?php

namespace MercadoPago\Net;

/** MPHttpClient interface. */
interface MPHttpClient
{
    /**
     * Method responsible to send a request.
     */
    public function send(MPRequest $request): MPResponse;
}
