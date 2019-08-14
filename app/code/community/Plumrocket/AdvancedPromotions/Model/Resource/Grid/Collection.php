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

class Plumrocket_AdvancedPromotions_Model_Resource_Grid_Collection extends Mage_SalesRule_Model_Resource_Rule_Collection
{
	public static $itemInc = 0;

	public function addItem(Varien_Object $item)
    {
    	self::$itemInc++;
    	$item->setIdFieldName('fake_id');
    	$item->setId(self::$itemInc);

    	return parent::addItem($item);
    }
}