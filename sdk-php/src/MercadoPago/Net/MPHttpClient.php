<?php

namespace MercadoPago\Net;

/** MPHttpClient interface. */
interface MPHttpClient
{
    /**
     * Method responsible to send a request.
     * @param \MercadoPago\Net\MPRequest $request request to be sent.
     * @return \MercadoPago\Net\MPResponse response from the request.
     */
    public function send(MPRequest $request): MPResponse;
}
