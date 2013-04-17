<?php
/*
 * MassNailIt Integrations File
 * This file can perform the following functions:
 * - get list of a certain type of products from IS
 * TODO:  link a user in litmos with a user in infusion soft
 * TODO:  authenticate a litmos user to use a certain program
 */
require_once('src/conn.cfg.php');
require_once('src/isdk.php');


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
            $name_last= $_GET['name_last'];
            $email= $_GET['email_address'];
            $user_response = LM_createUser($name_first, $name_last, $email,$username=null);
            echo json_encode($user_response);
        }
        break;
    default:
        die("Invalid action set");
}


function IS_getProductsWithPrefix($prefix=false) {
    $response = ['success'=>0,'message'=>"An unknown error occured."];
    $app = new iSDK;
    $app->cfgCon("mni");

    if(!$prefix) $sku = '%';
    elseif(!empty($prefix)) $sku = $prefix . '.%';

    $returnFields = ['Id','ProductName','ProductPrice','ShortDescription','Sku'];
    $query = ['Id' => '%','Sku' => $sku];
    $products = $app->dsQuery("Product",10,0,$query,$returnFields);
    $products_json = json_encode($products);
    if(json_decode($products_json) === null) {
        $response = ['success'=>0,'message'=>"Invalid JSON returned: " . $products];

    }
    $response = ['success'=>1,'message'=>null,'data'=>$products_json];
    return $response;
}

function LM_createUser($first_name,$last_name,$email_address,$username) {
    $response = ['success'=>0,'message'=>"An unknown error occured."];

    require_once('src/pest/PestJSON.php');
    if(is_null($username)) {
        $username = $email_address;
        $is_custom_user = false;
    }
    else {
        $is_custom_user = true;
    }
    $pest = new PestJSON('https://api.litmos.com/v1.svc');
    $data = [
        'Email' => $email_address,
        'UserName'=>$username,
        'FirstName' => $first_name,
        'LastName' => $last_name,
        'SkipFirstLogin'=>true,
        'DisableMessages'=>false,
        'IsCustomUsername'=>$is_custom_user,
        'Password'=> 'asdfas',
        'Active'=>true
    ];
    try {
        $user = $pest->post('/users?apikey=E8C3D63F-A273-461A-9691-37FC53EED941&source=mni',$data);
        $response = ['success'=>1,'message'=>null,'data'=>['response'=>json_decode($user),'id'=>$user['Id']]];
    }
    catch(Pest_Conflict $e) {
        $msg = json_decode($e->getMessage());
        if(isset($msg->Detail)) $msg = $msg->Detail;
        else $msg = 'An unknown error occurred.';
        $response = ['success'=>0,'message'=>$msg];
    }

    return $response;
}