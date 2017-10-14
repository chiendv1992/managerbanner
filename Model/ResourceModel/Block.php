<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
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
        $this->_init('manager_block', 'block_id');
    }

    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        // Get image data before and after save
        $oldImage = $object->getOrigData('image');
        $newImage = $object->getData('image');

        // Check when new image uploaded
        if ($newImage != null && $newImage != $oldImage) {
            $imageUploader = \Magento\Framework\App\ObjectManager::getInstance()
                ->get('Tigren\BannerManager\BannerBlockImageUpload');
            $imageUploader->moveFileFromTmp($newImage);
        }

        return $this;
    }
}
