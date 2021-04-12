<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(Request $request) {
		//return view('homeUser');
		//$request->user()->authorizeRoles(['user', 'admin']);
		//user()->authorizeRoles(['user', 'admin']);
		// if ($request->user()->authorizeRoles('admin')) {
		// 	return 'Good Admin';
		// }
		//return view('home');
		//dd("aaaa");
		if ($request->user()->authorizeRoles('user')) {
			//dd('MAL1');
			return view('homeUser');
		}
		if ($request->user()->authorizeRoles('admin')) {
			return view('homeAdmin');
		}
		//dd('MAL');
	}
	public function someAdminStuff(Request $request) {
		$request->user()->authorizeRoles('admin');
		return 'Good Admin';
	}
}