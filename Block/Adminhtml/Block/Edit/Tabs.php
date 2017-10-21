<?php
 
namespace Tigren\BannerManager\Block\Adminhtml\Block\Edit;
 
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
 // <!-- sẽ khai báo các tab ở cột bên trái của trang chỉnh sửa -->

class Tabs extends WidgetTabs
{
  
    protected function _construct()
    {
        parent::_construct();
        $this->setId('block_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Block'));
    }
 
    protected function _beforeToHtml()
    {
        // theem tab Block infomation
        $this->addTab(
            'block_info',
            [
                'label' => __('Block Information'),
                'title' => __('Block Information'),
                'content' => $this->getLayout()->createBlock(
                    'Tigren\BannerManager\Block\Adminhtml\Block\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );
        //  thêm tab slect banner
        $this->addTab(
            'block_main',
            [
                'label' => __('Select Banner'),
                'title' => __('Select Banner'),
                'content' => $this->getLayout()->createBlock(
                    'Tigren\BannerManager\Block\Adminhtml\Block\Edit\Tab\Main'
                )->toHtml(),
                'active' => false
            ]
        );
 
        return parent::_beforeToHtml();
    }
}