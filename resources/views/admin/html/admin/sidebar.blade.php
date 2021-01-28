<div class="menubar-fixed-panel">
	<div>
		<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
			<i class="fa fa-bars"></i>
		</a>
	</div>
	<div class="expanded">
		@if (isset($title_href))
			<a href="{{$title_href}}">
				<span class="text-lg text-bold text-primary">{{$title or '[$title]'}}</span>
			</a>
		@else
			{{ '<a href="[$title_href]">' }}
				<span class="text-lg text-bold text-primary">{{$title or '[$title]'}}</span>
			{{ '</a>'}}
		@endif
	</div>
</div>
<div class="menubar-scroll-panel">

	<!-- BEGIN MAIN MENU -->
	<ul id="main-menu" class="gui-controls">
		{!! $nav->render() !!}
	</ul>
	<!-- END MAIN MENU -->

	<div class="menubar-foot-panel">
		<small class="no-linebreak hidden-folded">
			<span class="opacity-75">Copyright &copy; 2014</span> <strong>Thunder.id</strong>
		</small>
	</div>
</div><!--end .menubar-scroll-panel-->
