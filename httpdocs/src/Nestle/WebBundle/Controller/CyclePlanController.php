<?php

namespace Nestle\WebBundle\Controller;

use Nestle\CoreBundle\Model\NestleNestleCyclePlans;
use Nestle\CoreBundle\Model\NestleNestleCyclePlansPeer;
use Nestle\CoreBundle\Model\NestleNestleDistributors;
use Nestle\CoreBundle\Model\NestleNestleDistributorsPeer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Nestle\CoreBundle\Utils\PropelrrConstant as C;
use Nestle\CoreBundle\Utils\PropelrrUploader as UP;
class CyclePlanController extends Controller
{

    public function indexAction()
    {
        $user = $this->getUser();

        $cyclePlan = NestleNestleCyclePlansPeer::getAll();

        return $this->render('NestleWebBundle:CyclePlan:index.html.twig', array(
            'user' => $user,
            'cyclePlan' => $cyclePlan
        ));
    }

    public function addCyclePlanAction()
    {
        $user = $this->getUser();
        $cyclePlan = NestleNestleCyclePlansPeer::getAll();

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $params = $request->request->all();

            $cpTitle = $params["cp_title"];
            $cpStatus = $params["cp_status"];
            $cpDate = $params["cp_date"];
            $newCp = new NestleNestleCyclePlans();
            $newCp->setTitle($cpTitle);
            $newCp->setStatus($cpStatus);
            $newCp->setDate($cpDate);


            if (!$_FILES['cp_file']['error'] > 0) {
                $targetDir = $request->server->get('DOCUMENT_ROOT') . C::DIR_CYCLE_PLAN;
                $file = $_FILES['cp_file'];
                $preName = 'cp_file';
                $image = UP::upload($targetDir, $file, $preName);

                if (isset($image['name'])) {
                    $newCp->setLink($image['name']);
//                    var_dump($image['name']); exit;

                }

            }

            $newCp->save();
            return $this->redirect($this->generateUrl('nestle_web_cycle_plan'));

        }
        return $this->render('NestleWebBundle:CyclePlan:cyclePlanAdd.html.twig', array(
            'user' => $user,
            'cyclePlan' => $cyclePlan
        ));
    }

    public function profileCyclePlanAction($id)
    {
        $user = $this->getUser();
        $cyclePlan = NestleNestleCyclePlansPeer::retrieveByPK($id);
        $title = $cyclePlan->getTitle();
        $date = $cyclePlan->getDate();
        $status = $cyclePlan->getStatus();
        $link = $cyclePlan->getLink();


        return $this->render('NestleWebBundle:CyclePlan:cyclePlanView.html.twig', array(
            'user' => $user,
            'cyclePlan' => $cyclePlan,
            'title' => $title,
            'date' => $date,
            'status' => $status,
            'link' => $link

        ));
    }

    public function editCyclePlanAction($id)
    {
        $cyclePlan = NestleNestleCyclePlansPeer::retrieveByPK($id);
        $user = $this->getUser();

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {
            $params = $request->request->all();

            $cpTitle = $params["cp_title"];
            $cpStatus = $params["cp_status"];
            $cpDate = $params["cp_date"];


            $cyclePlan->setTitle($cpTitle);
            $cyclePlan->setStatus($cpStatus);
            $cyclePlan->setDate($cpDate);


            if (!$_FILES['cp_file']['error'] > 0) {
                $targetDir = $request->server->get('DOCUMENT_ROOT') . C::DIR_CYCLE_PLAN;
                $file = $_FILES['cp_file'];
                $preName = 'cp_file';
                $image = UP::upload($targetDir, $file, $preName);

                if (isset($image['name'])) {
                    $cyclePlan->setLink($image['name']);

                }

            }

            $cyclePlan->save();
            return $this->redirect($this->generateUrl('nestle_web_cycle_plan'));

        }
        return $this->render('NestleWebBundle:CyclePlan:cyclePlanEdit.html.twig', array(
            'user' => $user,
            'cyclePlan' => $cyclePlan
        ));
    }



    public function bowerDeleteAction($id)
    {
        $cyclePlan = NestleNestleCyclePlansPeer::retrieveByPK($id);

        if (!empty($cyclePlan)) {
            $cyclePlan->delete();
        }

        $this->get('session')->getFlashBag()->add('notice', 'Successfully Deleted!');
        return $this->redirect($this->generateUrl('nestle_web_cycle_plan'));
    }

}
