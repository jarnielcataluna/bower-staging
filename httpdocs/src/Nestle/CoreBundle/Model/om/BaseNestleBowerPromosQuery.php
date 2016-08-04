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
use Nestle\CoreBundle\Model\NestleBowerPromosPeer;
use Nestle\CoreBundle\Model\NestleBowerPromosQuery;
use Nestle\CoreBundle\Model\NestleBowerRegion;
use Nestle\CoreBundle\Model\NestleBowerRules;

/**
 * @method NestleBowerPromosQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerPromosQuery orderByRuleId($order = Criteria::ASC) Order by the rule_id column
 * @method NestleBowerPromosQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method NestleBowerPromosQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method NestleBowerPromosQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method NestleBowerPromosQuery orderByRegionId($order = Criteria::ASC) Order by the region_id column
 *
 * @method NestleBowerPromosQuery groupById() Group by the id column
 * @method NestleBowerPromosQuery groupByRuleId() Group by the rule_id column
 * @method NestleBowerPromosQuery groupByName() Group by the name column
 * @method NestleBowerPromosQuery groupByDescription() Group by the description column
 * @method NestleBowerPromosQuery groupByStatus() Group by the status column
 * @method NestleBowerPromosQuery groupByRegionId() Group by the region_id column
 *
 * @method NestleBowerPromosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerPromosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerPromosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerPromosQuery leftJoinNestleBowerRules($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerRules relation
 * @method NestleBowerPromosQuery rightJoinNestleBowerRules($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerRules relation
 * @method NestleBowerPromosQuery innerJoinNestleBowerRules($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerRules relation
 *
 * @method NestleBowerPromosQuery leftJoinNestleBowerRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerRegion relation
 * @method NestleBowerPromosQuery rightJoinNestleBowerRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerRegion relation
 * @method NestleBowerPromosQuery innerJoinNestleBowerRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerRegion relation
 *
 * @method NestleBowerPromos findOne(PropelPDO $con = null) Return the first NestleBowerPromos matching the query
 * @method NestleBowerPromos findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerPromos matching the query, or a new NestleBowerPromos object populated from the query conditions when no match is found
 *
 * @method NestleBowerPromos findOneByRuleId(int $rule_id) Return the first NestleBowerPromos filtered by the rule_id column
 * @method NestleBowerPromos findOneByName(string $name) Return the first NestleBowerPromos filtered by the name column
 * @method NestleBowerPromos findOneByDescription(string $description) Return the first NestleBowerPromos filtered by the description column
 * @method NestleBowerPromos findOneByStatus(int $status) Return the first NestleBowerPromos filtered by the status column
 * @method NestleBowerPromos findOneByRegionId(int $region_id) Return the first NestleBowerPromos filtered by the region_id column
 *
 * @method array findById(int $id) Return NestleBowerPromos objects filtered by the id column
 * @method array findByRuleId(int $rule_id) Return NestleBowerPromos objects filtered by the rule_id column
 * @method array findByName(string $name) Return NestleBowerPromos objects filtered by the name column
 * @method array findByDescription(string $description) Return NestleBowerPromos objects filtered by the description column
 * @method array findByStatus(int $status) Return NestleBowerPromos objects filtered by the status column
 * @method array findByRegionId(int $region_id) Return NestleBowerPromos objects filtered by the region_id column
 */
abstract class BaseNestleBowerPromosQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerPromosQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerPromos';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerPromosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerPromosQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerPromosQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerPromosQuery) {
            return $criteria;
        }
        $query = new NestleBowerPromosQuery(null, null, $modelAlias);

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
     * @return   NestleBowerPromos|NestleBowerPromos[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerPromosPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPromosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerPromos A model object, or null if the key is not found
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
     * @return                 NestleBowerPromos A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `rule_id`, `name`, `description`, `status`, `region_id` FROM `promos` WHERE `id` = :p0';
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
            $obj = new NestleBowerPromos();
            $obj->hydrate($row);
            NestleBowerPromosPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerPromos|NestleBowerPromos[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerPromos[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerPromosPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerPromosPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerPromosPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerPromosPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerPromosPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the rule_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRuleId(1234); // WHERE rule_id = 1234
     * $query->filterByRuleId(array(12, 34)); // WHERE rule_id IN (12, 34)
     * $query->filterByRuleId(array('min' => 12)); // WHERE rule_id >= 12
     * $query->filterByRuleId(array('max' => 12)); // WHERE rule_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerRules()
     *
     * @param     mixed $ruleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function filterByRuleId($ruleId = null, $comparison = null)
    {
        if (is_array($ruleId)) {
            $useMinMax = false;
            if (isset($ruleId['min'])) {
                $this->addUsingAlias(NestleBowerPromosPeer::RULE_ID, $ruleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ruleId['max'])) {
                $this->addUsingAlias(NestleBowerPromosPeer::RULE_ID, $ruleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerPromosPeer::RULE_ID, $ruleId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerPromosPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerPromosPeer::DESCRIPTION, $description, $comparison);
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
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerPromosPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerPromosPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerPromosPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the region_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRegionId(1234); // WHERE region_id = 1234
     * $query->filterByRegionId(array(12, 34)); // WHERE region_id IN (12, 34)
     * $query->filterByRegionId(array('min' => 12)); // WHERE region_id >= 12
     * $query->filterByRegionId(array('max' => 12)); // WHERE region_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerRegion()
     *
     * @param     mixed $regionId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function filterByRegionId($regionId = null, $comparison = null)
    {
        if (is_array($regionId)) {
            $useMinMax = false;
            if (isset($regionId['min'])) {
                $this->addUsingAlias(NestleBowerPromosPeer::REGION_ID, $regionId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($regionId['max'])) {
                $this->addUsingAlias(NestleBowerPromosPeer::REGION_ID, $regionId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerPromosPeer::REGION_ID, $regionId, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerRules object
     *
     * @param   NestleBowerRules|PropelObjectCollection $nestleBowerRules The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerPromosQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerRules($nestleBowerRules, $comparison = null)
    {
        if ($nestleBowerRules instanceof NestleBowerRules) {
            return $this
                ->addUsingAlias(NestleBowerPromosPeer::RULE_ID, $nestleBowerRules->getId(), $comparison);
        } elseif ($nestleBowerRules instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerPromosPeer::RULE_ID, $nestleBowerRules->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerRules() only accepts arguments of type NestleBowerRules or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerRules relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function joinNestleBowerRules($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerRules');

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
            $this->addJoinObject($join, 'NestleBowerRules');
        }

        return $this;
    }

    /**
     * Use the NestleBowerRules relation NestleBowerRules object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerRulesQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerRulesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerRules($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerRules', '\Nestle\CoreBundle\Model\NestleBowerRulesQuery');
    }

    /**
     * Filter the query by a related NestleBowerRegion object
     *
     * @param   NestleBowerRegion|PropelObjectCollection $nestleBowerRegion The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerPromosQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerRegion($nestleBowerRegion, $comparison = null)
    {
        if ($nestleBowerRegion instanceof NestleBowerRegion) {
            return $this
                ->addUsingAlias(NestleBowerPromosPeer::REGION_ID, $nestleBowerRegion->getId(), $comparison);
        } elseif ($nestleBowerRegion instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerPromosPeer::REGION_ID, $nestleBowerRegion->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerRegion() only accepts arguments of type NestleBowerRegion or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerRegion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function joinNestleBowerRegion($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerRegion');

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
            $this->addJoinObject($join, 'NestleBowerRegion');
        }

        return $this;
    }

    /**
     * Use the NestleBowerRegion relation NestleBowerRegion object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerRegionQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerRegionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerRegion', '\Nestle\CoreBundle\Model\NestleBowerRegionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NestleBowerPromos $nestleBowerPromos Object to remove from the list of results
     *
     * @return NestleBowerPromosQuery The current query, for fluid interface
     */
    public function prune($nestleBowerPromos = null)
    {
        if ($nestleBowerPromos) {
            $this->addUsingAlias(NestleBowerPromosPeer::ID, $nestleBowerPromos->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
