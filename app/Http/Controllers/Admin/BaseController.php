<?php namespace App\Http\Controllers\Admin;

use Auth; 
use \App\Http\Controllers\Controller;
use \ThunderID\Menu\MaterialAdminSideMenu;

abstract class BaseController extends Controller {

	protected $html;
	protected $per_page = 12;

	function __construct() 
	{
		if (Auth::user() && Auth::user()->id)
		{
			$this->html = view('admin.html.admin.html');

		// sidebar
			$nav = new MaterialAdminSideMenu();

			$nav->add('dashboard', 'Dashboard', 'javascript:;', 'md md-home');
			$nav->add('dashboard-overview', 'Overview', route('admin.dashboard.overview'), null, 'dashboard');

			$nav->add('Business', 'Business', 'javascript:;', 'md md-business');
			$nav->add('vendor', 'Vendor', route('admin.vendor.index'), null, 'Business');

			$nav->add('clients', 'Clients', 'javascript:;', 'md md-people');
			$nav->add('Customers', 'Customers', 'javascript:;', null, 'clients');
			$nav->add('Claims', 'Claims', 'javascript:;', null, 'clients');

			$nav->add('Settings', 'Settings', 'javascript:;', 'md md-settings');
			$nav->add('Users', 'Users', 'javascript:;', null, 'Settings');
			$nav->add('Authentication', 'Authentication', 'javascript:;', null, 'Settings');

			// topbar
			$this->html->topbar = view('admin.html.admin.topbar');
			$this->html->topbar->title = 'CONTROL PANEL';
			$this->html->topbar->title_href = route('admin.dashboard.overview');

			// sidebar
			$this->html->sidebar = view('admin.html.admin.sidebar')->with('nav', $nav);
		}
		else
		{
			$this->html = view('admin.html.blank.html');
		}

		$this->html->title = 'GANTIRUGI.com';
	}
}
