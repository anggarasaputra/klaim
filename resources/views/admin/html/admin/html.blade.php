<html lang="en">
	<head>
		<title>{{$title}}</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="{{$meta['keywords'] or ''}}">
		<meta name="description" content="{{$meta['description'] or ""}}">

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700,800' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="{{ elixir('css/admin.css') }}" />
		@section('css')
		@show
		<!-- Additional CSS includes -->
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5shiv.js"></script>
		<script type="text/javascript" src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="header-fixed">

		<header id="header">
			{!! $topbar or '[$topbar]' !!}
		</header>

		<div id="base" class="menubar-hoverable">

			<div class="offcanvas">
			</div>

			<div id="content">
				<section>
					@if (!isset($section_title))
						<h1>[$section_title]</h1>
					@elseif ($section_title)
						<div class="section-header">
							<h1 class=''>
								{{$section_title or '[$section_title]'}} 
								<small>{{$section_subtitle or '[$section_subtitle]'}}</small> 
							</h1>
						</div><!--end .section-header -->
					@endif

					<div class="section-body contain-xl">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								{!! $section_body or '[$section_body]' !!}
							</div>
						</div>
					</div><!--end .section-body -->
				</section>
			</div>

			<div id="menubar" class='menubar-inverse'>
				{!! $sidebar or '[$sidebar]' !!}
			</div>

			<div class="offcanvas">
			</div>
		</div>

		<script src="{{elixir('js/admin.js')}}"></script>
		<script>
			$('.select2').select2();
			$('.select2-tags').select2({
				tags: [],
				tokenSeparators: [',', "'", '"', " "]

			});
		</script>

		@section('js')
		@show
	</body>
</html>