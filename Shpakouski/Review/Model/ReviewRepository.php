<?php

namespace Shpakouski\Review\Model;

use Shpakouski\Review\Api\ReviewRepositoryInterface;
use Shpakouski\Review\Api\Data\ReviewSearchResultsInterfaceFactory;
use Shpakouski\Review\Api\Data\ReviewInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Shpakouski\Review\Model\ResourceModel\Review as ResourceReview;
use Shpakouski\Review\Model\ResourceModel\Review\CollectionFactory as ReviewCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;

class ReviewRepository implements ReviewRepositoryInterface
{
    protected $resource;
    protected $reviewFactory;
    protected $reviewCollectionFactory;
    protected $searchResultsFactory;
    protected $dataObjectHelper;
    protected $dataObjectProcessor;
    protected $dataReviewFactory;
    protected $extensionAttributesJoinProcessor;
    private $storeManager;
    private $collectionProcessor;
    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceReview $resource
     * @param ReviewFactory $reviewFactory
     * @param ReviewInterfaceFactory $dataReviewFactory
     * @param ReviewCollectionFactory $reviewCollectionFactory
     * @param ReviewSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceReview $resource,
        ReviewFactory $reviewFactory,
        ReviewInterfaceFactory $dataReviewFactory,
        ReviewCollectionFactory $reviewCollectionFactory,
        ReviewSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    )
    {
        $this->resource = $resource;
        $this->reviewFactory = $reviewFactory;
        $this->reviewCollectionFactory = $reviewCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataReviewFactory = $dataReviewFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Shpakouski\Review\Api\Data\ReviewInterface $review
    )
    {
        /* if (empty($review->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $review->setStoreId($storeId);
        } */
        $reviewData = $this->extensibleDataObjectConverter->toNestedArray(
            $review,
            [],
            \Shpakouski\Review\Api\Data\ReviewInterface::class
        );
        $reviewModel = $this->reviewFactory->create()->setData($reviewData);
        try {
            $this->resource->save($reviewModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the review: %1',
                $exception->getMessage()
            ));
        }
        return $reviewModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($reviewId)
    {
        $review = $this->reviewFactory->create();
        $this->resource->load($review, $reviewId);
        if (!$review->getId()) {
            throw new NoSuchEntityException(__('Review with id "%1" does not exist.', $reviewId));
        }
        return $review->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    )
    {
        $collection = $this->reviewCollectionFactory->create();
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Shpakouski\Review\Api\Data\ReviewInterface::class
        );
        $this->collectionProcessor->process($criteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Shpakouski\Review\Api\Data\ReviewInterface $review
    )
    {
        try {
            $reviewModel = $this->reviewFactory->create();
            $this->resource->load($reviewModel, $review->getReviewId());
            $this->resource->delete($reviewModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Review: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($reviewId)
    {
        return $this->delete($this->get($reviewId));
    }
}
