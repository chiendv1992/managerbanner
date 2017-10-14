<?php
namespace Tigren\BannerManager\Controller\Adminhtml\Block;

use Magento\Backend\App\Action;
use Tigren\BannerManager\Model\Block;
use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends \Magento\Backend\App\Action
{
   
    const ADMIN_RESOURCE = 'Tigren_BannerManager::save';

    protected $dataProcessor;

    protected $dataPersistor;

    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor        
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Block::STATUS_ENABLED;
            }
            if (empty($data['block_id'])) {
                $data['block_id'] = null;
            }
            // xly ảnh
            if (empty($data['images'])) {
                $data['images'] = null;
            } else {
                if ($data['images'][0] && $data['images'][0]['name'])
                    $data['image'] = $data['images'][0]['name'];
                else
                    $data['image'] = null;
            }

            $model = $this->_objectManager->create('Tigren\BannerManager\Model\Block');
            // lấy dc data đăng
            $id = $this->getRequest()->getParam('block_id');
            if ($id) {
                $model->load($id);
            }
           
            // Validate data (dl đưa ra form)
            if (!$this->dataProcessor->validateRequireEntry($data)) {
                return $resultRedirect->setPath('*/*/edit', ['block_id' => $model->getId(), '_current' => true]);
            }
            // Update model
            $model->setData($data);
            // lưu dữ liệu vào database
            try 
            {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the block.'));
                $this->dataPersistor->clear('manager_block');
                if ($this->getRequest()->getParam('back')) 
                {
                    return $resultRedirect->setPath('*/*/edit', ['block_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } 
            catch (\Exception $e) 
            {
                $this->messageManager->addException($e, __('Something went wrong while saving the block.'));
            }

            $this->dataPersistor->set('manager_block', $data);
            return $resultRedirect->setPath('*/*/edit', ['block_id' => $this->getRequest()->getParam('block_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
