<?php

namespace Digi\Helpers;

class Helper{
	
	public static function checkRequiredParameters($array, $params)
	{
		foreach($params as $param)
		{
			if(!isset($array[$param]) || $array[$param] == '' || $array[$param] == null)
			{
				return array('result' => 'error', 'message' => "Missing required parameter '$param'.");
			}
		}
		return array("result" => "success");
	}
}