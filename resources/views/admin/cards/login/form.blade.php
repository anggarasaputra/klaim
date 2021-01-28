@if (!isset($card_class))
	<div class='alert style-danger'>
		<p>
			<span class='text-xl text-bold text-default-dark'>[$card_class] required!</span>
			<br><i>$card_class is the class applied to card</i>
		</p>
	</div>
@elseif (!isset($title))
	<div class='alert style-danger'>
		<p>
			<span class='text-xl text-bold text-default-dark'>[$title] required!</span>
		</p>
	</div>
@elseif (!isset($form_href))
	<div class='alert style-danger'>
		<p>
			<span class='text-xl text-bold text-default-dark'>[$form_href] required!</span>
			<br><i>$form_href is for form action URL</i>
		</p>
	</div>
@elseif (!isset($field_username))
	<div class='alert style-danger'>
		<p>
			<span class='text-xl text-bold text-default-dark'>[$field_username] required!</span>
			<br><i>$field_username is for the credential field name (i.e. username/email)</i>
		</p>
	</div>
@elseif (!isset($field_remember_me))
	<div class='alert style-danger'>
		<p>
			<span class='text-xl text-bold text-default-dark'>[$field_remember_me] required!</span>
			<br><i>leave it empty to hide this field</i>
		</p>
	</div>
@else
	<div class='card {{$card_class or ""}}'>
		<div class='card-head'>
			<header><h1>{{$title}}</h1></header>
		</div>
		<div class='card-body'>
			<form class="form floating-label" action="{{$form_href}}" accept-charset="utf-8" method="post">
				<input type='hidden' name='_token' value="{{csrf_token()}}">
				<div class="form-group">
					<input type="text" class="form-control" id="{{$field_username}}" name="{{$field_username}}">
					<label for="{{$field_username}}">{{ucwords($field_username)}}</label>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password" name="password">
					<label for="password">Password</label>
				</div>
				<br/>
				<div class="row">
					<div class="col-xs-6 text-left">
						@if ($field_remember_me)
							<div class="checkbox checkbox-inline checkbox-styled">
								<label>
									<input type="checkbox" name='{{$field_remember_me}}'> <span>Remember me</span>
								</label>
							</div>
						@endif
					</div><!--end .col -->
					<div class="col-xs-6 text-right">
						<button class="btn btn-primary btn-raised" type="submit">Login</button>
					</div><!--end .col -->
				</div><!--end .row -->
			</form>
		</div>
	</div>

@endif
