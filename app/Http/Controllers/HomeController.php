<?php namespace App\Http\Controllers;

use App\Page;

class HomeController extends Controller {
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home')->withPages(Page::all());
	}

}
