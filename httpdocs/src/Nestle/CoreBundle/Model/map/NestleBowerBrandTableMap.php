<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'brand' table.
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
class NestleBowerBrandTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerBrandTableMap';

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
        $this->setName('brand');
        $this->setPhpName('NestleBowerBrand');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerBrand');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('brand', 'Brand', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerBrandProduct', 'Nestle\\CoreBundle\\Model\\NestleBowerBrandProduct', RelationMap::ONE_TO_MANY, array('id' => 'brand_id', ), null, null, 'NestleBowerBrandProducts');
    } // buildRelations()

} // NestleBowerBrandTableMap
