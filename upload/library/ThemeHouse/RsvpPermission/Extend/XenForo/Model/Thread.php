<?php

/**
 *
 * @see XenForo_Model_Thread
 */
class ThemeHouse_RsvpPermission_Extend_XenForo_Model_Thread extends XFCP_ThemeHouse_RsvpPermission_Extend_XenForo_Model_Thread
{

    /**
     *
     * @see XenForo_Model_Thread::prepareThreadFetchOptions()
     */
    public function prepareThreadFetchOptions(array $fetchOptions)
    {
        $threadFetchOptions = parent::prepareThreadFetchOptions($fetchOptions);

        $selectFields = $threadFetchOptions['selectFields'];
        $joinTables = $threadFetchOptions['joinTables'];
        $orderClause = $threadFetchOptions['orderClause'];

        $xenOptions = XenForo_Application::get('options');

        if ($xenOptions->th_rsvpPermissions_invitedUserGroupId ||
             $xenOptions->th_rsvpPermissions_goingUserGroupId ||
             $xenOptions->th_rsvpPermissions_maybeUserGroupId ||
             $xenOptions->th_rsvpPermissions_declinedUserGroupId) {
            $selectFields .= ',
            	th_resourceevents_resource.resource_id, th_resourceevents_resource.resource_category_id,
                event.start_time AS event_start_time, event.end_time AS event_end_time,
                event.start_timezone AS event_start_timezone, event.end_timezone AS event_end_timezone,
                event.current_event_date_id AS event_date_id, event.event_date_count,
                event_date.going AS event_going, event_date.maybe AS event_maybe,
                event_date.invited AS event_invited, event_date.declined AS event_declined';
            $joinTables .= '
    			LEFT JOIN xf_resource AS th_resourceevents_resource
    				ON (th_resourceevents_resource.discussion_thread_id = thread.thread_id)
    			LEFT JOIN xf_resource_event_th AS event ON
    				(event.event_id = th_resourceevents_resource.current_event_id_th)
                LEFT JOIN xf_resource_event_date_th AS event_date ON
    				(event.event_id = event_date.event_id)';
            if (XenForo_Visitor::getUserId()) {
                $selectFields .= ',
    		        event_invite.invite_state AS event_invite_state';
                $joinTables .= '
    				LEFT JOIN xf_resource_event_invite_th AS event_invite ON
    					(event.event_id = event_invite.event_id
    					  AND event_invite.user_id = ' . XenForo_Visitor::getUserId() . ')';
            } else {
                $selectFields .= ',
    		       \'\' AS event_invite_state';
            }
        }

        return array(
            'selectFields' => $selectFields,
            'joinTables' => $joinTables,
            'orderClause' => $orderClause
        );
    }

    /**
     *
     * @see XenForo_Model_Thread::prepareThread()
     */
    public function getThreadById($threadId, array $fetchOptions = array())
    {
        $thread = parent::getThreadById($threadId, $fetchOptions);

        $viewingUser = XenForo_Visitor::getInstance();

        if (!empty($thread['event_invite_state'])) {
            switch ($thread['event_invite_state']) {
                case 'invited':
                    if ($viewingUser['invited_permission_combination_id_th']) {
                        XenForo_Visitor::getInstance()->setPermissionCombinationId(
                            $viewingUser['invited_permission_combination_id_th']);
                    }
                    break;
                case 'going':
                    if ($viewingUser['invited_permission_combination_id_th']) {
                        XenForo_Visitor::getInstance()->setPermissionCombinationId(
                            $viewingUser['going_permission_combination_id_th']);
                    }
                    break;
                case 'maybe':
                    if ($viewingUser['invited_permission_combination_id_th']) {
                        XenForo_Visitor::getInstance()->setPermissionCombinationId(
                            $viewingUser['maybe_permission_combination_id_th']);
                    }
                    break;
                case 'declined':
                default:
                    if ($viewingUser['invited_permission_combination_id_th']) {
                        XenForo_Visitor::getInstance()->setPermissionCombinationId(
                            $viewingUser['declined_permission_combination_id_th']);
                    }
            }
        }

        return $thread;
    }
}