<?php
 
// <!-- tạo tập tin block của container form -->

namespace Tigren\BannerManager\Block\Adminhtml\Block;
 
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
 
class Edit extends Container
{
    protected $_storeManager;
    protected $_coreRegistry = null;
 
    public function __construct(
        Context $context,        
        StoreManagerInterface $storeManager,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }
 
    protected function _construct()
    {
        // tạo các button
        $this->_objectId = 'manager_block_id';
        $this->_controller = 'adminhtml_block';
        $this->_blockGroup = 'Tigren_BannerManager';
 
        parent::_construct();
 
    }
    protected function _preparelayout()
    {
        if ($this->_isAllowedAction('Tigren_BannerManager::block_create') || $this->_isAllowedAction('Tigren_BannerManager::block_edit')) {
            $this->buttonList->update('save', 'label', __('Save Block'));
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
                            ],
                        ],
                    ]
                ],
                -100
            );

            $block = $this->_coreRegistry->registry('manager_block');
            if (!empty($faqCat)) {
                if ($faqCat->getBlockId() && $this->_isAllowedAction('Tigren_BannerManager::block_delete')) {
                    $this->buttonList->add(
                        'delete',
                        [
                            'label'   => __('Delete'),
                            'class'   => 'delete',
                            'onclick' => 'deleteConfirm("Are you sure you want to delete this Block ?", "'.$this->getDeleteUrl().'")'
                        ],
                        -100
                    );
                }
            }
        } else {
            $this->removeButton('save');
        }
        return parent::_prepareLayout();
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    public function getDeleteUrl()
    {
        return $this->getUrl(
            '*/*/delete',
            [
                '_current' => true,
                'id' => $this->getRequest()->getParam('block_id')
            ]
        );
    }

    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl(
            '*/*/save',
            [
                '_current' => true,
                'back' => 'edit',
                'active_tab' => ''
            ]
        );
    }
   
    
}
