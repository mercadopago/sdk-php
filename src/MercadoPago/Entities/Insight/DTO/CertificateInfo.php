<?php


namespace MercadoPago\Entities\Insight\DTO;
use MercadoPago\Annotation\Attribute;

class CertificateInfo
{
    const SerialVersionUID = 1;

    /**
     * @var string
     * @Attribute(json = "certificate-type")
     */
    public $certificateType;

    /**
     * @var string
     * @Attribute(json = "certificate-version")
     */
    public $certificateVersion;

    /**
     * @var string
     * @Attribute(json = "certificate-expiration")
     */
    public $certificateExpiration;

    /**
     * @var int
     * @Attribute(json = "handshake-time-millis")
     */
    public $handshakeTime;
}