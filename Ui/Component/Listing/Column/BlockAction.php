<?php
namespace Tigren\BannerManager\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\UrlInterface;
class BlockAction extends \Magento\Ui\Component\Listing\Columns\Column
{
    const MANAGER_BLOCK_URL_PATH_EDIT = 'bannermanager/block/edit';
    const MANAGER_BLOCK_URL_PATH_DELETE = 'bannermanager/block/delete';
    protected $urlBuilder;
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['block_id'])) {                   
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::MANAGER_BLOCK_URL_PATH_EDIT,
                                [
                                    'block_id' => $item['block_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::MANAGER_BLOCK_URL_PATH_DELETE,
                                [
                                    'block_id' => $item['block_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'message' => __('Are you sure you want to delete a  record?'),
                            ],
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }

}
