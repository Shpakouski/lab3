<?php

namespace Shpakouski\Review\Model\ResourceModel\Review;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Shpakouski\Review\Model\Review::class,
            \Shpakouski\Review\Model\ResourceModel\Review::class
        );
    }
}
