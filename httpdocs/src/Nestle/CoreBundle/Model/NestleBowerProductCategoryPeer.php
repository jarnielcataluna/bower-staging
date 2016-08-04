<?php

namespace Nestle\CoreBundle\Model;

use Nestle\CoreBundle\Model\om\BaseNestleBowerProductCategoryPeer;

use \Criteria;

class NestleBowerProductCategoryPeer extends BaseNestleBowerProductCategoryPeer
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
