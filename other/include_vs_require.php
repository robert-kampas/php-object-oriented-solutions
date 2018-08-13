<?php
/*
require_once('test.php');
require_once('test.php');

echo "final";

echo "<hr>";
*/

//var_dump(gethostbyname('https://www.youtube.com')); // https://www.youtube.com
//var_dump(gethostbyname('www.youtube.com')); // 216.58.213.78
//var_dump(gethostbyname('youtube.com')); // 216.58.212.110
//var_dump(gethostbyname('test')); // test

// allow_url_fopen = On
// mail.add_x_header = On
// mysqli.max_persistent = -1
// mysqli.default_host
// session.serialize_handler = php

//var_dump(ini_get('allow_url_fopen')); // 1
//var_dump(ini_get('mail.add_x_header')); // 1
//var_dump(ini_get('mysqli.max_persistent')); // -1
//var_dump(ini_get('mysqli.default_host')); // ''
//var_dump(ini_get('session.serialize_handler')); // 'php'
//var_dump(ini_get('test')); // false

print_r(get_headers('http://xgm.lt/', 1));