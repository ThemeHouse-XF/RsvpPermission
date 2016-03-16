<?php

/**
 * Helper to render a list of user groups.
 */
class ThemeHouse_RsvpPermission_Option_UserGroupChooser
{

    public static function renderSelect(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
    {
        return self::_render('option_list_option_select', $view, $fieldPrefix, $preparedOption, $canEdit);
    }

    /**
     * Fetches a list of user group options.
     *
     * @param string|array $selectedGroupIds Array or comma delimited list
     *
     * @return array
     */
    public static function getUserGroupOptions($selectedGroup)
    {
        /* @var $userGroupModel XenForo_Model_UserGroup */
        $userGroupModel = XenForo_Model::create('XenForo_Model_UserGroup');

        $options = array_merge(array(
            0 => ''
        ), $userGroupModel->getUserGroupOptions($selectedGroup));

        return $options;
    }

    /**
     * Renders the user group chooser option.
     *
     * @param string Name of template to render
     * @param XenForo_View $view View object
     * @param string $fieldPrefix Prefix for the HTML form field name
     * @param array $preparedOption Prepared option info
     * @param boolean $canEdit True if an "edit" link should appear
     *
     * @return XenForo_Template_Abstract Template object
     */
    protected static function _render($templateName, XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
    {
        $preparedOption['formatParams'] = self::getUserGroupOptions($preparedOption['option_value']);

        return XenForo_ViewAdmin_Helper_Option::renderOptionTemplateInternal($templateName, $view, $fieldPrefix,
            $preparedOption, $canEdit);
    }
}