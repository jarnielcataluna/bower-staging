<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerPromosPeer;

use \Criteria;

class NestleBowerPromosPeer extends BaseNestleBowerPromosPeer
{
	public static function getAllActive(Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}
		

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}

	public static function getCount(Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}


		$_self = self::doCount($c);

		return $_self ? $_self : 0;
	}

	public static function getFiltered($offset = 0, $limit = 0, Criteria $c = null)
	{

		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::STATUS, -1, Criteria::NOT_EQUAL);

		if($offset > 0){
			$c->setOffset($offset);
		}

		if($limit > 0){
			$c->setLimit($limit);
		}

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}

	public static function getAllActiveForUser($region, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c1 = $c->getNewCriterion('region_id', $region);
		$c2 = $c->getNewCriterion('region_id', 0);
		$c1->addOr($c2);
		$c->add($c);

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}


}
