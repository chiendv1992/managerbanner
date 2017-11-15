<?php
namespace Tigren\BannerManager\Controller\Adminhtml\Block;
use Magento\Backend\App\Action;
class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Tigren_BannerManager::block_edit';

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
    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Tigren_BannerManager::block');
        return $resultPage;
    }
    public function execute()
    {
        // lấy ID and tạo model
        $id = $this->getRequest()->getParam('block_id');
        $model = $this->_objectManager->create('Tigren\BannerManager\Model\Block');
        $model->setData([]);
        // Initial checking
        if ($id && (int) $id > 0) {
            $model->load($id);
            if (!$model->getBlockId()) {
                $this->messageManager->addError(__('This Block no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
            $title = $model->getTitle();
        }

        $FormData = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);

        if (!empty($FormData)) {
            $model->setData($FormData);
        }
        $this->_coreRegistry->register('manager_block', $model);
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Block') : __('New Block'),
            $id ? __('Edit Block') : __('New Block')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Manager Block'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('New Block'));

        return $resultPage;
    }
}
