<?php
namespace Tigren\BannerManager\Controller\Adminhtml\Block;

use Magento\Backend\App\Action;
use Tigren\BannerManager\Model\Block;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
   
    const ADMIN_RESOURCE = 'Tigren_BannerManager::save';

    protected $dataProcessor;

    protected $dataPersistor;

    private $pageFactory;

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
            if (empty($data['image'])) {
                $data['image'] = null;
            } else {
                if ($data['image'][0] && $data['image'][0]['name'])
                    $data['images'] = $data['image'][0]['name'];
                else
                    $data['images'] = null;
            }

            $model = $this->pageFactory->create();

            $id = $this->getRequest()->getParam('block_id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            if (!$this->dataProcessor->validate($data)) {
                return $resultRedirect->setPath('*/*/edit', ['block_id' => $model->getId(), '_current' => true]);
            }

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the block.'));
                $this->dataPersistor->clear('manager_block');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['block_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the block.'));
            }

            $this->dataPersistor->set('manager_block', $data);
            return $resultRedirect->setPath('*/*/edit', ['block_id' => $this->getRequest()->getParam('block_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
