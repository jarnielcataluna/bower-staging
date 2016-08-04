<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerAccountPeer;

use \Criteria;

class NestleBowerAccountPeer extends BaseNestleBowerAccountPeer
{
	public static function getAccountsByBowerId($bowerId, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::BOWER_ID, $bowerId, Criteria::EQUAL);

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}

	public static function getAccountByAccountId($acc, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::ACCOUNT_ID, $acc, Criteria::EQUAL);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}

	public static function getBowerAccountByAccountIdAndBowerId($accId, $bowId, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::STATUS, 1, Criteria::EQUAL);

		$c1 = $c->getNewCriterion(self::ACCOUNT_ID, $accId, Criteria::EQUAL);
		$c2 = $c->getNewCriterion(self::BOWER_ID, $bowId, Criteria::EQUAL);

		$c1->addAnd($c2);
		$c->add($c1);

		$_self = self::doSelectOne($c);

		return $_self ? $_self : null;
	}
}
