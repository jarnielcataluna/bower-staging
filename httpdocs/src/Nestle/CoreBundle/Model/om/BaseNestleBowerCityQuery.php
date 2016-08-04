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
use Nestle\CoreBundle\Model\NestleBowerArea;
use Nestle\CoreBundle\Model\NestleBowerCity;
use Nestle\CoreBundle\Model\NestleBowerCityPeer;
use Nestle\CoreBundle\Model\NestleBowerCityQuery;
use Nestle\CoreBundle\Model\NestleBowerProvince;

/**
 * @method NestleBowerCityQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerCityQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method NestleBowerCityQuery orderByProvinceId($order = Criteria::ASC) Order by the province_id column
 * @method NestleBowerCityQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerCityQuery groupById() Group by the id column
 * @method NestleBowerCityQuery groupByCity() Group by the city column
 * @method NestleBowerCityQuery groupByProvinceId() Group by the province_id column
 * @method NestleBowerCityQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerCityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerCityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerCityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerCityQuery leftJoinNestleBowerProvince($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerProvince relation
 * @method NestleBowerCityQuery rightJoinNestleBowerProvince($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerProvince relation
 * @method NestleBowerCityQuery innerJoinNestleBowerProvince($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerProvince relation
 *
 * @method NestleBowerCityQuery leftJoinNestleBowerAccountsMcp($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerCityQuery rightJoinNestleBowerAccountsMcp($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerAccountsMcp relation
 * @method NestleBowerCityQuery innerJoinNestleBowerAccountsMcp($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerAccountsMcp relation
 *
 * @method NestleBowerCityQuery leftJoinNestleBowerArea($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerArea relation
 * @method NestleBowerCityQuery rightJoinNestleBowerArea($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerArea relation
 * @method NestleBowerCityQuery innerJoinNestleBowerArea($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerArea relation
 *
 * @method NestleBowerCity findOne(PropelPDO $con = null) Return the first NestleBowerCity matching the query
 * @method NestleBowerCity findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerCity matching the query, or a new NestleBowerCity object populated from the query conditions when no match is found
 *
 * @method NestleBowerCity findOneByCity(string $city) Return the first NestleBowerCity filtered by the city column
 * @method NestleBowerCity findOneByProvinceId(int $province_id) Return the first NestleBowerCity filtered by the province_id column
 * @method NestleBowerCity findOneByStatus(int $status) Return the first NestleBowerCity filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerCity objects filtered by the id column
 * @method array findByCity(string $city) Return NestleBowerCity objects filtered by the city column
 * @method array findByProvinceId(int $province_id) Return NestleBowerCity objects filtered by the province_id column
 * @method array findByStatus(int $status) Return NestleBowerCity objects filtered by the status column
 */
abstract class BaseNestleBowerCityQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerCityQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerCity';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerCityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerCityQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerCityQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerCityQuery) {
            return $criteria;
        }
        $query = new NestleBowerCityQuery(null, null, $modelAlias);

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
     * @return   NestleBowerCity|NestleBowerCity[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerCityPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerCityPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerCity A model object, or null if the key is not found
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
     * @return                 NestleBowerCity A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `city`, `province_id`, `status` FROM `city` WHERE `id` = :p0';
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
            $obj = new NestleBowerCity();
            $obj->hydrate($row);
            NestleBowerCityPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerCity|NestleBowerCity[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerCity[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerCityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerCityPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerCityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerCityPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerCityQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerCityPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerCityPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerCityPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%'); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerCityQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $city)) {
                $city = str_replace('*', '%', $city);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerCityPeer::CITY, $city, $comparison);
    }

    /**
     * Filter the query on the province_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProvinceId(1234); // WHERE province_id = 1234
     * $query->filterByProvinceId(array(12, 34)); // WHERE province_id IN (12, 34)
     * $query->filterByProvinceId(array('min' => 12)); // WHERE province_id >= 12
     * $query->filterByProvinceId(array('max' => 12)); // WHERE province_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerProvince()
     *
     * @param     mixed $provinceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerCityQuery The current query, for fluid interface
     */
    public function filterByProvinceId($provinceId = null, $comparison = null)
    {
        if (is_array($provinceId)) {
            $useMinMax = false;
            if (isset($provinceId['min'])) {
                $this->addUsingAlias(NestleBowerCityPeer::PROVINCE_ID, $provinceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($provinceId['max'])) {
                $this->addUsingAlias(NestleBowerCityPeer::PROVINCE_ID, $provinceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerCityPeer::PROVINCE_ID, $provinceId, $comparison);
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
     * @return NestleBowerCityQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerCityPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerCityPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerCityPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerProvince object
     *
     * @param   NestleBowerProvince|PropelObjectCollection $nestleBowerProvince The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerCityQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerProvince($nestleBowerProvince, $comparison = null)
    {
        if ($nestleBowerProvince instanceof NestleBowerProvince) {
            return $this
                ->addUsingAlias(NestleBowerCityPeer::PROVINCE_ID, $nestleBowerProvince->getId(), $comparison);
        } elseif ($nestleBowerProvince instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerCityPeer::PROVINCE_ID, $nestleBowerProvince->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return NestleBowerCityQuery The current query, for fluid interface
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
     * Filter the query by a related NestleBowerAccountsMcp object
     *
     * @param   NestleBowerAccountsMcp|PropelObjectCollection $nestleBowerAccountsMcp  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerCityQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerAccountsMcp($nestleBowerAccountsMcp, $comparison = null)
    {
        if ($nestleBowerAccountsMcp instanceof NestleBowerAccountsMcp) {
            return $this
                ->addUsingAlias(NestleBowerCityPeer::ID, $nestleBowerAccountsMcp->getCityId(), $comparison);
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
     * @return NestleBowerCityQuery The current query, for fluid interface
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
     * Filter the query by a related NestleBowerArea object
     *
     * @param   NestleBowerArea|PropelObjectCollection $nestleBowerArea  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerCityQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerArea($nestleBowerArea, $comparison = null)
    {
        if ($nestleBowerArea instanceof NestleBowerArea) {
            return $this
                ->addUsingAlias(NestleBowerCityPeer::ID, $nestleBowerArea->getCityId(), $comparison);
        } elseif ($nestleBowerArea instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerAreaQuery()
                ->filterByPrimaryKeys($nestleBowerArea->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerArea() only accepts arguments of type NestleBowerArea or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerArea relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerCityQuery The current query, for fluid interface
     */
    public function joinNestleBowerArea($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerArea');

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
            $this->addJoinObject($join, 'NestleBowerArea');
        }

        return $this;
    }

    /**
     * Use the NestleBowerArea relation NestleBowerArea object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerAreaQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerAreaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerArea($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerArea', '\Nestle\CoreBundle\Model\NestleBowerAreaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NestleBowerCity $nestleBowerCity Object to remove from the list of results
     *
     * @return NestleBowerCityQuery The current query, for fluid interface
     */
    public function prune($nestleBowerCity = null)
    {
        if ($nestleBowerCity) {
            $this->addUsingAlias(NestleBowerCityPeer::ID, $nestleBowerCity->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
