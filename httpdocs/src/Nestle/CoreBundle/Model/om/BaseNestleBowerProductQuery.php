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
use Nestle\CoreBundle\Model\NestleBowerBrandProduct;
use Nestle\CoreBundle\Model\NestleBowerInvoiceItem;
use Nestle\CoreBundle\Model\NestleBowerProduct;
use Nestle\CoreBundle\Model\NestleBowerProductCategory;
use Nestle\CoreBundle\Model\NestleBowerProductPeer;
use Nestle\CoreBundle\Model\NestleBowerProductQuery;
use Nestle\CoreBundle\Model\NestleBowerRules;

/**
 * @method NestleBowerProductQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NestleBowerProductQuery orderByProductCategoryId($order = Criteria::ASC) Order by the product_category_id column
 * @method NestleBowerProductQuery orderBySku($order = Criteria::ASC) Order by the sku column
 * @method NestleBowerProductQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method NestleBowerProductQuery orderByBackgroundColor($order = Criteria::ASC) Order by the background_color column
 * @method NestleBowerProductQuery orderByFontColor($order = Criteria::ASC) Order by the font_color column
 * @method NestleBowerProductQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method NestleBowerProductQuery orderByThumbnail($order = Criteria::ASC) Order by the thumbnail column
 * @method NestleBowerProductQuery orderByBasePrice($order = Criteria::ASC) Order by the base_price column
 * @method NestleBowerProductQuery orderByVat($order = Criteria::ASC) Order by the vat column
 * @method NestleBowerProductQuery orderByDateAdded($order = Criteria::ASC) Order by the date_added column
 * @method NestleBowerProductQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method NestleBowerProductQuery orderByType($order = Criteria::ASC) Order by the type column
 *
 * @method NestleBowerProductQuery groupById() Group by the id column
 * @method NestleBowerProductQuery groupByProductCategoryId() Group by the product_category_id column
 * @method NestleBowerProductQuery groupBySku() Group by the sku column
 * @method NestleBowerProductQuery groupByName() Group by the name column
 * @method NestleBowerProductQuery groupByBackgroundColor() Group by the background_color column
 * @method NestleBowerProductQuery groupByFontColor() Group by the font_color column
 * @method NestleBowerProductQuery groupByImage() Group by the image column
 * @method NestleBowerProductQuery groupByThumbnail() Group by the thumbnail column
 * @method NestleBowerProductQuery groupByBasePrice() Group by the base_price column
 * @method NestleBowerProductQuery groupByVat() Group by the vat column
 * @method NestleBowerProductQuery groupByDateAdded() Group by the date_added column
 * @method NestleBowerProductQuery groupByStatus() Group by the status column
 * @method NestleBowerProductQuery groupByType() Group by the type column
 *
 * @method NestleBowerProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NestleBowerProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NestleBowerProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NestleBowerProductQuery leftJoinNestleBowerProductCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerProductCategory relation
 * @method NestleBowerProductQuery rightJoinNestleBowerProductCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerProductCategory relation
 * @method NestleBowerProductQuery innerJoinNestleBowerProductCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerProductCategory relation
 *
 * @method NestleBowerProductQuery leftJoinNestleBowerBrandProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerBrandProduct relation
 * @method NestleBowerProductQuery rightJoinNestleBowerBrandProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerBrandProduct relation
 * @method NestleBowerProductQuery innerJoinNestleBowerBrandProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerBrandProduct relation
 *
 * @method NestleBowerProductQuery leftJoinNestleBowerInvoiceItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerInvoiceItem relation
 * @method NestleBowerProductQuery rightJoinNestleBowerInvoiceItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerInvoiceItem relation
 * @method NestleBowerProductQuery innerJoinNestleBowerInvoiceItem($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerInvoiceItem relation
 *
 * @method NestleBowerProductQuery leftJoinNestleBowerRulesRelatedByProductId($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerRulesRelatedByProductId relation
 * @method NestleBowerProductQuery rightJoinNestleBowerRulesRelatedByProductId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerRulesRelatedByProductId relation
 * @method NestleBowerProductQuery innerJoinNestleBowerRulesRelatedByProductId($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerRulesRelatedByProductId relation
 *
 * @method NestleBowerProductQuery leftJoinNestleBowerRulesRelatedByPromoProductId($relationAlias = null) Adds a LEFT JOIN clause to the query using the NestleBowerRulesRelatedByPromoProductId relation
 * @method NestleBowerProductQuery rightJoinNestleBowerRulesRelatedByPromoProductId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NestleBowerRulesRelatedByPromoProductId relation
 * @method NestleBowerProductQuery innerJoinNestleBowerRulesRelatedByPromoProductId($relationAlias = null) Adds a INNER JOIN clause to the query using the NestleBowerRulesRelatedByPromoProductId relation
 *
 * @method NestleBowerProduct findOne(PropelPDO $con = null) Return the first NestleBowerProduct matching the query
 * @method NestleBowerProduct findOneOrCreate(PropelPDO $con = null) Return the first NestleBowerProduct matching the query, or a new NestleBowerProduct object populated from the query conditions when no match is found
 *
 * @method NestleBowerProduct findOneByProductCategoryId(int $product_category_id) Return the first NestleBowerProduct filtered by the product_category_id column
 * @method NestleBowerProduct findOneBySku(string $sku) Return the first NestleBowerProduct filtered by the sku column
 * @method NestleBowerProduct findOneByName(string $name) Return the first NestleBowerProduct filtered by the name column
 * @method NestleBowerProduct findOneByBackgroundColor(string $background_color) Return the first NestleBowerProduct filtered by the background_color column
 * @method NestleBowerProduct findOneByFontColor(string $font_color) Return the first NestleBowerProduct filtered by the font_color column
 * @method NestleBowerProduct findOneByImage(string $image) Return the first NestleBowerProduct filtered by the image column
 * @method NestleBowerProduct findOneByThumbnail(string $thumbnail) Return the first NestleBowerProduct filtered by the thumbnail column
 * @method NestleBowerProduct findOneByBasePrice(double $base_price) Return the first NestleBowerProduct filtered by the base_price column
 * @method NestleBowerProduct findOneByVat(double $vat) Return the first NestleBowerProduct filtered by the vat column
 * @method NestleBowerProduct findOneByDateAdded(string $date_added) Return the first NestleBowerProduct filtered by the date_added column
 * @method NestleBowerProduct findOneByStatus(int $status) Return the first NestleBowerProduct filtered by the status column
 * @method NestleBowerProduct findOneByType(int $type) Return the first NestleBowerProduct filtered by the type column
 *
 * @method array findById(int $id) Return NestleBowerProduct objects filtered by the id column
 * @method array findByProductCategoryId(int $product_category_id) Return NestleBowerProduct objects filtered by the product_category_id column
 * @method array findBySku(string $sku) Return NestleBowerProduct objects filtered by the sku column
 * @method array findByName(string $name) Return NestleBowerProduct objects filtered by the name column
 * @method array findByBackgroundColor(string $background_color) Return NestleBowerProduct objects filtered by the background_color column
 * @method array findByFontColor(string $font_color) Return NestleBowerProduct objects filtered by the font_color column
 * @method array findByImage(string $image) Return NestleBowerProduct objects filtered by the image column
 * @method array findByThumbnail(string $thumbnail) Return NestleBowerProduct objects filtered by the thumbnail column
 * @method array findByBasePrice(double $base_price) Return NestleBowerProduct objects filtered by the base_price column
 * @method array findByVat(double $vat) Return NestleBowerProduct objects filtered by the vat column
 * @method array findByDateAdded(string $date_added) Return NestleBowerProduct objects filtered by the date_added column
 * @method array findByStatus(int $status) Return NestleBowerProduct objects filtered by the status column
 * @method array findByType(int $type) Return NestleBowerProduct objects filtered by the type column
 */
abstract class BaseNestleBowerProductQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNestleBowerProductQuery object.
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
            $modelName = 'Nestle\\CoreBundle\\Model\\NestleBowerProduct';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NestleBowerProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NestleBowerProductQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NestleBowerProductQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NestleBowerProductQuery) {
            return $criteria;
        }
        $query = new NestleBowerProductQuery(null, null, $modelAlias);

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
     * @return   NestleBowerProduct|NestleBowerProduct[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NestleBowerProductPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NestleBowerProductPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NestleBowerProduct A model object, or null if the key is not found
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
     * @return                 NestleBowerProduct A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `product_category_id`, `sku`, `name`, `background_color`, `font_color`, `image`, `thumbnail`, `base_price`, `vat`, `date_added`, `status`, `type` FROM `product` WHERE `id` = :p0';
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
            $obj = new NestleBowerProduct();
            $obj->hydrate($row);
            NestleBowerProductPeer::addInstanceToPool($obj, (string) $key);
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
     * @return NestleBowerProduct|NestleBowerProduct[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NestleBowerProduct[]|mixed the list of results, formatted by the current formatter
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
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NestleBowerProductPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NestleBowerProductPeer::ID, $keys, Criteria::IN);
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
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NestleBowerProductPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NestleBowerProductPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the product_category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductCategoryId(1234); // WHERE product_category_id = 1234
     * $query->filterByProductCategoryId(array(12, 34)); // WHERE product_category_id IN (12, 34)
     * $query->filterByProductCategoryId(array('min' => 12)); // WHERE product_category_id >= 12
     * $query->filterByProductCategoryId(array('max' => 12)); // WHERE product_category_id <= 12
     * </code>
     *
     * @see       filterByNestleBowerProductCategory()
     *
     * @param     mixed $productCategoryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByProductCategoryId($productCategoryId = null, $comparison = null)
    {
        if (is_array($productCategoryId)) {
            $useMinMax = false;
            if (isset($productCategoryId['min'])) {
                $this->addUsingAlias(NestleBowerProductPeer::PRODUCT_CATEGORY_ID, $productCategoryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productCategoryId['max'])) {
                $this->addUsingAlias(NestleBowerProductPeer::PRODUCT_CATEGORY_ID, $productCategoryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::PRODUCT_CATEGORY_ID, $productCategoryId, $comparison);
    }

    /**
     * Filter the query on the sku column
     *
     * Example usage:
     * <code>
     * $query->filterBySku('fooValue');   // WHERE sku = 'fooValue'
     * $query->filterBySku('%fooValue%'); // WHERE sku LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sku The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterBySku($sku = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sku)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $sku)) {
                $sku = str_replace('*', '%', $sku);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::SKU, $sku, $comparison);
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
     * @return NestleBowerProductQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NestleBowerProductPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the background_color column
     *
     * Example usage:
     * <code>
     * $query->filterByBackgroundColor('fooValue');   // WHERE background_color = 'fooValue'
     * $query->filterByBackgroundColor('%fooValue%'); // WHERE background_color LIKE '%fooValue%'
     * </code>
     *
     * @param     string $backgroundColor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByBackgroundColor($backgroundColor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($backgroundColor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $backgroundColor)) {
                $backgroundColor = str_replace('*', '%', $backgroundColor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::BACKGROUND_COLOR, $backgroundColor, $comparison);
    }

    /**
     * Filter the query on the font_color column
     *
     * Example usage:
     * <code>
     * $query->filterByFontColor('fooValue');   // WHERE font_color = 'fooValue'
     * $query->filterByFontColor('%fooValue%'); // WHERE font_color LIKE '%fooValue%'
     * </code>
     *
     * @param     string $fontColor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByFontColor($fontColor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fontColor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $fontColor)) {
                $fontColor = str_replace('*', '%', $fontColor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::FONT_COLOR, $fontColor, $comparison);
    }

    /**
     * Filter the query on the image column
     *
     * Example usage:
     * <code>
     * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
     * $query->filterByImage('%fooValue%'); // WHERE image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $image The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByImage($image = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($image)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $image)) {
                $image = str_replace('*', '%', $image);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::IMAGE, $image, $comparison);
    }

    /**
     * Filter the query on the thumbnail column
     *
     * Example usage:
     * <code>
     * $query->filterByThumbnail('fooValue');   // WHERE thumbnail = 'fooValue'
     * $query->filterByThumbnail('%fooValue%'); // WHERE thumbnail LIKE '%fooValue%'
     * </code>
     *
     * @param     string $thumbnail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByThumbnail($thumbnail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($thumbnail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $thumbnail)) {
                $thumbnail = str_replace('*', '%', $thumbnail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::THUMBNAIL, $thumbnail, $comparison);
    }

    /**
     * Filter the query on the base_price column
     *
     * Example usage:
     * <code>
     * $query->filterByBasePrice(1234); // WHERE base_price = 1234
     * $query->filterByBasePrice(array(12, 34)); // WHERE base_price IN (12, 34)
     * $query->filterByBasePrice(array('min' => 12)); // WHERE base_price >= 12
     * $query->filterByBasePrice(array('max' => 12)); // WHERE base_price <= 12
     * </code>
     *
     * @param     mixed $basePrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByBasePrice($basePrice = null, $comparison = null)
    {
        if (is_array($basePrice)) {
            $useMinMax = false;
            if (isset($basePrice['min'])) {
                $this->addUsingAlias(NestleBowerProductPeer::BASE_PRICE, $basePrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($basePrice['max'])) {
                $this->addUsingAlias(NestleBowerProductPeer::BASE_PRICE, $basePrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::BASE_PRICE, $basePrice, $comparison);
    }

    /**
     * Filter the query on the vat column
     *
     * Example usage:
     * <code>
     * $query->filterByVat(1234); // WHERE vat = 1234
     * $query->filterByVat(array(12, 34)); // WHERE vat IN (12, 34)
     * $query->filterByVat(array('min' => 12)); // WHERE vat >= 12
     * $query->filterByVat(array('max' => 12)); // WHERE vat <= 12
     * </code>
     *
     * @param     mixed $vat The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByVat($vat = null, $comparison = null)
    {
        if (is_array($vat)) {
            $useMinMax = false;
            if (isset($vat['min'])) {
                $this->addUsingAlias(NestleBowerProductPeer::VAT, $vat['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($vat['max'])) {
                $this->addUsingAlias(NestleBowerProductPeer::VAT, $vat['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::VAT, $vat, $comparison);
    }

    /**
     * Filter the query on the date_added column
     *
     * Example usage:
     * <code>
     * $query->filterByDateAdded('fooValue');   // WHERE date_added = 'fooValue'
     * $query->filterByDateAdded('%fooValue%'); // WHERE date_added LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dateAdded The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByDateAdded($dateAdded = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dateAdded)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dateAdded)) {
                $dateAdded = str_replace('*', '%', $dateAdded);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::DATE_ADDED, $dateAdded, $comparison);
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
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(NestleBowerProductPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(NestleBowerProductPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType(1234); // WHERE type = 1234
     * $query->filterByType(array(12, 34)); // WHERE type IN (12, 34)
     * $query->filterByType(array('min' => 12)); // WHERE type >= 12
     * $query->filterByType(array('max' => 12)); // WHERE type <= 12
     * </code>
     *
     * @param     mixed $type The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_array($type)) {
            $useMinMax = false;
            if (isset($type['min'])) {
                $this->addUsingAlias(NestleBowerProductPeer::TYPE, $type['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($type['max'])) {
                $this->addUsingAlias(NestleBowerProductPeer::TYPE, $type['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NestleBowerProductPeer::TYPE, $type, $comparison);
    }

    /**
     * Filter the query by a related NestleBowerProductCategory object
     *
     * @param   NestleBowerProductCategory|PropelObjectCollection $nestleBowerProductCategory The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerProductQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerProductCategory($nestleBowerProductCategory, $comparison = null)
    {
        if ($nestleBowerProductCategory instanceof NestleBowerProductCategory) {
            return $this
                ->addUsingAlias(NestleBowerProductPeer::PRODUCT_CATEGORY_ID, $nestleBowerProductCategory->getId(), $comparison);
        } elseif ($nestleBowerProductCategory instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NestleBowerProductPeer::PRODUCT_CATEGORY_ID, $nestleBowerProductCategory->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNestleBowerProductCategory() only accepts arguments of type NestleBowerProductCategory or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerProductCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function joinNestleBowerProductCategory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerProductCategory');

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
            $this->addJoinObject($join, 'NestleBowerProductCategory');
        }

        return $this;
    }

    /**
     * Use the NestleBowerProductCategory relation NestleBowerProductCategory object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerProductCategoryQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerProductCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerProductCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerProductCategory', '\Nestle\CoreBundle\Model\NestleBowerProductCategoryQuery');
    }

    /**
     * Filter the query by a related NestleBowerBrandProduct object
     *
     * @param   NestleBowerBrandProduct|PropelObjectCollection $nestleBowerBrandProduct  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerProductQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerBrandProduct($nestleBowerBrandProduct, $comparison = null)
    {
        if ($nestleBowerBrandProduct instanceof NestleBowerBrandProduct) {
            return $this
                ->addUsingAlias(NestleBowerProductPeer::ID, $nestleBowerBrandProduct->getProductId(), $comparison);
        } elseif ($nestleBowerBrandProduct instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerBrandProductQuery()
                ->filterByPrimaryKeys($nestleBowerBrandProduct->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerBrandProduct() only accepts arguments of type NestleBowerBrandProduct or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerBrandProduct relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function joinNestleBowerBrandProduct($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerBrandProduct');

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
            $this->addJoinObject($join, 'NestleBowerBrandProduct');
        }

        return $this;
    }

    /**
     * Use the NestleBowerBrandProduct relation NestleBowerBrandProduct object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerBrandProductQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerBrandProductQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerBrandProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerBrandProduct', '\Nestle\CoreBundle\Model\NestleBowerBrandProductQuery');
    }

    /**
     * Filter the query by a related NestleBowerInvoiceItem object
     *
     * @param   NestleBowerInvoiceItem|PropelObjectCollection $nestleBowerInvoiceItem  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerProductQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerInvoiceItem($nestleBowerInvoiceItem, $comparison = null)
    {
        if ($nestleBowerInvoiceItem instanceof NestleBowerInvoiceItem) {
            return $this
                ->addUsingAlias(NestleBowerProductPeer::ID, $nestleBowerInvoiceItem->getProductId(), $comparison);
        } elseif ($nestleBowerInvoiceItem instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerInvoiceItemQuery()
                ->filterByPrimaryKeys($nestleBowerInvoiceItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerInvoiceItem() only accepts arguments of type NestleBowerInvoiceItem or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerInvoiceItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function joinNestleBowerInvoiceItem($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerInvoiceItem');

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
            $this->addJoinObject($join, 'NestleBowerInvoiceItem');
        }

        return $this;
    }

    /**
     * Use the NestleBowerInvoiceItem relation NestleBowerInvoiceItem object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerInvoiceItemQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerInvoiceItemQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerInvoiceItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerInvoiceItem', '\Nestle\CoreBundle\Model\NestleBowerInvoiceItemQuery');
    }

    /**
     * Filter the query by a related NestleBowerRules object
     *
     * @param   NestleBowerRules|PropelObjectCollection $nestleBowerRules  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerProductQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerRulesRelatedByProductId($nestleBowerRules, $comparison = null)
    {
        if ($nestleBowerRules instanceof NestleBowerRules) {
            return $this
                ->addUsingAlias(NestleBowerProductPeer::ID, $nestleBowerRules->getProductId(), $comparison);
        } elseif ($nestleBowerRules instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerRulesRelatedByProductIdQuery()
                ->filterByPrimaryKeys($nestleBowerRules->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerRulesRelatedByProductId() only accepts arguments of type NestleBowerRules or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerRulesRelatedByProductId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function joinNestleBowerRulesRelatedByProductId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerRulesRelatedByProductId');

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
            $this->addJoinObject($join, 'NestleBowerRulesRelatedByProductId');
        }

        return $this;
    }

    /**
     * Use the NestleBowerRulesRelatedByProductId relation NestleBowerRules object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerRulesQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerRulesRelatedByProductIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerRulesRelatedByProductId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerRulesRelatedByProductId', '\Nestle\CoreBundle\Model\NestleBowerRulesQuery');
    }

    /**
     * Filter the query by a related NestleBowerRules object
     *
     * @param   NestleBowerRules|PropelObjectCollection $nestleBowerRules  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NestleBowerProductQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNestleBowerRulesRelatedByPromoProductId($nestleBowerRules, $comparison = null)
    {
        if ($nestleBowerRules instanceof NestleBowerRules) {
            return $this
                ->addUsingAlias(NestleBowerProductPeer::ID, $nestleBowerRules->getPromoProductId(), $comparison);
        } elseif ($nestleBowerRules instanceof PropelObjectCollection) {
            return $this
                ->useNestleBowerRulesRelatedByPromoProductIdQuery()
                ->filterByPrimaryKeys($nestleBowerRules->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNestleBowerRulesRelatedByPromoProductId() only accepts arguments of type NestleBowerRules or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NestleBowerRulesRelatedByPromoProductId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function joinNestleBowerRulesRelatedByPromoProductId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NestleBowerRulesRelatedByPromoProductId');

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
            $this->addJoinObject($join, 'NestleBowerRulesRelatedByPromoProductId');
        }

        return $this;
    }

    /**
     * Use the NestleBowerRulesRelatedByPromoProductId relation NestleBowerRules object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Nestle\CoreBundle\Model\NestleBowerRulesQuery A secondary query class using the current class as primary query
     */
    public function useNestleBowerRulesRelatedByPromoProductIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNestleBowerRulesRelatedByPromoProductId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NestleBowerRulesRelatedByPromoProductId', '\Nestle\CoreBundle\Model\NestleBowerRulesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NestleBowerProduct $nestleBowerProduct Object to remove from the list of results
     *
     * @return NestleBowerProductQuery The current query, for fluid interface
     */
    public function prune($nestleBowerProduct = null)
    {
        if ($nestleBowerProduct) {
            $this->addUsingAlias(NestleBowerProductPeer::ID, $nestleBowerProduct->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
