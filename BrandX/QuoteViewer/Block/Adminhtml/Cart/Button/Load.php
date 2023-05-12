<?php

namespace BrandX\QuoteViewer\Block\Adminhtml\Cart\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Ui\Component\Control\Container;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Load implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('View Customer Cart'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
            'class_name' => Container::DEFAULT_CONTROL,
        ];
    }
    /**
     * @var Context
     */
    protected $context;

    /**
     * GenericButton constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }


    /**
     * Get order id from the URL
     *
     * @return mixed
     */
    public function getQuoteId()
    {
        try {
            return $this->context->getRequest()->getParam('quote_id');
        } catch (NoSuchEntityException $e) {
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }



}
