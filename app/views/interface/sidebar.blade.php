<div id="sidebar">

	<!-- <div id="sidebar_logo">

		<a href="/">

			<img id="popcorner_logo" src="{{ asset('img/sidebar_logo.png') }}">
		</a>
	</div> -->

	<div id="movs_tasks">

		<div id="home_task">

			<a class="option">MOVIE OPTIONS</a>
		</div>

		<div id="home_task">

			<img id="task" src="{{ asset('img/m_task.png') }}">

			<a class="task" href="../home">Home</a>
		</div>

		<div id="home_task">

			<img id="task" src="{{ asset('img/m_task.png') }}">

			<a class="task" href="../movies">Movie Catalog</a>
		</div>

		<div id="home_task">

			<img id="task" src="{{ asset('img/m_task.png') }}">

			<a class="task" href="../movies/popular">Popular Movies</a>
		</div>

		<div id="home_task">

			<img id="task" src="{{ asset('img/m_task.png') }}">

			<a class="task" href="../movies/lastest">Latest Movies</a>
		</div>

		<div id="home_task">

			<img id="task" src="{{ asset('img/m_task.png') }}">

			<a class="task" href="../movies/coming">Coming Movies</a>
		</div>
	</div>

		@if (Auth::user()->role !== 'popcorner')
		<div id="client_tasks">

			<div id="home_task">

				<a class="option">MOVIE TASKS</a>
			</div>

			<div id="home_task">

				<img id="task" src="{{ asset('img/m_task.png') }}">

				<a class="task" href="../create-movie">Create Movie</a>
			</div>
		</div>

		<div id="client_tasks">

			<div id="home_task">

				<a class="option">USER TASKS</a>
			</div>

			<div id="home_task">

				<img id="task" src="{{ asset('img/c_task.png') }}">

				<a class="task" href="../users">User List</a>
			</div>

			<div id="home_task">

				<img id="task" src="{{ asset('img/c_task.png') }}">

				<a class="task" href="../create-user">Create User</a>
			</div>
		</div>

		<div id="report_tasks">

			<div id="home_task">

				<a class="option">REPORT TASKS</a>
			</div>

			<div id="home_task">

				<img id="task" src="{{ asset('img/r_task.png') }}">

				<a class="task" href="">Rents by Date</a>
			</div>

			<div id="home_task">

				<img id="task" src="{{ asset('img/r_task.png') }}">

				<a class="task" href="">Rents by User</a>
			</div>
		</div>
	@endif
</div>
