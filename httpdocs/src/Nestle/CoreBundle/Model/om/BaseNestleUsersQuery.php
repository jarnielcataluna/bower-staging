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
use Nestle\CoreBundle\Model\NestleUsers;
use Nestle\CoreBundle\Model\NestleUsersPeer;
use Nestle\CoreBundle\Model\NestleUsersQuery;

/**
 * @method NestleUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleUsersQuery orderByFname($order = Criteria::ASC) Order by the fname column
 * @method NestleUsersQuery orderByLname($order = Criteria::ASC) Order by the lname column
 * @method NestleUsersQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method NestleUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method NestleUsersQuery orderByLevel($order = Criteria::ASC) Order by the level column
 * @method NestleUsersQuery orderByDepartment($order = Criteria::ASC) Order by the department column
 * @method NestleUsersQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method NestleUsersQuery orderByToken($order = Criteria::ASC) Order by the token column
 * @method NestleUsersQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method NestleUsersQuery groupById() Group by the id column
 * @method NestleUsersQuery groupByFname() Group by the fname column
 * @method NestleUsersQuery groupByLname() Group by the lname column
 * @method NestleUsersQuery groupByUsername() Group by the username column
 * @method NestleUsersQuery groupByPassword() Group by the password column
 * @method NestleUsersQuery groupByLevel() Group by the level column
 * @method NestleUsersQuery groupByDepartment() Group by the department column
 * @method NestleUsersQuery groupByLastLogin() Group by the last_login column
 * @method NestleUsersQuery groupByToken() Group by the token column
 * @method NestleUsersQuery groupByStatus() Group by the status column
 *
 * @method NestleUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleUsers findOne(PropelPDO $con = null) Return the first NestleUsers matching the query
 * @method NestleUsers findOneOrCreate(PropelPDO $con = null) Return the first NestleUsers matching the query, or a new NestleUsers object populated from the query conditions when no match is found
 *
 * @method NestleUsers findOneByFname(string $fname) Return the first NestleUsers filtered by the fname column
 * @method NestleUsers findOneByLname(string $lname) Return the first NestleUsers filtered by the lname column
 * @method NestleUsers findOneByUsername(string $username) Return the first NestleUsers filtered by the username column
 * @method NestleUsers findOneByPassword(string $password) Return the first NestleUsers filtered by the password column
 * @method NestleUsers findOneByLevel(string $level) Return the first NestleUsers filtered by the level column
 * @method NestleUsers findOneByDepartment(string $department) Return the first NestleUsers filtered by the department column
 * @method NestleUsers findOneByLastLogin(string $last_login) Return the first NestleUsers filtered by the last_login column
 * @method NestleUsers findOneByToken(string $token) Return the first NestleUsers filtered by the token column
 * @method NestleUsers findOneByStatus(int $status) Return the first NestleUsers filtered by the status column
 *
 * @method array findById(int $id) Return NestleUsers objects filtered by the id column
 * @method array findByFname(string $fname) Return NestleUsers objects filtered by the fname column
 * @method array findByLname(string $lname) Return NestleUsers objects filtered by the lname column
 * @method array findByUsername(string $username) Return NestleUsers objects filtered by the username column
 * @method array findByPassword(string $password) Return NestleUsers objects filtered by the password column
 * @method array findByLevel(string $level) Return NestleUsers objects filtered by the level column
 * @method array findByDepartment(string $department) Return NestleUsers objects filtered by the department column
 * @method array findByLastLogin(string $last_login) Return NestleUsers objects filtered by the last_login column
 * @method array findByToken(string $token) Return NestleUsers objects filtered by the token column
 * @method array findByStatus(int $status) Return NestleUsers objects filtered by the status column
 */
abstract class BaseNestleUsersQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleUsersQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleUsers';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleUsersQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleUsersQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleUsersQuery) {
            return $criteria;
        }
        $query = new NestleUsersQuery(null, null, $modelAlias);

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
     * @return   NestleUsers|NestleUsers[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleUsersPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleUsers A model object, or null if the key is not found
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
     * @return                 NestleUsers A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `fname`, `lname`, `username`, `password`, `level`, `department`, `last_login`, `token`, `status` FROM `users` WHERE `id` = :p0';
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
            $obj = new NestleUsers();
            $obj->hydrate($row);
            NestleUsersPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleUsers|NestleUsers[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleUsers[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleUsersPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleUsersPeer::ID, $keys, Criteria::IN);
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
     * @return NestleUsersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleUsersPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleUsersPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleUsersPeer::ID, $id, $comparison);
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
     * @return NestleUsersQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NestleUsersPeer::FNAME, $fname, $comparison);
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
     * @return NestleUsersQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NestleUsersPeer::LNAME, $lname, $comparison);
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
     * @return NestleUsersQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NestleUsersPeer::USERNAME, $username, $comparison);
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
     * @return NestleUsersQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NestleUsersPeer::PASSWORD, $password, $comparison);
    }

    /**
     * Filter the query on the level column
     *
     * Example usage:
     * <code>
     * $query->filterByLevel('fooValue');   // WHERE level = 'fooValue'
     * $query->filterByLevel('%fooValue%'); // WHERE level LIKE '%fooValue%'
     * </code>
     *
     * @param     string $level The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleUsersQuery The current query, for fluid interface
     */
    public function filterByLevel($level = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($level)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $level)) {
                $level = str_replace('*', '%', $level);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleUsersPeer::LEVEL, $level, $comparison);
    }

    /**
     * Filter the query on the department column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartment('fooValue');   // WHERE department = 'fooValue'
     * $query->filterByDepartment('%fooValue%'); // WHERE department LIKE '%fooValue%'
     * </code>
     *
     * @param     string $department The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleUsersQuery The current query, for fluid interface
     */
    public function filterByDepartment($department = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($department)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $department)) {
                $department = str_replace('*', '%', $department);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleUsersPeer::DEPARTMENT, $department, $comparison);
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin('fooValue');   // WHERE last_login = 'fooValue'
     * $query->filterByLastLogin('%fooValue%'); // WHERE last_login LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastLogin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleUsersQuery The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastLogin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastLogin)) {
                $lastLogin = str_replace('*', '%', $lastLogin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleUsersPeer::LAST_LOGIN, $lastLogin, $comparison);
    }

    /**
     * Filter the query on the token column
     *
     * Example usage:
     * <code>
     * $query->filterByToken('fooValue');   // WHERE token = 'fooValue'
     * $query->filterByToken('%fooValue%'); // WHERE token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $token The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleUsersQuery The current query, for fluid interface
     */
    public function filterByToken($token = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($token)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $token)) {
                $token = str_replace('*', '%', $token);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleUsersPeer::TOKEN, $token, $comparison);
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
     * @return NestleUsersQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleUsersPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleUsersPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleUsersPeer::STATUS, $status, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   NestleUsers $nestleUsers Object to remove from the list of results
     *
     * @return NestleUsersQuery The current query, for fluid interface
     */
    public function prune($nestleUsers = null)
    {
        if ($nestleUsers) {
            $this->addUsingAlias(NestleUsersPeer::ID, $nestleUsers->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
