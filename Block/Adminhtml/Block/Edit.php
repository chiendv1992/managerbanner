<?php
 
// <!-- tạo tập tin block của container form -->

namespace Tigren\BannerManager\Block\Adminhtml\Block;
 
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
 
class Edit extends Container
{
    protected $_coreRegistry = null;
 
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
 
    protected function _construct()
    {
    	// tạo các button
        // khởi tạo nguồn chỉnh sửa
        $this->_objectId = 'block_id';
        $this->_controller = 'adminhtml_block';
        $this->_blockGroup = 'Tigren_BannerManager';
 
        parent::_construct();
 
        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete'));
    }
     // truy xuất cho title
    public function getHeaderText()
    {
        $blockRegistry = $this->_coreRegistry->registry('manager_block');
        if ($blockRegistry->getId()) {
            $blockTitle = $this->escapeHtml($blockRegistry->getTitle());
            return __("Edit Block '%1'", $blockTitle);
        } else {
            return __('Add Block');
        }
    }
 
   // cb layout
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('post_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'post_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'post_content');
                }
            };
        ";
 
        return parent::_prepareLayout();
    }
    // ktra hanh đ
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    // tao url cho nút saveandcontinue
    // 
     protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('managerbanner/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}