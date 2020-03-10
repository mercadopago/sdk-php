<?php


namespace MercadoPago\Entities\Insight\DTO;


class TcpInfo
{
    const SerialVersionUID = 1;

    public $sourceAddress;

    public $targetAddress;

    public $handshakeTime;

    /**
     * @param mixed $sourceAddress
     * @return TcpInfo
     */
    public function setSourceAddress($sourceAddress)
    {
        $this->sourceAddress = $sourceAddress;
        return $this;
    }

    /**
     * @param mixed $targetAddress
     * @return TcpInfo
     */
    public function setTargetAddress($targetAddress)
    {
        $this->targetAddress = $targetAddress;
        return $this;
    }

    /**
     * @param mixed $handshakeTime
     * @return TcpInfo
     */
    public function setHandshakeTime($handshakeTime)
    {
        $this->handshakeTime = $handshakeTime;
        return $this;
    }


}