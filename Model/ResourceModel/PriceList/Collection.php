<?php

namespace Dealer4dealer\Xcore\Model\ResourceModel\PriceList;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Dealer4dealer\Xcore\Model\PriceList',
            'Dealer4dealer\Xcore\Model\ResourceModel\PriceList'
        );
    }
}