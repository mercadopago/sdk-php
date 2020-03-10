<?php


namespace MercadoPago\Entities\Insight\DTO;


class ProtocolInfo
{
    const SerialVersionUID = 1;

    public $name;

    public $protocolHttp;

    public $retryCount;

    /**
     * @param mixed $name
     * @return ProtocolInfo
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $protocolHttp
     * @return ProtocolInfo
     */
    public function setProtocolHttp($protocolHttp)
    {
        $this->protocolHttp = $protocolHttp;
        return $this;
    }

    /**
     * @param mixed $retryCount
     * @return ProtocolInfo
     */
    public function setRetryCount($retryCount)
    {
        $this->retryCount = $retryCount;
        return $this;
    }


}