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
		<center><H2>Rekomendasi Dosen dan Siswa</H2></center>
		<hr>
	</div>
</div>

&nbsp;
@endsection