<?php

namespace Nestle\CoreBundle\Utils;

class PropelrrUtility
{
    /**
     * @param Accepts any string and sanitize
     * @param Slugify string that can be used for url parameter
     * @var String $text (required)
     *
     * @return string
     */
    public static function slugify($text)
    {
        // replace all non letters or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function smsMsgParse($msg, $delim = ',')
    {
        $msg = strtoupper($msg);
        $msgArr = self::convertStringToArrayWithDelim($msg, $delim);
        foreach ($msgArr as $k => $m) {
            $msgArr[$k] = trim($m);
        }

        return $msgArr;
    }

    public static function getNetworkByMobile($number)
    {
        $mobile = "";
        $network = "";

        if ($number[0] == "6") {
            $number = substr($number, 1);
            if ($number[0] == "3") {
                $number = substr($number, 1);
            }
        }
        $mobile = substr($number, 0, 3);

        $smart = array("813", "918", "947", "998", "999");
        $stnt = array("907", "908", "909", "910", "912", "919", "921", "928", "929", "948", "949", "989");
        $tnt = array("946");
        $stntad = array("920");
        $stntrm = array("930", "938", "939");
        $exetel = array("973", "974");
        $globe = array("817", "917", "994");
        $gtm = array("905", "906", "915", "916", "926", "927", "935", "936", "937", "996", "997");
        $gpost = array("9178");
        $sun = array("922", "923", "925", "932", "933", "934", "942", "943");
        $nxtg = array("977");
        $nxt = array("979");
        $abs = array("937");

        if (in_array($mobile, $smart) || in_array($mobile, $tnt) || in_array($mobile, $stnt) || in_array($mobile, $stntad) || in_array($mobile, $stntrm) || in_array($mobile, $nxtg)) {
            $network = "SMART";
        } else if (in_array($mobile, $exetel)) {
            $network = "Exetel";
        } else if (in_array($mobile, $globe) || in_array($mobile, $gtm)) {
            $network = "GLOBE";
        } else if (in_array($mobile, $sun)) {
            $network = "Sun Cellular";
        } else if (in_array($mobile, $nxt)) {
            $network = "Next Mobile";
        } else if (in_array($mobile, $abs)) {
            $network = "ABS CBN Mobile";
        }

        return $network;
    }


}
