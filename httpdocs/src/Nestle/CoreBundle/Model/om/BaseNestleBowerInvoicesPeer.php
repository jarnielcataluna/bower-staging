<?php

namespace Nestle\CoreBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcpPeer;
use Nestle\CoreBundle\Model\NestleBowerInvoices;
use Nestle\CoreBundle\Model\NestleBowerInvoicesPeer;
use Nestle\CoreBundle\Model\NestleBowerPeer;
use Nestle\CoreBundle\Model\map\NestleBowerInvoicesTableMap;

abstract class BaseNestleBowerInvoicesPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'default';

    /** the table name for this class */
    const TABLE_NAME = 'invoices';

    /** the related Propel class for this table */
    const OM_CLASS = 'Nestle\\CoreBundle\\Model\\NestleBowerInvoices';

    /** the related TableMap class for this table */
    const TM_CLASS = 'Nestle\\CoreBundle\\Model\\map\\NestleBowerInvoicesTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 9;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 9;

    /** the column name for the id field */
    const ID = 'invoices.id';

    /** the column name for the receipt_id field */
    const RECEIPT_ID = 'invoices.receipt_id';

    /** the column name for the invoice_date field */
    const INVOICE_DATE = 'invoices.invoice_date';

    /** the column name for the account_id field */
    const ACCOUNT_ID = 'invoices.account_id';

    /** the column name for the sold_to field */
    const SOLD_TO = 'invoices.sold_to';

    /** the column name for the bower_id field */
    const BOWER_ID = 'invoices.bower_id';

    /** the column name for the sales field */
    const SALES = 'invoices.sales';

    /** the column name for the skus field */
    const SKUS = 'invoices.skus';

    /** the column name for the status field */
    const STATUS = 'invoices.status';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of NestleBowerInvoices objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array NestleBowerInvoices[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. NestleBowerInvoicesPeer::$fieldNames[NestleBowerInvoicesPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'ReceiptId', 'InvoiceDate', 'AccountId', 'SoldTo', 'BowerId', 'Sales', 'Skus', 'Status', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'receiptId', 'invoiceDate', 'accountId', 'soldTo', 'bowerId', 'sales', 'skus', 'status', ),
        BasePeer::TYPE_COLNAME => array (NestleBowerInvoicesPeer::ID, NestleBowerInvoicesPeer::RECEIPT_ID, NestleBowerInvoicesPeer::INVOICE_DATE, NestleBowerInvoicesPeer::ACCOUNT_ID, NestleBowerInvoicesPeer::SOLD_TO, NestleBowerInvoicesPeer::BOWER_ID, NestleBowerInvoicesPeer::SALES, NestleBowerInvoicesPeer::SKUS, NestleBowerInvoicesPeer::STATUS, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'RECEIPT_ID', 'INVOICE_DATE', 'ACCOUNT_ID', 'SOLD_TO', 'BOWER_ID', 'SALES', 'SKUS', 'STATUS', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'receipt_id', 'invoice_date', 'account_id', 'sold_to', 'bower_id', 'sales', 'skus', 'status', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. NestleBowerInvoicesPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ReceiptId' => 1, 'InvoiceDate' => 2, 'AccountId' => 3, 'SoldTo' => 4, 'BowerId' => 5, 'Sales' => 6, 'Skus' => 7, 'Status' => 8, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'receiptId' => 1, 'invoiceDate' => 2, 'accountId' => 3, 'soldTo' => 4, 'bowerId' => 5, 'sales' => 6, 'skus' => 7, 'status' => 8, ),
        BasePeer::TYPE_COLNAME => array (NestleBowerInvoicesPeer::ID => 0, NestleBowerInvoicesPeer::RECEIPT_ID => 1, NestleBowerInvoicesPeer::INVOICE_DATE => 2, NestleBowerInvoicesPeer::ACCOUNT_ID => 3, NestleBowerInvoicesPeer::SOLD_TO => 4, NestleBowerInvoicesPeer::BOWER_ID => 5, NestleBowerInvoicesPeer::SALES => 6, NestleBowerInvoicesPeer::SKUS => 7, NestleBowerInvoicesPeer::STATUS => 8, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'RECEIPT_ID' => 1, 'INVOICE_DATE' => 2, 'ACCOUNT_ID' => 3, 'SOLD_TO' => 4, 'BOWER_ID' => 5, 'SALES' => 6, 'SKUS' => 7, 'STATUS' => 8, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'receipt_id' => 1, 'invoice_date' => 2, 'account_id' => 3, 'sold_to' => 4, 'bower_id' => 5, 'sales' => 6, 'skus' => 7, 'status' => 8, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $toNames = NestleBowerInvoicesPeer::getFieldNames($toType);
        $key = isset(NestleBowerInvoicesPeer::$fieldKeys[$fromType][$name]) ? NestleBowerInvoicesPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(NestleBowerInvoicesPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, NestleBowerInvoicesPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return NestleBowerInvoicesPeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. NestleBowerInvoicesPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(NestleBowerInvoicesPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(NestleBowerInvoicesPeer::ID);
            $criteria->addSelectColumn(NestleBowerInvoicesPeer::RECEIPT_ID);
            $criteria->addSelectColumn(NestleBowerInvoicesPeer::INVOICE_DATE);
            $criteria->addSelectColumn(NestleBowerInvoicesPeer::ACCOUNT_ID);
            $criteria->addSelectColumn(NestleBowerInvoicesPeer::SOLD_TO);
            $criteria->addSelectColumn(NestleBowerInvoicesPeer::BOWER_ID);
            $criteria->addSelectColumn(NestleBowerInvoicesPeer::SALES);
            $criteria->addSelectColumn(NestleBowerInvoicesPeer::SKUS);
            $criteria->addSelectColumn(NestleBowerInvoicesPeer::STATUS);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.receipt_id');
            $criteria->addSelectColumn($alias . '.invoice_date');
            $criteria->addSelectColumn($alias . '.account_id');
            $criteria->addSelectColumn($alias . '.sold_to');
            $criteria->addSelectColumn($alias . '.bower_id');
            $criteria->addSelectColumn($alias . '.sales');
            $criteria->addSelectColumn($alias . '.skus');
            $criteria->addSelectColumn($alias . '.status');
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
        $criteria->setPrimaryTableName(NestleBowerInvoicesPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerInvoicesPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return NestleBowerInvoices
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = NestleBowerInvoicesPeer::doSelect($critcopy, $con);
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
        return NestleBowerInvoicesPeer::populateObjects(NestleBowerInvoicesPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            NestleBowerInvoicesPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);

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
     * @param NestleBowerInvoices $obj A NestleBowerInvoices object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            NestleBowerInvoicesPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A NestleBowerInvoices object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof NestleBowerInvoices) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or NestleBowerInvoices object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(NestleBowerInvoicesPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return NestleBowerInvoices Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(NestleBowerInvoicesPeer::$instances[$key])) {
                return NestleBowerInvoicesPeer::$instances[$key];
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
        foreach (NestleBowerInvoicesPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        NestleBowerInvoicesPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to invoices
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
        $cls = NestleBowerInvoicesPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = NestleBowerInvoicesPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = NestleBowerInvoicesPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NestleBowerInvoicesPeer::addInstanceToPool($obj, $key);
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
     * @return array (NestleBowerInvoices object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = NestleBowerInvoicesPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = NestleBowerInvoicesPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + NestleBowerInvoicesPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NestleBowerInvoicesPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            NestleBowerInvoicesPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining the related NestleBowerAccountsMcp table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinNestleBowerAccountsMcp(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerInvoicesPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerInvoicesPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerInvoicesPeer::ACCOUNT_ID, NestleBowerAccountsMcpPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related NestleBower table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinNestleBower(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerInvoicesPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerInvoicesPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerInvoicesPeer::BOWER_ID, NestleBowerPeer::ID, $join_behavior);

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
     * Selects a collection of NestleBowerInvoices objects pre-filled with their NestleBowerAccountsMcp objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBowerInvoices objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinNestleBowerAccountsMcp(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);
        }

        NestleBowerInvoicesPeer::addSelectColumns($criteria);
        $startcol = NestleBowerInvoicesPeer::NUM_HYDRATE_COLUMNS;
        NestleBowerAccountsMcpPeer::addSelectColumns($criteria);

        $criteria->addJoin(NestleBowerInvoicesPeer::ACCOUNT_ID, NestleBowerAccountsMcpPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerInvoicesPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerInvoicesPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = NestleBowerInvoicesPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerInvoicesPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = NestleBowerAccountsMcpPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = NestleBowerAccountsMcpPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = NestleBowerAccountsMcpPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    NestleBowerAccountsMcpPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (NestleBowerInvoices) to $obj2 (NestleBowerAccountsMcp)
                $obj2->addNestleBowerInvoices($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of NestleBowerInvoices objects pre-filled with their NestleBower objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBowerInvoices objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinNestleBower(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);
        }

        NestleBowerInvoicesPeer::addSelectColumns($criteria);
        $startcol = NestleBowerInvoicesPeer::NUM_HYDRATE_COLUMNS;
        NestleBowerPeer::addSelectColumns($criteria);

        $criteria->addJoin(NestleBowerInvoicesPeer::BOWER_ID, NestleBowerPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerInvoicesPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerInvoicesPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = NestleBowerInvoicesPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerInvoicesPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = NestleBowerPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = NestleBowerPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = NestleBowerPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    NestleBowerPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (NestleBowerInvoices) to $obj2 (NestleBower)
                $obj2->addNestleBowerInvoices($obj1);

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
        $criteria->setPrimaryTableName(NestleBowerInvoicesPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerInvoicesPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerInvoicesPeer::ACCOUNT_ID, NestleBowerAccountsMcpPeer::ID, $join_behavior);

        $criteria->addJoin(NestleBowerInvoicesPeer::BOWER_ID, NestleBowerPeer::ID, $join_behavior);

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
     * Selects a collection of NestleBowerInvoices objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBowerInvoices objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);
        }

        NestleBowerInvoicesPeer::addSelectColumns($criteria);
        $startcol2 = NestleBowerInvoicesPeer::NUM_HYDRATE_COLUMNS;

        NestleBowerAccountsMcpPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + NestleBowerAccountsMcpPeer::NUM_HYDRATE_COLUMNS;

        NestleBowerPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + NestleBowerPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(NestleBowerInvoicesPeer::ACCOUNT_ID, NestleBowerAccountsMcpPeer::ID, $join_behavior);

        $criteria->addJoin(NestleBowerInvoicesPeer::BOWER_ID, NestleBowerPeer::ID, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerInvoicesPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerInvoicesPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = NestleBowerInvoicesPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerInvoicesPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined NestleBowerAccountsMcp rows

            $key2 = NestleBowerAccountsMcpPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = NestleBowerAccountsMcpPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = NestleBowerAccountsMcpPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    NestleBowerAccountsMcpPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (NestleBowerInvoices) to the collection in $obj2 (NestleBowerAccountsMcp)
                $obj2->addNestleBowerInvoices($obj1);
            } // if joined row not null

            // Add objects for joined NestleBower rows

            $key3 = NestleBowerPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = NestleBowerPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = NestleBowerPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    NestleBowerPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (NestleBowerInvoices) to the collection in $obj3 (NestleBower)
                $obj3->addNestleBowerInvoices($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related NestleBowerAccountsMcp table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptNestleBowerAccountsMcp(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerInvoicesPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerInvoicesPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerInvoicesPeer::BOWER_ID, NestleBowerPeer::ID, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related NestleBower table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptNestleBower(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NestleBowerInvoicesPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NestleBowerInvoicesPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(NestleBowerInvoicesPeer::ACCOUNT_ID, NestleBowerAccountsMcpPeer::ID, $join_behavior);

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
     * Selects a collection of NestleBowerInvoices objects pre-filled with all related objects except NestleBowerAccountsMcp.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBowerInvoices objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptNestleBowerAccountsMcp(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);
        }

        NestleBowerInvoicesPeer::addSelectColumns($criteria);
        $startcol2 = NestleBowerInvoicesPeer::NUM_HYDRATE_COLUMNS;

        NestleBowerPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + NestleBowerPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(NestleBowerInvoicesPeer::BOWER_ID, NestleBowerPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerInvoicesPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerInvoicesPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = NestleBowerInvoicesPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerInvoicesPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined NestleBower rows

                $key2 = NestleBowerPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = NestleBowerPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = NestleBowerPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    NestleBowerPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (NestleBowerInvoices) to the collection in $obj2 (NestleBower)
                $obj2->addNestleBowerInvoices($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of NestleBowerInvoices objects pre-filled with all related objects except NestleBower.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of NestleBowerInvoices objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptNestleBower(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);
        }

        NestleBowerInvoicesPeer::addSelectColumns($criteria);
        $startcol2 = NestleBowerInvoicesPeer::NUM_HYDRATE_COLUMNS;

        NestleBowerAccountsMcpPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + NestleBowerAccountsMcpPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(NestleBowerInvoicesPeer::ACCOUNT_ID, NestleBowerAccountsMcpPeer::ID, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NestleBowerInvoicesPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NestleBowerInvoicesPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = NestleBowerInvoicesPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NestleBowerInvoicesPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined NestleBowerAccountsMcp rows

                $key2 = NestleBowerAccountsMcpPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = NestleBowerAccountsMcpPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = NestleBowerAccountsMcpPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    NestleBowerAccountsMcpPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (NestleBowerInvoices) to the collection in $obj2 (NestleBowerAccountsMcp)
                $obj2->addNestleBowerInvoices($obj1);

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
        return Propel::getDatabaseMap(NestleBowerInvoicesPeer::DATABASE_NAME)->getTable(NestleBowerInvoicesPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseNestleBowerInvoicesPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseNestleBowerInvoicesPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \Nestle\CoreBundle\Model\map\NestleBowerInvoicesTableMap());
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
        return NestleBowerInvoicesPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a NestleBowerInvoices or Criteria object.
     *
     * @param      mixed $values Criteria or NestleBowerInvoices object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from NestleBowerInvoices object
        }

        if ($criteria->containsKey(NestleBowerInvoicesPeer::ID) && $criteria->keyContainsValue(NestleBowerInvoicesPeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NestleBowerInvoicesPeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a NestleBowerInvoices or Criteria object.
     *
     * @param      mixed $values Criteria or NestleBowerInvoices object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(NestleBowerInvoicesPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(NestleBowerInvoicesPeer::ID);
            $value = $criteria->remove(NestleBowerInvoicesPeer::ID);
            if ($value) {
                $selectCriteria->add(NestleBowerInvoicesPeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(NestleBowerInvoicesPeer::TABLE_NAME);
            }

        } else { // $values is NestleBowerInvoices object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the invoices table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(NestleBowerInvoicesPeer::TABLE_NAME, $con, NestleBowerInvoicesPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NestleBowerInvoicesPeer::clearInstancePool();
            NestleBowerInvoicesPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a NestleBowerInvoices or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or NestleBowerInvoices object or primary key or array of primary keys
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
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            NestleBowerInvoicesPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof NestleBowerInvoices) { // it's a model object
            // invalidate the cache for this single object
            NestleBowerInvoicesPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NestleBowerInvoicesPeer::DATABASE_NAME);
            $criteria->add(NestleBowerInvoicesPeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                NestleBowerInvoicesPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(NestleBowerInvoicesPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            NestleBowerInvoicesPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given NestleBowerInvoices object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param NestleBowerInvoices $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(NestleBowerInvoicesPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(NestleBowerInvoicesPeer::TABLE_NAME);

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

        return BasePeer::doValidate(NestleBowerInvoicesPeer::DATABASE_NAME, NestleBowerInvoicesPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return NestleBowerInvoices
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = NestleBowerInvoicesPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(NestleBowerInvoicesPeer::DATABASE_NAME);
        $criteria->add(NestleBowerInvoicesPeer::ID, $pk);

        $v = NestleBowerInvoicesPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return NestleBowerInvoices[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(NestleBowerInvoicesPeer::DATABASE_NAME);
            $criteria->add(NestleBowerInvoicesPeer::ID, $pks, Criteria::IN);
            $objs = NestleBowerInvoicesPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseNestleBowerInvoicesPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseNestleBowerInvoicesPeer::buildTableMap();

