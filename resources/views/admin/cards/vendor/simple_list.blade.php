<?php 
	$widget_name = 'Vendor/simple_list';
	$required = [
					'show_pagination',
					'card_class', 
					'card_header_class', 
					'card_header_text_class',
					'card_body_class', 
					'card_header', 
					'detail_route',
					'current_page', 
					'count_per_page',
					'order_by',
					'order_mode', 
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
		@if ($card_header)
			<div class="card-head {{$card_header_class}}">
				<header><span class="{{$card_header_text_class}}">{{$card_header}}</span></header>
			</div>
		@endif
		<div class="card-body {{$card_body_class}}">
			<ul class='nav nav-pills nav-stacked'>
				@foreach ($data as $x)
					<li>
						<a href="{{route($detail_route, ['id' => $x->id])}}">
							@if ($x->image)
								<img class="img-circle img-responsive pull-left width-1" src="{{$x->logo}}" alt="">
							@else
								<img class="img-circle img-responsive pull-left width-1" src="http://placehold.it/200x200" alt="">
							@endif
							<span class="text-medium">{{$x->name}}</span><br>
							<span class="opacity-50">
								<span class="glyphicon glyphicon-phone text-sm"></span> &nbsp;{{$x->phone}}
							</span>
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif
