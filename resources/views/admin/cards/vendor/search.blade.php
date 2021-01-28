<?php 
	$widget_name = 'Vendor/search';
	$required = [
					'card_class', 
					'card_header_class', 
					'card_body_class', 
					'search_href',
					'search_field',
					'search_query',
					'create_href',
					'current_page', 
					'count_per_page', 
					'show_pagination',
					'pagination_path',
					'data'
				];
	$errors = [];
?>

@foreach ($required as $x)
	@if (!isset($$x))
		<?php $errors[] = $x; ?>
	@endif
@endforeach 

@if (count($errors))
	<div class='alert style-danger'>
		<span class='text-lg  text-default-dark'>Widget: {{$widget_name}}</span>
		<ul>Please set:
			@foreach ($errors as $x)
				<li class='text-bold'>[${{$x}}]</li>
			@endforeach
		</ul>
	</div>
@else
	<div class="card {{$card_class}}">

		<!-- BEGIN SEARCH HEADER -->
		<div class="card-head  {{$card_header_class}}">
			<div class="tools pull-left">
				{!! Form::open(['url' => $search_href, 'class' => 'navbar-search', 'role' => 'search', 'method' => 'GET']) !!}
					<div class="form-group">
						<input class="form-control" name="{{$search_field}}" placeholder="Enter your keyword" type="text">
					</div>
					<button type="submit" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-search"></i></button>
				{!! Form::close() !!}
			</div>
			<div class="tools">
				<a class="btn btn-floating-action btn-default-bright" href="{{$create_href}}"><i class="fa fa-plus"></i></a>
			</div>
		</div>
		<!-- END SEARCH HEADER -->

		<!-- BEGIN SEARCH RESULTS -->
		<div class="card-body {{$card_body_class}}">
			<div class="row">
				<!-- BEGIN SEARCH NAV -->
				<div class="hidden-xs col-sm-4 col-md-3 col-lg-2">

					@include('admin.cards.vendor.simple_list', [
																		'card_class'			=>  'style-transparent no-padding',
																		'card_header_class'		=>  'text-light text-default-light',
																		'card_header_text_class'=>  'text-sm',
																		'card_header'			=>  'LATEST UPDATED',
																		'card_body_class'		=>  'no-padding',
																		'detail_route'			=>  'admin.vendor.show',
																		'current_page'			=>  1,
																		'count_per_page'		=>  10,
																		'order_by'				=>  'updated_at',
																		'order_mode'			=>  'desc',
																		'show_pagination'		=>  false,
																		'data'					=>  null,
					])
				</div><!--end .col -->
				<!-- END SEARCH NAV -->

				<div class="col-sm-8 col-md-9 col-lg-10">
					
						<!-- BEGIN SEARCH RESULTS LIST -->
						<div class="margin-bottom-xxl">
							<span class="text-light text-lg">Filtered results <strong>34</strong></span>
							<div class="btn-group btn-group-sm pull-right">
								<button type="button" class="btn btn-default-light dropdown-toggle" data-toggle="dropdown">
									<span class="glyphicon glyphicon-arrow-down"></span> Sort
								</button>
								<ul class="dropdown-menu dropdown-menu-right animation-dock" role="menu">
									<li><a href="#">First name</a></li>
									<li><a href="#">Last name</a></li>
									<li><a href="#">Email address</a></li>
								</ul>
							</div>
						</div><!--end .margin-bottom-xxl -->
						<div class="list-results">
							@foreach ($data as $x)
								<div class="col-xs-12 col-lg-6 hbox-xs">
									<div class="hbox-column width-2">
										@if ($x->logo)
											<img class="img-circle img-responsive pull-left" src="http://www.codecovers.eu/assets/img/modules/materialadmin/avatar9.jpg?1422538626" alt="">
										@else
											<img class="img-circle img-responsive pull-left" src="http://placehold.it/200x200" alt="">
										@endif
									</div><!--end .hbox-column -->
									<div class="hbox-column v-top">
										<div class="clearfix">
											<div class="col-lg-12 margin-bottom-lg">
												<a class="text-lg text-medium" href="http://www.codecovers.eu/materialadmin/pages/contacts/details">{{$x->name}}</a>
											</div>
										</div>
										<div class="clearfix opacity-75">
											<div class="col-md-5">
												<span class="glyphicon glyphicon-phone text-sm"></span> &nbsp;{{$x->phone}}
											</div>
											<div class="col-md-7">
												<span class="glyphicon glyphicon-envelope text-sm"></span> &nbsp;{{$x->email}}
											</div>
										</div>
										<div class="clearfix">
											<div class="col-lg-12">
												<span class="opacity-75"><span class="glyphicon glyphicon-map-marker text-sm"></span> &nbsp;{{$x->address}}</span>
											</div>
										</div>
										<div class="stick-top-right small-padding">
											@if ($x->active)
												<i class="fa fa-dot-circle-o fa-fw text-success" data-toggle="tooltip" data-placement="left" data-original-title="Active Vendor"></i>
											@else
												<i class="fa fa-dot-circle-o fa-fw text-danger" data-toggle="tooltip" data-placement="left" data-original-title="Inactive Vendor"></i>
											@endif
										</div>
									</div><!--end .hbox-column -->
								</div><!--end .hbox-xs -->
							@endforeach
						</div><!--end .list-results -->
						<!-- BEGIN SEARCH RESULTS LIST -->

						<!-- BEGIN SEARCH RESULTS PAGING -->
						<div class="text-center">
							{!! $paginator->render() !!}
						</div><!--end .text-center -->
						<!-- BEGIN SEARCH RESULTS PAGING -->
					</div><!--end .col -->
			</div><!--end .row -->
		</div><!--end .card-body -->
		<!-- END SEARCH RESULTS -->

	</div>
@endif