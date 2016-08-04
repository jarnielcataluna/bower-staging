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
use Nestle\CoreBundle\Model\NestleBowerAccount;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcp;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcpPeer;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcpQuery;
use Nestle\CoreBundle\Model\NestleBowerArea;
use Nestle\CoreBundle\Model\NestleBowerCategory;
use Nestle\CoreBundle\Model\NestleBowerCity;
use Nestle\CoreBundle\Model\NestleBowerInvoices;

/**
 * @method NestleBowerAccountsMcpQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerAccountsMcpQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method NestleBowerAccountsMcpQuery orderByContactPerson($order = Criteria::ASC) Order by the contact_person column
 * @method NestleBowerAccountsMcpQuery orderByContactNumber($order = Criteria::ASC) Order by the contact_number column
 * @method NestleBowerAccountsMcpQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method NestleBowerAccountsMcpQuery orderByLatitude($order = Criteria::ASC) Order by the latitude column
 * @method NestleBowerAccountsMcpQuery orderByLongitude($order = Criteria::ASC) Order by the longitude column
 * @method NestleBowerAccountsMcpQuery orderByBestFrom($order = Criteria::ASC) Order by the best_from column
 * @method NestleBowerAccountsMcpQuery orderByBestTo($order = Criteria::ASC) Order by the best_to column
 * @method NestleBowerAccountsMcpQuery orderByAreaId($order = Criteria::ASC) Order by the area_id column
 * @method NestleBowerAccountsMcpQuery orderByCityId($order = Criteria::ASC) Order by the city_id column
 * @method NestleBowerAccountsMcpQuery orderByFrequency($order = Criteria::ASC) Order by the frequency column
 * @method NestleBowerAccountsMcpQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 * @method NestleBowerAccountsMcpQuery orderByChannel($order = Criteria::ASC) Order by the channel column
 * @method NestleBowerAccountsMcpQuery orderByBracketNumber($order = Criteria::ASC) Order by the bracket_number column
 * @method NestleBowerAccountsMcpQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleBowerAccountsMcpQuery groupById() Group by the id column
 * @method NestleBowerAccountsMcpQuery groupByName() Group by the name column
 * @method NestleBowerAccountsMcpQuery groupByContactPerson() Group by the contact_person column
 * @method NestleBowerAccountsMcpQuery groupByContactNumber() Group by the contact_number column
 * @method NestleBowerAccountsMcpQuery groupByAddress() Group by the address column
 * @method NestleBowerAccountsMcpQuery groupByLatitude() Group by the latitude column
 * @method NestleBowerAccountsMcpQuery groupByLongitude() Group by the longitude column
 * @method NestleBowerAccountsMcpQuery groupByBestFrom() Group by the best_from column
 * @method NestleBowerAccountsMcpQuery groupByBestTo() Group by the best_to column
 * @method NestleBowerAccountsMcpQuery groupByAreaId() Group by the area_id column
 * @method NestleBowerAccountsMcpQuery groupByCityId() Group by the city_id column
 * @method NestleBowerAccountsMcpQuery groupByFrequency() Group by the frequency column
 * @method NestleBowerAccountsMcpQuery groupByCategoryId() Group by the category_id column
 * @method NestleBowerAccountsMcpQuery groupByChannel() Group by the channel column
 * @method NestleBowerAccountsMcpQuery groupByBracketNumber() Group by the bracket_number column
 * @method NestleBowerAccountsMcpQuery groupByStatus() Group by the status column
 *
 * @method NestleBowerAccountsMcpQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerAccountsMcpQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerAccountsMcpQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerAccountsMcpQuery leftJoinNestleBowerArea($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerArea relation
 * @method NestleBowerAccountsMcpQuery rightJoinNestleBowerArea($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerArea relation
 * @method NestleBowerAccountsMcpQuery innerJoinNestleBowerArea($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerArea relation
 *
 * @method NestleBowerAccountsMcpQuery leftJoinNestleBowerCity($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerCity relation
 * @method NestleBowerAccountsMcpQuery rightJoinNestleBowerCity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerCity relation
 * @method NestleBowerAccountsMcpQuery innerJoinNestleBowerCity($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerCity relation
 *
 * @method NestleBowerAccountsMcpQuery leftJoinNestleBowerCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerCategory relation
 * @method NestleBowerAccountsMcpQuery rightJoinNestleBowerCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerCategory relation
 * @method NestleBowerAccountsMcpQuery innerJoinNestleBowerCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerCategory relation
 *
 * @method NestleBowerAccountsMcpQuery leftJoinNestleBowerAccount($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerAccount relation
 * @method NestleBowerAccountsMcpQuery rightJoinNestleBowerAccount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerAccount relation
 * @method NestleBowerAccountsMcpQuery innerJoinNestleBowerAccount($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerAccount relation
 *
 * @method NestleBowerAccountsMcpQuery leftJoinNestleBowerInvoices($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerInvoices relation
 * @method NestleBowerAccountsMcpQuery rightJoinNestleBowerInvoices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerInvoices relation
 * @method NestleBowerAccountsMcpQuery innerJoinNestleBowerInvoices($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerInvoices relation
 *
 * @method NestleBowerAccountsMcp findOne(PropelPDO $con = null) Return the first NestleBowerAccountsMcp matching the query
 * @method NestleBowerAccountsMcp findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerAccountsMcp matching the query, or a new NestleBowerAccountsMcp object populated from the query conditions when no match is found
 *
 * @method NestleBowerAccountsMcp findOneByName(string $name) Return the first NestleBowerAccountsMcp filtered by the name column
 * @method NestleBowerAccountsMcp findOneByContactPerson(string $contact_person) Return the first NestleBowerAccountsMcp filtered by the contact_person column
 * @method NestleBowerAccountsMcp findOneByContactNumber(string $contact_number) Return the first NestleBowerAccountsMcp filtered by the contact_number column
 * @method NestleBowerAccountsMcp findOneByAddress(string $address) Return the first NestleBowerAccountsMcp filtered by the address column
 * @method NestleBowerAccountsMcp findOneByLatitude(string $latitude) Return the first NestleBowerAccountsMcp filtered by the latitude column
 * @method NestleBowerAccountsMcp findOneByLongitude(string $longitude) Return the first NestleBowerAccountsMcp filtered by the longitude column
 * @method NestleBowerAccountsMcp findOneByBestFrom(string $best_from) Return the first NestleBowerAccountsMcp filtered by the best_from column
 * @method NestleBowerAccountsMcp findOneByBestTo(string $best_to) Return the first NestleBowerAccountsMcp filtered by the best_to column
 * @method NestleBowerAccountsMcp findOneByAreaId(int $area_id) Return the first NestleBowerAccountsMcp filtered by the area_id column
 * @method NestleBowerAccountsMcp findOneByCityId(int $city_id) Return the first NestleBowerAccountsMcp filtered by the city_id column
 * @method NestleBowerAccountsMcp findOneByFrequency(string $frequency) Return the first NestleBowerAccountsMcp filtered by the frequency column
 * @method NestleBowerAccountsMcp findOneByCategoryId(int $category_id) Return the first NestleBowerAccountsMcp filtered by the category_id column
 * @method NestleBowerAccountsMcp findOneByChannel(string $channel) Return the first NestleBowerAccountsMcp filtered by the channel column
 * @method NestleBowerAccountsMcp findOneByBracketNumber(string $bracket_number) Return the first NestleBowerAccountsMcp filtered by the bracket_number column
 * @method NestleBowerAccountsMcp findOneByStatus(int $status) Return the first NestleBowerAccountsMcp filtered by the status column
 *
 * @method array findById(int $id) Return NestleBowerAccountsMcp objects filtered by the id column
 * @method array findByName(string $name) Return NestleBowerAccountsMcp objects filtered by the name column
 * @method array findByContactPerson(string $contact_person) Return NestleBowerAccountsMcp objects filtered by the contact_person column
 * @method array findByContactNumber(string $contact_number) Return NestleBowerAccountsMcp objects filtered by the contact_number column
 * @method array findByAddress(string $address) Return NestleBowerAccountsMcp objects filtered by the address column
 * @method array findByLatitude(string $latitude) Return NestleBowerAccountsMcp objects filtered by the latitude column
 * @method array findByLongitude(string $longitude) Return NestleBowerAccountsMcp objects filtered by the longitude column
 * @method array findByBestFrom(string $best_from) Return NestleBowerAccountsMcp objects filtered by the best_from column
 * @method array findByBestTo(string $best_to) Return NestleBowerAccountsMcp objects filtered by the best_to column
 * @method array findByAreaId(int $area_id) Return NestleBowerAccountsMcp objects filtered by the area_id column
 * @method array findByCityId(int $city_id) Return NestleBowerAccountsMcp objects filtered by the city_id column
 * @method array findByFrequency(string $frequency) Return NestleBowerAccountsMcp objects filtered by the frequency column
 * @method array findByCategoryId(int $category_id) Return NestleBowerAccountsMcp objects filtered by the category_id column
 * @method array findByChannel(string $channel) Return NestleBowerAccountsMcp objects filtered by the channel column
 * @method array findByBracketNumber(string $bracket_number) Return NestleBowerAccountsMcp objects filtered by the bracket_number column
 * @method array findByStatus(int $status) Return NestleBowerAccountsMcp objects filtered by the status column
 */
abstract class BaseNestleBowerAccountsMcpQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerAccountsMcpQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerAccountsMcp';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerAccountsMcpQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerAccountsMcpQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerAccountsMcpQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerAccountsMcpQuery) {
            return $criteria;
        }
        $query = new NestleBowerAccountsMcpQuery(null, null, $modelAlias);

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
     * @return   NestleBowerAccountsMcp|NestleBowerAccountsMcp[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerAccountsMcpPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerAccountsMcpPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerAccountsMcp A model object, or null if the key is not found
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
     * @return                 NestleBowerAccountsMcp A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `contact_person`, `contact_number`, `address`, `latitude`, `longitude`, `best_from`, `best_to`, `area_id`, `city_id`, `frequency`, `category_id`, `channel`, `bracket_number`, `status` FROM `accounts` WHERE `id` = :p0';
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
            $obj = new NestleBowerAccountsMcp();
            $obj->hydrate($row);
            NestleBowerAccountsMcpPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerAccountsMcp|NestleBowerAccountsMcp[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerAccountsMcp[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::ID, $id, $comparison);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the contact_person column
     *
     * Example usage:
     * <code>
     * $query->filterByContactPerson('fooValue');   // WHERE contact_person = 'fooValue'
     * $query->filterByContactPerson('%fooValue%'); // WHERE contact_person LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contactPerson The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByContactPerson($contactPerson = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contactPerson)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contactPerson)) {
                $contactPerson = str_replace('*', '%', $contactPerson);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::CONTACT_PERSON, $contactPerson, $comparison);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::CONTACT_NUMBER, $contactNumber, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%'); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address)) {
                $address = str_replace('*', '%', $address);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the latitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitude('fooValue');   // WHERE latitude = 'fooValue'
     * $query->filterByLatitude('%fooValue%'); // WHERE latitude LIKE '%fooValue%'
     * </code>
     *
     * @param     string $latitude The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByLatitude($latitude = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($latitude)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $latitude)) {
                $latitude = str_replace('*', '%', $latitude);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::LATITUDE, $latitude, $comparison);
    }

    /**
     * Filter the query on the longitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLongitude('fooValue');   // WHERE longitude = 'fooValue'
     * $query->filterByLongitude('%fooValue%'); // WHERE longitude LIKE '%fooValue%'
     * </code>
     *
     * @param     string $longitude The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByLongitude($longitude = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($longitude)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $longitude)) {
                $longitude = str_replace('*', '%', $longitude);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::LONGITUDE, $longitude, $comparison);
    }

    /**
     * Filter the query on the best_from column
     *
     * Example usage:
     * <code>
     * $query->filterByBestFrom('fooValue');   // WHERE best_from = 'fooValue'
     * $query->filterByBestFrom('%fooValue%'); // WHERE best_from LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bestFrom The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByBestFrom($bestFrom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bestFrom)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bestFrom)) {
                $bestFrom = str_replace('*', '%', $bestFrom);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::BEST_FROM, $bestFrom, $comparison);
    }

    /**
     * Filter the query on the best_to column
     *
     * Example usage:
     * <code>
     * $query->filterByBestTo('fooValue');   // WHERE best_to = 'fooValue'
     * $query->filterByBestTo('%fooValue%'); // WHERE best_to LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bestTo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByBestTo($bestTo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bestTo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bestTo)) {
                $bestTo = str_replace('*', '%', $bestTo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::BEST_TO, $bestTo, $comparison);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByAreaId($areaId = null, $comparison = null)
    {
        if (is_array($areaId)) {
            $useMinMax = false;
            if (isset($areaId['min'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::AREA_ID, $areaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($areaId['max'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::AREA_ID, $areaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::AREA_ID, $areaId, $comparison);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByCityId($cityId = null, $comparison = null)
    {
        if (is_array($cityId)) {
            $useMinMax = false;
            if (isset($cityId['min'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::CITY_ID, $cityId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cityId['max'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::CITY_ID, $cityId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::CITY_ID, $cityId, $comparison);
    }

    /**
     * Filter the query on the frequency column
     *
     * Example usage:
     * <code>
     * $query->filterByFrequency('fooValue');   // WHERE frequency = 'fooValue'
     * $query->filterByFrequency('%fooValue%'); // WHERE frequency LIKE '%fooValue%'
     * </code>
     *
     * @param     string $frequency The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByFrequency($frequency = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($frequency)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $frequency)) {
                $frequency = str_replace('*', '%', $frequency);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::FREQUENCY, $frequency, $comparison);
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId(1234); // WHERE category_id = 1234
     * $query->filterByCategoryId(array(12, 34)); // WHERE category_id IN (12, 34)
     * $query->filterByCategoryId(array('min' => 12)); // WHERE category_id >= 12
     * $query->filterByCategoryId(array('max' => 12)); // WHERE category_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerCategory()
     *
     * @param     mixed $categoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, $comparison = null)
    {
        if (is_array($categoryId)) {
            $useMinMax = false;
            if (isset($categoryId['min'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::CATEGORY_ID, $categoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoryId['max'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::CATEGORY_ID, $categoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::CATEGORY_ID, $categoryId, $comparison);
    }

    /**
     * Filter the query on the channel column
     *
     * Example usage:
     * <code>
     * $query->filterByChannel('fooValue');   // WHERE channel = 'fooValue'
     * $query->filterByChannel('%fooValue%'); // WHERE channel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $channel The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByChannel($channel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($channel)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $channel)) {
                $channel = str_replace('*', '%', $channel);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::CHANNEL, $channel, $comparison);
    }

    /**
     * Filter the query on the bracket_number column
     *
     * Example usage:
     * <code>
     * $query->filterByBracketNumber('fooValue');   // WHERE bracket_number = 'fooValue'
     * $query->filterByBracketNumber('%fooValue%'); // WHERE bracket_number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bracketNumber The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByBracketNumber($bracketNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bracketNumber)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bracketNumber)) {
                $bracketNumber = str_replace('*', '%', $bracketNumber);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::BRACKET_NUMBER, $bracketNumber, $comparison);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerAccountsMcpPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerAccountsMcpPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerArea object
     *
     * @param   NestleBowerArea|PropelObjectCollection $nestleBowerArea The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerAccountsMcpQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerArea($nestleBowerArea, $comparison = null)
    {
        if ($nestleBowerArea instanceof NestleBowerArea) {
            return $this
                ->addUsingAlias(NestleBowerAccountsMcpPeer::AREA_ID, $nestleBowerArea->getId(), $comparison);
        } elseif ($nestleBowerArea instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerAccountsMcpPeer::AREA_ID, $nestleBowerArea->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
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
     * Filter the query by a related NestleBowerCity object
     *
     * @param   NestleBowerCity|PropelObjectCollection $nestleBowerCity The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerAccountsMcpQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerCity($nestleBowerCity, $comparison = null)
    {
        if ($nestleBowerCity instanceof NestleBowerCity) {
            return $this
                ->addUsingAlias(NestleBowerAccountsMcpPeer::CITY_ID, $nestleBowerCity->getId(), $comparison);
        } elseif ($nestleBowerCity instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerAccountsMcpPeer::CITY_ID, $nestleBowerCity->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
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
     * Filter the query by a related NestleBowerCategory object
     *
     * @param   NestleBowerCategory|PropelObjectCollection $nestleBowerCategory The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerAccountsMcpQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerCategory($nestleBowerCategory, $comparison = null)
    {
        if ($nestleBowerCategory instanceof NestleBowerCategory) {
            return $this
                ->addUsingAlias(NestleBowerAccountsMcpPeer::CATEGORY_ID, $nestleBowerCategory->getId(), $comparison);
        } elseif ($nestleBowerCategory instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerAccountsMcpPeer::CATEGORY_ID, $nestleBowerCategory->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerCategory() only accepts arguments of type NestleBowerCategory or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function joinNestleBowerCategory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerCategory');

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
            $this->addJoinObject($join, 'NestleBowerCategory');
        }

        return $this;
    }

    /**
     * Use the NestleBowerCategory relation NestleBowerCategory object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerCategoryQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerCategory', '\Nestle\CoreBundle\Model\NestleBowerCategoryQuery');
    }

    /**
     * Filter the query by a related NestleBowerAccount object
     *
     * @param   NestleBowerAccount|PropelObjectCollection $nestleBowerAccount  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerAccountsMcpQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerAccount($nestleBowerAccount, $comparison = null)
    {
        if ($nestleBowerAccount instanceof NestleBowerAccount) {
            return $this
                ->addUsingAlias(NestleBowerAccountsMcpPeer::ID, $nestleBowerAccount->getAccountId(), $comparison);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
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
     * @return                 NestleBowerAccountsMcpQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerInvoices($nestleBowerInvoices, $comparison = null)
    {
        if ($nestleBowerInvoices instanceof NestleBowerInvoices) {
            return $this
                ->addUsingAlias(NestleBowerAccountsMcpPeer::ID, $nestleBowerInvoices->getAccountId(), $comparison);
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
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   NestleBowerAccountsMcp $nestleBowerAccountsMcp Object to remove from the list of results
     *
     * @return NestleBowerAccountsMcpQuery The current query, for fluid interface
     */
    public function prune($nestleBowerAccountsMcp = null)
    {
        if ($nestleBowerAccountsMcp) {
            $this->addUsingAlias(NestleBowerAccountsMcpPeer::ID, $nestleBowerAccountsMcp->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
