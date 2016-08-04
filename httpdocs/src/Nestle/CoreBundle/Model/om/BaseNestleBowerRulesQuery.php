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
use Nestle\CoreBundle\Model\NestleBowerProduct;
use Nestle\CoreBundle\Model\NestleBowerPromos;
use Nestle\CoreBundle\Model\NestleBowerRules;
use Nestle\CoreBundle\Model\NestleBowerRulesPeer;
use Nestle\CoreBundle\Model\NestleBowerRulesQuery;

/**
 * @method NestleBowerRulesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerRulesQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method NestleBowerRulesQuery orderByQtyToQualify($order = Criteria::ASC) Order by the qty_to_qualify column
 * @method NestleBowerRulesQuery orderByQtyFree($order = Criteria::ASC) Order by the qty_free column
 * @method NestleBowerRulesQuery orderByPromoProductId($order = Criteria::ASC) Order by the promo_product_id column
 * @method NestleBowerRulesQuery orderByStartDate($order = Criteria::ASC) Order by the start_date column
 * @method NestleBowerRulesQuery orderByEndDate($order = Criteria::ASC) Order by the end_date column
 * @method NestleBowerRulesQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerRulesQuery groupById() Group by the id column
 * @method NestleBowerRulesQuery groupByProductId() Group by the product_id column
 * @method NestleBowerRulesQuery groupByQtyToQualify() Group by the qty_to_qualify column
 * @method NestleBowerRulesQuery groupByQtyFree() Group by the qty_free column
 * @method NestleBowerRulesQuery groupByPromoProductId() Group by the promo_product_id column
 * @method NestleBowerRulesQuery groupByStartDate() Group by the start_date column
 * @method NestleBowerRulesQuery groupByEndDate() Group by the end_date column
 * @method NestleBowerRulesQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerRulesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerRulesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerRulesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerRulesQuery leftJoinNestleBowerProductRelatedByProductId($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerProductRelatedByProductId relation
 * @method NestleBowerRulesQuery rightJoinNestleBowerProductRelatedByProductId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerProductRelatedByProductId relation
 * @method NestleBowerRulesQuery innerJoinNestleBowerProductRelatedByProductId($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerProductRelatedByProductId relation
 *
 * @method NestleBowerRulesQuery leftJoinNestleBowerProductRelatedByPromoProductId($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerProductRelatedByPromoProductId relation
 * @method NestleBowerRulesQuery rightJoinNestleBowerProductRelatedByPromoProductId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerProductRelatedByPromoProductId relation
 * @method NestleBowerRulesQuery innerJoinNestleBowerProductRelatedByPromoProductId($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerProductRelatedByPromoProductId relation
 *
 * @method NestleBowerRulesQuery leftJoinNestleBowerPromos($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerPromos relation
 * @method NestleBowerRulesQuery rightJoinNestleBowerPromos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerPromos relation
 * @method NestleBowerRulesQuery innerJoinNestleBowerPromos($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerPromos relation
 *
 * @method NestleBowerRules findOne(PropelPDO $con = null) Return the first NestleBowerRules matching the query
 * @method NestleBowerRules findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerRules matching the query, or a new NestleBowerRules object populated from the query conditions when no match is found
 *
 * @method NestleBowerRules findOneByProductId(int $product_id) Return the first NestleBowerRules filtered by the product_id column
 * @method NestleBowerRules findOneByQtyToQualify(int $qty_to_qualify) Return the first NestleBowerRules filtered by the qty_to_qualify column
 * @method NestleBowerRules findOneByQtyFree(int $qty_free) Return the first NestleBowerRules filtered by the qty_free column
 * @method NestleBowerRules findOneByPromoProductId(int $promo_product_id) Return the first NestleBowerRules filtered by the promo_product_id column
 * @method NestleBowerRules findOneByStartDate(string $start_date) Return the first NestleBowerRules filtered by the start_date column
 * @method NestleBowerRules findOneByEndDate(string $end_date) Return the first NestleBowerRules filtered by the end_date column
 * @method NestleBowerRules findOneByStatus(int $status) Return the first NestleBowerRules filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerRules objects filtered by the id column
 * @method array findByProductId(int $product_id) Return NestleBowerRules objects filtered by the product_id column
 * @method array findByQtyToQualify(int $qty_to_qualify) Return NestleBowerRules objects filtered by the qty_to_qualify column
 * @method array findByQtyFree(int $qty_free) Return NestleBowerRules objects filtered by the qty_free column
 * @method array findByPromoProductId(int $promo_product_id) Return NestleBowerRules objects filtered by the promo_product_id column
 * @method array findByStartDate(string $start_date) Return NestleBowerRules objects filtered by the start_date column
 * @method array findByEndDate(string $end_date) Return NestleBowerRules objects filtered by the end_date column
 * @method array findByStatus(int $status) Return NestleBowerRules objects filtered by the status column
 */
abstract class BaseNestleBowerRulesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerRulesQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerRules';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerRulesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerRulesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerRulesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerRulesQuery) {
            return $criteria;
        }
        $query = new NestleBowerRulesQuery(null, null, $modelAlias);

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
     * @return   NestleBowerRules|NestleBowerRules[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerRulesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerRulesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerRules A model object, or null if the key is not found
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
     * @return                 NestleBowerRules A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `product_id`, `qty_to_qualify`, `qty_free`, `promo_product_id`, `start_date`, `end_date`, `status` FROM `rules` WHERE `id` = :p0';
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
            $obj = new NestleBowerRules();
            $obj->hydrate($row);
            NestleBowerRulesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerRules|NestleBowerRules[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerRules[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerRulesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerRulesPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerRulesPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id >= 12
     * $query->filterByProductId(array('max' => 12)); // WHERE product_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerProductRelatedByProductId()
     *
     * @param     mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerRulesPeer::PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the qty_to_qualify column
     *
     * Example usage:
     * <code>
     * $query->filterByQtyToQualify(1234); // WHERE qty_to_qualify = 1234
     * $query->filterByQtyToQualify(array(12, 34)); // WHERE qty_to_qualify IN (12, 34)
     * $query->filterByQtyToQualify(array('min' => 12)); // WHERE qty_to_qualify >= 12
     * $query->filterByQtyToQualify(array('max' => 12)); // WHERE qty_to_qualify <= 12
     * </code>
     *
     * @param     mixed $qtyToQualify The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterByQtyToQualify($qtyToQualify = null, $comparison = null)
    {
        if (is_array($qtyToQualify)) {
            $useMinMax = false;
            if (isset($qtyToQualify['min'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::QTY_TO_QUALIFY, $qtyToQualify['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qtyToQualify['max'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::QTY_TO_QUALIFY, $qtyToQualify['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerRulesPeer::QTY_TO_QUALIFY, $qtyToQualify, $comparison);
    }

    /**
     * Filter the query on the qty_free column
     *
     * Example usage:
     * <code>
     * $query->filterByQtyFree(1234); // WHERE qty_free = 1234
     * $query->filterByQtyFree(array(12, 34)); // WHERE qty_free IN (12, 34)
     * $query->filterByQtyFree(array('min' => 12)); // WHERE qty_free >= 12
     * $query->filterByQtyFree(array('max' => 12)); // WHERE qty_free <= 12
     * </code>
     *
     * @param     mixed $qtyFree The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterByQtyFree($qtyFree = null, $comparison = null)
    {
        if (is_array($qtyFree)) {
            $useMinMax = false;
            if (isset($qtyFree['min'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::QTY_FREE, $qtyFree['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qtyFree['max'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::QTY_FREE, $qtyFree['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerRulesPeer::QTY_FREE, $qtyFree, $comparison);
    }

    /**
     * Filter the query on the promo_product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPromoProductId(1234); // WHERE promo_product_id = 1234
     * $query->filterByPromoProductId(array(12, 34)); // WHERE promo_product_id IN (12, 34)
     * $query->filterByPromoProductId(array('min' => 12)); // WHERE promo_product_id >= 12
     * $query->filterByPromoProductId(array('max' => 12)); // WHERE promo_product_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerProductRelatedByPromoProductId()
     *
     * @param     mixed $promoProductId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterByPromoProductId($promoProductId = null, $comparison = null)
    {
        if (is_array($promoProductId)) {
            $useMinMax = false;
            if (isset($promoProductId['min'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::PROMO_PRODUCT_ID, $promoProductId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($promoProductId['max'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::PROMO_PRODUCT_ID, $promoProductId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerRulesPeer::PROMO_PRODUCT_ID, $promoProductId, $comparison);
    }

    /**
     * Filter the query on the start_date column
     *
     * Example usage:
     * <code>
     * $query->filterByStartDate('fooValue');   // WHERE start_date = 'fooValue'
     * $query->filterByStartDate('%fooValue%'); // WHERE start_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $startDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterByStartDate($startDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($startDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $startDate)) {
                $startDate = str_replace('*', '%', $startDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerRulesPeer::START_DATE, $startDate, $comparison);
    }

    /**
     * Filter the query on the end_date column
     *
     * Example usage:
     * <code>
     * $query->filterByEndDate('fooValue');   // WHERE end_date = 'fooValue'
     * $query->filterByEndDate('%fooValue%'); // WHERE end_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $endDate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterByEndDate($endDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endDate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $endDate)) {
                $endDate = str_replace('*', '%', $endDate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerRulesPeer::END_DATE, $endDate, $comparison);
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
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerRulesPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerRulesPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerProduct object
     *
     * @param   NestleBowerProduct|PropelObjectCollection $nestleBowerProduct The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerRulesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerProductRelatedByProductId($nestleBowerProduct, $comparison = null)
    {
        if ($nestleBowerProduct instanceof NestleBowerProduct) {
            return $this
                ->addUsingAlias(NestleBowerRulesPeer::PRODUCT_ID, $nestleBowerProduct->getId(), $comparison);
        } elseif ($nestleBowerProduct instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerRulesPeer::PRODUCT_ID, $nestleBowerProduct->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerProductRelatedByProductId() only accepts arguments of type NestleBowerProduct or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerProductRelatedByProductId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function joinNestleBowerProductRelatedByProductId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerProductRelatedByProductId');

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
            $this->addJoinObject($join, 'NestleBowerProductRelatedByProductId');
        }

        return $this;
    }

    /**
     * Use the NestleBowerProductRelatedByProductId relation NestleBowerProduct object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerProductQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerProductRelatedByProductIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerProductRelatedByProductId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerProductRelatedByProductId', '\Nestle\CoreBundle\Model\NestleBowerProductQuery');
    }

    /**
     * Filter the query by a related NestleBowerProduct object
     *
     * @param   NestleBowerProduct|PropelObjectCollection $nestleBowerProduct The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerRulesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerProductRelatedByPromoProductId($nestleBowerProduct, $comparison = null)
    {
        if ($nestleBowerProduct instanceof NestleBowerProduct) {
            return $this
                ->addUsingAlias(NestleBowerRulesPeer::PROMO_PRODUCT_ID, $nestleBowerProduct->getId(), $comparison);
        } elseif ($nestleBowerProduct instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerRulesPeer::PROMO_PRODUCT_ID, $nestleBowerProduct->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerProductRelatedByPromoProductId() only accepts arguments of type NestleBowerProduct or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerProductRelatedByPromoProductId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function joinNestleBowerProductRelatedByPromoProductId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerProductRelatedByPromoProductId');

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
            $this->addJoinObject($join, 'NestleBowerProductRelatedByPromoProductId');
        }

        return $this;
    }

    /**
     * Use the NestleBowerProductRelatedByPromoProductId relation NestleBowerProduct object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerProductQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerProductRelatedByPromoProductIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerProductRelatedByPromoProductId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerProductRelatedByPromoProductId', '\Nestle\CoreBundle\Model\NestleBowerProductQuery');
    }

    /**
     * Filter the query by a related NestleBowerPromos object
     *
     * @param   NestleBowerPromos|PropelObjectCollection $nestleBowerPromos  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerRulesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerPromos($nestleBowerPromos, $comparison = null)
    {
        if ($nestleBowerPromos instanceof NestleBowerPromos) {
            return $this
                ->addUsingAlias(NestleBowerRulesPeer::ID, $nestleBowerPromos->getRuleId(), $comparison);
        } elseif ($nestleBowerPromos instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerPromosQuery()
                ->filterByPrimaryKeys($nestleBowerPromos->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerPromos() only accepts arguments of type NestleBowerPromos or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerPromos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function joinNestleBowerPromos($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerPromos');

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
            $this->addJoinObject($join, 'NestleBowerPromos');
        }

        return $this;
    }

    /**
     * Use the NestleBowerPromos relation NestleBowerPromos object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerPromosQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerPromosQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerPromos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerPromos', '\Nestle\CoreBundle\Model\NestleBowerPromosQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NestleBowerRules $nestleBowerRules Object to remove from the list of results
     *
     * @return NestleBowerRulesQuery The current query, for fluid interface
     */
    public function prune($nestleBowerRules = null)
    {
        if ($nestleBowerRules) {
            $this->addUsingAlias(NestleBowerRulesPeer::ID, $nestleBowerRules->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
