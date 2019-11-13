<?php

namespace Shpakouski\Review\Block\Customer;
class Allreviews extends \Magento\Framework\View\Element\Template
{
    protected $reviewFactory;
    protected $customerSession;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Shpakouski\Review\Model\ReviewFactory $reviewFactory,
        array $data = []
    )
    {
        $this->customerSession = $customerSession;
        $this->reviewFactory = $reviewFactory;
        parent::__construct($context, $data);
    }

    public function getCustomer()
    {
        // var_dump($this->customerSession->isLoggedIn());
        var_dump($this->customerSession->getCustomer()->getName()); //Print current customer ID
        //var_dump($this->customerSession->getCustomer());
    }

    public function getReviews()
    {
        $customer = $this->customerSession->getCustomer()->getName();
        return $this->reviewFactory->create()->getCollection()->addFieldToFilter('review_user', $customer);
    }
}
