<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'province' table.
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
class NestleBowerProvinceTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerProvinceTableMap';

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
        $this->setName('province');
        $this->setPhpName('NestleBowerProvince');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerProvince');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('province', 'Province', 'VARCHAR', false, 255, null);
        $this->addForeignKey('region_id', 'RegionId', 'INTEGER', 'region', 'id', false, 100, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerRegion', 'Nestle\\CoreBundle\\Model\\NestleBowerRegion', RelationMap::MANY_TO_ONE, array('region_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerCity', 'Nestle\\CoreBundle\\Model\\NestleBowerCity', RelationMap::ONE_TO_MANY, array('id' => 'province_id', ), null, null, 'NestleBowerCities');
    } // buildRelations()

} // NestleBowerProvinceTableMap
