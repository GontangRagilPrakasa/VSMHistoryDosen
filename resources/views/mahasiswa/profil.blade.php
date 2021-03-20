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
				<label for="nama_bumdes">Judul Skripsi </label>
				<input type="text" class="form-control" id="mahasiswa_judul_skripsi" name="mahasiswa_judul_skripsi" required="" value="{{ @$master_mahasiswa->mahasiswa_judul_skripsi }}" <?= (@$master_mahasiswa->approval <> null )? 'disabled' : '' ; ?>>
			</div>

            
			<br>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</div>
	</form>
</div>
@endsection
