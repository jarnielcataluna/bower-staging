<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerSalesReportPeer;

use \Criteria;

class NestleBowerSalesReportPeer extends BaseNestleBowerSalesReportPeer
{
	public static function getAllTransactions(Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

        $c->addDescendingOrderByColumn(self::ID);



		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}

	public static function getFiltered($offset, $limit, $startDate = '', $endDate = '', $bower = '', Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

        $c->addDescendingOrderByColumn(self::ID);

        if ($bower != '') {
        	$c->add(self::BOWER_ID, $bower, Criteria::EQUAL);
        }

        if ($startDate && $endDate) {
        	$cd1 = $c->getNewCriterion(self::DATE, $startDate." 00:00:01", Criteria::GREATER_EQUAL);
        	$cd2 = $c->getNewCriterion(self::DATE, $endDate." 23:59:59", Criteria::LESS_EQUAL);
        	$cd1->addAnd($cd2);
        	$c->add($cd1);
        } elseif ($startDate && !$endDate) {
        	$c->add(self::DATE, $startDate." 00:00:01", Criteria::GREATER_EQUAL);
        } elseif (!$startDate && $endDate) {
        	$c->add(self::DATE, $endDate." 23:59:59", Criteria::LESS_EQUAL);
        }
        
        $c->setOffset($offset);
        $c->setLimit($limit);

        $_self = self::doSelect($c);
        
        return $_self ? $_self : array();
	}

	public static function getExportTransactions($startDate = '', $endDate = '', Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		if ($startDate && $endDate) {
			$cd1 = $c->getNewCriterion(self::DATE, $startDate." 00:00:01", Criteria::GREATER_EQUAL);
			$cd2 = $c->getNewCriterion(self::DATE, $endDate." 23:59:59", Criteria::LESS_EQUAL);
			$cd1->addAnd($cd2);
			$c->add($cd1);
		} elseif ($startDate && !$endDate) {
			$c->add(self::DATE, $startDate." 00:00:01", Criteria::GREATER_EQUAL);
		} elseif (!$startDate && $endDate) {
			$c->add(self::DATE, $endDate." 23:59:59", Criteria::LESS_EQUAL);
		}


		$c->addDescendingOrderByColumn(self::ID);



		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}
}
