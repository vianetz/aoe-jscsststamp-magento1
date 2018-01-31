<?php

/**
 * In order to have timestamps etc. in the admin area as well, we extend from Aoe_JsCssTstamp_Block_Head instead of
 * Mage_Adminhtml_Block_Page_Head. By default, Mage_Adminhtml_Block_Page_Head extends from Mage_Page_Block_Html_Head
 * anyway.
 * This rewrite includes the methods from Mage_Adminhtml_Block_Page_Head only.
 */
class Aoe_JsCssTstamp_Block_Adminhtml_Page_Head extends Aoe_JsCssTstamp_Block_Head
{
    /**
     * Enter description here...
     *
     * @return string
     */
    protected function _getUrlModelClass()
    {
        return 'adminhtml/url';
    }

    /**
     * Retrieve Session Form Key
     *
     * @return string
     */
    public function getFormKey()
    {
        return Mage::getSingleton('core/session')->getFormKey();
    }
}
