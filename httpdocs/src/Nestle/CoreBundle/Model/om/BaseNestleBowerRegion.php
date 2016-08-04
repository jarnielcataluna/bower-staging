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
use Nestle\CoreBundle\Model\NestleBowerPromos;
use Nestle\CoreBundle\Model\NestleBowerPromosQuery;
use Nestle\CoreBundle\Model\NestleBowerProvince;
use Nestle\CoreBundle\Model\NestleBowerProvinceQuery;
use Nestle\CoreBundle\Model\NestleBowerRegion;
use Nestle\CoreBundle\Model\NestleBowerRegionPeer;
use Nestle\CoreBundle\Model\NestleBowerRegionQuery;

abstract class BaseNestleBowerRegion extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Nestle\\CoreBundle\\Model\\NestleBowerRegionPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NestleBowerRegionPeer
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
     * The value for the region field.
     * @var        string
     */
    protected $region;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * @var        PropelObjectCollection|NestleBowerProvince[] Collection to store aggregation of NestleBowerProvince objects.
     */
    protected $collNestleBowerProvinces;
    protected $collNestleBowerProvincesPartial;

    /**
     * @var        PropelObjectCollection|NestleBowerPromos[] Collection to store aggregation of NestleBowerPromos objects.
     */
    protected $collNestleBowerPromoss;
    protected $collNestleBowerPromossPartial;

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
    protected $nestleBowerProvincesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nestleBowerPromossScheduledForDeletion = null;

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
     * Get the [region] column value.
     *
     * @return string
     */
    public function getRegion()
    {

        return $this->region;
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
     * @return NestleBowerRegion The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NestleBowerRegionPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [region] column.
     *
     * @param  string $v new value
     * @return NestleBowerRegion The current object (for fluent API support)
     */
    public function setRegion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->region !== $v) {
            $this->region = $v;
            $this->modifiedColumns[] = NestleBowerRegionPeer::REGION;
        }


        return $this;
    } // setRegion()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return NestleBowerRegion The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = NestleBowerRegionPeer::STATUS;
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
            $this->region = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->status = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 3; // 3 = NestleBowerRegionPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating NestleBowerRegion object", $e);
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
            $con = Propel::getConnection(NestleBowerRegionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NestleBowerRegionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collNestleBowerProvinces = null;

            $this->collNestleBowerPromoss = null;

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
            $con = Propel::getConnection(NestleBowerRegionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NestleBowerRegionQuery::create()
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
            $con = Propel::getConnection(NestleBowerRegionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                NestleBowerRegionPeer::addInstanceToPool($this);
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

            if ($this->nestleBowerProvincesScheduledForDeletion !== null) {
                if (!$this->nestleBowerProvincesScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerProvincesScheduledForDeletion as $nestleBowerProvince) {
                        // need to save related object because we set the relation to null
                        $nestleBowerProvince->save($con);
                    }
                    $this->nestleBowerProvincesScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerProvinces !== null) {
                foreach ($this->collNestleBowerProvinces as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nestleBowerPromossScheduledForDeletion !== null) {
                if (!$this->nestleBowerPromossScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerPromossScheduledForDeletion as $nestleBowerPromos) {
                        // need to save related object because we set the relation to null
                        $nestleBowerPromos->save($con);
                    }
                    $this->nestleBowerPromossScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerPromoss !== null) {
                foreach ($this->collNestleBowerPromoss as $referrerFK) {
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

        $this->modifiedColumns[] = NestleBowerRegionPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NestleBowerRegionPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NestleBowerRegionPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(NestleBowerRegionPeer::REGION)) {
            $modifiedColumns[':p' . $index++]  = '`region`';
        }
        if ($this->isColumnModified(NestleBowerRegionPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }

        $sql = sprintf(
            'INSERT INTO `region` (%s) VALUES (%s)',
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
                    case '`region`':
                        $stmt->bindValue($identifier, $this->region, PDO::PARAM_STR);
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


            if (($retval = NestleBowerRegionPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collNestleBowerProvinces !== null) {
                    foreach ($this->collNestleBowerProvinces as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNestleBowerPromoss !== null) {
                    foreach ($this->collNestleBowerPromoss as $referrerFK) {
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
        $pos = NestleBowerRegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getRegion();
                break;
            case 2:
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
        if (isset($alreadyDumpedObjects['NestleBowerRegion'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NestleBowerRegion'][$this->getPrimaryKey()] = true;
        $keys = NestleBowerRegionPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getRegion(),
            $keys[2] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collNestleBowerProvinces) {
                $result['NestleBowerProvinces'] = $this->collNestleBowerProvinces->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNestleBowerPromoss) {
                $result['NestleBowerPromoss'] = $this->collNestleBowerPromoss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = NestleBowerRegionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setRegion($value);
                break;
            case 2:
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
        $keys = NestleBowerRegionPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setRegion($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setStatus($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NestleBowerRegionPeer::DATABASE_NAME);

        if ($this->isColumnModified(NestleBowerRegionPeer::ID)) $criteria->add(NestleBowerRegionPeer::ID, $this->id);
        if ($this->isColumnModified(NestleBowerRegionPeer::REGION)) $criteria->add(NestleBowerRegionPeer::REGION, $this->region);
        if ($this->isColumnModified(NestleBowerRegionPeer::STATUS)) $criteria->add(NestleBowerRegionPeer::STATUS, $this->status);

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
        $criteria = new Criteria(NestleBowerRegionPeer::DATABASE_NAME);
        $criteria->add(NestleBowerRegionPeer::ID, $this->id);

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
     * @param object $copyObj An object of NestleBowerRegion (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setRegion($this->getRegion());
        $copyObj->setStatus($this->getStatus());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getNestleBowerProvinces() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerProvince($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNestleBowerPromoss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerPromos($relObj->copy($deepCopy));
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
     * @return NestleBowerRegion Clone of current object.
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
     * @return NestleBowerRegionPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NestleBowerRegionPeer();
        }

        return self::$peer;
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
        if ('NestleBowerProvince' == $relationName) {
            $this->initNestleBowerProvinces();
        }
        if ('NestleBowerPromos' == $relationName) {
            $this->initNestleBowerPromoss();
        }
    }

    /**
     * Clears out the collNestleBowerProvinces collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerRegion The current object (for fluent API support)
     * @see        addNestleBowerProvinces()
     */
    public function clearNestleBowerProvinces()
    {
        $this->collNestleBowerProvinces = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerProvincesPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerProvinces collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerProvinces($v = true)
    {
        $this->collNestleBowerProvincesPartial = $v;
    }

    /**
     * Initializes the collNestleBowerProvinces collection.
     *
     * By default this just sets the collNestleBowerProvinces collection to an empty array (like clearcollNestleBowerProvinces());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerProvinces($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerProvinces && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerProvinces = new PropelObjectCollection();
        $this->collNestleBowerProvinces->setModel('NestleBowerProvince');
    }

    /**
     * Gets an array of NestleBowerProvince objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBowerRegion is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerProvince[] List of NestleBowerProvince objects
     * @throws PropelException
     */
    public function getNestleBowerProvinces($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerProvincesPartial && !$this->isNew();
        if (null === $this->collNestleBowerProvinces || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerProvinces) {
                // return empty collection
                $this->initNestleBowerProvinces();
            } else {
                $collNestleBowerProvinces = NestleBowerProvinceQuery::create(null, $criteria)
                    ->filterByNestleBowerRegion($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerProvincesPartial && count($collNestleBowerProvinces)) {
                      $this->initNestleBowerProvinces(false);

                      foreach ($collNestleBowerProvinces as $obj) {
                        if (false == $this->collNestleBowerProvinces->contains($obj)) {
                          $this->collNestleBowerProvinces->append($obj);
                        }
                      }

                      $this->collNestleBowerProvincesPartial = true;
                    }

                    $collNestleBowerProvinces->getInternalIterator()->rewind();

                    return $collNestleBowerProvinces;
                }

                if ($partial && $this->collNestleBowerProvinces) {
                    foreach ($this->collNestleBowerProvinces as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerProvinces[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerProvinces = $collNestleBowerProvinces;
                $this->collNestleBowerProvincesPartial = false;
            }
        }

        return $this->collNestleBowerProvinces;
    }

    /**
     * Sets a collection of NestleBowerProvince objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerProvinces A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBowerRegion The current object (for fluent API support)
     */
    public function setNestleBowerProvinces(PropelCollection $nestleBowerProvinces, PropelPDO $con = null)
    {
        $nestleBowerProvincesToDelete = $this->getNestleBowerProvinces(new Criteria(), $con)->diff($nestleBowerProvinces);


        $this->nestleBowerProvincesScheduledForDeletion = $nestleBowerProvincesToDelete;

        foreach ($nestleBowerProvincesToDelete as $nestleBowerProvinceRemoved) {
            $nestleBowerProvinceRemoved->setNestleBowerRegion(null);
        }

        $this->collNestleBowerProvinces = null;
        foreach ($nestleBowerProvinces as $nestleBowerProvince) {
            $this->addNestleBowerProvince($nestleBowerProvince);
        }

        $this->collNestleBowerProvinces = $nestleBowerProvinces;
        $this->collNestleBowerProvincesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerProvince objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerProvince objects.
     * @throws PropelException
     */
    public function countNestleBowerProvinces(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerProvincesPartial && !$this->isNew();
        if (null === $this->collNestleBowerProvinces || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerProvinces) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerProvinces());
            }
            $query = NestleBowerProvinceQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBowerRegion($this)
                ->count($con);
        }

        return count($this->collNestleBowerProvinces);
    }

    /**
     * Method called to associate a NestleBowerProvince object to this object
     * through the NestleBowerProvince foreign key attribute.
     *
     * @param    NestleBowerProvince $l NestleBowerProvince
     * @return NestleBowerRegion The current object (for fluent API support)
     */
    public function addNestleBowerProvince(NestleBowerProvince $l)
    {
        if ($this->collNestleBowerProvinces === null) {
            $this->initNestleBowerProvinces();
            $this->collNestleBowerProvincesPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerProvinces->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerProvince($l);

            if ($this->nestleBowerProvincesScheduledForDeletion and $this->nestleBowerProvincesScheduledForDeletion->contains($l)) {
                $this->nestleBowerProvincesScheduledForDeletion->remove($this->nestleBowerProvincesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerProvince $nestleBowerProvince The nestleBowerProvince object to add.
     */
    protected function doAddNestleBowerProvince($nestleBowerProvince)
    {
        $this->collNestleBowerProvinces[]= $nestleBowerProvince;
        $nestleBowerProvince->setNestleBowerRegion($this);
    }

    /**
     * @param	NestleBowerProvince $nestleBowerProvince The nestleBowerProvince object to remove.
     * @return NestleBowerRegion The current object (for fluent API support)
     */
    public function removeNestleBowerProvince($nestleBowerProvince)
    {
        if ($this->getNestleBowerProvinces()->contains($nestleBowerProvince)) {
            $this->collNestleBowerProvinces->remove($this->collNestleBowerProvinces->search($nestleBowerProvince));
            if (null === $this->nestleBowerProvincesScheduledForDeletion) {
                $this->nestleBowerProvincesScheduledForDeletion = clone $this->collNestleBowerProvinces;
                $this->nestleBowerProvincesScheduledForDeletion->clear();
            }
            $this->nestleBowerProvincesScheduledForDeletion[]= $nestleBowerProvince;
            $nestleBowerProvince->setNestleBowerRegion(null);
        }

        return $this;
    }

    /**
     * Clears out the collNestleBowerPromoss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerRegion The current object (for fluent API support)
     * @see        addNestleBowerPromoss()
     */
    public function clearNestleBowerPromoss()
    {
        $this->collNestleBowerPromoss = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerPromossPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerPromoss collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerPromoss($v = true)
    {
        $this->collNestleBowerPromossPartial = $v;
    }

    /**
     * Initializes the collNestleBowerPromoss collection.
     *
     * By default this just sets the collNestleBowerPromoss collection to an empty array (like clearcollNestleBowerPromoss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerPromoss($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerPromoss && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerPromoss = new PropelObjectCollection();
        $this->collNestleBowerPromoss->setModel('NestleBowerPromos');
    }

    /**
     * Gets an array of NestleBowerPromos objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBowerRegion is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerPromos[] List of NestleBowerPromos objects
     * @throws PropelException
     */
    public function getNestleBowerPromoss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerPromossPartial && !$this->isNew();
        if (null === $this->collNestleBowerPromoss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerPromoss) {
                // return empty collection
                $this->initNestleBowerPromoss();
            } else {
                $collNestleBowerPromoss = NestleBowerPromosQuery::create(null, $criteria)
                    ->filterByNestleBowerRegion($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerPromossPartial && count($collNestleBowerPromoss)) {
                      $this->initNestleBowerPromoss(false);

                      foreach ($collNestleBowerPromoss as $obj) {
                        if (false == $this->collNestleBowerPromoss->contains($obj)) {
                          $this->collNestleBowerPromoss->append($obj);
                        }
                      }

                      $this->collNestleBowerPromossPartial = true;
                    }

                    $collNestleBowerPromoss->getInternalIterator()->rewind();

                    return $collNestleBowerPromoss;
                }

                if ($partial && $this->collNestleBowerPromoss) {
                    foreach ($this->collNestleBowerPromoss as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerPromoss[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerPromoss = $collNestleBowerPromoss;
                $this->collNestleBowerPromossPartial = false;
            }
        }

        return $this->collNestleBowerPromoss;
    }

    /**
     * Sets a collection of NestleBowerPromos objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerPromoss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBowerRegion The current object (for fluent API support)
     */
    public function setNestleBowerPromoss(PropelCollection $nestleBowerPromoss, PropelPDO $con = null)
    {
        $nestleBowerPromossToDelete = $this->getNestleBowerPromoss(new Criteria(), $con)->diff($nestleBowerPromoss);


        $this->nestleBowerPromossScheduledForDeletion = $nestleBowerPromossToDelete;

        foreach ($nestleBowerPromossToDelete as $nestleBowerPromosRemoved) {
            $nestleBowerPromosRemoved->setNestleBowerRegion(null);
        }

        $this->collNestleBowerPromoss = null;
        foreach ($nestleBowerPromoss as $nestleBowerPromos) {
            $this->addNestleBowerPromos($nestleBowerPromos);
        }

        $this->collNestleBowerPromoss = $nestleBowerPromoss;
        $this->collNestleBowerPromossPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerPromos objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerPromos objects.
     * @throws PropelException
     */
    public function countNestleBowerPromoss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerPromossPartial && !$this->isNew();
        if (null === $this->collNestleBowerPromoss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerPromoss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerPromoss());
            }
            $query = NestleBowerPromosQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBowerRegion($this)
                ->count($con);
        }

        return count($this->collNestleBowerPromoss);
    }

    /**
     * Method called to associate a NestleBowerPromos object to this object
     * through the NestleBowerPromos foreign key attribute.
     *
     * @param    NestleBowerPromos $l NestleBowerPromos
     * @return NestleBowerRegion The current object (for fluent API support)
     */
    public function addNestleBowerPromos(NestleBowerPromos $l)
    {
        if ($this->collNestleBowerPromoss === null) {
            $this->initNestleBowerPromoss();
            $this->collNestleBowerPromossPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerPromoss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerPromos($l);

            if ($this->nestleBowerPromossScheduledForDeletion and $this->nestleBowerPromossScheduledForDeletion->contains($l)) {
                $this->nestleBowerPromossScheduledForDeletion->remove($this->nestleBowerPromossScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerPromos $nestleBowerPromos The nestleBowerPromos object to add.
     */
    protected function doAddNestleBowerPromos($nestleBowerPromos)
    {
        $this->collNestleBowerPromoss[]= $nestleBowerPromos;
        $nestleBowerPromos->setNestleBowerRegion($this);
    }

    /**
     * @param	NestleBowerPromos $nestleBowerPromos The nestleBowerPromos object to remove.
     * @return NestleBowerRegion The current object (for fluent API support)
     */
    public function removeNestleBowerPromos($nestleBowerPromos)
    {
        if ($this->getNestleBowerPromoss()->contains($nestleBowerPromos)) {
            $this->collNestleBowerPromoss->remove($this->collNestleBowerPromoss->search($nestleBowerPromos));
            if (null === $this->nestleBowerPromossScheduledForDeletion) {
                $this->nestleBowerPromossScheduledForDeletion = clone $this->collNestleBowerPromoss;
                $this->nestleBowerPromossScheduledForDeletion->clear();
            }
            $this->nestleBowerPromossScheduledForDeletion[]= $nestleBowerPromos;
            $nestleBowerPromos->setNestleBowerRegion(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NestleBowerRegion is new, it will return
     * an empty collection; or if this NestleBowerRegion has previously
     * been saved, it will retrieve related NestleBowerPromoss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NestleBowerRegion.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NestleBowerPromos[] List of NestleBowerPromos objects
     */
    public function getNestleBowerPromossJoinNestleBowerRules($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NestleBowerPromosQuery::create(null, $criteria);
        $query->joinWith('NestleBowerRules', $join_behavior);

        return $this->getNestleBowerPromoss($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->region = null;
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
            if ($this->collNestleBowerProvinces) {
                foreach ($this->collNestleBowerProvinces as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNestleBowerPromoss) {
                foreach ($this->collNestleBowerPromoss as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collNestleBowerProvinces instanceof PropelCollection) {
            $this->collNestleBowerProvinces->clearIterator();
        }
        $this->collNestleBowerProvinces = null;
        if ($this->collNestleBowerPromoss instanceof PropelCollection) {
            $this->collNestleBowerPromoss->clearIterator();
        }
        $this->collNestleBowerPromoss = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NestleBowerRegionPeer::DEFAULT_STRING_FORMAT);
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
