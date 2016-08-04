<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerSalesReportInvoicePeer;

use \Criteria;

class NestleBowerSalesReportInvoicePeer extends BaseNestleBowerSalesReportInvoicePeer
{
	public static function getAllSalesReportInvoice(Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}

	public static function getSalesReportInvoiceByReportId($id, Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::SALES_REPORT_ID, $id, Criteria::EQUAL);

		$_self = self::doSelect($c);

		return $_self ? $_self : array();
	}

	public static function getAllSalesReportInvoiceBySubmissions($sks = array(), Criteria $c = null)
	{
		if (is_null($c)) {
			$c = new Criteria();
		}

		$c->add(self::SALES_REPORT_ID, $sks, Criteria::IN);

		$_self = self::doSelect($c);

		return $_self ? $_self : array();

	}


}
