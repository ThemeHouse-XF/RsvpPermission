<?php

/**
 *
 * @see XenForo_Model_Permission
 */
class ThemeHouse_RsvpPermission_Extend_XenForo_Model_Permission extends XFCP_ThemeHouse_RsvpPermission_Extend_XenForo_Model_Permission
{

    /**
     * Updates the specified permission combination for a user based on the
     * current state in the database.
     *
     * @param string $combinationKey Name of column to update in xf_user table
     * @param integer|array $userId Integer user ID or array of user info
     * @param boolean $buildOnCreate If true, the permission cache for a
     * combination will be built if it's created
     * @param boolean $checkForUserPerms If false, doesn't look for user perms.
     * Mostly an optimization
     *
     * @return false integer ID for the user if possible
     */
    public function updateUserEventPermissionCombination($combinationKey, array $user, $buildOnCreate = true,
        $checkForUserPerms = true)
    {
        if (!isset($user['user_id'])) {
            return false;
        }
        $userId = $user['user_id'];

        $originalCombination = $this->getPermissionCombinationById($user[$combinationKey]);

        $combinationId = $this->findOrCreatePermissionCombinationFromUser($user, $buildOnCreate, $checkForUserPerms);
        if ($combinationId != $user[$combinationKey]) {
            $db = $this->_getDb();
            $db->update('xf_user', array(
                $combinationKey => $combinationId
            ), 'user_id = ' . $db->quote($userId));

            // if the old combination used this user_id and it is not used
            // elsewhere, delete it
            if ($originalCombination && $originalCombination['user_id'] == $userId &&
                 $user['invited_permission_combination_id_th'] != $combinationId &&
                 $user['going_permission_combination_id_th'] != $combinationId &&
                 $user['maybe_permission_combination_id_th'] != $combinationId &&
                 $user['declined_permission_combination_id_th'] != $combinationId) {
                // $this->deletePermissionCombination($originalCombination['permission_combination_id']);
            }
        }

        return $combinationId;
    }
}