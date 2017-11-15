<?php

namespace Tigren\BannerManager\Controller\Adminhtml\Blocks;

use Magento\Backend\App\Action;
use Magento\TestFramework\ErrorLog\Logger;

class Blocks extends \Magento\Backend\App\Action
{

    protected $_resultLayoutFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
    ) {
        parent::__construct($context);
        $this->_resultLayoutFactory = $resultLayoutFactory;
    }

    protected function _isAllowed()
    {
        return true;
    }

    public function execute()
    {
        $resultLayout = $this->_resultLayoutFactory->create();
        $resultLayout->getLayout()->getBlock('tigrenbannermanager.edit.blocks')
                     ->setInBlocks($this->getRequest()->getPost('manager_block', null));

        return $resultLayout;
    }
}
