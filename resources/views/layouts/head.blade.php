<nav class="navbar navbar-default">
		<div class="container">
				<div class="navbar-header">
						<a class="navbar-brand" href="#">Cursos Uai</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="{{ Request::is('/') ? 'active' : '' }}">
								<a href="{{ url('/') }}">Home</a>
							</li>
							<li class="{{  Request::segment(1) === 'professors' ? 'active' : '' }}">
								<a href="{{ url('professors') }}">Profesores</a>
							</li>
							<li class="{{  Request::segment(1) === 'courses' ? 'active' : '' }}">
								<a href="{{ url('courses') }}">Cursos</a>
							</li>
						</ul>
				</div><!--/.nav-collapse -->
		</div>
</nav>
