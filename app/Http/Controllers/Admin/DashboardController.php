<?php namespace App\Http\Controllers\Admin;

class DashboardController extends BaseController {

	/**
	 * login form
	 *
	 * @return void
	 * @author 
	 **/
	function getOverview()
	{
		// HTML
		$this->html->section_title = 'Dashboard';
		$this->html->section_subtitle = 'Overview';

		// PAGE LAYOUT
		$this->html->section_body = view('admin.pages.dashboard.overview');

		// RETURN VIEW
		return $this->html;
	}
}
