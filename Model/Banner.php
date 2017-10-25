<?php

namespace Tigren\Bannermanager\Model;

use Magento\Framework\DataObject\IdentityInterface;

class Banner extends \Magento\Framework\Model\AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'banner_grid';
    
    protected $_cacheTag = 'banner_grid';

    protected $_eventPrefix = 'banner_grid';

    protected function _construct()
    {
        $this->_init('Tigren\Bannermanager\Model\ResourceModel\Banner');
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function getBlocks(\Tigren\Bannermanager\Model\Banner $object)
    {
        $tbl = $this->getResource()->getTable(\Tigren\Bannermanager\Model\ResourceModel\Banner::TIGREN_BANNERMANAGER_BLOCK);
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['block_id']
        )
        ;
        return $this->getResource()->getConnection()->fetchCol($select);
    }
}
