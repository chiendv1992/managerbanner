<?php
namespace Tigren\BannerManager\Controller\Adminhtml\Block;
use Magento\Backend\App\Action;
class Edit extends Action
{
    // hành động chỉnh sửa trang
   
    protected $_coreRegistry;
    protected $resultPageFactory;
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }
    // load layout và 
    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Tigren_BannerManager::manager_block');
        return $resultPage;
    }
    public function execute()
    {
        
        // 1. lấy ID và tạo model 
        $block_id = $this->getRequest()->getParam('block_id');
        $model = $this->_objectManager->create('Tigren\BannerManager\Model\Block');
        // 2. Initial checking
        if ($block_id) {
            $model->load($block_id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This block no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('manager_block', $model);
       
        $resultPage = $this->resultPageFactory->create();
        $this->_initAction($resultPage)->addBreadcrumb(
            $block_id ? __('Edit Block') : __('New Block'),
            $block_id ? __('Edit Block') : __('New Block')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Blocks'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Block'));
        return $resultPage;
    }
}
