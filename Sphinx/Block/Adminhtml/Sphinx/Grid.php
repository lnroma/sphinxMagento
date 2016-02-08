<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 11.06.15
 * Time: 14:48
 */
class Naumov_Sphinx_Block_Adminhtml_Sphinx_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('sphinx_grid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * prepare collection for grid
     * @return this
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('sphinx/sphinx_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid columns
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn('entity_id',array(
            'header' => Mage::helper('sphinx')->__('Id'),
            'index'  => 'entity_id'
        ));

        $this->addColumn('name_index',array(
            'header' => Mage::helper('sphinx')->__('Name index'),
            'index'  => 'name_index'
        ));

        $this->addColumn('description_index',array(
            'header' => Mage::helper('sphinx')->__('Description index'),
            'index'  => 'description_index'
        ));

        return parent::_prepareColumns();
    }

}