<?php
 
namespace Tigren\BannerManager\Controller\Adminhtml\Block;
 
use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;
 
class Save extends \Magento\Backend\App\Action
{
   
    protected $cacheTypeList;
 
    
 
    public function __construct(
        Action\Context $context,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
    )
    {
        $this->cacheTypeList = $cacheTypeList;
        parent::__construct($context);
       
    }
 
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tigren_BannerManager::save');
    }
 
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();      
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
           
            $model = $this->_objectManager->create('Tigren\BannerManager\Model\Block');
 
            $block_id = $this->getRequest()->getParam('block_id');
            if ($block_id) {
                $model->load($block_id);
            }
 
            $model->setData($data);
 
            // $this->_eventManager->dispatch(
            //     'manager_block',
            //     ['block' => $model, 'request' => $this->getRequest()]
            // );

            try {
                $model->save();

                // $this->cacheTypeList->invalidate('full_page');
                $this->messageManager->addSuccess(__('You saved this Block.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['block_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Block.'));
            }
 
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit',['block_id' => $this->getRequest()->getParam('block_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}