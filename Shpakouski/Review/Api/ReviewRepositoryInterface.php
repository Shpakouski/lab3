<?php

namespace Shpakouski\Review\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ReviewRepositoryInterface
{
    /**
     * Save Review
     * @param \Shpakouski\Review\Api\Data\ReviewInterface $review
     * @return \Shpakouski\Review\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Shpakouski\Review\Api\Data\ReviewInterface $review
    );

    /**
     * Retrieve Review
     * @param string $reviewId
     * @return \Shpakouski\Review\Api\Data\ReviewInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($reviewId);

    /**
     * Retrieve Review matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Shpakouski\Review\Api\Data\ReviewSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Review
     * @param \Shpakouski\Review\Api\Data\ReviewInterface $review
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Shpakouski\Review\Api\Data\ReviewInterface $review
    );

    /**
     * Delete Review by ID
     * @param string $reviewId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($reviewId);
}
