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
    // load store view cho block
    protected function _afterLoad(AbstractModel $object)
    {
        $block_store=$this->getConnection()
            ->select()
            ->from($this->getMainTable('block_store'),['block_id'])
            ->where('block_id'.' = :block_id');
        $stores=$this->getConnection()->fetchCol($block_store,[':block_id'=>$object->getID()]);
        if($stores)
        {
            $object->setData('stores',$stores);
        }
        return parent::_afterLoad($object);
    }
    // lấy lại id của block
    public function getCmsPageIdentifierById($id)
    {
        $connection = $this->getConnection();
        $entityMetadata = $this->metadataPool->getMetadata(PageInterface::class);

        $select = $connection->select()
            ->from($this->getMainTable(), 'identifier')
            ->where($entityMetadata->getIdentifierField() . ' = :block_id');

        return $connection->fetchOne($select, ['block_id' => (int)$id]);
    }

// get id store
    public function lookupStoreIds($pageId)
    {
        $connection = $this->getConnection();

        $entityMetadata = $this->metadataPool->getMetadata(PageInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $select = $connection->select()
            ->from(['managerblocks' => $this->getTable('block_store')], 'store_id')
            ->join(
                ['managerblock' => $this->getMainTable()],
                'managerblocks.' . $linkField . ' = managerblock.' . $linkField,
                []
            )
            ->where('managerblock.' . $entityMetadata->getIdentifierField() . ' = :block_id');

        return $connection->fetchCol($select, ['block_id' => (int)$pageId]);
    }
}
