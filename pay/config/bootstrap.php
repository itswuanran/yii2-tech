<?php
if (YII_DEBUG) {
    $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
    $allow_origin = array(
        'http://party.dev.xxx.com',
    );
    if (in_array($origin, $allow_origin)) {
        header('Access-Control-Allow-Origin:' . $origin);
    }
} else {
    header('Access-Control-Allow-Origin: http://party.xxx.com');
}
// 参见 http://stackoverflow.com/questions/19743396/cors-cannot-use-wildcard-in-access-control-allow-origin-when-credentials-flag-i
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Key, TOKEN');
