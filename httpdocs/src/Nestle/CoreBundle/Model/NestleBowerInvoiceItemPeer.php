<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerInvoiceItemPeer;

use \Criteria;

class NestleBowerInvoiceItemPeer extends BaseNestleBowerInvoiceItemPeer
{
	public static function getInvoiceItemsById($id, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::INVOICE_ID, $id, Criteria::EQUAL);

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}
}
