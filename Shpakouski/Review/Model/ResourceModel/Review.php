<?php

namespace Shpakouski\Review\Model\ResourceModel;
class Review extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('shpakouski_review_review', 'review_id');
    }
}
