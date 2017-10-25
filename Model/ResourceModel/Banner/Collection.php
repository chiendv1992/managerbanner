<?php
namespace Tigren\BannerManager\Model\ResourceModel\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'banner_id';

   
    protected function _construct()
    {
        $this->_init('Tigren\BannerManager\Model\Banner', 'Tigren\BannerManager\Model\ResourceModel\Banner');
      
    }    
      
}
