<?php

namespace Shpakouski\Review\Block\Goods;
class Allreviews extends \Magento\Framework\View\Element\Template
{
    protected $reviewFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Shpakouski\Review\Model\ReviewFactory $reviewFactory,
        array $data = []
    )
    {
        $this->reviewFactory = $reviewFactory;
        parent::__construct($context, $data);
    }

    public function getReviewsForProduct()
    {
        return $this->reviewFactory->create()->getCollection()->getData();
    }
}
