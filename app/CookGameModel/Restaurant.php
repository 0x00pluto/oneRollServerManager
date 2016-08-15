<?php

namespace App\CookGameModel;

use App\Model\GameModel;

class Restaurant extends GameModel
{
	protected $table = 'restaurant';


	public function toViewData()
	{
		if (!$this->exists) {
			return [];
		}

		$arr = $this->attributes;

		$arr=array_except($arr,$this->getPublicExceptArray());
		//排除公用的排除数组中的元素

		//$arr=array_except($arr,['userid','_id','create_at']);
		//排除本类中不需要的元素

		foreach ($arr as $key => $value) {
			$arr [$key] = $this->getAttribute($key);
		}

		return $arr;
	}
}
