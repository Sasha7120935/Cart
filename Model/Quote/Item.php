<?php
/**
 * Model/Quote/Address.php
 *
 * @copyright Copyright © 2021 Web4pro. All rights reserved.
 * @author    belousalek2@gmail.com
 */

namespace Web4pro\Cart\Model\Quote;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Model\AbstractModel;

class Item extends AbstractModel
{
    protected $resourceModel;
    /**
     * Address Model Quote
     */
    const CACHE_TAG = 'web4pro_cart';

    /**
     * @var string
     */
    protected $_cacheTag = 'web4pro_cart';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'web4pro_cart';

    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;

    /**
     * Initialize resource model
     *
     * @return void
     */
    public function __construct(
        \Magento\Framework\Model\Context                               $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $_productCollectionFactory,
        \Magento\Catalog\Model\ProductRepository                       $productRepository,
        \Magento\Framework\Event\ManagerInterface                      $eventManager,
        \Magento\Framework\App\RequestInterface                        $request,
        \Magento\Framework\Registry                                    $registry,
        \Magento\Store\Model\StoreManagerInterface                     $storeManager,
        \Magento\CatalogInventory\Helper\Stock                         $stockHelper,
        array                                                          $data = []
    ) {
        $this->_productCollectionFactory = $_productCollectionFactory;
        $this->_productRepository = $productRepository;
        $this->_eventManager = $eventManager;
        $this->_storeManager = $storeManager;
        $this->_request = $request;
        $this->registry = $registry;
        $this->stockHelper = $stockHelper;
        parent::__construct($context, $registry);
    }


    protected function _construct()
    {
        parent::_construct();
        $this->_init('Web4pro\Cart\Model\ResourceModel\Item');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Save from collection data
     *
     * @param array $data
     * @return $this|bool
     */
    public function saveCollection(array $data)
    {
        if (isset($data[$this->getId()])) {
            $this->addData($data[$this->getId()]);
            $this->getResource()->save($this);
        }
        return $this;
    }
}
