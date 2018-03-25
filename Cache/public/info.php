<?php
// phpinfo();
//
//$m = new memcached();
//$m->addServer('127.0.0.1',11211);
//echo $m->get('user1');

$r = new Redis();
$r->connect('127.0.0.1',6379);
echo $r->get('user_1');