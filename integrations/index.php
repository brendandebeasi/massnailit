<?php
/*
 * MassNailIt Integrations File
 * This file can perform the following functions:
 * - get list of a certain type of products from IS
 * - link a user in litmos with a user in infusion soft
 * TODO:  authenticate a litmos user to use a certain program
 */
require_once('src/conn.cfg.php');
require_once('src/isdk.php');

if(!isset($_GET['api_key'])) die('No API Key Set');
else {
    $key = $_GET['api_key'];
    if($key != 'Callie123') die('Invalid API Key');
}

if(isset($_GET['action'])) $action = $_GET['action'];
elseif(isset($_POST['action'])) $action = $_POST['action'];
switch($action) {
    case 'is-get-products':
        if(isset($_GET['prefix'])) $prefix = $_GET['prefix'];
        else $prefix = false;

        echo json_encode(IS_getProductsWithPrefix($prefix));

        break;


    case 'is-link-with-lms' :
        if(isset($_GET['lms_id']) && isset($_GET['is_id'])) {
            $lms_id = $_GET['lms_id'];
            $is_id = $_GET['is_id'];

            echo json_encode(IS_associateWithLitmosUser($is_id,$lms_id));
        }
        else die('No LMS ID or IS ID set.');
        break;

    case 'is-get-user-by-email' :
        if(isset($_GET['email_address'])) {
            $email = $_GET['email_address'];

            echo json_encode(IS_getUserByEmail($email));
        }
        else die('No email address set.');
        break;

    case 'lms-create-user':
        if(isset($_GET['name_first']) && isset($_GET['name_last']) && isset($_GET['email_address']) ) {
            $name_first = $_GET['name_first'];
            $name_last= $_GET['name_last'];
            $email= $_GET['email_address'];

            if(isset($_GET['username'])) $username = $_GET['username'];
            else $username = null;

            if(isset($_GET['password'])) $password = $_GET['password'];
            else $password = null;

            $user_response = LMS_createUser($name_first, $name_last, $email,$username,$password);
            echo json_encode($user_response);
        }
        break;

    case 'lms-get-courses':
        $courses = LMS_getCourses();
        echo json_encode($courses);

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
    $response = ['success'=>1,'message'=>null,'data'=>json_decode($products_json)];
    return $response;
}
function IS_associateWithLitmosUser($is_id,$lms_id) {
    $response = ['success'=>0,'message'=>"An unknown error occured."];
    $app = new iSDK;
    $app->cfgCon("mni");

    $contact_data = ['_lmsuid'=>$lms_id];
    try {
        $updated_contact = $app->updateCon($is_id,$contact_data);
    }
    catch(Exception $e) {
        $response = ['success'=>0,'message'=>"An unknown error occured: " . $e->getMessage()];
    }

    if(!empty($updated_contact)) {
        if(stripos($updated_contact,'ERROR') === false) $response = ['success'=>1,'message'=>null,'data'=>$updated_contact];
        else $response = ['success'=>0,'message'=>"An error occurred: " . $updated_contact];
    }

    return $response;
}

function IS_getUserByEmail($email) {
    $response = ['success'=>0,'message'=>"An unknown error occured."];
    $app = new iSDK;
    $app->cfgCon("mni");

    $returnFields = array('Id', 'FirstName', 'LastName');

    $returnUser = $app->findByEmail($email,$returnFields);
    if(empty($returnFields)) $response = ['success'=>0,'message'=>"No user found with the specified ID."];
    else $response = ['success'=>1,'message'=>null,'data'=>$returnUser];

    return $response;
}

function LMS_createUser($first_name,$last_name,$email_address,$username=null,$password) {
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
        'Password'=> $password,
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

function LMS_getCourses() {
    $response = ['success'=>0,'message'=>"An unknown error occured."];

    require_once('src/pest/PestJSON.php');
    $pest = new PestJSON('https://api.litmos.com/v1.svc');
    try {
        $courses = $pest->get('/courses?apikey=E8C3D63F-A273-461A-9691-37FC53EED941&source=mni',array());
        $response = ['success'=>1,'message'=>null,'data'=>$courses];
    }
    catch(Pest_Conflict $e) {
        $msg = json_decode($e->getMessage());
        if(isset($msg->Detail)) $msg = $msg->Detail;
        else $msg = 'An unknown error occurred.';
        $response = ['success'=>0,'message'=>$msg];
    }

    return $response;
}