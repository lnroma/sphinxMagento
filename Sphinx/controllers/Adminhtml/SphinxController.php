<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 11.06.15
 * Time: 13:06
 */
class Naumov_Sphinx_Adminhtml_SphinxController extends Mage_Adminhtml_Controller_Action
{
    /**
     * index action
     */
    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('sphinx/sphinx');
        $this->_addContent(
            $this->getLayout()->createBlock('sphinx/adminhtml_sphinx')
        );
        $this->renderLayout();
    }

    /**
     * reindex aciton
     */
    public function reindexAction()
    {
        /** @var Naumov_Sphinx_Helper_Data $helper */
        $helper = Mage::helper('sphinx');
        $helper->reindexSphinxTable();
        Mage::getSingleton('core/session')->addSuccess('Index build success full');
        $this->_redirect('*/*/index');
    }

    /**
     * words form edit
     */
    public function wordsformAction()
    {
        $this->loadLayout()->_setActiveMenu('sphinx/sphinx');
        $this->_addContent(
            $this->getLayout()->createBlock('sphinx/adminhtml_form_edit')
        );
        $this->renderLayout();
    }

    /**
     * save wordsform
     */
    public function saveAction()
    {
        $pathToFile = Mage::getStoreConfig('sphinx/sphinx/wordsform_path');

        if (file_put_contents($pathToFile,Mage::app()->getRequest()->getPost('wordforms'))) {
           Mage::getSingleton('core/session')->addSuccess(Mage::helper('sphinx')->__('Word forms is save in file'));
        } else {
            Mage::getSingleton('core/session')->addError(Mage::helper('sphinx')->__('Error save file sphinx word forms'));
        }

        $this->_redirect('*/*/wordsform');
    }

    /**
     * reindex sphinx by php don't work because sphinx need root user
     */
    public function indexSphinxAction()
    {
        $output = shell_exec('indexer --all --rotate');
        Mage::getSingleton('core/session')->addSuccess(nl2br($output));
        $this->_redirect('*/*/index');
    }

}