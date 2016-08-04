<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerAccountsMcpPeer;

use \Criteria;

class NestleBowerAccountsMcpPeer extends BaseNestleBowerAccountsMcpPeer
{
	public static function getAll(Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}

	public static function getFiltered($offset = 0, $limit = 0, $area = '', $city = '', $ids = null, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}


		$c->add(self::ID, 1, Criteria::NOT_EQUAL);
		$c->add(self::STATUS, -1, Criteria::NOT_EQUAL);

		if ($area != '') {
			$c->add(self::AREA_ID, $area, Criteria::EQUAL);
		}

		if ($city != '') {
			$c->add(self::CITY_ID, $city, Criteria::EQUAL);
		}

		if($offset > 0){
			$c->setOffset($offset);
		}

		if($limit > 0){
			$c->setLimit($limit);
		}

		$c->addDescendingOrderByColumn(self::ID);

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}

	public static function getMatchedAccount($name = '', $cPerson = '', $cNum = '', Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		if ($name != '') {
			$name = "%".$name."%";
			$c->add(self::NAME, $name, Criteria::LIKE);
		}

		if ($cPerson != '') {
			$cPerson = "%".$cPerson."%";
			$c->add(self::CONTACT_PERSON, $cPerson, Criteria::LIKE);
		}

		if ($cNum != '') {
			$cNum = "%".$cNum."%";
			$c->add(self::CONTACT_NUMBER, $cNum, Criteria::LIKE);
		}

		$c->add(self::ID, 1, Criteria::NOT_EQUAL);
		$_count = self::doCount($c);

		return $_count;
	}
}
