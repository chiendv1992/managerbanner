<?php
namespace Tigren\BannerManager\Model\ResourceModel\Block;
 
class CollectionFactory
{
    protected $_objectManager = null;
 
    protected $_instanceName  = null;
 
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName  = '\Tigren\BannerManager\Model\ResourceModel\Block\Collection')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName  = $instanceName ;
    }
 
    public function create(array $data = array())
    {
        return $this->_objectManager->create($this->_instanceName , $data);
    }
}