@extends('layouts.admin')
@section('title', 'Profile')
@section('contentCss')
<style>

</style>
@endsection
@section('contentJs')
<script>
    $('#formData').submit(function(){
		var formData = new FormData($('#formData')[0]);
		$.ajax({
			type: 'POST',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: formData,
			url : "{{ url('mahasiswa/profile-save') }}",
            contentType: false,
            processData: false,
            cache: false,
			success : function(ret){
				if (ret.result == true) {
					alert(ret.msg);
				} else {
					alert(ret.msg);
				}
			},
		});
	});
	
	$('#mahasiswa_prodi').prop('disabled', true);
	$('#mahasiswa_fakultas').change(function(){
		var id = $('#mahasiswa_fakultas').val();
		if (id) {
			$.ajax({
				url : '{{ url( 'json/prodi/' ) }}/'+id,
				type: 'GET',
				success: function( result )
				{
					$('#mahasiswa_prodi').prop('disabled', false);
					
					$("#mahasiswa_prodi").prop("selectedIndex", 0);
					$('#mahasiswa_prodi').find('option').remove().end().append('<option value=""> Pilih Program Studi </option>');
					$.each( result, function(k, v) {
						console.log(k,v);
						$('#mahasiswa_prodi').append($('<option>', {value:k, text:v}));
					});
					if (fakultas_id == id && prodi_id && $('#mode').val() == 'edit') {
						$('#mahasiswa_prodi').val(prodi_id).trigger('change');	
					}
				}
			});
		} else {
			
			$('#mahasiswa_prodi').prop('disabled', true);
			
			$("#mahasiswa_prodi").prop("selectedIndex", 0);
		}
			
	});

</script>


@endsection

@section('content')

<div class="content">
	<center><div id="alertData" style="display: none;"></div></center>
	<form class="form-horizontal" id="formData" onSubmit="return false" method="post" enctype="multipart/form-data" action="#">
		<div class="col-md-10">

            <div class="form-group">
				<label for="nama_bumdes">Nama Mahasiswa </label>
				<input type="text" class="form-control" id="mahasiswa_name" name="mahasiswa_name" required="" value="{{ @$master_mahasiswa->mahasiswa_name }}">
			</div>

			<div class="form-group">
				<label for="nama_bumdes">NPM Mahasiswa </label>
				<input type="text" class="form-control" id="mahasiswa_npm" name="mahasiswa_npm" required="" value="{{ @$master_mahasiswa->mahasiswa_npm }}">
			</div>

			<div class="form-group">
				<label for="nama_bumdes">Tempat Lahir Mahasiswa </label>
				<input type="text" class="form-control" id="mahasiswa_tempat_lahir" name="mahasiswa_tempat_lahir" required="" value="{{ @$master_mahasiswa->mahasiswa_tempat_lahir }}">
			</div>

			<div class="form-group">
				<label for="nama_bumdes">Tangal Lahir Mahasiswa </label>
				<input type="text" class="form-control datepicker" id="mahasiswa_tanggal_lahir" name="mahasiswa_tanggal_lahir" required="" value="{{ @$master_mahasiswa->mahasiswa_tanggal_lahir }}">
			</div>

            <div class="form-group">
				<label for="mahasiswa_jk">Jenis Kelamin </label>
                <select name="mahasiswa_jk" id="mahasiswa_jk" class="select2" required>
				    <option value="" disabled selected hidden>Pilih Status </option>
                    @foreach($opt_jk as $id => $jk)
						<option value="{{ $id }}" <?= (@$master_mahasiswa->mahasiswa_jk == $id)? 'selected' : '' ; ?>>{{ $jk }}</option>
					@endforeach
				</select>
			</div>

            <div class="form-group">
				<label for="nama_bumdes">No Telp </label>
				<input type="text" class="form-control" id="mahasiswa_telp" name="mahasiswa_telp" required="" value="{{ @$master_mahasiswa->mahasiswa_telp }}">
			</div>

			<div class="form-group">
				<label for="nama_bumdes">Fakultas </label>
				<select name="mahasiswa_fakultas" id="mahasiswa_fakultas" class="select2" required>
					<option value="" disabled selected hidden>Pilih Fakultas</option>
						@foreach ($fakultas as $key => $fak)
							<option value="{{ $key }}" <?= (@$master_mahasiswa->mahasiswa_fakultas == $key)? 'selected' : '' ; ?>> {{ $fak }}</option>
						@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="nama_bumdes">Program Studi </label>
				<select name="mahasiswa_prodi" id="mahasiswa_prodi" class="select2" required>
					<option value="" disabled selected hidden>Pilih Program Studi</option>
						@foreach ($prodi as $key => $prod)
							<option value="{{ $key }}" <?= (@$master_mahasiswa->mahasiswa_prodi == $key)? 'selected' : '' ; ?>> {{ $prod }}</option>
						@endforeach     
				</select>
			</div>	
            
			<br>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</form>
</div>
@endsection
