<?php

namespace Shpakouski\Review\Model;

use Shpakouski\Review\Api\Data\ReviewInterface;
use Shpakouski\Review\Api\Data\ReviewInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Review extends \Magento\Framework\Model\AbstractModel
{
    protected $reviewDataFactory;
    protected $dataObjectHelper;
    protected $_eventPrefix = 'shpakouski_review_review';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ReviewInterfaceFactory $reviewDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Shpakouski\Review\Model\ResourceModel\Review $resource
     * @param \Shpakouski\Review\Model\ResourceModel\Review\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ReviewInterfaceFactory $reviewDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Shpakouski\Review\Model\ResourceModel\Review $resource,
        \Shpakouski\Review\Model\ResourceModel\Review\Collection $resourceCollection,
        array $data = []
    )
    {
        $this->reviewDataFactory = $reviewDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve review model with review data
     * @return ReviewInterface
     */
    public function getDataModel()
    {
        $reviewData = $this->getData();
        $reviewDataObject = $this->reviewDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $reviewDataObject,
            $reviewData,
            ReviewInterface::class
        );
        return $reviewDataObject;
    }
}
