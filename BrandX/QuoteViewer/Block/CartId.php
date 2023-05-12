<?php

namespace BrandX\QuoteViewer\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Checkout\Model\Session as CheckoutSession;

class CartId extends Template
{
    /**
     * @var CheckoutSession
     */
    protected $checkoutSession;


    /**
     * @param Context $context
     * @param CheckoutSession $checkoutSession
     * @param array $data
     */
    public function __construct(
        Context $context,
        CheckoutSession $checkoutSession,
        array $data = []
    )
    {
        $this->checkoutSession = $checkoutSession;
        parent::__construct($context, $data);
    }

    /**
     * @return int
     */
    public function getCartId()
    {
        return $this->checkoutSession->getQuoteId();
    }

}
