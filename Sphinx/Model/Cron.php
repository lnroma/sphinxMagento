<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 24.06.15
 * Time: 15:11
 */
class Naumov_Sphinx_Model_Cron
{
    /**
     * run reindex by cron
     * @return null
     */
    static public function runReindex()
    {
        $helper = Mage::helper('sphinx');
        $helper->reindexSphinxTable();
        return null;
    }

}