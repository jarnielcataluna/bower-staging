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
use Nestle\CoreBundle\Model\NestleBowerInvoiceItem;
use Nestle\CoreBundle\Model\NestleBowerInvoiceItemPeer;
use Nestle\CoreBundle\Model\NestleBowerInvoiceItemQuery;
use Nestle\CoreBundle\Model\NestleBowerInvoices;
use Nestle\CoreBundle\Model\NestleBowerProduct;

/**
 * @method NestleBowerInvoiceItemQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerInvoiceItemQuery orderByInvoiceId($order = Criteria::ASC) Order by the invoice_id column
 * @method NestleBowerInvoiceItemQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method NestleBowerInvoiceItemQuery orderByUnitPrice($order = Criteria::ASC) Order by the unit_price column
 * @method NestleBowerInvoiceItemQuery orderByQty($order = Criteria::ASC) Order by the qty column
 * @method NestleBowerInvoiceItemQuery orderByTotalSales($order = Criteria::ASC) Order by the total_sales column
 *
 * @method NestleBowerInvoiceItemQuery groupById() Group by the id column
 * @method NestleBowerInvoiceItemQuery groupByInvoiceId() Group by the invoice_id column
 * @method NestleBowerInvoiceItemQuery groupByProductId() Group by the product_id column
 * @method NestleBowerInvoiceItemQuery groupByUnitPrice() Group by the unit_price column
 * @method NestleBowerInvoiceItemQuery groupByQty() Group by the qty column
 * @method NestleBowerInvoiceItemQuery groupByTotalSales() Group by the total_sales column
 *
 * @method NestleBowerInvoiceItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerInvoiceItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerInvoiceItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerInvoiceItemQuery leftJoinNestleBowerInvoices($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerInvoices relation
 * @method NestleBowerInvoiceItemQuery rightJoinNestleBowerInvoices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerInvoices relation
 * @method NestleBowerInvoiceItemQuery innerJoinNestleBowerInvoices($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerInvoices relation
 *
 * @method NestleBowerInvoiceItemQuery leftJoinNestleBowerProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerProduct relation
 * @method NestleBowerInvoiceItemQuery rightJoinNestleBowerProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerProduct relation
 * @method NestleBowerInvoiceItemQuery innerJoinNestleBowerProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerProduct relation
 *
 * @method NestleBowerInvoiceItem findOne(PropelPDO $con = null) Return the first NestleBowerInvoiceItem matching the query
 * @method NestleBowerInvoiceItem findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerInvoiceItem matching the query, or a new NestleBowerInvoiceItem object populated from the query conditions when no match is found
 *
 * @method NestleBowerInvoiceItem findOneByInvoiceId(int $invoice_id) Return the first NestleBowerInvoiceItem filtered by the invoice_id column
 * @method NestleBowerInvoiceItem findOneByProductId(int $product_id) Return the first NestleBowerInvoiceItem filtered by the product_id column
 * @method NestleBowerInvoiceItem findOneByUnitPrice(double $unit_price) Return the first NestleBowerInvoiceItem filtered by the unit_price column
 * @method NestleBowerInvoiceItem findOneByQty(int $qty) Return the first NestleBowerInvoiceItem filtered by the qty column
 * @method NestleBowerInvoiceItem findOneByTotalSales(double $total_sales) Return the first NestleBowerInvoiceItem filtered by the total_sales column
 *
 * @method array findById(int $id) Return NestleBowerInvoiceItem objects filtered by the id column
 * @method array findByInvoiceId(int $invoice_id) Return NestleBowerInvoiceItem objects filtered by the invoice_id column
 * @method array findByProductId(int $product_id) Return NestleBowerInvoiceItem objects filtered by the product_id column
 * @method array findByUnitPrice(double $unit_price) Return NestleBowerInvoiceItem objects filtered by the unit_price column
 * @method array findByQty(int $qty) Return NestleBowerInvoiceItem objects filtered by the qty column
 * @method array findByTotalSales(double $total_sales) Return NestleBowerInvoiceItem objects filtered by the total_sales column
 */
abstract class BaseNestleBowerInvoiceItemQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerInvoiceItemQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerInvoiceItem';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerInvoiceItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerInvoiceItemQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerInvoiceItemQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerInvoiceItemQuery) {
            return $criteria;
        }
        $query = new NestleBowerInvoiceItemQuery(null, null, $modelAlias);

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
     * @return   NestleBowerInvoiceItem|NestleBowerInvoiceItem[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerInvoiceItemPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerInvoiceItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerInvoiceItem A model object, or null if the key is not found
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
     * @return                 NestleBowerInvoiceItem A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `invoice_id`, `product_id`, `unit_price`, `qty`, `total_sales` FROM `invoice_item` WHERE `id` = :p0';
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
            $obj = new NestleBowerInvoiceItem();
            $obj->hydrate($row);
            NestleBowerInvoiceItemPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerInvoiceItem|NestleBowerInvoiceItem[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerInvoiceItem[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerInvoiceItemPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerInvoiceItemPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoiceItemPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the invoice_id column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceId(1234); // WHERE invoice_id = 1234
     * $query->filterByInvoiceId(array(12, 34)); // WHERE invoice_id IN (12, 34)
     * $query->filterByInvoiceId(array('min' => 12)); // WHERE invoice_id >= 12
     * $query->filterByInvoiceId(array('max' => 12)); // WHERE invoice_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerInvoices()
     *
     * @param     mixed $invoiceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function filterByInvoiceId($invoiceId = null, $comparison = null)
    {
        if (is_array($invoiceId)) {
            $useMinMax = false;
            if (isset($invoiceId['min'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::INVOICE_ID, $invoiceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($invoiceId['max'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::INVOICE_ID, $invoiceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoiceItemPeer::INVOICE_ID, $invoiceId, $comparison);
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
     * @see       filterByNestleBowerProduct()
     *
     * @param     mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoiceItemPeer::PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query on the unit_price column
     *
     * Example usage:
     * <code>
     * $query->filterByUnitPrice(1234); // WHERE unit_price = 1234
     * $query->filterByUnitPrice(array(12, 34)); // WHERE unit_price IN (12, 34)
     * $query->filterByUnitPrice(array('min' => 12)); // WHERE unit_price >= 12
     * $query->filterByUnitPrice(array('max' => 12)); // WHERE unit_price <= 12
     * </code>
     *
     * @param     mixed $unitPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function filterByUnitPrice($unitPrice = null, $comparison = null)
    {
        if (is_array($unitPrice)) {
            $useMinMax = false;
            if (isset($unitPrice['min'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::UNIT_PRICE, $unitPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($unitPrice['max'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::UNIT_PRICE, $unitPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoiceItemPeer::UNIT_PRICE, $unitPrice, $comparison);
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty >= 12
     * $query->filterByQty(array('max' => 12)); // WHERE qty <= 12
     * </code>
     *
     * @param     mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoiceItemPeer::QTY, $qty, $comparison);
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
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function filterByTotalSales($totalSales = null, $comparison = null)
    {
        if (is_array($totalSales)) {
            $useMinMax = false;
            if (isset($totalSales['min'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::TOTAL_SALES, $totalSales['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalSales['max'])) {
                $this->addUsingAlias(NestleBowerInvoiceItemPeer::TOTAL_SALES, $totalSales['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerInvoiceItemPeer::TOTAL_SALES, $totalSales, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerInvoices object
     *
     * @param   NestleBowerInvoices|PropelObjectCollection $nestleBowerInvoices The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerInvoiceItemQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerInvoices($nestleBowerInvoices, $comparison = null)
    {
        if ($nestleBowerInvoices instanceof NestleBowerInvoices) {
            return $this
                ->addUsingAlias(NestleBowerInvoiceItemPeer::INVOICE_ID, $nestleBowerInvoices->getId(), $comparison);
        } elseif ($nestleBowerInvoices instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerInvoiceItemPeer::INVOICE_ID, $nestleBowerInvoices->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerInvoices() only accepts arguments of type NestleBowerInvoices or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerInvoices relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function joinNestleBowerInvoices($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerInvoices');

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
            $this->addJoinObject($join, 'NestleBowerInvoices');
        }

        return $this;
    }

    /**
     * Use the NestleBowerInvoices relation NestleBowerInvoices object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerInvoicesQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerInvoicesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerInvoices($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerInvoices', '\Nestle\CoreBundle\Model\NestleBowerInvoicesQuery');
    }

    /**
     * Filter the query by a related NestleBowerProduct object
     *
     * @param   NestleBowerProduct|PropelObjectCollection $nestleBowerProduct The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerInvoiceItemQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerProduct($nestleBowerProduct, $comparison = null)
    {
        if ($nestleBowerProduct instanceof NestleBowerProduct) {
            return $this
                ->addUsingAlias(NestleBowerInvoiceItemPeer::PRODUCT_ID, $nestleBowerProduct->getId(), $comparison);
        } elseif ($nestleBowerProduct instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerInvoiceItemPeer::PRODUCT_ID, $nestleBowerProduct->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerProduct() only accepts arguments of type NestleBowerProduct or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerProduct relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function joinNestleBowerProduct($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerProduct');

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
            $this->addJoinObject($join, 'NestleBowerProduct');
        }

        return $this;
    }

    /**
     * Use the NestleBowerProduct relation NestleBowerProduct object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerProductQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerProductQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerProduct', '\Nestle\CoreBundle\Model\NestleBowerProductQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NestleBowerInvoiceItem $nestleBowerInvoiceItem Object to remove from the list of results
     *
     * @return NestleBowerInvoiceItemQuery The current query, for fluid interface
     */
    public function prune($nestleBowerInvoiceItem = null)
    {
        if ($nestleBowerInvoiceItem) {
            $this->addUsingAlias(NestleBowerInvoiceItemPeer::ID, $nestleBowerInvoiceItem->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
