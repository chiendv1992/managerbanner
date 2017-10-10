<?php
/**
 *
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Tigren\BannerManager\Controller\Adminhtml\Block;

class NewAction extends \Magento\Backend\App\Action
{
    // dùng trong phân quyền
    const ADMIN_RESOURCE = 'Tigren_BannerManager::save';
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
        
        // chuyển hướng trang
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
