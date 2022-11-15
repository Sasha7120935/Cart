<?php

namespace Web4pro\Cart\Observer\Sales;

use Magento\Framework\Event\Observer;

class QuoteItemSetProduct implements \Magento\Framework\Event\ObserverInterface
{
    protected $renderer;

    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     */
    public function __construct(
        \Web4pro\Cart\Block\Checkout\Cart\Item\Renderer $renderer
    ) {
        $this->renderer = $renderer;
    }

    public function execute(
        Observer $observer
    ) {
        $quoteItem = $observer->getEvent()->getData('quote_item');
        $products = $this->renderer->getProductCollection();
        foreach ($products as $product) {
            $r = $product->getName();
            $quoteItem->setName($r);
        }
    }
}
