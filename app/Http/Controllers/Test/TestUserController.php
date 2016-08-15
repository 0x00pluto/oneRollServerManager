<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\UserTestModel;
use Illuminate\Database\Eloquent\Model;

class TestUserController extends Controller {
	function __construct() {
		// $this->middleware ( 'auth' );
	}
	function testA($id) {
		// dump ( 'here1' . $id );

		// dump ( action ( 'Test\TestUserController@testA' ) );

		// $data = new UserTestModel ();

		// $data->testint = 2;
		// $data->save ();

		// dump ( UserTestModel::all () );
		return view ( 'userinfo', [
				'name' => 'aaa<br/>'
		] );
	}
}