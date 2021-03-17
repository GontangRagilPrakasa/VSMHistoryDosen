<?php
	$currentAction = Route::currentRouteAction();
	list($controller, $method) = explode('@', $currentAction);
	$controller = str_replace("App\\Http\\Controllers\\", "", $controller);
?>
<section class="sidebar">
	<ul class="sidebar-menu" data-widget="tree">
		<li class="header">MAIN NAVIGATION</li>
		<li class="{{ ($controller=='DashboardController'?'active':'') }}">
			<a href="{{ url('dashboard') }}">
			<i class="fa fa-dashboard"></i> <span>Dashboard</span>
			</a>
		</li>
			
		<!-- seller eks -->
		@if(in_array(Auth::User()->role, [1]))


            <li class="{{ ($controller=='AdminDesaController'?'active':'') }}">
                <a href="{{ url('admin') }}">
                    <i class="fa fa-user"></i> <span>Admin Desa</span>
                </a>
            </li>
		@endif

		<!-- driver seller eks -->
		@if(in_array(Auth::User()->role, [2]))
            <li class="{{ ($controller=='DosenController'?'active':'') }}">
                <a href="{{ url('dosen/penelitian') }}">
                    <i class="fa fa-archive"></i> <span>Tambah Data Tesis</span>
                </a>
            </li>
            <li class="{{ ($controller=='DosenController'?'active':'') }}">
                <a href="{{ url('dosen/mahasiswa') }}">
                    <i class="fa fa-archive"></i> <span>Daftar Mahasiswa Skripsi</span>
                </a>
            </li>
            
		@endif

        <!-- driver seller eks -->
		@if(in_array(Auth::User()->role, [3]))
            <li class="{{ ($controller=='MahasiswaController'?'active':'') }}">
                <a href="{{ url('mahasiswa/skripsi-form') }}">
                    <i class="fa fa-archive"></i> <span>Form Ajuan Skripsi</span>
                </a>
            </li>
            
		@endif
	</ul>
</section>