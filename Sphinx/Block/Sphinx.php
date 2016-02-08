<?php
/**
 * Created by PhpStorm.
 * User: naumov
 * Date: 26.09.14
 * Time: 13:45
 * @method Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection getResultCollection()
 */
class Naumov_Sphinx_Block_Sphinx extends Mage_CatalogSearch_Block_Result {

    /**
     * get search result
     * @return Mage_Catalog_Mysql4_Product_Collection
     */
    public function getProductCollection(){
        return $this->getCollection();
    }

    /**
     * prepare product collection
     * @param $condition
     * @return Mage_CatalogSearch_Model_Resource_Fulltext_Collection
     */
    protected function _prepareProductCollection($condition){
        /** @var Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection $productCollection */
        $productCollection = Mage::getModel('catalog/product')->getCollection();
        $attributeForSelect = Mage::getSingleton('catalog/config')->getProductAttributes();
        /** @var Mage_Core_Controller_Request_Http $request */
        $request = Mage::app()->getRequest();

        $limit = $request->getParam('limit',12);
        $page = $request->getParam('p',1);

        $productCollection
            ->addAttributeToSelect($attributeForSelect)
            ->setStore(Mage::app()->getStore())
            ->addAttributeToFilter('status',Mage_Catalog_Model_Product_Status::STATUS_ENABLED)
            ->addFieldToFilter('entity_id', array(
                array('in' => $condition))
            )
            ->joinField('stock_status_sort','cataloginventory/stock_status','stock_status','product_id=entity_id',
                array(
                    'website_id' => Mage::app()->getWebsite()->getWebsiteId(),
                )
            )
            ->setPage($page,$limit);

        // adding sort for search result product collection
        $productCollection = $this->_addSortToCollection($productCollection);
        // load collection
        $productCollection->load();

        return $productCollection;
    }

    /**
     * getter for collection
     * @return Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection
     */
    public function getCollection() {
        if(is_null($this->getResultCollection())) {

            $condition = Mage::getModel('sphinx/sphinx')
                ->searchProduct(
                    Mage::app()->getRequest()->getParam('q'),'1'
                );

            $this->setResultCollection(
                $this->_prepareProductCollection($condition)
            );
        } else {
            return $this->getResultCollection();
        }
    }

    /**
     * add sort to result collection
     * @param Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection $collection
     * @return Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection
     */
    protected function _addSortToCollection( Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection $collection ) {
        $orderBy = Mage::app()->getRequest()->getParam('order',null);
        $orderDir = Mage::app()->getRequest()->getParam('dir',null);

        if( is_null($orderBy) ) {
            return $collection;
        }

        if( is_null($orderDir) ) {
            $orderDir = $collection::SORT_ORDER_DESC;
        } elseif ( $orderDir == 'desc' ) {
            $orderDir = $collection::SORT_ORDER_DESC;
        } elseif ( $orderDir == 'asc') {
            $orderDir = $collection::SORT_ORDER_ASC;
        }
        $collection->setOrder($orderBy,$orderDir);
        return $collection;
    }

}