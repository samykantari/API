<?php

$f3=require('framework/base.php');

$f3->set('DEBUG',1);
if ((float)PCRE_VERSION<7.9)
	trigger_error('PCRE version is out of date');

$f3->config('api/configs/config.ini');
$f3->config('api/configs/routes.ini');




$f3->route('GET /',
    function($f3) {
        Api::response(404, 0);
    }
);

$hive = $f3->hive();

$f3->set('ONERROR',function($f3){
    // $error = F3::get('ERROR');
    echo \Template::instance()->render('error.html');
});
if(!Api::validToken() && $hive['URI'] != '/v1/users'){
    Api::response(400, array('error' => 'pas utilisateur'));
    return false;
}


$f3->run();
