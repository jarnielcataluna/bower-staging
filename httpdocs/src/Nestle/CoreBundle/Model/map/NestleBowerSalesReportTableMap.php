<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'sales_report' table.
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
class NestleBowerSalesReportTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerSalesReportTableMap';

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
        $this->setName('sales_report');
        $this->setPhpName('NestleBowerSalesReport');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerSalesReport');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('bower_id', 'BowerId', 'INTEGER', 'bower', 'id', false, 11, null);
        $this->addColumn('total_sales', 'TotalSales', 'FLOAT', false, 100, null);
        $this->addColumn('total_skus', 'TotalSkus', 'INTEGER', false, 11, null);
        $this->addColumn('date', 'Date', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBower', 'Nestle\\CoreBundle\\Model\\NestleBower', RelationMap::MANY_TO_ONE, array('bower_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerSalesReportInvoice', 'Nestle\\CoreBundle\\Model\\NestleBowerSalesReportInvoice', RelationMap::ONE_TO_MANY, array('id' => 'sales_report_id', ), null, null, 'NestleBowerSalesReportInvoices');
    } // buildRelations()

} // NestleBowerSalesReportTableMap
