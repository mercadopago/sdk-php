<?php


namespace MercadoPago\Entities\Insight\DTO;


class CertificateInfo
{
    const SerialVersionUID = 1;

    public $certificateType;

    public $certificateVersion;

    public $certificateExpiration;

    public $handshakeTime;
}