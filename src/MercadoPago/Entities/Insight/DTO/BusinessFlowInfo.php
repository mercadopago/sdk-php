<?php


namespace MercadoPago\Entities\Insight\DTO;


class BusinessFlowInfo
{
    const serialVersionUID = 1;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $uid;

    /**
     * @param string $name
     * @return BusinessFlowInfo
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $uid
     * @return BusinessFlowInfo
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
        return $this;
    }


}