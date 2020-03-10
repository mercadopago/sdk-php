<?php


namespace MercadoPago\Entities\Insight\DTO;


class StructuredMetricRequest
{
    const SerialVersionUID = 1;

    /**
     * @var ClientInfo
     */
    public $clientInfo;

    /**
     * @var BusinessFlowInfo
     */
    public $businessFlowInfo;

    /**
     * @var EventInfo
     */
    public $eventInfo;

    /**
     * @var ConnectionInfo
     */
    public $connectionInfo;

    /**
     * @var DeviceInfo
     */
    public $deviceInfo;

    /**
     * @var string
     */
    public $base64data;

    /**
     * @param ClientInfo $clientInfo
     * @return StructuredMetricRequest
     */
    public function setClientInfo($clientInfo)
    {
        $this->clientInfo = $clientInfo;
        return $this;
    }

    /**
     * @param BusinessFlowInfo $businessFlowInfo
     * @return StructuredMetricRequest
     */
    public function setBusinessFlowInfo($businessFlowInfo)
    {
        $this->businessFlowInfo = $businessFlowInfo;
        return $this;
    }

    /**
     * @param EventInfo $eventInfo
     * @return StructuredMetricRequest
     */
    public function setEventInfo($eventInfo)
    {
        $this->eventInfo = $eventInfo;
        return $this;
    }

    /**
     * @param ConnectionInfo $connectionInfo
     * @return StructuredMetricRequest
     */
    public function setConnectionInfo($connectionInfo)
    {
        $this->connectionInfo = $connectionInfo;
        return $this;
    }

    /**
     * @param DeviceInfo $deviceInfo
     * @return StructuredMetricRequest
     */
    public function setDeviceInfo($deviceInfo)
    {
        $this->deviceInfo = $deviceInfo;
        return $this;
    }

    /**
     * @param string $base64data
     * @return StructuredMetricRequest
     */
    public function setBase64data($base64data)
    {
        $this->base64data = $base64data;
        return $this;
    }


}