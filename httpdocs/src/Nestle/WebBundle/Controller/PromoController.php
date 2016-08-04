<?php

namespace Nestle\WebBundle\Controller;

use Nestle\CoreBundle\Model\NestleBowerProductPeer;
use Nestle\CoreBundle\Model\NestleBowerPromos;
use Nestle\CoreBundle\Model\NestleBowerPromosPeer;
use Nestle\CoreBundle\Model\NestleBowerRegionPeer;
use Nestle\CoreBundle\Model\NestleBowerRules;
use Nestle\CoreBundle\Model\NestleBowerRulesPeer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PromoController extends Controller
{
    public function promosAction()
    {

        if ($this->get('security.context')->isGranted('ROLE_ANALYST')) {

        } else if (!$this->getUser() instanceof NestleBowerUsers) {
            return $this->redirect($this->generateUrl('logout'));
        }

        $user = $this->getUser();

        $filtered = NestleBowerPromosPeer::getFiltered();
        $arr = array();

        foreach ($filtered as $fil) {
            $name = $fil->getName();

            $rules = $fil->getNestleBowerRules();
            $product_id = $rules->getProductId();
            $promo_id = $rules->getPromoProductId();
            if ($fil->getStatus() == 1) {
                $status = 'Active';
            } else {
                $status = 'Inactive';
            }


            if($fil->getRegionId() == 0){
                $region = 'All';
            }else{
                $region = $fil->getNestleBowerRegion()->getRegion();
            }

            $product = NestleBowerProductPeer::retrieveByPK($product_id);
            $promo_item = NestleBowerProductPeer::retrieveByPK($promo_id);

            $tmp = array(
                'id' => $fil->getId(),
                'name' => $name,
                'productName' => $product->getName(),
                'promoName' => $promo_item->getName(),
                'start' => $rules->getStartDate(),
                'end' => $rules->getEndDate(),
                'status' => $status,
                'region' => $region,
            );

            array_push($arr, $tmp);
        }


        return $this->render('NestleWebBundle:Promo:promos.html.twig', array(
            'user' => $user,
            'data' => $arr
        ));
    }

    public function promoTableAction()
    {
        return $this->render('NestleWebBundle:Promo:promoTable.html.twig');
    }

    public function promoTableDataAction()
    {
        $request = $this->getRequest();

        $draw = $request->query->get('draw');
        $pageStart = $request->query->get('start');
        $length = $request->query->get('length');
        $columns = $request->query->get('columns');
        $order = $request->query->get('order');
        $search = $request->query->get('search');

        $sort = $order[0]['column'];
        $dir = $order[0]['dir'];
        $searching = $search['value'];

        $count = NestleBowerPromosPeer::getCount();
        if ($count < $length) {
            $length = $count;
        }
        if ($pageStart >= $count) {
            $pageStart = 0;
        }

        $filtered = NestleBowerPromosPeer::getFiltered($pageStart, $length);
        $arr = array();

        foreach ($filtered as $fil) {
            $name = $fil->getName();

            $rules = $fil->getNestleBowerRules();
            $product_id = $rules->getProductId();
            $promo_id = $rules->getPromoProductId();
            if ($fil->getStatus() == 1) {
                $status = 'Active';
            } else {
                $status = 'Inactive';
            }

            $product = NestleBowerProductPeer::retrieveByPK($product_id);
            $promo_item = NestleBowerProductPeer::retrieveByPK($promo_id);

            $tmp = array(
                "DT_RowId" => "infoOpen",
                "DT_RowClass" => '',
                "DT_RowData" => $fil->getId(),
                "DT_RowAttr" => array(
                    "style" => 'cursor: pointer',
                    "data-id" => $fil->getId()
                ),
                0 => $name,
                1 => $product->getName(),
                2 => $promo_item->getName(),
                3 => $rules->getStartDate(),
                4 => $rules->getEndDate(),
                5 => $status,

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

    public function promoAddAction()
    {
        $request = $this->getRequest();

        $user = $this->getUser();

        $allproduct = NestleBowerProductPeer::getByType(1);
        $allpromo = NestleBowerProductPeer::getByType(2);
        $allregion = NestleBowerRegionPeer::getAll();

        if ($request->getMethod() == 'POST') {
            $new_promo = new NestleBowerPromos();
            $rule = new NestleBowerRules();
            $name = $request->request->get('name');
            $desc = $request->request->get('desc');
            $status = $request->request->get('status');
            $start_date = $request->request->get('start');
            $end_date = $request->request->get('end');
            $productid = $request->request->get('product_id');
            $promoid = $request->request->get('product_promo_id');
            $qualify = $request->request->get('qualifier');
            $free = $request->request->get('free');
            $region = $request->request->get('region');

            $rule->setProductId($productid);
            $rule->setQtyToQualify($qualify);
            $rule->setQtyFree($free);
            $rule->setPromoProductId($promoid);
            $rule->setStartDate($start_date);
            $rule->setEndDate($end_date);
            $rule->setStatus($status);

            if ($rule->save()) {
                $new_promo->setRuleId($rule->getId());
                $new_promo->setName($name);
                $new_promo->setDescription($desc);
                $new_promo->setStatus($status);
                $new_promo->setRegionId($region);
                $new_promo->save();
                $this->get('session')->getFlashBag()->add('notice', 'Successfully added promo!');
                return $this->redirect($this->generateUrl('nestle_web_promo'));

            }
        }



        return $this->render('NestleWebBundle:Promo:promoAdd.html.twig', array(
            'user' => $user,
            'product' => $allproduct,
            'promoproduct' => $allpromo,
            'regions' => $allregion
        ));
    }

    public function promoViewAction($id)
    {
        $user = $this->getUser();
        $promo = NestleBowerPromosPeer::retrieveByPK($id);
        $rule = NestleBowerRulesPeer::retrieveByPK($promo->getRuleId());
        $product = NestleBowerProductPeer::retrieveByPK($rule->getProductId());
        $promoproduct = NestleBowerProductPeer::retrieveByPK($rule->getPromoProductId());

        return $this->render('NestleWebBundle:Promo:promoView.html.twig', array(
            'user' => $user,
            'product' => $product,
            'promoproduct' => $promoproduct,
            'promo' => $promo,
            'rule' => $rule
        ));
    }

    public function promoEditAction($id)
    {
        $user = $this->getUser();
        $promo = NestleBowerPromosPeer::retrieveByPK($id);
        $rule = NestleBowerRulesPeer::retrieveByPK($promo->getRuleId());


        $allproduct = NestleBowerProductPeer::getByType(1);
        $allpromo = NestleBowerProductPeer::getByType(2);
        $allregion = NestleBowerRegionPeer::getAll();
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $name = $request->request->get('name');
            $desc = $request->request->get('desc');
            $status = $request->request->get('status');
            $start_date = $request->request->get('start');
            $end_date = $request->request->get('end');
            $productid = $request->request->get('product_id');
            $promoid = $request->request->get('product_promo_id');
            $qualify = $request->request->get('qualifier');
            $free = $request->request->get('free');
            $region = $request->request->get('region');

            $rule = NestleBowerRulesPeer::retrieveByPK($promo->getRuleId());
            $rule->setNestleBowerProductRelatedByProductId(NestleBowerProductPeer::retrieveByPK($productid));
            $rule->setNestleBowerProductRelatedByPromoProductId(NestleBowerProductPeer::retrieveByPK($promoid));
            $rule->setQtyToQualify($qualify);
            $rule->setQtyFree($free);
            $rule->setStartDate($start_date);
            $rule->setEndDate($end_date);
            $rule->setStatus($status);

            $rule->save();


            $promo->setRuleId($rule->getId());
            $promo->setName($name);
            $promo->setDescription($desc);
            $promo->setStatus($status);
            $promo->setRegionId($region);
            if ($promo->save()) {
                $this->get('session')->getFlashBag()->add('notice', 'Promo successfully updated!');

                return $this->render('NestleWebBundle:Promo:promoEdit.html.twig', array(
                    'user' => $user,
                    'product' => $allproduct,
                    'promoproduct' => $allpromo,
                    'promo' => $promo,
                    'rule' => $rule,
                    'regions' => $allregion
                ));
            }


        }


        return $this->render('NestleWebBundle:Promo:promoEdit.html.twig', array(
            'user' => $user,
            'product' => $allproduct,
            'promoproduct' => $allpromo,
            'promo' => $promo,
            'rule' => $rule,
            'regions' => $allregion
        ));

    }

    public function promoDeleteAction($id)
    {
        $promo = NestleBowerPromosPeer::retrieveByPK($id);
        if (!empty($promo)) {
            $rule = NestleBowerRulesPeer::retrieveByPK($promo->getRuleId());
            $rule->setStatus(-1);
            if ($rule->save()) {
                $promo->setStatus(-1);
                $promo->save();
                $this->get('session')->getFlashBag()->add('notice', 'Promo successfully deleted!');
                return $this->redirect($this->generateUrl('nestle_web_promo'));
            }
        } else {
            $this->get('session')->getFlashBag()->add('notice', 'error!');
            return $this->redirect($this->generateUrl('nestle_web_promo'));
        }
    }


}
