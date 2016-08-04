<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'bower' table.
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
class NestleBowerTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerTableMap';

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
        $this->setName('bower');
        $this->setPhpName('NestleBower');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBower');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('fname', 'Fname', 'VARCHAR', false, 255, null);
        $this->addColumn('lname', 'Lname', 'VARCHAR', false, 255, null);
        $this->addColumn('contact_number', 'ContactNumber', 'VARCHAR', false, 255, null);
        $this->addColumn('bdate', 'Bdate', 'VARCHAR', false, 255, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 255, null);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 255, null);
        $this->addForeignKey('area_id', 'AreaId', 'INTEGER', 'area', 'id', false, 100, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        $this->addColumn('bower_id', 'BowerId', 'VARCHAR', false, 255, null);
        $this->addColumn('distributor', 'Distributor', 'VARCHAR', false, 255, null);
        $this->addForeignKey('distributor_id', 'DistributorId', 'INTEGER', 'nestle_distributors', 'id', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleNestleDistributors', 'Nestle\\CoreBundle\\Model\\NestleNestleDistributors', RelationMap::MANY_TO_ONE, array('distributor_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerArea', 'Nestle\\CoreBundle\\Model\\NestleBowerArea', RelationMap::MANY_TO_ONE, array('area_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerAccount', 'Nestle\\CoreBundle\\Model\\NestleBowerAccount', RelationMap::ONE_TO_MANY, array('id' => 'bower_id', ), null, null, 'NestleBowerAccounts');
        $this->addRelation('NestleBowerInvoices', 'Nestle\\CoreBundle\\Model\\NestleBowerInvoices', RelationMap::ONE_TO_MANY, array('id' => 'bower_id', ), null, null, 'NestleBowerInvoicess');
        $this->addRelation('NestleBowerSalesReport', 'Nestle\\CoreBundle\\Model\\NestleBowerSalesReport', RelationMap::ONE_TO_MANY, array('id' => 'bower_id', ), null, null, 'NestleBowerSalesReports');
    } // buildRelations()

} // NestleBowerTableMap
