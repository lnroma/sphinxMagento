<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 18.06.15
 * Time: 15:45
 */
class Naumov_Sphinx_Block_Adminhtml_Form_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare form for edit wordforms
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form( array(
                'id'    =>  'edit_form',
                'method' => 'post',
                'action' => $this->getUrl('*/*/save')
            )
        );

        $fieldset = $form->addFieldset('form_form',array(
            'legend' => Mage::helper('sphinx')->__('Edit wordforms for sphinx'),
        ));

        $wordforms = $this->_getValueForWordforms();

        if(!$wordforms) {
            echo Mage::helper('sphinx')->__("No such file or directory, please settings path to file in system -> configuration -> sphinx search -> wordforms path");
            return false;
        }


        $fieldset->addField('wordforms','textarea',array(
            'label'  =>  Mage::helper('sphinx')->__('Wordforms'),
            'value' =>  $wordforms,
            'name'   => 'wordforms',
        ));

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * get content file puth
     * @return string
     */
    protected function _getValueForWordforms()
    {
        $pathToFile = Mage::getStoreConfig('sphinx/sphinx/wordsform_path');
        return file_get_contents($pathToFile);
    }

}