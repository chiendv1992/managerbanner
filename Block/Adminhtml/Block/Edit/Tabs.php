<?php
namespace Tigren\BannerManager\Block\Adminhtml\Block\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    
    protected function _construct()
    {
        parent::_construct();
        $this->setId('block_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Block Information'));
    }

    protected function _beforeToHtml()
    {
        $this->setActiveTab('block_info');
        return parent::_beforeToHtml();
    }

    protected function _prepareLayout()
    {
        $this->addTab(
            'block_info',
            [
                'label' => __('Block Information'),
                'content' => $this->getLayout()->createBlock('Tigren\BannerManager\Block\Adminhtml\Block\Edit\Tab\Info')->toHtml()
            ]
        );

        $this->addTab(
            'select_banner',
            [
                'label' => __('Select Banner'),
                'content' => $this->getLayout()->createBlock('Tigren\BannerManager\Block\Adminhtml\Block\Edit\Tab\Bannerselect')->toHtml()
            ]
        );

        
        return parent::_prepareLayout();
    }
}
