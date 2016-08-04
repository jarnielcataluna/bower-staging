<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'sales_report_invoice' table.
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
class NestleBowerSalesReportInvoiceTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerSalesReportInvoiceTableMap';

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
        $this->setName('sales_report_invoice');
        $this->setPhpName('NestleBowerSalesReportInvoice');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerSalesReportInvoice');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('sales_report_id', 'SalesReportId', 'INTEGER', 'sales_report', 'id', false, 11, null);
        $this->addForeignKey('invoice_id', 'InvoiceId', 'INTEGER', 'invoices', 'id', false, 11, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerSalesReport', 'Nestle\\CoreBundle\\Model\\NestleBowerSalesReport', RelationMap::MANY_TO_ONE, array('sales_report_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerInvoices', 'Nestle\\CoreBundle\\Model\\NestleBowerInvoices', RelationMap::MANY_TO_ONE, array('invoice_id' => 'id', ), null, null);
    } // buildRelations()

} // NestleBowerSalesReportInvoiceTableMap
