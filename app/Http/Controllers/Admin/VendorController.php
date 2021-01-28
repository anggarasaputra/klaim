<?php namespace App\Http\Controllers\Admin;

use \App\Vendor as Model;
use \App\Commands\UploadFile;
use \App\APIConnector\API;
use Illuminate\Pagination\LengthAwarePaginator;
use Input, Session, Request;

class VendorController extends BaseController {

	protected $title = 'vendor';

	function __construct(Model $model) 
	{
		parent::__construct();

		$this->model = $model;
	}
	
	function getIndex()
	{
		// ---------------------- PROCESS INPUT ----------------------
		$current_page = Input::has('page') ? max(1,Input::get('page')) : 1;

		// ---------------------- GENERATE VIEW: PAGE LAYOUT (CONTENT) ----------------------
		$this->html->section_title 							= ucwords(str_plural($this->title));
		$this->html->section_subtitle 						= '';

		// section body
		$this->html->section_body							= view('admin.pages.'.$this->title.'.index');
		$this->html->section_body->area_1					= view('admin.cards.'.$this->title.'.search')
																		->with('card_class', '')
																		->with('card_header_class', 'style-primary')
																		->with('card_body_class', '')
																		->with('search_href', Request::url())
																		->with('search_field', 'q')
																		->with('search_query', Input::has('q') ? Input::get('q') : '')
																		->with('create_href', route('admin.' . $this->title . '.create'))
																		->with('current_page', $current_page)
																		->with('count_per_page', $this->per_page)
																		->with('order_by', 'name')
																		->with('order_mode', 'asc')
																		->with('show_pagination', true)
																		->with('pagination_path', Request::url())
																		;


		$this->html->section_body->area_2					= '';
		$this->html->section_body->area_3					= '';

		// $this->html->page_layout						= view('admin.html_admin.page_layout.list');
		// $this->html->page_layout->title				= strtoupper(str_plural($this->title));
		// $this->html->page_layout->subtitle			= '';


		// $this->html->page_layout->search_form				= view('admin.html_admin.pages.vendor.pages.index.search_form')->with('title', $this->title);
		// $this->html->page_layout->actions					= view('admin.html_admin.pages.vendor.pages.index.action')->with('title', $this->title);
		// $this->html->page_layout->sidebar					= view('admin.html_admin.pages.vendor.pages.index.sidebar');
		// $this->html->page_layout->contents					= view('admin.html_admin.pages.vendor.pages.index.contents')->with('title', $this->title);
		// $this->html->page_layout->filter					= Input::has('q') ? "FILTER: " . Input::get('q') : "ALL " . $this->html->title;

		// ---------------------- RETURN LAYOUT ----------------------
		return $this->html;
	}

	function getCreate($id = null)
	{
		// ---------------------- LOAD DATA ----------------------
		if (!is_null($id))
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// Load country list
		$filename = base_path('/resources/data/countries.json');
		$fd = fopen($filename, 'r');
		$json = json_decode(fread($fd, filesize($filename)));
		fclose($fd);

		$country_list = [];
		foreach ($json as $country)
		{
			$tmp = json_decode($country);
			$country_list[$country] = $country;
		}
	
		// ---------------------- GENERATE CONTENT ----------------------
		$this->layout->page_title = strtoupper($this->title);

		$this->layout->content = view('admin.'.$this->title.'.create');
		$this->layout->content->title = $this->title;
		$this->layout->content->data = $data;
		$this->layout->content->country_list = $country_list;

		return $this->layout;
	}

	function postStore($id = null)
	{
		// ---------------------- LOAD DATA ----------------------
		if (!is_null($id))
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// ---------------------- HANDLE INPUT ----------------------
		$input = Input::all();
		$input['contact_person']['name'] = Input::get('contact_person_name');
		$input['contact_person']['phone'] = Input::get('contact_person_phone');
		$input['contact_person']['email'] = Input::get('contact_person_email');

		$input['address']['street'] = Input::get('address_street');
		$input['address']['city'] = Input::get('address_city');
		$input['address']['province'] = Input::get('address_province');
		$input['address']['country'] = Input::get('address_country');

		if ($logo_path = $this->dispatch(new UploadFile('logo', 'uploaded/vendors/logo/'.date('Y/m/d/H'))))
		{
			$input['logo'] = $logo_path;
		}
		$data->fill($input);

		if ($data->save())
		{
			return redirect()->route('admin.' . $this->title . '.index')->with('alert_success', ucwords($this->title) . ' "' . $data->name . '" has been saved');
		}
		else
		{
			return redirect()->back()->withInput()->withErrors($data->getErrors());
		}
	}

	function getShow($id)
	{
		// ---------------------- LOAD DATA ----------------------
		if (!is_null($id))
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			$data = $this->model->newInstance();
		}

		// ---------------------- GENERATE CONTENT ----------------------
		$this->layout->page_title = strtoupper($this->title);

		$this->layout->content = view('admin.'.$this->title.'.show');
		$this->layout->content->title = $this->title;
		$this->layout->content->data = $data;

		return $this->layout;
	}

	function getDelete($id)
	{
		// ---------------------- LOAD DATA ----------------------
		if (!is_null($id))
		{
			$data = $this->model->findorfail($id);
		}
		else
		{
			App::abort(404);
		}
		
		if (str_is('Delete', Input::get('type2confirm')))
		{
			if ($data->delete())
			{
				return redirect()->route('admin.'.$this->title.'.index')->with('alert_success', 'Data "' . $data->name . '" has been deleted');
			}
			else
			{
				return redirect()->back()->withErrors($data->getErrors());
			}
		}
		else
		{
			return redirect()->back()->with('alert_danger', 'Invalid delete confirmation text');
		}
	}
}
