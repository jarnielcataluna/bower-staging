<?php

namespace Nestle\CoreBundle\Utils;

use Nestle\CoreBundle\Utils\PropelrrUtility as U;

class PropelrrUploader
{
    /**
     * A flexible file uploader
     *
     * @param $targetDir (required) directory folder of the file to be uploaded
     * @param $file (required) the file to be uploaded
     * @param $preName (optional) default name of the file
     * @param $origName (optional) default identifier of the orig name
     *
     * @return array
     */
    public static function upload($targetDir, $file, $preName = "", $origName = 0)
    {
        $filename = "";

        /* Get the necessary variables of the file */
        $name = $file['name'];
        $ext = explode(".", $name);
        $type = $file['type'];
        $tmp = $file['tmp_name'];
        $error = $file['error'];
        $size = $file['size'];

        if (!$error > 0) {
            /* Check if the directory is existing */
            if (!file_exists($targetDir)) {
                /* Will create one if none, then make it writable */
                mkdir($targetDir, 0755, true);
            }

            /* Check if the directory is writable */
            if (!is_writable($targetDir)) {
                /* Make it a writable */
                chmod($targetDir, 0755, true);
            }

            if ($preName) {
                $preName = U::slugify($preName);

                /* The filename will compose with:
                 * preName is a parameter from the function that come from the caller module
                 * timestamp integer, will be the unique identifier of the file
                 * with the file type ext
                 */
                $customName = $preName.'-'.time();
                $filename = $customName.".".end($ext);

                /* This is acceptable if the preName is set, append the origname with the custom name */
                if ($origName) {
                    $filename = $customName.'-'.$name;
                }
            } else {
                $filename = $name;
            }

            $target = $targetDir.$filename;

            /* Check if the file is already existing in the folder */
            if (!file_exists($target)) {
                /* Transfer the file and check if its successfull */
                if (move_uploaded_file($tmp, $target)) {
                    return array(
                        "name" => $filename,
                        "type" => $type,
                        "size" => $size,
                    );
                }
            }
        }

        return 0;
    }
}
