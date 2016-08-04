<?php

namespace Nestle\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Nestle\CoreBundle\Model\NestleBower;
use Nestle\CoreBundle\Model\NestleBowerAreaPeer;
use Nestle\CoreBundle\Model\NestleBowerPeer;
use Nestle\CoreBundle\Model\NestleNestleDistributorsPeer;
use Nestle\CoreBundle\Model\map\NestleBowerTableMap;

abstract class BaseNestleBowerPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'bower';

    /** the related Propel class for this table */
    const OM_CLASS = 'Nestle\\CoreBundle\\Model\\NestleBower';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Nestle\\CoreBundle\\Model\\map\\NestleBowerTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 12;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 12;

    /** the column name for the id field */
    const ID = 'bower.id';

    /** the column name for the fname field */
    const FNAME = 'bower.fname';

    /** the column name for the lname field */
    const LNAME = 'bower.lname';

    /** the column name for the contact_number field */
    const CONTACT_NUMBER = 'bower.contact_number';

    /** the column name for the bdate field */
    const BDATE = 'bower.bdate';

    /** the column name for the username field */
    const USERNAME = 'bower.username';

    /** the column name for the password field */
    const PASSWORD = 'bower.password';

    /** the column name for the area_id field */
    const AREA_ID = 'bower.area_id';

    /** the column name for the status field */
    const STATUS = 'bower.status';

    /** the column name for the bower_id field */
    const BOWER_ID = 'bower.bower_id';

    /** the column name for the distributor field */
    const DISTRIBUTOR = 'bower.distributor';

    /** the column name for the distributor_id field */
    const DISTRIBUTOR_ID = 'bower.distributor_id';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of NestleBower objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array NestleBower[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. NestleBowerPeer::$fieldNames[NestleBowerPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'Fname', 'Lname', 'ContactNumber', 'Bdate', 'Username', 'Password', 'AreaId', 'Status', 'BowerId', 'Distributor', 'DistributorId', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'fname', 'lname', 'contactNumber', 'bdate', 'username', 'password', 'areaId', 'status', 'bowerId', 'distributor', 'distributorId', ),
        BasePeer::TYPE_COLNAME => array (NestleBowerPeer::ID, NestleBowerPeer::FNAME, NestleBowerPeer::LNAME, NestleBowerPeer::CONTACT_NUMBER, NestleBowerPeer::BDATE, NestleBowerPeer::USERNAME, NestleBowerPeer::PASSWORD, NestleBowerPeer::AREA_ID, NestleBowerPeer::STATUS, NestleBowerPeer::BOWER_ID, NestleBowerPeer::DISTRIBUTOR, NestleBowerPeer::DISTRIBUTOR_ID, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'FNAME', 'LNAME', 'CONTACT_NUMBER', 'BDATE', 'USERNAME', 'PASSWORD', 'AREA_ID', 'STATUS', 'BOWER_ID', 'DISTRIBUTOR', 'DISTRIBUTOR_ID', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'fname', 'lname', 'contact_number', 'bdate', 'username', 'password', 'area_id', 'status', 'bower_id', 'distributor', 'distributor_id', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. NestleBowerPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Fname' => 1, 'Lname' => 2, 'ContactNumber' => 3, 'Bdate' => 4, 'Username' => 5, 'Password' => 6, 'AreaId' => 7, 'Status' => 8, 'BowerId' => 9, 'Distributor' => 10, 'DistributorId' => 11, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'fname' => 1, 'lname' => 2, 'contactNumber' => 3, 'bdate' => 4, 'username' => 5, 'password' => 6, 'areaId' => 7, 'status' => 8, 'bowerId' => 9, 'distributor' => 10, 'distributorId' => 11, ),
        BasePeer::TYPE_COLNAME => array (NestleBowerPeer::ID => 0, NestleBowerPeer::FNAME => 1, NestleBowerPeer::LNAME => 2, NestleBowerPeer::CONTACT_NUMBER => 3, NestleBowerPeer::BDATE => 4, NestleBowerPeer::USERNAME => 5, NestleBowerPeer::PASSWORD => 6, NestleBowerPeer::AREA_ID => 7, NestleBowerPeer::STATUS => 8, NestleBowerPeer::BOWER_ID => 9, NestleBowerPeer::DISTRIBUTOR => 10, NestleBowerPeer::DISTRIBUTOR_ID => 11, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'FNAME' => 1, 'LNAME' => 2, 'CONTACT_NUMBER' => 3, 'BDATE' => 4, 'USERNAME' => 5, 'PASSWORD' => 6, 'AREA_ID' => 7, 'STATUS' => 8, 'BOWER_ID' => 9, 'DISTRIBUTOR' => 10, 'DISTRIBUTOR_ID' => 11, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'fname' => 1, 'lname' => 2, 'contact_number' => 3, 'bdate' => 4, 'username' => 5, 'password' => 6, 'area_id' => 7, 'status' => 8, 'bower_id' => 9, 'distributor' => 10, 'distributor_id' => 11, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = NestleBowerPeer::getFieldNames($toType);
        $key = isset(NestleBowerPeer::$fieldKeys[$fromType][$name]) ? NestleBowerPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(NestleBowerPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, NestleBowerPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return NestleBowerPeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. NestleBowerPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(NestleBowerPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(NestleBowerPeer::ID);
            $criteria->addSelectColumn(NestleBowerPeer::FNAME);
            $criteria->addSelectColumn(NestleBowerPeer::LNAME);
            $criteria->addSelectColumn(NestleBowerPeer::CONTACT_NUMBER);
            $criteria->addSelectColumn(NestleBowerPeer::BDATE);
            $criteria->addSelectColumn(NestleBowerPeer::USERNAME);
            $criteria->addSelectColumn(NestleBowerPeer::PASSWORD);
            $criteria->addSelectColumn(NestleBowerPeer::AREA_ID);
            $criteria->addSelectColumn(NestleBowerPeer::STATUS);
            $criteria->addSelectColumn(NestleBowerPeer::BOWER_ID);
            $criteria->addSelectColumn(NestleBowerPeer::DISTRIBUTOR);
            $criteria->addSelectColumn(NestleBowerPeer::DISTRIBUTOR_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.fname');
            $criteria->addSelectColumn($alias . '.lname');
            $criteria->addSelectColumn($alias . '.contact_number');
            $criteria->addSelectColumn($alias . '.bdate');
            $criteria->addSelectColumn($alias . '.username');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.area_id');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.bower_id');
            $criteria->addSelectColumn($alias . '.distributor');
            $criteria->addSelectColumn($alias . '.distributor_id');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return NestleBower
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = NestleBowerPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return NestleBowerPeer::populateObjects(NestleBowerPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            NestleBowerPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param NestleBower $obj A NestleBower object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            NestleBowerPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A NestleBower object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof NestleBower) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or NestleBower object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(NestleBowerPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return NestleBower Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(NestleBowerPeer::$instances[$key])) {
                return NestleBowerPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references) {
        foreach (NestleBowerPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        NestleBowerPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to bower
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = NestleBowerPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = NestleBowerPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = NestleBowerPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NestleBowerPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (NestleBower object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = NestleBowerPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = NestleBowerPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + NestleBowerPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NestleBowerPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            NestleBowerPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related NestleNestleDistributors table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinNestleNestleDistributors(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerPeer::DISTRIBUTOR_ID, NestleNestleDistributorsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related NestleBowerArea table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinNestleBowerArea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerPeer::AREA_ID, NestleBowerAreaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of NestleBower objects pre-filled with their NestleNestleDistributors objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBower objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinNestleNestleDistributors(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);
        }

        NestleBowerPeer::addSelectColumns($criteria);
        $startcol = NestleBowerPeer::NUM_HYDRATE_COLUMNS;
        NestleNestleDistributorsPeer::addSelectColumns($criteria);

        $criteria->addJoin(NestleBowerPeer::DISTRIBUTOR_ID, NestleNestleDistributorsPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = NestleBowerPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = NestleNestleDistributorsPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = NestleNestleDistributorsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = NestleNestleDistributorsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    NestleNestleDistributorsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (NestleBower) to $obj2 (NestleNestleDistributors)
                $obj2->addNestleBower($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of NestleBower objects pre-filled with their NestleBowerArea objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBower objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinNestleBowerArea(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);
        }

        NestleBowerPeer::addSelectColumns($criteria);
        $startcol = NestleBowerPeer::NUM_HYDRATE_COLUMNS;
        NestleBowerAreaPeer::addSelectColumns($criteria);

        $criteria->addJoin(NestleBowerPeer::AREA_ID, NestleBowerAreaPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = NestleBowerPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = NestleBowerAreaPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = NestleBowerAreaPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = NestleBowerAreaPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    NestleBowerAreaPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (NestleBower) to $obj2 (NestleBowerArea)
                $obj2->addNestleBower($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerPeer::DISTRIBUTOR_ID, NestleNestleDistributorsPeer::ID, $join_behavior);

        $criteria->addJoin(NestleBowerPeer::AREA_ID, NestleBowerAreaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of NestleBower objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBower objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);
        }

        NestleBowerPeer::addSelectColumns($criteria);
        $startcol2 = NestleBowerPeer::NUM_HYDRATE_COLUMNS;

        NestleNestleDistributorsPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + NestleNestleDistributorsPeer::NUM_HYDRATE_COLUMNS;

        NestleBowerAreaPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + NestleBowerAreaPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(NestleBowerPeer::DISTRIBUTOR_ID, NestleNestleDistributorsPeer::ID, $join_behavior);

        $criteria->addJoin(NestleBowerPeer::AREA_ID, NestleBowerAreaPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = NestleBowerPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined NestleNestleDistributors rows

            $key2 = NestleNestleDistributorsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = NestleNestleDistributorsPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = NestleNestleDistributorsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    NestleNestleDistributorsPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (NestleBower) to the collection in $obj2 (NestleNestleDistributors)
                $obj2->addNestleBower($obj1);
            } // if joined row not null

            // Add objects for joined NestleBowerArea rows

            $key3 = NestleBowerAreaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = NestleBowerAreaPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = NestleBowerAreaPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    NestleBowerAreaPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (NestleBower) to the collection in $obj3 (NestleBowerArea)
                $obj3->addNestleBower($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related NestleNestleDistributors table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptNestleNestleDistributors(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerPeer::AREA_ID, NestleBowerAreaPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related NestleBowerArea table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptNestleBowerArea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerPeer::DISTRIBUTOR_ID, NestleNestleDistributorsPeer::ID, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of NestleBower objects pre-filled with all related objects except NestleNestleDistributors.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBower objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptNestleNestleDistributors(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);
        }

        NestleBowerPeer::addSelectColumns($criteria);
        $startcol2 = NestleBowerPeer::NUM_HYDRATE_COLUMNS;

        NestleBowerAreaPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + NestleBowerAreaPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(NestleBowerPeer::AREA_ID, NestleBowerAreaPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = NestleBowerPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined NestleBowerArea rows

                $key2 = NestleBowerAreaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = NestleBowerAreaPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = NestleBowerAreaPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    NestleBowerAreaPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (NestleBower) to the collection in $obj2 (NestleBowerArea)
                $obj2->addNestleBower($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of NestleBower objects pre-filled with all related objects except NestleBowerArea.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBower objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptNestleBowerArea(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);
        }

        NestleBowerPeer::addSelectColumns($criteria);
        $startcol2 = NestleBowerPeer::NUM_HYDRATE_COLUMNS;

        NestleNestleDistributorsPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + NestleNestleDistributorsPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(NestleBowerPeer::DISTRIBUTOR_ID, NestleNestleDistributorsPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = NestleBowerPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined NestleNestleDistributors rows

                $key2 = NestleNestleDistributorsPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = NestleNestleDistributorsPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = NestleNestleDistributorsPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    NestleNestleDistributorsPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (NestleBower) to the collection in $obj2 (NestleNestleDistributors)
                $obj2->addNestleBower($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(NestleBowerPeer::DATABASE_NAME)->getTable(NestleBowerPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseNestleBowerPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseNestleBowerPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Nestle\CoreBundle\Model\map\NestleBowerTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return NestleBowerPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a NestleBower or Criteria object.
     *
     * @param      mixed $values Criteria or NestleBower object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from NestleBower object
        }

        if ($criteria->containsKey(NestleBowerPeer::ID) && $criteria->keyContainsValue(NestleBowerPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NestleBowerPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a NestleBower or Criteria object.
     *
     * @param      mixed $values Criteria or NestleBower object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(NestleBowerPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(NestleBowerPeer::ID);
            $value = $criteria->remove(NestleBowerPeer::ID);
            if ($value) {
                $selectCriteria->add(NestleBowerPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(NestleBowerPeer::TABLE_NAME);
            }

        } else { // $values is NestleBower object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the bower table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(NestleBowerPeer::TABLE_NAME, $con, NestleBowerPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NestleBowerPeer::clearInstancePool();
            NestleBowerPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a NestleBower or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or NestleBower object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            NestleBowerPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof NestleBower) { // it's a model object
            // invalidate the cache for this single object
            NestleBowerPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NestleBowerPeer::DATABASE_NAME);
            $criteria->add(NestleBowerPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                NestleBowerPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(NestleBowerPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            NestleBowerPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given NestleBower object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param NestleBower $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(NestleBowerPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(NestleBowerPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(NestleBowerPeer::DATABASE_NAME, NestleBowerPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return NestleBower
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = NestleBowerPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(NestleBowerPeer::DATABASE_NAME);
        $criteria->add(NestleBowerPeer::ID, $pk);

        $v = NestleBowerPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return NestleBower[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(NestleBowerPeer::DATABASE_NAME);
            $criteria->add(NestleBowerPeer::ID, $pks, Criteria::IN);
            $objs = NestleBowerPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseNestleBowerPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseNestleBowerPeer::buildTableMap();

