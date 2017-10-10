<?php
namespace Tigren\BannerManager\Controller\Adminhtml\Block;

class PostDataProcessor
{

    protected $messageManager;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
    }

    // Validate required columns
    public function validateRequireEntry(array $data)
    {
        $requiredFields = [
            'title' => __('Title'),
            'url' => __('URL'),
            'display' => __('Display'),
            'identifier' => __('Identifier'),
            'link' => __('Link'),
            'descriotion' => __('Descriotion'),
            'status' => __('Status'),
            'content' => __('Content'),
            'position' => __('Position'),
            'images' => __('Image'),
            'sort_order' => __('Sort_order'),
            'status' => __('Status')
            
        ];
        $errorNo = true;
        
        foreach ($data as $field => $value) {
            if (in_array($field, array_keys($requiredFields)) && $value == '') {
                $errorNo = false;
                $this->messageManager->addError(
                    __('"%1" field is required', $requiredFields[$field])
                );
            }
        }
        return $errorNo;
    }
}
