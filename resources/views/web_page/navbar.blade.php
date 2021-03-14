@php
$segment = Request::segment(1);
$desa_id = $desa->desa_id;
@endphp
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link {{ $segment == 'indentitas-desa' ? 'active' : '' }}" href="{{ url('indentitas-desa') .'/'. $desa_id }}">IDENTITAS DESA</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $segment == 'geografi-desa' ? 'active' : '' }}" href="{{ url('geografi-desa') .'/'. $desa_id }}">GEOGRAFI</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $segment == 'demografi-desa' ? 'active' : '' }}" href="{{ url('demografi-desa') .'/'. $desa_id }}">DEMOGRAFI</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $segment == 'idm-desa' ? 'active' : '' }}" href="{{ url('idm-desa') .'/'. $desa_id }}">PROGRESS IDM</a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ $segment == 'kesehatan-desa' ? 'active' : '' }}" href="{{ url('kesehatan-desa') .'/'. $desa_id }}">KESEHATAN</a>
  </li>
</ul>