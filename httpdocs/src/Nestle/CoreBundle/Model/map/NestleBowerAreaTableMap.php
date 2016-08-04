<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'area' table.
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
class NestleBowerAreaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerAreaTableMap';

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
        $this->setName('area');
        $this->setPhpName('NestleBowerArea');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerArea');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('area', 'Area', 'VARCHAR', false, 255, null);
        $this->addForeignKey('city_id', 'CityId', 'INTEGER', 'city', 'id', false, 11, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerCity', 'Nestle\\CoreBundle\\Model\\NestleBowerCity', RelationMap::MANY_TO_ONE, array('city_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerAccountsMcp', 'Nestle\\CoreBundle\\Model\\NestleBowerAccountsMcp', RelationMap::ONE_TO_MANY, array('id' => 'area_id', ), null, null, 'NestleBowerAccountsMcps');
        $this->addRelation('NestleBower', 'Nestle\\CoreBundle\\Model\\NestleBower', RelationMap::ONE_TO_MANY, array('id' => 'area_id', ), null, null, 'NestleBowers');
    } // buildRelations()

} // NestleBowerAreaTableMap
