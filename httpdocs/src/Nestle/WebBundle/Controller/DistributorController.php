<?php

namespace Nestle\WebBundle\Controller;

use Nestle\CoreBundle\Model\NestleNestleDistributors;
use Nestle\CoreBundle\Model\NestleNestleDistributorsPeer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DistributorController extends Controller
{

    public function distributorViewAction()
    {
        $user = $this->getUser();
        return $this->render('NestleWebBundle:Distributor:index.html.twig', array(
            'user' => $user
        ));
    }

    public function distributorListAction(Request $request)
    {
        $response = array();
        json_encode($response);
        exit;
    }

    public function distributorManageAction(Request $request)
    {
        $response = array();
        echo json_encode($response);
        exit;
    }

    public function distributorDeleteAction(Request $request)
    {
        $response = array();
        json_encode($response);
        exit;
    }
}
