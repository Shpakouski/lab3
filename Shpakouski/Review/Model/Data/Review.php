<?php

namespace Shpakouski\Review\Model\Data;

use Shpakouski\Review\Api\Data\ReviewInterface;

class Review extends \Magento\Framework\Api\AbstractExtensibleObject implements ReviewInterface
{
    /**
     * Get review_id
     * @return string|null
     */
    public function getReviewId()
    {
        return $this->_get(self::REVIEW_ID);
    }

    /**
     * Set review_id
     * @param string $reviewId
     * @return \Shpakouski\Review\Api\Data\ReviewInterface
     */
    public function setReviewId($reviewId)
    {
        return $this->setData(self::REVIEW_ID, $reviewId);
    }

    /**
     * Get id_review
     * @return string|null
     */
    public function getIdReview()
    {
        return $this->_get(self::ID_REVIEW);
    }

    /**
     * Set id_review
     * @param string $idReview
     * @return \Shpakouski\Review\Api\Data\ReviewInterface
     */
    public function setIdReview($idReview)
    {
        return $this->setData(self::ID_REVIEW, $idReview);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Shpakouski\Review\Api\Data\ReviewExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Shpakouski\Review\Api\Data\ReviewExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Shpakouski\Review\Api\Data\ReviewExtensionInterface $extensionAttributes
    )
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
