<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 11.06.15
 * Time: 15:11
 */
class Naumov_Sphinx_Model_Mysql4_Sphinx extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * init model resource class
     * @return Naumov_Sphinx_Model_Mysql4_Sphinx
     */
    protected function _construct()
    {
        $this->_init('sphinx/sphinx','entity_id');
        return $this;
    }

    /**
     * truncate index table
     * @return Naumov_Sphinx_Model_Mysql4_Sphinx
     */
    public function truncate() {
        $this->_getWriteAdapter()->query('TRUNCATE TABLE '.$this->getMainTable());
        return $this;
    }

}