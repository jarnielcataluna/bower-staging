<?php

namespace Nestle\CoreBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelException;
use \PropelPDO;
use Nestle\CoreBundle\Model\NestleBowerInvoices;
use Nestle\CoreBundle\Model\NestleBowerInvoicesQuery;
use Nestle\CoreBundle\Model\NestleBowerSalesReport;
use Nestle\CoreBundle\Model\NestleBowerSalesReportInvoice;
use Nestle\CoreBundle\Model\NestleBowerSalesReportInvoicePeer;
use Nestle\CoreBundle\Model\NestleBowerSalesReportInvoiceQuery;
use Nestle\CoreBundle\Model\NestleBowerSalesReportQuery;

abstract class BaseNestleBowerSalesReportInvoice extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Nestle\\CoreBundle\\Model\\NestleBowerSalesReportInvoicePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NestleBowerSalesReportInvoicePeer
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
     * The value for the sales_report_id field.
     * @var        int
     */
    protected $sales_report_id;

    /**
     * The value for the invoice_id field.
     * @var        int
     */
    protected $invoice_id;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * @var        NestleBowerSalesReport
     */
    protected $aNestleBowerSalesReport;

    /**
     * @var        NestleBowerInvoices
     */
    protected $aNestleBowerInvoices;

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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [sales_report_id] column value.
     *
     * @return int
     */
    public function getSalesReportId()
    {

        return $this->sales_report_id;
    }

    /**
     * Get the [invoice_id] column value.
     *
     * @return int
     */
    public function getInvoiceId()
    {

        return $this->invoice_id;
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
     * @return NestleBowerSalesReportInvoice The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportInvoicePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [sales_report_id] column.
     *
     * @param  int $v new value
     * @return NestleBowerSalesReportInvoice The current object (for fluent API support)
     */
    public function setSalesReportId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->sales_report_id !== $v) {
            $this->sales_report_id = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportInvoicePeer::SALES_REPORT_ID;
        }

        if ($this->aNestleBowerSalesReport !== null && $this->aNestleBowerSalesReport->getId() !== $v) {
            $this->aNestleBowerSalesReport = null;
        }


        return $this;
    } // setSalesReportId()

    /**
     * Set the value of [invoice_id] column.
     *
     * @param  int $v new value
     * @return NestleBowerSalesReportInvoice The current object (for fluent API support)
     */
    public function setInvoiceId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->invoice_id !== $v) {
            $this->invoice_id = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportInvoicePeer::INVOICE_ID;
        }

        if ($this->aNestleBowerInvoices !== null && $this->aNestleBowerInvoices->getId() !== $v) {
            $this->aNestleBowerInvoices = null;
        }


        return $this;
    } // setInvoiceId()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return NestleBowerSalesReportInvoice The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = NestleBowerSalesReportInvoicePeer::STATUS;
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
            $this->sales_report_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->invoice_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->status = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 4; // 4 = NestleBowerSalesReportInvoicePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating NestleBowerSalesReportInvoice object", $e);
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

        if ($this->aNestleBowerSalesReport !== null && $this->sales_report_id !== $this->aNestleBowerSalesReport->getId()) {
            $this->aNestleBowerSalesReport = null;
        }
        if ($this->aNestleBowerInvoices !== null && $this->invoice_id !== $this->aNestleBowerInvoices->getId()) {
            $this->aNestleBowerInvoices = null;
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
            $con = Propel::getConnection(NestleBowerSalesReportInvoicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NestleBowerSalesReportInvoicePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aNestleBowerSalesReport = null;
            $this->aNestleBowerInvoices = null;
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
            $con = Propel::getConnection(NestleBowerSalesReportInvoicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NestleBowerSalesReportInvoiceQuery::create()
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
            $con = Propel::getConnection(NestleBowerSalesReportInvoicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                NestleBowerSalesReportInvoicePeer::addInstanceToPool($this);
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

            if ($this->aNestleBowerSalesReport !== null) {
                if ($this->aNestleBowerSalesReport->isModified() || $this->aNestleBowerSalesReport->isNew()) {
                    $affectedRows += $this->aNestleBowerSalesReport->save($con);
                }
                $this->setNestleBowerSalesReport($this->aNestleBowerSalesReport);
            }

            if ($this->aNestleBowerInvoices !== null) {
                if ($this->aNestleBowerInvoices->isModified() || $this->aNestleBowerInvoices->isNew()) {
                    $affectedRows += $this->aNestleBowerInvoices->save($con);
                }
                $this->setNestleBowerInvoices($this->aNestleBowerInvoices);
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

        $this->modifiedColumns[] = NestleBowerSalesReportInvoicePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NestleBowerSalesReportInvoicePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NestleBowerSalesReportInvoicePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(NestleBowerSalesReportInvoicePeer::SALES_REPORT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`sales_report_id`';
        }
        if ($this->isColumnModified(NestleBowerSalesReportInvoicePeer::INVOICE_ID)) {
            $modifiedColumns[':p' . $index++]  = '`invoice_id`';
        }
        if ($this->isColumnModified(NestleBowerSalesReportInvoicePeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }

        $sql = sprintf(
            'INSERT INTO `sales_report_invoice` (%s) VALUES (%s)',
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
                    case '`sales_report_id`':
                        $stmt->bindValue($identifier, $this->sales_report_id, PDO::PARAM_INT);
                        break;
                    case '`invoice_id`':
                        $stmt->bindValue($identifier, $this->invoice_id, PDO::PARAM_INT);
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

            if ($this->aNestleBowerSalesReport !== null) {
                if (!$this->aNestleBowerSalesReport->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBowerSalesReport->getValidationFailures());
                }
            }

            if ($this->aNestleBowerInvoices !== null) {
                if (!$this->aNestleBowerInvoices->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBowerInvoices->getValidationFailures());
                }
            }


            if (($retval = NestleBowerSalesReportInvoicePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = NestleBowerSalesReportInvoicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getSalesReportId();
                break;
            case 2:
                return $this->getInvoiceId();
                break;
            case 3:
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
        if (isset($alreadyDumpedObjects['NestleBowerSalesReportInvoice'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NestleBowerSalesReportInvoice'][$this->getPrimaryKey()] = true;
        $keys = NestleBowerSalesReportInvoicePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getSalesReportId(),
            $keys[2] => $this->getInvoiceId(),
            $keys[3] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aNestleBowerSalesReport) {
                $result['NestleBowerSalesReport'] = $this->aNestleBowerSalesReport->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aNestleBowerInvoices) {
                $result['NestleBowerInvoices'] = $this->aNestleBowerInvoices->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = NestleBowerSalesReportInvoicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setSalesReportId($value);
                break;
            case 2:
                $this->setInvoiceId($value);
                break;
            case 3:
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
        $keys = NestleBowerSalesReportInvoicePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setSalesReportId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setInvoiceId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setStatus($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NestleBowerSalesReportInvoicePeer::DATABASE_NAME);

        if ($this->isColumnModified(NestleBowerSalesReportInvoicePeer::ID)) $criteria->add(NestleBowerSalesReportInvoicePeer::ID, $this->id);
        if ($this->isColumnModified(NestleBowerSalesReportInvoicePeer::SALES_REPORT_ID)) $criteria->add(NestleBowerSalesReportInvoicePeer::SALES_REPORT_ID, $this->sales_report_id);
        if ($this->isColumnModified(NestleBowerSalesReportInvoicePeer::INVOICE_ID)) $criteria->add(NestleBowerSalesReportInvoicePeer::INVOICE_ID, $this->invoice_id);
        if ($this->isColumnModified(NestleBowerSalesReportInvoicePeer::STATUS)) $criteria->add(NestleBowerSalesReportInvoicePeer::STATUS, $this->status);

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
        $criteria = new Criteria(NestleBowerSalesReportInvoicePeer::DATABASE_NAME);
        $criteria->add(NestleBowerSalesReportInvoicePeer::ID, $this->id);

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
     * @param object $copyObj An object of NestleBowerSalesReportInvoice (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setSalesReportId($this->getSalesReportId());
        $copyObj->setInvoiceId($this->getInvoiceId());
        $copyObj->setStatus($this->getStatus());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

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
     * @return NestleBowerSalesReportInvoice Clone of current object.
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
     * @return NestleBowerSalesReportInvoicePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NestleBowerSalesReportInvoicePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a NestleBowerSalesReport object.
     *
     * @param                  NestleBowerSalesReport $v
     * @return NestleBowerSalesReportInvoice The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleBowerSalesReport(NestleBowerSalesReport $v = null)
    {
        if ($v === null) {
            $this->setSalesReportId(NULL);
        } else {
            $this->setSalesReportId($v->getId());
        }

        $this->aNestleBowerSalesReport = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleBowerSalesReport object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBowerSalesReportInvoice($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleBowerSalesReport object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleBowerSalesReport The associated NestleBowerSalesReport object.
     * @throws PropelException
     */
    public function getNestleBowerSalesReport(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleBowerSalesReport === null && ($this->sales_report_id !== null) && $doQuery) {
            $this->aNestleBowerSalesReport = NestleBowerSalesReportQuery::create()->findPk($this->sales_report_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleBowerSalesReport->addNestleBowerSalesReportInvoices($this);
             */
        }

        return $this->aNestleBowerSalesReport;
    }

    /**
     * Declares an association between this object and a NestleBowerInvoices object.
     *
     * @param                  NestleBowerInvoices $v
     * @return NestleBowerSalesReportInvoice The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleBowerInvoices(NestleBowerInvoices $v = null)
    {
        if ($v === null) {
            $this->setInvoiceId(NULL);
        } else {
            $this->setInvoiceId($v->getId());
        }

        $this->aNestleBowerInvoices = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleBowerInvoices object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBowerSalesReportInvoice($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleBowerInvoices object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleBowerInvoices The associated NestleBowerInvoices object.
     * @throws PropelException
     */
    public function getNestleBowerInvoices(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleBowerInvoices === null && ($this->invoice_id !== null) && $doQuery) {
            $this->aNestleBowerInvoices = NestleBowerInvoicesQuery::create()->findPk($this->invoice_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleBowerInvoices->addNestleBowerSalesReportInvoices($this);
             */
        }

        return $this->aNestleBowerInvoices;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->sales_report_id = null;
        $this->invoice_id = null;
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
            if ($this->aNestleBowerSalesReport instanceof Persistent) {
              $this->aNestleBowerSalesReport->clearAllReferences($deep);
            }
            if ($this->aNestleBowerInvoices instanceof Persistent) {
              $this->aNestleBowerInvoices->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aNestleBowerSalesReport = null;
        $this->aNestleBowerInvoices = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NestleBowerSalesReportInvoicePeer::DEFAULT_STRING_FORMAT);
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
