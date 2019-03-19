<?php

namespace Phoenix\GeoMage\Model;

use Magento\Framework\Model\AbstractModel;

class Item extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Phoenix\GeoMage\Model\ResourceModel\Item::class);
    }
}