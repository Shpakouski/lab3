<?php

namespace Shpakouski\Review\Controller\Product;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\RequestInterface;

class Post extends \Magento\Framework\App\Action\Action
{
    protected $reviewFactory;
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Shpakouski\Review\Model\ReviewFactory $reviewFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->reviewFactory = $reviewFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getParams();
        $review = $this->reviewFactory->create();
        $review->setData($data);
        if ($review->save()) {
            $this->messageManager->addSuccessMessage(__('You saved the data.'));
        } else {
            $this->messageManager->addErrorMessage(__('Data was not saved.'));
        }
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
