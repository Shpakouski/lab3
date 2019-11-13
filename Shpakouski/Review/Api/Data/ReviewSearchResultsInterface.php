<?php

namespace Shpakouski\Review\Api\Data;
interface ReviewSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Review list.
     * @return \Shpakouski\Review\Api\Data\ReviewInterface[]
     */
    public function getItems();

    /**
     * Set id_review list.
     * @param \Shpakouski\Review\Api\Data\ReviewInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
