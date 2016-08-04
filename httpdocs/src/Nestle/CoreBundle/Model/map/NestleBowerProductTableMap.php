<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'product' table.
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
class NestleBowerProductTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerProductTableMap';

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
        $this->setName('product');
        $this->setPhpName('NestleBowerProduct');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerProduct');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('product_category_id', 'ProductCategoryId', 'INTEGER', 'product_category', 'id', false, 100, null);
        $this->addColumn('sku', 'Sku', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('background_color', 'BackgroundColor', 'VARCHAR', false, 255, null);
        $this->addColumn('font_color', 'FontColor', 'VARCHAR', false, 255, null);
        $this->addColumn('image', 'Image', 'VARCHAR', false, 255, null);
        $this->addColumn('thumbnail', 'Thumbnail', 'VARCHAR', false, 255, null);
        $this->addColumn('base_price', 'BasePrice', 'FLOAT', false, null, null);
        $this->addColumn('vat', 'Vat', 'FLOAT', false, null, null);
        $this->addColumn('date_added', 'DateAdded', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 100, null);
        $this->addColumn('type', 'Type', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBowerProductCategory', 'Nestle\\CoreBundle\\Model\\NestleBowerProductCategory', RelationMap::MANY_TO_ONE, array('product_category_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerBrandProduct', 'Nestle\\CoreBundle\\Model\\NestleBowerBrandProduct', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), null, null, 'NestleBowerBrandProducts');
        $this->addRelation('NestleBowerInvoiceItem', 'Nestle\\CoreBundle\\Model\\NestleBowerInvoiceItem', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), null, null, 'NestleBowerInvoiceItems');
        $this->addRelation('NestleBowerRulesRelatedByProductId', 'Nestle\\CoreBundle\\Model\\NestleBowerRules', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), null, null, 'NestleBowerRulessRelatedByProductId');
        $this->addRelation('NestleBowerRulesRelatedByPromoProductId', 'Nestle\\CoreBundle\\Model\\NestleBowerRules', RelationMap::ONE_TO_MANY, array('id' => 'promo_product_id', ), null, null, 'NestleBowerRulessRelatedByPromoProductId');
    } // buildRelations()

} // NestleBowerProductTableMap
