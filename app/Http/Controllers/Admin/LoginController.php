<?php namespace App\Http\Controllers\Admin;

use Input, Auth, Session, \Illuminate\Support\MessageBag;
use \App\APIConnector\API;

class LoginController extends BaseController {

	/**
	 * login form
	 *
	 * @return void
	 * @author 
	 **/
	function getLogin()
	{
		// page layout
		$this->html->section_body 				= view('admin.pages.login.index');

		$this->html->section_body->area_1		= view('admin.cards.common.alerts');
		
		$this->html->section_body->area_2 		= view('admin.cards.login.form')->with('card_class', 'style-transparent')
																				->with('title', 'Sign In')
																				->with('form_href', route('admin.login.post'))
																				->with('field_username', 'email')
																				->with('field_remember_me', 'remember');

		$this->html->section_body->area_3 		= view('admin.cards.login.forgot_password')->with('card_class', 'style-transparent')
																				->with('title', 'Sign In')
																				;
		// $this->html->page_layout->left_content 	= view('admin.html_blank.pages.login.form');
		// $this->html->page_layout->right_content = view('admin.html_blank.pages.login.description');



		// return view
		return $this->html;
	}

	/**
	 * handle login
	 *
	 * @return void
	 * @author 
	 **/
	function postLogin()
	{
		$credential = Input::only('email', 'password');
		if (Auth::attempt($credential))
		{
			return redirect()->route('admin.dashboard.overview');
		}
		else
		{
			return redirect()->back()->withErrors(new MessageBag(['Invalid Username & Password']));
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('admin.login');
	}
}
