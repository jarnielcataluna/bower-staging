<?php

namespace Nestle\CoreBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Nestle\CoreBundle\Model\NestleBower;
use Nestle\CoreBundle\Model\NestleBowerQuery;
use Nestle\CoreBundle\Model\NestleBowerSalesReport;
use Nestle\CoreBundle\Model\NestleBowerSalesReportInvoice;
use Nestle\CoreBundle\Model\NestleBowerSalesReportInvoiceQuery;
use Nestle\CoreBundle\Model\NestleBowerSalesReportPeer;
use Nestle\CoreBundle\Model\NestleBowerSalesReportQuery;

abstract class BaseNestleBowerSalesReport extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Nestle\\CoreBundle\\Model\\NestleBowerSalesReportPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NestleBowerSalesReportPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the bower_id field.
     * @var        int
     */
    protected $bower_id;

    /**
     * The value for the total_sales field.
     * @var        double
     */
    protected $total_sales;

    /**
     * The value for the total_skus field.
     * @var        int
     */
    protected $total_skus;

    /**
     * The value for the date field.
     * @var        string
     */
    protected $date;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * @var        NestleBower
     */
    protected $aNestleBower;

    /**
     * @var        PropelObjectCollection|NestleBowerSalesReportInvoice[] Collection to store aggregation of NestleBowerSalesReportInvoice objects.
     */
    protected $collNestleBowerSalesReportInvoices;
    protected $collNestleBowerSalesReportInvoicesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nestleBowerSalesReportInvoicesScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [bower_id] column value.
     *
     * @return int
     */
    public function getBowerId()
    {

        return $this->bower_id;
    }

    /**
     * Get the [total_sales] column value.
     *
     * @return double
     */
    public function getTotalSales()
    {

        return $this->total_sales;
    }

    /**
     * Get the [total_skus] column value.
     *
     * @return int
     */
    public function getTotalSkus()
    {

        return $this->total_skus;
    }

    /**
     * Get the [date] column value.
     *
     * @return string
     */
    public function getDate()
    {

        return $this->date;
    }

    /**
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {

        return $this->status;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return NestleBowerSalesReport The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [bower_id] column.
     *
     * @param  int $v new value
     * @return NestleBowerSalesReport The current object (for fluent API support)
     */
    public function setBowerId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->bower_id !== $v) {
            $this->bower_id = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportPeer::BOWER_ID;
        }

        if ($this->aNestleBower !== null && $this->aNestleBower->getId() !== $v) {
            $this->aNestleBower = null;
        }


        return $this;
    } // setBowerId()

    /**
     * Set the value of [total_sales] column.
     *
     * @param  double $v new value
     * @return NestleBowerSalesReport The current object (for fluent API support)
     */
    public function setTotalSales($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->total_sales !== $v) {
            $this->total_sales = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportPeer::TOTAL_SALES;
        }


        return $this;
    } // setTotalSales()

    /**
     * Set the value of [total_skus] column.
     *
     * @param  int $v new value
     * @return NestleBowerSalesReport The current object (for fluent API support)
     */
    public function setTotalSkus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->total_skus !== $v) {
            $this->total_skus = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportPeer::TOTAL_SKUS;
        }


        return $this;
    } // setTotalSkus()

    /**
     * Set the value of [date] column.
     *
     * @param  string $v new value
     * @return NestleBowerSalesReport The current object (for fluent API support)
     */
    public function setDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date !== $v) {
            $this->date = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportPeer::DATE;
        }


        return $this;
    } // setDate()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return NestleBowerSalesReport The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->bower_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->total_sales = ($row[$startcol + 2] !== null) ? (double) $row[$startcol + 2] : null;
            $this->total_skus = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->date = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->status = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 6; // 6 = NestleBowerSalesReportPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating NestleBowerSalesReport object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aNestleBower !== null && $this->bower_id !== $this->aNestleBower->getId()) {
            $this->aNestleBower = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerSalesReportPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NestleBowerSalesReportPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aNestleBower = null;
            $this->collNestleBowerSalesReportInvoices = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerSalesReportPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NestleBowerSalesReportQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(NestleBowerSalesReportPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                NestleBowerSalesReportPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aNestleBower !== null) {
                if ($this->aNestleBower->isModified() || $this->aNestleBower->isNew()) {
                    $affectedRows += $this->aNestleBower->save($con);
                }
                $this->setNestleBower($this->aNestleBower);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->nestleBowerSalesReportInvoicesScheduledForDeletion !== null) {
                if (!$this->nestleBowerSalesReportInvoicesScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerSalesReportInvoicesScheduledForDeletion as $nestleBowerSalesReportInvoice) {
                        // need to save related object because we set the relation to null
                        $nestleBowerSalesReportInvoice->save($con);
                    }
                    $this->nestleBowerSalesReportInvoicesScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerSalesReportInvoices !== null) {
                foreach ($this->collNestleBowerSalesReportInvoices as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = NestleBowerSalesReportPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NestleBowerSalesReportPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NestleBowerSalesReportPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(NestleBowerSalesReportPeer::BOWER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`bower_id`';
        }
        if ($this->isColumnModified(NestleBowerSalesReportPeer::TOTAL_SALES)) {
            $modifiedColumns[':p' . $index++]  = '`total_sales`';
        }
        if ($this->isColumnModified(NestleBowerSalesReportPeer::TOTAL_SKUS)) {
            $modifiedColumns[':p' . $index++]  = '`total_skus`';
        }
        if ($this->isColumnModified(NestleBowerSalesReportPeer::DATE)) {
            $modifiedColumns[':p' . $index++]  = '`date`';
        }
        if ($this->isColumnModified(NestleBowerSalesReportPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }

        $sql = sprintf(
            'INSERT INTO `sales_report` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`bower_id`':
                        $stmt->bindValue($identifier, $this->bower_id, PDO::PARAM_INT);
                        break;
                    case '`total_sales`':
                        $stmt->bindValue($identifier, $this->total_sales, PDO::PARAM_STR);
                        break;
                    case '`total_skus`':
                        $stmt->bindValue($identifier, $this->total_skus, PDO::PARAM_INT);
                        break;
                    case '`date`':
                        $stmt->bindValue($identifier, $this->date, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aNestleBower !== null) {
                if (!$this->aNestleBower->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBower->getValidationFailures());
                }
            }


            if (($retval = NestleBowerSalesReportPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collNestleBowerSalesReportInvoices !== null) {
                    foreach ($this->collNestleBowerSalesReportInvoices as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = NestleBowerSalesReportPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getBowerId();
                break;
            case 2:
                return $this->getTotalSales();
                break;
            case 3:
                return $this->getTotalSkus();
                break;
            case 4:
                return $this->getDate();
                break;
            case 5:
                return $this->getStatus();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['NestleBowerSalesReport'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NestleBowerSalesReport'][$this->getPrimaryKey()] = true;
        $keys = NestleBowerSalesReportPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getBowerId(),
            $keys[2] => $this->getTotalSales(),
            $keys[3] => $this->getTotalSkus(),
            $keys[4] => $this->getDate(),
            $keys[5] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aNestleBower) {
                $result['NestleBower'] = $this->aNestleBower->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collNestleBowerSalesReportInvoices) {
                $result['NestleBowerSalesReportInvoices'] = $this->collNestleBowerSalesReportInvoices->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = NestleBowerSalesReportPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setBowerId($value);
                break;
            case 2:
                $this->setTotalSales($value);
                break;
            case 3:
                $this->setTotalSkus($value);
                break;
            case 4:
                $this->setDate($value);
                break;
            case 5:
                $this->setStatus($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = NestleBowerSalesReportPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setBowerId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setTotalSales($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setTotalSkus($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setDate($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setStatus($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NestleBowerSalesReportPeer::DATABASE_NAME);

        if ($this->isColumnModified(NestleBowerSalesReportPeer::ID)) $criteria->add(NestleBowerSalesReportPeer::ID, $this->id);
        if ($this->isColumnModified(NestleBowerSalesReportPeer::BOWER_ID)) $criteria->add(NestleBowerSalesReportPeer::BOWER_ID, $this->bower_id);
        if ($this->isColumnModified(NestleBowerSalesReportPeer::TOTAL_SALES)) $criteria->add(NestleBowerSalesReportPeer::TOTAL_SALES, $this->total_sales);
        if ($this->isColumnModified(NestleBowerSalesReportPeer::TOTAL_SKUS)) $criteria->add(NestleBowerSalesReportPeer::TOTAL_SKUS, $this->total_skus);
        if ($this->isColumnModified(NestleBowerSalesReportPeer::DATE)) $criteria->add(NestleBowerSalesReportPeer::DATE, $this->date);
        if ($this->isColumnModified(NestleBowerSalesReportPeer::STATUS)) $criteria->add(NestleBowerSalesReportPeer::STATUS, $this->status);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(NestleBowerSalesReportPeer::DATABASE_NAME);
        $criteria->add(NestleBowerSalesReportPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of NestleBowerSalesReport (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBowerId($this->getBowerId());
        $copyObj->setTotalSales($this->getTotalSales());
        $copyObj->setTotalSkus($this->getTotalSkus());
        $copyObj->setDate($this->getDate());
        $copyObj->setStatus($this->getStatus());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getNestleBowerSalesReportInvoices() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerSalesReportInvoice($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return NestleBowerSalesReport Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return NestleBowerSalesReportPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NestleBowerSalesReportPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a NestleBower object.
     *
     * @param                  NestleBower $v
     * @return NestleBowerSalesReport The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleBower(NestleBower $v = null)
    {
        if ($v === null) {
            $this->setBowerId(NULL);
        } else {
            $this->setBowerId($v->getId());
        }

        $this->aNestleBower = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleBower object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBowerSalesReport($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleBower object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleBower The associated NestleBower object.
     * @throws PropelException
     */
    public function getNestleBower(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleBower === null && ($this->bower_id !== null) && $doQuery) {
            $this->aNestleBower = NestleBowerQuery::create()->findPk($this->bower_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleBower->addNestleBowerSalesReports($this);
             */
        }

        return $this->aNestleBower;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('NestleBowerSalesReportInvoice' == $relationName) {
            $this->initNestleBowerSalesReportInvoices();
        }
    }

    /**
     * Clears out the collNestleBowerSalesReportInvoices collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerSalesReport The current object (for fluent API support)
     * @see        addNestleBowerSalesReportInvoices()
     */
    public function clearNestleBowerSalesReportInvoices()
    {
        $this->collNestleBowerSalesReportInvoices = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerSalesReportInvoicesPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerSalesReportInvoices collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerSalesReportInvoices($v = true)
    {
        $this->collNestleBowerSalesReportInvoicesPartial = $v;
    }

    /**
     * Initializes the collNestleBowerSalesReportInvoices collection.
     *
     * By default this just sets the collNestleBowerSalesReportInvoices collection to an empty array (like clearcollNestleBowerSalesReportInvoices());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerSalesReportInvoices($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerSalesReportInvoices && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerSalesReportInvoices = new PropelObjectCollection();
        $this->collNestleBowerSalesReportInvoices->setModel('NestleBowerSalesReportInvoice');
    }

    /**
     * Gets an array of NestleBowerSalesReportInvoice objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBowerSalesReport is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerSalesReportInvoice[] List of NestleBowerSalesReportInvoice objects
     * @throws PropelException
     */
    public function getNestleBowerSalesReportInvoices($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerSalesReportInvoicesPartial && !$this->isNew();
        if (null === $this->collNestleBowerSalesReportInvoices || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerSalesReportInvoices) {
                // return empty collection
                $this->initNestleBowerSalesReportInvoices();
            } else {
                $collNestleBowerSalesReportInvoices = NestleBowerSalesReportInvoiceQuery::create(null, $criteria)
                    ->filterByNestleBowerSalesReport($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerSalesReportInvoicesPartial && count($collNestleBowerSalesReportInvoices)) {
                      $this->initNestleBowerSalesReportInvoices(false);

                      foreach ($collNestleBowerSalesReportInvoices as $obj) {
                        if (false == $this->collNestleBowerSalesReportInvoices->contains($obj)) {
                          $this->collNestleBowerSalesReportInvoices->append($obj);
                        }
                      }

                      $this->collNestleBowerSalesReportInvoicesPartial = true;
                    }

                    $collNestleBowerSalesReportInvoices->getInternalIterator()->rewind();

                    return $collNestleBowerSalesReportInvoices;
                }

                if ($partial && $this->collNestleBowerSalesReportInvoices) {
                    foreach ($this->collNestleBowerSalesReportInvoices as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerSalesReportInvoices[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerSalesReportInvoices = $collNestleBowerSalesReportInvoices;
                $this->collNestleBowerSalesReportInvoicesPartial = false;
            }
        }

        return $this->collNestleBowerSalesReportInvoices;
    }

    /**
     * Sets a collection of NestleBowerSalesReportInvoice objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerSalesReportInvoices A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBowerSalesReport The current object (for fluent API support)
     */
    public function setNestleBowerSalesReportInvoices(PropelCollection $nestleBowerSalesReportInvoices, PropelPDO $con = null)
    {
        $nestleBowerSalesReportInvoicesToDelete = $this->getNestleBowerSalesReportInvoices(new Criteria(), $con)->diff($nestleBowerSalesReportInvoices);


        $this->nestleBowerSalesReportInvoicesScheduledForDeletion = $nestleBowerSalesReportInvoicesToDelete;

        foreach ($nestleBowerSalesReportInvoicesToDelete as $nestleBowerSalesReportInvoiceRemoved) {
            $nestleBowerSalesReportInvoiceRemoved->setNestleBowerSalesReport(null);
        }

        $this->collNestleBowerSalesReportInvoices = null;
        foreach ($nestleBowerSalesReportInvoices as $nestleBowerSalesReportInvoice) {
            $this->addNestleBowerSalesReportInvoice($nestleBowerSalesReportInvoice);
        }

        $this->collNestleBowerSalesReportInvoices = $nestleBowerSalesReportInvoices;
        $this->collNestleBowerSalesReportInvoicesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerSalesReportInvoice objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerSalesReportInvoice objects.
     * @throws PropelException
     */
    public function countNestleBowerSalesReportInvoices(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerSalesReportInvoicesPartial && !$this->isNew();
        if (null === $this->collNestleBowerSalesReportInvoices || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerSalesReportInvoices) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerSalesReportInvoices());
            }
            $query = NestleBowerSalesReportInvoiceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBowerSalesReport($this)
                ->count($con);
        }

        return count($this->collNestleBowerSalesReportInvoices);
    }

    /**
     * Method called to associate a NestleBowerSalesReportInvoice object to this object
     * through the NestleBowerSalesReportInvoice foreign key attribute.
     *
     * @param    NestleBowerSalesReportInvoice $l NestleBowerSalesReportInvoice
     * @return NestleBowerSalesReport The current object (for fluent API support)
     */
    public function addNestleBowerSalesReportInvoice(NestleBowerSalesReportInvoice $l)
    {
        if ($this->collNestleBowerSalesReportInvoices === null) {
            $this->initNestleBowerSalesReportInvoices();
            $this->collNestleBowerSalesReportInvoicesPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerSalesReportInvoices->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerSalesReportInvoice($l);

            if ($this->nestleBowerSalesReportInvoicesScheduledForDeletion and $this->nestleBowerSalesReportInvoicesScheduledForDeletion->contains($l)) {
                $this->nestleBowerSalesReportInvoicesScheduledForDeletion->remove($this->nestleBowerSalesReportInvoicesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerSalesReportInvoice $nestleBowerSalesReportInvoice The nestleBowerSalesReportInvoice object to add.
     */
    protected function doAddNestleBowerSalesReportInvoice($nestleBowerSalesReportInvoice)
    {
        $this->collNestleBowerSalesReportInvoices[]= $nestleBowerSalesReportInvoice;
        $nestleBowerSalesReportInvoice->setNestleBowerSalesReport($this);
    }

    /**
     * @param	NestleBowerSalesReportInvoice $nestleBowerSalesReportInvoice The nestleBowerSalesReportInvoice object to remove.
     * @return NestleBowerSalesReport The current object (for fluent API support)
     */
    public function removeNestleBowerSalesReportInvoice($nestleBowerSalesReportInvoice)
    {
        if ($this->getNestleBowerSalesReportInvoices()->contains($nestleBowerSalesReportInvoice)) {
            $this->collNestleBowerSalesReportInvoices->remove($this->collNestleBowerSalesReportInvoices->search($nestleBowerSalesReportInvoice));
            if (null === $this->nestleBowerSalesReportInvoicesScheduledForDeletion) {
                $this->nestleBowerSalesReportInvoicesScheduledForDeletion = clone $this->collNestleBowerSalesReportInvoices;
                $this->nestleBowerSalesReportInvoicesScheduledForDeletion->clear();
            }
            $this->nestleBowerSalesReportInvoicesScheduledForDeletion[]= $nestleBowerSalesReportInvoice;
            $nestleBowerSalesReportInvoice->setNestleBowerSalesReport(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NestleBowerSalesReport is new, it will return
     * an empty collection; or if this NestleBowerSalesReport has previously
     * been saved, it will retrieve related NestleBowerSalesReportInvoices from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NestleBowerSalesReport.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NestleBowerSalesReportInvoice[] List of NestleBowerSalesReportInvoice objects
     */
    public function getNestleBowerSalesReportInvoicesJoinNestleBowerInvoices($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NestleBowerSalesReportInvoiceQuery::create(null, $criteria);
        $query->joinWith('NestleBowerInvoices', $join_behavior);

        return $this->getNestleBowerSalesReportInvoices($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->bower_id = null;
        $this->total_sales = null;
        $this->total_skus = null;
        $this->date = null;
        $this->status = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collNestleBowerSalesReportInvoices) {
                foreach ($this->collNestleBowerSalesReportInvoices as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aNestleBower instanceof Persistent) {
              $this->aNestleBower->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collNestleBowerSalesReportInvoices instanceof PropelCollection) {
            $this->collNestleBowerSalesReportInvoices->clearIterator();
        }
        $this->collNestleBowerSalesReportInvoices = null;
        $this->aNestleBower = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NestleBowerSalesReportPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
