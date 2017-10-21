<?php

namespace Tigren\Bannermanager\Model;

use Magento\Framework\DataObject\IdentityInterface;

class Block extends \Magento\Framework\Model\AbstractModel implements IdentityInterface
{

    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'bn_block_grid';

    /**
     * @var string
     */
    protected $_cacheTag = 'bn_block_grid';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'bn_block_grid';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tigren\Bannermanager\Model\ResourceModel\Block');
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getBlocks(\Tigren\Bannermanager\Model\Block $object)
    {
        $tbl = $this->getResource()->getTable(\Tigren\Bannermanager\Model\ResourceModel\Block::TBL_ATT_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['block_id']
        )
        ;
        return $this->getResource()->getConnection()->fetchCol($select);
    }
}
