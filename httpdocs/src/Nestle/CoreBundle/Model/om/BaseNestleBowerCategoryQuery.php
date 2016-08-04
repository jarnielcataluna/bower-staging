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
use Nestle\CoreBundle\Model\NestleBowerAccountsMcp;
use Nestle\CoreBundle\Model\NestleBowerCategory;
use Nestle\CoreBundle\Model\NestleBowerCategoryPeer;
use Nestle\CoreBundle\Model\NestleBowerCategoryQuery;

/**
 * @method NestleBowerCategoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerCategoryQuery orderByCategory($order = Criteria::ASC) Order by the category column
 * @method NestleBowerCategoryQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerCategoryQuery groupById() Group by the id column
 * @method NestleBowerCategoryQuery groupByCategory() Group by the category column
 * @method NestleBowerCategoryQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerCategoryQuery leftJoinNestleBowerAccountsMcp($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerCategoryQuery rightJoinNestleBowerAccountsMcp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerCategoryQuery innerJoinNestleBowerAccountsMcp($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerAccountsMcp relation
 *
 * @method NestleBowerCategory findOne(PropelPDO $con = null) Return the first NestleBowerCategory matching the query
 * @method NestleBowerCategory findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerCategory matching the query, or a new NestleBowerCategory object populated from the query conditions when no match is found
 *
 * @method NestleBowerCategory findOneByCategory(string $category) Return the first NestleBowerCategory filtered by the category column
 * @method NestleBowerCategory findOneByStatus(int $status) Return the first NestleBowerCategory filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerCategory objects filtered by the id column
 * @method array findByCategory(string $category) Return NestleBowerCategory objects filtered by the category column
 * @method array findByStatus(int $status) Return NestleBowerCategory objects filtered by the status column
 */
abstract class BaseNestleBowerCategoryQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerCategoryQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerCategory';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerCategoryQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerCategoryQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerCategoryQuery) {
            return $criteria;
        }
        $query = new NestleBowerCategoryQuery(null, null, $modelAlias);

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
     * @return   NestleBowerCategory|NestleBowerCategory[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerCategoryPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerCategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerCategory A model object, or null if the key is not found
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
     * @return                 NestleBowerCategory A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `category`, `status` FROM `category` WHERE `id` = :p0';
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
            $obj = new NestleBowerCategory();
            $obj->hydrate($row);
            NestleBowerCategoryPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerCategory|NestleBowerCategory[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerCategory[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerCategoryPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerCategoryPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerCategoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerCategoryPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerCategoryPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerCategoryPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the category column
     *
     * Example usage:
     * <code>
     * $query->filterByCategory('fooValue');   // WHERE category = 'fooValue'
     * $query->filterByCategory('%fooValue%'); // WHERE category LIKE '%fooValue%'
     * </code>
     *
     * @param     string $category The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerCategoryQuery The current query, for fluid interface
     */
    public function filterByCategory($category = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($category)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $category)) {
                $category = str_replace('*', '%', $category);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerCategoryPeer::CATEGORY, $category, $comparison);
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
     * @return NestleBowerCategoryQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerCategoryPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerCategoryPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerCategoryPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerAccountsMcp object
     *
     * @param   NestleBowerAccountsMcp|PropelObjectCollection $nestleBowerAccountsMcp  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerCategoryQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerAccountsMcp($nestleBowerAccountsMcp, $comparison = null)
    {
        if ($nestleBowerAccountsMcp instanceof NestleBowerAccountsMcp) {
            return $this
                ->addUsingAlias(NestleBowerCategoryPeer::ID, $nestleBowerAccountsMcp->getCategoryId(), $comparison);
        } elseif ($nestleBowerAccountsMcp instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerAccountsMcpQuery()
                ->filterByPrimaryKeys($nestleBowerAccountsMcp->getPrimaryKeys())
                ->endUse();
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
     * @return NestleBowerCategoryQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   NestleBowerCategory $nestleBowerCategory Object to remove from the list of results
     *
     * @return NestleBowerCategoryQuery The current query, for fluid interface
     */
    public function prune($nestleBowerCategory = null)
    {
        if ($nestleBowerCategory) {
            $this->addUsingAlias(NestleBowerCategoryPeer::ID, $nestleBowerCategory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
