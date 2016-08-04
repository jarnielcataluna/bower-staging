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
use Nestle\CoreBundle\Model\NestleBowerArea;
use Nestle\CoreBundle\Model\NestleBowerAreaPeer;
use Nestle\CoreBundle\Model\NestleBowerAreaQuery;
use Nestle\CoreBundle\Model\NestleBowerCity;

/**
 * @method NestleBowerAreaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerAreaQuery orderByArea($order = Criteria::ASC) Order by the area column
 * @method NestleBowerAreaQuery orderByCityId($order = Criteria::ASC) Order by the city_id column
 * @method NestleBowerAreaQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerAreaQuery groupById() Group by the id column
 * @method NestleBowerAreaQuery groupByArea() Group by the area column
 * @method NestleBowerAreaQuery groupByCityId() Group by the city_id column
 * @method NestleBowerAreaQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerAreaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerAreaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerAreaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerAreaQuery leftJoinNestleBowerCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerCity relation
 * @method NestleBowerAreaQuery rightJoinNestleBowerCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerCity relation
 * @method NestleBowerAreaQuery innerJoinNestleBowerCity($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerCity relation
 *
 * @method NestleBowerAreaQuery leftJoinNestleBowerAccountsMcp($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerAreaQuery rightJoinNestleBowerAccountsMcp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerAreaQuery innerJoinNestleBowerAccountsMcp($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerAccountsMcp relation
 *
 * @method NestleBowerAreaQuery leftJoinNestleBower($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBower relation
 * @method NestleBowerAreaQuery rightJoinNestleBower($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBower relation
 * @method NestleBowerAreaQuery innerJoinNestleBower($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBower relation
 *
 * @method NestleBowerArea findOne(PropelPDO $con = null) Return the first NestleBowerArea matching the query
 * @method NestleBowerArea findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerArea matching the query, or a new NestleBowerArea object populated from the query conditions when no match is found
 *
 * @method NestleBowerArea findOneByArea(string $area) Return the first NestleBowerArea filtered by the area column
 * @method NestleBowerArea findOneByCityId(int $city_id) Return the first NestleBowerArea filtered by the city_id column
 * @method NestleBowerArea findOneByStatus(int $status) Return the first NestleBowerArea filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerArea objects filtered by the id column
 * @method array findByArea(string $area) Return NestleBowerArea objects filtered by the area column
 * @method array findByCityId(int $city_id) Return NestleBowerArea objects filtered by the city_id column
 * @method array findByStatus(int $status) Return NestleBowerArea objects filtered by the status column
 */
abstract class BaseNestleBowerAreaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerAreaQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerArea';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerAreaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerAreaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerAreaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerAreaQuery) {
            return $criteria;
        }
        $query = new NestleBowerAreaQuery(null, null, $modelAlias);

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
     * @return   NestleBowerArea|NestleBowerArea[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerAreaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerAreaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerArea A model object, or null if the key is not found
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
     * @return                 NestleBowerArea A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `area`, `city_id`, `status` FROM `area` WHERE `id` = :p0';
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
            $obj = new NestleBowerArea();
            $obj->hydrate($row);
            NestleBowerAreaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerArea|NestleBowerArea[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerArea[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerAreaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerAreaPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerAreaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerAreaPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerAreaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerAreaPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerAreaPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAreaPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the area column
     *
     * Example usage:
     * <code>
     * $query->filterByArea('fooValue');   // WHERE area = 'fooValue'
     * $query->filterByArea('%fooValue%'); // WHERE area LIKE '%fooValue%'
     * </code>
     *
     * @param     string $area The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAreaQuery The current query, for fluid interface
     */
    public function filterByArea($area = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($area)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $area)) {
                $area = str_replace('*', '%', $area);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAreaPeer::AREA, $area, $comparison);
    }

    /**
     * Filter the query on the city_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCityId(1234); // WHERE city_id = 1234
     * $query->filterByCityId(array(12, 34)); // WHERE city_id IN (12, 34)
     * $query->filterByCityId(array('min' => 12)); // WHERE city_id >= 12
     * $query->filterByCityId(array('max' => 12)); // WHERE city_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerCity()
     *
     * @param     mixed $cityId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAreaQuery The current query, for fluid interface
     */
    public function filterByCityId($cityId = null, $comparison = null)
    {
        if (is_array($cityId)) {
            $useMinMax = false;
            if (isset($cityId['min'])) {
                $this->addUsingAlias(NestleBowerAreaPeer::CITY_ID, $cityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cityId['max'])) {
                $this->addUsingAlias(NestleBowerAreaPeer::CITY_ID, $cityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAreaPeer::CITY_ID, $cityId, $comparison);
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
     * @return NestleBowerAreaQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerAreaPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerAreaPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAreaPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerCity object
     *
     * @param   NestleBowerCity|PropelObjectCollection $nestleBowerCity The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerAreaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerCity($nestleBowerCity, $comparison = null)
    {
        if ($nestleBowerCity instanceof NestleBowerCity) {
            return $this
                ->addUsingAlias(NestleBowerAreaPeer::CITY_ID, $nestleBowerCity->getId(), $comparison);
        } elseif ($nestleBowerCity instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerAreaPeer::CITY_ID, $nestleBowerCity->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerCity() only accepts arguments of type NestleBowerCity or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerCity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerAreaQuery The current query, for fluid interface
     */
    public function joinNestleBowerCity($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerCity');

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
            $this->addJoinObject($join, 'NestleBowerCity');
        }

        return $this;
    }

    /**
     * Use the NestleBowerCity relation NestleBowerCity object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerCityQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerCityQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerCity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerCity', '\Nestle\CoreBundle\Model\NestleBowerCityQuery');
    }

    /**
     * Filter the query by a related NestleBowerAccountsMcp object
     *
     * @param   NestleBowerAccountsMcp|PropelObjectCollection $nestleBowerAccountsMcp  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerAreaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerAccountsMcp($nestleBowerAccountsMcp, $comparison = null)
    {
        if ($nestleBowerAccountsMcp instanceof NestleBowerAccountsMcp) {
            return $this
                ->addUsingAlias(NestleBowerAreaPeer::ID, $nestleBowerAccountsMcp->getAreaId(), $comparison);
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
     * @return NestleBowerAreaQuery The current query, for fluid interface
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
     * @param   NestleBower|PropelObjectCollection $nestleBower  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerAreaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBower($nestleBower, $comparison = null)
    {
        if ($nestleBower instanceof NestleBower) {
            return $this
                ->addUsingAlias(NestleBowerAreaPeer::ID, $nestleBower->getAreaId(), $comparison);
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
     * @return NestleBowerAreaQuery The current query, for fluid interface
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
     * @param   NestleBowerArea $nestleBowerArea Object to remove from the list of results
     *
     * @return NestleBowerAreaQuery The current query, for fluid interface
     */
    public function prune($nestleBowerArea = null)
    {
        if ($nestleBowerArea) {
            $this->addUsingAlias(NestleBowerAreaPeer::ID, $nestleBowerArea->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
