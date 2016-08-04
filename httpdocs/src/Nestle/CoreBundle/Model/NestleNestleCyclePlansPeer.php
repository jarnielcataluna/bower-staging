<?php

namespace Nestle\CoreBundle\Model;

use Criteria;
use Nestle\CoreBundle\Model\om\BaseNestleNestleCyclePlansPeer;

class NestleNestleCyclePlansPeer extends BaseNestleNestleCyclePlansPeer
{
    public static function getAll(Criteria $c = null )
    {
        if(is_null($c)){
            $c = new Criteria();
        }

        $data = self::doSelect($c);
        return $data ? $data : array();
    }

    public static function getAllActive(Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $c->add(self::STATUS, 0, Criteria::NOT_EQUAL);

        $_self = self::doSelectOne($c);

        return $_self ? $_self : null;
    }
}
