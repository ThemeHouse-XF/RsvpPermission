<?php

class ThemeHouse_RsvpPermission_Install_Controller extends ThemeHouse_Install
{

    protected $_resourceManagerUrl = 'https://xenforo.com/community/resources/rsvp-permissions.4111/';
    
    public function _getTableChanges()
    {
        return array(
            'xf_user' => array(
                'invited_permission_combination_id_th' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0',
                'going_permission_combination_id_th' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0',
                'maybe_permission_combination_id_th' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0',
                'declined_permission_combination_id_th' => 'INT(10) UNSIGNED NOT NULL DEFAULT 0',
            ), 
        );
    }


    protected function _postInstall()
    {
        $addOn = $this->getModelFromCache('XenForo_Model_AddOn')->getAddOnById('YoYo_');
        if ($addOn) {
            $db->query("
                UPDATE xf_user
                    SET invited_permission_combination_id_th=invited_permission_combination_id_waindigo, going_permission_combination_id_th=going_permission_combination_id_waindigo, maybe_permission_combination_id_th=maybe_permission_combination_id_waindigo, declined_permission_combination_id_th=declined_permission_combination_id_waindigo");
        }
    }
}