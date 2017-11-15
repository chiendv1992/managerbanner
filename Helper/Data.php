<?php
namespace Tigren\BannerManager\Helper;
 
use Magento\Customer\Model\Session as CustomerSession;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
     protected $_categoryCollectionFactory;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
    )
    {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        parent::__construct($context);

    }
    // Display Type 
     public function getDisplayTypeOptions()
    {
        return [
            ['label' => '-- Select Type --', 'value' => ''],
            ['label' => __('All Images'), 'value' => 1],
            ['label' => __('Random'), 'value' => 2],
            ['label' => __('Slider'), 'value' => 3],
            ['label' => __('Slider with Description'), 'value' => 4],
            ['label' => __('Basic Slider with Custom Direction Navigation'), 'value' => 5],
            ['label' => __('Slider with Min and Max Ranges'), 'value' => 6],
            ['label' => __('Basic Carousel'), 'value' => 7],
            ['label' => __('Fade'), 'value' => 8],
            ['label' => __('Fade with Description'), 'value' => 9],
        ];
    }
    // positions
    public function getPositionOptions()
    {
        return [
            [
                'label' => __('------- Please choose position -------'),
                'value' => '',
            ],
            [
                'label' => __('Popular positions'),
                'value' => [
                    ['value' => 'cms-page-content-top', 'label' => __('Homepage-Content-Top')],
                ],
            ],
            [
                'label' => __('Default for using in CMS page template'),
                'value' => [
                    ['value' => 'custom', 'label' => __('Custom')],
                ],
            ],
            [
                'label' => __('General (will be disaplyed on all pages)'),
                'value' => [
                    ['value' => 'sidebar-main-top', 'label' => __('Sidebar-Main-Top')],
                    ['value' => 'sidebar-main-bottom', 'label' => __('Sidebar-Main-Bottom')],
                    ['value' => 'sidebar-additional-top', 'label' => __('Sidebar-Additional-Top')],
                    ['value' => 'sidebar-additional-bottom', 'label' => __('Sidebar-Additional-Bottom')],
                    ['value' => 'content-top', 'label' => __('Content-Top')],
                    ['value' => 'menu-top', 'label' => __('Menu-Top')],
                    ['value' => 'menu-bottom', 'label' => __('Menu-Bottom')],
                    ['value' => 'page-bottom', 'label' => __('Page-Bottom')],
                ],
            ],
            [
                'label' => __('Catalog and product'),
                'value' => [
                    ['value' => 'catalog-sidebar-main-top', 'label' => __('Catalog-Sidebar-Main-Top')],
                    ['value' => 'catalog-sidebar-main-bottom', 'label' => __('Catalog-Sidebar-Main-Bottom')],
                    ['value' => 'catalog-sidebar-additional-top', 'label' => __('Catalog-Sidebar-Additional-Top')],
                    ['value' => 'catalog-sidebar-additional-bottom', 'label' => __('Catalog-Sidebar-Additional-Bottom')],
                    ['value' => 'catalog-content-top', 'label' => __('Catalog-Content-Top')],
                    ['value' => 'catalog-menu-top', 'label' => __('Catalog-Menu-Top')],
                    ['value' => 'catalog-menu-bottom', 'label' => __('Catalog-Menu-Bottom')],
                    ['value' => 'catalog-page-bottom', 'label' => __('Catalog-Page-Bottom')],
                ],
            ],
            [
                'label' => __('Category only'),
                'value' => [
                    ['value' => 'category-sidebar-main-top', 'label' => __('Category-Sidebar-Main-Top')],
                    ['value' => 'category-sidebar-main-bottom', 'label' => __('Category-Sidebar-Main-Bottom')],
                    ['value' => 'category-sidebar-additional-top', 'label' => __('Category-Sidebar-Additional-Top')],
                    ['value' => 'category-sidebar-additional-bottom', 'label' => __('Category-Sidebar-Additional-Bottom')],
                    ['value' => 'category-content-top', 'label' => __('Category-Content-Top')],
                    ['value' => 'category-menu-top', 'label' => __('Category-Menu-Top')],
                    ['value' => 'category-menu-bottom', 'label' => __('Category-Menu-Bottom')],
                    ['value' => 'category-page-bottom', 'label' => __('Category-Page-Bottom')],
                ],
            ],
            [
                'label' => __('Product only'),
                'value' => [
                    ['value' => 'product-sidebar-main-top', 'label' => __('Product-Sidebar-Main-Top')],
                    ['value' => 'product-sidebar-main-bottom', 'label' => __('Product-Sidebar-Main-Bottom')],
                    ['value' => 'product-sidebar-additional-top', 'label' => __('Product-Sidebar-Additional-Top')],
                    ['value' => 'product-sidebar-additional-bottom', 'label' => __('Product-Sidebar-Additional-Bottom')],
                    ['value' => 'product-content-top', 'label' => __('Product-Content-Top')],
                    ['value' => 'product-menu-top', 'label' => __('Product-Menu-Top')],
                    ['value' => 'product-menu-bottom', 'label' => __('Product-Menu-Bottom')],
                    ['value' => 'product-page-bottom', 'label' => __('Product-Page-Bottom')],
                ],
            ],
            [
                'label' => __('Customer'),
                'value' => [
                    ['value' => 'customer-content-top', 'label' => __('Customer-Content-Top')],
                    ['value' => 'customer-sidebar-main-top', 'label' => __('Customer-Siderbar-Main-Top')],
                    ['value' => 'customer-sidebar-main-bottom', 'label' => __('Customer-Siderbar-Main-Bottom')],
                    ['value' => 'customer-sidebar-additional-top', 'label' => __('Customer-Siderbar-Additional-Top')],
                    ['value' => 'customer-sidebar-additional-bottom', 'label' => __('Customer-Siderbar-Additional-Bottom')],
                ],
            ],
            [
                'label' => __('Cart & Checkout'),
                'value' => [
                    ['value' => 'cart-content-top', 'label' => __('Cart-Content-Top')],
                    ['value' => 'checkout-content-top', 'label' => __('Checkout-Content-Top')],
                ],
            ],
        ];
    }
    // Tagert 
    //  public function getTargetOptions()
    // {
    //     return [
    //         ['value' => 0, 'label' => __('Open in the same window')],
    //         ['value' => 1, 'label' => __('Open in new window')]
    //     ];
    // }

    public function getCategoryOptions()
    {
        $categoriesArray = $this->_categoryCollectionFactory->create()
            ->addAttributeToSelect('name')
            ->addAttributeToSort('path', 'asc')
            ->load()
            ->toArray();

        $categories = array();
        foreach ($categoriesArray as $categoryId => $category) {
            if (isset($category['name']) && isset($category['level'])) {
                $categories[] = array(
                    'label' => $category['name'],
                    'level' => $category['level'],
                    'value' => $categoryId,
                );
            }
        }

        return $categories;
    }
    public function getBlocksGridUrl()
    {
        return $this->_backendUrl->getUrl('tigren/bannermanager/blocks', ['_current' => true]);
    }
}