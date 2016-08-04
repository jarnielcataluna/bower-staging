<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'city' table.
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
class NestleBowerCityTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerCityTableMap';

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
        $this->setName('city');
        $this->setPhpName('NestleBowerCity');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerCity');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 255, null);
        $this->addForeignKey('province_id', 'ProvinceId', 'INTEGER', 'province', 'id', false, 11, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerProvince', 'Nestle\\CoreBundle\\Model\\NestleBowerProvince', RelationMap::MANY_TO_ONE, array('province_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerAccountsMcp', 'Nestle\\CoreBundle\\Model\\NestleBowerAccountsMcp', RelationMap::ONE_TO_MANY, array('id' => 'city_id', ), null, null, 'NestleBowerAccountsMcps');
        $this->addRelation('NestleBowerArea', 'Nestle\\CoreBundle\\Model\\NestleBowerArea', RelationMap::ONE_TO_MANY, array('id' => 'city_id', ), null, null, 'NestleBowerAreas');
    } // buildRelations()

} // NestleBowerCityTableMap
