<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'brand_product' table.
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
class NestleBowerBrandProductTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerBrandProductTableMap';

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
        $this->setName('brand_product');
        $this->setPhpName('NestleBowerBrandProduct');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerBrandProduct');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('brand_id', 'BrandId', 'INTEGER', 'brand', 'id', false, 100, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'product', 'id', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerBrand', 'Nestle\\CoreBundle\\Model\\NestleBowerBrand', RelationMap::MANY_TO_ONE, array('brand_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerProduct', 'Nestle\\CoreBundle\\Model\\NestleBowerProduct', RelationMap::MANY_TO_ONE, array('product_id' => 'id', ), null, null);
    } // buildRelations()

} // NestleBowerBrandProductTableMap
