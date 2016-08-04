<?php

namespace Nestle\WebBundle\Controller;

use Aws\S3\S3Client;
use Nestle\CoreBundle\Model\NestleBowerBrand;
use Nestle\CoreBundle\Model\NestleBowerBrandPeer;
use Nestle\CoreBundle\Model\NestleBowerBrandProduct;
use Nestle\CoreBundle\Model\NestleBowerBrandProductQuery;
use Nestle\CoreBundle\Model\NestleBowerBrandQuery;
use Nestle\CoreBundle\Model\NestleBowerProduct;
use Nestle\CoreBundle\Model\NestleBowerProductCategory;
use Nestle\CoreBundle\Model\NestleBowerProductCategoryPeer;
use Nestle\CoreBundle\Model\NestleBowerProductCategoryQuery;
use Nestle\CoreBundle\Model\NestleBowerProductPeer;
use Nestle\CoreBundle\Model\NestleBowerUsers;
use Nestle\CoreBundle\Model\NestleUsers;
use Nestle\CoreBundle\Model\om\BaseNestleBowerBrandProductQuery;
use Nestle\CoreBundle\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProductController extends Controller
{

    public function productsAction()
    {

        if ($this->get('security.context')->isGranted('ROLE_ANALYST')) {

        } else if (!$this->getUser() instanceof NestleUsers) {
            return $this->redirect($this->generateUrl('logout'));
        }

        $user = $this->getUser();

        $filtered = NestleBowerProductPeer::getFiltered();
        $arr = array();

        foreach ($filtered as $fil) {

            $category = $fil->getNestleBowerProductCategory()->getProductCategory();

            $sku = $fil->getSku();
            $name = $fil->getName();

            $brand_product = BaseNestleBowerBrandProductQuery::create()
                ->filterByProductId($fil->getId())
                ->findOne();

            $brand = $brand_product->getNestleBowerBrand()->getBrand();

            if ($fil->getStatus() == 1) {
                $status = 'Active';
            } else {
                $status = 'Inactive';
            }

            if ($fil->getType() == 1) {
                $product_type = 'Product';
            } else {
                $product_type = 'Promo';
            }

            $tmp = array(

                'id' => $fil->getId(),
                'sku' => $sku,
                'name' => $name,
                'brand' => $brand,
                'category' => $category,
                'type' => $product_type,
                'status' => $status,
            );

            array_push($arr, $tmp);
        }

        return $this->render('NestleWebBundle:Products:products.html.twig', array(
            'data' => $arr,
            'user' => $user
        ));

    }

    public function productTableAction()
    {
        return $this->render('NestleWebBundle:Products:productTable.html.twig');
    }

    public function productTableDataAction()
    {
        $request = $this->getRequest();

        $draw = $request->query->get('draw');
        $pageStart = $request->query->get('start');
        $length = $request->query->get('length');
        $columns = $request->query->get('columns');
        $order = $request->query->get('order');
        $search = $request->query->get('search');

        $sort = $order[0]['column'];
        $dir = $order[0]['dir'];
        $searching = $search['value'];

        $count = NestleBowerProductPeer::getCount();


        if ($count < $length) {
            $length = $count;
        }
        if ($pageStart >= $count) {
            $pageStart = 0;
        }

        $filtered = NestleBowerProductPeer::getFiltered($pageStart, $length);
        $arr = array();


        foreach ($filtered as $fil) {

            $category = $fil->getNestleBowerProductCategory()->getProductCategory();

            $sku = $fil->getSku();
            $name = $fil->getName();

            $brand_product = BaseNestleBowerBrandProductQuery::create()
                ->filterByProductId($fil->getId())
                ->findOne();

            $brand = $brand_product->getNestleBowerBrand()->getBrand();

            if ($fil->getStatus() == 1) {
                $status = 'Active';
            } else {
                $status = 'Inactive';
            }

            if ($fil->getType() == 1) {
                $product_type = 'Product';
            } else {
                $product_type = 'Promo';
            }

            $tmp = array(
                "DT_RowId" => "infoOpen",
                "DT_RowClass" => '',
                "DT_RowData" => $fil->getId(),
                "DT_RowAttr" => array(
                    "style" => 'cursor: pointer',
                    "data-id" => $fil->getId()
                ),
                0 => $sku,
                1 => $name,
                2 => $brand,
                3 => $category,
                4 => $product_type,
                5 => $status,

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

    public function productViewAction($id)
    {
        $user = $this->getUser();

        $allBrand = NestleBowerBrandPeer::getAll();
        $allCategory = NestleBowerProductCategoryPeer::getAll();
        $product = NestleBowerProductPeer::retrieveByPK($id);
        $category = $product->getNestleBowerProductCategory()->getProductCategory();
        $brandObj = NestleBowerBrandProductQuery::create()
            ->filterByProductId($product->getId())
            ->findOne();
        $brand = $brandObj->getNestleBowerBrand()->getBrand();


        return $this->render('NestleWebBundle:Products:viewProduct.html.twig', array(
            'user' => $user,
            'brands' => $allBrand,
            'categories' => $allCategory,
            'product' => $product,
            'product_category' => $category,
            'product_brand' => $brand
        ));


    }

    public function processCsvAction()
    {
        $request = $this->getRequest();
        $csv_directory = $request->server->get('DOCUMENT_ROOT') . 'uploads/csv/';
        $image_directory = $request->server->get('DOCUMENT_ROOT') . "/img/products/";


        if ($request->getMethod() == 'POST') {

            $csv_file = $request->files->get('product_csv');
            $csv = $csv_file->getPathName();
            $prod = $request->files->get('product_csv');

            $date = new \DateTime('now');
            $fileName = $date->format('Y_m_d_H_i_s') . '_product_list.csv';
            $target = $csv_directory . $fileName;

            $handle = fopen($csv, "r");
            $check = fopen($csv, "r");

            $error = 0;
            $errmsg = "";

            $ctr = 0;



            while (!feof($check)) {
                $list = fgetcsv($check);
                if ($ctr > 0) {
                    echo '<script>alert();</script>';
                    if(empty($list[0])){
                        continue;
                    }

                    if(!NestleBowerProductPeer::checkSku($list[0])){
                        $errmsg .= " SKU Already Exist ! Check line " . $ctr. " .";
                        $error++;
                    }

                    if(empty($list[0])){
                        $errmsg .= " SKU Required Check line " . $ctr. " .";
                        $error++;
                    }else{
                        if(!NestleBowerProductPeer::checkSku($list[0])){
                            $errmsg .= " SKU Already Exist ! Check line " . $ctr. " .";
                            $error++;
                        }
                    }


                    if(empty($list[5])){
                        $errmsg .= " Background Color Required Check line " . $ctr. " .";
                        $error++;
                    }

                    if(empty($list[6])){
                        $errmsg .= " Font Color Required Check line " . $ctr. " .";
                        $error++;
                    }

                    if(empty($list[7])){
                        $errmsg .= " Price Required Check line " . $ctr. " .";
                        $error++;
                    }


                    if(empty($list[1])){
                        $errmsg .= " Product Name Required Check line " . $ctr. " .";
                        $error++;
                    }

                    if(empty($list[2])){
                        $errmsg .= " Brand Required Check line " . $ctr. " .";
                        $error++;
                    }

                    if(empty($list[3])){
                        $errmsg .= " Category Required Check line " . $ctr. " .";
                        $error++;
                    }

                    if(empty($list[4])){
                        $errmsg .= " Type Required Check line " . $ctr . " .";
                        $error++;
                    }

                }
            }

            if ($error == 0) {
                $ctr = 0;
                while (!feof($handle)) {
                    $list = fgetcsv($handle);

                    if ($ctr > 0) {

                        if(empty($list[0])){
                            continue;
                        }

                        $sku = addslashes($list[0]);
                        $name = addslashes($list[1]);
                        $brand = addslashes($list[2]);
                        $category = addslashes($list[3]);
                        $type = addslashes($list[4]);
                        $background = addslashes($list[5]);
                        $font = addslashes($list[6]);
                        $price = addslashes($list[7]);
                        $vat = addslashes($list[8]);
                        $image = addslashes($list[9]);
                        $thumbnail = addslashes($list[10]);


                        $new_product = new NestleBowerProduct();

                        $cat = NestleBowerProductCategoryQuery::create()
                            ->filterByProductCategory('%' . $category . '%')
                            ->findOne();

                        if (is_null($cat)) {
                            $new_category = new NestleBowerProductCategory();
                            $new_category->setProductCategory($category);
                            $new_category->setStatus(1);
                            $new_category->save();
                            $new_product->setProductCategoryId($new_category->getId());
                        } else {
                            $new_product->setProductCategoryId($cat->getId());
                        }

                        $brnd = NestleBowerBrandQuery::create()
                            ->filterByBrand('%' . $brand . '%')
                            ->findOne();

                        if (is_null($brnd)) {
                            $new_brand = new NestleBowerBrand();
                            $new_brand->setBrand($brand);
                            $new_brand->setStatus(1);
                            $new_brand->save();
                            $brand_id = $new_brand->getId();
                        } else {
                            $brand_id = $brnd->getId();
                        }

                        if (strtolower($type) == strtolower('product')) {
                            $new_product->setType(1);
                        } else {
                            $new_product->setType(2);
                        }

                        if (!$list[5]) {
                            $background = '#000000';
                        }

                        if (!$list[6]) {
                            $font = '#FFFFFF';
                        }

                        $new_product->setSku($sku);
                        $new_product->setName($name);
                        $new_product->setBackgroundColor($background);
                        $new_product->setFontColor($font);
                        $new_product->setBasePrice($price);
                        $new_product->setVat($vat);
                        $new_product->setImage($image);
                        $new_product->setThumbnail($thumbnail);
                        $new_product->setStatus(1);

                        if ($new_product->save()) {
                            $new_brand_product = new NestleBowerBrandProduct();
                            $new_brand_product->setBrandId($brand_id);
                            $new_brand_product->setProductId($new_product->getId());
                            $new_brand_product->save();
                        }
                    }

                    $ctr++;

                }
            } else {
                $this->get('session')->getFlashBag()->add('notice', $errmsg);
                return $this->redirect($this->generateUrl('nestle_web_products'));
            }

            $count = 0;

            foreach ($_FILES['product_images']['name'] as $image => $image_name) {
                if ($_FILES['product_images']['error'][$image] == 4) {
                    continue; // Skip file if any error found
                }

                if ($_FILES['product_images']['error'][$image] == 0) {
                    $prod = $request->files->get('image');
                    if (move_uploaded_file($_FILES["product_images"]["tmp_name"][$image], $image_directory . $image_name)) {
                        $count++;
                    }

                    $bucket = 'nestle-bower-image-hosting';
                    $keyname = 'AKIAITYEZ5N4YWEYTVWQ';
                    $filepath = 'product-images';

                    $s3 = S3Client::factory([
                        'region' => 'ap-southeast-1',
                        'version' => 'latest'
                    ]);


                    try {

                        $result = $s3->putObject(array(
                            'Bucket' => $bucket,
                            'Key' => "product-images/" . $_FILES['image']['name'],
                            'Body' => fopen($prod['$image']->getPathName(), 'rb'),
                            'ContentType' => $_FILES['image']['type'],
                            'StorageClass' => 'STANDARD',
                            'ACL' => 'public-read'
                        ));

                        // Print the URL to the object.
                        echo $result['ObjectURL'] . "\n";
                    } catch (S3Exception $e) {
                        echo $e->getMessage() . "\n";
                    }

                }
            }


            $this->get('session')->getFlashBag()->add('notice', 'Product List successfully uploaded!');
            return $this->redirect($this->generateUrl('nestle_web_products'));
        }

        return $this->redirect($this->generateUrl('nestle_web_products'));
    }

    public function productAddAction()
    {
        $user = $this->getUser();


        $request = $this->getRequest();
        $allBrand = NestleBowerBrandPeer::getAll();
        $allCategory = NestleBowerProductCategoryPeer::getAll();
        if ($request->getMethod() == 'POST') {

            $new_product = new NestleBowerProduct();
            $sku = $request->request->get('sku');
            $name = $request->request->get('product_name');
            $color = $request->request->get('color');
            $font = $request->request->get('font');
            $price = $request->request->get('price');
            $category = $request->request->get('category');
            $brand = $request->request->get('brand');
            $vat = $request->request->get('vat');
            $type = $request->request->get('type');
            $added = new \DateTime("now");
            $dateadded = $added->format('Y-m-d H:i:s');
            $status = 1;

            $bucket = 'nestle-bower-image-hosting';
            $keyname = 'AKIAITYEZ5N4YWEYTVWQ';
            $filepath = 'product-images';

            $s3 = S3Client::factory([
                'region' => 'ap-southeast-1',
                'version' => 'latest'
            ]);

            $prod = $request->files->get('image');
            $thumb = $request->files->get('thumbnail');


            if (!$_FILES['image']['error'] > 0) {

                try {

                    $result = $s3->putObject(array(
                        'Bucket' => $bucket,
                        'Key' => "product-images/" . $_FILES['image']['name'],
                        'Body' => fopen($prod->getPathName(), 'rb'),
                        'ContentType' => $_FILES['image']['type'],
                        'StorageClass' => 'STANDARD',
                        'ACL' => 'public-read'
                    ));

                    // Print the URL to the object.
                    echo $result['ObjectURL'] . "\n";
                } catch (S3Exception $e) {
                    echo $e->getMessage() . "\n";
                }

                if (isset($_FILES['image']['name'])) {
                    $new_product->setImage($_FILES['image']['name']);
                }
            }

            if (!$_FILES['thumbnail']['error'] > 0) {
                try {

                    $result = $s3->putObject(array(
                        'Bucket' => $bucket,
                        'Key' => "product-images/" . $_FILES['thumbnail']['name'],
                        'Body' => fopen($thumb->getPathName(), 'rb'),
                        'ContentType' => $_FILES['thumbnail']['type'],
                        'StorageClass' => 'STANDARD',
                        'ACL' => 'public-read'
                    ));

                    // Print the URL to the object.
                    echo $result['ObjectURL'] . "\n";
                } catch (S3Exception $e) {
                    echo $e->getMessage() . "\n";
                }

                if (isset($_FILES['thumbnail']['name'])) {
                    $new_product->setThumbnail($_FILES['thumbnail']['name']);
                }
            }

            $new_product->setProductCategoryId($category);
            $new_product->setSku($sku);
            $new_product->setName($name);
            $new_product->setFontColor($font);
            $new_product->setBackgroundColor($color);
            $new_product->setBasePrice($price);
            $new_product->setVat($vat);
            $new_product->setType($type);
            $new_product->setDateAdded($dateadded);
            $new_product->setStatus($status);

            if ($new_product->save()) {
                $brand_product = new NestleBowerBrandProduct();
                $brand_product->setBrandId($brand);
                $brand_product->setProductId($new_product->getId());
                $brand_product->save();
                $this->get('session')->getFlashBag()->add('notice', 'Successfully added product!');
                return $this->redirect($this->generateUrl('nestle_web_products'));
            }


        }
        return $this->render('NestleWebBundle:Products:productAdd.html.twig', array(
            'user' => $user,
            'category' => $allCategory,
            'brand' => $allBrand
        ));

    }

    public function productDeleteAction($id)
    {
        $product = NestleBowerProductPeer::retrieveByPK($id);
        if (!empty($product)) {
            $product->setStatus(-1);
            $product->save();
        }
        $this->get('session')->getFlashBag()->add('notice', 'Successfully deleted product!');
        return $this->redirect($this->generateUrl('nestle_web_products'));
    }

    public function productEditAction($id)
    {
        $user = $this->getUser();
        $request = $this->getRequest();
        $allBrand = NestleBowerBrandPeer::getAll();
        $allCategory = NestleBowerProductCategoryPeer::getAll();
        $product = NestleBowerProductPeer::retrieveByPK($id);
        $category = $product->getNestleBowerProductCategory()->getId();
        $brandObj = NestleBowerBrandProductQuery::create()
            ->filterByProductId($product->getId())
            ->findOne();
        $brand = $brandObj->getNestleBowerBrand()->getId();

        if ($request->getMethod() == 'POST') {
            $sku = $request->request->get('sku');
            $name = $request->request->get('product_name');
            $color = $request->request->get('color');
            $font = $request->request->get('font');
            $price = $request->request->get('price');
            $category = $request->request->get('category');
            $brand = $request->request->get('brand');
            $vat = $request->request->get('vat');
            $type = $request->request->get('type');
            $added = new \DateTime("now");
            $dateadded = $added->format('Y-m-d H:i:s');
            $status = $request->request->get('status');

            $bucket = 'nestle-bower-image-hosting';
            $keyname = 'AKIAITYEZ5N4YWEYTVWQ';
            $filepath = 'product-images';

            $s3 = S3Client::factory([
                'region' => 'ap-southeast-1',
                'version' => 'latest'
            ]);

            $prod = $request->files->get('image');
            $thumb = $request->files->get('thumbnail');


            if (!$_FILES['image']['error'] > 0) {

                try {

                    $result = $s3->putObject(array(
                        'Bucket' => $bucket,
                        'Key' => "product-images/" . $_FILES['image']['name'],
                        'Body' => fopen($prod->getPathName(), 'rb'),
                        'ContentType' => $_FILES['image']['type'],
                        'StorageClass' => 'STANDARD',
                        'ACL' => 'public-read'
                    ));

                    // Print the URL to the object.
                    echo $result['ObjectURL'] . "\n";
                } catch (S3Exception $e) {
                    echo $e->getMessage() . "\n";
                }

                if (isset($_FILES['image']['name'])) {
                    $product->setImage($_FILES['image']['name']);
                }
            }

            if (!$_FILES['thumbnail']['error'] > 0) {
                try {

                    $result = $s3->putObject(array(
                        'Bucket' => $bucket,
                        'Key' => "product-images/" . $_FILES['thumbnail']['name'],
                        'Body' => fopen($thumb->getPathName(), 'rb'),
                        'ContentType' => $_FILES['thumbnail']['type'],
                        'StorageClass' => 'STANDARD',
                        'ACL' => 'public-read'
                    ));

                    // Print the URL to the object.
                    echo $result['ObjectURL'] . "\n";
                } catch (S3Exception $e) {
                    echo $e->getMessage() . "\n";
                }

                if (isset($_FILES['thumbnail']['name'])) {
                    $product->setThumbnail($_FILES['thumbnail']['name']);
                }
            }

            $product->setProductCategoryId($category);
            $product->setSku($sku);
            $product->setName($name);
            $product->setFontColor($font);
            $product->setBackgroundColor($color);
            $product->setBasePrice($price);
            $product->setVat($vat);
            $product->setType($type);
            $product->setDateAdded($dateadded);
            $product->setStatus($status);

            if ($product->save()) {
                $brand_product = NestleBowerBrandProductQuery::create()
                    ->filterByProductId($product->getId())
                    ->findOne();
                $brand_product->setBrandId($brand);
                $brand_product->save();
                $this->get('session')->getFlashBag()->add('notice', 'Successfully updated product!');
                return $this->render('NestleWebBundle:Products:productEdit.html.twig', array(
                    'user' => $user,
                    'brands' => $allBrand,
                    'categories' => $allCategory,
                    'product' => $product,
                    'product_category' => $category,
                    'product_brand' => $brand
                ));
            }


        }

        return $this->render('NestleWebBundle:Products:productEdit.html.twig', array(
            'user' => $user,
            'brands' => $allBrand,
            'categories' => $allCategory,
            'product' => $product,
            'product_category' => $category,
            'product_brand' => $brand
        ));
    }
}