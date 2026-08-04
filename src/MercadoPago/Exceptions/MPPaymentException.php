<?php

namespace MercadoPago\Exceptions;

/** Thrown when the API returns HTTP 402 Payment Required (transaction processing error, e.g. Orders/AP). */
class MPPaymentException extends MPApiException {}
