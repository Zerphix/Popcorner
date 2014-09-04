<div id="topbar">

	<div class="center" id="nav">

		<div id="left_top_box">

			<div id="base_icon">

				<a href="../home"><img src="{{ asset('img/top_logo.png') }}"></a>
			</div>

			<div id="search_bar">

				{{ Form::open(array('url' => 'movies')) }}
					<input class="main_search" name="search" type="text" placeholder="Search for your favorites Movies">
				{{ Form::close() }}
			</div>
		</div>

		<div id="right_top_box">

			<div id="user_picture">

				<img src="../profiles/{{ Auth::user()->picture; }}">
			</div>

			<div id="options">

				<span class="username">

					<a class="username">{{ Auth::user()->first_name; }}</a>
				</span>

				<span class="username">

					<a class="logout" href="{{ URL::to('logout') }}">Logout</a>
				</span>
			</div>
		</div>
	</div>
</div>
