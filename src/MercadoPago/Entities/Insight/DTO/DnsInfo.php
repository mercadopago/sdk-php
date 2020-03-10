<?php


namespace MercadoPago\Entities\Insight\DTO;


class DnsInfo
{
    const SerialVersionUID = 1;

    public $nameServerAddress;
    public $lookupTime;

    /**
     * @param mixed $nameServerAddress
     * @return DnsInfo
     */
    public function setNameServerAddress($nameServerAddress)
    {
        $this->nameServerAddress = $nameServerAddress;
        return $this;
    }

    /**
     * @param mixed $lookupTime
     * @return DnsInfo
     */
    public function setLookupTime($lookupTime)
    {
        $this->lookupTime = $lookupTime;
        return $this;
    }


}