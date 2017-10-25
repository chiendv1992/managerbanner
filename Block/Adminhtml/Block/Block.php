<?php

namespace Tigren\BannerManager\Block\Adminhtml;

class Block extends \Magento\Backend\Block\Widget\Grid\Container
{
    
    protected function _construct()
    {
        parent::__construct($context, $data);
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
