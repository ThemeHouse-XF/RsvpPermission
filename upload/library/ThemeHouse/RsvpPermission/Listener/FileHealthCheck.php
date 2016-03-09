<?php

class ThemeHouse_RsvpPermission_Listener_FileHealthCheck
{

    public static function fileHealthCheck(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $hashes = array_merge($hashes,
            array(
                'library/ThemeHouse/RsvpPermission/Extend/XenForo/DataWriter/User.php' => 'b3bf5b9d05c928398e9852a03ee9c2ad',
                'library/ThemeHouse/RsvpPermission/Extend/XenForo/Model/Permission.php' => '579b219341af57d2fafe3b73313dbb26',
                'library/ThemeHouse/RsvpPermission/Extend/XenForo/Model/Thread.php' => 'a6a068b44962f67aa2e9cb36debdddf5',
                'library/ThemeHouse/RsvpPermission/Extend/XenForo/Visitor.php' => '0b9a865ba46c48e636b9b3d6eebe14d3',
                'library/ThemeHouse/RsvpPermission/Extend/XenResource/Model/Resource.php' => 'eda7eba390dc97a97df4b8c3942394a1',
                'library/ThemeHouse/RsvpPermission/Install/Controller.php' => '11d72c74b67bb4b352782246c41c24e1',
                'library/ThemeHouse/RsvpPermission/Listener/LoadClass.php' => '8aaf40a75a60cf87c56880a24e100b94',
                'library/ThemeHouse/RsvpPermission/Option/UserGroupChooser.php' => 'cf93a3c21d4c1e0ee9018b939bfd261f',
                'library/ThemeHouse/Install.php' => '18f1441e00e3742460174ab197bec0b7',
                'library/ThemeHouse/Install/20151109.php' => '2e3f16d685652ea2fa82ba11b69204f4',
                'library/ThemeHouse/Deferred.php' => 'ebab3e432fe2f42520de0e36f7f45d88',
                'library/ThemeHouse/Deferred/20150106.php' => 'a311d9aa6f9a0412eeba878417ba7ede',
                'library/ThemeHouse/Listener/ControllerPreDispatch.php' => 'fdebb2d5347398d3974a6f27eb11a3cd',
                'library/ThemeHouse/Listener/ControllerPreDispatch/20150911.php' => 'f2aadc0bd188ad127e363f417b4d23a9',
                'library/ThemeHouse/Listener/InitDependencies.php' => '8f59aaa8ffe56231c4aa47cf2c65f2b0',
                'library/ThemeHouse/Listener/InitDependencies/20150212.php' => 'f04c9dc8fa289895c06c1bcba5d27293',
                'library/ThemeHouse/Listener/LoadClass.php' => '5cad77e1862641ddc2dd693b1aa68a50',
                'library/ThemeHouse/Listener/LoadClass/20150518.php' => 'f4d0d30ba5e5dc51cda07141c39939e3',
            ));
    }
}