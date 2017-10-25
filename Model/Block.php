<?php

namespace Tigren\Bannermanager\Model;

use Magento\Framework\DataObject\IdentityInterface;

class Block extends \Magento\Framework\Model\AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'manager_block';
    
    protected $_cacheTag = 'manager_block';

    protected $_eventPrefix = 'manager_block';

    protected function _construct()
    {
        $this->_init('Tigren\Bannermanager\Model\ResourceModel\Block');
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function getBlocks(\Tigren\Bannermanager\Model\Block $object)
    {
        $tbl = $this->getResource()->getTable(\Tigren\Bannermanager\Model\ResourceModel\Block::TIGREN_BANNERMANAGER_BLOCK);
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['block_id']
        )
        ;
        return $this->getResource()->getConnection()->fetchCol($select);
    }
}
