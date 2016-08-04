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
use Nestle\CoreBundle\Model\NestleBowerSalesReport;
use Nestle\CoreBundle\Model\NestleBowerSalesReportInvoice;
use Nestle\CoreBundle\Model\NestleBowerSalesReportPeer;
use Nestle\CoreBundle\Model\NestleBowerSalesReportQuery;

/**
 * @method NestleBowerSalesReportQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerSalesReportQuery orderByBowerId($order = Criteria::ASC) Order by the bower_id column
 * @method NestleBowerSalesReportQuery orderByTotalSales($order = Criteria::ASC) Order by the total_sales column
 * @method NestleBowerSalesReportQuery orderByTotalSkus($order = Criteria::ASC) Order by the total_skus column
 * @method NestleBowerSalesReportQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method NestleBowerSalesReportQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerSalesReportQuery groupById() Group by the id column
 * @method NestleBowerSalesReportQuery groupByBowerId() Group by the bower_id column
 * @method NestleBowerSalesReportQuery groupByTotalSales() Group by the total_sales column
 * @method NestleBowerSalesReportQuery groupByTotalSkus() Group by the total_skus column
 * @method NestleBowerSalesReportQuery groupByDate() Group by the date column
 * @method NestleBowerSalesReportQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerSalesReportQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerSalesReportQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerSalesReportQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerSalesReportQuery leftJoinNestleBower($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBower relation
 * @method NestleBowerSalesReportQuery rightJoinNestleBower($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBower relation
 * @method NestleBowerSalesReportQuery innerJoinNestleBower($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBower relation
 *
 * @method NestleBowerSalesReportQuery leftJoinNestleBowerSalesReportInvoice($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerSalesReportInvoice relation
 * @method NestleBowerSalesReportQuery rightJoinNestleBowerSalesReportInvoice($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerSalesReportInvoice relation
 * @method NestleBowerSalesReportQuery innerJoinNestleBowerSalesReportInvoice($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerSalesReportInvoice relation
 *
 * @method NestleBowerSalesReport findOne(PropelPDO $con = null) Return the first NestleBowerSalesReport matching the query
 * @method NestleBowerSalesReport findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerSalesReport matching the query, or a new NestleBowerSalesReport object populated from the query conditions when no match is found
 *
 * @method NestleBowerSalesReport findOneByBowerId(int $bower_id) Return the first NestleBowerSalesReport filtered by the bower_id column
 * @method NestleBowerSalesReport findOneByTotalSales(double $total_sales) Return the first NestleBowerSalesReport filtered by the total_sales column
 * @method NestleBowerSalesReport findOneByTotalSkus(int $total_skus) Return the first NestleBowerSalesReport filtered by the total_skus column
 * @method NestleBowerSalesReport findOneByDate(string $date) Return the first NestleBowerSalesReport filtered by the date column
 * @method NestleBowerSalesReport findOneByStatus(int $status) Return the first NestleBowerSalesReport filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerSalesReport objects filtered by the id column
 * @method array findByBowerId(int $bower_id) Return NestleBowerSalesReport objects filtered by the bower_id column
 * @method array findByTotalSales(double $total_sales) Return NestleBowerSalesReport objects filtered by the total_sales column
 * @method array findByTotalSkus(int $total_skus) Return NestleBowerSalesReport objects filtered by the total_skus column
 * @method array findByDate(string $date) Return NestleBowerSalesReport objects filtered by the date column
 * @method array findByStatus(int $status) Return NestleBowerSalesReport objects filtered by the status column
 */
abstract class BaseNestleBowerSalesReportQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerSalesReportQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerSalesReport';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerSalesReportQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerSalesReportQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerSalesReportQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerSalesReportQuery) {
            return $criteria;
        }
        $query = new NestleBowerSalesReportQuery(null, null, $modelAlias);

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
     * @return   NestleBowerSalesReport|NestleBowerSalesReport[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerSalesReportPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerSalesReportPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerSalesReport A model object, or null if the key is not found
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
     * @return                 NestleBowerSalesReport A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `bower_id`, `total_sales`, `total_skus`, `date`, `status` FROM `sales_report` WHERE `id` = :p0';
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
            $obj = new NestleBowerSalesReport();
            $obj->hydrate($row);
            NestleBowerSalesReportPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerSalesReport|NestleBowerSalesReport[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerSalesReport[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerSalesReportPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerSalesReportPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerSalesReportPeer::ID, $id, $comparison);
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
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
     */
    public function filterByBowerId($bowerId = null, $comparison = null)
    {
        if (is_array($bowerId)) {
            $useMinMax = false;
            if (isset($bowerId['min'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::BOWER_ID, $bowerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bowerId['max'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::BOWER_ID, $bowerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerSalesReportPeer::BOWER_ID, $bowerId, $comparison);
    }

    /**
     * Filter the query on the total_sales column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalSales(1234); // WHERE total_sales = 1234
     * $query->filterByTotalSales(array(12, 34)); // WHERE total_sales IN (12, 34)
     * $query->filterByTotalSales(array('min' => 12)); // WHERE total_sales >= 12
     * $query->filterByTotalSales(array('max' => 12)); // WHERE total_sales <= 12
     * </code>
     *
     * @param     mixed $totalSales The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
     */
    public function filterByTotalSales($totalSales = null, $comparison = null)
    {
        if (is_array($totalSales)) {
            $useMinMax = false;
            if (isset($totalSales['min'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::TOTAL_SALES, $totalSales['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalSales['max'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::TOTAL_SALES, $totalSales['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerSalesReportPeer::TOTAL_SALES, $totalSales, $comparison);
    }

    /**
     * Filter the query on the total_skus column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalSkus(1234); // WHERE total_skus = 1234
     * $query->filterByTotalSkus(array(12, 34)); // WHERE total_skus IN (12, 34)
     * $query->filterByTotalSkus(array('min' => 12)); // WHERE total_skus >= 12
     * $query->filterByTotalSkus(array('max' => 12)); // WHERE total_skus <= 12
     * </code>
     *
     * @param     mixed $totalSkus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
     */
    public function filterByTotalSkus($totalSkus = null, $comparison = null)
    {
        if (is_array($totalSkus)) {
            $useMinMax = false;
            if (isset($totalSkus['min'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::TOTAL_SKUS, $totalSkus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalSkus['max'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::TOTAL_SKUS, $totalSkus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerSalesReportPeer::TOTAL_SKUS, $totalSkus, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('fooValue');   // WHERE date = 'fooValue'
     * $query->filterByDate('%fooValue%'); // WHERE date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $date The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($date)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $date)) {
                $date = str_replace('*', '%', $date);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerSalesReportPeer::DATE, $date, $comparison);
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
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerSalesReportPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerSalesReportPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBower object
     *
     * @param   NestleBower|PropelObjectCollection $nestleBower The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerSalesReportQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBower($nestleBower, $comparison = null)
    {
        if ($nestleBower instanceof NestleBower) {
            return $this
                ->addUsingAlias(NestleBowerSalesReportPeer::BOWER_ID, $nestleBower->getId(), $comparison);
        } elseif ($nestleBower instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerSalesReportPeer::BOWER_ID, $nestleBower->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
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
     * Filter the query by a related NestleBowerSalesReportInvoice object
     *
     * @param   NestleBowerSalesReportInvoice|PropelObjectCollection $nestleBowerSalesReportInvoice  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerSalesReportQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerSalesReportInvoice($nestleBowerSalesReportInvoice, $comparison = null)
    {
        if ($nestleBowerSalesReportInvoice instanceof NestleBowerSalesReportInvoice) {
            return $this
                ->addUsingAlias(NestleBowerSalesReportPeer::ID, $nestleBowerSalesReportInvoice->getSalesReportId(), $comparison);
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
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
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
     * @param   NestleBowerSalesReport $nestleBowerSalesReport Object to remove from the list of results
     *
     * @return NestleBowerSalesReportQuery The current query, for fluid interface
     */
    public function prune($nestleBowerSalesReport = null)
    {
        if ($nestleBowerSalesReport) {
            $this->addUsingAlias(NestleBowerSalesReportPeer::ID, $nestleBowerSalesReport->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
