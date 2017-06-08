<?php

namespace OngSystem\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$title = 'Dashboard';
		if (\Auth::user()->hasRole('teacher')) {
			$subject = getSubjectsByTeacher();
			$nextTests = getNextTests();
			return view('dashboard.teacher', compact('subject', 'nextTests', 'title'));
		} elseif (\Auth::user()->hasRole('employee') or \Auth::user()->hasRole('root')) {
			return view('dashboard.employee', compact('title'));
		}
	}
}
