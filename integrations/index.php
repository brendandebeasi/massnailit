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
    case 'is-successful-purchase':
        $pi = $_POST; //purchaseinfo
        $IS_user_id = $pi["Id"];
        $IS_user_lms_id = $pi['lmsuid'];
        //get list of products user has purchased
        $purchased_skus = IS_getPurchasesForContact($IS_user_id);
        error_log(json_encode($purchased_skus));
        $LMS_courses = LMS_getCourses();

        foreach($purchased_skus['data']['skus'] as $sku) {
            $returnValue = preg_match('/^ON.*/', $sku, $matches);
            //see if there are any skus beginning with ON.
            if($returnValue) {
                //see if there is an LMS ID for the user
                if($IS_user_lms_id == '0.0') { //if not create one
                    $response = LMS_createUser($pi['FirstName'],$pi['LastName'],$pi['Email'],strtolower($pi['FirstName'].$pi['LastName'].$pi['Id']),generateStrongPassword());
                    $IS_user_lms_id = $response['data']['id'];
                    //save the litmos ID to the IS user's lms field.
                    IS_associateWithLitmosUser($IS_user_id,$IS_user_lms_id);
                }

                //try and match the courses with the sku
                foreach($LMS_courses as $course) {
                    if($course['Code'] == $sku) {
                        LMS_assignCourseToUser($IS_user_lms_id, $course['Id']);
                    }
                }

            }
        }

        break;
    case 'is-get-products':
        if(isset($_GET['prefix'])) $prefix = $_GET['prefix'];
        else $prefix = false;

        echo json_encode(IS_getProductsWithPrefix($prefix));

        break;

    case 'is-get-products-for-contact':
        if(isset($_GET['contact_id'])) $contact_id = $_GET['contact_id'];
        else die('no contact ID set');

        echo json_encode(IS_getPurchasesForContact($contact_id));
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
    case 'lms-get-users':
        if(isset($_GET['limit']) && is_numeric($_GET['limit'])) $limit = $_GET['limit'];
        else $limit = null;
        if(isset($_GET['start']) && is_numeric($_GET['start'])) $start = $_GET['start'];
        else $start = null;

        $user_list= LMS_getUsers($limit,$start);
        echo json_encode($user_list);
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
    case 'lms-get-users':
        $courses = LMS_getUsers();
        echo json_encode($courses);

        break;

    case 'lms-get-courses-for-user':
        if(isset($_GET['lms_id'])) {
            $lms_id = $_GET['lms_id'];
            $courses = LMS_getCoursesForUser($lms_id);
            echo json_encode($courses);
        }
        else die('LMS ID not set.');
        break;
    case 'lms-assign-course-to-user':
        if(isset($_GET['lms_id']) && isset($_GET['course_id'])) {
            $lms_id = $_GET['lms_id'];
            $course_id = $_GET['course_id'];
            $courses = LMS_assignCourseToUser($lms_id,$course_id);
            echo json_encode($courses);
        }
        else die('LMS ID or Course ID not set.');
        break;
    case 'mni-purchase-success-callback':
        file_put_contents(getcwd() . '/brendan.txt', json_encode($_POST));
        break;
    default:
        die("Invalid action set");
}

function IS_getPurchasesForContact($contact_id) {
    $skus = [];

    $app = new iSDK;
    $app->cfgCon("mni");

    //get all invoices for user
    $returnFields = ['Id'];
    $query = ['ContactId' => $contact_id];
    $invoices = $app->dsQuery("Invoice",1000,0,$query,$returnFields);
    foreach($invoices as $invoice) {
        //get all items in the invoice
        $returnFields = ['OrderItemId'];
        $query = ['InvoiceId' => $invoice['Id']];
        $invoiceItems = $app->dsQuery("InvoiceItem",1000,0,$query,$returnFields);
        //get the product ID for each item
        foreach($invoiceItems as $item) {
            $returnFields = ['ProductId'];
            $query = ['Id' => $item['OrderItemId']];
            $orderItems = $app->dsQuery("OrderItem",1000,0,$query,$returnFields);
//            die(json_encode($item));
            //get the sku for each product id
            foreach($orderItems as $item) {
                $returnFields = ['Sku'];
                $query = ['Id' => $item['ProductId']];
                $products = $app->dsQuery("Product",1000,0,$query,$returnFields);
                foreach($products as $product) {
                    $skus[] = $product['Sku'];
                }
            }

                    //
        }
    }
    return ['success'=>1,'data'=>$skus];
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

function LMS_getUsers($limit=null,$start=null) {
    $response = ['success'=>0,'message'=>"An unknown error occured."];

    require_once('src/pest/PestJSON.php');
    $pest = new PestJSON('https://api.litmos.com/v1.svc');
    try {
        if($limit!=null) $limit = '&limit=' . $limit;
        if($start!=null) $start = '&start=' . $start;

        $users = $pest->get('/users?apikey=E8C3D63F-A273-461A-9691-37FC53EED941&source=mni'.$limit.$start,[]);
        $response = ['success'=>1,'message'=>null,'data'=>$users];
    }
    catch(Pest_Conflict $e) {
        $msg = json_decode($e->getMessage());
        if(isset($msg->Detail)) $msg = $msg->Detail;
        else $msg = 'An unknown error occurred.';
        $response = ['success'=>0,'message'=>$msg];
    }

    return $response;
}

function LMS_getCoursesForUser($lms_id) {
    $response = ['success'=>0,'message'=>"An unknown error occured."];

    require_once('src/pest/PestJSON.php');
    $pest = new PestJSON('https://api.litmos.com/v1.svc');
    try {
        $courses = $pest->get('/users/'.$lms_id.'/courses?apikey=E8C3D63F-A273-461A-9691-37FC53EED941&source=mni',array());
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

function LMS_assignCourseToUser($lms_id,$course_id) {
    require_once('src/pest/PestJSON.php');
    $pest = new PestJSON('https://api.litmos.com/v1.svc');
    $data = '[{"Id":"IZ84SXaiA3s1"}]';


    try {

        $courses = $pest->post('/users/'.$lms_id.'/courses?apikey=E8C3D63F-A273-461A-9691-37FC53EED941&source=mni',$data);
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

function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
{
    $sets = array();
    if(strpos($available_sets, 'l') !== false)
        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    if(strpos($available_sets, 'u') !== false)
        $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    if(strpos($available_sets, 'd') !== false)
        $sets[] = '23456789';
    if(strpos($available_sets, 's') !== false)
        $sets[] = '!@#$%&*?';

    $all = '';
    $password = '';
    foreach($sets as $set)
    {
        $password .= $set[array_rand(str_split($set))];
        $all .= $set;
    }

    $all = str_split($all);
    for($i = 0; $i < $length - count($sets); $i++)
        $password .= $all[array_rand($all)];

    $password = str_shuffle($password);

    if(!$add_dashes)
        return $password;

    $dash_len = floor(sqrt($length));
    $dash_str = '';
    while(strlen($password) > $dash_len)
    {
        $dash_str .= substr($password, 0, $dash_len) . '-';
        $password = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
}