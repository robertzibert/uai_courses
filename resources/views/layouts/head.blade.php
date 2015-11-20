<nav class="navbar navbar-default">
		<div class="container">
				<div class="navbar-header">
						<a class="navbar-brand" href="#">Cursos Uai</a>
				</div>

				@if(Auth::check())
				<div id="navbar" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="{{ Request::is('dashboard') ? 'active' : '' }}">
								<a href="{{ url('/dashboard') }}">Dashboard</a>
							</li>
							<li class="{{  Request::segment(1) === 'professors' ? 'active' : '' }}">
								<a href="{{ url('professors') }}">Profesores</a>
							</li>
							<li class="{{  Request::segment(1) === 'courses' ? 'active' : '' }}">
								<a href="{{ url('courses') }}">Cursos</a>
							</li>

						@if(Auth::user()->role->name == 'Administrador')
							<li class="{{  Request::segment(1) === 'users' ? 'active' : '' }}">
								<a href="{{ url('users') }}">Usuarios</a>
							</li>
						@endif
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->email}}<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="/auth/logout">Log Out</a></li>
								</ul>
			 </li>
		 </ul>

				</div><!--/.nav-collapse -->

				@endif
		</div>
</nav>
