<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Tigren\BannerManager\Model;
use Magento\Framework\Model\AbstractModel;
class Block extends AbstractModel
{
    const CACHE_TAG = 'manager_block';   
    protected $_eventPrefix = 'manager_block';

    protected function _construct()
    {
        $this->_init('Tigren\BannerManager\Model\ResourceModel\Block');
    }

}
