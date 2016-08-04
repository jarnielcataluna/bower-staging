<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerRegionPeer;

use \Criteria;

class NestleBowerRegionPeer extends BaseNestleBowerRegionPeer
{
	public static function getRegionByName($name, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$name = "%".$name."%";

		$c->add(self::REGION, $name, Criteria::LIKE);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}

	public static function getAll(Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}
}
