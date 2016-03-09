<?php

/**
 *
 * @see XenResource_Model_Resource
 */
class ThemeHouse_RsvpPermission_Extend_XenResource_Model_Resource extends XFCP_ThemeHouse_RsvpPermission_Extend_XenResource_Model_Resource
{

    /**
     *
     * @see XenResource_Model_Resource::standardizeViewingUserReferenceForCategory()
     */
    public function standardizeViewingUserReferenceForCategory($categoryId, array &$viewingUser = null,
        array &$categoryPermissions = null)
    {
        $this->standardizeViewingUserReference($viewingUser);

        if (is_array($categoryId) && !empty($categoryId['event_invite_state'])) {
            switch ($categoryId['event_invite_state']) {
                case 'invited':
                    if ($viewingUser['invited_permission_combination_id_th']) {
                        $viewingUser['permission_combination_id'] = $viewingUser['invited_permission_combination_id_th'];
                    }
                    break;
                case 'going':
                    if ($viewingUser['going_permission_combination_id_th']) {
                        $viewingUser['permission_combination_id'] = $viewingUser['going_permission_combination_id_th'];
                    }
                    break;
                case 'maybe':
                    if ($viewingUser['maybe_permission_combination_id_th']) {
                        $viewingUser['permission_combination_id'] = $viewingUser['maybe_permission_combination_id_th'];
                    }
                    break;
                case 'declined':
                default:
                    if ($viewingUser['declined_permission_combination_id_th']) {
                        $viewingUser['permission_combination_id'] = $viewingUser['declined_permission_combination_id_th'];
                    }
            }
        }

        return parent::standardizeViewingUserReferenceForCategory($categoryId, $viewingUser, $categoryPermissions);
    }
}