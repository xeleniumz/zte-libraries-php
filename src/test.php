<?php

use Kernel\Snmp\Olt;
use Kernel\Snmp\Onu;


date_default_timezone_set('Asia/Bangkok');


$olt =  [ 
			['ip'=>'10.1.1.100','id'=>'10011'],
			['ip'=>'10.1.1.101','id'=>'10012']
	    ];

$str = '';
$OLTNAME = '';

$OLT = new Olt();

foreach($olt as $r){

	$ip      = $r['ip'];
	$gpon_id = $r['id'];

	$data['olt_name'] = $OLT->getOltName($ip);
	$data['olt_id']   = $OLT->getOltId($ip);

	$uptime               = $OLT->getUptime($ip);
	$uptime_value         = explode(')',$uptime[0]);
	$data['uptime_value'] = $uptime_value[1];
	$gpon_name            = explode(':', $data['olt_name'][0]);

	print_r($data);

	foreach ($data['olt_id']  as $v) {
        $id         = explode( ' ', $v);
       	print_($OLT->getOltStatus($ip,$id[1],TRUE)) .'<br>';
        print_($OLT->getOltSolt($ip,$id[1])) .'<br>';
        print_($OLT->checkGpon($olt_name[0])) .'<br>';
   		
    }

}
