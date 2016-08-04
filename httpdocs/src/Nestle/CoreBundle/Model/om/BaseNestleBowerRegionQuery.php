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
use Nestle\CoreBundle\Model\NestleBowerPromos;
use Nestle\CoreBundle\Model\NestleBowerProvince;
use Nestle\CoreBundle\Model\NestleBowerRegion;
use Nestle\CoreBundle\Model\NestleBowerRegionPeer;
use Nestle\CoreBundle\Model\NestleBowerRegionQuery;

/**
 * @method NestleBowerRegionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerRegionQuery orderByRegion($order = Criteria::ASC) Order by the region column
 * @method NestleBowerRegionQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerRegionQuery groupById() Group by the id column
 * @method NestleBowerRegionQuery groupByRegion() Group by the region column
 * @method NestleBowerRegionQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerRegionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerRegionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerRegionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerRegionQuery leftJoinNestleBowerProvince($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerProvince relation
 * @method NestleBowerRegionQuery rightJoinNestleBowerProvince($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerProvince relation
 * @method NestleBowerRegionQuery innerJoinNestleBowerProvince($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerProvince relation
 *
 * @method NestleBowerRegionQuery leftJoinNestleBowerPromos($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerPromos relation
 * @method NestleBowerRegionQuery rightJoinNestleBowerPromos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerPromos relation
 * @method NestleBowerRegionQuery innerJoinNestleBowerPromos($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerPromos relation
 *
 * @method NestleBowerRegion findOne(PropelPDO $con = null) Return the first NestleBowerRegion matching the query
 * @method NestleBowerRegion findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerRegion matching the query, or a new NestleBowerRegion object populated from the query conditions when no match is found
 *
 * @method NestleBowerRegion findOneByRegion(string $region) Return the first NestleBowerRegion filtered by the region column
 * @method NestleBowerRegion findOneByStatus(int $status) Return the first NestleBowerRegion filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerRegion objects filtered by the id column
 * @method array findByRegion(string $region) Return NestleBowerRegion objects filtered by the region column
 * @method array findByStatus(int $status) Return NestleBowerRegion objects filtered by the status column
 */
abstract class BaseNestleBowerRegionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerRegionQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerRegion';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerRegionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerRegionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerRegionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerRegionQuery) {
            return $criteria;
        }
        $query = new NestleBowerRegionQuery(null, null, $modelAlias);

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
     * @return   NestleBowerRegion|NestleBowerRegion[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerRegionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerRegionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerRegion A model object, or null if the key is not found
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
     * @return                 NestleBowerRegion A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `region`, `status` FROM `region` WHERE `id` = :p0';
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
            $obj = new NestleBowerRegion();
            $obj->hydrate($row);
            NestleBowerRegionPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerRegion|NestleBowerRegion[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerRegion[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerRegionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerRegionPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerRegionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerRegionPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerRegionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerRegionPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerRegionPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerRegionPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the region column
     *
     * Example usage:
     * <code>
     * $query->filterByRegion('fooValue');   // WHERE region = 'fooValue'
     * $query->filterByRegion('%fooValue%'); // WHERE region LIKE '%fooValue%'
     * </code>
     *
     * @param     string $region The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerRegionQuery The current query, for fluid interface
     */
    public function filterByRegion($region = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($region)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $region)) {
                $region = str_replace('*', '%', $region);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerRegionPeer::REGION, $region, $comparison);
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
     * @return NestleBowerRegionQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerRegionPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerRegionPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerRegionPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerProvince object
     *
     * @param   NestleBowerProvince|PropelObjectCollection $nestleBowerProvince  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerRegionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerProvince($nestleBowerProvince, $comparison = null)
    {
        if ($nestleBowerProvince instanceof NestleBowerProvince) {
            return $this
                ->addUsingAlias(NestleBowerRegionPeer::ID, $nestleBowerProvince->getRegionId(), $comparison);
        } elseif ($nestleBowerProvince instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerProvinceQuery()
                ->filterByPrimaryKeys($nestleBowerProvince->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerProvince() only accepts arguments of type NestleBowerProvince or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerProvince relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerRegionQuery The current query, for fluid interface
     */
    public function joinNestleBowerProvince($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerProvince');

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
            $this->addJoinObject($join, 'NestleBowerProvince');
        }

        return $this;
    }

    /**
     * Use the NestleBowerProvince relation NestleBowerProvince object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerProvinceQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerProvinceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerProvince($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerProvince', '\Nestle\CoreBundle\Model\NestleBowerProvinceQuery');
    }

    /**
     * Filter the query by a related NestleBowerPromos object
     *
     * @param   NestleBowerPromos|PropelObjectCollection $nestleBowerPromos  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerRegionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerPromos($nestleBowerPromos, $comparison = null)
    {
        if ($nestleBowerPromos instanceof NestleBowerPromos) {
            return $this
                ->addUsingAlias(NestleBowerRegionPeer::ID, $nestleBowerPromos->getRegionId(), $comparison);
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
     * @return NestleBowerRegionQuery The current query, for fluid interface
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
     * @param   NestleBowerRegion $nestleBowerRegion Object to remove from the list of results
     *
     * @return NestleBowerRegionQuery The current query, for fluid interface
     */
    public function prune($nestleBowerRegion = null)
    {
        if ($nestleBowerRegion) {
            $this->addUsingAlias(NestleBowerRegionPeer::ID, $nestleBowerRegion->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
