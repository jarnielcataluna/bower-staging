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
use Nestle\CoreBundle\Model\NestleBowerBrandProduct;
use Nestle\CoreBundle\Model\NestleBowerBrandProductQuery;
use Nestle\CoreBundle\Model\NestleBowerInvoiceItem;
use Nestle\CoreBundle\Model\NestleBowerInvoiceItemQuery;
use Nestle\CoreBundle\Model\NestleBowerProduct;
use Nestle\CoreBundle\Model\NestleBowerProductCategory;
use Nestle\CoreBundle\Model\NestleBowerProductCategoryQuery;
use Nestle\CoreBundle\Model\NestleBowerProductPeer;
use Nestle\CoreBundle\Model\NestleBowerProductQuery;
use Nestle\CoreBundle\Model\NestleBowerRules;
use Nestle\CoreBundle\Model\NestleBowerRulesQuery;

abstract class BaseNestleBowerProduct extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Nestle\\CoreBundle\\Model\\NestleBowerProductPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NestleBowerProductPeer
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
     * The value for the product_category_id field.
     * @var        int
     */
    protected $product_category_id;

    /**
     * The value for the sku field.
     * @var        string
     */
    protected $sku;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the background_color field.
     * @var        string
     */
    protected $background_color;

    /**
     * The value for the font_color field.
     * @var        string
     */
    protected $font_color;

    /**
     * The value for the image field.
     * @var        string
     */
    protected $image;

    /**
     * The value for the thumbnail field.
     * @var        string
     */
    protected $thumbnail;

    /**
     * The value for the base_price field.
     * @var        double
     */
    protected $base_price;

    /**
     * The value for the vat field.
     * @var        double
     */
    protected $vat;

    /**
     * The value for the date_added field.
     * @var        string
     */
    protected $date_added;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * The value for the type field.
     * @var        int
     */
    protected $type;

    /**
     * @var        NestleBowerProductCategory
     */
    protected $aNestleBowerProductCategory;

    /**
     * @var        PropelObjectCollection|NestleBowerBrandProduct[] Collection to store aggregation of NestleBowerBrandProduct objects.
     */
    protected $collNestleBowerBrandProducts;
    protected $collNestleBowerBrandProductsPartial;

    /**
     * @var        PropelObjectCollection|NestleBowerInvoiceItem[] Collection to store aggregation of NestleBowerInvoiceItem objects.
     */
    protected $collNestleBowerInvoiceItems;
    protected $collNestleBowerInvoiceItemsPartial;

    /**
     * @var        PropelObjectCollection|NestleBowerRules[] Collection to store aggregation of NestleBowerRules objects.
     */
    protected $collNestleBowerRulessRelatedByProductId;
    protected $collNestleBowerRulessRelatedByProductIdPartial;

    /**
     * @var        PropelObjectCollection|NestleBowerRules[] Collection to store aggregation of NestleBowerRules objects.
     */
    protected $collNestleBowerRulessRelatedByPromoProductId;
    protected $collNestleBowerRulessRelatedByPromoProductIdPartial;

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
    protected $nestleBowerBrandProductsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nestleBowerInvoiceItemsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nestleBowerRulessRelatedByProductIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion = null;

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
     * Get the [product_category_id] column value.
     *
     * @return int
     */
    public function getProductCategoryId()
    {

        return $this->product_category_id;
    }

    /**
     * Get the [sku] column value.
     *
     * @return string
     */
    public function getSku()
    {

        return $this->sku;
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
     * Get the [background_color] column value.
     *
     * @return string
     */
    public function getBackgroundColor()
    {

        return $this->background_color;
    }

    /**
     * Get the [font_color] column value.
     *
     * @return string
     */
    public function getFontColor()
    {

        return $this->font_color;
    }

    /**
     * Get the [image] column value.
     *
     * @return string
     */
    public function getImage()
    {

        return $this->image;
    }

    /**
     * Get the [thumbnail] column value.
     *
     * @return string
     */
    public function getThumbnail()
    {

        return $this->thumbnail;
    }

    /**
     * Get the [base_price] column value.
     *
     * @return double
     */
    public function getBasePrice()
    {

        return $this->base_price;
    }

    /**
     * Get the [vat] column value.
     *
     * @return double
     */
    public function getVat()
    {

        return $this->vat;
    }

    /**
     * Get the [date_added] column value.
     *
     * @return string
     */
    public function getDateAdded()
    {

        return $this->date_added;
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
     * Get the [type] column value.
     *
     * @return int
     */
    public function getType()
    {

        return $this->type;
    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [product_category_id] column.
     *
     * @param  int $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setProductCategoryId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->product_category_id !== $v) {
            $this->product_category_id = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::PRODUCT_CATEGORY_ID;
        }

        if ($this->aNestleBowerProductCategory !== null && $this->aNestleBowerProductCategory->getId() !== $v) {
            $this->aNestleBowerProductCategory = null;
        }


        return $this;
    } // setProductCategoryId()

    /**
     * Set the value of [sku] column.
     *
     * @param  string $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setSku($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sku !== $v) {
            $this->sku = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::SKU;
        }


        return $this;
    } // setSku()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [background_color] column.
     *
     * @param  string $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setBackgroundColor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->background_color !== $v) {
            $this->background_color = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::BACKGROUND_COLOR;
        }


        return $this;
    } // setBackgroundColor()

    /**
     * Set the value of [font_color] column.
     *
     * @param  string $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setFontColor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->font_color !== $v) {
            $this->font_color = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::FONT_COLOR;
        }


        return $this;
    } // setFontColor()

    /**
     * Set the value of [image] column.
     *
     * @param  string $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setImage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->image !== $v) {
            $this->image = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::IMAGE;
        }


        return $this;
    } // setImage()

    /**
     * Set the value of [thumbnail] column.
     *
     * @param  string $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setThumbnail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->thumbnail !== $v) {
            $this->thumbnail = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::THUMBNAIL;
        }


        return $this;
    } // setThumbnail()

    /**
     * Set the value of [base_price] column.
     *
     * @param  double $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setBasePrice($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->base_price !== $v) {
            $this->base_price = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::BASE_PRICE;
        }


        return $this;
    } // setBasePrice()

    /**
     * Set the value of [vat] column.
     *
     * @param  double $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setVat($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->vat !== $v) {
            $this->vat = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::VAT;
        }


        return $this;
    } // setVat()

    /**
     * Set the value of [date_added] column.
     *
     * @param  string $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setDateAdded($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->date_added !== $v) {
            $this->date_added = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::DATE_ADDED;
        }


        return $this;
    } // setDateAdded()

    /**
     * Set the value of [status] column.
     *
     * @param  int $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::STATUS;
        }


        return $this;
    } // setStatus()

    /**
     * Set the value of [type] column.
     *
     * @param  int $v new value
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[] = NestleBowerProductPeer::TYPE;
        }


        return $this;
    } // setType()

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
            $this->product_category_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->sku = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->background_color = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->font_color = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->image = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->thumbnail = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->base_price = ($row[$startcol + 8] !== null) ? (double) $row[$startcol + 8] : null;
            $this->vat = ($row[$startcol + 9] !== null) ? (double) $row[$startcol + 9] : null;
            $this->date_added = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->status = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->type = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 13; // 13 = NestleBowerProductPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating NestleBowerProduct object", $e);
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

        if ($this->aNestleBowerProductCategory !== null && $this->product_category_id !== $this->aNestleBowerProductCategory->getId()) {
            $this->aNestleBowerProductCategory = null;
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
            $con = Propel::getConnection(NestleBowerProductPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NestleBowerProductPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aNestleBowerProductCategory = null;
            $this->collNestleBowerBrandProducts = null;

            $this->collNestleBowerInvoiceItems = null;

            $this->collNestleBowerRulessRelatedByProductId = null;

            $this->collNestleBowerRulessRelatedByPromoProductId = null;

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
            $con = Propel::getConnection(NestleBowerProductPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NestleBowerProductQuery::create()
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
            $con = Propel::getConnection(NestleBowerProductPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                NestleBowerProductPeer::addInstanceToPool($this);
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

            if ($this->aNestleBowerProductCategory !== null) {
                if ($this->aNestleBowerProductCategory->isModified() || $this->aNestleBowerProductCategory->isNew()) {
                    $affectedRows += $this->aNestleBowerProductCategory->save($con);
                }
                $this->setNestleBowerProductCategory($this->aNestleBowerProductCategory);
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

            if ($this->nestleBowerBrandProductsScheduledForDeletion !== null) {
                if (!$this->nestleBowerBrandProductsScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerBrandProductsScheduledForDeletion as $nestleBowerBrandProduct) {
                        // need to save related object because we set the relation to null
                        $nestleBowerBrandProduct->save($con);
                    }
                    $this->nestleBowerBrandProductsScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerBrandProducts !== null) {
                foreach ($this->collNestleBowerBrandProducts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nestleBowerInvoiceItemsScheduledForDeletion !== null) {
                if (!$this->nestleBowerInvoiceItemsScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerInvoiceItemsScheduledForDeletion as $nestleBowerInvoiceItem) {
                        // need to save related object because we set the relation to null
                        $nestleBowerInvoiceItem->save($con);
                    }
                    $this->nestleBowerInvoiceItemsScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerInvoiceItems !== null) {
                foreach ($this->collNestleBowerInvoiceItems as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nestleBowerRulessRelatedByProductIdScheduledForDeletion !== null) {
                if (!$this->nestleBowerRulessRelatedByProductIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerRulessRelatedByProductIdScheduledForDeletion as $nestleBowerRulesRelatedByProductId) {
                        // need to save related object because we set the relation to null
                        $nestleBowerRulesRelatedByProductId->save($con);
                    }
                    $this->nestleBowerRulessRelatedByProductIdScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerRulessRelatedByProductId !== null) {
                foreach ($this->collNestleBowerRulessRelatedByProductId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion !== null) {
                if (!$this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion as $nestleBowerRulesRelatedByPromoProductId) {
                        // need to save related object because we set the relation to null
                        $nestleBowerRulesRelatedByPromoProductId->save($con);
                    }
                    $this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion = null;
                }
            }

            if ($this->collNestleBowerRulessRelatedByPromoProductId !== null) {
                foreach ($this->collNestleBowerRulessRelatedByPromoProductId as $referrerFK) {
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

        $this->modifiedColumns[] = NestleBowerProductPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NestleBowerProductPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NestleBowerProductPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::PRODUCT_CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`product_category_id`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::SKU)) {
            $modifiedColumns[':p' . $index++]  = '`sku`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::BACKGROUND_COLOR)) {
            $modifiedColumns[':p' . $index++]  = '`background_color`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::FONT_COLOR)) {
            $modifiedColumns[':p' . $index++]  = '`font_color`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::IMAGE)) {
            $modifiedColumns[':p' . $index++]  = '`image`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::THUMBNAIL)) {
            $modifiedColumns[':p' . $index++]  = '`thumbnail`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::BASE_PRICE)) {
            $modifiedColumns[':p' . $index++]  = '`base_price`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::VAT)) {
            $modifiedColumns[':p' . $index++]  = '`vat`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::DATE_ADDED)) {
            $modifiedColumns[':p' . $index++]  = '`date_added`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::STATUS)) {
            $modifiedColumns[':p' . $index++]  = '`status`';
        }
        if ($this->isColumnModified(NestleBowerProductPeer::TYPE)) {
            $modifiedColumns[':p' . $index++]  = '`type`';
        }

        $sql = sprintf(
            'INSERT INTO `product` (%s) VALUES (%s)',
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
                    case '`product_category_id`':
                        $stmt->bindValue($identifier, $this->product_category_id, PDO::PARAM_INT);
                        break;
                    case '`sku`':
                        $stmt->bindValue($identifier, $this->sku, PDO::PARAM_STR);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`background_color`':
                        $stmt->bindValue($identifier, $this->background_color, PDO::PARAM_STR);
                        break;
                    case '`font_color`':
                        $stmt->bindValue($identifier, $this->font_color, PDO::PARAM_STR);
                        break;
                    case '`image`':
                        $stmt->bindValue($identifier, $this->image, PDO::PARAM_STR);
                        break;
                    case '`thumbnail`':
                        $stmt->bindValue($identifier, $this->thumbnail, PDO::PARAM_STR);
                        break;
                    case '`base_price`':
                        $stmt->bindValue($identifier, $this->base_price, PDO::PARAM_STR);
                        break;
                    case '`vat`':
                        $stmt->bindValue($identifier, $this->vat, PDO::PARAM_STR);
                        break;
                    case '`date_added`':
                        $stmt->bindValue($identifier, $this->date_added, PDO::PARAM_STR);
                        break;
                    case '`status`':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case '`type`':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_INT);
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

            if ($this->aNestleBowerProductCategory !== null) {
                if (!$this->aNestleBowerProductCategory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aNestleBowerProductCategory->getValidationFailures());
                }
            }


            if (($retval = NestleBowerProductPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collNestleBowerBrandProducts !== null) {
                    foreach ($this->collNestleBowerBrandProducts as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNestleBowerInvoiceItems !== null) {
                    foreach ($this->collNestleBowerInvoiceItems as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNestleBowerRulessRelatedByProductId !== null) {
                    foreach ($this->collNestleBowerRulessRelatedByProductId as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNestleBowerRulessRelatedByPromoProductId !== null) {
                    foreach ($this->collNestleBowerRulessRelatedByPromoProductId as $referrerFK) {
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
        $pos = NestleBowerProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getProductCategoryId();
                break;
            case 2:
                return $this->getSku();
                break;
            case 3:
                return $this->getName();
                break;
            case 4:
                return $this->getBackgroundColor();
                break;
            case 5:
                return $this->getFontColor();
                break;
            case 6:
                return $this->getImage();
                break;
            case 7:
                return $this->getThumbnail();
                break;
            case 8:
                return $this->getBasePrice();
                break;
            case 9:
                return $this->getVat();
                break;
            case 10:
                return $this->getDateAdded();
                break;
            case 11:
                return $this->getStatus();
                break;
            case 12:
                return $this->getType();
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
        if (isset($alreadyDumpedObjects['NestleBowerProduct'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NestleBowerProduct'][$this->getPrimaryKey()] = true;
        $keys = NestleBowerProductPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getProductCategoryId(),
            $keys[2] => $this->getSku(),
            $keys[3] => $this->getName(),
            $keys[4] => $this->getBackgroundColor(),
            $keys[5] => $this->getFontColor(),
            $keys[6] => $this->getImage(),
            $keys[7] => $this->getThumbnail(),
            $keys[8] => $this->getBasePrice(),
            $keys[9] => $this->getVat(),
            $keys[10] => $this->getDateAdded(),
            $keys[11] => $this->getStatus(),
            $keys[12] => $this->getType(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aNestleBowerProductCategory) {
                $result['NestleBowerProductCategory'] = $this->aNestleBowerProductCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collNestleBowerBrandProducts) {
                $result['NestleBowerBrandProducts'] = $this->collNestleBowerBrandProducts->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNestleBowerInvoiceItems) {
                $result['NestleBowerInvoiceItems'] = $this->collNestleBowerInvoiceItems->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNestleBowerRulessRelatedByProductId) {
                $result['NestleBowerRulessRelatedByProductId'] = $this->collNestleBowerRulessRelatedByProductId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNestleBowerRulessRelatedByPromoProductId) {
                $result['NestleBowerRulessRelatedByPromoProductId'] = $this->collNestleBowerRulessRelatedByPromoProductId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = NestleBowerProductPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setProductCategoryId($value);
                break;
            case 2:
                $this->setSku($value);
                break;
            case 3:
                $this->setName($value);
                break;
            case 4:
                $this->setBackgroundColor($value);
                break;
            case 5:
                $this->setFontColor($value);
                break;
            case 6:
                $this->setImage($value);
                break;
            case 7:
                $this->setThumbnail($value);
                break;
            case 8:
                $this->setBasePrice($value);
                break;
            case 9:
                $this->setVat($value);
                break;
            case 10:
                $this->setDateAdded($value);
                break;
            case 11:
                $this->setStatus($value);
                break;
            case 12:
                $this->setType($value);
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
        $keys = NestleBowerProductPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setProductCategoryId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setSku($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setBackgroundColor($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setFontColor($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setImage($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setThumbnail($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setBasePrice($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setVat($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setDateAdded($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setStatus($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setType($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NestleBowerProductPeer::DATABASE_NAME);

        if ($this->isColumnModified(NestleBowerProductPeer::ID)) $criteria->add(NestleBowerProductPeer::ID, $this->id);
        if ($this->isColumnModified(NestleBowerProductPeer::PRODUCT_CATEGORY_ID)) $criteria->add(NestleBowerProductPeer::PRODUCT_CATEGORY_ID, $this->product_category_id);
        if ($this->isColumnModified(NestleBowerProductPeer::SKU)) $criteria->add(NestleBowerProductPeer::SKU, $this->sku);
        if ($this->isColumnModified(NestleBowerProductPeer::NAME)) $criteria->add(NestleBowerProductPeer::NAME, $this->name);
        if ($this->isColumnModified(NestleBowerProductPeer::BACKGROUND_COLOR)) $criteria->add(NestleBowerProductPeer::BACKGROUND_COLOR, $this->background_color);
        if ($this->isColumnModified(NestleBowerProductPeer::FONT_COLOR)) $criteria->add(NestleBowerProductPeer::FONT_COLOR, $this->font_color);
        if ($this->isColumnModified(NestleBowerProductPeer::IMAGE)) $criteria->add(NestleBowerProductPeer::IMAGE, $this->image);
        if ($this->isColumnModified(NestleBowerProductPeer::THUMBNAIL)) $criteria->add(NestleBowerProductPeer::THUMBNAIL, $this->thumbnail);
        if ($this->isColumnModified(NestleBowerProductPeer::BASE_PRICE)) $criteria->add(NestleBowerProductPeer::BASE_PRICE, $this->base_price);
        if ($this->isColumnModified(NestleBowerProductPeer::VAT)) $criteria->add(NestleBowerProductPeer::VAT, $this->vat);
        if ($this->isColumnModified(NestleBowerProductPeer::DATE_ADDED)) $criteria->add(NestleBowerProductPeer::DATE_ADDED, $this->date_added);
        if ($this->isColumnModified(NestleBowerProductPeer::STATUS)) $criteria->add(NestleBowerProductPeer::STATUS, $this->status);
        if ($this->isColumnModified(NestleBowerProductPeer::TYPE)) $criteria->add(NestleBowerProductPeer::TYPE, $this->type);

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
        $criteria = new Criteria(NestleBowerProductPeer::DATABASE_NAME);
        $criteria->add(NestleBowerProductPeer::ID, $this->id);

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
     * @param object $copyObj An object of NestleBowerProduct (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setProductCategoryId($this->getProductCategoryId());
        $copyObj->setSku($this->getSku());
        $copyObj->setName($this->getName());
        $copyObj->setBackgroundColor($this->getBackgroundColor());
        $copyObj->setFontColor($this->getFontColor());
        $copyObj->setImage($this->getImage());
        $copyObj->setThumbnail($this->getThumbnail());
        $copyObj->setBasePrice($this->getBasePrice());
        $copyObj->setVat($this->getVat());
        $copyObj->setDateAdded($this->getDateAdded());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setType($this->getType());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getNestleBowerBrandProducts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerBrandProduct($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNestleBowerInvoiceItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerInvoiceItem($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNestleBowerRulessRelatedByProductId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerRulesRelatedByProductId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNestleBowerRulessRelatedByPromoProductId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNestleBowerRulesRelatedByPromoProductId($relObj->copy($deepCopy));
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
     * @return NestleBowerProduct Clone of current object.
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
     * @return NestleBowerProductPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NestleBowerProductPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a NestleBowerProductCategory object.
     *
     * @param                  NestleBowerProductCategory $v
     * @return NestleBowerProduct The current object (for fluent API support)
     * @throws PropelException
     */
    public function setNestleBowerProductCategory(NestleBowerProductCategory $v = null)
    {
        if ($v === null) {
            $this->setProductCategoryId(NULL);
        } else {
            $this->setProductCategoryId($v->getId());
        }

        $this->aNestleBowerProductCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the NestleBowerProductCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addNestleBowerProduct($this);
        }


        return $this;
    }


    /**
     * Get the associated NestleBowerProductCategory object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return NestleBowerProductCategory The associated NestleBowerProductCategory object.
     * @throws PropelException
     */
    public function getNestleBowerProductCategory(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aNestleBowerProductCategory === null && ($this->product_category_id !== null) && $doQuery) {
            $this->aNestleBowerProductCategory = NestleBowerProductCategoryQuery::create()->findPk($this->product_category_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aNestleBowerProductCategory->addNestleBowerProducts($this);
             */
        }

        return $this->aNestleBowerProductCategory;
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
        if ('NestleBowerBrandProduct' == $relationName) {
            $this->initNestleBowerBrandProducts();
        }
        if ('NestleBowerInvoiceItem' == $relationName) {
            $this->initNestleBowerInvoiceItems();
        }
        if ('NestleBowerRulesRelatedByProductId' == $relationName) {
            $this->initNestleBowerRulessRelatedByProductId();
        }
        if ('NestleBowerRulesRelatedByPromoProductId' == $relationName) {
            $this->initNestleBowerRulessRelatedByPromoProductId();
        }
    }

    /**
     * Clears out the collNestleBowerBrandProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerProduct The current object (for fluent API support)
     * @see        addNestleBowerBrandProducts()
     */
    public function clearNestleBowerBrandProducts()
    {
        $this->collNestleBowerBrandProducts = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerBrandProductsPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerBrandProducts collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerBrandProducts($v = true)
    {
        $this->collNestleBowerBrandProductsPartial = $v;
    }

    /**
     * Initializes the collNestleBowerBrandProducts collection.
     *
     * By default this just sets the collNestleBowerBrandProducts collection to an empty array (like clearcollNestleBowerBrandProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerBrandProducts($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerBrandProducts && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerBrandProducts = new PropelObjectCollection();
        $this->collNestleBowerBrandProducts->setModel('NestleBowerBrandProduct');
    }

    /**
     * Gets an array of NestleBowerBrandProduct objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBowerProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerBrandProduct[] List of NestleBowerBrandProduct objects
     * @throws PropelException
     */
    public function getNestleBowerBrandProducts($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerBrandProductsPartial && !$this->isNew();
        if (null === $this->collNestleBowerBrandProducts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerBrandProducts) {
                // return empty collection
                $this->initNestleBowerBrandProducts();
            } else {
                $collNestleBowerBrandProducts = NestleBowerBrandProductQuery::create(null, $criteria)
                    ->filterByNestleBowerProduct($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerBrandProductsPartial && count($collNestleBowerBrandProducts)) {
                      $this->initNestleBowerBrandProducts(false);

                      foreach ($collNestleBowerBrandProducts as $obj) {
                        if (false == $this->collNestleBowerBrandProducts->contains($obj)) {
                          $this->collNestleBowerBrandProducts->append($obj);
                        }
                      }

                      $this->collNestleBowerBrandProductsPartial = true;
                    }

                    $collNestleBowerBrandProducts->getInternalIterator()->rewind();

                    return $collNestleBowerBrandProducts;
                }

                if ($partial && $this->collNestleBowerBrandProducts) {
                    foreach ($this->collNestleBowerBrandProducts as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerBrandProducts[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerBrandProducts = $collNestleBowerBrandProducts;
                $this->collNestleBowerBrandProductsPartial = false;
            }
        }

        return $this->collNestleBowerBrandProducts;
    }

    /**
     * Sets a collection of NestleBowerBrandProduct objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerBrandProducts A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setNestleBowerBrandProducts(PropelCollection $nestleBowerBrandProducts, PropelPDO $con = null)
    {
        $nestleBowerBrandProductsToDelete = $this->getNestleBowerBrandProducts(new Criteria(), $con)->diff($nestleBowerBrandProducts);


        $this->nestleBowerBrandProductsScheduledForDeletion = $nestleBowerBrandProductsToDelete;

        foreach ($nestleBowerBrandProductsToDelete as $nestleBowerBrandProductRemoved) {
            $nestleBowerBrandProductRemoved->setNestleBowerProduct(null);
        }

        $this->collNestleBowerBrandProducts = null;
        foreach ($nestleBowerBrandProducts as $nestleBowerBrandProduct) {
            $this->addNestleBowerBrandProduct($nestleBowerBrandProduct);
        }

        $this->collNestleBowerBrandProducts = $nestleBowerBrandProducts;
        $this->collNestleBowerBrandProductsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerBrandProduct objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerBrandProduct objects.
     * @throws PropelException
     */
    public function countNestleBowerBrandProducts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerBrandProductsPartial && !$this->isNew();
        if (null === $this->collNestleBowerBrandProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerBrandProducts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerBrandProducts());
            }
            $query = NestleBowerBrandProductQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBowerProduct($this)
                ->count($con);
        }

        return count($this->collNestleBowerBrandProducts);
    }

    /**
     * Method called to associate a NestleBowerBrandProduct object to this object
     * through the NestleBowerBrandProduct foreign key attribute.
     *
     * @param    NestleBowerBrandProduct $l NestleBowerBrandProduct
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function addNestleBowerBrandProduct(NestleBowerBrandProduct $l)
    {
        if ($this->collNestleBowerBrandProducts === null) {
            $this->initNestleBowerBrandProducts();
            $this->collNestleBowerBrandProductsPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerBrandProducts->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerBrandProduct($l);

            if ($this->nestleBowerBrandProductsScheduledForDeletion and $this->nestleBowerBrandProductsScheduledForDeletion->contains($l)) {
                $this->nestleBowerBrandProductsScheduledForDeletion->remove($this->nestleBowerBrandProductsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerBrandProduct $nestleBowerBrandProduct The nestleBowerBrandProduct object to add.
     */
    protected function doAddNestleBowerBrandProduct($nestleBowerBrandProduct)
    {
        $this->collNestleBowerBrandProducts[]= $nestleBowerBrandProduct;
        $nestleBowerBrandProduct->setNestleBowerProduct($this);
    }

    /**
     * @param	NestleBowerBrandProduct $nestleBowerBrandProduct The nestleBowerBrandProduct object to remove.
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function removeNestleBowerBrandProduct($nestleBowerBrandProduct)
    {
        if ($this->getNestleBowerBrandProducts()->contains($nestleBowerBrandProduct)) {
            $this->collNestleBowerBrandProducts->remove($this->collNestleBowerBrandProducts->search($nestleBowerBrandProduct));
            if (null === $this->nestleBowerBrandProductsScheduledForDeletion) {
                $this->nestleBowerBrandProductsScheduledForDeletion = clone $this->collNestleBowerBrandProducts;
                $this->nestleBowerBrandProductsScheduledForDeletion->clear();
            }
            $this->nestleBowerBrandProductsScheduledForDeletion[]= $nestleBowerBrandProduct;
            $nestleBowerBrandProduct->setNestleBowerProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NestleBowerProduct is new, it will return
     * an empty collection; or if this NestleBowerProduct has previously
     * been saved, it will retrieve related NestleBowerBrandProducts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NestleBowerProduct.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NestleBowerBrandProduct[] List of NestleBowerBrandProduct objects
     */
    public function getNestleBowerBrandProductsJoinNestleBowerBrand($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NestleBowerBrandProductQuery::create(null, $criteria);
        $query->joinWith('NestleBowerBrand', $join_behavior);

        return $this->getNestleBowerBrandProducts($query, $con);
    }

    /**
     * Clears out the collNestleBowerInvoiceItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerProduct The current object (for fluent API support)
     * @see        addNestleBowerInvoiceItems()
     */
    public function clearNestleBowerInvoiceItems()
    {
        $this->collNestleBowerInvoiceItems = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerInvoiceItemsPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerInvoiceItems collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerInvoiceItems($v = true)
    {
        $this->collNestleBowerInvoiceItemsPartial = $v;
    }

    /**
     * Initializes the collNestleBowerInvoiceItems collection.
     *
     * By default this just sets the collNestleBowerInvoiceItems collection to an empty array (like clearcollNestleBowerInvoiceItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerInvoiceItems($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerInvoiceItems && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerInvoiceItems = new PropelObjectCollection();
        $this->collNestleBowerInvoiceItems->setModel('NestleBowerInvoiceItem');
    }

    /**
     * Gets an array of NestleBowerInvoiceItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBowerProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerInvoiceItem[] List of NestleBowerInvoiceItem objects
     * @throws PropelException
     */
    public function getNestleBowerInvoiceItems($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerInvoiceItemsPartial && !$this->isNew();
        if (null === $this->collNestleBowerInvoiceItems || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerInvoiceItems) {
                // return empty collection
                $this->initNestleBowerInvoiceItems();
            } else {
                $collNestleBowerInvoiceItems = NestleBowerInvoiceItemQuery::create(null, $criteria)
                    ->filterByNestleBowerProduct($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerInvoiceItemsPartial && count($collNestleBowerInvoiceItems)) {
                      $this->initNestleBowerInvoiceItems(false);

                      foreach ($collNestleBowerInvoiceItems as $obj) {
                        if (false == $this->collNestleBowerInvoiceItems->contains($obj)) {
                          $this->collNestleBowerInvoiceItems->append($obj);
                        }
                      }

                      $this->collNestleBowerInvoiceItemsPartial = true;
                    }

                    $collNestleBowerInvoiceItems->getInternalIterator()->rewind();

                    return $collNestleBowerInvoiceItems;
                }

                if ($partial && $this->collNestleBowerInvoiceItems) {
                    foreach ($this->collNestleBowerInvoiceItems as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerInvoiceItems[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerInvoiceItems = $collNestleBowerInvoiceItems;
                $this->collNestleBowerInvoiceItemsPartial = false;
            }
        }

        return $this->collNestleBowerInvoiceItems;
    }

    /**
     * Sets a collection of NestleBowerInvoiceItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerInvoiceItems A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setNestleBowerInvoiceItems(PropelCollection $nestleBowerInvoiceItems, PropelPDO $con = null)
    {
        $nestleBowerInvoiceItemsToDelete = $this->getNestleBowerInvoiceItems(new Criteria(), $con)->diff($nestleBowerInvoiceItems);


        $this->nestleBowerInvoiceItemsScheduledForDeletion = $nestleBowerInvoiceItemsToDelete;

        foreach ($nestleBowerInvoiceItemsToDelete as $nestleBowerInvoiceItemRemoved) {
            $nestleBowerInvoiceItemRemoved->setNestleBowerProduct(null);
        }

        $this->collNestleBowerInvoiceItems = null;
        foreach ($nestleBowerInvoiceItems as $nestleBowerInvoiceItem) {
            $this->addNestleBowerInvoiceItem($nestleBowerInvoiceItem);
        }

        $this->collNestleBowerInvoiceItems = $nestleBowerInvoiceItems;
        $this->collNestleBowerInvoiceItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerInvoiceItem objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerInvoiceItem objects.
     * @throws PropelException
     */
    public function countNestleBowerInvoiceItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerInvoiceItemsPartial && !$this->isNew();
        if (null === $this->collNestleBowerInvoiceItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerInvoiceItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerInvoiceItems());
            }
            $query = NestleBowerInvoiceItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBowerProduct($this)
                ->count($con);
        }

        return count($this->collNestleBowerInvoiceItems);
    }

    /**
     * Method called to associate a NestleBowerInvoiceItem object to this object
     * through the NestleBowerInvoiceItem foreign key attribute.
     *
     * @param    NestleBowerInvoiceItem $l NestleBowerInvoiceItem
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function addNestleBowerInvoiceItem(NestleBowerInvoiceItem $l)
    {
        if ($this->collNestleBowerInvoiceItems === null) {
            $this->initNestleBowerInvoiceItems();
            $this->collNestleBowerInvoiceItemsPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerInvoiceItems->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerInvoiceItem($l);

            if ($this->nestleBowerInvoiceItemsScheduledForDeletion and $this->nestleBowerInvoiceItemsScheduledForDeletion->contains($l)) {
                $this->nestleBowerInvoiceItemsScheduledForDeletion->remove($this->nestleBowerInvoiceItemsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerInvoiceItem $nestleBowerInvoiceItem The nestleBowerInvoiceItem object to add.
     */
    protected function doAddNestleBowerInvoiceItem($nestleBowerInvoiceItem)
    {
        $this->collNestleBowerInvoiceItems[]= $nestleBowerInvoiceItem;
        $nestleBowerInvoiceItem->setNestleBowerProduct($this);
    }

    /**
     * @param	NestleBowerInvoiceItem $nestleBowerInvoiceItem The nestleBowerInvoiceItem object to remove.
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function removeNestleBowerInvoiceItem($nestleBowerInvoiceItem)
    {
        if ($this->getNestleBowerInvoiceItems()->contains($nestleBowerInvoiceItem)) {
            $this->collNestleBowerInvoiceItems->remove($this->collNestleBowerInvoiceItems->search($nestleBowerInvoiceItem));
            if (null === $this->nestleBowerInvoiceItemsScheduledForDeletion) {
                $this->nestleBowerInvoiceItemsScheduledForDeletion = clone $this->collNestleBowerInvoiceItems;
                $this->nestleBowerInvoiceItemsScheduledForDeletion->clear();
            }
            $this->nestleBowerInvoiceItemsScheduledForDeletion[]= $nestleBowerInvoiceItem;
            $nestleBowerInvoiceItem->setNestleBowerProduct(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this NestleBowerProduct is new, it will return
     * an empty collection; or if this NestleBowerProduct has previously
     * been saved, it will retrieve related NestleBowerInvoiceItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in NestleBowerProduct.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NestleBowerInvoiceItem[] List of NestleBowerInvoiceItem objects
     */
    public function getNestleBowerInvoiceItemsJoinNestleBowerInvoices($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NestleBowerInvoiceItemQuery::create(null, $criteria);
        $query->joinWith('NestleBowerInvoices', $join_behavior);

        return $this->getNestleBowerInvoiceItems($query, $con);
    }

    /**
     * Clears out the collNestleBowerRulessRelatedByProductId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerProduct The current object (for fluent API support)
     * @see        addNestleBowerRulessRelatedByProductId()
     */
    public function clearNestleBowerRulessRelatedByProductId()
    {
        $this->collNestleBowerRulessRelatedByProductId = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerRulessRelatedByProductIdPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerRulessRelatedByProductId collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerRulessRelatedByProductId($v = true)
    {
        $this->collNestleBowerRulessRelatedByProductIdPartial = $v;
    }

    /**
     * Initializes the collNestleBowerRulessRelatedByProductId collection.
     *
     * By default this just sets the collNestleBowerRulessRelatedByProductId collection to an empty array (like clearcollNestleBowerRulessRelatedByProductId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerRulessRelatedByProductId($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerRulessRelatedByProductId && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerRulessRelatedByProductId = new PropelObjectCollection();
        $this->collNestleBowerRulessRelatedByProductId->setModel('NestleBowerRules');
    }

    /**
     * Gets an array of NestleBowerRules objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBowerProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerRules[] List of NestleBowerRules objects
     * @throws PropelException
     */
    public function getNestleBowerRulessRelatedByProductId($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerRulessRelatedByProductIdPartial && !$this->isNew();
        if (null === $this->collNestleBowerRulessRelatedByProductId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerRulessRelatedByProductId) {
                // return empty collection
                $this->initNestleBowerRulessRelatedByProductId();
            } else {
                $collNestleBowerRulessRelatedByProductId = NestleBowerRulesQuery::create(null, $criteria)
                    ->filterByNestleBowerProductRelatedByProductId($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerRulessRelatedByProductIdPartial && count($collNestleBowerRulessRelatedByProductId)) {
                      $this->initNestleBowerRulessRelatedByProductId(false);

                      foreach ($collNestleBowerRulessRelatedByProductId as $obj) {
                        if (false == $this->collNestleBowerRulessRelatedByProductId->contains($obj)) {
                          $this->collNestleBowerRulessRelatedByProductId->append($obj);
                        }
                      }

                      $this->collNestleBowerRulessRelatedByProductIdPartial = true;
                    }

                    $collNestleBowerRulessRelatedByProductId->getInternalIterator()->rewind();

                    return $collNestleBowerRulessRelatedByProductId;
                }

                if ($partial && $this->collNestleBowerRulessRelatedByProductId) {
                    foreach ($this->collNestleBowerRulessRelatedByProductId as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerRulessRelatedByProductId[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerRulessRelatedByProductId = $collNestleBowerRulessRelatedByProductId;
                $this->collNestleBowerRulessRelatedByProductIdPartial = false;
            }
        }

        return $this->collNestleBowerRulessRelatedByProductId;
    }

    /**
     * Sets a collection of NestleBowerRulesRelatedByProductId objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerRulessRelatedByProductId A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setNestleBowerRulessRelatedByProductId(PropelCollection $nestleBowerRulessRelatedByProductId, PropelPDO $con = null)
    {
        $nestleBowerRulessRelatedByProductIdToDelete = $this->getNestleBowerRulessRelatedByProductId(new Criteria(), $con)->diff($nestleBowerRulessRelatedByProductId);


        $this->nestleBowerRulessRelatedByProductIdScheduledForDeletion = $nestleBowerRulessRelatedByProductIdToDelete;

        foreach ($nestleBowerRulessRelatedByProductIdToDelete as $nestleBowerRulesRelatedByProductIdRemoved) {
            $nestleBowerRulesRelatedByProductIdRemoved->setNestleBowerProductRelatedByProductId(null);
        }

        $this->collNestleBowerRulessRelatedByProductId = null;
        foreach ($nestleBowerRulessRelatedByProductId as $nestleBowerRulesRelatedByProductId) {
            $this->addNestleBowerRulesRelatedByProductId($nestleBowerRulesRelatedByProductId);
        }

        $this->collNestleBowerRulessRelatedByProductId = $nestleBowerRulessRelatedByProductId;
        $this->collNestleBowerRulessRelatedByProductIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerRules objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerRules objects.
     * @throws PropelException
     */
    public function countNestleBowerRulessRelatedByProductId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerRulessRelatedByProductIdPartial && !$this->isNew();
        if (null === $this->collNestleBowerRulessRelatedByProductId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerRulessRelatedByProductId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerRulessRelatedByProductId());
            }
            $query = NestleBowerRulesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBowerProductRelatedByProductId($this)
                ->count($con);
        }

        return count($this->collNestleBowerRulessRelatedByProductId);
    }

    /**
     * Method called to associate a NestleBowerRules object to this object
     * through the NestleBowerRules foreign key attribute.
     *
     * @param    NestleBowerRules $l NestleBowerRules
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function addNestleBowerRulesRelatedByProductId(NestleBowerRules $l)
    {
        if ($this->collNestleBowerRulessRelatedByProductId === null) {
            $this->initNestleBowerRulessRelatedByProductId();
            $this->collNestleBowerRulessRelatedByProductIdPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerRulessRelatedByProductId->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerRulesRelatedByProductId($l);

            if ($this->nestleBowerRulessRelatedByProductIdScheduledForDeletion and $this->nestleBowerRulessRelatedByProductIdScheduledForDeletion->contains($l)) {
                $this->nestleBowerRulessRelatedByProductIdScheduledForDeletion->remove($this->nestleBowerRulessRelatedByProductIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerRulesRelatedByProductId $nestleBowerRulesRelatedByProductId The nestleBowerRulesRelatedByProductId object to add.
     */
    protected function doAddNestleBowerRulesRelatedByProductId($nestleBowerRulesRelatedByProductId)
    {
        $this->collNestleBowerRulessRelatedByProductId[]= $nestleBowerRulesRelatedByProductId;
        $nestleBowerRulesRelatedByProductId->setNestleBowerProductRelatedByProductId($this);
    }

    /**
     * @param	NestleBowerRulesRelatedByProductId $nestleBowerRulesRelatedByProductId The nestleBowerRulesRelatedByProductId object to remove.
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function removeNestleBowerRulesRelatedByProductId($nestleBowerRulesRelatedByProductId)
    {
        if ($this->getNestleBowerRulessRelatedByProductId()->contains($nestleBowerRulesRelatedByProductId)) {
            $this->collNestleBowerRulessRelatedByProductId->remove($this->collNestleBowerRulessRelatedByProductId->search($nestleBowerRulesRelatedByProductId));
            if (null === $this->nestleBowerRulessRelatedByProductIdScheduledForDeletion) {
                $this->nestleBowerRulessRelatedByProductIdScheduledForDeletion = clone $this->collNestleBowerRulessRelatedByProductId;
                $this->nestleBowerRulessRelatedByProductIdScheduledForDeletion->clear();
            }
            $this->nestleBowerRulessRelatedByProductIdScheduledForDeletion[]= $nestleBowerRulesRelatedByProductId;
            $nestleBowerRulesRelatedByProductId->setNestleBowerProductRelatedByProductId(null);
        }

        return $this;
    }

    /**
     * Clears out the collNestleBowerRulessRelatedByPromoProductId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return NestleBowerProduct The current object (for fluent API support)
     * @see        addNestleBowerRulessRelatedByPromoProductId()
     */
    public function clearNestleBowerRulessRelatedByPromoProductId()
    {
        $this->collNestleBowerRulessRelatedByPromoProductId = null; // important to set this to null since that means it is uninitialized
        $this->collNestleBowerRulessRelatedByPromoProductIdPartial = null;

        return $this;
    }

    /**
     * reset is the collNestleBowerRulessRelatedByPromoProductId collection loaded partially
     *
     * @return void
     */
    public function resetPartialNestleBowerRulessRelatedByPromoProductId($v = true)
    {
        $this->collNestleBowerRulessRelatedByPromoProductIdPartial = $v;
    }

    /**
     * Initializes the collNestleBowerRulessRelatedByPromoProductId collection.
     *
     * By default this just sets the collNestleBowerRulessRelatedByPromoProductId collection to an empty array (like clearcollNestleBowerRulessRelatedByPromoProductId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNestleBowerRulessRelatedByPromoProductId($overrideExisting = true)
    {
        if (null !== $this->collNestleBowerRulessRelatedByPromoProductId && !$overrideExisting) {
            return;
        }
        $this->collNestleBowerRulessRelatedByPromoProductId = new PropelObjectCollection();
        $this->collNestleBowerRulessRelatedByPromoProductId->setModel('NestleBowerRules');
    }

    /**
     * Gets an array of NestleBowerRules objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this NestleBowerProduct is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NestleBowerRules[] List of NestleBowerRules objects
     * @throws PropelException
     */
    public function getNestleBowerRulessRelatedByPromoProductId($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerRulessRelatedByPromoProductIdPartial && !$this->isNew();
        if (null === $this->collNestleBowerRulessRelatedByPromoProductId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerRulessRelatedByPromoProductId) {
                // return empty collection
                $this->initNestleBowerRulessRelatedByPromoProductId();
            } else {
                $collNestleBowerRulessRelatedByPromoProductId = NestleBowerRulesQuery::create(null, $criteria)
                    ->filterByNestleBowerProductRelatedByPromoProductId($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNestleBowerRulessRelatedByPromoProductIdPartial && count($collNestleBowerRulessRelatedByPromoProductId)) {
                      $this->initNestleBowerRulessRelatedByPromoProductId(false);

                      foreach ($collNestleBowerRulessRelatedByPromoProductId as $obj) {
                        if (false == $this->collNestleBowerRulessRelatedByPromoProductId->contains($obj)) {
                          $this->collNestleBowerRulessRelatedByPromoProductId->append($obj);
                        }
                      }

                      $this->collNestleBowerRulessRelatedByPromoProductIdPartial = true;
                    }

                    $collNestleBowerRulessRelatedByPromoProductId->getInternalIterator()->rewind();

                    return $collNestleBowerRulessRelatedByPromoProductId;
                }

                if ($partial && $this->collNestleBowerRulessRelatedByPromoProductId) {
                    foreach ($this->collNestleBowerRulessRelatedByPromoProductId as $obj) {
                        if ($obj->isNew()) {
                            $collNestleBowerRulessRelatedByPromoProductId[] = $obj;
                        }
                    }
                }

                $this->collNestleBowerRulessRelatedByPromoProductId = $collNestleBowerRulessRelatedByPromoProductId;
                $this->collNestleBowerRulessRelatedByPromoProductIdPartial = false;
            }
        }

        return $this->collNestleBowerRulessRelatedByPromoProductId;
    }

    /**
     * Sets a collection of NestleBowerRulesRelatedByPromoProductId objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nestleBowerRulessRelatedByPromoProductId A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function setNestleBowerRulessRelatedByPromoProductId(PropelCollection $nestleBowerRulessRelatedByPromoProductId, PropelPDO $con = null)
    {
        $nestleBowerRulessRelatedByPromoProductIdToDelete = $this->getNestleBowerRulessRelatedByPromoProductId(new Criteria(), $con)->diff($nestleBowerRulessRelatedByPromoProductId);


        $this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion = $nestleBowerRulessRelatedByPromoProductIdToDelete;

        foreach ($nestleBowerRulessRelatedByPromoProductIdToDelete as $nestleBowerRulesRelatedByPromoProductIdRemoved) {
            $nestleBowerRulesRelatedByPromoProductIdRemoved->setNestleBowerProductRelatedByPromoProductId(null);
        }

        $this->collNestleBowerRulessRelatedByPromoProductId = null;
        foreach ($nestleBowerRulessRelatedByPromoProductId as $nestleBowerRulesRelatedByPromoProductId) {
            $this->addNestleBowerRulesRelatedByPromoProductId($nestleBowerRulesRelatedByPromoProductId);
        }

        $this->collNestleBowerRulessRelatedByPromoProductId = $nestleBowerRulessRelatedByPromoProductId;
        $this->collNestleBowerRulessRelatedByPromoProductIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NestleBowerRules objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NestleBowerRules objects.
     * @throws PropelException
     */
    public function countNestleBowerRulessRelatedByPromoProductId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNestleBowerRulessRelatedByPromoProductIdPartial && !$this->isNew();
        if (null === $this->collNestleBowerRulessRelatedByPromoProductId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNestleBowerRulessRelatedByPromoProductId) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNestleBowerRulessRelatedByPromoProductId());
            }
            $query = NestleBowerRulesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNestleBowerProductRelatedByPromoProductId($this)
                ->count($con);
        }

        return count($this->collNestleBowerRulessRelatedByPromoProductId);
    }

    /**
     * Method called to associate a NestleBowerRules object to this object
     * through the NestleBowerRules foreign key attribute.
     *
     * @param    NestleBowerRules $l NestleBowerRules
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function addNestleBowerRulesRelatedByPromoProductId(NestleBowerRules $l)
    {
        if ($this->collNestleBowerRulessRelatedByPromoProductId === null) {
            $this->initNestleBowerRulessRelatedByPromoProductId();
            $this->collNestleBowerRulessRelatedByPromoProductIdPartial = true;
        }

        if (!in_array($l, $this->collNestleBowerRulessRelatedByPromoProductId->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNestleBowerRulesRelatedByPromoProductId($l);

            if ($this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion and $this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion->contains($l)) {
                $this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion->remove($this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	NestleBowerRulesRelatedByPromoProductId $nestleBowerRulesRelatedByPromoProductId The nestleBowerRulesRelatedByPromoProductId object to add.
     */
    protected function doAddNestleBowerRulesRelatedByPromoProductId($nestleBowerRulesRelatedByPromoProductId)
    {
        $this->collNestleBowerRulessRelatedByPromoProductId[]= $nestleBowerRulesRelatedByPromoProductId;
        $nestleBowerRulesRelatedByPromoProductId->setNestleBowerProductRelatedByPromoProductId($this);
    }

    /**
     * @param	NestleBowerRulesRelatedByPromoProductId $nestleBowerRulesRelatedByPromoProductId The nestleBowerRulesRelatedByPromoProductId object to remove.
     * @return NestleBowerProduct The current object (for fluent API support)
     */
    public function removeNestleBowerRulesRelatedByPromoProductId($nestleBowerRulesRelatedByPromoProductId)
    {
        if ($this->getNestleBowerRulessRelatedByPromoProductId()->contains($nestleBowerRulesRelatedByPromoProductId)) {
            $this->collNestleBowerRulessRelatedByPromoProductId->remove($this->collNestleBowerRulessRelatedByPromoProductId->search($nestleBowerRulesRelatedByPromoProductId));
            if (null === $this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion) {
                $this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion = clone $this->collNestleBowerRulessRelatedByPromoProductId;
                $this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion->clear();
            }
            $this->nestleBowerRulessRelatedByPromoProductIdScheduledForDeletion[]= $nestleBowerRulesRelatedByPromoProductId;
            $nestleBowerRulesRelatedByPromoProductId->setNestleBowerProductRelatedByPromoProductId(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->product_category_id = null;
        $this->sku = null;
        $this->name = null;
        $this->background_color = null;
        $this->font_color = null;
        $this->image = null;
        $this->thumbnail = null;
        $this->base_price = null;
        $this->vat = null;
        $this->date_added = null;
        $this->status = null;
        $this->type = null;
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
            if ($this->collNestleBowerBrandProducts) {
                foreach ($this->collNestleBowerBrandProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNestleBowerInvoiceItems) {
                foreach ($this->collNestleBowerInvoiceItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNestleBowerRulessRelatedByProductId) {
                foreach ($this->collNestleBowerRulessRelatedByProductId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNestleBowerRulessRelatedByPromoProductId) {
                foreach ($this->collNestleBowerRulessRelatedByPromoProductId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aNestleBowerProductCategory instanceof Persistent) {
              $this->aNestleBowerProductCategory->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collNestleBowerBrandProducts instanceof PropelCollection) {
            $this->collNestleBowerBrandProducts->clearIterator();
        }
        $this->collNestleBowerBrandProducts = null;
        if ($this->collNestleBowerInvoiceItems instanceof PropelCollection) {
            $this->collNestleBowerInvoiceItems->clearIterator();
        }
        $this->collNestleBowerInvoiceItems = null;
        if ($this->collNestleBowerRulessRelatedByProductId instanceof PropelCollection) {
            $this->collNestleBowerRulessRelatedByProductId->clearIterator();
        }
        $this->collNestleBowerRulessRelatedByProductId = null;
        if ($this->collNestleBowerRulessRelatedByPromoProductId instanceof PropelCollection) {
            $this->collNestleBowerRulessRelatedByPromoProductId->clearIterator();
        }
        $this->collNestleBowerRulessRelatedByPromoProductId = null;
        $this->aNestleBowerProductCategory = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NestleBowerProductPeer::DEFAULT_STRING_FORMAT);
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
