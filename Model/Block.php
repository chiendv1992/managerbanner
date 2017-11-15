<?php

namespace Tigren\Bannermanager\Model;

class Block extends \Magento\Framework\Model\AbstractModel 
{
    const CACHE_TAG = 'manager_block';

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    
    protected $_cacheTag = 'manager_block';

    protected $_eventPrefix = 'manager_block';

    protected function _construct()
    {
        $this->_init('Tigren\Bannermanager\Model\ResourceModel\Block');
    }

}