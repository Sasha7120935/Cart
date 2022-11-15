<?php
/**
 * Address.php
 *
 * @copyright Copyright © 2021 Web4pro. All rights reserved.
 * @author    belousalek2@gmail.com
 */
namespace Web4pro\Cart\Model\ResourceModel;


class Item extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Address Resource Model
     */
    protected function _construct()
    {
        $this->_isPkAutoIncrement = false;
        $this->_init('quote_cart', 'item_id');
    }


}
