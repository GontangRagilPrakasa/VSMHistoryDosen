@extends('layouts.admin')
@section('title', 'Dashboard')
@section('contentCss')
<style>

</style>
@endsection
@section('contentJs')
<script>
	$(document).ready(function(){
		$('#start_date').datepicker({
			format: 'yyyy-mm-dd',
		});

		$('#end_date').datepicker({
			format: 'yyyy-mm-dd',
		});
	});
</script>
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">
		<center><H2>SELAMAT DATANG DI SISTEM INDUK DESA</H2></center>
		<hr>
		@if(!is_null($desa))
		<div class="content text-center">
			<b>DESA <span class="text-primary">{{ $desa->desa_name }}</span></b>
			<br>
			<b>KECAMATAN {{ $desa->kecamatan_name }}</b>
			<br>
			<b>KABUPATEN {{ $desa->kabupaten_name }}</b>
			<br>
			<b>PROVINSI {{ $desa->provinsi_name }}</b>
			<br>
		</div>
		@endif
	</div>
</div>

&nbsp;
@endsection