<?php

/**
 *
 * @see XenForo_Visitor
 */
class ThemeHouse_RsvpPermission_Extend_XenForo_Visitor extends XFCP_ThemeHouse_RsvpPermission_Extend_XenForo_Visitor
{

    public function setPermissionCombinationId($permissionCombinationId)
    {
        if ($permissionCombinationId) {
            $this->_user['permission_combination_id'] = $permissionCombinationId;
        }
    }
}