<?php
class Olt extends Component
{
	public $olt_name = '1.3.6.1.2.1.1.5.0';
	public $snmp_get_octet  = '1.3.6.1.2.1.2.2.1.1';
	public $gpon_name ='1.3.6.1.2.1.2.2.1.2';
	public $gpon_status = '1.3.6.1.2.1.2.2.1.8';
	public $gpon_uptime = '1.3.6.1.2.1.1.3.0';
	public $community = 'public';

	public function getOltName($ip){
		$name = snmpwalk($ip, $this->community, $this->olt_name);
		return $name;
	}

	public function getOltId($ip){
		$id = snmpwalk($ip, $this->community, $this->snmp_get_octet);
		return $id;
	}

	public function getOltSolt($ip,$id){
		$data = $this->gpon_name.'.'.$id;
		$rs = snmpwalk($ip,$this->community,$data);
		return $rs;
	}

	public function getOltStatus($ip,$id,$check=FALSE){
		if($check == TRUE){
			$data = $this->gpon_status.'.'.$id;
			$rs = snmpwalk($ip,$this->community,$data);
			$rs = explode(' ', $rs[0]);
			return $rs[1];
		}else{
			$data = $this->gpon_status.'.'.$id;
			$rs = snmpwalk($ip,$this->community,$data);
			$rs = explode(' ', $rs[0]);
			$res = ($rs[1] == 1) ? 'ONLINE':'OFFLINE';
			return $res;
		}
	}

	public function checkGpon($val){
		$v = explode('"', $val);
		$g = explode('_', $v[1]);

		$rs['chk'] = ($g[0] == 'gpon') ? TRUE:FALSE;
		$rs['gpon'] = $v[1];
		return $rs;
	}

	public function getUptime($ip){
		$uptime = snmpwalk($ip,$this->community,$this->gpon_uptime);
		return $uptime;
	}
	?>
