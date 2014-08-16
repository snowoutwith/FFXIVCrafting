<!DOCTYPE html>
<html lang='en-us'>
	<head>
		<meta http-equiv='X-UA-Compatible' content='IE=Edge'>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title>Crafting as a Service | Final Fantasy XIV ARR Crafting Information</title>
		<meta name='description' content='Final Fantasy XIV ARR Crafting Information and Planning'>
		<meta name='keywords' content=''

		<meta charset='utf-8'>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>

		<link href='{{ cdn('/css/bootstrap.css') }}' rel='stylesheet' />
		<link href='{{ cdn('/css/bootstrap-theme.min.css') }}' rel='stylesheet' />
		{{-- DO NOT HOST ON CDN --}}<link href='/css/local.css' rel='stylesheet' />{{-- /DO NOT HOST ON CDN --}}

		@section('vendor-css')
		@show

		<link href='{{ cdn('/css/global.css') }}' rel='stylesheet' />

		<!-- New Theme, woot woot! -->
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
		<link href='{{ cdn('/css/theme.css') }}' rel='stylesheet' />

		@section('css')
		@show

		@if(Config::get('app.debug'))
		<style type='text/css'>@media(min-width: 768px) { #copyright-info { padding-bottom: 48px; } } @media(max-width: 767px) { .anbu { display: none !important; } }</style>
		@endif
	</head>
	<body>

		<input type='checkbox' id='nav-handler'>

		{{-- MOBILE MENU ONLY --}}
		<nav id='mobile-nav'>
			<div class='header-bar'>
				<div class="container">
					<ul>
						<li>
							<label id='mobile-menu-button' for='nav-handler'>
								Close Menu
							</label>
						</li>
					</ul>
				</div>
			</div>
			<div class="container navbox">
				<ul class='nav navbar-nav'>

					<li>
						<a href="/list"{{ isset($active) && $active == 'list' ? ' class="active"' : '' }}>
							<img src="/img/icons/bag.png">
							<span>Crafting List</span>
						</a>
					</li>

					<li>
						<a href="#"{{ isset($active) && $active == 'account' ? ' class="active"' : '' }}>
							<img src="/img/icons/account.png">
							<span>Account</span>
						</a>
					</li>
					
					<li>
						<hr>
					</li>

					{{-- See /app/helpers.php for menu_item() function --}}
					{{ menu_item('/',			'Home',			'home'		) }}
					{{ menu_item('/equipment',	'Equipment',	'equipment'	) }}
					{{ menu_item('/crafting',	'Crafting',		'crafting'	) }}
					{{ menu_item('/career',		'Career',		'career'	) }}
					{{ menu_item('/recipes',	'Recipe Book',	'recipes'	) }}
					{{ menu_item('/quests',		'Quests',		'quests'	) }}
					{{ menu_item('/leve',		'Leves',		'leves'		) }}
					{{ menu_item('/stats',		'Stats',		'stats'		) }}
					{{ menu_item('/materia',	'Materia',		'materia'	) }}
					{{ menu_item('/food',		'Food',			'food'		) }}

					<li>
						<hr>
					</li>

					@foreach(Config::get('site.full_languages') as $slug => $language)
					<?php if ($slug == Config::get('language')) continue; ?>
					<li>
						<a tabindex='-1' href='http://{{ ($slug != 'en' ? $slug . '.' : '') . Config::get('language_base_url') }}'>
							<img src="/img/icons/flags/{{ $slug }}.png"> {{ $language }}
						</a>
					</li>
					@endforeach
				</ul>

			</div>
		</nav>

		<main id='main-container'>
			<header id='main-header'>
				<div id="account">
					<div class="container">
						<ul class='hidden-xs'>
							<li class='language-selector dropdown'>
								<a href="#" class='dropdown-toggle' data-toggle='dropdown'>
									<img src="/img/icons/flags/{{ Config::get('language') }}.png">
									<span>{{ Config::get('site.full_languages')[Config::get('language')] }}</span>
								</a>
								<ul class='dropdown-menu' role='menu'>
									@foreach(Config::get('site.full_languages') as $slug => $language)
									<?php if ($slug == Config::get('language')) continue; ?>
									<li>
										<a tabindex='-1' href='http://{{ ($slug != 'en' ? $slug . '.' : '') . Config::get('language_base_url') }}'>
											<img src="/img/icons/flags/{{ $slug }}.png"> {{ $language }}
										</a>
									</li>
									@endforeach
								</ul>
							</li>
							<li>
								<a href="#"{{ isset($active) && $active == 'account' ? ' class="active"' : '' }}>
									<img src="/img/icons/account.png">
									<span>Account</span>
								</a>
							</li>
							<li>
								<a href="/list"{{ isset($active) && $active == 'list' ? ' class="active"' : '' }}>
									<img src="/img/icons/bag.png">
									<span>Crafting List</span>
								</a>
							</li>
						</ul>
						<ul class='visible-xs'>
							<li>
								<label id='mobile-menu-button' for='nav-handler'>
									<img src="/img/reward.png" width='12' height='12'>
									<span>Menu</span>
								</label>
							</li>
						</ul>
					</div>
				</div>
				<div id="header">
					<div class='navbar'>
						<div class='container'>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-lg-3 logo">
									<!-- /f7f7f7/e2e2e2 -->
									<img src="http://placehold.it/280x80" class="img-responsive" width='280' height='80'>
								</div>
								<div class="col-xs-12 col-sm-8 col-lg-9 menu-navbar">
									<div class='navbar-header'>
									</div>
									<div class='collapse navbar-collapse'>
										<ul class='nav navbar-nav'>
											{{-- See /app/helpers.php for menu_item() function --}}
											{{ menu_item('/',			'Home',			'home'		) }}
											{{ menu_item('/equipment',	'Equipment',	'equipment'	) }}
											{{ menu_item('/crafting',	'Crafting',		'crafting'	) }}
											{{ menu_item('/career',		'Career',		'career'	) }}
											{{ menu_item('/recipes',	'Recipe Book',	'recipes'	) }}
											{{ menu_item('/quests',		'Quests',		'quests'	) }}
											{{ menu_item('/leve',		'Leves',		'leves'		) }}
											<li class='dropdown{{ isset($active) && in_array($active, array('stats', 'materia', 'food')) ? ' active' : '' }}'>
												<a href='#' class='dropdown-toggle' data-toggle="dropdown">Resources <b class='caret'></b></a>
												<ul class='dropdown-menu dropdown-menu-right'>
													<li{{ isset($active) && $active == 'stats' ? ' class="active"' : '' }}><a href='/stats'>Stats</a></li>
													<li{{ isset($active) && $active == 'materia' ? ' class="active"' : '' }}><a href='/materia'>Materia</a></li>
													<li{{ isset($active) && $active == 'food' ? ' class="active"' : '' }}><a href='/food'>Food</a></li>
												</ul>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<section id='content-container'>
				<div id="banner">
					<div class="container">
						@yield('banner')
					</div>
				</div>

				<div id="content">
					@yield('precontent')

					<div class='container'>

						@yield('content')

					</div>
				</div>

				<div id='footer'>
					<div class='container'>

						<div class="row">
							<div class="col-sm-3">
								<p class="headline">Recent News</p>

								<?php $wardrobe = new \Wardrobe\Core\Repositories\DbPostRepository(); ?>
								@foreach($wardrobe->active(3) as $post)
									<div class="post">
										<div class="title">
											<a href="/blog/post/{{{ $post->slug }}}">{{ $post->title }}</a>
										</div>
										<div class="date">
											<img src="/img/icons/time.png"><span>{{ date("M d, Y", strtotime($post->publish_date)) }}</span>
											<?php /*by <span class='who'>{{ $post->user->first_name }} {{ $post->user->last_name }}</span> */ ?>
										</div>
										<hr>
									</div>
								@endforeach

								<p class="view-all"><a href="/blog/">View All Recent News</a></p>
							</div>
							<div class="col-sm-3">
								<p class="headline">Current Patch</p>
								<img src="/img/current_patch.png" class="img-responsive">
								<p>This site has been optimzed for Patch 2.3 Defenders of Eorzea</p>
							</div>
							<div class="col-sm-3">
								<p class="headline">Donations</p>
								<p>I've spent more time building this site than actually playing. Help me relax and show my wife this isn't just a hobby!</p>
								<p class="view-all"><a href="#buymeabeer">Donate Today!</a></p>
							</div>
							<div class="col-sm-3">
								<p class="headline">Other Links</p>

								<p><a href="mailto:tickthokk@gmail.com">Contact Me</a></p>
								<hr>
								<p><a href="/report">Report a bug</a></p>
								<hr>
								<p><a href="http://na.finalfantasyxiv.com/lodestone/character/2859264/">My Character</a></p>
								<hr>
								<p><a href="http://ffxivclock.com/">FFXIV Clock</a></p>
								<hr>
								<p><a href="http://www.reddit.com/r/ffxivcrafting">Subreddit</a></p>
								<hr>
								<p><a href="/credits">Source Credits &amp; Resources</a></p>
							</div>
						</div>
					</div>
				</div>
				<div id="copyright-info">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-8">
								2014 FFXIV - Crafting as a Service. FINAL FANTASY is a registered trademark of Square Enix Holdings Co., Ltd.
							</div>
							<div class="col-xs-12 col-sm-4 text-right">
								<a href="#">Back To Top<span class="glyphicon glyphicon-chevron-up"></span></a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>

		<div id='notifications'></div>

		<!-- jQuery -->
		<script src='{{ cdn('/js/jquery-2.0.3.min.js') }}'></script>
		<script src='//code.jquery.com/ui/1.10.3/jquery-ui.js'></script>

		<script src='{{ cdn('/js/bootstrap.min.js') }}' type='text/javascript'></script>

		<script src='{{ cdn('/js/noty.js') }}' type='text/javascript'></script>
		<script src='{{ cdn('/js/noty-bottomCenter.js') }}' type='text/javascript'></script>
		<script src='{{ cdn('/js/noty-theme.js') }}' type='text/javascript'></script>

		<script src='{{ cdn('/js/viewport.js') }}' type='text/javascript'></script>

		<script src='{{ cdn('/js/global.js') }}' type='text/javascript'></script>

		@section('javascript')
		@show

		<script type='text/javascript'>
			if (typeof(xivdb_tooltips) === 'undefined')
				var xivdb_tooltips = 
				{ 
					"language"      : "{{ strtoupper(Config::get('language') == 'ja' ? 'jp' : Config::get('language')) }}",
					"frameShadow"   : true,
					"compact"       : false,
					"statsOnly"     : false,
					"replaceName"   : false,
					"colorName"     : true,
					"showIcon"      : false,
				} 
		</script>
		<script type='text/javascript' src='http://xivdb.com/tooltips.js'></script>

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-43830923-1', 'craftingasaservice.com');
			ga('send', 'pageview');
		</script>
	</body>
</html>