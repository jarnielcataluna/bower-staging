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
use Nestle\CoreBundle\Model\NestleBowerProductCategory;
use Nestle\CoreBundle\Model\NestleBowerProductCategoryPeer;
use Nestle\CoreBundle\Model\NestleBowerProductCategoryQuery;

/**
 * @method NestleBowerProductCategoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerProductCategoryQuery orderByProductCategory($order = Criteria::ASC) Order by the product_category column
 * @method NestleBowerProductCategoryQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerProductCategoryQuery groupById() Group by the id column
 * @method NestleBowerProductCategoryQuery groupByProductCategory() Group by the product_category column
 * @method NestleBowerProductCategoryQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerProductCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerProductCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerProductCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerProductCategoryQuery leftJoinNestleBowerProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerProduct relation
 * @method NestleBowerProductCategoryQuery rightJoinNestleBowerProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerProduct relation
 * @method NestleBowerProductCategoryQuery innerJoinNestleBowerProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerProduct relation
 *
 * @method NestleBowerProductCategory findOne(PropelPDO $con = null) Return the first NestleBowerProductCategory matching the query
 * @method NestleBowerProductCategory findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerProductCategory matching the query, or a new NestleBowerProductCategory object populated from the query conditions when no match is found
 *
 * @method NestleBowerProductCategory findOneByProductCategory(string $product_category) Return the first NestleBowerProductCategory filtered by the product_category column
 * @method NestleBowerProductCategory findOneByStatus(int $status) Return the first NestleBowerProductCategory filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerProductCategory objects filtered by the id column
 * @method array findByProductCategory(string $product_category) Return NestleBowerProductCategory objects filtered by the product_category column
 * @method array findByStatus(int $status) Return NestleBowerProductCategory objects filtered by the status column
 */
abstract class BaseNestleBowerProductCategoryQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerProductCategoryQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerProductCategory';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerProductCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerProductCategoryQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerProductCategoryQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerProductCategoryQuery) {
            return $criteria;
        }
        $query = new NestleBowerProductCategoryQuery(null, null, $modelAlias);

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
     * @return   NestleBowerProductCategory|NestleBowerProductCategory[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerProductCategoryPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerProductCategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerProductCategory A model object, or null if the key is not found
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
     * @return                 NestleBowerProductCategory A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `product_category`, `status` FROM `product_category` WHERE `id` = :p0';
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
            $obj = new NestleBowerProductCategory();
            $obj->hydrate($row);
            NestleBowerProductCategoryPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerProductCategory|NestleBowerProductCategory[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerProductCategory[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerProductCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerProductCategoryPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerProductCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerProductCategoryPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerProductCategoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerProductCategoryPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerProductCategoryPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerProductCategoryPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the product_category column
     *
     * Example usage:
     * <code>
     * $query->filterByProductCategory('fooValue');   // WHERE product_category = 'fooValue'
     * $query->filterByProductCategory('%fooValue%'); // WHERE product_category LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productCategory The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductCategoryQuery The current query, for fluid interface
     */
    public function filterByProductCategory($productCategory = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productCategory)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $productCategory)) {
                $productCategory = str_replace('*', '%', $productCategory);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerProductCategoryPeer::PRODUCT_CATEGORY, $productCategory, $comparison);
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
     * @return NestleBowerProductCategoryQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerProductCategoryPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerProductCategoryPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerProductCategoryPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerProduct object
     *
     * @param   NestleBowerProduct|PropelObjectCollection $nestleBowerProduct  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerProductCategoryQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerProduct($nestleBowerProduct, $comparison = null)
    {
        if ($nestleBowerProduct instanceof NestleBowerProduct) {
            return $this
                ->addUsingAlias(NestleBowerProductCategoryPeer::ID, $nestleBowerProduct->getProductCategoryId(), $comparison);
        } elseif ($nestleBowerProduct instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerProductQuery()
                ->filterByPrimaryKeys($nestleBowerProduct->getPrimaryKeys())
                ->endUse();
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
     * @return NestleBowerProductCategoryQuery The current query, for fluid interface
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
     * @param   NestleBowerProductCategory $nestleBowerProductCategory Object to remove from the list of results
     *
     * @return NestleBowerProductCategoryQuery The current query, for fluid interface
     */
    public function prune($nestleBowerProductCategory = null)
    {
        if ($nestleBowerProductCategory) {
            $this->addUsingAlias(NestleBowerProductCategoryPeer::ID, $nestleBowerProductCategory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
