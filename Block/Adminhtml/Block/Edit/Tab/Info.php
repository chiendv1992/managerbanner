<?php
namespace Tigren\BannerManager\Block\Adminhtml\Block\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Tigren\BannerManager\Helper;


 // Tập tin này sẽ khai báo các trường trong form
class Info extends Generic implements TabInterface
{
    protected $_wysiwygConfig;
    protected $_systemStore;
    protected $_options;
    protected $_helper;

    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Customer\Model\Customer\Attribute\Source\Group $options,
        \Tigren\BannerManager\Helper\Data $helper,
        array $data = []
    ) {
       
        $this->_systemStore = $systemStore;
        $this->_options = $options;
        $this->_helper = $helper;
        parent::__construct($context, $registry, $formFactory, $data, $systemStore, $options, $helper);
        }
 
    protected function _prepareForm()
    {
    // manager_block ben controller edit.php
        $model = $this->_coreRegistry->registry('manager_block');
 
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('block_');
        $form->setFieldNameSuffix('block');
//kt date-time
        $dateFormat = 'M/d/yy';
        $timeFormat = 'h:mm a';
        $dateTimeFormat = 'M/d/yy h:mm a';
        $style = 'color: #000;background-color: #fff; font-weight: bold; font-size: 13px;';


        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Infomation')]
        );
 
        if ($model->getId()) {
            $fieldset->addField(
                'block_id',
                'hidden',
                ['name' => 'block_id']
            );
        }
        $fieldset->addField(
            'title',
            'text',
            [
                'name'        => 'title',
                'label'    => __('Title'),
                'required'     => true
            ]
        );
        // store view
        if (!$this->_storeManager->isSingleStoreMode()) {
            $field = $fieldset->addField(
                'store_id',
                'multiselect',
                [
                    'name' => 'stores[]',
                    'label' => __('Store View'),
                    'title' => __('Store View'),
                    'required' => true,
                    'values' => $this->_systemStore->getStoreValuesForForm(false, true)
                ]
            );
            $renderer = $this->getLayout()->createBlock(
                'Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element'
            );
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(
                'store_id',
                'hidden',
                ['name' => 'stores[]', 'value' => $this->_storeManager->getStore(true)->getId()]
            );
            $model->setStoreId($this->_storeManager->getStore(true)->getId());
        }
        // customer group 
        // $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        // $groupOptions = $objectManager->get('\Magento\Customer\Model\Customer\Attribute\Source\Group')->getAllOptions();
        $fieldset->addField(
            'customer_id',
            'multiselect',
            [
                'name'        => 'customer_id',
                'label'    => __('Customer Group'),
                'required'     => true,                
                // 'values' => $groupOptions,
                'values'=> $this->_options->toOptionArray('customer_group_id','customer_group_code')               
            ]
        );
        $fieldset->addField(
            'position',
            'select',
            [
                'name'        => 'position',
                'label'    => __('Block Position'),
                'required'     => true,
                'values'=> $this->_helper->getPositionOptions()               
            ]
        );
        $fieldset->addField(
            'Category Type',
            'select',
            [
                'name'        => 'type',
                'label'    => __('Category Type'),
                'required'     => true,
                'values'=> $this->_helper->getDisplayTypeOptions()
             ]
        );
        $fieldset->addField(
            'display',
            'select',
            [
                'name'        => 'display',
                'label'    => __('Display Type'),
                'required'     => true,
                'values'=> $this->_helper->getDisplayTypeOptions()
            ]
        );
        $fieldset->addField(
            'creation_time',
            'date',
            [
                'name'        => 'creation_time',
                'label'    => __('From '),
                'required'     => false,
                'class' => __('validate-date'),
                'date_format' => $dateFormat,
                'time_format' => $timeFormat,
                'note' => $dateTimeFormat
            ]
        );
        $fieldset->addField(
            'update_time',
            'date',
            [
                'name'        => 'update_time',
                'label'    => __('To'),
                'required'     => true,
                'style' => $style,
                'required' => false,
                'class' => __('validate-date'),
                'date_format' => $dateFormat,
                'time_format' => $timeFormat,
                'note' => $dateTimeFormat
            ]
        );         
        $fieldset->addField(
            'status',
            'select',
            [
                'name'        => 'status',
                'label'    => __('Is Active'),
                'required'     => true,
                'options' => ['1' => __('Enable'), '0' => __('Disible')]
            ]
        );         
        $fieldset->addField(
            'sort_order',
            'text',
            [
                'name'        => 'sort_order',
                'label'    => __('Sort Order'),
                'required'     => false
            ]
        );       
 
        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);
 
        return parent::_prepareForm();
    } 
    public function getTabLabel()
    {
        return __('Block Infomation');
    } 
    public function getTabTitle()
    {
        return __('Block Infomation');
    } 
    public function canShowTab()
    {
        return true;
    } 
    public function isHidden()
    {
        return false;
    }

}