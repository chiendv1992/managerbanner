<?php
namespace Tigren\BannerManager\Controller\Adminhtml\Block;

class NewAction extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Tigren_BannerManager::block_create';
  
    protected $resultForwardFactory;

    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
