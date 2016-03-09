<?php

/**
 *
 * @see XenForo_DataWriter_User
 */
class ThemeHouse_RsvpPermission_Extend_XenForo_DataWriter_User extends XFCP_ThemeHouse_RsvpPermission_Extend_XenForo_DataWriter_User
{

    protected function _getFields()
    {
        $fields = parent::_getFields();

        $fields['xf_user'] = array_merge($fields['xf_user'],
            array(
                'invited_permission_combination_id_th' => array(
                    'type' => XenForo_DataWriter::TYPE_UINT,
                    'default' => 0
                ),
                'going_permission_combination_id_th' => array(
                    'type' => XenForo_DataWriter::TYPE_UINT,
                    'default' => 0
                ),
                'maybe_permission_combination_id_th' => array(
                    'type' => XenForo_DataWriter::TYPE_UINT,
                    'default' => 0
                ),
                'declined_permission_combination_id_th' => array(
                    'type' => XenForo_DataWriter::TYPE_UINT,
                    'default' => 0
                )
            ));

        return $fields;
    }

    /**
     *
     * @see XenForo_DataWriter_User::rebuildPermissionCombinationId()
     */
    public function rebuildPermissionCombinationId($checkForUserPerms = true)
    {
        $xenOptions = XenForo_Application::get('options');

        $extraUserGroups = array(
            'invited' => $xenOptions->th_rsvpPermissions_invitedUserGroupId,
            'going' => $xenOptions->th_rsvpPermissions_goingUserGroupId,
            'maybe' => $xenOptions->th_rsvpPermissions_maybeUserGroupId,
            'declined' => $xenOptions->th_rsvpPermissions_declinedUserGroupId
        );
        foreach ($extraUserGroups as $state => $userGroupId) {
            $user = $this->getMergedData();
            if ($userGroupId && $user['user_group_id'] != $userGroupId) {
                $groups = explode(',', $user['secondary_group_ids']);
                $groups[] = $userGroupId;
                $groups = array_map('intval', $groups);
                $groups = array_unique($groups);
                sort($groups, SORT_NUMERIC);
                $user['secondary_group_ids'] = implode(',', $groups);
            }
            $combinationId = $this->_getPermissionModel()->updateUserEventPermissionCombination(
                $state . '_permission_combination_id_th', $user, true, $checkForUserPerms);
            $this->_setPostSave($state . '_permission_combination_id_th', $combinationId);
        }

        parent::rebuildPermissionCombinationId($checkForUserPerms);
    }
}