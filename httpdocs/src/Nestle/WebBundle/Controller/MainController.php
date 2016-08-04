<?php

namespace Nestle\WebBundle\Controller;

use Nestle\CoreBundle\Model\NestleBowerAccountPeer;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcpPeer;
use Nestle\CoreBundle\Model\NestleBowerInvoicesPeer;
use Nestle\CoreBundle\Model\NestleBowerProductPeer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

//Models
use Nestle\CoreBundle\Model\NestleBowerUsers;

//Peers
use Nestle\CoreBundle\Model\NestleBowerPeer;
use Nestle\CoreBundle\Model\NestleBowerSalesReportPeer;
use Nestle\CoreBundle\Model\NestleBowerSalesReportInvoicePeer;
use Nestle\CoreBundle\Model\NestleBowerInvoiceItemPeer;

class MainController extends Controller
{
	public function indexAction()
	{

        $user = $this->getUser();
		$request = $this->getRequest();
		$bow = $request->query->get('bower');
		$start = $request->query->get('startDate');
		$end = $request->query->get('endDate');

		$bowers = NestleBowerPeer::getAllActive();
		$txns = count(NestleBowerSalesReportPeer::getAllTransactions());

        $submissions = NestleBowerSalesReportPeer::getAllTransactions();
        $invoices = NestleBowerSalesReportInvoicePeer::getAllSalesReportInvoice();

        $counts = array();
        foreach ($submissions as $s) {
            $ct = count(NestleBowerSalesReportInvoicePeer::getSalesReportInvoiceByReportId($s->getId()));
            $counts[$s->getId()] = $ct;  
        }

		return $this->render('NestleWebBundle:Transactions:leads.html.twig', array(
            'user' => $user,
			'bowers' => $bowers,
			'txns' => $txns,
			'bow' => $bow,
			'start' => $start,
			'end' => $end,
            'counts' => $counts,
		));
	}

	public function leadsDataTableAjaxAction()
	{
		$request = $this->getRequest();

        $startDate = $request->query->get('startDate');
        $endDate = $request->query->get('endDate');

        if($startDate){
            $start = date("Y-m-d",strtotime($startDate));
        }else{
            $start = "";
        }

        if($endDate){
            $end = date("Y-m-d",strtotime($endDate));
        }else{
            $end = "";
        }



        $bow = $request->query->get('bow');

        $draw = $request->query->get('draw');
        $pageStart = $request->query->get('start');
        $length = $request->query->get('length');
        $columns = $request->query->get('columns');
        $order = $request->query->get('order');
        $search = $request->query->get('search');
        $count = 0;

        $sort = $order[0]['column'];
        $dir = $order[0]['dir'];
        $searching = $search['value'];

        $data = array();

        $allTxns = NestleBowerSalesReportPeer::getAllTransactions();
        $count = count($allTxns);

        if ($count < $length) {
            $length = $count;
        }
        if ($pageStart >= $count) {
            $pageStart = 0;
        }

        $filtered = NestleBowerSalesReportPeer::getFiltered($pageStart, $length, $start, $end, $bow);
        $arr = array();

        foreach ($filtered as $fil) {
        	$invoices = NestleBowerSalesReportInvoicePeer::getSalesReportInvoiceByReportId($fil->getId());
        	$date = new \DateTime($fil->getDate());

        	$tmp = array(
        		"DT_RowId" => "infoOpen",
                "DT_RowClass" => '',
                "DT_RowData" => $fil->getDate(),
                "DT_RowAttr" => array(
                    "style" => 'cursor: pointer',
                    "data-id" => $fil->getId()
                ),
                0 => $date->format('Y-m-d g:i a'),
                1 => $fil->getNestleBower()->getBowerId(),
                2 => $fil->getNestleBower()->getFname().' '.$fil->getNestleBower()->getLname(),
                3 => "PHP ".number_format($fil->getTotalSales(), 2, '.', ','),
                4 => $fil->getTotalSkus(),
                5 => count($invoices)
        	);

        	array_push($arr, $tmp);
        }

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $arr
        );

        echo json_encode($data);
        exit;
	}

	public function leadsDataAjaxAction()
	{
        $request = $this->getRequest();
        $startDate = $request->query->get('startDate');
        $endDate = $request->query->get('endDate');
        $bow = $request->query->get('bow');
        
        $data = array();

        return $this->render('NestleWebBundle:Transactions:leadTable.html.twig', array(
            'data' => $data,
            'bow' => $bow,
            'startDate' => $startDate,
            'endDate' => $endDate
        ));
	}

	public function leadInfoAction($id)
	{
		$request = $this->getRequest();
        $user = $this->getUser();


		$txn = NestleBowerSalesReportPeer::retrieveByPK($id);
		$invoices = NestleBowerSalesReportInvoicePeer::getSalesReportInvoiceByReportId($txn->getId());
		$items = array();

		foreach ($invoices as $inv) {
			$items[$inv->getId()] = NestleBowerInvoiceItemPeer::getInvoiceItemsById($inv->getInvoiceId());
		}
		
		return $this->render('NestleWebBundle:Transactions:leadInfo.html.twig', array(
            'user' => $user,
			'txn' => $txn,
			'invoices' => $invoices,
			'items' => $items
		));
	}

    public function getExportDataAction()
    {
        $request = $this->getRequest();

        if ($request->getMethod() == "POST") {
            $startDate = $request->request->get('startDate');
            $endDate = $request->request->get('endDate');


            if($startDate){
                $start = date("Y-m-d",strtotime($startDate));
            }else{
                $start = "";
            }

            if($endDate){
                $end = date("Y-m-d",strtotime($endDate));
            }else{
                $end = "";
            }


            $submissions = NestleBowerSalesReportPeer::getExportTransactions($start, $end);
            $submissions_keys = array();
            $counts = array();
            foreach ($submissions as $s) {
                $ct = count(NestleBowerSalesReportInvoicePeer::getSalesReportInvoiceByReportId($s->getId()));
                $counts[$s->getId()] = $ct;
                array_push($submissions_keys, $s->getId());
            }

            $invoices = NestleBowerSalesReportInvoicePeer::getAllSalesReportInvoiceBySubmissions($submissions_keys);

            $invoiceitems = array();

            foreach ($invoices as $inv) {
                $items = NestleBowerInvoiceItemPeer::getInvoiceItemsById($inv->getInvoiceId());
                foreach ($items as $item){
                    $invoice = NestleBowerInvoicesPeer::retrieveByPK($item->getInvoiceID());
                    $product = NestleBowerProductPeer::retrieveByPK($item->getProductId());
                    $bows = NestleBowerPeer::retrieveByPK($invoice->getBowerId());
                    $account = NestleBowerAccountsMcpPeer::retrieveByPK($invoice->getAccountId());
                    $name = $product->getName();
                    $sku = $product->getSku();
                    $price = $item->getUnitPrice();
                    $quantity = $item->getQty();
                    $total = $item->getTotalSales();
                    $date = explode(' ', $invoice->getInvoiceDate());

                    if($account->getId() == 1){
                        $account_name = $account->getName() . " (" . $invoice->getSoldTo() . ")";
                    }else{
                        $account_name = $account->getName();
                    }

                    $tmp = array(
                        'invoiceId' => $invoice->getReceiptId(),
                        'product_sku' => $sku,
                        'product_name' => $name,
                        'bow_id' => $bows->getBowerId(),
                        'bow' => $bows->getFname() . " " . $bows->getLname(),
                        'date' => $date,
                        'area' => $bows->getNestleBowerArea()->getArea(),
                        'account' => $account_name,
                        'price' => $price,
                        'quantity' => $quantity,
                        'total' => $total
                    );

                    array_push($invoiceitems, $tmp);

                }

            }

            return $this->render('NestleWebBundle:Transactions:exportTable.html.twig', array(
                'submissions' => $submissions,
                'items' => $invoiceitems,
                'counts' => $counts
            ));
        } else {
            return new Response();
        }
    }
}

?>