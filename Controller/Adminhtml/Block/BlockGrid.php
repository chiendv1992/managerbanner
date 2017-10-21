<?php    
    namespace Tigren\BannerManager\Controller\Adminhtml\Block;
 
    class BlockGrid extends \Tigren\BannerManager\Controller\Adminhtml\Block
    {
        protected $resultLayoutFactory;
 
        public function __construct(
            \Magento\Backend\App\Action\Context $context,
            \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
        ) {
            parent::__construct($context);
            $this->resultLayoutFactory = $resultLayoutFactory;
        }
        public function execute()
        {
            $resultLayout = $this->resultLayoutFactory->create();
            $resultLayout->getLayout()->getBlock('managerbanner.block.edit.tab.main');
            return $resultLayout;
        }
 
    }