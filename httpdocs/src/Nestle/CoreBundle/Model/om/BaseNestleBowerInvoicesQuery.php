<?php

namespace Nestle\CoreBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Nestle\CoreBundle\Model\NestleBower;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcp;
use Nestle\CoreBundle\Model\NestleBowerInvoiceItem;
use Nestle\CoreBundle\Model\NestleBowerInvoices;
use Nestle\CoreBundle\Model\NestleBowerInvoicesPeer;
use Nestle\CoreBundle\Model\NestleBowerInvoicesQuery;
use Nestle\CoreBundle\Model\NestleBowerSalesReportInvoice;

/**
 * @method NestleBowerInvoicesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerInvoicesQuery orderByReceiptId($order = Criteria::ASC) Order by the receipt_id column
 * @method NestleBowerInvoicesQuery orderByInvoiceDate($order = Criteria::ASC) Order by the invoice_date column
 * @method NestleBowerInvoicesQuery orderByAccountId($order = Criteria::ASC) Order by the account_id column
 * @method NestleBowerInvoicesQuery orderBySoldTo($order = Criteria::ASC) Order by the sold_to column
 * @method NestleBowerInvoicesQuery orderByBowerId($order = Criteria::ASC) Order by the bower_id column
 * @method NestleBowerInvoicesQuery orderBySales($order = Criteria::ASC) Order by the sales column
 * @method NestleBowerInvoicesQuery orderBySkus($order = Criteria::ASC) Order by the skus column
 * @method NestleBowerInvoicesQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerInvoicesQuery groupById() Group by the id column
 * @method NestleBowerInvoicesQuery groupByReceiptId() Group by the receipt_id column
 * @method NestleBowerInvoicesQuery groupByInvoiceDate() Group by the invoice_date column
 * @method NestleBowerInvoicesQuery groupByAccountId() Group by the account_id column
 * @method NestleBowerInvoicesQuery groupBySoldTo() Group by the sold_to column
 * @method NestleBowerInvoicesQuery groupByBowerId() Group by the bower_id column
 * @method NestleBowerInvoicesQuery groupBySales() Group by the sales column
 * @method NestleBowerInvoicesQuery groupBySkus() Group by the skus column
 * @method NestleBowerInvoicesQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerInvoicesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerInvoicesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerInvoicesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerInvoicesQuery leftJoinNestleBowerAccountsMcp($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerInvoicesQuery rightJoinNestleBowerAccountsMcp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerInvoicesQuery innerJoinNestleBowerAccountsMcp($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerAccountsMcp relation
 *
 * @method NestleBowerInvoicesQuery leftJoinNestleBower($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBower relation
 * @method NestleBowerInvoicesQuery rightJoinNestleBower($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBower relation
 * @method NestleBowerInvoicesQuery innerJoinNestleBower($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBower relation
 *
 * @method NestleBowerInvoicesQuery leftJoinNestleBowerInvoiceItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerInvoiceItem relation
 * @method NestleBowerInvoicesQuery rightJoinNestleBowerInvoiceItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerInvoiceItem relation
 * @method NestleBowerInvoicesQuery innerJoinNestleBowerInvoiceItem($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerInvoiceItem relation
 *
 * @method NestleBowerInvoicesQuery leftJoinNestleBowerSalesReportInvoice($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerSalesReportInvoice relation
 * @method NestleBowerInvoicesQuery rightJoinNestleBowerSalesReportInvoice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerSalesReportInvoice relation
 * @method NestleBowerInvoicesQuery innerJoinNestleBowerSalesReportInvoice($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerSalesReportInvoice relation
 *
 * @method NestleBowerInvoices findOne(PropelPDO $con = null) Return the first NestleBowerInvoices matching the query
 * @method NestleBowerInvoices findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerInvoices matching the query, or a new NestleBowerInvoices object populated from the query conditions when no match is found
 *
 * @method NestleBowerInvoices findOneByReceiptId(string $receipt_id) Return the first NestleBowerInvoices filtered by the receipt_id column
 * @method NestleBowerInvoices findOneByInvoiceDate(string $invoice_date) Return the first NestleBowerInvoices filtered by the invoice_date column
 * @method NestleBowerInvoices findOneByAccountId(int $account_id) Return the first NestleBowerInvoices filtered by the account_id column
 * @method NestleBowerInvoices findOneBySoldTo(string $sold_to) Return the first NestleBowerInvoices filtered by the sold_to column
 * @method NestleBowerInvoices findOneByBowerId(int $bower_id) Return the first NestleBowerInvoices filtered by the bower_id column
 * @method NestleBowerInvoices findOneBySales(double $sales) Return the first NestleBowerInvoices filtered by the sales column
 * @method NestleBowerInvoices findOneBySkus(int $skus) Return the first NestleBowerInvoices filtered by the skus column
 * @method NestleBowerInvoices findOneByStatus(int $status) Return the first NestleBowerInvoices filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerInvoices objects filtered by the id column
 * @method array findByReceiptId(string $receipt_id) Return NestleBowerInvoices objects filtered by the receipt_id column
 * @method array findByInvoiceDate(string $invoice_date) Return NestleBowerInvoices objects filtered by the invoice_date column
 * @method array findByAccountId(int $account_id) Return NestleBowerInvoices objects filtered by the account_id column
 * @method array findBySoldTo(string $sold_to) Return NestleBowerInvoices objects filtered by the sold_to column
 * @method array findByBowerId(int $bower_id) Return NestleBowerInvoices objects filtered by the bower_id column
 * @method array findBySales(double $sales) Return NestleBowerInvoices objects filtered by the sales column
 * @method array findBySkus(int $skus) Return NestleBowerInvoices objects filtered by the skus column
 * @method array findByStatus(int $status) Return NestleBowerInvoices objects filtered by the status column
 */
abstract class BaseNestleBowerInvoicesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerInvoicesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'default';
        }
        if (null === $modelName) {
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerInvoices';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerInvoicesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerInvoicesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerInvoicesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerInvoicesQuery) {
            return $criteria;
        }
        $query = new NestleBowerInvoicesQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   NestleBowerInvoices|NestleBowerInvoices[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerInvoicesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoicesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 NestleBowerInvoices A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 NestleBowerInvoices A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `receipt_id`, `invoice_date`, `account_id`, `sold_to`, `bower_id`, `sales`, `skus`, `status` FROM `invoices` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new NestleBowerInvoices();
            $obj->hydrate($row);
            NestleBowerInvoicesPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return NestleBowerInvoices|NestleBowerInvoices[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|NestleBowerInvoices[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerInvoicesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerInvoicesPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoicesPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the receipt_id column
     *
     * Example usage:
     * <code>
     * $query->filterByReceiptId('fooValue');   // WHERE receipt_id = 'fooValue'
     * $query->filterByReceiptId('%fooValue%'); // WHERE receipt_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $receiptId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterByReceiptId($receiptId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($receiptId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $receiptId)) {
                $receiptId = str_replace('*', '%', $receiptId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoicesPeer::RECEIPT_ID, $receiptId, $comparison);
    }

    /**
     * Filter the query on the invoice_date column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceDate('fooValue');   // WHERE invoice_date = 'fooValue'
     * $query->filterByInvoiceDate('%fooValue%'); // WHERE invoice_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $invoiceDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterByInvoiceDate($invoiceDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($invoiceDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $invoiceDate)) {
                $invoiceDate = str_replace('*', '%', $invoiceDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoicesPeer::INVOICE_DATE, $invoiceDate, $comparison);
    }

    /**
     * Filter the query on the account_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAccountId(1234); // WHERE account_id = 1234
     * $query->filterByAccountId(array(12, 34)); // WHERE account_id IN (12, 34)
     * $query->filterByAccountId(array('min' => 12)); // WHERE account_id >= 12
     * $query->filterByAccountId(array('max' => 12)); // WHERE account_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerAccountsMcp()
     *
     * @param     mixed $accountId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterByAccountId($accountId = null, $comparison = null)
    {
        if (is_array($accountId)) {
            $useMinMax = false;
            if (isset($accountId['min'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::ACCOUNT_ID, $accountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accountId['max'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::ACCOUNT_ID, $accountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoicesPeer::ACCOUNT_ID, $accountId, $comparison);
    }

    /**
     * Filter the query on the sold_to column
     *
     * Example usage:
     * <code>
     * $query->filterBySoldTo('fooValue');   // WHERE sold_to = 'fooValue'
     * $query->filterBySoldTo('%fooValue%'); // WHERE sold_to LIKE '%fooValue%'
     * </code>
     *
     * @param     string $soldTo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterBySoldTo($soldTo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($soldTo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $soldTo)) {
                $soldTo = str_replace('*', '%', $soldTo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoicesPeer::SOLD_TO, $soldTo, $comparison);
    }

    /**
     * Filter the query on the bower_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBowerId(1234); // WHERE bower_id = 1234
     * $query->filterByBowerId(array(12, 34)); // WHERE bower_id IN (12, 34)
     * $query->filterByBowerId(array('min' => 12)); // WHERE bower_id >= 12
     * $query->filterByBowerId(array('max' => 12)); // WHERE bower_id <= 12
     * </code>
     *
     * @see       filterByNestleBower()
     *
     * @param     mixed $bowerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterByBowerId($bowerId = null, $comparison = null)
    {
        if (is_array($bowerId)) {
            $useMinMax = false;
            if (isset($bowerId['min'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::BOWER_ID, $bowerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bowerId['max'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::BOWER_ID, $bowerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoicesPeer::BOWER_ID, $bowerId, $comparison);
    }

    /**
     * Filter the query on the sales column
     *
     * Example usage:
     * <code>
     * $query->filterBySales(1234); // WHERE sales = 1234
     * $query->filterBySales(array(12, 34)); // WHERE sales IN (12, 34)
     * $query->filterBySales(array('min' => 12)); // WHERE sales >= 12
     * $query->filterBySales(array('max' => 12)); // WHERE sales <= 12
     * </code>
     *
     * @param     mixed $sales The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterBySales($sales = null, $comparison = null)
    {
        if (is_array($sales)) {
            $useMinMax = false;
            if (isset($sales['min'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::SALES, $sales['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sales['max'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::SALES, $sales['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoicesPeer::SALES, $sales, $comparison);
    }

    /**
     * Filter the query on the skus column
     *
     * Example usage:
     * <code>
     * $query->filterBySkus(1234); // WHERE skus = 1234
     * $query->filterBySkus(array(12, 34)); // WHERE skus IN (12, 34)
     * $query->filterBySkus(array('min' => 12)); // WHERE skus >= 12
     * $query->filterBySkus(array('max' => 12)); // WHERE skus <= 12
     * </code>
     *
     * @param     mixed $skus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterBySkus($skus = null, $comparison = null)
    {
        if (is_array($skus)) {
            $useMinMax = false;
            if (isset($skus['min'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::SKUS, $skus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($skus['max'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::SKUS, $skus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoicesPeer::SKUS, $skus, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status >= 12
     * $query->filterByStatus(array('max' => 12)); // WHERE status <= 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerInvoicesPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoicesPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerAccountsMcp object
     *
     * @param   NestleBowerAccountsMcp|PropelObjectCollection $nestleBowerAccountsMcp The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerInvoicesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerAccountsMcp($nestleBowerAccountsMcp, $comparison = null)
    {
        if ($nestleBowerAccountsMcp instanceof NestleBowerAccountsMcp) {
            return $this
                ->addUsingAlias(NestleBowerInvoicesPeer::ACCOUNT_ID, $nestleBowerAccountsMcp->getId(), $comparison);
        } elseif ($nestleBowerAccountsMcp instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerInvoicesPeer::ACCOUNT_ID, $nestleBowerAccountsMcp->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerAccountsMcp() only accepts arguments of type NestleBowerAccountsMcp or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerAccountsMcp relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function joinNestleBowerAccountsMcp($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerAccountsMcp');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'NestleBowerAccountsMcp');
        }

        return $this;
    }

    /**
     * Use the NestleBowerAccountsMcp relation NestleBowerAccountsMcp object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerAccountsMcpQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerAccountsMcpQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerAccountsMcp($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerAccountsMcp', '\Nestle\CoreBundle\Model\NestleBowerAccountsMcpQuery');
    }

    /**
     * Filter the query by a related NestleBower object
     *
     * @param   NestleBower|PropelObjectCollection $nestleBower The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerInvoicesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBower($nestleBower, $comparison = null)
    {
        if ($nestleBower instanceof NestleBower) {
            return $this
                ->addUsingAlias(NestleBowerInvoicesPeer::BOWER_ID, $nestleBower->getId(), $comparison);
        } elseif ($nestleBower instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerInvoicesPeer::BOWER_ID, $nestleBower->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBower() only accepts arguments of type NestleBower or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBower relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function joinNestleBower($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBower');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'NestleBower');
        }

        return $this;
    }

    /**
     * Use the NestleBower relation NestleBower object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBower($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBower', '\Nestle\CoreBundle\Model\NestleBowerQuery');
    }

    /**
     * Filter the query by a related NestleBowerInvoiceItem object
     *
     * @param   NestleBowerInvoiceItem|PropelObjectCollection $nestleBowerInvoiceItem  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerInvoicesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerInvoiceItem($nestleBowerInvoiceItem, $comparison = null)
    {
        if ($nestleBowerInvoiceItem instanceof NestleBowerInvoiceItem) {
            return $this
                ->addUsingAlias(NestleBowerInvoicesPeer::ID, $nestleBowerInvoiceItem->getInvoiceId(), $comparison);
        } elseif ($nestleBowerInvoiceItem instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerInvoiceItemQuery()
                ->filterByPrimaryKeys($nestleBowerInvoiceItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerInvoiceItem() only accepts arguments of type NestleBowerInvoiceItem or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerInvoiceItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function joinNestleBowerInvoiceItem($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerInvoiceItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'NestleBowerInvoiceItem');
        }

        return $this;
    }

    /**
     * Use the NestleBowerInvoiceItem relation NestleBowerInvoiceItem object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerInvoiceItemQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerInvoiceItemQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerInvoiceItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerInvoiceItem', '\Nestle\CoreBundle\Model\NestleBowerInvoiceItemQuery');
    }

    /**
     * Filter the query by a related NestleBowerSalesReportInvoice object
     *
     * @param   NestleBowerSalesReportInvoice|PropelObjectCollection $nestleBowerSalesReportInvoice  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerInvoicesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerSalesReportInvoice($nestleBowerSalesReportInvoice, $comparison = null)
    {
        if ($nestleBowerSalesReportInvoice instanceof NestleBowerSalesReportInvoice) {
            return $this
                ->addUsingAlias(NestleBowerInvoicesPeer::ID, $nestleBowerSalesReportInvoice->getInvoiceId(), $comparison);
        } elseif ($nestleBowerSalesReportInvoice instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerSalesReportInvoiceQuery()
                ->filterByPrimaryKeys($nestleBowerSalesReportInvoice->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerSalesReportInvoice() only accepts arguments of type NestleBowerSalesReportInvoice or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerSalesReportInvoice relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function joinNestleBowerSalesReportInvoice($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerSalesReportInvoice');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'NestleBowerSalesReportInvoice');
        }

        return $this;
    }

    /**
     * Use the NestleBowerSalesReportInvoice relation NestleBowerSalesReportInvoice object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerSalesReportInvoiceQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerSalesReportInvoiceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerSalesReportInvoice($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerSalesReportInvoice', '\Nestle\CoreBundle\Model\NestleBowerSalesReportInvoiceQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NestleBowerInvoices $nestleBowerInvoices Object to remove from the list of results
     *
     * @return NestleBowerInvoicesQuery The current query, for fluid interface
     */
    public function prune($nestleBowerInvoices = null)
    {
        if ($nestleBowerInvoices) {
            $this->addUsingAlias(NestleBowerInvoicesPeer::ID, $nestleBowerInvoices->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
