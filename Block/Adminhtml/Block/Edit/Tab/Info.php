<?php

namespace Tigren\BannerManager\Block\Adminhtml\Block\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
 // Tập tin này sẽ khai báo các trường trong form
class Info extends Generic implements TabInterface
{
    protected $_wysiwygConfig;
    
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        array $data = []
    ) {
       
        parent::__construct($context, $registry, $formFactory, $data);
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
         $fieldset->addField(
            'Store View',
            'textarea',
            [
                'name'        => 'store_id',
                'label'    => __('Store'),
                'required'     => true,
                'cols'  => '15',
                'row'   =>'4'
            ]
        );
         $fieldset->addField(
            'customer',
            'textarea',
            [
                'name'        => 'Customer',
                'label'    => __('Customer Group'),
                'required'     => true
            ]
        );
         $fieldset->addField(
            'position',
            'select',
            [
                'name'        => 'position',
                'label'    => __('Block Position'),
                'required'     => true,
            ]
        );
         $fieldset->addField(
            'Category Type',
            'select',
            [
                'name'        => 'type',
                'label'    => __('Category Type'),
                'required'     => true
            ]
        );
         $fieldset->addField(
            'display',
            'select',
            [
                'name'        => 'display',
                'label'    => __('Display Type'),
                'required'     => true
            ]
        );
         $fieldset->addField(
            'creation_time',
            'date',
            [
                'name'        => 'creation_time',
                'label'    => __('From '),
                'required'     => true,
                'class' => __('validate-date'),
                'date_format' => $dateFormat,
                'time_format' => $timeFormat,
                'note' => $dateTimeFormat
            ]
        );
        $fieldset->addField(
            'time',
            'date',
            [
                'name'        => 'update_time',
                'label'    => __('To'),
                'required'     => true,
                'style' => $style,
                'required' => true,
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
            'order',
            'text',
            [
                'name'        => 'sort_order',
                'label'    => __('Sort Order'),
                'required'     => true
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