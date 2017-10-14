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
            'title' => __('Block Title'),
            'url' => __('URL'),
            'display' => __('Display'),
            'identifier' => __('Identifier'),
            'descriotion' => __('Descriotion'),
            'status' => __('Status'),
            'position' => __('Position'),
            'image' => __('Image'),
            'sort_order' => __('Sort order'),
            'status' => __('Status'),
            'content' => __('Content')
            
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
