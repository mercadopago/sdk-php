<?php


namespace MercadoPago\Entities\Insight\DTO;


class ConnectionInfo
{
    const serialVersionUID = 1;

    /**
     * @var string
     */
    public $networkType;

    /**
     * @var string
     */
    public $networkSpeed;

    /**
     * @var string
     */
    public $userAgent;

    /**
     * @var boolean
     */
    public $wasReused;

    /**
     * @var DnsInfo
     */
    public $dnsInfo;

    /**
     * @var CertificateInfo
     */
    public $certificateInfo;

    /**
     * @var TcpInfo
     */
    public $tcpInfo;

    /**
     * @var ProtocolInfo
     */
    public $protocolInfo;

    /**
     * @var boolean
     */
    public $completeData;

    /**
     * @param string $networkType
     * @return ConnectionInfo
     */
    public function setNetworkType($networkType)
    {
        $this->networkType = $networkType;
        return $this;
    }

    /**
     * @param string $networkSpeed
     * @return ConnectionInfo
     */
    public function setNetworkSpeed($networkSpeed)
    {
        $this->networkSpeed = $networkSpeed;
        return $this;
    }

    /**
     * @param string $userAgent
     * @return ConnectionInfo
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @param bool $wasReused
     * @return ConnectionInfo
     */
    public function setWasReused($wasReused)
    {
        $this->wasReused = $wasReused;
        return $this;
    }

    /**
     * @param DnsInfo $dnsInfo
     * @return ConnectionInfo
     */
    public function setDnsInfo($dnsInfo)
    {
        $this->dnsInfo = $dnsInfo;
        return $this;
    }

    /**
     * @param CertificateInfo $certificateInfo
     * @return ConnectionInfo
     */
    public function setCertificateInfo($certificateInfo)
    {
        $this->certificateInfo = $certificateInfo;
        return $this;
    }

    /**
     * @param TcpInfo $tcpInfo
     * @return ConnectionInfo
     */
    public function setTcpInfo($tcpInfo)
    {
        $this->tcpInfo = $tcpInfo;
        return $this;
    }

    /**
     * @param ProtocolInfo $protocolInfo
     * @return ConnectionInfo
     */
    public function setProtocolInfo($protocolInfo)
    {
        $this->protocolInfo = $protocolInfo;
        return $this;
    }

    /**
     * @param bool $completeData
     * @return ConnectionInfo
     */
    public function setCompleteData($completeData)
    {
        $this->completeData = $completeData;
        return $this;
    }


}