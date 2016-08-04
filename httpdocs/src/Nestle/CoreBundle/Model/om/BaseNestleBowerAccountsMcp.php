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
use Nestle\CoreBundle\Model\NestleBowerAccount;
use Nestle\CoreBundle\Model\NestleBowerAccountQuery;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcp;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcpPeer;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcpQuery;
use Nestle\CoreBundle\Model\NestleBowerArea;
use Nestle\CoreBundle\Model\NestleBowerAreaQuery;
use Nestle\CoreBundle\Model\NestleBowerCategory;
use Nestle\CoreBundle\Model\NestleBowerCategoryQuery;
use Nestle\CoreBundle\Model\NestleBowerCity;
use Nestle\CoreBundle\Model\NestleBowerCityQuery;
use Nestle\CoreBundle\Model\NestleBowerInvoices;
use Nestle\CoreBundle\Model\NestleBowerInvoicesQuery;

abstract class BaseNestleBowerAccountsMcp extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Nestle\\CoreBundle\\Model\\NestleBowerAccountsMcpPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NestleBowerAccountsMcpPeer
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
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the contact_person field.
     * @var        string
     */
    protected $contact_person;

    /**
     * The value for the contact_number field.
     * @var        string
     */
    protected $contact_number;

    /**
     * The value for the address field.
     * @var        string
     */
    protected $address;

    /**
     * The value for the latitude field.
     * @var        string
     */
    protected $latitude;

    /**
     * The value for the longitude field.
     * @var        string
     */
    protected $longitude;

    /**
     * The value for the best_from field.
     * @var        string
     */
    protected $best_from;

    /**
     * The value for the best_to field.
     * @var        string
     */
    protected $best_to;

    /**
     * The value for the area_id field.
     * @var        int
     */
    protected $area_id;

    /**
     * The value for the city_id field.
     * @var        int
     */
    protected $city_id;

    /**
     * The value for the frequency field.
     * @var        string
     */
    protected $frequency;

    /**
     * The value for the category_id field.
     * @var        int
     */
    protected $category_id;

    /**
     * The value for the channel field.
     * @var        string
     */
    protected $channel;

    /**
     * The value for the bracket_number field.
     * @var        string
     */
    protected $bracket_number;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * @var        NestleBowerArea
     */
    protected $aNestleBowerArea;

    /**
     * @var        NestleBowerCity
     */
    protected $aNestleBowerCity;

    /**
     * @var        NestleBowerCategory
     */
    protected $aNestleBowerCategory;

    /**
     * @var        PropelObjectCollection|NestleBowerAccount[] Collection to store aggregation of NestleBowerAccount objects.
     */
    protected $collNestleBowerAccounts;
    protected $collNestleBowerAccountsPartial;

    /**
     * @var        PropelObjectCollection|NestleBowerInvoices[] Collection to store aggregation of NestleBowerInvoices objects.
     */
    protected $collNestleBowerInvoicess;
    protected $collNestleBowerInvoicessPartial;

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
    protected $nestleBowerAccountsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nestleBowerInvoicessScheduledForDeletion = null;

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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the [contact_person] column value.
     *
     * @return string
     */
    public function getContactPerson()
    {

        return $this->contact_person;
    }

    /**
     * Get the [contact_number] column value.
     *
     * @return string
     */
    public function getContactNumber()
    {

        return $this->contact_number;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {

        return $this->address;
    }

    /**
     * Get the [latitude] column value.
     *
     * @return string
     */
    public function getLatitude()
    {

        return $this->latitude;
    }

    /**
     * Get the [longitude] column value.
     *
     * @return string
     */
    public function getLongitude()
    {

        return $this->longitude;
    }

    /**
     * Get the [best_from] column value.
     *
     * @return string
     */
    public function getBestFrom()
    {

        return $this->best_from;
    }

    /**
     * Get the [best_to] column value.
     *
     * @return string
     */
    public function getBestTo()
    {

        return $this->best_to;
    }

    /**
     * Get the [area_id] column value.
     *
     * @return int
     */
    public function getAreaId()
    {

        return $this->area_id;
    }

    /**
     * Get the [city_id] column value.
     *
     * @return int
     */
    public function getCityId()
    {

        return $this->city_id;
    }

    /**
     * Get the [frequency] column value.
     *
     * @return string
     */
    public function getFrequency()
    {

        return $this->frequency;
    }

    /**
     * Get the [category_id] column value.
     *
     * @return int
     */
    public function getCategoryId()
    {

        return $this->category_id;
    }

    /**
     * Get the [channel] column value.
     *
     * @return string
     */
    public function getChannel()
    {

        return $this->channel;
    }

    /**
     * Get the [bracket_number] column value.
     *
     * @return string
     */
    public function getBracketNumber()
    {

        return $this->bracket_number;
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
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [contact_person] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setContactPerson($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact_person !== $v) {
            $this->contact_person = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::CONTACT_PERSON;
        }


        return $this;
    } // setContactPerson()

    /**
     * Set the value of [contact_number] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setContactNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact_number !== $v) {
            $this->contact_number = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::CONTACT_NUMBER;
        }


        return $this;
    } // setContactNumber()

    /**
     * Set the value of [address] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::ADDRESS;
        }


        return $this;
    } // setAddress()

    /**
     * Set the value of [latitude] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setLatitude($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->latitude !== $v) {
            $this->latitude = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::LATITUDE;
        }


        return $this;
    } // setLatitude()

    /**
     * Set the value of [longitude] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setLongitude($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->longitude !== $v) {
            $this->longitude = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::LONGITUDE;
        }


        return $this;
    } // setLongitude()

    /**
     * Set the value of [best_from] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setBestFrom($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->best_from !== $v) {
            $this->best_from = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::BEST_FROM;
        }


        return $this;
    } // setBestFrom()

    /**
     * Set the value of [best_to] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setBestTo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->best_to !== $v) {
            $this->best_to = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::BEST_TO;
        }


        return $this;
    } // setBestTo()

    /**
     * Set the value of [area_id] column.
     *
     * @param  int $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setAreaId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->area_id !== $v) {
            $this->area_id = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::AREA_ID;
        }

        if ($this->aNestleBowerArea !== null && $this->aNestleBowerArea->getId() !== $v) {
            $this->aNestleBowerArea = null;
        }


        return $this;
    } // setAreaId()

    /**
     * Set the value of [city_id] column.
     *
     * @param  int $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setCityId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->city_id !== $v) {
            $this->city_id = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::CITY_ID;
        }

        if ($this->aNestleBowerCity !== null && $this->aNestleBowerCity->getId() !== $v) {
            $this->aNestleBowerCity = null;
        }


        return $this;
    } // setCityId()

    /**
     * Set the value of [frequency] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setFrequency($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->frequency !== $v) {
            $this->frequency = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::FREQUENCY;
        }


        return $this;
    } // setFrequency()

    /**
     * Set the value of [category_id] column.
     *
     * @param  int $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setCategoryId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->category_id !== $v) {
            $this->category_id = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::CATEGORY_ID;
        }

        if ($this->aNestleBowerCategory !== null && $this->aNestleBowerCategory->getId() !== $v) {
            $this->aNestleBowerCategory = null;
        }


        return $this;
    } // setCategoryId()

    /**
     * Set the value of [channel] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setChannel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->channel !== $v) {
            $this->channel = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::CHANNEL;
        }


        return $this;
    } // setChannel()

    /**
     * Set the value of [bracket_number] column.
     *
     * @param  string $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setBracketNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bracket_number !== $v) {
            $this->bracket_number = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::BRACKET_NUMBER;
        }


        return $this;
    } // setBracketNumber()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::STATUS;
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
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->contact_person = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->contact_number = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->address = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->latitude = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->longitude = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->best_from = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->best_to = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->area_id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->city_id = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->frequency = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->category_id = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->channel = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->bracket_number = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->status = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 16; // 16 = NestleBowerAccountsMcpPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating NestleBowerAccountsMcp object", $e);
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

        if ($this->aNestleBowerArea !== null && $this->area_id !== $this->aNestleBowerArea->getId()) {
            $this->aNestleBowerArea = null;
        }
        if ($this->aNestleBowerCity !== null && $this->city_id !== $this->aNestleBowerCity->getId()) {
            $this->aNestleBowerCity = null;
        }
        if ($this->aNestleBowerCategory !== null && $this->category_id !== $this->aNestleBowerCategory->getId()) {
            $this->aNestleBowerCategory = null;
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
            $con = Propel::getConnection(NestleBowerAccountsMcpPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NestleBowerAccountsMcpPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aNestleBowerArea = null;
            $this->aNestleBowerCity = null;
            $this->aNestleBowerCategory = null;
            $this->collNestleBowerAccounts = null;

            $this->collNestleBowerInvoicess = null;

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
            $con = Propel::getConnection(NestleBowerAccountsMcpPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NestleBowerAccountsMcpQuery::create()
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
            $con = Propel::getConnection(NestleBowerAccountsMcpPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                NestleBowerAccountsMcpPeer::addInstanceToPool($this);
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

            if ($this->aNestleBowerArea !== null) {
                if ($this->aNestleBowerArea->isModified() || $this->aNestleBowerArea->isNew()) {
                    $affectedRows += $this->aNestleBowerArea->save($con);
                }
                $this->setNestleBowerArea($this->aNestleBowerArea);
            }

            if ($this->aNestleBowerCity !== null) {
                if ($this->aNestleBowerCity->isModified() || $this->aNestleBowerCity->isNew()) {
                    $affectedRows += $this->aNestleBowerCity->save($con);
                }
                $this->setNestleBowerCity($this->aNestleBowerCity);
            }

            if ($this->aNestleBowerCategory !== null) {
                if ($this->aNestleBowerCategory->isModified() || $this->aNestleBowerCategory->isNew()) {
                    $affectedRows += $this->aNestleBowerCategory->save($con);
                }
                $this->setNestleBowerCategory($this->aNestleBowerCategory);
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

            if ($this->nestleBowerAccountsScheduledForDeletion !== null) {
                if (!$this->nestleBowerAccountsScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerAccountsScheduledForDeletion as $nestleBowerAccount) {
                        // need to save related object because we set the relation to null
                        $nestleBowerAccount->save($con);
                    }
                    $this->nestleBowerAccountsScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerAccounts !== null) {
                foreach ($this->collNestleBowerAccounts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nestleBowerInvoicessScheduledForDeletion !== null) {
                if (!$this->nestleBowerInvoicessScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerInvoicessScheduledForDeletion as $nestleBowerInvoices) {
                        // need to save related object because we set the relation to null
                        $nestleBowerInvoices->save($con);
                    }
                    $this->nestleBowerInvoicessScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerInvoicess !== null) {
                foreach ($this->collNestleBowerInvoicess as $referrerFK) {
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

        $this->modifiedColumns[] = NestleBowerAccountsMcpPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NestleBowerAccountsMcpPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CONTACT_PERSON)) {
            $modifiedColumns[':p' . $index++]  = '`contact_person`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CONTACT_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`contact_number`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = '`address`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::LATITUDE)) {
            $modifiedColumns[':p' . $index++]  = '`latitude`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::LONGITUDE)) {
            $modifiedColumns[':p' . $index++]  = '`longitude`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::BEST_FROM)) {
            $modifiedColumns[':p' . $index++]  = '`best_from`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::BEST_TO)) {
            $modifiedColumns[':p' . $index++]  = '`best_to`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::AREA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`area_id`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CITY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`city_id`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::FREQUENCY)) {
            $modifiedColumns[':p' . $index++]  = '`frequency`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`category_id`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CHANNEL)) {
            $modifiedColumns[':p' . $index++]  = '`channel`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::BRACKET_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`bracket_number`';
        }
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }

        $sql = sprintf(
            'INSERT INTO `accounts` (%s) VALUES (%s)',
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
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`contact_person`':
                        $stmt->bindValue($identifier, $this->contact_person, PDO::PARAM_STR);
                        break;
                    case '`contact_number`':
                        $stmt->bindValue($identifier, $this->contact_number, PDO::PARAM_STR);
                        break;
                    case '`address`':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case '`latitude`':
                        $stmt->bindValue($identifier, $this->latitude, PDO::PARAM_STR);
                        break;
                    case '`longitude`':
                        $stmt->bindValue($identifier, $this->longitude, PDO::PARAM_STR);
                        break;
                    case '`best_from`':
                        $stmt->bindValue($identifier, $this->best_from, PDO::PARAM_STR);
                        break;
                    case '`best_to`':
                        $stmt->bindValue($identifier, $this->best_to, PDO::PARAM_STR);
                        break;
                    case '`area_id`':
                        $stmt->bindValue($identifier, $this->area_id, PDO::PARAM_INT);
                        break;
                    case '`city_id`':
                        $stmt->bindValue($identifier, $this->city_id, PDO::PARAM_INT);
                        break;
                    case '`frequency`':
                        $stmt->bindValue($identifier, $this->frequency, PDO::PARAM_STR);
                        break;
                    case '`category_id`':
                        $stmt->bindValue($identifier, $this->category_id, PDO::PARAM_INT);
                        break;
                    case '`channel`':
                        $stmt->bindValue($identifier, $this->channel, PDO::PARAM_STR);
                        break;
                    case '`bracket_number`':
                        $stmt->bindValue($identifier, $this->bracket_number, PDO::PARAM_STR);
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

            if ($this->aNestleBowerArea !== null) {
                if (!$this->aNestleBowerArea->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBowerArea->getValidationFailures());
                }
            }

            if ($this->aNestleBowerCity !== null) {
                if (!$this->aNestleBowerCity->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBowerCity->getValidationFailures());
                }
            }

            if ($this->aNestleBowerCategory !== null) {
                if (!$this->aNestleBowerCategory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBowerCategory->getValidationFailures());
                }
            }


            if (($retval = NestleBowerAccountsMcpPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collNestleBowerAccounts !== null) {
                    foreach ($this->collNestleBowerAccounts as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNestleBowerInvoicess !== null) {
                    foreach ($this->collNestleBowerInvoicess as $referrerFK) {
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
        $pos = NestleBowerAccountsMcpPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
                return $this->getContactPerson();
                break;
            case 3:
                return $this->getContactNumber();
                break;
            case 4:
                return $this->getAddress();
                break;
            case 5:
                return $this->getLatitude();
                break;
            case 6:
                return $this->getLongitude();
                break;
            case 7:
                return $this->getBestFrom();
                break;
            case 8:
                return $this->getBestTo();
                break;
            case 9:
                return $this->getAreaId();
                break;
            case 10:
                return $this->getCityId();
                break;
            case 11:
                return $this->getFrequency();
                break;
            case 12:
                return $this->getCategoryId();
                break;
            case 13:
                return $this->getChannel();
                break;
            case 14:
                return $this->getBracketNumber();
                break;
            case 15:
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
        if (isset($alreadyDumpedObjects['NestleBowerAccountsMcp'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NestleBowerAccountsMcp'][$this->getPrimaryKey()] = true;
        $keys = NestleBowerAccountsMcpPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getContactPerson(),
            $keys[3] => $this->getContactNumber(),
            $keys[4] => $this->getAddress(),
            $keys[5] => $this->getLatitude(),
            $keys[6] => $this->getLongitude(),
            $keys[7] => $this->getBestFrom(),
            $keys[8] => $this->getBestTo(),
            $keys[9] => $this->getAreaId(),
            $keys[10] => $this->getCityId(),
            $keys[11] => $this->getFrequency(),
            $keys[12] => $this->getCategoryId(),
            $keys[13] => $this->getChannel(),
            $keys[14] => $this->getBracketNumber(),
            $keys[15] => $this->getStatus(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aNestleBowerArea) {
                $result['NestleBowerArea'] = $this->aNestleBowerArea->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aNestleBowerCity) {
                $result['NestleBowerCity'] = $this->aNestleBowerCity->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aNestleBowerCategory) {
                $result['NestleBowerCategory'] = $this->aNestleBowerCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collNestleBowerAccounts) {
                $result['NestleBowerAccounts'] = $this->collNestleBowerAccounts->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNestleBowerInvoicess) {
                $result['NestleBowerInvoicess'] = $this->collNestleBowerInvoicess->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = NestleBowerAccountsMcpPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setName($value);
                break;
            case 2:
                $this->setContactPerson($value);
                break;
            case 3:
                $this->setContactNumber($value);
                break;
            case 4:
                $this->setAddress($value);
                break;
            case 5:
                $this->setLatitude($value);
                break;
            case 6:
                $this->setLongitude($value);
                break;
            case 7:
                $this->setBestFrom($value);
                break;
            case 8:
                $this->setBestTo($value);
                break;
            case 9:
                $this->setAreaId($value);
                break;
            case 10:
                $this->setCityId($value);
                break;
            case 11:
                $this->setFrequency($value);
                break;
            case 12:
                $this->setCategoryId($value);
                break;
            case 13:
                $this->setChannel($value);
                break;
            case 14:
                $this->setBracketNumber($value);
                break;
            case 15:
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
        $keys = NestleBowerAccountsMcpPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setContactPerson($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setContactNumber($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAddress($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setLatitude($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setLongitude($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setBestFrom($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setBestTo($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setAreaId($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setCityId($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setFrequency($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setCategoryId($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setChannel($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setBracketNumber($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setStatus($arr[$keys[15]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NestleBowerAccountsMcpPeer::DATABASE_NAME);

        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::ID)) $criteria->add(NestleBowerAccountsMcpPeer::ID, $this->id);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::NAME)) $criteria->add(NestleBowerAccountsMcpPeer::NAME, $this->name);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CONTACT_PERSON)) $criteria->add(NestleBowerAccountsMcpPeer::CONTACT_PERSON, $this->contact_person);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CONTACT_NUMBER)) $criteria->add(NestleBowerAccountsMcpPeer::CONTACT_NUMBER, $this->contact_number);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::ADDRESS)) $criteria->add(NestleBowerAccountsMcpPeer::ADDRESS, $this->address);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::LATITUDE)) $criteria->add(NestleBowerAccountsMcpPeer::LATITUDE, $this->latitude);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::LONGITUDE)) $criteria->add(NestleBowerAccountsMcpPeer::LONGITUDE, $this->longitude);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::BEST_FROM)) $criteria->add(NestleBowerAccountsMcpPeer::BEST_FROM, $this->best_from);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::BEST_TO)) $criteria->add(NestleBowerAccountsMcpPeer::BEST_TO, $this->best_to);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::AREA_ID)) $criteria->add(NestleBowerAccountsMcpPeer::AREA_ID, $this->area_id);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CITY_ID)) $criteria->add(NestleBowerAccountsMcpPeer::CITY_ID, $this->city_id);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::FREQUENCY)) $criteria->add(NestleBowerAccountsMcpPeer::FREQUENCY, $this->frequency);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CATEGORY_ID)) $criteria->add(NestleBowerAccountsMcpPeer::CATEGORY_ID, $this->category_id);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::CHANNEL)) $criteria->add(NestleBowerAccountsMcpPeer::CHANNEL, $this->channel);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::BRACKET_NUMBER)) $criteria->add(NestleBowerAccountsMcpPeer::BRACKET_NUMBER, $this->bracket_number);
        if ($this->isColumnModified(NestleBowerAccountsMcpPeer::STATUS)) $criteria->add(NestleBowerAccountsMcpPeer::STATUS, $this->status);

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
        $criteria = new Criteria(NestleBowerAccountsMcpPeer::DATABASE_NAME);
        $criteria->add(NestleBowerAccountsMcpPeer::ID, $this->id);

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
     * @param object $copyObj An object of NestleBowerAccountsMcp (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setContactPerson($this->getContactPerson());
        $copyObj->setContactNumber($this->getContactNumber());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setLatitude($this->getLatitude());
        $copyObj->setLongitude($this->getLongitude());
        $copyObj->setBestFrom($this->getBestFrom());
        $copyObj->setBestTo($this->getBestTo());
        $copyObj->setAreaId($this->getAreaId());
        $copyObj->setCityId($this->getCityId());
        $copyObj->setFrequency($this->getFrequency());
        $copyObj->setCategoryId($this->getCategoryId());
        $copyObj->setChannel($this->getChannel());
        $copyObj->setBracketNumber($this->getBracketNumber());
        $copyObj->setStatus($this->getStatus());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getNestleBowerAccounts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerAccount($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNestleBowerInvoicess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerInvoices($relObj->copy($deepCopy));
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
     * @return NestleBowerAccountsMcp Clone of current object.
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
     * @return NestleBowerAccountsMcpPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NestleBowerAccountsMcpPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a NestleBowerArea object.
     *
     * @param                  NestleBowerArea $v
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleBowerArea(NestleBowerArea $v = null)
    {
        if ($v === null) {
            $this->setAreaId(NULL);
        } else {
            $this->setAreaId($v->getId());
        }

        $this->aNestleBowerArea = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleBowerArea object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBowerAccountsMcp($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleBowerArea object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleBowerArea The associated NestleBowerArea object.
     * @throws PropelException
     */
    public function getNestleBowerArea(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleBowerArea === null && ($this->area_id !== null) && $doQuery) {
            $this->aNestleBowerArea = NestleBowerAreaQuery::create()->findPk($this->area_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleBowerArea->addNestleBowerAccountsMcps($this);
             */
        }

        return $this->aNestleBowerArea;
    }

    /**
     * Declares an association between this object and a NestleBowerCity object.
     *
     * @param                  NestleBowerCity $v
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleBowerCity(NestleBowerCity $v = null)
    {
        if ($v === null) {
            $this->setCityId(NULL);
        } else {
            $this->setCityId($v->getId());
        }

        $this->aNestleBowerCity = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleBowerCity object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBowerAccountsMcp($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleBowerCity object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleBowerCity The associated NestleBowerCity object.
     * @throws PropelException
     */
    public function getNestleBowerCity(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleBowerCity === null && ($this->city_id !== null) && $doQuery) {
            $this->aNestleBowerCity = NestleBowerCityQuery::create()->findPk($this->city_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleBowerCity->addNestleBowerAccountsMcps($this);
             */
        }

        return $this->aNestleBowerCity;
    }

    /**
     * Declares an association between this object and a NestleBowerCategory object.
     *
     * @param                  NestleBowerCategory $v
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleBowerCategory(NestleBowerCategory $v = null)
    {
        if ($v === null) {
            $this->setCategoryId(NULL);
        } else {
            $this->setCategoryId($v->getId());
        }

        $this->aNestleBowerCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleBowerCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBowerAccountsMcp($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleBowerCategory object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleBowerCategory The associated NestleBowerCategory object.
     * @throws PropelException
     */
    public function getNestleBowerCategory(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleBowerCategory === null && ($this->category_id !== null) && $doQuery) {
            $this->aNestleBowerCategory = NestleBowerCategoryQuery::create()->findPk($this->category_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleBowerCategory->addNestleBowerAccountsMcps($this);
             */
        }

        return $this->aNestleBowerCategory;
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
        if ('NestleBowerAccount' == $relationName) {
            $this->initNestleBowerAccounts();
        }
        if ('NestleBowerInvoices' == $relationName) {
            $this->initNestleBowerInvoicess();
        }
    }

    /**
     * Clears out the collNestleBowerAccounts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     * @see        addNestleBowerAccounts()
     */
    public function clearNestleBowerAccounts()
    {
        $this->collNestleBowerAccounts = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerAccountsPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerAccounts collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerAccounts($v = true)
    {
        $this->collNestleBowerAccountsPartial = $v;
    }

    /**
     * Initializes the collNestleBowerAccounts collection.
     *
     * By default this just sets the collNestleBowerAccounts collection to an empty array (like clearcollNestleBowerAccounts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerAccounts($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerAccounts && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerAccounts = new PropelObjectCollection();
        $this->collNestleBowerAccounts->setModel('NestleBowerAccount');
    }

    /**
     * Gets an array of NestleBowerAccount objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBowerAccountsMcp is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerAccount[] List of NestleBowerAccount objects
     * @throws PropelException
     */
    public function getNestleBowerAccounts($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerAccountsPartial && !$this->isNew();
        if (null === $this->collNestleBowerAccounts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerAccounts) {
                // return empty collection
                $this->initNestleBowerAccounts();
            } else {
                $collNestleBowerAccounts = NestleBowerAccountQuery::create(null, $criteria)
                    ->filterByNestleBowerAccountsMcp($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerAccountsPartial && count($collNestleBowerAccounts)) {
                      $this->initNestleBowerAccounts(false);

                      foreach ($collNestleBowerAccounts as $obj) {
                        if (false == $this->collNestleBowerAccounts->contains($obj)) {
                          $this->collNestleBowerAccounts->append($obj);
                        }
                      }

                      $this->collNestleBowerAccountsPartial = true;
                    }

                    $collNestleBowerAccounts->getInternalIterator()->rewind();

                    return $collNestleBowerAccounts;
                }

                if ($partial && $this->collNestleBowerAccounts) {
                    foreach ($this->collNestleBowerAccounts as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerAccounts[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerAccounts = $collNestleBowerAccounts;
                $this->collNestleBowerAccountsPartial = false;
            }
        }

        return $this->collNestleBowerAccounts;
    }

    /**
     * Sets a collection of NestleBowerAccount objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerAccounts A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setNestleBowerAccounts(PropelCollection $nestleBowerAccounts, PropelPDO $con = null)
    {
        $nestleBowerAccountsToDelete = $this->getNestleBowerAccounts(new Criteria(), $con)->diff($nestleBowerAccounts);


        $this->nestleBowerAccountsScheduledForDeletion = $nestleBowerAccountsToDelete;

        foreach ($nestleBowerAccountsToDelete as $nestleBowerAccountRemoved) {
            $nestleBowerAccountRemoved->setNestleBowerAccountsMcp(null);
        }

        $this->collNestleBowerAccounts = null;
        foreach ($nestleBowerAccounts as $nestleBowerAccount) {
            $this->addNestleBowerAccount($nestleBowerAccount);
        }

        $this->collNestleBowerAccounts = $nestleBowerAccounts;
        $this->collNestleBowerAccountsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerAccount objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerAccount objects.
     * @throws PropelException
     */
    public function countNestleBowerAccounts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerAccountsPartial && !$this->isNew();
        if (null === $this->collNestleBowerAccounts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerAccounts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerAccounts());
            }
            $query = NestleBowerAccountQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBowerAccountsMcp($this)
                ->count($con);
        }

        return count($this->collNestleBowerAccounts);
    }

    /**
     * Method called to associate a NestleBowerAccount object to this object
     * through the NestleBowerAccount foreign key attribute.
     *
     * @param    NestleBowerAccount $l NestleBowerAccount
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function addNestleBowerAccount(NestleBowerAccount $l)
    {
        if ($this->collNestleBowerAccounts === null) {
            $this->initNestleBowerAccounts();
            $this->collNestleBowerAccountsPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerAccounts->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerAccount($l);

            if ($this->nestleBowerAccountsScheduledForDeletion and $this->nestleBowerAccountsScheduledForDeletion->contains($l)) {
                $this->nestleBowerAccountsScheduledForDeletion->remove($this->nestleBowerAccountsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerAccount $nestleBowerAccount The nestleBowerAccount object to add.
     */
    protected function doAddNestleBowerAccount($nestleBowerAccount)
    {
        $this->collNestleBowerAccounts[]= $nestleBowerAccount;
        $nestleBowerAccount->setNestleBowerAccountsMcp($this);
    }

    /**
     * @param	NestleBowerAccount $nestleBowerAccount The nestleBowerAccount object to remove.
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function removeNestleBowerAccount($nestleBowerAccount)
    {
        if ($this->getNestleBowerAccounts()->contains($nestleBowerAccount)) {
            $this->collNestleBowerAccounts->remove($this->collNestleBowerAccounts->search($nestleBowerAccount));
            if (null === $this->nestleBowerAccountsScheduledForDeletion) {
                $this->nestleBowerAccountsScheduledForDeletion = clone $this->collNestleBowerAccounts;
                $this->nestleBowerAccountsScheduledForDeletion->clear();
            }
            $this->nestleBowerAccountsScheduledForDeletion[]= $nestleBowerAccount;
            $nestleBowerAccount->setNestleBowerAccountsMcp(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NestleBowerAccountsMcp is new, it will return
     * an empty collection; or if this NestleBowerAccountsMcp has previously
     * been saved, it will retrieve related NestleBowerAccounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NestleBowerAccountsMcp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NestleBowerAccount[] List of NestleBowerAccount objects
     */
    public function getNestleBowerAccountsJoinNestleBower($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NestleBowerAccountQuery::create(null, $criteria);
        $query->joinWith('NestleBower', $join_behavior);

        return $this->getNestleBowerAccounts($query, $con);
    }

    /**
     * Clears out the collNestleBowerInvoicess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     * @see        addNestleBowerInvoicess()
     */
    public function clearNestleBowerInvoicess()
    {
        $this->collNestleBowerInvoicess = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerInvoicessPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerInvoicess collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerInvoicess($v = true)
    {
        $this->collNestleBowerInvoicessPartial = $v;
    }

    /**
     * Initializes the collNestleBowerInvoicess collection.
     *
     * By default this just sets the collNestleBowerInvoicess collection to an empty array (like clearcollNestleBowerInvoicess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerInvoicess($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerInvoicess && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerInvoicess = new PropelObjectCollection();
        $this->collNestleBowerInvoicess->setModel('NestleBowerInvoices');
    }

    /**
     * Gets an array of NestleBowerInvoices objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBowerAccountsMcp is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerInvoices[] List of NestleBowerInvoices objects
     * @throws PropelException
     */
    public function getNestleBowerInvoicess($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerInvoicessPartial && !$this->isNew();
        if (null === $this->collNestleBowerInvoicess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerInvoicess) {
                // return empty collection
                $this->initNestleBowerInvoicess();
            } else {
                $collNestleBowerInvoicess = NestleBowerInvoicesQuery::create(null, $criteria)
                    ->filterByNestleBowerAccountsMcp($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerInvoicessPartial && count($collNestleBowerInvoicess)) {
                      $this->initNestleBowerInvoicess(false);

                      foreach ($collNestleBowerInvoicess as $obj) {
                        if (false == $this->collNestleBowerInvoicess->contains($obj)) {
                          $this->collNestleBowerInvoicess->append($obj);
                        }
                      }

                      $this->collNestleBowerInvoicessPartial = true;
                    }

                    $collNestleBowerInvoicess->getInternalIterator()->rewind();

                    return $collNestleBowerInvoicess;
                }

                if ($partial && $this->collNestleBowerInvoicess) {
                    foreach ($this->collNestleBowerInvoicess as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerInvoicess[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerInvoicess = $collNestleBowerInvoicess;
                $this->collNestleBowerInvoicessPartial = false;
            }
        }

        return $this->collNestleBowerInvoicess;
    }

    /**
     * Sets a collection of NestleBowerInvoices objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerInvoicess A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function setNestleBowerInvoicess(PropelCollection $nestleBowerInvoicess, PropelPDO $con = null)
    {
        $nestleBowerInvoicessToDelete = $this->getNestleBowerInvoicess(new Criteria(), $con)->diff($nestleBowerInvoicess);


        $this->nestleBowerInvoicessScheduledForDeletion = $nestleBowerInvoicessToDelete;

        foreach ($nestleBowerInvoicessToDelete as $nestleBowerInvoicesRemoved) {
            $nestleBowerInvoicesRemoved->setNestleBowerAccountsMcp(null);
        }

        $this->collNestleBowerInvoicess = null;
        foreach ($nestleBowerInvoicess as $nestleBowerInvoices) {
            $this->addNestleBowerInvoices($nestleBowerInvoices);
        }

        $this->collNestleBowerInvoicess = $nestleBowerInvoicess;
        $this->collNestleBowerInvoicessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerInvoices objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerInvoices objects.
     * @throws PropelException
     */
    public function countNestleBowerInvoicess(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerInvoicessPartial && !$this->isNew();
        if (null === $this->collNestleBowerInvoicess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerInvoicess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerInvoicess());
            }
            $query = NestleBowerInvoicesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBowerAccountsMcp($this)
                ->count($con);
        }

        return count($this->collNestleBowerInvoicess);
    }

    /**
     * Method called to associate a NestleBowerInvoices object to this object
     * through the NestleBowerInvoices foreign key attribute.
     *
     * @param    NestleBowerInvoices $l NestleBowerInvoices
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function addNestleBowerInvoices(NestleBowerInvoices $l)
    {
        if ($this->collNestleBowerInvoicess === null) {
            $this->initNestleBowerInvoicess();
            $this->collNestleBowerInvoicessPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerInvoicess->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerInvoices($l);

            if ($this->nestleBowerInvoicessScheduledForDeletion and $this->nestleBowerInvoicessScheduledForDeletion->contains($l)) {
                $this->nestleBowerInvoicessScheduledForDeletion->remove($this->nestleBowerInvoicessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerInvoices $nestleBowerInvoices The nestleBowerInvoices object to add.
     */
    protected function doAddNestleBowerInvoices($nestleBowerInvoices)
    {
        $this->collNestleBowerInvoicess[]= $nestleBowerInvoices;
        $nestleBowerInvoices->setNestleBowerAccountsMcp($this);
    }

    /**
     * @param	NestleBowerInvoices $nestleBowerInvoices The nestleBowerInvoices object to remove.
     * @return NestleBowerAccountsMcp The current object (for fluent API support)
     */
    public function removeNestleBowerInvoices($nestleBowerInvoices)
    {
        if ($this->getNestleBowerInvoicess()->contains($nestleBowerInvoices)) {
            $this->collNestleBowerInvoicess->remove($this->collNestleBowerInvoicess->search($nestleBowerInvoices));
            if (null === $this->nestleBowerInvoicessScheduledForDeletion) {
                $this->nestleBowerInvoicessScheduledForDeletion = clone $this->collNestleBowerInvoicess;
                $this->nestleBowerInvoicessScheduledForDeletion->clear();
            }
            $this->nestleBowerInvoicessScheduledForDeletion[]= $nestleBowerInvoices;
            $nestleBowerInvoices->setNestleBowerAccountsMcp(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NestleBowerAccountsMcp is new, it will return
     * an empty collection; or if this NestleBowerAccountsMcp has previously
     * been saved, it will retrieve related NestleBowerInvoicess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NestleBowerAccountsMcp.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NestleBowerInvoices[] List of NestleBowerInvoices objects
     */
    public function getNestleBowerInvoicessJoinNestleBower($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NestleBowerInvoicesQuery::create(null, $criteria);
        $query->joinWith('NestleBower', $join_behavior);

        return $this->getNestleBowerInvoicess($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->contact_person = null;
        $this->contact_number = null;
        $this->address = null;
        $this->latitude = null;
        $this->longitude = null;
        $this->best_from = null;
        $this->best_to = null;
        $this->area_id = null;
        $this->city_id = null;
        $this->frequency = null;
        $this->category_id = null;
        $this->channel = null;
        $this->bracket_number = null;
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
            if ($this->collNestleBowerAccounts) {
                foreach ($this->collNestleBowerAccounts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNestleBowerInvoicess) {
                foreach ($this->collNestleBowerInvoicess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aNestleBowerArea instanceof Persistent) {
              $this->aNestleBowerArea->clearAllReferences($deep);
            }
            if ($this->aNestleBowerCity instanceof Persistent) {
              $this->aNestleBowerCity->clearAllReferences($deep);
            }
            if ($this->aNestleBowerCategory instanceof Persistent) {
              $this->aNestleBowerCategory->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collNestleBowerAccounts instanceof PropelCollection) {
            $this->collNestleBowerAccounts->clearIterator();
        }
        $this->collNestleBowerAccounts = null;
        if ($this->collNestleBowerInvoicess instanceof PropelCollection) {
            $this->collNestleBowerInvoicess->clearIterator();
        }
        $this->collNestleBowerInvoicess = null;
        $this->aNestleBowerArea = null;
        $this->aNestleBowerCity = null;
        $this->aNestleBowerCategory = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NestleBowerAccountsMcpPeer::DEFAULT_STRING_FORMAT);
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
