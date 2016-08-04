<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerCategoryPeer;

use \Criteria;

class NestleBowerCategoryPeer extends BaseNestleBowerCategoryPeer
{
	public static function getCategoryByName($name, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$name = "%".$name."%";

		$c->add(self::CATEGORY, $name, Criteria::LIKE);

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
