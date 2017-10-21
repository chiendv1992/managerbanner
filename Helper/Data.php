<?php
namespace Tigren\BannerManager\Helper;
 
use Magento\Customer\Model\Session as CustomerSession;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    )
    {
        parent::__construct($context);

    }
 
    public function getOptionArray()
    {
        return [
            [
                'label' => __('------- Please choose option -------'),
                'value' => '',
            ],
            [
                'label' => __('Block Position'),
                'value' => [
                    ['value' => '1', 'label' => __('Option 1')],
                    ['value' => '2', 'label' => __('Option 2')],
                    ['value' => '3', 'label' => __('Option 3')],
                    ['value' => '4', 'label' => __('Option 4')],
                    ['value' => '5', 'label' => __('Option 5')],
                ],
            ],
        ];
    }
 
}