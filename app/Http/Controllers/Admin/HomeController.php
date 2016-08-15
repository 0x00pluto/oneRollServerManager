<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WebConfig;
use Illuminate\Database\Eloquent\Model;

class HomeController extends Controller {
	//
	function __construct() {
		$this->middleware ( 'auth' );
	}
	public function home() {
// 		$menu = WebConfig::create ( [
// 				'menuname' => 'a',
// 				'menuurl' => '/a/a',
// 				'menuindex' => - 1
// 		] );
// 		$menu->aaaa = 'aaa';
// 		$menu->save();

		$user = Auth::user ();
		// dump ( $user->name );
		return view ( 'home', [
				'user' => $user,
				'sidebar_menus'
		] );
	}
}
