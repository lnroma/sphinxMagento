<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.06.15
 * Time: 15:38
 */
class Naumov_Sphinx_Block_Adminhtml_Form_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * construct
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'sphinx';
        $this->_controller = 'adminhtml_form';
        $this->_mode = 'edit';
        $this->_updateButton('save','label',Mage::helper('sphinx')->__('Save'));
    }

    /**
     * get header text for form container
     * @return string
     */
    public function getHeaderText()
    {
        return Mage::helper('sphinx')->__('Edit words form container');
    }
}