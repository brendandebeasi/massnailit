<?php
require 'src/pest/PestJSON.php';
$api_key = 'E8C3D63F-A273-461A-9691-37FC53EED941';
$limit = 20;
$pest = new PestJSON('https://api.litmos.com/v1.svc');

$users = $pest->get('/users?apikey=' . $api_key . '&source=mni&limit='.$limit);

foreach($users as $user){
    $userInfo = $pest->get('/users/' . $user['Id'] . '?apikey=' . $api_key . '&source=mni&limit='.$limit);
    print_r($userInfo);
    die();
}
//$thing = $pest->get('/things');
/*
$thing = $pest->post('/things',
    array(
        'name' => "Foo",
        'colour' => "Red"
    )
);

$thing = $pest->put('/things/15',
    array(
        'colour' => "Blue"
    )
);

$pest->delete('/things/15');
*/
?>