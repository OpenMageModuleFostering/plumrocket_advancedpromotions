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

class Plumrocket_Advancedpromotions_Block_Adminhtml_Coupons_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('coupons_and_orders_grid');
        $this->setDefaultSort('pricerule_id');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {

        $resource = Mage::getSingleton('core/resource');
        $collection = new Plumrocket_AdvancedPromotions_Model_Resource_Grid_Collection;
        $collection->getSelect()
            ->joinLeft(array('cp' => $resource->getTableName('salesrule/coupon')),
             'main_table.rule_id = cp.rule_id',
             array('code')
        )
        ->joinLeft(array('o' => $resource->getTableName('sales/order')),
            'FIND_IN_SET(main_table.rule_id, o.applied_rule_ids) AND o.coupon_code IS NULL
            or o.coupon_code = cp.code
             ',
             array('entity_id', 'increment_id', 'base_grand_total')
        )->where('cp.code IS NOT NULL OR o.increment_id IS NOT NULL');

        $collection->addFilterToMap('code', 'cp.code');

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('pricerule_id', array(
            'header' => Mage::helper('salesrule')->__('Rule ID'),
            'index'  => 'rule_id',
            'width'  => '50'
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('salesrule')->__('Rule Name'),
            'index'     => 'name',
            'renderer'  => 'pradvancedpromotions/adminhtml_coupons_grid_renderer_rule',
        ));

        $this->addColumn('code', array(
            'header' => Mage::helper('salesrule')->__('Coupon Code'),
            'index'  => 'code'
        ));

        $this->addColumn('increment_id', array(
            'header' => Mage::helper('sales')->__('Order #'),
            'index'  => 'increment_id',
            'renderer'  => 'pradvancedpromotions/adminhtml_coupons_grid_renderer_order',
        ));

        $this->addColumn('base_grand_total', array(
            'header'    => Mage::helper('sales')->__('G.T. (Base)'),
            'index'  => 'base_grand_total',
            'type' => 'number'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/promo_quote/edit', array('id' => $row->getRuleId()));
    }
}
