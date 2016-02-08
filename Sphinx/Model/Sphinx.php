<?php
/**
 * Created by PhpStorm.
 * User: naumov
 * Date: 26.09.14
 * Time: 9:50
 * @method Naumov_Sphinx_Model_Sphinx setProductId()
 * @method Naumov_Sphinx_Model_Sphinx setNameIndex()
 * @method Naumov_Sphinx_Model_Sphinx setDescriptionIndex()
 */
class Naumov_Sphinx_Model_Sphinx extends Mage_Core_Model_Abstract
{
    /**
     * init sphinx resource
     */
    public function _construct()
    {
        parent::_init('sphinx/sphinx');
    }

    /**
     * search product by sphinx
     * @param $query
     * @param string $result_type
     * @return array|string
     */
    public function searchProduct($query, $result_type = 'array')
    {
        $sphinx = new Naumov_Sphinx_Model_Api_Sphinx();
        $sphinx->SphinxClient();
        $sphinx->SetServer(Mage::getStoreConfig('sphinx/sphinx/host'), Mage::getStoreConfig('sphinx/sphinx/port'));
        $sphinx->SetMatchMode(SPH_MATCH_ANY);
        $sphinx->SetSortMode(SPH_SORT_RELEVANCE);
        $sphinx->SetLimits(0,1500);
        $sphinx->SetFieldWeights(array('name_index' => 30, 'subtitle_index' => 20, 'desc_index' => 10));
        $sphinx->AddQuery($query);

        $mathes = $sphinx->RunQueries();

        $result_tmp = array();
        if (empty($mathes[0]['error'])) {
	    if(is_array($mathes[0]['matches'])) {
	            foreach ($mathes[0]['matches'] as $result) {
        	        $result_tmp[] = $result['attrs']['product_id'];
	            }
	    }
        }

        $result_tmp_string = implode(',', $result_tmp);

        if ($result_type == 'array') {
            return $result_tmp;
        } else {
            return $result_tmp_string;
        }
    }

}
