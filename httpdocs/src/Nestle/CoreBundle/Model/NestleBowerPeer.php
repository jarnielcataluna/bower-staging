<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerPeer;

use \Criteria;

class NestleBowerPeer extends BaseNestleBowerPeer
{
    public static function getUserByCredentials($user, $pass, Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $c1 = $c->getNewCriterion(self::USERNAME, $user, Criteria::EQUAL);
        $c2 = $c->getNewCriterion(self::PASSWORD, $pass, Criteria::EQUAL);



        $c1->addAnd($c2);
        $c->add($c1);

        $c->add(self::STATUS, 1 , Criteria::EQUAL);

        $_self = self::doSelectOne($c);

        return $_self ? $_self : null;
    }

    public static function getUserByForgotßCreds($user, $bdate, Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $c1 = $c->getNewCriterion(self::USERNAME, $user, Criteria::EQUAL);
        $c2 = $c->getNewCriterion(self::BDATE, $bdate, Criteria::EQUAL);

        $c1->addAnd($c2);
        $c->add($c1);

        $_self = self::doSelectOne($c);

        return $_self ? $_self : null;
    }

    public static function getUserByUsername($user, Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $c->add(self::USERNAME, $user, Criteria::EQUAL);

        $_self = self::doSelectOne($c);

        return $_self ? $_self : null;
    }

    public static function getAllActive(Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $c->add(self::STATUS, 1, Criteria::EQUAL);

        $c->addDescendingOrderByColumn(self::ID);

        $_self = self::doSelect($c);

        return $_self ? $_self : array();
    }

    public static function getBowerByName($fname, $lname, Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $fname = "%" . $fname . "%";
        $lname = "%" . $lname . "%";

        $c1 = $c->getNewCriterion(self::FNAME, $fname, Criteria::LIKE);
        $c2 = $c->getNewCriterion(self::LNAME, $lname, Criteria::LIKE);

        $c1->addAnd($c2);
        $c->add($c1);

        $_self = self::doSelectOne($c);

        return $_self ? $_self : null;
    }

    public static function getAll(Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $_self = self::doSelectOne($c);

        return $_self ? $_self : null;
    }


    public static function getFiltered($offset = 0, $limit = 0, $area = '', Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        if ($area != '') {
            $c->add(self::AREA_ID, $area, Criteria::EQUAL);
        }
        $c->add(self::STATUS, -1, Criteria::NOT_EQUAL);

        if($offset > 0){
            $c->setOffset($offset);

        }

        if($limit > 0){
            $c->setLimit($limit);
        }

        $_self = self::doSelect($c);

        return $_self ? $_self : array();
    }

    public static function getCount(Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        return self::doCount($c);
    }

    public static function validateUsername($username, Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $c->add(self::USERNAME, $username, Criteria::EQUAL);
        $count = self::doCount($c);

        if($count == 0){
            return true;
        }else{
            return false;
        }

    }

    public static function validateBowerId($id, Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $c->add(self::ID, $id, Criteria::EQUAL);
        $count = self::doCount($c);

        if($count == 0){
            return false;
        }else{
            return true;
        }

    }

    public static function validateBowerString($id, Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $c->add(self::BOWER_ID, $id, Criteria::EQUAL);
        $count = self::doCount($c);

        if($count == 0){
            return true;
        }else{
            return false;
        }

    }

    public static function getBowerString($id, Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $c->add(self::BOWER_ID, $id, Criteria::EQUAL);
        $_self = self::doSelectOne($c);
        return $_self ? $_self : array();

    }




}
