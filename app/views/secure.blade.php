<HTML>
<HEAD>
</HEAD>
<BODY>

<H1>Esta es una zona restringida</H1>

<h3>{{ Auth::user()->email; }}</h3>
<h3>{{ Auth::user()->role; }}</h3>

<!-- LOGOUT BUTTON -->
	<a href="{{ URL::to('logout') }}">Logout</a>

</BODY>
</HTML>
