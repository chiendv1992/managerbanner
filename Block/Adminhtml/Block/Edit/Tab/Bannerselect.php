<?php
  namespace Tigren\Bannermanager\Block\Adminhtml\Block\Edit\Tab;
 
    class Bannerselect extends \Magento\Backend\Block\Widget\Grid\Extended
    {
        protected $blockFactory;
 
        public function __construct(
            \Magento\Backend\Block\Template\Context $context,
            \Magento\Backend\Helper\Data $backendHelper,
            \Magento\Catalog\Model\ProductFactory $blockFactory,
            \Magento\Framework\ObjectManagerInterface $objectManager,
            \Magento\Framework\Registry $coreRegistry,
            array $data = []
        ) {
            $this->blockFactory = $blockFactory;
            $this->_coreRegistry = $coreRegistry;
            parent::__construct($context, $backendHelper, $data);
            $this->_objectManager = $objectManager;
        }
        protected function _construct()
        {
            parent::_construct();
            $this->setId('edit_form');
            $this->setDefaultSort('entity_id');
            $this->setUseAjax(true);
             if ($this->getRequest()->getParam('block_id')) {
            $this->setDefaultFilter(array('in_product' => 1));
        } 
            $this->setSaveParametersInSession(false); 
        }
        protected function _addColumnFilterToCollection($column)
        {
            if ($column->getId() == 'in_blocks') {
                $blockIds = $this->_getSelectedBlocks();
                if (empty($blockIds)) {
                    $blockIds = 0;
                }
                if ($column->getFilter()->getValue()) {
                    $this->getCollection()->addFieldToFilter('entity_id', array('in'=>$blockIds));
                } else {
                    if($blockIds) {
                        $this->getCollection()->addFieldToFilter('entity_id', array('nin'=>$blockIds));
                    }
                }
            } else {
                parent::_addColumnFilterToCollection($column);
            }
            return $this;
        }
      
        protected function _prepareCollection()
        {
            $collection = $this->blockFactory->create()->getCollection()->addAttributeToSelect("*");
            $this->setCollection($collection);
            return parent::_prepareCollection();
        }
   //  thêm cột
        protected function _prepareColumns()
        {
        $model = $this->_objectManager->get('\Tigren\Bannermanager\Model\Block');   
        $this->addColumn(
            'in_blocks',
            [
                'header_css_class' => 'a-center',
                'type' => 'checkbox',
                'name' => 'in_blocks',
                'align' => 'center',
                'index' => 'entity_id',
                'values' => $this->_getSelectedBlocks()
            ]
        );
        $this->addColumn(
                'banner_id',
                [
                    'header' => __('ID'),
                    'sortable' => true,
                    'index' => 'banner_id',
                    'header_css_class' => 'col-id',
                    'column_css_class' => 'col-id'
                ]
            );
        $this->addColumn(
                'title',
                [
                    'header' => __('Title'),
                    'index' => 'title'
                ]
            );
        $this->addColumn(
                'description',
                [
                    'header' => __('Description'),
                    'index' => 'description'
                ]
            );
        $this->addColumn(
                'image',
                [
                    'header' => __('image'),
                    'index' => 'image'
                ]
            );
        $this->addColumn(
                'url',
                [
                    'header' => __('Banner URL'),
                    'index' => 'url'
                ]
            );
        $this->addColumn(
                'position',
                [
                    'header' => __('position'),
                    'index' => 'Position',
                    'width'             => 80,
                    'type'              => 'number',
                    'validate_class'    => 'validate-number',
                    'index'             => 'position',
                    'editable'          => true,
                    'edit_only'         => true
                ]
            );
 
            return parent::_prepareColumns();
        }
 
        protected function _getSelectedBlocks()   
        {
            $blocks = array_keys($this->getSelectedBlocks());
            return $blocks;
        }

        public function getSelectedBlocks() 
        {
            // block Data
            $tm_id = $this->getRequest()->getParam('block_id');
            if(!isset($tm_id)) 
                {
                    $tm_id = 0;
                }
            $blocks = array(1,2); 
            $blockIds = array();
            
            return $blockIds;
        }
        public function getGridUrl()
        {
            return $this->getUrl('block/*/blockgrid', ['_current' => true]);
        }
        
}