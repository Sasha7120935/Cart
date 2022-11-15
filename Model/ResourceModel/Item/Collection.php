<?php
/**
 * Collection.php
 *
 * @copyright Copyright © 2021 Web4pro. All rights reserved.
 * @author    belousalek2@gmail.com
 */

namespace Web4pro\Cart\Model\ResourceModel\Item;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'item_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Web4pro\Cart\Model\Quote\Item', 'Web4pro\Cart\Model\ResourceModel\Item');
    }
}
