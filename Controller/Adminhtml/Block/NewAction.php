<?php
namespace Tigren\BannerManager\Controller\Adminhtml\Block;

class NewAction extends \Magento\Backend\App\Action
{
    // dùng trong phân quyền
    // const ADMIN_RESOURCE = 'Tigren_BannerManager::save';
    protected $resultForwardFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }
     protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tigren_BannerManager::save');
    }
    public function execute()
    {
        // chuyển hướng trang
        
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }

}
