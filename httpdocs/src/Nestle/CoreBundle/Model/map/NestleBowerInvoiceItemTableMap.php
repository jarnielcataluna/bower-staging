<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'invoice_item' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Nestle.CoreBundle.Model.map
 */
class NestleBowerInvoiceItemTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerInvoiceItemTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('invoice_item');
        $this->setPhpName('NestleBowerInvoiceItem');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerInvoiceItem');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('invoice_id', 'InvoiceId', 'INTEGER', 'invoices', 'id', false, 11, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'product', 'id', false, 11, null);
        $this->addColumn('unit_price', 'UnitPrice', 'FLOAT', false, 100, null);
        $this->addColumn('qty', 'Qty', 'INTEGER', false, 11, null);
        $this->addColumn('total_sales', 'TotalSales', 'FLOAT', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerInvoices', 'Nestle\\CoreBundle\\Model\\NestleBowerInvoices', RelationMap::MANY_TO_ONE, array('invoice_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerProduct', 'Nestle\\CoreBundle\\Model\\NestleBowerProduct', RelationMap::MANY_TO_ONE, array('product_id' => 'id', ), null, null);
    } // buildRelations()

} // NestleBowerInvoiceItemTableMap
