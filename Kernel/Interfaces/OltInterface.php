<?php

namespace Kernel\Interface;


/**
 * @author Xeleniumz Fx
 * @version 1.1
 * @date 2/3/2017
 * */

Interface Olt {


	/**
	 *
	 *  get olt name from src ip
	 *
	 */
	public function getOltName($ip);

	/**
	 *
	 *  get olt id from src ip
	 *
	 */
	public function getOltId($ip);


	/**
	 *
	 *  get olt shell slot from src ip,id
	 *
	 */
	public function getOltSolt($ip,$id);

	/**
	 *
	 *  get olt shell slot from src ip,id,check status 
	 *  if enable check it will return all data 
	 *
	 */
	public function getOltStatus($ip,$id,$check=FALSE);

	/**
	 *
	 *  check status of gpon from the data that get from olt
	 *
	 */
	public function checkGpon($val);

	/**
	 *
	 *  check uptime from olt ip
	 *
	 */
	public function getUptime($ip);

}