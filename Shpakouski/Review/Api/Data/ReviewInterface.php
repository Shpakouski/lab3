<?php

namespace Shpakouski\Review\Api\Data;
interface ReviewInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const REVIEW_ID = 'review_id';
    const ID_REVIEW = 'id_review';

    /**
     * Get review_id
     * @return string|null
     */
    public function getReviewId();

    /**
     * Set review_id
     * @param string $reviewId
     * @return \Shpakouski\Review\Api\Data\ReviewInterface
     */
    public function setReviewId($reviewId);

    /**
     * Get id_review
     * @return string|null
     */
    public function getIdReview();

    /**
     * Set id_review
     * @param string $idReview
     * @return \Shpakouski\Review\Api\Data\ReviewInterface
     */
    public function setIdReview($idReview);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Shpakouski\Review\Api\Data\ReviewExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Shpakouski\Review\Api\Data\ReviewExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Shpakouski\Review\Api\Data\ReviewExtensionInterface $extensionAttributes
    );
}
