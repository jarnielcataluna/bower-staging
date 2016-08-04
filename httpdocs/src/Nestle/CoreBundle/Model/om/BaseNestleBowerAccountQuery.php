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
use Nestle\CoreBundle\Model\NestleBowerAccount;
use Nestle\CoreBundle\Model\NestleBowerAccountPeer;
use Nestle\CoreBundle\Model\NestleBowerAccountQuery;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcp;

/**
 * @method NestleBowerAccountQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerAccountQuery orderByBowerId($order = Criteria::ASC) Order by the bower_id column
 * @method NestleBowerAccountQuery orderByAccountId($order = Criteria::ASC) Order by the account_id column
 * @method NestleBowerAccountQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerAccountQuery groupById() Group by the id column
 * @method NestleBowerAccountQuery groupByBowerId() Group by the bower_id column
 * @method NestleBowerAccountQuery groupByAccountId() Group by the account_id column
 * @method NestleBowerAccountQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerAccountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerAccountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerAccountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerAccountQuery leftJoinNestleBower($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBower relation
 * @method NestleBowerAccountQuery rightJoinNestleBower($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBower relation
 * @method NestleBowerAccountQuery innerJoinNestleBower($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBower relation
 *
 * @method NestleBowerAccountQuery leftJoinNestleBowerAccountsMcp($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerAccountQuery rightJoinNestleBowerAccountsMcp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerAccountQuery innerJoinNestleBowerAccountsMcp($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerAccountsMcp relation
 *
 * @method NestleBowerAccount findOne(PropelPDO $con = null) Return the first NestleBowerAccount matching the query
 * @method NestleBowerAccount findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerAccount matching the query, or a new NestleBowerAccount object populated from the query conditions when no match is found
 *
 * @method NestleBowerAccount findOneByBowerId(int $bower_id) Return the first NestleBowerAccount filtered by the bower_id column
 * @method NestleBowerAccount findOneByAccountId(int $account_id) Return the first NestleBowerAccount filtered by the account_id column
 * @method NestleBowerAccount findOneByStatus(int $status) Return the first NestleBowerAccount filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerAccount objects filtered by the id column
 * @method array findByBowerId(int $bower_id) Return NestleBowerAccount objects filtered by the bower_id column
 * @method array findByAccountId(int $account_id) Return NestleBowerAccount objects filtered by the account_id column
 * @method array findByStatus(int $status) Return NestleBowerAccount objects filtered by the status column
 */
abstract class BaseNestleBowerAccountQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerAccountQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerAccount';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerAccountQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerAccountQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerAccountQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerAccountQuery) {
            return $criteria;
        }
        $query = new NestleBowerAccountQuery(null, null, $modelAlias);

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
     * @return   NestleBowerAccount|NestleBowerAccount[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerAccountPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerAccountPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerAccount A model object, or null if the key is not found
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
     * @return                 NestleBowerAccount A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `bower_id`, `account_id`, `status` FROM `bower_account` WHERE `id` = :p0';
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
            $obj = new NestleBowerAccount();
            $obj->hydrate($row);
            NestleBowerAccountPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerAccount|NestleBowerAccount[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerAccount[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerAccountPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerAccountQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerAccountPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerAccountQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerAccountPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerAccountPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountPeer::ID, $id, $comparison);
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
     * @return NestleBowerAccountQuery The current query, for fluid interface
     */
    public function filterByBowerId($bowerId = null, $comparison = null)
    {
        if (is_array($bowerId)) {
            $useMinMax = false;
            if (isset($bowerId['min'])) {
                $this->addUsingAlias(NestleBowerAccountPeer::BOWER_ID, $bowerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bowerId['max'])) {
                $this->addUsingAlias(NestleBowerAccountPeer::BOWER_ID, $bowerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountPeer::BOWER_ID, $bowerId, $comparison);
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
     * @return NestleBowerAccountQuery The current query, for fluid interface
     */
    public function filterByAccountId($accountId = null, $comparison = null)
    {
        if (is_array($accountId)) {
            $useMinMax = false;
            if (isset($accountId['min'])) {
                $this->addUsingAlias(NestleBowerAccountPeer::ACCOUNT_ID, $accountId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($accountId['max'])) {
                $this->addUsingAlias(NestleBowerAccountPeer::ACCOUNT_ID, $accountId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountPeer::ACCOUNT_ID, $accountId, $comparison);
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
     * @return NestleBowerAccountQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerAccountPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerAccountPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBower object
     *
     * @param   NestleBower|PropelObjectCollection $nestleBower The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerAccountQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBower($nestleBower, $comparison = null)
    {
        if ($nestleBower instanceof NestleBower) {
            return $this
                ->addUsingAlias(NestleBowerAccountPeer::BOWER_ID, $nestleBower->getId(), $comparison);
        } elseif ($nestleBower instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerAccountPeer::BOWER_ID, $nestleBower->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return NestleBowerAccountQuery The current query, for fluid interface
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
     * Filter the query by a related NestleBowerAccountsMcp object
     *
     * @param   NestleBowerAccountsMcp|PropelObjectCollection $nestleBowerAccountsMcp The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerAccountQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerAccountsMcp($nestleBowerAccountsMcp, $comparison = null)
    {
        if ($nestleBowerAccountsMcp instanceof NestleBowerAccountsMcp) {
            return $this
                ->addUsingAlias(NestleBowerAccountPeer::ACCOUNT_ID, $nestleBowerAccountsMcp->getId(), $comparison);
        } elseif ($nestleBowerAccountsMcp instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerAccountPeer::ACCOUNT_ID, $nestleBowerAccountsMcp->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return NestleBowerAccountQuery The current query, for fluid interface
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
     * @param   NestleBowerAccount $nestleBowerAccount Object to remove from the list of results
     *
     * @return NestleBowerAccountQuery The current query, for fluid interface
     */
    public function prune($nestleBowerAccount = null)
    {
        if ($nestleBowerAccount) {
            $this->addUsingAlias(NestleBowerAccountPeer::ID, $nestleBowerAccount->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
