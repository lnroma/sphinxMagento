<?php
/**
 * Created by PhpStorm.
 * User: naumov
 * Date: 26.09.14
 * Time: 9:45
 */
class Naumov_Sphinx_Helper_Data extends Mage_Core_Helper_Data
{
    /**
     * method for build search index table for sphinx
     * @param bool $shell
     * @return Naumov_Sphinx_Helper_Data
     */
    public function reindexSphinxTable($shell=false) {
        // incress memory for cron or shell
        ini_set('memory_limit','2048M');
        /** @var Naumov_Sphinx_Model_Mysql4_Sphinx $modelSphinx */
        $modelSphinx = Mage::getResourceModel('sphinx/sphinx');
        $modelSphinx->truncate();
        foreach ($this->_getProductReindexCollection() as $_product) {
             if ($shell) {
                 printf("index product %s \n",$_product->getId());
             }
             /** @var Naumov_Sphinx_Model_Sphinx $sphinxModel */
             $sphinxModel = Mage::getModel('sphinx/sphinx');
             try {
                 $sphinxModel
                     ->setProductId($_product->getId())
                     ->setNameIndex($_product->getName())
                     ->setDescriptionIndex($_product->getDescription());
                 $sphinxModel->save();
             } catch (Exception $error) {
                 if ($shell) {
                    printf("error: %s \n",$error->getMessage());
                 }
                 Mage::log($error->getMessage(),null,'sphinx.log');
             }
             if ($shell) {
                 printf("index product %s is success \n",$_product->getId());
             }
        }
        return $this;
    }

    /**
     * get all product collection for index
     * @return Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection
     */
    protected function _getProductReindexCollection()
    {
        /** @var Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection $collection */
        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection
            ->addAttributeToSelect(array(
                'name',
                'description'
            ))
            ->load();
        return $collection;
    }
}