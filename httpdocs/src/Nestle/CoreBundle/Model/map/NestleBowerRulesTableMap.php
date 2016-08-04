<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'rules' table.
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
class NestleBowerRulesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerRulesTableMap';

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
        $this->setName('rules');
        $this->setPhpName('NestleBowerRules');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerRules');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('product_id', 'ProductId', 'INTEGER', 'product', 'id', false, 11, null);
        $this->addColumn('qty_to_qualify', 'QtyToQualify', 'INTEGER', false, 11, null);
        $this->addColumn('qty_free', 'QtyFree', 'INTEGER', false, 11, null);
        $this->addForeignKey('promo_product_id', 'PromoProductId', 'INTEGER', 'product', 'id', false, 11, null);
        $this->addColumn('start_date', 'StartDate', 'VARCHAR', false, 255, null);
        $this->addColumn('end_date', 'EndDate', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerProductRelatedByProductId', 'Nestle\\CoreBundle\\Model\\NestleBowerProduct', RelationMap::MANY_TO_ONE, array('product_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerProductRelatedByPromoProductId', 'Nestle\\CoreBundle\\Model\\NestleBowerProduct', RelationMap::MANY_TO_ONE, array('promo_product_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerPromos', 'Nestle\\CoreBundle\\Model\\NestleBowerPromos', RelationMap::ONE_TO_MANY, array('id' => 'rule_id', ), null, null, 'NestleBowerPromoss');
    } // buildRelations()

} // NestleBowerRulesTableMap
