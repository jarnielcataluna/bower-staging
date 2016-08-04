<?php

namespace Nestle\WebBundle\Controller;

use Nestle\CoreBundle\Model\NestleBowerAccountQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

//Models
use Nestle\CoreBundle\Model\NestleBowerUsers;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcp;
use Nestle\CoreBundle\Model\NestleBowerArea;
use Nestle\CoreBundle\Model\NestleBowerCity;
use Nestle\CoreBundle\Model\NestleBowerProvince;
use Nestle\CoreBundle\Model\NestleBowerRegion;
use Nestle\CoreBundle\Model\NestleBowerAccount;

//Peers
use Nestle\CoreBundle\Model\NestleBowerPeer;
use Nestle\CoreBundle\Model\NestleBowerAccountsMcpPeer;
use Nestle\CoreBundle\Model\NestleBowerAccountPeer;
use Nestle\CoreBundle\Model\NestleBowerProvincePeer;
use Nestle\CoreBundle\Model\NestleBowerRegionPeer;
use Nestle\CoreBundle\Model\NestleBowerAreaPeer;
use Nestle\CoreBundle\Model\NestleBowerCityPeer;
use Nestle\CoreBundle\Model\NestleBowerCategoryPeer;

class AccountsController extends Controller
{
    public function accountsAction()
    {
        $request = $this->getRequest();
        $user = $this->getUser();

        /* Check if the Role: if User Will Redirect to itself */
        if ($this->get('security.context')->isGranted('ROLE_ANALYST')) {

        } else if (!$this->getUser() instanceof NestleBowerUsers) {
            return $this->redirect($this->generateUrl('logout'));
        }
        /* End */

        $bow = $request->query->get('bower');
        $bowers = NestleBowerPeer::getAllActive();

        $filtered = NestleBowerAccountsMcpPeer::getFiltered();
        $arr = array();
        foreach ($filtered as $fil) {
            $name = $fil->getName();
            $area =  NestleBowerAreaPeer::retrieveByPK($fil->getAreaId())->getArea();
            $city = $fil->getNestleBowerCity()->getCity();
            $province = $fil->getNestleBowerCity()->getNestleBowerProvince()->getProvince();
            $regionObj = NestleBowerRegionPeer::retrieveByPK($fil->getNestleBowerCity()->getNestleBowerProvince()->getRegionId());
            $region = $regionObj->getRegion();
            $d = explode("-", $fil->getBracketNumber());
            $day = '';
            if($d[0] == 1){
                $day .= 'M ';
            }

            if($d[1] == 1){
                $day .= 'T ';
            }

            if($d[2] == 1){
                $day .= 'W ';
            }

            if($d[3] == 1){
                $day .= 'TH ';
            }

            if($d[4] == 1){
                $day .= 'F ';
            }

            if($d[5] == 1){
                $day .= 'S ';
            }



            $bowerAcct = NestleBowerAccountPeer::getAccountByAccountId($fil->getId());
            $bower = $bowerAcct->getNestleBower()->getFname().' '.$bowerAcct->getNestleBower()->getLname();
            if ($fil->getStatus() == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }

            $tmp = array(
                'user' => $user,
                'id' => $fil->getId(),
                'name' => $name,
                'area' => $area,
                'city' => $city,
                'province' => $province,
                'region' => $region,
                'day' => $day,
                'bower' => $bower,
                'status' => $status
            );

            array_push($arr, $tmp);
        }

        return $this->render('NestleWebBundle:Accounts:accounts.html.twig', array(
            'user' => $user,
            'bowers' => $bowers,
            'bow' => $bow,
            'accounts' => $arr
        ));
    }

    public function accountsTableAction()
    {
        $request = $this->getRequest();

        $bow = $request->query->get('bow');

        $data = array();

        return $this->render('NestleWebBundle:Accounts:accountsTable.html.twig', array(
            'data' => $data,
            'bow' => $bow
        ));
    }

    public function accountsTableDataAction()
    {
        $request = $this->getRequest();
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
        $accts = NestleBowerAccountsMcpPeer::getAll();
        $count = count($accts) - 1;
        if ($count < $length) {
            $length = $count;
        }
        if ($pageStart >= $count) {
            $pageStart = 0;
        }
        $filtered = NestleBowerAccountsMcpPeer::getFiltered($pageStart, $length);
        $arr = array();
        foreach ($filtered as $fil) {
            $name = $fil->getName();
            $area =  NestleBowerAreaPeer::retrieveByPK($fil->getAreaId())->getArea();
            $city = $fil->getNestleBowerCity()->getCity();
            $province = $fil->getNestleBowerCity()->getNestleBowerProvince()->getProvince();
            $regionObj = NestleBowerRegionPeer::retrieveByPK($fil->getNestleBowerCity()->getNestleBowerProvince()->getId());
            $region = $regionObj->getRegion();
            if ($fil->getBracketNumber() == 1) {
                $day = 'M-W-F';
            } else {
                $day = 'T-Th-S';
            }

            $bowerAcct = NestleBowerAccountPeer::getAccountByAccountId($fil->getId());
            $bower = $bowerAcct->getNestleBower()->getFname().' '.$bowerAcct->getNestleBower()->getLname();
            if ($fil->getStatus() == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }
            $tmp = array(
                "DT_RowId" => "infoOpen",
                "DT_RowClass" => '',
                "DT_RowData" => $fil->getId(),
                "DT_RowAttr" => array(
                    "style" => 'cursor: pointer',
                    "data-id" => $fil->getId()
                ),
                0 => $name,
                1 => $area,
                2 => $city,
                3 => $province,
                4 => $region,
                5 => $day,
                6 => $bower,
                7 => $status
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

    public function processCsvAction()
    {
        $request = $this->getRequest();

        $directory = $request->server->get('DOCUMENT_ROOT') . 'uploads/csv/';
        $files = $request->files->get('accountsImport');
        $file = $files->getPathName();

        $date = new \DateTime('now');
        $fileName = $date->format('Y_m_d_H_i_s') . '_accounts_list.csv';
        $target = $directory . $fileName;

        //if (move_uploaded_file($file, $target)) {
            $handle = fopen($file, "r");
            $ctr = 0;
            $flag = 1;
            $error = 0;
            $errormsg = '';

            while (!feof($handle)) {
                $list = fgetcsv($handle);

                if ($ctr > 0) {
                    $name = addslashes($list[0]);
                    $cPerson = addslashes($list[1]);
                    $cNumber = addslashes($list[2]);
                    $address = addslashes($list[3]);
                    $latitude = addslashes($list[4]);
                    $longitude = addslashes($list[5]);
                    $bestFrom = addslashes($list[6]);
                    $bestTo = addslashes($list[7]);
                    $area = addslashes($list[8]);
                    $city = addslashes($list[9]);
                    $province = addslashes($list[10]);
                    $region = addslashes($list[11]);
                    $day = addslashes($list[12]);
                    $frequency = addslashes($list[13]);
                    $category = addslashes($list[14]);
                    $bower = addslashes($list[17]);
                    $channel = addslashes($list[18]);
                    $status = 1;

                    if(empty($list[0])){
                        continue;
                    }

                    $acc = NestleBowerAccountsMcpPeer::getMatchedAccount($name, $cPerson, $cNumber);

                    if ($acc > 0) {
                        $errormsg .= "MCP Already Exist . Check Line " . $ctr . " Column 1 ";
                        $error++;
                    }else{
                        if(NestleBowerPeer::validateBowerString($bower)){
                            $errormsg .= "Bower Id Not Found. See Line " . $ctr . " Column 18 ";
                            $error++;
                        }else{
                            if(NestleBowerRegionPeer::getRegionByName($region) == null ){
                                $errormsg .= "Region Not Found. See Line " . $ctr . " Column 12 ";
                                $error++;
                            } else {

                                if(NestleBowerCityPeer::getCityByName($city) == null ){
                                    $errormsg .= "City Not Found. See Line " . $ctr . " Column 10 ";
                                    $error++;
                                }

                                if(NestleBowerProvincePeer::getProvinceByName($province) == null ){
                                    $errormsg .= "Province Not Found. See Line " . $ctr . " Column 11 ";
                                    $error++;
                                }

                                $categories = array("kapihan", "combi", "carinderia");

                                if(!in_array(strtolower($category), $categories)){
                                    $errormsg .= "Account Type Not Found. See Line " . $ctr . " Column 15 ";
                                    $error++;
                                }

                            }
                        }

                    }

                }

                $ctr++;
            }

            if($ctr == 1){
                $errormsg .= "Empty Template \n";
                $error++;
            }

            $ctr = 0;

            $handle2 = fopen($file, "r");

            if($error == 0){
                while (!feof($handle2)) {
                    $list = fgetcsv($handle2);

                    if ($ctr > 0) {

                        if(empty($list[0])){
                            continue;
                        }

                        $name = addslashes($list[0]);
                        $cPerson = addslashes($list[1]);
                        $cNumber = addslashes($list[2]);
                        $address = addslashes($list[3]);
                        $latitude = addslashes($list[4]);
                        $longitude = addslashes($list[5]);
                        $bestFrom = addslashes($list[6]);
                        $bestTo = addslashes($list[7]);
                        $area = addslashes($list[8]);
                        $city = addslashes($list[9]);
                        $province = addslashes($list[10]);
                        $region = addslashes($list[11]);
                        $day = addslashes($list[12]);
                        $frequency = addslashes($list[13]);
                        $category = addslashes($list[14]);
                        $bower = addslashes($list[17]);
                        $channel = addslashes($list[18]);
                        $status = 1;


                        $b = NestleBowerPeer::getBowerString($bower);
                        $acc = NestleBowerAccountsMcpPeer::getMatchedAccount($name, $cPerson, $cNumber);
                        $areaObj = NestleBowerAreaPeer::getAreaByName($area);
                        $cityObj = NestleBowerCityPeer::getCityByName($city);
                        $provObj = NestleBowerProvincePeer::getProvinceByName($province);
                        $regionObj = NestleBowerRegionPeer::getRegionByName($region);
                        $catObj = NestleBowerCategoryPeer::getCategoryByName($category);


                        if ($acc > 0) {
                            //do nothing
                        } elseif ($acc < 0) {
                            return new JsonResponse('System Error.');
                        } else {

                            if (!$bower) {
                                $flag = 0;
                                continue;
                            }

                            if (!$regionObj) {
                                $regObj = new NestleBowerRegion();
                                $regObj->setRegion($region);
                                $regObj->setStatus(1);
                                $regObj->save();
                            } else {
                                $regObj = $regionObj;
                            }

                            if (!$provObj) {
                                $pObj = new NestleBowerProvince();
                                $pObj->setProvince($province);
                                $pObj->setRegionId($regObj->getId());
                                $pObj->setStatus(1);
                                $pObj->save();
                            } else {
                                $pObj = $provObj;
                            }

                            if (!$cityObj) {
                                $cObj = new NestleBowerCity();
                                $cObj->setCity($city);
                                $cObj->setProvinceId($pObj->getId());
                                $cObj->setStatus(1);
                                $cObj->save();
                            } else {
                                $cObj = $cityObj;
                            }

                            if (!$areaObj) {
                                $arObj = new NestleBowerArea();
                                $arObj->setArea($area);
                                $arObj->setCityId($cObj->getId());
                                $arObj->setStatus(1);
                                $arObj->save();
                            } else {
                                $arObj = $areaObj;
                            }

                            $day = strtolower($day);
                            $d = explode('-', $day);
                            $days = array();

                            if(in_array('m', $d)){
                                $days[0] = 1;
                            } else{
                                $days[0] = 0;
                            }

                            if(in_array('t', $d)){
                                $days[1] = 1;
                            } else{
                                $days[1] = 0;
                            }

                            if(in_array('w', $d)){
                                $days[2] = 1;
                            } else{
                                $days[2] = 0;
                            }

                            if(in_array('th', $d)){
                                $days[3] = 1;
                            } else{
                                $days[3] = 0;
                            }
                            if(in_array('f', $d)){
                                $days[4] = 1;
                            } else{
                                $days[4] = 0;
                            }

                            if(in_array('s', $d)){
                                $days[5] = 1;
                            } else{
                                $days[5] = 0;
                            }

                            $days = implode("-", $days);

                            $newAcc = new NestleBowerAccountsMcp();
                            $newAcc->setName($name);
                            $newAcc->setContactPerson($cPerson);
                            $newAcc->setContactNumber($cNumber);
                            $newAcc->setAddress($address);
                            $newAcc->setLatitude($latitude);
                            $newAcc->setLongitude($longitude);
                            $newAcc->setBestFrom($bestFrom);
                            $newAcc->setBestTo($bestTo);

                            $newAcc->setAreaId($arObj->getId());
                            $newAcc->setCityId($cObj->getId());
                            $newAcc->setCategoryId($catObj->getId());

                            $newAcc->setFrequency($frequency);
                            $newAcc->setBracketNumber($days);
                            $newAcc->setChannel($channel);

                            $newAcc->setStatus($status);
                            $newAcc->save();

                            $con = new NestleBowerAccount();
                            $con->setBowerId($b->getId());
                            $con->setAccountId($newAcc->getId());
                            $con->save();
                        }
                    }

                    $ctr++;
                }

                $this->get('session')->getFlashBag()->add('notice', 'List successfully uploaded!');

                return $this->redirect($this->generateUrl('nestle_web_account_leads'));
            }else{
                $this->get('session')->getFlashBag()->add('notice', $errormsg);

                return $this->redirect($this->generateUrl('nestle_web_account_leads'));
            }



        //}
    }

    public function accountsProfileAction($id)
    {

        $user = $this->getUser();

        $account = NestleBowerAccountsMcpPeer::retrieveByPK($id);
        $bowerAssigned = NestleBowerAccountPeer::getAccountByAccountId($id);

        $city = NestleBowerCityPeer::retrieveByPK($account->getCityId());
        $province = NestleBowerProvincePeer::retrieveByPK($city->getNestleBowerProvince()->getId());
        $region = NestleBowerRegionPeer::retrieveByPK($province->getNestleBowerRegion()->getId());

        $d = explode("-", $account->getBracketNumber());
        $day = '';
        if($d[0] == 1){
            $day .= 'M ';
        }

        if($d[1] == 1){
            $day .= 'T ';
        }

        if($d[2] == 1){
            $day .= 'W ';
        }

        if($d[3] == 1){
            $day .= 'TH ';
        }

        if($d[4] == 1){
            $day .= 'F ';
        }

        if($d[5] == 1){
            $day .= 'S ';
        }

        return $this->render('NestleWebBundle:Accounts:accountsProfile.html.twig', array(
            'user' => $user,
            'account' => $account,
            'bowerAssigned' => $bowerAssigned,
            'province' => $province,
            'day' => $day,
            'region' => $region
        ));
    }


    public function accountsDeleteAction($id)
    {
        $account = NestleBowerAccountsMcpPeer::retrieveByPK($id);
        $account->setStatus(-1);
        $account->save();

//        $mcp = NestleBowerAccountQuery::create()
//            ->filterByAccountId($account->getId())
//            ->find();


//        foreach($mcp as $m){
//            $m->setStatus(0);
//            $m->save();
//        }


        $this->get('session')->getFlashBag()->add('notice', 'successfully deleted the account!');
        return $this->redirect($this->generateUrl('nestle_web_account_leads'));

    }


    public function accountsProfileEditAction($id)
    {
        $user = $this->getUser();

        $request = $this->getRequest();
        $account = NestleBowerAccountsMcpPeer::retrieveByPK($id);
        $bowerAssigned = NestleBowerAccountPeer::getAccountByAccountId($id);

        $city = NestleBowerCityPeer::retrieveByPK($account->getCityId());
        $province = NestleBowerProvincePeer::retrieveByPK($city->getNestleBowerProvince()->getId());
        $region = NestleBowerRegionPeer::retrieveByPK($province->getNestleBowerRegion()->getId());

        $allBowers = NestleBowerPeer::getAllActive();
        $allRegions = NestleBowerRegionPeer::getAll();
        $allProvinces = NestleBowerProvincePeer::getAll();
        $allCities = NestleBowerCityPeer::getAll();
        $allAreas = NestleBowerAreaPeer::getAll();

        $days = $account->getBracketNumber();
        $d = explode("-", $days);
        $days = array(
            'monday' => $d[0],
            'tuesday' => $d[1],
            'wednesday' => $d[2],
            'thursday' => $d[3],
            'friday' => $d[4],
            'saturday' => $d[5],
        );


        if ($request->getMethod() == 'POST') {
            $name = $request->request->get('storeName');
            $status = $request->request->get('status');
            $category = $request->request->get('category');
            $bower = $request->request->get('bower');
            $contactPerson = $request->request->get('contactPerson');
            $contactNumber = $request->request->get('contactNumber');
            $regionId = $request->request->get('region');
            $provinceId = $request->request->get('province');
            $cityId = $request->request->get('city');
            $address = $request->request->get('address');
            $bestFrom = $request->request->get('bestFrom');
            $bestTo = $request->request->get('bestTo');
            $frequency = $request->request->get('frequency');
            $new_area = $request->request->get('new_area');
            $area = $request->request->get('area');
            if($area == 0 OR !isset($area) OR empty($area)){
                if(!empty($new_area)){
                    $new_area_obj = new NestleBowerArea();
                    $new_area_obj->setArea($new_area);
                    $new_area_obj->setCityId($cityId);
                    $new_area_obj->save();
                    $area = $new_area_obj->getId();
                }else{
                    $this->get('session')->getFlashBag()->add('notice', 'Please fill up new Area!');
                    $this->redirect($this->generateUrl('nestle_web_account_leads_add'));
                }
            }

            $monday = $request->request->get('monday');
            $tuesday = $request->request->get('tuesday');
            $wednesday = $request->request->get('wednesday');
            $thursday = $request->request->get('thursday');
            $friday = $request->request->get('friday');
            $saturday = $request->request->get('saturday');
            $day = '';
            if(isset($monday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($tuesday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($wednesday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($thursday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($friday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($saturday)){
                $day .= '1';
            }else{
                $day .= '0';
            }

            $account->setName($name);
            $account->setContactPerson($contactPerson);
            $account->setContactNumber($contactNumber);
            $account->setAddress($address);
            $account->setBestFrom($bestFrom);
            $account->setBestTo($bestTo);
            $account->setAreaId($area);
            $account->setCityId($cityId);
            $account->setFrequency($frequency);
            $account->setCategoryId($category);
            $account->setBracketNumber($day);
            $account->setStatus($status);
            $account->save();

            $bowerAssignment = NestleBowerAccountPeer::getBowerAccountByAccountIdAndBowerId($id, $bower);

            if (!empty($bowerAssignment)) {
                $bowerAssignment->setStatus(0);
                $bowerAssignment->save();
            }

            $bowerAssignment = new NestleBowerAccount();
            $bowerAssignment->setBowerId($bower);
            $bowerAssignment->setAccountId($id);
            $bowerAssignment->setStatus(1);
            $bowerAssignment->save();

            $this->get('session')->getFlashBag()->add('notice', 'Successfully updated the record!');

            return $this->redirect($this->generateUrl('nestle_web_account_leads_profile_edit', array('id' => $id)));
        }

        return $this->render('NestleWebBundle:Accounts:accountsProfileEdit.html.twig', array(
            'user' => $user,
            'account' => $account,
            'bowerAssigned' => $bowerAssigned,
            'province' => $province,
            'region' => $region,
            'allBowers' => $allBowers,
            'allRegions' => $allRegions,
            'allProvinces' => $allProvinces,
            'allCities' => $allCities,
            'allArea' => $allAreas,
            'days' => $days,
        ));
    }


    public function accountsProfileAddAction()
    {
        $request = $this->getRequest();
        $user = $this->getUser();
        $account = new NestleBowerAccountsMcp();


        $allBowers = NestleBowerPeer::getAllActive();
        $allRegions = NestleBowerRegionPeer::getAll();
        $allProvinces = NestleBowerProvincePeer::getAll();
        $allCities = NestleBowerCityPeer::getAll();
        $allAreas = NestleBowerAreaPeer::getAll();


        if ($request->getMethod() == 'POST') {
            $name = $request->request->get('storeName');
            $status = 1;
            $category = $request->request->get('category');
            $bower = $request->request->get('bower');
            $contactPerson = $request->request->get('contactPerson');
            $contactNumber = $request->request->get('contactNumber');
            $cityId = $request->request->get('city');
            $address = $request->request->get('address');
            $bestFrom = $request->request->get('bestFrom');
            $bestTo = $request->request->get('bestTo');
            $frequency = $request->request->get('frequency');
            $latitude = $request->request->get('latitude');
            $longitude = $request->request->get('longitude');

            $area = $request->request->get('area');
            $new_area = $request->request->get('new_area');
            if($area == 0 OR !isset($area) OR empty($area)){
                if(!empty($new_area)){
                    $new_area_obj = new NestleBowerArea();
                    $new_area_obj->setArea($new_area);
                    $new_area_obj->setCityId($cityId);
                    $new_area_obj->save();
                    $area = $new_area_obj->getId();
                }else{
                    $this->get('session')->getFlashBag()->add('notice', 'Please fill up new Area!');
                    $this->redirect($this->generateUrl('nestle_web_account_leads_add'));
                }
            }

            $monday = $request->request->get('monday');
            $tuesday = $request->request->get('tuesday');
            $wednesday = $request->request->get('wednesday');
            $thursday = $request->request->get('thursday');
            $friday = $request->request->get('friday');
            $saturday = $request->request->get('saturday');
            $day = '';
            if(isset($monday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($tuesday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($wednesday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($thursday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($friday)){
                $day .= '1-';
            }else{
                $day .= '0-';
            }

            if(isset($saturday)){
                $day .= '1';
            }else{
                $day .= '0';
            }

            $account->setName($name);
            $account->setContactPerson($contactPerson);
            $account->setContactNumber($contactNumber);
            $account->setAddress($address);
            $account->setBestFrom($bestFrom);
            $account->setBestTo($bestTo);
            $account->setAreaId($area);
            $account->setCityId($cityId);
            $account->setFrequency($frequency);
            $account->setCategoryId($category);
            $account->setBracketNumber($day);
            $account->setLatitude(doubleval($latitude));
            $account->setLongitude(doubleval($longitude));
            $account->setStatus($status);
            $account->save();

            $bowerAssignment = new NestleBowerAccount();
            $bowerAssignment->setBowerId($bower);
            $bowerAssignment->setAccountId($account->getId());
            $bowerAssignment->setStatus(1);
            $bowerAssignment->save();

            $this->get('session')->getFlashBag()->add('notice', 'Successfully added the account!');

            return $this->redirect($this->generateUrl('nestle_web_account_leads'));

        }

        return $this->render('NestleWebBundle:Accounts:accountsProfileAdd.html.twig', array(
            'user' => $user,
            'account' => $account,
            'allArea' => $allAreas,
            'allBowers' => $allBowers,
            'allRegions' => $allRegions,
            'allProvinces' => $allProvinces,
            'allCities' => $allCities
        ));

    }
}

?>