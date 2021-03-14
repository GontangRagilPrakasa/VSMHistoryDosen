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
		@if(in_array(Auth::User()->role, [5]))
            <li class="treeview {{ (Request::segment(2)=='identitas'?'active':'') }}">
                <a href="#">
                    <i class="fa fa-archive"></i> <span>Identitas Desa</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::segment(3)=='desa-kades'?'active':'') }}">
                        <a href="{{ url('admin-desa/identitas/desa-kades/') }}">
                            <i class="fa fa-circle-o"></i> <span>Kepala Desa</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='desa-wilayah'?'active':'') }}">
                        <a href="{{ url('admin-desa/identitas/desa-wilayah/') }}">
                            <i class="fa fa-circle-o"></i> <span>Kantor Desa</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='organisasi-desa'?'active':'') }}">
                        <a href="{{ url('admin-desa/identitas/organisasi-desa') }}">
                            <i class="fa fa-circle-o"></i> <span>Organisasi Desa</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ (Request::segment(2)=='demografi'?'active':'') }}">
                <a href="#">
                    <i class="fa fa-archive"></i> <span>Demografi Desa</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::segment(3)=='penduduk'?'active':'') }}">
                        <a href="{{ url('admin-desa/demografi/penduduk') }}">
                            <i class="fa fa-circle-o"></i> <span>Penduduk</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='kepala-keluarga'?'active':'') }}">
                        <a href="{{ url('admin-desa/demografi/kepala-keluarga') }}">
                            <i class="fa fa-circle-o"></i> <span>Kepala Keluarga</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='usia'?'active':'') }}">
                        <a href="{{ url('admin-desa/demografi/usia') }}">
                            <i class="fa fa-circle-o"></i> <span>Usia</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='pekerjaan'?'active':'') }}">
                        <a href="{{ url('admin-desa/demografi/pekerjaan') }}">
                            <i class="fa fa-circle-o"></i> <span>Jenis Pekerjaan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ ($controller=='Desa\GeografiController'?'active':'') }}">
                <a href="{{ url('admin-desa/geografi/') }}">
                    <i class="fa fa-archive"></i> <span>Geografi Desa</span>
                </a>
            </li>

            <li class="{{ ($controller=='Desa\IndexDesaController'?'active':'') }}">
                <a href="{{ url('admin-desa/idm/') }}">
                    <i class="fa fa-archive"></i> <span>Indeks Desa Membangun</span>
                </a>
            </li>

            <li class="treeview {{ (Request::segment(2)=='kesehatan'?'active':'') }}">
                <a href="#">
                    <i class="fa fa-archive"></i> <span>Kesehatan Desa</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::segment(3)=='sarana'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/sarana') }}">
                            <i class="fa fa-circle-o"></i><span>Sarana Kesehatan</span>
                        </a>
                    </li>
                     <li class="{{ (Request::segment(3)=='rumah-sakit'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/rumah-sakit') }}">
                            <i class="fa fa-circle-o"></i><span>Rumah Sakit</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='rumah-sakit-bersalin'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/rumah-sakit-bersalin') }}">
                            <i class="fa fa-circle-o"></i><span>Rumah Sakit Bersalin</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='puskesmas-inap'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/puskesmas-inap/') }}">
                            <i class="fa fa-circle-o"></i><span>Puskesmas Rawat Inap</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='puskesmas-tanpa-inap'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/puskesmas-tanpa-inap') }}">
                            <i class="fa fa-circle-o"></i><span>Puskesmas Tanpa Rawat Inap</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='puskesmas-pembantu'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/puskesmas-pembantu/') }}">
                            <i class="fa fa-circle-o"></i><span>Puskesmas Pembantu</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='dokter-praktek'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/dokter-praktek') }}">
                            <i class="fa fa-circle-o"></i><span>Tempat Praktek Dokter</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='poliklinik'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/poliklinik') }}">
                            <i class="fa fa-circle-o"></i><span>Poliklinik / Balai Pengobatan</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='bersalin'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/bersalin/') }}">
                            <i class="fa fa-circle-o"></i><span>Rumah Bersalin</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='bidan'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/bidan/') }}">
                            <i class="fa fa-circle-o"></i><span>Tempat Praktek Bidan</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='apotek'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/apotek/') }}">
                            <i class="fa fa-circle-o"></i> <span>Apotik</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='tenaga'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/tenaga') }}">
                            <i class="fa fa-circle-o"></i><span>Ketersediaan Tenaga Kesehatan</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='poskes'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/poskes') }}">
                            <i class="fa fa-circle-o"></i><span>Pos Kesehatan / Posyandu</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='peserta-bpjs'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/peserta-bpjs') }}">
                            <i class="fa fa-circle-o"></i><span>Kepesertaan BPJS/JKN/KIS</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='gizi-buruk'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/gizi-buruk') }}">
                            <i class="fa fa-circle-o"></i><span>Kesehatan & Gizi Buruk</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='sasaran-hpk'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/sasaran-hpk') }}">
                            <i class="fa fa-circle-o"></i><span>Sasaran 1.000 HPK</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='tikar-pertumbuhan'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/tikar-pertumbuhan') }}">
                            <i class="fa fa-circle-o"></i><span>Pertumbuhan Anak 0-2 Thn</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='hpk-bumil'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/hpk-bumil') }}">
                            <i class="fa fa-circle-o"></i><span>Konvergensi HPK Bumil</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='hpk-baduta'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/hpk-baduta') }}">
                            <i class="fa fa-circle-o"></i><span>Konvergensi HPK Anak 0-2 Thn</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(3)=='hpk-balita'?'active':'') }}">
                        <a href="{{ url('admin-desa/kesehatan/hpk-balita') }}">
                            <i class="fa fa-circle-o"></i><span>Konvergensi HPK Anak 2-6 Thn</span>
                        </a>
                    </li>
                </ul>
            </li>
            
		@endif
	</ul>
</section>