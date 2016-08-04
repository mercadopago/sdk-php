<?php

namespace MercadoPago;

abstract class Entity
{
    protected static $_manager;

    public static function setManager(Manager $manager)
    {
        self::$_manager = $manager;
    }

    public static function loadAll()
    {
        return self::$_manager->execute(
            get_called_class(), 'get'
        );
    }
    public static function load()
    {
        return self::$_manager->execute(
            get_called_class(), 'get'
        );
    }
    public static function addNew()
    {
        return self::$_manager->execute(
            get_called_class(), ''
        );
    }
    public static function update()
    {
        return self::$_manager->execute(
            get_called_class(), ''
        );
    }
    public static function destroy()
    {
        return self::$_manager->execute(
            get_called_class(), ''
        );
    }
    public static function save()
    {
        return self::$_manager->execute(
            get_called_class(), ''
        );
    }


}