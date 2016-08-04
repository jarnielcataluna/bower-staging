<?php

namespace Nestle\WebBundle\Controller;

//Models
use Nestle\CoreBundle\Model\NestleBowerAccount;
use Nestle\CoreBundle\Model\NestleBowerUsers;
use Nestle\CoreBundle\Model\NestleBower;
use Nestle\CoreBundle\Model\NestleBowerArea;
use Nestle\CoreBundle\Model\NestleBowerCity;
use Nestle\CoreBundle\Model\NestleBowerProvince;
use Nestle\CoreBundle\Model\NestleBowerRegion;

//Peers
use Nestle\CoreBundle\Model\NestleBowerPeer;
use Nestle\CoreBundle\Model\NestleBowerProvincePeer;
use Nestle\CoreBundle\Model\NestleBowerRegionPeer;
use Nestle\CoreBundle\Model\NestleBowerAreaPeer;
use Nestle\CoreBundle\Model\NestleBowerCityPeer;


use Nestle\CoreBundle\Model\NestleUsers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BowerController extends Controller
{
    public function bowersAction()
    {


        if ($this->get('security.context')->isGranted('ROLE_ANALYST')) {

        } else if (!$this->getUser() instanceof NestleUsers) {
            return $this->redirect($this->generateUrl('logout'));
        }

        $user = $this->getUser();

        $filtered = NestleBowerPeer::getFiltered();
        $arr = array();

        foreach ($filtered as $fil) {

            $areaObj = NestleBowerAreaPeer::retrieveByPK($fil->getAreaId());
            $cityObj = NestleBowerCityPeer::retrieveByPK($areaObj->getCityId());
            $provObj = NestleBowerProvincePeer::retrieveByPK($cityObj->getProvinceId());
            $regionObj = NestleBowerRegionPeer::retrieveByPK($provObj->getRegionId());
            $username = $fil->getUsername();
            $fname = $fil->getFname();
            $lname = $fil->getLname();
            $area = $areaObj->getArea();
            $city = $cityObj->getCity();
            $province = $provObj->getProvince();
            $region = $regionObj->getRegion();

            if ($fil->getStatus() == 1) {
                $status = "Active";
            } else {
                $status = "Inactive";
            }

            $tmp = array(
                'id' => $fil->getId(),
                'bowerId' => $fil->getBowerId(),
                'username' => $username,
                'fname' => $fname,
                'lname' => $lname,
                'area' => $area,
                'city' => $city,
                'province' => $province,
                'region' => $region,
                'status' => $status
            );


            array_push($arr, $tmp);
        }


        return $this->render('NestleWebBundle:Bowers:bowers.html.twig', array(
            'user' => $user,
            'data' => $arr
        ));
    }

    public function bowersTableAction()
    {
        return $this->render('NestleWebBundle:Bowers:bowersTable.html.twig');
    }

    public function bowersTableDataAction()
    {
        $request = $this->getRequest();

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

        $bowers = NestleBowerPeer::getAll();
        $count = NestleBowerPeer::getCount();

        if ($count < $length) {
            $length = $count;
        }
        if ($pageStart >= $count) {
            $pageStart = 0;
        }


        $filtered = NestleBowerPeer::getFiltered($pageStart, $length);
        $arr = array();

        foreach ($filtered as $fil) {
            $f = new NestleBower();

            $areaObj = NestleBowerAreaPeer::retrieveByPK($fil->getAreaId());
            $cityObj = NestleBowerCityPeer::retrieveByPK($areaObj->getCityId());
            $provObj = NestleBowerProvincePeer::retrieveByPK($cityObj->getProvinceId());
            $regionObj = NestleBowerRegionPeer::retrieveByPK($provObj->getRegionId());
            $username = $fil->getUsername();
            $fname = $fil->getFname();
            $lname = $fil->getLname();
            $area = $areaObj->getArea();
            $city = $cityObj->getCity();
            $province = $provObj->getProvince();
            $region = $regionObj->getRegion();

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
                0 => $username,
                1 => $fname,
                2 => $lname,
                3 => $area,
                4 => $city,
                5 => $province,
                6 => $region,
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

    public function bowerAddAction()
    {
        $request = $this->getRequest();

        $user = $this->getUser();
        $allRegions = NestleBowerRegionPeer::getAll();
        $allProvinces = NestleBowerProvincePeer::getAll();
        $allCities = NestleBowerCityPeer::getAll();
        $allAreas = NestleBowerAreaPeer::getAll();

        if ($request->getMethod() == 'POST') {


            $fname = $request->request->get('fname');
            $lname = $request->request->get('lname');
            $status = $request->request->get('status');
            $username = $request->request->get('username');
            $password = $request->request->get('password');
            $bdate = $request->request->get('bdate');
            $contact = $request->request->get('contact');
            $distributor = $request->request->get('distributor');
            $region = $request->request->get('region');
            $province = $request->request->get('province');
            $city = $request->request->get('city');
            $area = $request->request->get('area');
            $new_area = $request->request->get('new_area');
            if($area == 0 OR !isset($area) OR empty($area)){
                if(!empty($new_area)){
                    $new_area_obj = new NestleBowerArea();
                    $new_area_obj->setArea($new_area);
                    $new_area_obj->setCityId($city);
                    $new_area_obj->save();
                    $area = $new_area_obj->getId();
                }else{
                    $this->get('session')->getFlashBag()->add('notice', 'Please fill up new Area!');
                    $this->redirect($this->generateUrl('nestle_web_bower_add'));
                }
            }
            $bowerId = $request->request->get('bowerId');

            if(NestleBowerPeer::validateBowerString($bowerId)){
                if (NestleBowerPeer::validateUsername($username)) {

                    $new_bower = new NestleBower();
                    $new_bower->setFname($fname);
                    $new_bower->setLname($lname);
                    $new_bower->setStatus($status);
                    $new_bower->setUsername($username);
                    $new_bower->setPassword($password);
                    $new_bower->setBdate($bdate);
                    $new_bower->setContactNumber($contact);
                    $new_bower->setAreaId($area);
                    $new_bower->setBowerId($bowerId);
                    $new_bower->setDistributor($distributor);

                    if ($new_bower->save()) {

                        $con = new NestleBowerAccount();
                        $con->setBowerId($new_bower->getId());
                        $con->setAccountId(1);
                        $con->setStatus(1);
                        $con->save();

                        $this->get('session')->getFlashBag()->add('notice', 'Successfully added bower!');
                        return $this->redirect($this->generateUrl('nestle_web_bower'));
                    } else {
                        $this->get('session')->getFlashBag()->add('notice', 'Something went wrong!');
                    }

                }else{
                    $this->get('session')->getFlashBag()->add('notice', 'username already taken!');
                }
            }else{
                $this->get('session')->getFlashBag()->add('notice', 'Existing BOW ID!');
            }




        }

        return $this->render('NestleWebBundle:Bowers:bowerAdd.html.twig', array(
            'user' => $user,
            'allRegions' => $allRegions,
            'allProvinces' => $allProvinces,
            'allCities' => $allCities,
            'allAreas' => $allAreas,
        ));

    }

    public function bowerDeleteAction($id)
    {
        $bower = NestleBowerPeer::retrieveByPK($id);
        if (!empty($bower)) {
            $bower->setStatus(-1);
            $bower->save();
        }
        $this->get('session')->getFlashBag()->add('notice', 'Bower Successfully Deleted!');
        return $this->redirect($this->generateUrl('nestle_web_bower'));
    }

    public function bowerEditAction($id)
    {
        $request = $this->getRequest();

        $user = $this->getUser();

        $allRegions = NestleBowerRegionPeer::getAll();
        $allProvinces = NestleBowerProvincePeer::getAll();
        $allCities = NestleBowerCityPeer::getAll();
        $allAreas = NestleBowerAreaPeer::getAll();

        $bower = NestleBowerPeer::retrieveByPK($id);
        $area = $bower->getNestleBowerArea();
        $city = $area->getNestleBowerCity();
        $province = $city->getNestleBowerProvince();
        $region = $province->getNestleBowerRegion();


        if ($request->getMethod() == 'POST') {
            $fname = $request->request->get('fname');
            $lname = $request->request->get('lname');
            $status = $request->request->get('status');
            $username = $request->request->get('username');
            $password = $request->request->get('password');
            $bdate = $request->request->get('bdate');
            $contact = $request->request->get('contact');
            $edit_region = $request->request->get('region');
            $edit_province = $request->request->get('province');
            $edit_city = $request->request->get('city');
            $edit_area = $request->request->get('area');
            $new_area = $request->request->get('new_area');
            $distributor = $request->request->get('distributor');
            if($edit_area == 0 OR !isset($edit_area) OR empty($edit_area)){
                if(!empty($new_area)){
                    $new_area_obj = new NestleBowerArea();
                    $new_area_obj->setArea($new_area);
                    $new_area_obj->setCityId($edit_city);
                    $new_area_obj->save();
                    $edit_area = $new_area_obj->getId();
                }else{
                    $this->get('session')->getFlashBag()->add('notice', 'Please fill up new Area!');
                    $this->redirect($this->generateUrl('nestle_web_bower_add'));
                }
            }


            if (NestleBowerPeer::validateUsername($username) OR $username == $bower->getUsername()) {

                $bower->setFname($fname);
                $bower->setLname($lname);
                $bower->setStatus($status);
                $bower->setUsername($username);
                $bower->setPassword($password);
                $bower->setBdate($bdate);
                $bower->setContactNumber($contact);
                $bower->setAreaId($edit_area);
                $bower->setDistributor($distributor);

                if ($bower->save()) {
                    $this->get('session')->getFlashBag()->add('notice', 'Successfully updated bower!');
                    return $this->render('NestleWebBundle:Bowers:bowerEdit.html.twig', array(
                        'user' => $user,
                        'id' => $id,
                        'bower' => $bower,
                        'area' => $area,
                        'city' => $city,
                        'province' => $province,
                        'region' => $region,
                        'allRegions' => $allRegions,
                        'allProvinces' => $allProvinces,
                        'allCities' => $allCities,
                        'allAreas' => $allAreas
                    ));

                } else {
                    $this->get('session')->getFlashBag()->add('notice', 'Something went wrong!');
                }
            }else{
                $this->get('session')->getFlashBag()->add('notice', 'Sorry ! Username Already Exist!');
            }

        }

        return $this->render('NestleWebBundle:Bowers:bowerEdit.html.twig', array(
            'user' => $user,
            'bower' => $bower,
            'area' => $area,
            'city' => $city,
            'province' => $province,
            'region' => $region,
            'allRegions' => $allRegions,
            'allProvinces' => $allProvinces,
            'allCities' => $allCities,
            'allAreas' => $allAreas
        ));
    }

    public function bowerProfileAction($id)
    {
        $user = $this->getUser();
        $bower = NestleBowerPeer::retrieveByPK($id);
        $area = $bower->getNestleBowerArea();
        $city = $area->getNestleBowerCity();
        $province = $city->getNestleBowerProvince();
        $region = $province->getNestleBowerRegion();


        return $this->render('NestleWebBundle:Bowers:bowerProfile.html.twig', array(
            'user' => $user,
            'bower' => $bower,
            'area' => $area,
            'city' => $city,
            'province' => $province,
            'region' => $region

        ));
    }

    public function processCsvAction()
    {
        $request = $this->getRequest();

        $directory = $request->server->get('DOCUMENT_ROOT') . 'uploads/csv/';
        $files = $request->files->get('bowersImport');
        $file = $files->getPathName();

        $date = new \DateTime('now');
        $fileName = $date->format('Y_m_d_H_i_s') . '_bower_list.csv';
        $target = $directory . $fileName;

        //if (move_uploaded_file($file, $target)) {
        $handle = fopen($files->getPathName(), "r");
        $handle2 = fopen($files->getPathName(), "r");
        $ctr = 0;
        $errormsg = "Opps !";
        $error = 0;

        while (!feof($handle)) {
            $list = fgetcsv($handle);
            if ($ctr > 0) {

                if(empty($list[0])){
                    continue;
                }

                $bower_id = addslashes($list[0]);
                $fname = addslashes($list[1]);
                $lname = addslashes($list[2]);
                $contanct = addslashes($list[3]);
                $bdate = addslashes($list[4]);
                $username = addslashes($list[5]);
                $password = addslashes($list[6]);
                $region = addslashes($list[7]);
                $province = addslashes($list[8]);
                $city = addslashes($list[9]);
                $area = addslashes($list[10]);



                if (!NestleBowerPeer::validateUsername($username)) {

                    $errormsg .= "Bower Username Already Exist . See Line " . $ctr . " Column 6 ";
                    $error++;

                } else {

                    if (!NestleBowerPeer::validateBowerString($bower_id)) {
                        $errormsg .= "Bower ID Already Existing. See Line " . $ctr . " Column 1 ";
                        $error++;
                    } else {
                        if (NestleBowerRegionPeer::getRegionByName($region) == null) {
                            $errormsg .= "Region Not Found. See Line " . $ctr . " Column 8 ";
                            $error++;
                        } else {

                            if (NestleBowerCityPeer::getCityByName($city) == null) {
                                $errormsg .= "City Not Found. See Line " . $ctr . " Column 10 ";
                                $error++;
                            }


                            if (NestleBowerProvincePeer::getProvinceByName($province) == null) {
                                $errormsg .= "Province Not Found. See Line " . $ctr . " Column 9 ";
                                $error++;
                            }


                        }
                    }

                }
            }

            $ctr++;
        }
        $ctr = 0;

        if($error == 0){

        while (!feof($handle2)) {
            $list = fgetcsv($handle2);
            if ($ctr > 0) {

                if(empty($list[0])){
                    continue;
                }

                $bower_id = addslashes($list[0]);
                $fname = addslashes($list[1]);
                $lname = addslashes($list[2]);
                $contanct = addslashes($list[3]);
                $bdate = addslashes($list[4]);
                $username = addslashes($list[5]);
                $password = addslashes($list[6]);
                $region = addslashes($list[7]);
                $province = addslashes($list[8]);
                $city = addslashes($list[9]);
                $area = addslashes($list[10]);


                if (!NestleBowerPeer::validateBowerString($bower_id) != null) {
                    continue;
                }

                $areaObj = NestleBowerAreaPeer::getAreaByName($area);
                $cityObj = NestleBowerCityPeer::getCityByName($city);
                $provObj = NestleBowerProvincePeer::getProvinceByName($province);
                $regionObj = NestleBowerRegionPeer::getRegionByName($region);




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

                $newbower = new NestleBower();
                $newbower->setBowerId($bower_id);
                $newbower->setFname($fname);
                $newbower->setLname($lname);
                $newbower->setContactNumber($contanct);
                $newbower->setBdate($bdate);
                $newbower->setUsername($username);
                $newbower->setPassword($password);
                $newbower->setAreaId($arObj->getId());
                $newbower->setStatus(1);
                $newbower->save();

                $con = new NestleBowerAccount();
                $con->setBowerId($newbower->getId());
                $con->setAccountId(1);
                $con->setStatus(1);
                $con->save();

            }

            $ctr++;
        }

        $this->get('session')->getFlashBag()->add('notice', 'List successfully uploaded!');
        return $this->redirect($this->generateUrl('nestle_web_bower'));

        }else{
            $this->get('session')->getFlashBag()->add('notice', $errormsg);
            return $this->redirect($this->generateUrl('nestle_web_bower'));
        }

    }


}


