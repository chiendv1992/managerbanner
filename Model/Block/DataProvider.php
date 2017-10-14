<?php
namespace Tigren\BannerManager\Model\Block;

use Tigren\BannerManager\Model\ResourceModel\Block\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    
    protected $collection;
    protected $dataPersistor;
    protected $loadedData;
    protected $storeManager;
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $pageCollectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $pageCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

       foreach ($items as $block) {
            $data = $block->getData();

            $image = $data['image'];
            if ($image && is_string($image)) {
                $data['images'][0]['name'] = $image;
                // get store cung  cấp một đối tượng (đưa ra đường dẫn chứa ảnh) 
                $data['images'][0]['url'] = $this->storeManager->getStore()
                        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)
                    .'bannermanager/images/' . $image;
            }

            $this->loadedData[$block->getId()] = $data;
        }
        $data = $this->dataPersistor->get('manager_block');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('manager_block');
        }

        return $this->loadedData;
    }
}
