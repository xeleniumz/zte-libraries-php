<?php
/**
* @ This class work with only zte onu
* @author Xeleniumz Fx
* @version 1.0
* @date 16/2/2015
* */
class Onu
{
	public $onu_no = '1.3.6.1.4.1.3902.1012.3.28.1.1.6';
	public $onu_customer_circuit = '1.3.6.1.4.1.3902.1012.3.28.1.1.2';
	public $onu_type = '1.3.6.1.4.1.3902.1012.3.28.1.1.1';
	public $onu_mac = '1.3.6.1.4.1.3902.1012.3.28.1.1.5';
	public $onu_status = '1.3.6.1.4.1.3902.1012.3.28.2.1.4';
	public $community = 'public';

	public function getOnu($ip,$index){
		$index_olt = $index;
		$arr = snmprealwalk($ip, $this->community,$this->onu_no);
		$key ='';
		$j=1;
		foreach($arr as $k => $v){
			$i = explode('.', $k);
			$index = $i[13];
			if($key != $index){
				$key = $index;
				$value[$j] = $key;
				if($j == $index_olt){
					return $value[$j];
					break;
				}
				$j++;
			}
		}
	}

	public function getCustomerCircuit($ip,$gpon_id){
		$val = $this->onu_customer_circuit.'.'.$gpon_id;
		$arr = snmpwalk($ip, $this->community,$val);
		return $arr;
	}

	public function getCustomerOnuType($ip,$gpon_id){
		$val = $this->onu_type.'.'.$gpon_id;
		$arr = snmpwalk($ip, $this->community,$val);
		return $arr;
	}

	public function getCustomerOnuMac($ip,$gpon_id){
		$val = $this->onu_mac.'.'.$gpon_id;
		$arr = snmpwalk($ip, $this->community,$val);
		return $arr;
	}

	public function getCustomerStatus($ip,$gpon_id){
		$rs = $this->onu_status.'.'.$gpon_id;
		$arr = snmpwalk($ip, $this->community,$rs);
		$res = array();
		foreach($arr as $v){
			$val = explode(':', $v);
			if($val[1] == '1')
				$status='Lost';
			elseif($val[1] == '3')
				$status='Online';
			elseif($val[1] == '4')
				$status='Dying Gasp';
			elseif($val[1] == '6')
				$status='Offline';
			array_push($res,$status);
		}
		return $res;
	}

	public function getClientCircuit($ip,$cus_circuit_no){
		$rs = snmprealwalk($ip,$this->community,$this->onu_customer_circuit);
		foreach($rs as $k => $r){
			$circuit = explode('"',$r);
			if($circuit[1] == $cus_circuit_no){
				//echo $k .'=>'.$circuit[1].'<br/>';
				$key = explode('.', $k);
				return  $key[13].'.'.$key[14];
				break;
			}
		}
	}

	public function getClientStatus($ip,$onu_circuit_index){

		$rs = snmprealwalk($ip,$this->community,$this->onu_status);
		foreach ($rs as $k => $v) {
			$key = explode('.', $k);
			$onu_status_index = $key[13].'.'.$key[14];
			if($onu_circuit_index == $onu_status_index){
				$val = explode(':',$v);
				break;
			}
		}
			if($val[1] == '1')
				$status='Lost';
			elseif($val[1] == '3')
				$status='Online';
			elseif($val[1] == '4')
				$status='Dying Gasp';
			elseif($val[1] == '6')
				$status='Offline';

		return $status;
	}

}
