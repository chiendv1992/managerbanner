<?php

namespace Tigren\BannerManager\Controller\Adminhtml\Block;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Tigren_BannerManager::block_delete';
    
    public function execute()
    {
        $id = $this->getRequest()->getParam('block_id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) { 
            try {
                // Init model and delete
                $model = $this->_objectManager->create('Tigren\BannerManager\Model\Block');
                $model->load($id);
                $id = $model->getId();
                $model->delete();

                // Display success message
                $this->messageManager->addSuccess(__('The block has been deleted.'));

                // Redirect to list page
                return $resultRedirect->setPath('bannermanager/*/index');
            } catch (\Exception $e) {
                // Display error message
                $this->messageManager->addError($e->getMessage());
                // Go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['block_id' => $id]);
            }
        }
 
        // Display error message
        $this->messageManager->addError(__('We can\'t find a block to delete.'));

        // Redirect to list page
        return $resultRedirect->setPath('bannermanager/*/index');
    }
}
