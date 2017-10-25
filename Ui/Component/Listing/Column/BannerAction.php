<?php
namespace Tigren\BannerManager\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
class BannerAction extends Column
{
    const MANAGER_BANNER_URL_PATH_EDIT = 'bannermanager/banner/edit';
    const MANAGER_BANNER_URL_PATH_DELETE = 'bannermanager/banner/delete';
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
                if (isset($item['banner_id'])) {                   
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::MANAGER_BANNER_URL_PATH_EDIT,
                                [
                                    'banner_id' => $item['banner_id']
                                ]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::MANAGER_BANNER_URL_PATH_DELETE,
                                [
                                    'banner_id' => $item['banner_id']
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
