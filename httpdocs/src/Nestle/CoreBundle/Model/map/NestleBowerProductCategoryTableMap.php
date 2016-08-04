<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'product_category' table.
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
class NestleBowerProductCategoryTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerProductCategoryTableMap';

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
        $this->setName('product_category');
        $this->setPhpName('NestleBowerProductCategory');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerProductCategory');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('product_category', 'ProductCategory', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 100, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerProduct', 'Nestle\\CoreBundle\\Model\\NestleBowerProduct', RelationMap::ONE_TO_MANY, array('id' => 'product_category_id', ), null, null, 'NestleBowerProducts');
    } // buildRelations()

} // NestleBowerProductCategoryTableMap