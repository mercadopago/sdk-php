<?php


namespace MercadoPago\Entities\Insight\DTO;


class EventInfo
{
    const SerialVersionUID = 1;

    public $name;

    /**
     * @param mixed $name
     * @return EventInfo
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}