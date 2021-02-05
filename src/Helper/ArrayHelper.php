<?php

namespace App\Service;

class ArrayHelper
{
	public function searchThroughArray($search,array $lists)
	{
	    try{
	        foreach ($lists as $key => $value) {
	            if(is_array($value)){
	                array_walk_recursive($value, function($v, $k) use($search ,$key,$value,&$val){
	                    if(strpos($v, $search) !== false )  $val[$key]=$value;
						});
					}else{
						if(strpos($value, $search) !== false )  $val[$key]=$value;
					}
			}
					return $val;
			}catch (Exception $e) {
					return false;
			}
	}

	public function pushToArray($array, $value)
	{
		return array_push($array,$value);
	}

	public function randArray($array)
    {
        $rand_keys = array_rand($array, 3);
    }
}
