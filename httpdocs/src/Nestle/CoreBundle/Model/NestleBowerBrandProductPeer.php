<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerBrandProductPeer;

use \Criteria;

class NestleBowerBrandProductPeer extends BaseNestleBowerBrandProductPeer
{
	public static function getBrandProductByProductId($id, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::PRODUCT_ID, $id, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
