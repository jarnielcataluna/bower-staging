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
use Nestle\CoreBundle\Model\NestleBowerBrand;
use Nestle\CoreBundle\Model\NestleBowerBrandProduct;
use Nestle\CoreBundle\Model\NestleBowerBrandProductPeer;
use Nestle\CoreBundle\Model\NestleBowerBrandProductQuery;
use Nestle\CoreBundle\Model\NestleBowerProduct;

/**
 * @method NestleBowerBrandProductQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerBrandProductQuery orderByBrandId($order = Criteria::ASC) Order by the brand_id column
 * @method NestleBowerBrandProductQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 *
 * @method NestleBowerBrandProductQuery groupById() Group by the id column
 * @method NestleBowerBrandProductQuery groupByBrandId() Group by the brand_id column
 * @method NestleBowerBrandProductQuery groupByProductId() Group by the product_id column
 *
 * @method NestleBowerBrandProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerBrandProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerBrandProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerBrandProductQuery leftJoinNestleBowerBrand($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerBrand relation
 * @method NestleBowerBrandProductQuery rightJoinNestleBowerBrand($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerBrand relation
 * @method NestleBowerBrandProductQuery innerJoinNestleBowerBrand($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerBrand relation
 *
 * @method NestleBowerBrandProductQuery leftJoinNestleBowerProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerProduct relation
 * @method NestleBowerBrandProductQuery rightJoinNestleBowerProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerProduct relation
 * @method NestleBowerBrandProductQuery innerJoinNestleBowerProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerProduct relation
 *
 * @method NestleBowerBrandProduct findOne(PropelPDO $con = null) Return the first NestleBowerBrandProduct matching the query
 * @method NestleBowerBrandProduct findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerBrandProduct matching the query, or a new NestleBowerBrandProduct object populated from the query conditions when no match is found
 *
 * @method NestleBowerBrandProduct findOneByBrandId(int $brand_id) Return the first NestleBowerBrandProduct filtered by the brand_id column
 * @method NestleBowerBrandProduct findOneByProductId(int $product_id) Return the first NestleBowerBrandProduct filtered by the product_id column
 *
 * @method array findById(int $id) Return NestleBowerBrandProduct objects filtered by the id column
 * @method array findByBrandId(int $brand_id) Return NestleBowerBrandProduct objects filtered by the brand_id column
 * @method array findByProductId(int $product_id) Return NestleBowerBrandProduct objects filtered by the product_id column
 */
abstract class BaseNestleBowerBrandProductQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerBrandProductQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerBrandProduct';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerBrandProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerBrandProductQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerBrandProductQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerBrandProductQuery) {
            return $criteria;
        }
        $query = new NestleBowerBrandProductQuery(null, null, $modelAlias);

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
     * @return   NestleBowerBrandProduct|NestleBowerBrandProduct[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerBrandProductPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerBrandProductPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerBrandProduct A model object, or null if the key is not found
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
     * @return                 NestleBowerBrandProduct A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `brand_id`, `product_id` FROM `brand_product` WHERE `id` = :p0';
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
            $obj = new NestleBowerBrandProduct();
            $obj->hydrate($row);
            NestleBowerBrandProductPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerBrandProduct|NestleBowerBrandProduct[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerBrandProduct[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerBrandProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerBrandProductPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerBrandProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerBrandProductPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerBrandProductQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerBrandProductPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerBrandProductPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerBrandProductPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the brand_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandId(1234); // WHERE brand_id = 1234
     * $query->filterByBrandId(array(12, 34)); // WHERE brand_id IN (12, 34)
     * $query->filterByBrandId(array('min' => 12)); // WHERE brand_id >= 12
     * $query->filterByBrandId(array('max' => 12)); // WHERE brand_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerBrand()
     *
     * @param     mixed $brandId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerBrandProductQuery The current query, for fluid interface
     */
    public function filterByBrandId($brandId = null, $comparison = null)
    {
        if (is_array($brandId)) {
            $useMinMax = false;
            if (isset($brandId['min'])) {
                $this->addUsingAlias(NestleBowerBrandProductPeer::BRAND_ID, $brandId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($brandId['max'])) {
                $this->addUsingAlias(NestleBowerBrandProductPeer::BRAND_ID, $brandId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerBrandProductPeer::BRAND_ID, $brandId, $comparison);
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
     * @return NestleBowerBrandProductQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(NestleBowerBrandProductPeer::PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(NestleBowerBrandProductPeer::PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerBrandProductPeer::PRODUCT_ID, $productId, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerBrand object
     *
     * @param   NestleBowerBrand|PropelObjectCollection $nestleBowerBrand The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerBrandProductQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerBrand($nestleBowerBrand, $comparison = null)
    {
        if ($nestleBowerBrand instanceof NestleBowerBrand) {
            return $this
                ->addUsingAlias(NestleBowerBrandProductPeer::BRAND_ID, $nestleBowerBrand->getId(), $comparison);
        } elseif ($nestleBowerBrand instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerBrandProductPeer::BRAND_ID, $nestleBowerBrand->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerBrand() only accepts arguments of type NestleBowerBrand or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerBrand relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerBrandProductQuery The current query, for fluid interface
     */
    public function joinNestleBowerBrand($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerBrand');

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
            $this->addJoinObject($join, 'NestleBowerBrand');
        }

        return $this;
    }

    /**
     * Use the NestleBowerBrand relation NestleBowerBrand object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerBrandQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerBrandQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerBrand($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerBrand', '\Nestle\CoreBundle\Model\NestleBowerBrandQuery');
    }

    /**
     * Filter the query by a related NestleBowerProduct object
     *
     * @param   NestleBowerProduct|PropelObjectCollection $nestleBowerProduct The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerBrandProductQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerProduct($nestleBowerProduct, $comparison = null)
    {
        if ($nestleBowerProduct instanceof NestleBowerProduct) {
            return $this
                ->addUsingAlias(NestleBowerBrandProductPeer::PRODUCT_ID, $nestleBowerProduct->getId(), $comparison);
        } elseif ($nestleBowerProduct instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerBrandProductPeer::PRODUCT_ID, $nestleBowerProduct->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return NestleBowerBrandProductQuery The current query, for fluid interface
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
     * @param   NestleBowerBrandProduct $nestleBowerBrandProduct Object to remove from the list of results
     *
     * @return NestleBowerBrandProductQuery The current query, for fluid interface
     */
    public function prune($nestleBowerBrandProduct = null)
    {
        if ($nestleBowerBrandProduct) {
            $this->addUsingAlias(NestleBowerBrandProductPeer::ID, $nestleBowerBrandProduct->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
