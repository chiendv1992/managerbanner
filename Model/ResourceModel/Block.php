<?php
namespace Tigren\BannerManager\Model\ResourceModel;

use Tigren\BannerManager\Api\Data\BlockInterface;
use Magento\Framework\DB\Select;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Block extends AbstractDb
{
    protected function _construct()
    {
        // Table name + primary key column
        $this->_init('manager_block','block_id');
    }
    protected function _afterLoad(AbstractModel $object)
    {
        $block_store = $this->getConnection()
            ->select()
            ->from($this->getTable('block_store'), ['store_id'])
            ->where('block_id = :block_id');

        $stores = $this->getConnection()->fetchCol($block_store, [':block_id' => $object->getId()]);

        if ($stores) {
            $object->setData('stores', $stores);
        }

        return parent::_afterLoad($object);
    }
}
