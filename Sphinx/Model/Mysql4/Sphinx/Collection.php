<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 11.06.15
 * Time: 15:11
 * @method int getId()
 * @method Naumov_Sphinx_Model_Mysql4_Sphinx_Collection setId()
 * @method string | null getNameIndex()
 * @method Naumov_Sphinx_Model_Mysql4_Sphinx_Collection setNameIndex()
 * @method string | null getDescriptionIndex()
 * @method Naumov_Sphinx_Model_Mysql4_Sphinx_Collection setDescriptionIndex()
 */
class Naumov_Sphinx_Model_Mysql4_Sphinx_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * init model
     * @return Naumov_Sphinx_Model_Mysql4_Sphinx_Collection
     */
    protected function _construct()
    {
        $this->_init('sphinx/sphinx');
        return $this;
    }
}