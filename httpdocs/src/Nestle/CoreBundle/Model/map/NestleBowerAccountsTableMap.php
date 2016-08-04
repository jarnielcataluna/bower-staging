<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'accounts' table.
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
class NestleBowerAccountsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerAccountsTableMap';

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
        $this->setName('accounts');
        $this->setPhpName('NestleBowerAccounts');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerAccounts');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('contact_person', 'ContactPerson', 'VARCHAR', false, 255, null);
        $this->addColumn('contact_number', 'ContactNumber', 'VARCHAR', false, 45, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, 255, null);
        $this->addForeignKey('area_id', 'AreaId', 'INTEGER', 'area', 'id', false, 11, null);
        $this->addForeignKey('city_id', 'CityId', 'INTEGER', 'city', 'id', false, 11, null);
        $this->addColumn('frequency', 'Frequency', 'VARCHAR', false, 100, null);
        $this->addForeignKey('category_id', 'CategoryId', 'INTEGER', 'category', 'id', false, 11, null);
        $this->addColumn('channel', 'Channel', 'VARCHAR', false, 255, null);
        $this->addColumn('bracket_number', 'BracketNumber', 'INTEGER', false, 11, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerArea', 'Nestle\\CoreBundle\\Model\\NestleBowerArea', RelationMap::MANY_TO_ONE, array('area_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerCity', 'Nestle\\CoreBundle\\Model\\NestleBowerCity', RelationMap::MANY_TO_ONE, array('city_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerCategory', 'Nestle\\CoreBundle\\Model\\NestleBowerCategory', RelationMap::MANY_TO_ONE, array('category_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerAccount', 'Nestle\\CoreBundle\\Model\\NestleBowerAccount', RelationMap::ONE_TO_MANY, array('id' => 'account_id', ), null, null, 'NestleBowerAccounts');
    } // buildRelations()

} // NestleBowerAccountsTableMap
