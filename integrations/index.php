<?php
/*
 * MassNailIt Integrations File
 * This file can perform the following functions:
 * TODO:  get list of a certain type of products from IS
 * TODO:  link a user in litmos with a user in infusion soft
 * TODO:  authenticate a litmos user to use a certain program
 */
require_once('src/conn.cfg.php');
require_once('src/isdk.php');
require_once('src/pest/PestJSON.php');


if(isset($_GET['action'])) $action = $_GET['action'];
elseif(isset($_POST['action'])) $action = $_POST['action'];
switch($action) {
    case 'get-products':
        if(isset($_GET['prefix'])) $prefix = $_GET['prefix'];
        else $prefix = false;

        echo IS_getProductsWithPrefix($prefix);

        break;
    case 'create-litmos-user':
        if(isset($_GET['name_first']) && isset($_GET['name_last']) && isset($_GET['email_address']) ) {
            $name_first = $_GET['name_first'];
            $name_last= $_GET['name_first'];
            $email= $_GET['email_address'];
            $user_response = LM_createUser($name_first, $name_last, $email);
            print_r($user_response);
        }
    default:
        die("Invalid action set");
}


function IS_getProductsWithPrefix($prefix=false) {
    $app = new iSDK;
    $app->cfgCon("mni");

    if(!$prefix) $sku = '%';
    elseif(!empty($prefix)) $sku = $prefix . '.%';

    $returnFields = ['Id','ProductName','ProductPrice','ShortDescription','Sku'];
    $query = ['Id' => '%','Sku' => $sku];
    $products = $app->dsQuery("Product",10,0,$query,$returnFields);
    $products_json = json_encode($products);
    if(json_decode($products_json) === null) {
        die('Invalid Json Returned' . $products);
    }
    else return $products_json;
}

function LM_createUser($first_name,$last_name,$email_address) {

    $pest = new PestJSON('https://api.litmos.com/v1.svc');
    $data = Array(
        'Email' => $email_address,
        'FirstName' => $first_name,
        'LastName' => $last_name,
        'SkipFirstLogin'=>true
    );
    $user = $pest->post('/users?apikey=E8C3D63F-A273-461A-9691-37FC53EED941',$data);
    return $user;
}