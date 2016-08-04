<?php

namespace Nestle\CoreBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'bower_account' table.
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
class NestleBowerAccountTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Nestle.CoreBundle.Model.map.NestleBowerAccountTableMap';

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
        $this->setName('bower_account');
        $this->setPhpName('NestleBowerAccount');
        $this->setClassname('Nestle\\CoreBundle\\Model\\NestleBowerAccount');
        $this->setPackage('src.Nestle.CoreBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('bower_id', 'BowerId', 'INTEGER', 'bower', 'id', false, 11, null);
        $this->addForeignKey('account_id', 'AccountId', 'INTEGER', 'accounts', 'id', false, 11, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, 11, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NestleBower', 'Nestle\\CoreBundle\\Model\\NestleBower', RelationMap::MANY_TO_ONE, array('bower_id' => 'id', ), null, null);
        $this->addRelation('NestleBowerAccountsMcp', 'Nestle\\CoreBundle\\Model\\NestleBowerAccountsMcp', RelationMap::MANY_TO_ONE, array('account_id' => 'id', ), null, null);
    } // buildRelations()

} // NestleBowerAccountTableMap
