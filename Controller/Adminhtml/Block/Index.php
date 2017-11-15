<?php
namespace Tigren\BannerManager\Controller\Adminhtml\Block;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory;
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage ->addBreadcrumb(
			'Block Manager',
			'Block Manager'
		);
		  $resultPage->getConfig()->getTitle()->prepend((__('Block')));
		  $resultPage->getConfig()->getTitle()->prepend((__('Block Manager')));
		  return $resultPage;
	}


}