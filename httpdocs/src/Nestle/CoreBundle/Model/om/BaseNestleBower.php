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
use Nestle\CoreBundle\Model\NestleBowerAccount;
use Nestle\CoreBundle\Model\NestleBowerAccountQuery;
use Nestle\CoreBundle\Model\NestleBowerArea;
use Nestle\CoreBundle\Model\NestleBowerAreaQuery;
use Nestle\CoreBundle\Model\NestleBowerInvoices;
use Nestle\CoreBundle\Model\NestleBowerInvoicesQuery;
use Nestle\CoreBundle\Model\NestleBowerPeer;
use Nestle\CoreBundle\Model\NestleBowerQuery;
use Nestle\CoreBundle\Model\NestleBowerSalesReport;
use Nestle\CoreBundle\Model\NestleBowerSalesReportQuery;
use Nestle\CoreBundle\Model\NestleNestleDistributors;
use Nestle\CoreBundle\Model\NestleNestleDistributorsQuery;

abstract class BaseNestleBower extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Nestle\\CoreBundle\\Model\\NestleBowerPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NestleBowerPeer
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
     * The value for the fname field.
     * @var        string
     */
    protected $fname;

    /**
     * The value for the lname field.
     * @var        string
     */
    protected $lname;

    /**
     * The value for the contact_number field.
     * @var        string
     */
    protected $contact_number;

    /**
     * The value for the bdate field.
     * @var        string
     */
    protected $bdate;

    /**
     * The value for the username field.
     * @var        string
     */
    protected $username;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the area_id field.
     * @var        int
     */
    protected $area_id;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * The value for the bower_id field.
     * @var        string
     */
    protected $bower_id;

    /**
     * The value for the distributor field.
     * @var        string
     */
    protected $distributor;

    /**
     * The value for the distributor_id field.
     * @var        int
     */
    protected $distributor_id;

    /**
     * @var        NestleNestleDistributors
     */
    protected $aNestleNestleDistributors;

    /**
     * @var        NestleBowerArea
     */
    protected $aNestleBowerArea;

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
     * @var        PropelObjectCollection|NestleBowerSalesReport[] Collection to store aggregation of NestleBowerSalesReport objects.
     */
    protected $collNestleBowerSalesReports;
    protected $collNestleBowerSalesReportsPartial;

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
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nestleBowerSalesReportsScheduledForDeletion = null;

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
     * Get the [fname] column value.
     *
     * @return string
     */
    public function getFname()
    {

        return $this->fname;
    }

    /**
     * Get the [lname] column value.
     *
     * @return string
     */
    public function getLname()
    {

        return $this->lname;
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
     * Get the [bdate] column value.
     *
     * @return string
     */
    public function getBdate()
    {

        return $this->bdate;
    }

    /**
     * Get the [username] column value.
     *
     * @return string
     */
    public function getUsername()
    {

        return $this->username;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {

        return $this->password;
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
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {

        return $this->status;
    }

    /**
     * Get the [bower_id] column value.
     *
     * @return string
     */
    public function getBowerId()
    {

        return $this->bower_id;
    }

    /**
     * Get the [distributor] column value.
     *
     * @return string
     */
    public function getDistributor()
    {

        return $this->distributor;
    }

    /**
     * Get the [distributor_id] column value.
     *
     * @return int
     */
    public function getDistributorId()
    {

        return $this->distributor_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NestleBowerPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fname] column.
     *
     * @param  string $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setFname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fname !== $v) {
            $this->fname = $v;
            $this->modifiedColumns[] = NestleBowerPeer::FNAME;
        }


        return $this;
    } // setFname()

    /**
     * Set the value of [lname] column.
     *
     * @param  string $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setLname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lname !== $v) {
            $this->lname = $v;
            $this->modifiedColumns[] = NestleBowerPeer::LNAME;
        }


        return $this;
    } // setLname()

    /**
     * Set the value of [contact_number] column.
     *
     * @param  string $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setContactNumber($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact_number !== $v) {
            $this->contact_number = $v;
            $this->modifiedColumns[] = NestleBowerPeer::CONTACT_NUMBER;
        }


        return $this;
    } // setContactNumber()

    /**
     * Set the value of [bdate] column.
     *
     * @param  string $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setBdate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bdate !== $v) {
            $this->bdate = $v;
            $this->modifiedColumns[] = NestleBowerPeer::BDATE;
        }


        return $this;
    } // setBdate()

    /**
     * Set the value of [username] column.
     *
     * @param  string $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[] = NestleBowerPeer::USERNAME;
        }


        return $this;
    } // setUsername()

    /**
     * Set the value of [password] column.
     *
     * @param  string $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[] = NestleBowerPeer::PASSWORD;
        }


        return $this;
    } // setPassword()

    /**
     * Set the value of [area_id] column.
     *
     * @param  int $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setAreaId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->area_id !== $v) {
            $this->area_id = $v;
            $this->modifiedColumns[] = NestleBowerPeer::AREA_ID;
        }

        if ($this->aNestleBowerArea !== null && $this->aNestleBowerArea->getId() !== $v) {
            $this->aNestleBowerArea = null;
        }


        return $this;
    } // setAreaId()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = NestleBowerPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [bower_id] column.
     *
     * @param  string $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setBowerId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bower_id !== $v) {
            $this->bower_id = $v;
            $this->modifiedColumns[] = NestleBowerPeer::BOWER_ID;
        }


        return $this;
    } // setBowerId()

    /**
     * Set the value of [distributor] column.
     *
     * @param  string $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setDistributor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->distributor !== $v) {
            $this->distributor = $v;
            $this->modifiedColumns[] = NestleBowerPeer::DISTRIBUTOR;
        }


        return $this;
    } // setDistributor()

    /**
     * Set the value of [distributor_id] column.
     *
     * @param  int $v new value
     * @return NestleBower The current object (for fluent API support)
     */
    public function setDistributorId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->distributor_id !== $v) {
            $this->distributor_id = $v;
            $this->modifiedColumns[] = NestleBowerPeer::DISTRIBUTOR_ID;
        }

        if ($this->aNestleNestleDistributors !== null && $this->aNestleNestleDistributors->getId() !== $v) {
            $this->aNestleNestleDistributors = null;
        }


        return $this;
    } // setDistributorId()

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
            $this->fname = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->lname = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->contact_number = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->bdate = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->username = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->password = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->area_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->status = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->bower_id = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->distributor = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->distributor_id = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 12; // 12 = NestleBowerPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating NestleBower object", $e);
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
        if ($this->aNestleNestleDistributors !== null && $this->distributor_id !== $this->aNestleNestleDistributors->getId()) {
            $this->aNestleNestleDistributors = null;
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
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NestleBowerPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aNestleNestleDistributors = null;
            $this->aNestleBowerArea = null;
            $this->collNestleBowerAccounts = null;

            $this->collNestleBowerInvoicess = null;

            $this->collNestleBowerSalesReports = null;

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
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NestleBowerQuery::create()
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
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                NestleBowerPeer::addInstanceToPool($this);
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

            if ($this->aNestleNestleDistributors !== null) {
                if ($this->aNestleNestleDistributors->isModified() || $this->aNestleNestleDistributors->isNew()) {
                    $affectedRows += $this->aNestleNestleDistributors->save($con);
                }
                $this->setNestleNestleDistributors($this->aNestleNestleDistributors);
            }

            if ($this->aNestleBowerArea !== null) {
                if ($this->aNestleBowerArea->isModified() || $this->aNestleBowerArea->isNew()) {
                    $affectedRows += $this->aNestleBowerArea->save($con);
                }
                $this->setNestleBowerArea($this->aNestleBowerArea);
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

            if ($this->nestleBowerSalesReportsScheduledForDeletion !== null) {
                if (!$this->nestleBowerSalesReportsScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerSalesReportsScheduledForDeletion as $nestleBowerSalesReport) {
                        // need to save related object because we set the relation to null
                        $nestleBowerSalesReport->save($con);
                    }
                    $this->nestleBowerSalesReportsScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerSalesReports !== null) {
                foreach ($this->collNestleBowerSalesReports as $referrerFK) {
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

        $this->modifiedColumns[] = NestleBowerPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NestleBowerPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NestleBowerPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(NestleBowerPeer::FNAME)) {
            $modifiedColumns[':p' . $index++]  = '`fname`';
        }
        if ($this->isColumnModified(NestleBowerPeer::LNAME)) {
            $modifiedColumns[':p' . $index++]  = '`lname`';
        }
        if ($this->isColumnModified(NestleBowerPeer::CONTACT_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`contact_number`';
        }
        if ($this->isColumnModified(NestleBowerPeer::BDATE)) {
            $modifiedColumns[':p' . $index++]  = '`bdate`';
        }
        if ($this->isColumnModified(NestleBowerPeer::USERNAME)) {
            $modifiedColumns[':p' . $index++]  = '`username`';
        }
        if ($this->isColumnModified(NestleBowerPeer::PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`password`';
        }
        if ($this->isColumnModified(NestleBowerPeer::AREA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`area_id`';
        }
        if ($this->isColumnModified(NestleBowerPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(NestleBowerPeer::BOWER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`bower_id`';
        }
        if ($this->isColumnModified(NestleBowerPeer::DISTRIBUTOR)) {
            $modifiedColumns[':p' . $index++]  = '`distributor`';
        }
        if ($this->isColumnModified(NestleBowerPeer::DISTRIBUTOR_ID)) {
            $modifiedColumns[':p' . $index++]  = '`distributor_id`';
        }

        $sql = sprintf(
            'INSERT INTO `bower` (%s) VALUES (%s)',
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
                    case '`fname`':
                        $stmt->bindValue($identifier, $this->fname, PDO::PARAM_STR);
                        break;
                    case '`lname`':
                        $stmt->bindValue($identifier, $this->lname, PDO::PARAM_STR);
                        break;
                    case '`contact_number`':
                        $stmt->bindValue($identifier, $this->contact_number, PDO::PARAM_STR);
                        break;
                    case '`bdate`':
                        $stmt->bindValue($identifier, $this->bdate, PDO::PARAM_STR);
                        break;
                    case '`username`':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case '`password`':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case '`area_id`':
                        $stmt->bindValue($identifier, $this->area_id, PDO::PARAM_INT);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`bower_id`':
                        $stmt->bindValue($identifier, $this->bower_id, PDO::PARAM_STR);
                        break;
                    case '`distributor`':
                        $stmt->bindValue($identifier, $this->distributor, PDO::PARAM_STR);
                        break;
                    case '`distributor_id`':
                        $stmt->bindValue($identifier, $this->distributor_id, PDO::PARAM_INT);
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

            if ($this->aNestleNestleDistributors !== null) {
                if (!$this->aNestleNestleDistributors->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleNestleDistributors->getValidationFailures());
                }
            }

            if ($this->aNestleBowerArea !== null) {
                if (!$this->aNestleBowerArea->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBowerArea->getValidationFailures());
                }
            }


            if (($retval = NestleBowerPeer::doValidate($this, $columns)) !== true) {
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

                if ($this->collNestleBowerSalesReports !== null) {
                    foreach ($this->collNestleBowerSalesReports as $referrerFK) {
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
        $pos = NestleBowerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getFname();
                break;
            case 2:
                return $this->getLname();
                break;
            case 3:
                return $this->getContactNumber();
                break;
            case 4:
                return $this->getBdate();
                break;
            case 5:
                return $this->getUsername();
                break;
            case 6:
                return $this->getPassword();
                break;
            case 7:
                return $this->getAreaId();
                break;
            case 8:
                return $this->getStatus();
                break;
            case 9:
                return $this->getBowerId();
                break;
            case 10:
                return $this->getDistributor();
                break;
            case 11:
                return $this->getDistributorId();
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
        if (isset($alreadyDumpedObjects['NestleBower'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NestleBower'][$this->getPrimaryKey()] = true;
        $keys = NestleBowerPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFname(),
            $keys[2] => $this->getLname(),
            $keys[3] => $this->getContactNumber(),
            $keys[4] => $this->getBdate(),
            $keys[5] => $this->getUsername(),
            $keys[6] => $this->getPassword(),
            $keys[7] => $this->getAreaId(),
            $keys[8] => $this->getStatus(),
            $keys[9] => $this->getBowerId(),
            $keys[10] => $this->getDistributor(),
            $keys[11] => $this->getDistributorId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aNestleNestleDistributors) {
                $result['NestleNestleDistributors'] = $this->aNestleNestleDistributors->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aNestleBowerArea) {
                $result['NestleBowerArea'] = $this->aNestleBowerArea->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collNestleBowerAccounts) {
                $result['NestleBowerAccounts'] = $this->collNestleBowerAccounts->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNestleBowerInvoicess) {
                $result['NestleBowerInvoicess'] = $this->collNestleBowerInvoicess->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNestleBowerSalesReports) {
                $result['NestleBowerSalesReports'] = $this->collNestleBowerSalesReports->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = NestleBowerPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setFname($value);
                break;
            case 2:
                $this->setLname($value);
                break;
            case 3:
                $this->setContactNumber($value);
                break;
            case 4:
                $this->setBdate($value);
                break;
            case 5:
                $this->setUsername($value);
                break;
            case 6:
                $this->setPassword($value);
                break;
            case 7:
                $this->setAreaId($value);
                break;
            case 8:
                $this->setStatus($value);
                break;
            case 9:
                $this->setBowerId($value);
                break;
            case 10:
                $this->setDistributor($value);
                break;
            case 11:
                $this->setDistributorId($value);
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
        $keys = NestleBowerPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFname($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setLname($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setContactNumber($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setBdate($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUsername($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setPassword($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setAreaId($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setStatus($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setBowerId($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setDistributor($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setDistributorId($arr[$keys[11]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NestleBowerPeer::DATABASE_NAME);

        if ($this->isColumnModified(NestleBowerPeer::ID)) $criteria->add(NestleBowerPeer::ID, $this->id);
        if ($this->isColumnModified(NestleBowerPeer::FNAME)) $criteria->add(NestleBowerPeer::FNAME, $this->fname);
        if ($this->isColumnModified(NestleBowerPeer::LNAME)) $criteria->add(NestleBowerPeer::LNAME, $this->lname);
        if ($this->isColumnModified(NestleBowerPeer::CONTACT_NUMBER)) $criteria->add(NestleBowerPeer::CONTACT_NUMBER, $this->contact_number);
        if ($this->isColumnModified(NestleBowerPeer::BDATE)) $criteria->add(NestleBowerPeer::BDATE, $this->bdate);
        if ($this->isColumnModified(NestleBowerPeer::USERNAME)) $criteria->add(NestleBowerPeer::USERNAME, $this->username);
        if ($this->isColumnModified(NestleBowerPeer::PASSWORD)) $criteria->add(NestleBowerPeer::PASSWORD, $this->password);
        if ($this->isColumnModified(NestleBowerPeer::AREA_ID)) $criteria->add(NestleBowerPeer::AREA_ID, $this->area_id);
        if ($this->isColumnModified(NestleBowerPeer::STATUS)) $criteria->add(NestleBowerPeer::STATUS, $this->status);
        if ($this->isColumnModified(NestleBowerPeer::BOWER_ID)) $criteria->add(NestleBowerPeer::BOWER_ID, $this->bower_id);
        if ($this->isColumnModified(NestleBowerPeer::DISTRIBUTOR)) $criteria->add(NestleBowerPeer::DISTRIBUTOR, $this->distributor);
        if ($this->isColumnModified(NestleBowerPeer::DISTRIBUTOR_ID)) $criteria->add(NestleBowerPeer::DISTRIBUTOR_ID, $this->distributor_id);

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
        $criteria = new Criteria(NestleBowerPeer::DATABASE_NAME);
        $criteria->add(NestleBowerPeer::ID, $this->id);

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
     * @param object $copyObj An object of NestleBower (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFname($this->getFname());
        $copyObj->setLname($this->getLname());
        $copyObj->setContactNumber($this->getContactNumber());
        $copyObj->setBdate($this->getBdate());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setAreaId($this->getAreaId());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setBowerId($this->getBowerId());
        $copyObj->setDistributor($this->getDistributor());
        $copyObj->setDistributorId($this->getDistributorId());

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

            foreach ($this->getNestleBowerSalesReports() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerSalesReport($relObj->copy($deepCopy));
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
     * @return NestleBower Clone of current object.
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
     * @return NestleBowerPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NestleBowerPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a NestleNestleDistributors object.
     *
     * @param                  NestleNestleDistributors $v
     * @return NestleBower The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleNestleDistributors(NestleNestleDistributors $v = null)
    {
        if ($v === null) {
            $this->setDistributorId(NULL);
        } else {
            $this->setDistributorId($v->getId());
        }

        $this->aNestleNestleDistributors = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleNestleDistributors object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBower($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleNestleDistributors object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleNestleDistributors The associated NestleNestleDistributors object.
     * @throws PropelException
     */
    public function getNestleNestleDistributors(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleNestleDistributors === null && ($this->distributor_id !== null) && $doQuery) {
            $this->aNestleNestleDistributors = NestleNestleDistributorsQuery::create()->findPk($this->distributor_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleNestleDistributors->addNestleBowers($this);
             */
        }

        return $this->aNestleNestleDistributors;
    }

    /**
     * Declares an association between this object and a NestleBowerArea object.
     *
     * @param                  NestleBowerArea $v
     * @return NestleBower The current object (for fluent API support)
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
            $v->addNestleBower($this);
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
                $this->aNestleBowerArea->addNestleBowers($this);
             */
        }

        return $this->aNestleBowerArea;
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
        if ('NestleBowerSalesReport' == $relationName) {
            $this->initNestleBowerSalesReports();
        }
    }

    /**
     * Clears out the collNestleBowerAccounts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBower The current object (for fluent API support)
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
     * If this NestleBower is new, it will return
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
                    ->filterByNestleBower($this)
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
     * @return NestleBower The current object (for fluent API support)
     */
    public function setNestleBowerAccounts(PropelCollection $nestleBowerAccounts, PropelPDO $con = null)
    {
        $nestleBowerAccountsToDelete = $this->getNestleBowerAccounts(new Criteria(), $con)->diff($nestleBowerAccounts);


        $this->nestleBowerAccountsScheduledForDeletion = $nestleBowerAccountsToDelete;

        foreach ($nestleBowerAccountsToDelete as $nestleBowerAccountRemoved) {
            $nestleBowerAccountRemoved->setNestleBower(null);
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
                ->filterByNestleBower($this)
                ->count($con);
        }

        return count($this->collNestleBowerAccounts);
    }

    /**
     * Method called to associate a NestleBowerAccount object to this object
     * through the NestleBowerAccount foreign key attribute.
     *
     * @param    NestleBowerAccount $l NestleBowerAccount
     * @return NestleBower The current object (for fluent API support)
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
        $nestleBowerAccount->setNestleBower($this);
    }

    /**
     * @param	NestleBowerAccount $nestleBowerAccount The nestleBowerAccount object to remove.
     * @return NestleBower The current object (for fluent API support)
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
            $nestleBowerAccount->setNestleBower(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NestleBower is new, it will return
     * an empty collection; or if this NestleBower has previously
     * been saved, it will retrieve related NestleBowerAccounts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NestleBower.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NestleBowerAccount[] List of NestleBowerAccount objects
     */
    public function getNestleBowerAccountsJoinNestleBowerAccountsMcp($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NestleBowerAccountQuery::create(null, $criteria);
        $query->joinWith('NestleBowerAccountsMcp', $join_behavior);

        return $this->getNestleBowerAccounts($query, $con);
    }

    /**
     * Clears out the collNestleBowerInvoicess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBower The current object (for fluent API support)
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
     * If this NestleBower is new, it will return
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
                    ->filterByNestleBower($this)
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
     * @return NestleBower The current object (for fluent API support)
     */
    public function setNestleBowerInvoicess(PropelCollection $nestleBowerInvoicess, PropelPDO $con = null)
    {
        $nestleBowerInvoicessToDelete = $this->getNestleBowerInvoicess(new Criteria(), $con)->diff($nestleBowerInvoicess);


        $this->nestleBowerInvoicessScheduledForDeletion = $nestleBowerInvoicessToDelete;

        foreach ($nestleBowerInvoicessToDelete as $nestleBowerInvoicesRemoved) {
            $nestleBowerInvoicesRemoved->setNestleBower(null);
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
                ->filterByNestleBower($this)
                ->count($con);
        }

        return count($this->collNestleBowerInvoicess);
    }

    /**
     * Method called to associate a NestleBowerInvoices object to this object
     * through the NestleBowerInvoices foreign key attribute.
     *
     * @param    NestleBowerInvoices $l NestleBowerInvoices
     * @return NestleBower The current object (for fluent API support)
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
        $nestleBowerInvoices->setNestleBower($this);
    }

    /**
     * @param	NestleBowerInvoices $nestleBowerInvoices The nestleBowerInvoices object to remove.
     * @return NestleBower The current object (for fluent API support)
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
            $nestleBowerInvoices->setNestleBower(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NestleBower is new, it will return
     * an empty collection; or if this NestleBower has previously
     * been saved, it will retrieve related NestleBowerInvoicess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NestleBower.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NestleBowerInvoices[] List of NestleBowerInvoices objects
     */
    public function getNestleBowerInvoicessJoinNestleBowerAccountsMcp($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NestleBowerInvoicesQuery::create(null, $criteria);
        $query->joinWith('NestleBowerAccountsMcp', $join_behavior);

        return $this->getNestleBowerInvoicess($query, $con);
    }

    /**
     * Clears out the collNestleBowerSalesReports collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBower The current object (for fluent API support)
     * @see        addNestleBowerSalesReports()
     */
    public function clearNestleBowerSalesReports()
    {
        $this->collNestleBowerSalesReports = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerSalesReportsPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerSalesReports collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerSalesReports($v = true)
    {
        $this->collNestleBowerSalesReportsPartial = $v;
    }

    /**
     * Initializes the collNestleBowerSalesReports collection.
     *
     * By default this just sets the collNestleBowerSalesReports collection to an empty array (like clearcollNestleBowerSalesReports());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerSalesReports($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerSalesReports && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerSalesReports = new PropelObjectCollection();
        $this->collNestleBowerSalesReports->setModel('NestleBowerSalesReport');
    }

    /**
     * Gets an array of NestleBowerSalesReport objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBower is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerSalesReport[] List of NestleBowerSalesReport objects
     * @throws PropelException
     */
    public function getNestleBowerSalesReports($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerSalesReportsPartial && !$this->isNew();
        if (null === $this->collNestleBowerSalesReports || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerSalesReports) {
                // return empty collection
                $this->initNestleBowerSalesReports();
            } else {
                $collNestleBowerSalesReports = NestleBowerSalesReportQuery::create(null, $criteria)
                    ->filterByNestleBower($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerSalesReportsPartial && count($collNestleBowerSalesReports)) {
                      $this->initNestleBowerSalesReports(false);

                      foreach ($collNestleBowerSalesReports as $obj) {
                        if (false == $this->collNestleBowerSalesReports->contains($obj)) {
                          $this->collNestleBowerSalesReports->append($obj);
                        }
                      }

                      $this->collNestleBowerSalesReportsPartial = true;
                    }

                    $collNestleBowerSalesReports->getInternalIterator()->rewind();

                    return $collNestleBowerSalesReports;
                }

                if ($partial && $this->collNestleBowerSalesReports) {
                    foreach ($this->collNestleBowerSalesReports as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerSalesReports[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerSalesReports = $collNestleBowerSalesReports;
                $this->collNestleBowerSalesReportsPartial = false;
            }
        }

        return $this->collNestleBowerSalesReports;
    }

    /**
     * Sets a collection of NestleBowerSalesReport objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerSalesReports A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBower The current object (for fluent API support)
     */
    public function setNestleBowerSalesReports(PropelCollection $nestleBowerSalesReports, PropelPDO $con = null)
    {
        $nestleBowerSalesReportsToDelete = $this->getNestleBowerSalesReports(new Criteria(), $con)->diff($nestleBowerSalesReports);


        $this->nestleBowerSalesReportsScheduledForDeletion = $nestleBowerSalesReportsToDelete;

        foreach ($nestleBowerSalesReportsToDelete as $nestleBowerSalesReportRemoved) {
            $nestleBowerSalesReportRemoved->setNestleBower(null);
        }

        $this->collNestleBowerSalesReports = null;
        foreach ($nestleBowerSalesReports as $nestleBowerSalesReport) {
            $this->addNestleBowerSalesReport($nestleBowerSalesReport);
        }

        $this->collNestleBowerSalesReports = $nestleBowerSalesReports;
        $this->collNestleBowerSalesReportsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerSalesReport objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerSalesReport objects.
     * @throws PropelException
     */
    public function countNestleBowerSalesReports(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerSalesReportsPartial && !$this->isNew();
        if (null === $this->collNestleBowerSalesReports || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerSalesReports) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerSalesReports());
            }
            $query = NestleBowerSalesReportQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBower($this)
                ->count($con);
        }

        return count($this->collNestleBowerSalesReports);
    }

    /**
     * Method called to associate a NestleBowerSalesReport object to this object
     * through the NestleBowerSalesReport foreign key attribute.
     *
     * @param    NestleBowerSalesReport $l NestleBowerSalesReport
     * @return NestleBower The current object (for fluent API support)
     */
    public function addNestleBowerSalesReport(NestleBowerSalesReport $l)
    {
        if ($this->collNestleBowerSalesReports === null) {
            $this->initNestleBowerSalesReports();
            $this->collNestleBowerSalesReportsPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerSalesReports->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerSalesReport($l);

            if ($this->nestleBowerSalesReportsScheduledForDeletion and $this->nestleBowerSalesReportsScheduledForDeletion->contains($l)) {
                $this->nestleBowerSalesReportsScheduledForDeletion->remove($this->nestleBowerSalesReportsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerSalesReport $nestleBowerSalesReport The nestleBowerSalesReport object to add.
     */
    protected function doAddNestleBowerSalesReport($nestleBowerSalesReport)
    {
        $this->collNestleBowerSalesReports[]= $nestleBowerSalesReport;
        $nestleBowerSalesReport->setNestleBower($this);
    }

    /**
     * @param	NestleBowerSalesReport $nestleBowerSalesReport The nestleBowerSalesReport object to remove.
     * @return NestleBower The current object (for fluent API support)
     */
    public function removeNestleBowerSalesReport($nestleBowerSalesReport)
    {
        if ($this->getNestleBowerSalesReports()->contains($nestleBowerSalesReport)) {
            $this->collNestleBowerSalesReports->remove($this->collNestleBowerSalesReports->search($nestleBowerSalesReport));
            if (null === $this->nestleBowerSalesReportsScheduledForDeletion) {
                $this->nestleBowerSalesReportsScheduledForDeletion = clone $this->collNestleBowerSalesReports;
                $this->nestleBowerSalesReportsScheduledForDeletion->clear();
            }
            $this->nestleBowerSalesReportsScheduledForDeletion[]= $nestleBowerSalesReport;
            $nestleBowerSalesReport->setNestleBower(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->fname = null;
        $this->lname = null;
        $this->contact_number = null;
        $this->bdate = null;
        $this->username = null;
        $this->password = null;
        $this->area_id = null;
        $this->status = null;
        $this->bower_id = null;
        $this->distributor = null;
        $this->distributor_id = null;
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
            if ($this->collNestleBowerSalesReports) {
                foreach ($this->collNestleBowerSalesReports as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aNestleNestleDistributors instanceof Persistent) {
              $this->aNestleNestleDistributors->clearAllReferences($deep);
            }
            if ($this->aNestleBowerArea instanceof Persistent) {
              $this->aNestleBowerArea->clearAllReferences($deep);
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
        if ($this->collNestleBowerSalesReports instanceof PropelCollection) {
            $this->collNestleBowerSalesReports->clearIterator();
        }
        $this->collNestleBowerSalesReports = null;
        $this->aNestleNestleDistributors = null;
        $this->aNestleBowerArea = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NestleBowerPeer::DEFAULT_STRING_FORMAT);
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
