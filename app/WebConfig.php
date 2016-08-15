<?php

namespace App;

use App\Model\Model;

class WebConfig extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'menuname',
			'menuurl',
			'menuindex'
	];
}
