<?php
namespace Tigren\BannerManager\Model;
use Magento\Framework\Model\AbstractModel;
class Block extends AbstractModel
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;  
    

    protected function _construct()
    {
        $this->_init('Tigren\BannerManager\Model\ResourceModel\Block');
    }
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

}
