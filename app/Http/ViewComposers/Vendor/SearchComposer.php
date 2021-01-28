<?php namespace App\Http\ViewComposers\Vendor;

use Illuminate\Contracts\View\View;
use Input, Request, Validator, Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Vendor as Model;


class SearchComposer {

	protected $model;

	/**
	 * Create a new profile composer.
	 *
	 * @param  UserRepository  $users
	 * @return void
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		// LATEST VENDOR
		if (!isset($view->data))
		{
			// input
			$input['current_page'] 		= $view->current_page;
			$input['count_per_page'] 	= $view->count_per_page;
			$input['order_by'] 			= $view->order_by;
			$input['order_mode'] 		= $view->order_mode;

			// rules
			$rules['current_page']		= 'numeric|min:1';
			$rules['count_per_page']	= 'numeric|min:1|max:100';
			$rules['order_by']			= 'required|in:name,created_at,updated_at';
			$rules['order_mode']		= 'required|in:asc,desc';

			$validator = Validator::make($input, $rules);

			if ($validator->fails())
			{
				throw new Exception($validator->messages()->__toString());
			}

			// -------------------------------- QUERY --------------------------------
			$data 	= $this->model->name()
										->skip(($input['current_page'] - 1) * $input['count_per_page'])
										->take($input['count_per_page'])
										->orderBy($input['order_by'], $input['order_mode'])
										->orderBy('id', $input['order_mode'])
										->get();
			$view->with('data', $data);

			// -------------------------------- PAGINATION --------------------------------
			if ($view->show_pagination)
			{
				if (!isset($view->pagination_path))
				{
					throw new Exception("Please set the $pagination_path");
				}

				$count = $this->model->name()->count();
				$paginator = new LengthAwarePaginator($data, $count, $input['count_per_page'], $input['current_page'], ['path' => $view->pagination_path, 'query' => ['q' => $view->search]]);
				$view->with('paginator', $paginator);
			}
			
		}
	}

}