<?php

namespace MercadoPago\Resources\Common;

/**
 * Represents a personal or legal identification document in the MercadoPago API.
 *
 * Used to identify payers, cardholders, and sub-merchants through government-issued
 * documents such as CPF, CNPJ, DNI, or similar national IDs.
 */
class Identification
{
    /** Document type code (e.g. "CPF", "CNPJ", "DNI", "CC"). */
    public ?string $type;

    /** Document number corresponding to the identification type. */
    public ?string $number;
}
