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
use Nestle\CoreBundle\Model\NestleNestleDistributors;
use Nestle\CoreBundle\Model\NestleNestleDistributorsPeer;
use Nestle\CoreBundle\Model\NestleNestleDistributorsQuery;

/**
 * @method NestleNestleDistributorsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleNestleDistributorsQuery orderByDistributorId($order = Criteria::ASC) Order by the distributor_id column
 * @method NestleNestleDistributorsQuery orderByDistributor($order = Criteria::ASC) Order by the distributor column
 * @method NestleNestleDistributorsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleNestleDistributorsQuery groupById() Group by the id column
 * @method NestleNestleDistributorsQuery groupByDistributorId() Group by the distributor_id column
 * @method NestleNestleDistributorsQuery groupByDistributor() Group by the distributor column
 * @method NestleNestleDistributorsQuery groupByStatus() Group by the status column
 *
 * @method NestleNestleDistributorsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleNestleDistributorsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleNestleDistributorsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleNestleDistributorsQuery leftJoinNestleBower($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBower relation
 * @method NestleNestleDistributorsQuery rightJoinNestleBower($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBower relation
 * @method NestleNestleDistributorsQuery innerJoinNestleBower($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBower relation
 *
 * @method NestleNestleDistributors findOne(PropelPDO $con = null) Return the first NestleNestleDistributors matching the query
 * @method NestleNestleDistributors findOneOrCreate(PropelPDO $con = null) Return the first NestleNestleDistributors matching the query, or a new NestleNestleDistributors object populated from the query conditions when no match is found
 *
 * @method NestleNestleDistributors findOneByDistributorId(string $distributor_id) Return the first NestleNestleDistributors filtered by the distributor_id column
 * @method NestleNestleDistributors findOneByDistributor(string $distributor) Return the first NestleNestleDistributors filtered by the distributor column
 * @method NestleNestleDistributors findOneByStatus(int $status) Return the first NestleNestleDistributors filtered by the status column
 *
 * @method array findById(int $id) Return NestleNestleDistributors objects filtered by the id column
 * @method array findByDistributorId(string $distributor_id) Return NestleNestleDistributors objects filtered by the distributor_id column
 * @method array findByDistributor(string $distributor) Return NestleNestleDistributors objects filtered by the distributor column
 * @method array findByStatus(int $status) Return NestleNestleDistributors objects filtered by the status column
 */
abstract class BaseNestleNestleDistributorsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleNestleDistributorsQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleNestleDistributors';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleNestleDistributorsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleNestleDistributorsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleNestleDistributorsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleNestleDistributorsQuery) {
            return $criteria;
        }
        $query = new NestleNestleDistributorsQuery(null, null, $modelAlias);

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
     * @return   NestleNestleDistributors|NestleNestleDistributors[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleNestleDistributorsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleNestleDistributorsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleNestleDistributors A model object, or null if the key is not found
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
     * @return                 NestleNestleDistributors A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `distributor_id`, `distributor`, `status` FROM `nestle_distributors` WHERE `id` = :p0';
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
            $obj = new NestleNestleDistributors();
            $obj->hydrate($row);
            NestleNestleDistributorsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleNestleDistributors|NestleNestleDistributors[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleNestleDistributors[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleNestleDistributorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleNestleDistributorsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleNestleDistributorsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleNestleDistributorsPeer::ID, $keys, Criteria::IN);
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
     * @return NestleNestleDistributorsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleNestleDistributorsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleNestleDistributorsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleNestleDistributorsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the distributor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDistributorId('fooValue');   // WHERE distributor_id = 'fooValue'
     * $query->filterByDistributorId('%fooValue%'); // WHERE distributor_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $distributorId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleNestleDistributorsQuery The current query, for fluid interface
     */
    public function filterByDistributorId($distributorId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($distributorId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $distributorId)) {
                $distributorId = str_replace('*', '%', $distributorId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleNestleDistributorsPeer::DISTRIBUTOR_ID, $distributorId, $comparison);
    }

    /**
     * Filter the query on the distributor column
     *
     * Example usage:
     * <code>
     * $query->filterByDistributor('fooValue');   // WHERE distributor = 'fooValue'
     * $query->filterByDistributor('%fooValue%'); // WHERE distributor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $distributor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleNestleDistributorsQuery The current query, for fluid interface
     */
    public function filterByDistributor($distributor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($distributor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $distributor)) {
                $distributor = str_replace('*', '%', $distributor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleNestleDistributorsPeer::DISTRIBUTOR, $distributor, $comparison);
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
     * @return NestleNestleDistributorsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleNestleDistributorsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleNestleDistributorsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleNestleDistributorsPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBower object
     *
     * @param   NestleBower|PropelObjectCollection $nestleBower  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleNestleDistributorsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBower($nestleBower, $comparison = null)
    {
        if ($nestleBower instanceof NestleBower) {
            return $this
                ->addUsingAlias(NestleNestleDistributorsPeer::ID, $nestleBower->getDistributorId(), $comparison);
        } elseif ($nestleBower instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerQuery()
                ->filterByPrimaryKeys($nestleBower->getPrimaryKeys())
                ->endUse();
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
     * @return NestleNestleDistributorsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   NestleNestleDistributors $nestleNestleDistributors Object to remove from the list of results
     *
     * @return NestleNestleDistributorsQuery The current query, for fluid interface
     */
    public function prune($nestleNestleDistributors = null)
    {
        if ($nestleNestleDistributors) {
            $this->addUsingAlias(NestleNestleDistributorsPeer::ID, $nestleNestleDistributors->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
