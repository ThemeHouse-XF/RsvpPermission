<?php

class ThemeHouse_RsvpPermission_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_RsvpPermission' => array(
                'datawriter' => array(
                    'XenForo_DataWriter_User'
                ), 
                'model' => array(
                    'XenForo_Model_Permission',
                    'XenForo_Model_Thread',
                    'XenResource_Model_Resource'
                ), 
                'visitor' => array(
                    'XenForo_Visitor'
                ), 
            ), 
        );
    }

    public static function loadClassDataWriter($class, array &$extend)
    {
        $extend = self::createAndRun('ThemeHouse_RsvpPermission_Listener_LoadClass', $class, $extend, 'datawriter');
    }

    public static function loadClassModel($class, array &$extend)
    {
        $extend = self::createAndRun('ThemeHouse_RsvpPermission_Listener_LoadClass', $class, $extend, 'model');
    }

    public static function loadClassVisitor($class, array &$extend)
    {
        $extend = self::createAndRun('ThemeHouse_RsvpPermission_Listener_LoadClass', $class, $extend, 'visitor');
    }
}