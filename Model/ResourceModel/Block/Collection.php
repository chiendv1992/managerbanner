<?php
namespace Tigren\BannerManager\Model\ResourceModel\Block;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'block_id';

   
    protected function _construct()
    {
        $this->_init('Tigren\BannerManager\Model\Block', 'Tigren\BannerManager\Model\ResourceModel\Block');
      
    }    
      
}
