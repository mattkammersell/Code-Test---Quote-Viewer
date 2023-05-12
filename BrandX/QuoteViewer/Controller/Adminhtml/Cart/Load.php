<?php

namespace BrandX\QuoteViewer\Controller\Adminhtml\Cart;

use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Backend\Model\Session\Quote;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;


class Load extends Action implements HttpPostActionInterface
{

    /**
     * @var string $aclResource
     */
    protected $aclResource;

    /**
     * @var $quote Quote
     */
    protected $quote;

    /**
     * @var RedirectFactory $resultRedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @param Quote $quote
     * @param RedirectFactory $resultRedirectFactory
     */
    public function __construct(
        Quote $quote,
        RedirectFactory $resultRedirectFactory,
        Context $context
    ) {
        $this->aclResource = "BrandX_QuoteViewer::manage";
        $this->quote = $quote;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        (int)$id = $this->getRequest()->getParam('quote_id');

        try {
            $this->quote->setQuoteId($id);
            $quote = $this->quote->getQuote();

            $customerId = null;

            if ($quote->getCustomerId()) {
                $customerId = $quote->getCustomerId();
            }

            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('sales/order_create/index', ['customer_id' => $customerId]);


        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('This cart does not exist.'));
        } catch (InputException $e) {
            $this->messageManager->addErrorMessage(__('This cart does not exist.'));
        }
        $this->_redirect('*/*');
    }

    /**
     * Acl check for admin
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed($this->aclResource);
    }

}
