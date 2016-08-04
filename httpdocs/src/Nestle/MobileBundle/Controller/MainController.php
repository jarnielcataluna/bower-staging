<?php

namespace Nestle\MobileBundle\Controller;

use Nestle\CoreBundle\Model\NestleBowerAccount;
use Nestle\CoreBundle\Model\NestleNestleCyclePlans;
use Nestle\CoreBundle\Model\NestleNestleCyclePlansPeer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

//Models
use Nestle\CoreBundle\Model\NestleBowerInvoices;
use Nestle\CoreBundle\Model\NestleBowerInvoiceItem;
use Nestle\CoreBundle\Model\NestleBowerSalesReport;
use Nestle\CoreBundle\Model\NestleBowerSalesReportInvoice;

//Peers
use Nestle\CoreBundle\Model\NestleBowerPeer;
use Nestle\CoreBundle\Model\NestleBowerAccountPeer;
use Nestle\CoreBundle\Model\NestleBowerDayPeer;
use Nestle\CoreBundle\Model\NestleBowerBrandProductPeer;
use Nestle\CoreBundle\Model\NestleBowerProductPeer;
use Nestle\CoreBundle\Model\NestleBowerPromosPeer;
use Nestle\CoreBundle\Model\NestleBowerRulesPeer;

class MainController extends Controller
{
	private $webkey = "7cdc41555302168a2df0b8126c05ec9184a02e9036caf05e0d0ddcf4afec6368";

	public function bowerLoginAction()
	{
		$request = $this->getRequest();
		$key = $request->request->get('web_service_key');

		if ($key == $this->webkey) {
			$username = $request->request->get('username');
			$password = $request->request->get('password');

			$user = NestleBowerPeer::getUserByCredentials($username, $password);

			if ($user) {
				$bower = array(
					'id' => $user->getId(),
					'fname' => $user->getFname(),
					'lname' => $user->getLname(),
					'contact_number' => $user->getContactNumber(),
					'bdate' => $user->getBdate(),
					'area' => $user->getNestleBowerArea()->getArea(),
					'username' => $user->getUsername(),
					'password' => $user->getPassword(),
					'status' => $user->getStatus()
				);

				echo json_encode($bower);
				exit;
			} else {
				$return = array();

				echo json_encode($return);
				exit;
			}

		} else {
			throw new AccessDeniedHttpException();
		}
	}

	public function forgotPasswordAction()
	{
		$request = $this->getRequest();
		$key = $request->request->get('web_service_key');
		$username = $request->request->get('username');
		$bdate = $request->request->get('birthday');

		if ($key == $this->webkey && isset($username) && isset($bdate)) {
			$user = NestleBowerPeer::getUserByForgotCreds($username, $bdate);

			if ($user) {
				$bower = array(
					'id' => $user->getId(),
					'fname' => $user->getFname(),
					'lname' => $user->getLname(),
					'contact_number' => $user->getContactNumber(),
					'bdate' => $user->getBdate(),
					'area' => $user->getNestleBowerArea()->getArea(),
					'username' => $user->getUsername(),
					'password' => $user->getPassword(),
					'status' => $user->getStatus()
				);

				echo json_encode($bower);
				exit;
			} else {
				$return = array();

				echo json_encode($return);
				exit;
			}
			
		} else {
			throw new AccessDeniedHttpException();
		}
	}

	public function blockAccountLogin()
	{
		$request = $this->getRequest();
		$key = $request->request->get('web_service_key');
		$username = $request->request->get('username');

		if ($key == $this->webkey && isset($bowerId)) {
			$user = NestleBowerPeer::getUserByUsername($username);

			$user->setStatus(-1);
			$user->save();

			if ($user) {
				$bower = array(
					'id' => $user->getId(),
					'fname' => $user->getFname(),
					'lname' => $user->getLname(),
					'contact_number' => $user->getContactNumber(),
					'bdate' => $user->getBdate(),
					'area' => $user->getNestleBowerArea()->getArea(),
					'username' => $user->getUsername(),
					'password' => $user->getPassword(),
					'status' => $user->getStatus()
				);

				echo json_encode($bower);
				exit;
			} else {
				$return = array();

				echo json_encode($return);
				exit;
			}

		} else {
			throw new AccessDeniedHttpException();
		}
	}

	public function retrieveMcpAction()
	{
		$request = $this->getRequest();
		$key = $request->request->get('web_service_key');
		$bowerId = $request->request->get('id');

		if ($key == $this->webkey && isset($bowerId)) {
			$tmp = NestleBowerAccountPeer::getAccountsByBowerId($bowerId);
			$accounts['accounts'] = array();




			if (!empty($tmp)) {
				foreach ($tmp as $t) {

					$days = $t->getNestleBowerAccountsMcp()->getBracketNumber();
					$d = explode("-", $days);
					$days = array(
						'monday' => $d[0],
						'tuesday' => $d[1],
						'wednesday' => $d[2],
						'thursday' => $d[3],
						'friday' => $d[4],
						'saturday' => $d[5],
					);

					$push = array();
					$push['id'] = $t->getNestleBowerAccountsMcp()->getId();
					$push['account_name'] = $t->getNestleBowerAccountsMcp()->getName();
					$push['contact_person'] = $t->getNestleBowerAccountsMcp()->getContactPerson();
					$push['account_type'] = $t->getNestleBowerAccountsMcp()->getNestleBowerCategory()->getCategory();
					$push['contact_number'] = $t->getNestleBowerAccountsMcp()->getContactNumber();
					$push['latitude'] = $t->getNestleBowerAccountsMcp()->getLatitude();
					$push['longitude'] = $t->getNestleBowerAccountsMcp()->getLongitude();
					$push['address'] = $t->getNestleBowerAccountsMcp()->getAddress();
					$push['city'] = $t->getNestleBowerAccountsMcp()->getNestleBowerCity()->getCity();
					$push['area'] = $t->getNestleBowerAccountsMcp()->getNestleBowerArea()->getArea();
					$push['time_start'] = $t->getNestleBowerAccountsMcp()->getBestFrom();
					$push['time_end'] = $t->getNestleBowerAccountsMcp()->getBestTo();
					$push['day'] = $days;
					$push['frequency'] = $t->getNestleBowerAccountsMcp()->getFrequency();
					$push['ave_purchase_per_visit'] = "";
					$push['channel'] = "";
					$push['status'] = $t->getNestleBOwerAccountsMcp()->getStatus();

					array_push($accounts['accounts'], $push);
				}
			}

			echo json_encode($accounts);
			exit;
		} else {
			throw new AccessDeniedHttpException();
		}
	}

	public function retrieveCyclePlanAction()
	{
		$request = $this->getRequest();
		$key = $request->request->get('web_service_key');
		$bowerId = $request->request->get('id');

		if ($key == $this->webkey && isset($bowerId)) {
			$cycPlan = NestleNestleCyclePlansPeer::getAllActive();
			$cyclePlan['cycle_plan'] = array();



			foreach ($cycPlan as $cp) {

				$temp = array(
					'id' => $cp->getId(),
					'title' => $cp->getTitle(),
					'date' => $cp->getDate(),
					'link' => $cp->getLink(),
					'status' =>$cp->getStatus()

				);

				array_push($cyclePlan['cycle_plan'], $temp);
			}

			echo json_encode($cyclePlan);
			exit;

		} else {
			throw new AccessDeniedHttpException();
		}
	}


	public function retrieveProductsAction()
	{
		$request = $this->getRequest();
		$key = $request->request->get('web_service_key');
		$bowerId = $request->request->get('id');

		if ($key == $this->webkey && isset($bowerId)) {
			$prods = NestleBowerProductPeer::getAllActiveProducts();
			$products['product_list'] = array();

			foreach ($prods as $p) {
				$brProd = NestleBowerBrandProductPeer::getBrandProductByProductId($p->getId());

				$temp = array(
					'id' => $p->getId(),
					'product_sku' => $p->getSku(),
					'product_name' => $p->getName(),
					'base_price' => $p->getBasePrice(),
					'category' => $p->getNestleBowerProductCategory()->getProductCategory(),
					'brand' => $brProd->getNestleBowerBrand()->getBrand(),
					'background_color' => $p->getBackgroundColor(),
					'font_color' => $p->getFontColor(),
					'image' => $p->getImage(),
					'thumbnail' => $p->getImage(),
					'status' => $p->getStatus(),
					'type' => $p->getType()
				);

				array_push($products['product_list'], $temp);
			}

			echo json_encode($products);
			exit;

		} else {
			throw new AccessDeniedHttpException();
		}
	}

	public function retrievePromoAction()
	{
		$request = $this->getRequest();
		$key = $request->request->get('web_service_key');
		$bowerId = $request->request->get('id');
		$bower = NestleBowerPeer::retrieveByPK($bowerId);
		$region = $bower->getNestleBowerArea()->getNestleBowerCity()->getNestleBowerProvince()->getNestleBowerRegion()->getId();

		if ($key == $this->webkey && isset($bowerId)) {
			$promos = NestleBowerPromosPeer::getAllActiveForUser($region);
			$data['response'] = array();

			foreach ($promos as $promo) {
				$tmp = array(
					'id' => $promo->getId(),
					'name' => $promo->getName(),
					'description' => $promo->getDescription(),
					'start' => $promo->getNestleBowerRules()->getStartDate(),
					'end' => $promo->getNestleBowerRules()->getEndDate(),
					'qualifying_product_id' => $promo->getNestleBowerRules()->getProductId(),
					'qty_to_quality' => $promo->getNestleBowerRules()->getQtyToQualify(),
					'num_free_items' => $promo->getNestleBowerRules()->getQtyFree(),
					'promo_product_id' => $promo->getNestleBowerRules()->getPromoProductId(),
					'status' => $promo->getNestleBowerRules()->getStatus(),
				);

				array_push($data['response'], $tmp); 
			}

			echo json_encode($data);
			exit;

		} else {
			throw new AccessDeniedHttpException();
		}
	}

	public function receiveSalesReportAction()
	{
		$request = $this->getRequest();

		$jsonData = file_get_contents('php://input');
		$arrData = json_decode($jsonData, true);

		$key = $arrData['web_service_key'];
		$bowerId = $arrData['bower_id'];
		$data = $arrData['data'];

		if ($key == $this->webkey && isset($bowerId)) {
			$target = $request->server->get('DOCUMENT_ROOT');
			$file = $target.'/web/file.txt';

			file_put_contents($file, print_r($data, true));

			$date = new \DateTime('now');

			$sales = new NestleBowerSalesReport();
			$sales->setBowerId($bowerId);
			$sales->setDate($date->format('Y-m-d H:i:s'));
			$sales->setStatus(1);
			$sales->save();

			$transactSales = 0;
			$transactSkus = 0;

			foreach ($data as $d) {
				$invoice = new NestleBowerInvoices();
				$invoice->setReceiptId($d['id']);
				$invoice->setInvoiceDate($d['datetime']);
				$invoice->setAccountId($d['account_id']);
				$invoice->setSoldTo($d['contact_person']);
				$invoice->setBowerId($d['bower_id']);
				$invoice->setSales($d['sales']);
				$invoice->setSkus($d['sku_bought']);
				$invoice->setStatus(1);
				$invoice->save();

				$transactSales += $d['sales'];
				$transactSkus += $d['sku_bought'];

				foreach ($d['invoice_items'] as $di) {
					$in = new NestleBowerInvoiceItem();
					$in->setInvoiceId($invoice->getId());
					$in->setProductId($di['product_id']);
					$in->setUnitPrice($di['price']);
					$in->setQty($di['quantity']);
					$in->setTotalSales($di['total_price']);
					$in->save();
				}

				$si = new NestleBowerSalesReportInvoice();
				$si->setSalesReportId($sales->getId());
				$si->setInvoiceId($invoice->getId());
				$si->setStatus(1);
				$si->save();
			}

			$sales->setTotalSales($transactSales);
			$sales->setTotalSkus($transactSkus);
			$sales->save();

			echo json_encode(array('response' => 1));
			exit;
		} else {
			throw new AccessDeniedHttpException();
		}

		echo json_encode(array('response' => -1));
		exit;
	}



	public function retrieveCyclePlansAction()
	{
		$request = $this->getRequest();
		$key = $request->request->get('web_service_key');
		$bowerId = $request->request->get('id');

		if ($key == $this->webkey && isset($bowerId)) {
			$cycle = NestleNestleCyclePlansPeer::getAll();
			$cycles['cycle_plans'] = array();

			foreach ($cycle as $cp) {
				$temp = array(
					'id' => $cp->getId(),
					'title' => $cp->getTitle(),
					'date' => $cp->getDate(),
					'file' => $cp->getLink(),
					'status' => $cp->getStatus()

				);

				array_push($cycles['cycle_plans'], $temp);
			}

			echo json_encode($cycles);
			exit;

		} else {
			throw new AccessDeniedHttpException();
		}
	}



}

?>