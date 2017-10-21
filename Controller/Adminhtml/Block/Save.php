<?php
 
namespace Tigren\BannerManager\Controller\Adminhtml\Block;
 
use Tigren\BannerManager\Controller\Adminhtml\Block;
 
class Save extends Block
{
   /**
     * @return void
     */
   public function execute()
   {
      $isPost = $this->getRequest()->getPost();
 
      if ($isPost) {
         $newsModel = $this->_newsFactory->create();
         $blockId = $this->getRequest()->getParam('block_id');
 
         if ($blockId) {
            $newsModel->load($blockId);
         }
         $formData = $this->getRequest()->getParam('block');
         $newsModel->setData($formData);
         
         try {
            // Save news
            $newsModel->save();
 
            // Display success message
            $this->messageManager->addSuccess(__('The block has been saved.'));
 
            // Check if 'Save and Continue'
            if ($this->getRequest()->getParam('back')) {
               $this->_redirect('*/*/edit', ['block_id' => $newsModel->getId(), '_current' => true]);
               return;
            }
 
            // Go to grid page
            $this->_redirect('*/*/');
            return;
         } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
         }
 
         $this->_getSession()->setFormData($formData);
         $this->_redirect('*/*/edit', ['block_id' => $blockId]);
      }
   }
}