<?php
/**
 * Plumrocket Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End-user License Agreement
 * that is available through the world-wide-web at this URL:
 * http://wiki.plumrocket.net/wiki/EULA
 * If you are unable to obtain it through the world-wide-web, please
 * send an email to support@plumrocket.com so we can send you a copy immediately.
 *
 * @package     Plumrocket_AdvancedPromotions
 * @copyright   Copyright (c) 2017 Plumrocket Inc. (http://www.plumrocket.com)
 * @license     http://wiki.plumrocket.net/wiki/EULA  End-user License Agreement
 */

class Plumrocket_AdvancedPromotions_Adminhtml_Prpromo_CouponsController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('promo')
            ->_title($this->__('Orders &amp; Coupons'));

        $this->renderLayout();
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('promo/quote/shopping_cart_coupons');
    }
}