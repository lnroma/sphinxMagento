<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 11.06.15
 * Time: 14:49
 */
class Naumov_Sphinx_Block_Adminhtml_Sphinx extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * construct
     */
    public function __construct()
    {
        $this->_blockGroup = 'sphinx';
        $this->_controller = 'adminhtml_sphinx';
        $this->_headerText = Mage::helper('sphinx')->__('Sphinx search index');
        parent::__construct();
        $this->_removeButton('add');

        $this->_addButton('reindex',array(
            'label' => Mage::helper('catalog')->__('Reindex'),
            'onclick'   =>  "setLocation('{$this->getUrl('*/*/reindex')}')",
            'class'     =>  'add'
        ));

        $this->_addButton('reindexSphinx',array(
            'label' => Mage::helper('catalog')->__('Reindex sphinx'),
            'onclick'   =>  "setLocation('{$this->getUrl('*/*/indexSphinx')}')",
            'class'     =>  'add'
        ));
    }

}