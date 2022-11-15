<?php
declare(strict_types=1);
/**
 * Update.php
 *
 * @copyright Copyright © 2021 Web4pro. All rights reserved.
 * @author    belousalek2@gmail.com
 */

namespace Web4pro\Cart\Controller\Cart;

use Magento\Checkout\Model\Cart;
use Magento\Checkout\Model\Sidebar;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Json\Helper\Data;
use Magento\Framework\View\Result\PageFactory;
use Web4pro\Cart\Model\Quote\ItemFactory;
use Psr\Log\LoggerInterface;

class Update extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface, HttpPostActionInterface
{
    /**
     * @var Sidebar
     */
    protected Sidebar $sidebar;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var Data
     */
    protected Data $jsonHelper;

    /**
     * @var Cart
     */
    protected Cart $cart;
    /**
     * @var ResultFactory
     */
    protected $resultJsonFactory;
    /**
     * @var PageFactory
     */
    protected PageFactory $_resultPageFactory;

    protected $itemFactory;

    protected $item;
    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;

    /**
     * @param Context $context
     * @param Sidebar $sidebar
     * @param LoggerInterface $logger
     * @param Data $jsonHelper
     * @codeCoverageIgnore
     */
    public function __construct(
        Context                                                        $context,
        Cart                                                           $cart,
        \Magento\Checkout\Model\Session                                $checkoutSession,
        Sidebar                                                        $sidebar,
        LoggerInterface                                                $logger,
        Data                                                           $jsonHelper,
        \Magento\Framework\Controller\Result\JsonFactory               $resultJsonFactory,
        \Magento\Framework\View\Result\PageFactory                     $resultPageFactory,
        \Web4pro\Cart\Model\Quote\ItemFactory                          $itemFactory,
        \Web4pro\Cart\Model\ResourceModel\Item                         $item,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $_productCollectionFactory
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->sidebar = $sidebar;
        $this->logger = $logger;
        $this->jsonHelper = $jsonHelper;
        $this->_checkoutSession = $checkoutSession;
        $this->cart = $cart;
        $this->itemFactory = $itemFactory;
        $this->item = $item;
        $this->_productCollectionFactory = $_productCollectionFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $itemQty = $this->getRequest()->getParam('cart');
        try {
//            $cart = $this->cart->save();
//            $this->cart->updateItems($itemQty)->save();
            $result = $this->resultJsonFactory->create();
            $itemModel = $this->itemFactory->create();
            $itemModel->setData($data);
            $r = $this->item->save($itemModel);
            $list = [$data];
            foreach ($this->cart->getQuote()->getAllVisibleItems() as $item) {
                $list[$item->getId()] = [
                    'name' => $item->getName()
                ];
                return $result->setData($list);

            }
        } catch (LocalizedException $e) {
            return $this->jsonResponse($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            return $this->jsonResponse($e->getMessage());
        }
    }

    protected function jsonResponse($error = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($this->sidebar->getResponseData($error))
        );
    }
}
