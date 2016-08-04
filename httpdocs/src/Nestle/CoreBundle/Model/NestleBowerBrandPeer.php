<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerBrandPeer;
use \Criteria;

class NestleBowerBrandPeer extends BaseNestleBowerBrandPeer
{
    public static function getAll(Criteria $c = null)
    {
        if (is_null($c)) {
            $c = new Criteria();
        }

        $_self = self::doSelect($c);

        return $_self ? $_self : array();
    }
}
