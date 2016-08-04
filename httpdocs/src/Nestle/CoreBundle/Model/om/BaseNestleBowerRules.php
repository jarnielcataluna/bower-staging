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
use Nestle\CoreBundle\Model\NestleBowerProduct;
use Nestle\CoreBundle\Model\NestleBowerProductQuery;
use Nestle\CoreBundle\Model\NestleBowerPromos;
use Nestle\CoreBundle\Model\NestleBowerPromosQuery;
use Nestle\CoreBundle\Model\NestleBowerRules;
use Nestle\CoreBundle\Model\NestleBowerRulesPeer;
use Nestle\CoreBundle\Model\NestleBowerRulesQuery;

abstract class BaseNestleBowerRules extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Nestle\\CoreBundle\\Model\\NestleBowerRulesPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NestleBowerRulesPeer
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
     * The value for the product_id field.
     * @var        int
     */
    protected $product_id;

    /**
     * The value for the qty_to_qualify field.
     * @var        int
     */
    protected $qty_to_qualify;

    /**
     * The value for the qty_free field.
     * @var        int
     */
    protected $qty_free;

    /**
     * The value for the promo_product_id field.
     * @var        int
     */
    protected $promo_product_id;

    /**
     * The value for the start_date field.
     * @var        string
     */
    protected $start_date;

    /**
     * The value for the end_date field.
     * @var        string
     */
    protected $end_date;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * @var        NestleBowerProduct
     */
    protected $aNestleBowerProductRelatedByProductId;

    /**
     * @var        NestleBowerProduct
     */
    protected $aNestleBowerProductRelatedByPromoProductId;

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
     * Get the [product_id] column value.
     *
     * @return int
     */
    public function getProductId()
    {

        return $this->product_id;
    }

    /**
     * Get the [qty_to_qualify] column value.
     *
     * @return int
     */
    public function getQtyToQualify()
    {

        return $this->qty_to_qualify;
    }

    /**
     * Get the [qty_free] column value.
     *
     * @return int
     */
    public function getQtyFree()
    {

        return $this->qty_free;
    }

    /**
     * Get the [promo_product_id] column value.
     *
     * @return int
     */
    public function getPromoProductId()
    {

        return $this->promo_product_id;
    }

    /**
     * Get the [start_date] column value.
     *
     * @return string
     */
    public function getStartDate()
    {

        return $this->start_date;
    }

    /**
     * Get the [end_date] column value.
     *
     * @return string
     */
    public function getEndDate()
    {

        return $this->end_date;
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
     * @return NestleBowerRules The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NestleBowerRulesPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [product_id] column.
     *
     * @param  int $v new value
     * @return NestleBowerRules The current object (for fluent API support)
     */
    public function setProductId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->product_id !== $v) {
            $this->product_id = $v;
            $this->modifiedColumns[] = NestleBowerRulesPeer::PRODUCT_ID;
        }

        if ($this->aNestleBowerProductRelatedByProductId !== null && $this->aNestleBowerProductRelatedByProductId->getId() !== $v) {
            $this->aNestleBowerProductRelatedByProductId = null;
        }


        return $this;
    } // setProductId()

    /**
     * Set the value of [qty_to_qualify] column.
     *
     * @param  int $v new value
     * @return NestleBowerRules The current object (for fluent API support)
     */
    public function setQtyToQualify($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->qty_to_qualify !== $v) {
            $this->qty_to_qualify = $v;
            $this->modifiedColumns[] = NestleBowerRulesPeer::QTY_TO_QUALIFY;
        }


        return $this;
    } // setQtyToQualify()

    /**
     * Set the value of [qty_free] column.
     *
     * @param  int $v new value
     * @return NestleBowerRules The current object (for fluent API support)
     */
    public function setQtyFree($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->qty_free !== $v) {
            $this->qty_free = $v;
            $this->modifiedColumns[] = NestleBowerRulesPeer::QTY_FREE;
        }


        return $this;
    } // setQtyFree()

    /**
     * Set the value of [promo_product_id] column.
     *
     * @param  int $v new value
     * @return NestleBowerRules The current object (for fluent API support)
     */
    public function setPromoProductId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->promo_product_id !== $v) {
            $this->promo_product_id = $v;
            $this->modifiedColumns[] = NestleBowerRulesPeer::PROMO_PRODUCT_ID;
        }

        if ($this->aNestleBowerProductRelatedByPromoProductId !== null && $this->aNestleBowerProductRelatedByPromoProductId->getId() !== $v) {
            $this->aNestleBowerProductRelatedByPromoProductId = null;
        }


        return $this;
    } // setPromoProductId()

    /**
     * Set the value of [start_date] column.
     *
     * @param  string $v new value
     * @return NestleBowerRules The current object (for fluent API support)
     */
    public function setStartDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->start_date !== $v) {
            $this->start_date = $v;
            $this->modifiedColumns[] = NestleBowerRulesPeer::START_DATE;
        }


        return $this;
    } // setStartDate()

    /**
     * Set the value of [end_date] column.
     *
     * @param  string $v new value
     * @return NestleBowerRules The current object (for fluent API support)
     */
    public function setEndDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->end_date !== $v) {
            $this->end_date = $v;
            $this->modifiedColumns[] = NestleBowerRulesPeer::END_DATE;
        }


        return $this;
    } // setEndDate()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return NestleBowerRules The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = NestleBowerRulesPeer::STATUS;
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
            $this->product_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->qty_to_qualify = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->qty_free = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->promo_product_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->start_date = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->end_date = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->status = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 8; // 8 = NestleBowerRulesPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating NestleBowerRules object", $e);
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

        if ($this->aNestleBowerProductRelatedByProductId !== null && $this->product_id !== $this->aNestleBowerProductRelatedByProductId->getId()) {
            $this->aNestleBowerProductRelatedByProductId = null;
        }
        if ($this->aNestleBowerProductRelatedByPromoProductId !== null && $this->promo_product_id !== $this->aNestleBowerProductRelatedByPromoProductId->getId()) {
            $this->aNestleBowerProductRelatedByPromoProductId = null;
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
            $con = Propel::getConnection(NestleBowerRulesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NestleBowerRulesPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aNestleBowerProductRelatedByProductId = null;
            $this->aNestleBowerProductRelatedByPromoProductId = null;
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
            $con = Propel::getConnection(NestleBowerRulesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NestleBowerRulesQuery::create()
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
            $con = Propel::getConnection(NestleBowerRulesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                NestleBowerRulesPeer::addInstanceToPool($this);
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

            if ($this->aNestleBowerProductRelatedByProductId !== null) {
                if ($this->aNestleBowerProductRelatedByProductId->isModified() || $this->aNestleBowerProductRelatedByProductId->isNew()) {
                    $affectedRows += $this->aNestleBowerProductRelatedByProductId->save($con);
                }
                $this->setNestleBowerProductRelatedByProductId($this->aNestleBowerProductRelatedByProductId);
            }

            if ($this->aNestleBowerProductRelatedByPromoProductId !== null) {
                if ($this->aNestleBowerProductRelatedByPromoProductId->isModified() || $this->aNestleBowerProductRelatedByPromoProductId->isNew()) {
                    $affectedRows += $this->aNestleBowerProductRelatedByPromoProductId->save($con);
                }
                $this->setNestleBowerProductRelatedByPromoProductId($this->aNestleBowerProductRelatedByPromoProductId);
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

        $this->modifiedColumns[] = NestleBowerRulesPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NestleBowerRulesPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NestleBowerRulesPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(NestleBowerRulesPeer::PRODUCT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`product_id`';
        }
        if ($this->isColumnModified(NestleBowerRulesPeer::QTY_TO_QUALIFY)) {
            $modifiedColumns[':p' . $index++]  = '`qty_to_qualify`';
        }
        if ($this->isColumnModified(NestleBowerRulesPeer::QTY_FREE)) {
            $modifiedColumns[':p' . $index++]  = '`qty_free`';
        }
        if ($this->isColumnModified(NestleBowerRulesPeer::PROMO_PRODUCT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`promo_product_id`';
        }
        if ($this->isColumnModified(NestleBowerRulesPeer::START_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`start_date`';
        }
        if ($this->isColumnModified(NestleBowerRulesPeer::END_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`end_date`';
        }
        if ($this->isColumnModified(NestleBowerRulesPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }

        $sql = sprintf(
            'INSERT INTO `rules` (%s) VALUES (%s)',
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
                    case '`product_id`':
                        $stmt->bindValue($identifier, $this->product_id, PDO::PARAM_INT);
                        break;
                    case '`qty_to_qualify`':
                        $stmt->bindValue($identifier, $this->qty_to_qualify, PDO::PARAM_INT);
                        break;
                    case '`qty_free`':
                        $stmt->bindValue($identifier, $this->qty_free, PDO::PARAM_INT);
                        break;
                    case '`promo_product_id`':
                        $stmt->bindValue($identifier, $this->promo_product_id, PDO::PARAM_INT);
                        break;
                    case '`start_date`':
                        $stmt->bindValue($identifier, $this->start_date, PDO::PARAM_STR);
                        break;
                    case '`end_date`':
                        $stmt->bindValue($identifier, $this->end_date, PDO::PARAM_STR);
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

            if ($this->aNestleBowerProductRelatedByProductId !== null) {
                if (!$this->aNestleBowerProductRelatedByProductId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBowerProductRelatedByProductId->getValidationFailures());
                }
            }

            if ($this->aNestleBowerProductRelatedByPromoProductId !== null) {
                if (!$this->aNestleBowerProductRelatedByPromoProductId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBowerProductRelatedByPromoProductId->getValidationFailures());
                }
            }


            if (($retval = NestleBowerRulesPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = NestleBowerRulesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getProductId();
                break;
            case 2:
                return $this->getQtyToQualify();
                break;
            case 3:
                return $this->getQtyFree();
                break;
            case 4:
                return $this->getPromoProductId();
                break;
            case 5:
                return $this->getStartDate();
                break;
            case 6:
                return $this->getEndDate();
                break;
            case 7:
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
        if (isset($alreadyDumpedObjects['NestleBowerRules'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NestleBowerRules'][$this->getPrimaryKey()] = true;
        $keys = NestleBowerRulesPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getProductId(),
            $keys[2] => $this->getQtyToQualify(),
            $keys[3] => $this->getQtyFree(),
            $keys[4] => $this->getPromoProductId(),
            $keys[5] => $this->getStartDate(),
            $keys[6] => $this->getEndDate(),
            $keys[7] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aNestleBowerProductRelatedByProductId) {
                $result['NestleBowerProductRelatedByProductId'] = $this->aNestleBowerProductRelatedByProductId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aNestleBowerProductRelatedByPromoProductId) {
                $result['NestleBowerProductRelatedByPromoProductId'] = $this->aNestleBowerProductRelatedByPromoProductId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = NestleBowerRulesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setProductId($value);
                break;
            case 2:
                $this->setQtyToQualify($value);
                break;
            case 3:
                $this->setQtyFree($value);
                break;
            case 4:
                $this->setPromoProductId($value);
                break;
            case 5:
                $this->setStartDate($value);
                break;
            case 6:
                $this->setEndDate($value);
                break;
            case 7:
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
        $keys = NestleBowerRulesPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setProductId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setQtyToQualify($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setQtyFree($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPromoProductId($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setStartDate($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEndDate($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setStatus($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NestleBowerRulesPeer::DATABASE_NAME);

        if ($this->isColumnModified(NestleBowerRulesPeer::ID)) $criteria->add(NestleBowerRulesPeer::ID, $this->id);
        if ($this->isColumnModified(NestleBowerRulesPeer::PRODUCT_ID)) $criteria->add(NestleBowerRulesPeer::PRODUCT_ID, $this->product_id);
        if ($this->isColumnModified(NestleBowerRulesPeer::QTY_TO_QUALIFY)) $criteria->add(NestleBowerRulesPeer::QTY_TO_QUALIFY, $this->qty_to_qualify);
        if ($this->isColumnModified(NestleBowerRulesPeer::QTY_FREE)) $criteria->add(NestleBowerRulesPeer::QTY_FREE, $this->qty_free);
        if ($this->isColumnModified(NestleBowerRulesPeer::PROMO_PRODUCT_ID)) $criteria->add(NestleBowerRulesPeer::PROMO_PRODUCT_ID, $this->promo_product_id);
        if ($this->isColumnModified(NestleBowerRulesPeer::START_DATE)) $criteria->add(NestleBowerRulesPeer::START_DATE, $this->start_date);
        if ($this->isColumnModified(NestleBowerRulesPeer::END_DATE)) $criteria->add(NestleBowerRulesPeer::END_DATE, $this->end_date);
        if ($this->isColumnModified(NestleBowerRulesPeer::STATUS)) $criteria->add(NestleBowerRulesPeer::STATUS, $this->status);

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
        $criteria = new Criteria(NestleBowerRulesPeer::DATABASE_NAME);
        $criteria->add(NestleBowerRulesPeer::ID, $this->id);

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
     * @param object $copyObj An object of NestleBowerRules (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setProductId($this->getProductId());
        $copyObj->setQtyToQualify($this->getQtyToQualify());
        $copyObj->setQtyFree($this->getQtyFree());
        $copyObj->setPromoProductId($this->getPromoProductId());
        $copyObj->setStartDate($this->getStartDate());
        $copyObj->setEndDate($this->getEndDate());
        $copyObj->setStatus($this->getStatus());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

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
     * @return NestleBowerRules Clone of current object.
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
     * @return NestleBowerRulesPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NestleBowerRulesPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a NestleBowerProduct object.
     *
     * @param                  NestleBowerProduct $v
     * @return NestleBowerRules The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleBowerProductRelatedByProductId(NestleBowerProduct $v = null)
    {
        if ($v === null) {
            $this->setProductId(NULL);
        } else {
            $this->setProductId($v->getId());
        }

        $this->aNestleBowerProductRelatedByProductId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleBowerProduct object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBowerRulesRelatedByProductId($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleBowerProduct object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleBowerProduct The associated NestleBowerProduct object.
     * @throws PropelException
     */
    public function getNestleBowerProductRelatedByProductId(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleBowerProductRelatedByProductId === null && ($this->product_id !== null) && $doQuery) {
            $this->aNestleBowerProductRelatedByProductId = NestleBowerProductQuery::create()->findPk($this->product_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleBowerProductRelatedByProductId->addNestleBowerRulessRelatedByProductId($this);
             */
        }

        return $this->aNestleBowerProductRelatedByProductId;
    }

    /**
     * Declares an association between this object and a NestleBowerProduct object.
     *
     * @param                  NestleBowerProduct $v
     * @return NestleBowerRules The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleBowerProductRelatedByPromoProductId(NestleBowerProduct $v = null)
    {
        if ($v === null) {
            $this->setPromoProductId(NULL);
        } else {
            $this->setPromoProductId($v->getId());
        }

        $this->aNestleBowerProductRelatedByPromoProductId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleBowerProduct object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBowerRulesRelatedByPromoProductId($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleBowerProduct object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleBowerProduct The associated NestleBowerProduct object.
     * @throws PropelException
     */
    public function getNestleBowerProductRelatedByPromoProductId(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleBowerProductRelatedByPromoProductId === null && ($this->promo_product_id !== null) && $doQuery) {
            $this->aNestleBowerProductRelatedByPromoProductId = NestleBowerProductQuery::create()->findPk($this->promo_product_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleBowerProductRelatedByPromoProductId->addNestleBowerRulessRelatedByPromoProductId($this);
             */
        }

        return $this->aNestleBowerProductRelatedByPromoProductId;
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
        if ('NestleBowerPromos' == $relationName) {
            $this->initNestleBowerPromoss();
        }
    }

    /**
     * Clears out the collNestleBowerPromoss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerRules The current object (for fluent API support)
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
     * If this NestleBowerRules is new, it will return
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
                    ->filterByNestleBowerRules($this)
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
     * @return NestleBowerRules The current object (for fluent API support)
     */
    public function setNestleBowerPromoss(PropelCollection $nestleBowerPromoss, PropelPDO $con = null)
    {
        $nestleBowerPromossToDelete = $this->getNestleBowerPromoss(new Criteria(), $con)->diff($nestleBowerPromoss);


        $this->nestleBowerPromossScheduledForDeletion = $nestleBowerPromossToDelete;

        foreach ($nestleBowerPromossToDelete as $nestleBowerPromosRemoved) {
            $nestleBowerPromosRemoved->setNestleBowerRules(null);
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
                ->filterByNestleBowerRules($this)
                ->count($con);
        }

        return count($this->collNestleBowerPromoss);
    }

    /**
     * Method called to associate a NestleBowerPromos object to this object
     * through the NestleBowerPromos foreign key attribute.
     *
     * @param    NestleBowerPromos $l NestleBowerPromos
     * @return NestleBowerRules The current object (for fluent API support)
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
        $nestleBowerPromos->setNestleBowerRules($this);
    }

    /**
     * @param	NestleBowerPromos $nestleBowerPromos The nestleBowerPromos object to remove.
     * @return NestleBowerRules The current object (for fluent API support)
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
            $nestleBowerPromos->setNestleBowerRules(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NestleBowerRules is new, it will return
     * an empty collection; or if this NestleBowerRules has previously
     * been saved, it will retrieve related NestleBowerPromoss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NestleBowerRules.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NestleBowerPromos[] List of NestleBowerPromos objects
     */
    public function getNestleBowerPromossJoinNestleBowerRegion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NestleBowerPromosQuery::create(null, $criteria);
        $query->joinWith('NestleBowerRegion', $join_behavior);

        return $this->getNestleBowerPromoss($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->product_id = null;
        $this->qty_to_qualify = null;
        $this->qty_free = null;
        $this->promo_product_id = null;
        $this->start_date = null;
        $this->end_date = null;
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
            if ($this->collNestleBowerPromoss) {
                foreach ($this->collNestleBowerPromoss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aNestleBowerProductRelatedByProductId instanceof Persistent) {
              $this->aNestleBowerProductRelatedByProductId->clearAllReferences($deep);
            }
            if ($this->aNestleBowerProductRelatedByPromoProductId instanceof Persistent) {
              $this->aNestleBowerProductRelatedByPromoProductId->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collNestleBowerPromoss instanceof PropelCollection) {
            $this->collNestleBowerPromoss->clearIterator();
        }
        $this->collNestleBowerPromoss = null;
        $this->aNestleBowerProductRelatedByProductId = null;
        $this->aNestleBowerProductRelatedByPromoProductId = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NestleBowerRulesPeer::DEFAULT_STRING_FORMAT);
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
