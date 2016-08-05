<?php

namespace MercadoPago;

/**
 * Entity Class Doc Comment
 *
 * @package MercadoPago
 */
abstract class Entity
{
    /**
     * @var
     */
    protected static $_manager;

    /**
     * @param Manager $manager
     */
    public static function setManager(Manager $manager)
    {
        self::$_manager = $manager;
    }

    /**
     * @return mixed
     */
    public static function loadAll()
    {
        return self::$_manager->execute(
            get_called_class(), 'get'
        );
    }

    /**
     * @return mixed
     */
    public static function load()
    {
        return self::$_manager->execute(
            get_called_class(), 'get'
        );
    }

    /**
     * @return mixed
     */
    public static function addNew()
    {
        return self::$_manager->execute(
            get_called_class(), ''
        );
    }

    /**
     * @return mixed
     */
    public static function update()
    {
        return self::$_manager->execute(
            get_called_class(), ''
        );
    }

    /**
     * @return mixed
     */
    public static function destroy()
    {
        return self::$_manager->execute(
            get_called_class(), ''
        );
    }

    /**
     * @return mixed
     */
    public static function save()
    {
        return self::$_manager->execute(
            get_called_class(), ''
        );
    }


}