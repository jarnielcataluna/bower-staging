<?php

namespace Nestle\CoreBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Nestle\CoreBundle\Model\NestleNestleRegions;
use Nestle\CoreBundle\Model\NestleNestleRegionsPeer;
use Nestle\CoreBundle\Model\NestleNestleRegionsQuery;

/**
 * @method NestleNestleRegionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleNestleRegionsQuery orderByRegionCode($order = Criteria::ASC) Order by the region_code column
 * @method NestleNestleRegionsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleNestleRegionsQuery groupById() Group by the id column
 * @method NestleNestleRegionsQuery groupByRegionCode() Group by the region_code column
 * @method NestleNestleRegionsQuery groupByStatus() Group by the status column
 *
 * @method NestleNestleRegionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleNestleRegionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleNestleRegionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleNestleRegions findOne(PropelPDO $con = null) Return the first NestleNestleRegions matching the query
 * @method NestleNestleRegions findOneOrCreate(PropelPDO $con = null) Return the first NestleNestleRegions matching the query, or a new NestleNestleRegions object populated from the query conditions when no match is found
 *
 * @method NestleNestleRegions findOneByRegionCode(string $region_code) Return the first NestleNestleRegions filtered by the region_code column
 * @method NestleNestleRegions findOneByStatus(int $status) Return the first NestleNestleRegions filtered by the status column
 *
 * @method array findById(int $id) Return NestleNestleRegions objects filtered by the id column
 * @method array findByRegionCode(string $region_code) Return NestleNestleRegions objects filtered by the region_code column
 * @method array findByStatus(int $status) Return NestleNestleRegions objects filtered by the status column
 */
abstract class BaseNestleNestleRegionsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleNestleRegionsQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleNestleRegions';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleNestleRegionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleNestleRegionsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleNestleRegionsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleNestleRegionsQuery) {
            return $criteria;
        }
        $query = new NestleNestleRegionsQuery(null, null, $modelAlias);

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
     * @return   NestleNestleRegions|NestleNestleRegions[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleNestleRegionsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleNestleRegionsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleNestleRegions A model object, or null if the key is not found
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
     * @return                 NestleNestleRegions A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `region_code`, `status` FROM `nestle_regions` WHERE `id` = :p0';
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
            $obj = new NestleNestleRegions();
            $obj->hydrate($row);
            NestleNestleRegionsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleNestleRegions|NestleNestleRegions[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleNestleRegions[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleNestleRegionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleNestleRegionsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleNestleRegionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleNestleRegionsPeer::ID, $keys, Criteria::IN);
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
     * @return NestleNestleRegionsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleNestleRegionsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleNestleRegionsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleNestleRegionsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the region_code column
     *
     * Example usage:
     * <code>
     * $query->filterByRegionCode('fooValue');   // WHERE region_code = 'fooValue'
     * $query->filterByRegionCode('%fooValue%'); // WHERE region_code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $regionCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleNestleRegionsQuery The current query, for fluid interface
     */
    public function filterByRegionCode($regionCode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($regionCode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $regionCode)) {
                $regionCode = str_replace('*', '%', $regionCode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleNestleRegionsPeer::REGION_CODE, $regionCode, $comparison);
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
     * @return NestleNestleRegionsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleNestleRegionsPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleNestleRegionsPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleNestleRegionsPeer::STATUS, $status, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   NestleNestleRegions $nestleNestleRegions Object to remove from the list of results
     *
     * @return NestleNestleRegionsQuery The current query, for fluid interface
     */
    public function prune($nestleNestleRegions = null)
    {
        if ($nestleNestleRegions) {
            $this->addUsingAlias(NestleNestleRegionsPeer::ID, $nestleNestleRegions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
