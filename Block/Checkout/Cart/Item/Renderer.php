<?php

namespace Web4pro\Cart\Block\Checkout\Cart\Item;

use Magento\Catalog\Model\Product\Configuration\Item\ItemResolverInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\View\Element\Message\InterpretationStrategyInterface;
use Web4pro\Cart\Model\Quote\ItemFactory;

class Renderer extends \Magento\Checkout\Block\Cart\Item\Renderer
{
    /**
     * @var CollectionFactory
     */
    protected $itemFactory;
    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Helper\Product\Configuration $productConfig,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Catalog\Block\Product\ImageBuilder $imageBuilder,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        PriceCurrencyInterface $priceCurrency,
        \Magento\Framework\Module\Manager $moduleManager,
        InterpretationStrategyInterface $messageInterpretationStrategy,
        ItemFactory $itemFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $_productCollectionFactory,
        array $data = [],
        ItemResolverInterface $itemResolver = null
    ) {
        parent::__construct(
            $context,
            $productConfig,
            $checkoutSession,
            $imageBuilder,
            $urlHelper,
            $messageManager,
            $priceCurrency,
            $moduleManager,
            $messageInterpretationStrategy,
            $data,
            $itemResolver
        );
        $this->itemFactory = $itemFactory;
        $this->_productCollectionFactory = $_productCollectionFactory;
    }
    public function getProductCollection()
    {
        $productCollection = $this->_productCollectionFactory->create();
        return $productCollection
            ->addAttributeToSelect('*')
            ->load();
    }
}
