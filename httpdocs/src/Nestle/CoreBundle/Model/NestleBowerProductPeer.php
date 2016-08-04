<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerProductPeer;

use \Criteria;

class NestleBowerProductPeer extends BaseNestleBowerProductPeer
{
	public static function getAllActiveProducts(Criteria $c = null)
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

		return $_self ? $_self :0;
	}

	public static function getFiltered($offset = 0, $limit = 0, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::STATUS, -1, Criteria::NOT_EQUAL);

		if($offset > 0 ){
			$c->setOffset($offset);

		}

		if($limit > 0){
			$c->setLimit($limit);
		}

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}

	public static function getByType($int, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::TYPE, $int, Criteria::EQUAL);

		$_self = self::doSelect($c);
		return $_self ? $_self : array();
	}

	public static function checkSku($sku, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::SKU, $sku, Criteria::EQUAL);

		$count = self::doCount($c);
		if($count == 0){
			return true;
		}else{
			return false;
		}
	}


}
