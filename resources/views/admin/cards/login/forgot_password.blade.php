@if (!isset($card_class))
	<div class='alert style-danger'>
		<p>
			<span class='text-xl text-bold text-default-dark'>[$card_class] required!</span>
			<br><i>$card_class is the class applied to card</i>
		</p>
	</div>
@else
	<div class='card {{$card_class or ""}}'>
		<div class='card-head'>
			<header><h1>Forgot Password?</h1></header>
		</div>
		<div class='card-body'>
			<p class='text-left'>Please contact your system administrator to retrieve your new password</p>		
		</div>
	</div>
@endif