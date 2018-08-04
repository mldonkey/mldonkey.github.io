<?php
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';  
   
$allow_origin = array(  
    'http://mldonkey.github.io',  
    'https://mldonkey.github.io',  
    'http://bt.js.org',
    'https://bt.js.org',
);  
   
if(in_array($origin, $allow_origin)){  
    header('Access-Control-Allow-Origin:'.$origin);  
    header('Access-Control-Allow-Methods:POST');  
    header('Access-Control-Allow-Headers:x-requested-with,content-type');  
}