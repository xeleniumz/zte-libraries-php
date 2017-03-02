<?php

namespace Kernel\Interface;

/**
 * @author Xeleniumz Fx
 * @version 1.1
 * @date 2/3/2017
 * */

Interface Onu {


	/**
	 *
	 * get onu data from src ip , index of array and return with array
	 *
	 */
	public function getOnu($ip,$index);


	/**
	 *
	 * get circuit from  src ip and gpon id
	 *
	 */
	public function getCustomerCircuit($ip,$gpon_id);


	/**
	 *
	 * get type of onu from ip,gpon id
	 *
	 */
	public function getCustomerOnuType($ip,$gpon_id);

	/**
	 *
	 * get type of onu status
	 *
	 */
	public function getCustomerOnuMac($ip,$gpon_id);


	/**
	 *
	 * get onu status from src ip and gpon id
	 *
	 */
	public function getCustomerStatus($ip,$gpon_id);

	/**
	 *
	 * get onu circuit from src ip ,circuit num
	 *
	 */
	public function getClientCircuit($ip,$cus_circuit_no);

	/**
	 *
	 * get onu circuit status
	 *
	 */
	public function getClientStatus($ip,$onu_circuit_index);


}
