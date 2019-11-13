<?php

namespace Shpakouski\Review\Block\Product;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class Review extends \Magento\Framework\View\Element\Template
{
    protected $customerSession;
    protected $registry;
    private $product;
    protected $reviewFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        Registry $registry,
        \Shpakouski\Review\Model\ReviewFactory $reviewFactory,
        array $data = []
    )
    {
        $this->registry = $registry;
        $this->reviewFactory = $reviewFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    private function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->registry->registry('product');
            if (!$this->product->getId()) {
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }
        return $this->product;
    }

    public function getProductName()
    {
        return $this->getProduct()->getName();
    }

    public function getCustomer()
    {
        if ($this->customerSession->isLoggedIn()) {
            return $this->customerSession->getCustomer()->getName();
        } else return "Guest";
    }

    public function getReviews()
    {
        return $this->reviewFactory->create()->getCollection()->getData();
    }
}
