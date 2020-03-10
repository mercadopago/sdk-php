<?php


namespace MercadoPago\Entities\Insight\DTO;


class DeviceInfo
{
    const SerialVersionUID = 1;

    public $osName;

    public $modelName;

    public $cpuType;

    public $ramSize;

    /**
     * @param mixed $osName
     * @return DeviceInfo
     */
    public function setOsName($osName)
    {
        $this->osName = $osName;
        return $this;
    }

    /**
     * @param mixed $modelName
     * @return DeviceInfo
     */
    public function setModelName($modelName)
    {
        $this->modelName = $modelName;
        return $this;
    }

    /**
     * @param mixed $cpuType
     * @return DeviceInfo
     */
    public function setCpuType($cpuType)
    {
        $this->cpuType = $cpuType;
        return $this;
    }

    /**
     * @param mixed $ramSize
     * @return DeviceInfo
     */
    public function setRamSize($ramSize)
    {
        $this->ramSize = $ramSize;
        return $this;
    }
}