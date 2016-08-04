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
use Nestle\CoreBundle\Model\NestleBowerArea;
use Nestle\CoreBundle\Model\NestleBowerInvoices;
use Nestle\CoreBundle\Model\NestleBowerPeer;
use Nestle\CoreBundle\Model\NestleBowerQuery;
use Nestle\CoreBundle\Model\NestleBowerSalesReport;
use Nestle\CoreBundle\Model\NestleNestleDistributors;

/**
 * @method NestleBowerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerQuery orderByFname($order = Criteria::ASC) Order by the fname column
 * @method NestleBowerQuery orderByLname($order = Criteria::ASC) Order by the lname column
 * @method NestleBowerQuery orderByContactNumber($order = Criteria::ASC) Order by the contact_number column
 * @method NestleBowerQuery orderByBdate($order = Criteria::ASC) Order by the bdate column
 * @method NestleBowerQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method NestleBowerQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method NestleBowerQuery orderByAreaId($order = Criteria::ASC) Order by the area_id column
 * @method NestleBowerQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method NestleBowerQuery orderByBowerId($order = Criteria::ASC) Order by the bower_id column
 * @method NestleBowerQuery orderByDistributor($order = Criteria::ASC) Order by the distributor column
 * @method NestleBowerQuery orderByDistributorId($order = Criteria::ASC) Order by the distributor_id column
 *
 * @method NestleBowerQuery groupById() Group by the id column
 * @method NestleBowerQuery groupByFname() Group by the fname column
 * @method NestleBowerQuery groupByLname() Group by the lname column
 * @method NestleBowerQuery groupByContactNumber() Group by the contact_number column
 * @method NestleBowerQuery groupByBdate() Group by the bdate column
 * @method NestleBowerQuery groupByUsername() Group by the username column
 * @method NestleBowerQuery groupByPassword() Group by the password column
 * @method NestleBowerQuery groupByAreaId() Group by the area_id column
 * @method NestleBowerQuery groupByStatus() Group by the status column
 * @method NestleBowerQuery groupByBowerId() Group by the bower_id column
 * @method NestleBowerQuery groupByDistributor() Group by the distributor column
 * @method NestleBowerQuery groupByDistributorId() Group by the distributor_id column
 *
 * @method NestleBowerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerQuery leftJoinNestleNestleDistributors($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleNestleDistributors relation
 * @method NestleBowerQuery rightJoinNestleNestleDistributors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleNestleDistributors relation
 * @method NestleBowerQuery innerJoinNestleNestleDistributors($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleNestleDistributors relation
 *
 * @method NestleBowerQuery leftJoinNestleBowerArea($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerArea relation
 * @method NestleBowerQuery rightJoinNestleBowerArea($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerArea relation
 * @method NestleBowerQuery innerJoinNestleBowerArea($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerArea relation
 *
 * @method NestleBowerQuery leftJoinNestleBowerAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerAccount relation
 * @method NestleBowerQuery rightJoinNestleBowerAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerAccount relation
 * @method NestleBowerQuery innerJoinNestleBowerAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerAccount relation
 *
 * @method NestleBowerQuery leftJoinNestleBowerInvoices($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerInvoices relation
 * @method NestleBowerQuery rightJoinNestleBowerInvoices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerInvoices relation
 * @method NestleBowerQuery innerJoinNestleBowerInvoices($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerInvoices relation
 *
 * @method NestleBowerQuery leftJoinNestleBowerSalesReport($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerSalesReport relation
 * @method NestleBowerQuery rightJoinNestleBowerSalesReport($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerSalesReport relation
 * @method NestleBowerQuery innerJoinNestleBowerSalesReport($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerSalesReport relation
 *
 * @method NestleBower findOne(PropelPDO $con = null) Return the first NestleBower matching the query
 * @method NestleBower findOneOrCreate(PropelPDO $con = null) Return the first NestleBower matching the query, or a new NestleBower object populated from the query conditions when no match is found
 *
 * @method NestleBower findOneByFname(string $fname) Return the first NestleBower filtered by the fname column
 * @method NestleBower findOneByLname(string $lname) Return the first NestleBower filtered by the lname column
 * @method NestleBower findOneByContactNumber(string $contact_number) Return the first NestleBower filtered by the contact_number column
 * @method NestleBower findOneByBdate(string $bdate) Return the first NestleBower filtered by the bdate column
 * @method NestleBower findOneByUsername(string $username) Return the first NestleBower filtered by the username column
 * @method NestleBower findOneByPassword(string $password) Return the first NestleBower filtered by the password column
 * @method NestleBower findOneByAreaId(int $area_id) Return the first NestleBower filtered by the area_id column
 * @method NestleBower findOneByStatus(int $status) Return the first NestleBower filtered by the status column
 * @method NestleBower findOneByBowerId(string $bower_id) Return the first NestleBower filtered by the bower_id column
 * @method NestleBower findOneByDistributor(string $distributor) Return the first NestleBower filtered by the distributor column
 * @method NestleBower findOneByDistributorId(int $distributor_id) Return the first NestleBower filtered by the distributor_id column
 *
 * @method array findById(int $id) Return NestleBower objects filtered by the id column
 * @method array findByFname(string $fname) Return NestleBower objects filtered by the fname column
 * @method array findByLname(string $lname) Return NestleBower objects filtered by the lname column
 * @method array findByContactNumber(string $contact_number) Return NestleBower objects filtered by the contact_number column
 * @method array findByBdate(string $bdate) Return NestleBower objects filtered by the bdate column
 * @method array findByUsername(string $username) Return NestleBower objects filtered by the username column
 * @method array findByPassword(string $password) Return NestleBower objects filtered by the password column
 * @method array findByAreaId(int $area_id) Return NestleBower objects filtered by the area_id column
 * @method array findByStatus(int $status) Return NestleBower objects filtered by the status column
 * @method array findByBowerId(string $bower_id) Return NestleBower objects filtered by the bower_id column
 * @method array findByDistributor(string $distributor) Return NestleBower objects filtered by the distributor column
 * @method array findByDistributorId(int $distributor_id) Return NestleBower objects filtered by the distributor_id column
 */
abstract class BaseNestleBowerQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBower';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerQuery) {
            return $criteria;
        }
        $query = new NestleBowerQuery(null, null, $modelAlias);

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
     * @return   NestleBower|NestleBower[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBower A model object, or null if the key is not found
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
     * @return                 NestleBower A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `fname`, `lname`, `contact_number`, `bdate`, `username`, `password`, `area_id`, `status`, `bower_id`, `distributor`, `distributor_id` FROM `bower` WHERE `id` = :p0';
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
            $obj = new NestleBower();
            $obj->hydrate($row);
            NestleBowerPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBower|NestleBower[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBower[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the fname column
     *
     * Example usage:
     * <code>
     * $query->filterByFname('fooValue');   // WHERE fname = 'fooValue'
     * $query->filterByFname('%fooValue%'); // WHERE fname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByFname($fname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fname)) {
                $fname = str_replace('*', '%', $fname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::FNAME, $fname, $comparison);
    }

    /**
     * Filter the query on the lname column
     *
     * Example usage:
     * <code>
     * $query->filterByLname('fooValue');   // WHERE lname = 'fooValue'
     * $query->filterByLname('%fooValue%'); // WHERE lname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByLname($lname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lname)) {
                $lname = str_replace('*', '%', $lname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::LNAME, $lname, $comparison);
    }

    /**
     * Filter the query on the contact_number column
     *
     * Example usage:
     * <code>
     * $query->filterByContactNumber('fooValue');   // WHERE contact_number = 'fooValue'
     * $query->filterByContactNumber('%fooValue%'); // WHERE contact_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByContactNumber($contactNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contactNumber)) {
                $contactNumber = str_replace('*', '%', $contactNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::CONTACT_NUMBER, $contactNumber, $comparison);
    }

    /**
     * Filter the query on the bdate column
     *
     * Example usage:
     * <code>
     * $query->filterByBdate('fooValue');   // WHERE bdate = 'fooValue'
     * $query->filterByBdate('%fooValue%'); // WHERE bdate LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bdate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByBdate($bdate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bdate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bdate)) {
                $bdate = str_replace('*', '%', $bdate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::BDATE, $bdate, $comparison);
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%'); // WHERE username LIKE '%fooValue%'
     * </code>
     *
     * @param     string $username The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByUsername($username = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $username)) {
                $username = str_replace('*', '%', $username);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::USERNAME, $username, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%'); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $password)) {
                $password = str_replace('*', '%', $password);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the area_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAreaId(1234); // WHERE area_id = 1234
     * $query->filterByAreaId(array(12, 34)); // WHERE area_id IN (12, 34)
     * $query->filterByAreaId(array('min' => 12)); // WHERE area_id >= 12
     * $query->filterByAreaId(array('max' => 12)); // WHERE area_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerArea()
     *
     * @param     mixed $areaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByAreaId($areaId = null, $comparison = null)
    {
        if (is_array($areaId)) {
            $useMinMax = false;
            if (isset($areaId['min'])) {
                $this->addUsingAlias(NestleBowerPeer::AREA_ID, $areaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($areaId['max'])) {
                $this->addUsingAlias(NestleBowerPeer::AREA_ID, $areaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::AREA_ID, $areaId, $comparison);
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
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the bower_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBowerId('fooValue');   // WHERE bower_id = 'fooValue'
     * $query->filterByBowerId('%fooValue%'); // WHERE bower_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bowerId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByBowerId($bowerId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bowerId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bowerId)) {
                $bowerId = str_replace('*', '%', $bowerId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::BOWER_ID, $bowerId, $comparison);
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
     * @return NestleBowerQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NestleBowerPeer::DISTRIBUTOR, $distributor, $comparison);
    }

    /**
     * Filter the query on the distributor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDistributorId(1234); // WHERE distributor_id = 1234
     * $query->filterByDistributorId(array(12, 34)); // WHERE distributor_id IN (12, 34)
     * $query->filterByDistributorId(array('min' => 12)); // WHERE distributor_id >= 12
     * $query->filterByDistributorId(array('max' => 12)); // WHERE distributor_id <= 12
     * </code>
     *
     * @see       filterByNestleNestleDistributors()
     *
     * @param     mixed $distributorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function filterByDistributorId($distributorId = null, $comparison = null)
    {
        if (is_array($distributorId)) {
            $useMinMax = false;
            if (isset($distributorId['min'])) {
                $this->addUsingAlias(NestleBowerPeer::DISTRIBUTOR_ID, $distributorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($distributorId['max'])) {
                $this->addUsingAlias(NestleBowerPeer::DISTRIBUTOR_ID, $distributorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerPeer::DISTRIBUTOR_ID, $distributorId, $comparison);
    }

    /**
     * Filter the query by a related NestleNestleDistributors object
     *
     * @param   NestleNestleDistributors|PropelObjectCollection $nestleNestleDistributors The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleNestleDistributors($nestleNestleDistributors, $comparison = null)
    {
        if ($nestleNestleDistributors instanceof NestleNestleDistributors) {
            return $this
                ->addUsingAlias(NestleBowerPeer::DISTRIBUTOR_ID, $nestleNestleDistributors->getId(), $comparison);
        } elseif ($nestleNestleDistributors instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerPeer::DISTRIBUTOR_ID, $nestleNestleDistributors->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleNestleDistributors() only accepts arguments of type NestleNestleDistributors or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleNestleDistributors relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function joinNestleNestleDistributors($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleNestleDistributors');

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
            $this->addJoinObject($join, 'NestleNestleDistributors');
        }

        return $this;
    }

    /**
     * Use the NestleNestleDistributors relation NestleNestleDistributors object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleNestleDistributorsQuery A secondary query class using the current class as primary query
     */
    public function useNestleNestleDistributorsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleNestleDistributors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleNestleDistributors', '\Nestle\CoreBundle\Model\NestleNestleDistributorsQuery');
    }

    /**
     * Filter the query by a related NestleBowerArea object
     *
     * @param   NestleBowerArea|PropelObjectCollection $nestleBowerArea The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerArea($nestleBowerArea, $comparison = null)
    {
        if ($nestleBowerArea instanceof NestleBowerArea) {
            return $this
                ->addUsingAlias(NestleBowerPeer::AREA_ID, $nestleBowerArea->getId(), $comparison);
        } elseif ($nestleBowerArea instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerPeer::AREA_ID, $nestleBowerArea->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return NestleBowerQuery The current query, for fluid interface
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
     * Filter the query by a related NestleBowerAccount object
     *
     * @param   NestleBowerAccount|PropelObjectCollection $nestleBowerAccount  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerAccount($nestleBowerAccount, $comparison = null)
    {
        if ($nestleBowerAccount instanceof NestleBowerAccount) {
            return $this
                ->addUsingAlias(NestleBowerPeer::ID, $nestleBowerAccount->getBowerId(), $comparison);
        } elseif ($nestleBowerAccount instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerAccountQuery()
                ->filterByPrimaryKeys($nestleBowerAccount->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerAccount() only accepts arguments of type NestleBowerAccount or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerAccount relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function joinNestleBowerAccount($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerAccount');

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
            $this->addJoinObject($join, 'NestleBowerAccount');
        }

        return $this;
    }

    /**
     * Use the NestleBowerAccount relation NestleBowerAccount object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerAccountQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerAccountQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerAccount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerAccount', '\Nestle\CoreBundle\Model\NestleBowerAccountQuery');
    }

    /**
     * Filter the query by a related NestleBowerInvoices object
     *
     * @param   NestleBowerInvoices|PropelObjectCollection $nestleBowerInvoices  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerInvoices($nestleBowerInvoices, $comparison = null)
    {
        if ($nestleBowerInvoices instanceof NestleBowerInvoices) {
            return $this
                ->addUsingAlias(NestleBowerPeer::ID, $nestleBowerInvoices->getBowerId(), $comparison);
        } elseif ($nestleBowerInvoices instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerInvoicesQuery()
                ->filterByPrimaryKeys($nestleBowerInvoices->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerInvoices() only accepts arguments of type NestleBowerInvoices or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerInvoices relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function joinNestleBowerInvoices($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerInvoices');

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
            $this->addJoinObject($join, 'NestleBowerInvoices');
        }

        return $this;
    }

    /**
     * Use the NestleBowerInvoices relation NestleBowerInvoices object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerInvoicesQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerInvoicesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerInvoices($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerInvoices', '\Nestle\CoreBundle\Model\NestleBowerInvoicesQuery');
    }

    /**
     * Filter the query by a related NestleBowerSalesReport object
     *
     * @param   NestleBowerSalesReport|PropelObjectCollection $nestleBowerSalesReport  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerSalesReport($nestleBowerSalesReport, $comparison = null)
    {
        if ($nestleBowerSalesReport instanceof NestleBowerSalesReport) {
            return $this
                ->addUsingAlias(NestleBowerPeer::ID, $nestleBowerSalesReport->getBowerId(), $comparison);
        } elseif ($nestleBowerSalesReport instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerSalesReportQuery()
                ->filterByPrimaryKeys($nestleBowerSalesReport->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerSalesReport() only accepts arguments of type NestleBowerSalesReport or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerSalesReport relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function joinNestleBowerSalesReport($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerSalesReport');

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
            $this->addJoinObject($join, 'NestleBowerSalesReport');
        }

        return $this;
    }

    /**
     * Use the NestleBowerSalesReport relation NestleBowerSalesReport object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerSalesReportQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerSalesReportQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerSalesReport($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerSalesReport', '\Nestle\CoreBundle\Model\NestleBowerSalesReportQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NestleBower $nestleBower Object to remove from the list of results
     *
     * @return NestleBowerQuery The current query, for fluid interface
     */
    public function prune($nestleBower = null)
    {
        if ($nestleBower) {
            $this->addUsingAlias(NestleBowerPeer::ID, $nestleBower->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
