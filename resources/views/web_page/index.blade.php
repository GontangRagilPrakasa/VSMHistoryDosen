@extends('layouts.page')
@section('title', 'Home')

@section('contentCss')
<style>

</style>
@endsection

@section('contentJs')
<script>
  $(document).ready(function(){
    $('.select2').select2();

    $('.select2-auto-width').select2({
      dropdownAutoWidth : true,
    });

    $('#cari-desa-by-name').hide();
    $('#cari-desa-by-provinsi').show();

    $('#button-cari-by-provinsi').click(function(event) {
      $('#cari-desa-by-provinsi').show();
      $('#cari-desa-by-name').hide();
    });

    $('#button-cari-by-name').click(function(event) {
      $('#cari-desa-by-name').show();
      $('#cari-desa-by-provinsi').hide();
    });

    // search kecamatan
    $('#kabupaten_id').on('change', function(event) {
      kabupaten_id = $('#kabupaten_id').val();
      if (kabupaten_id != '') {
        $.ajax({
          type: 'POST',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url : "{{ url('list-kecamatan') }}/" + kabupaten_id, 
          success : function(ret){
            $('#kecamatan_id').find('option').not(':first').remove();
            $('#desa_id').find('option').not(':first').remove();

            $.each(ret.data, function(key, value) {   
              $('#kecamatan_id').append($("<option></option>").attr("value", key).text(value)); 
            });
          }
        });
      }
    });

    // search kecamatan
    $('#kecamatan_id').on('change', function(event) {
      kecamatan_id = $('#kecamatan_id').val();
      if (kecamatan_id != 0) {
        $.ajax({
          type: 'POST',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url : "{{ url('list-desa') }}/" + kecamatan_id, 
          success : function(ret){
            $('#desa_id').find('option').not(':first').remove();

            $.each(ret.data, function(key, value) {   
              $('#desa_id').append($("<option></option>").attr("value", key).text(value)); 
            });
          }
        });
      }
    });

    // search kecamatan
    $('#desa_id').on('change', function(event) {
      desa_id = $('#desa_id').val();
      if (desa_id != 0) {
        window.location.replace("{!! url('/indentitas-desa/') !!}/" + desa_id);
      }
    });

    // desa by name
    $.ajax({
      type: 'POST',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url : "{{ url('list-desa-all') }}",
      success : function(ret){
        $('#desa_by_name').find('option').not(':first').remove();
        $.each(ret.data, function(key, value) {   
          $('#desa_by_name').append($("<option></option>").attr("value", key).text(value)); 
        });
      }
    });

    // search kecamatan
    $('#desa_by_name').on('change', function(event) {
      desa_id = $('#desa_by_name').val();
      if (desa_id != 0) {
        window.location.replace("{!! url('/indentitas-desa/') !!}/" + desa_id);
      }
    });
  });
</script>
@endsection

@section('content')
<div class="container">
  @include('web_page.carousel')  
</div>

<!-- #main -->
<main id="main">
  <section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h3>CARI<span> DESA</span></h3>
        <hr>
        <button class="btn btn-sm" id="button-cari-by-name"><h2>CARI BERDASARKAN NAMA DESA</h2></button>
        -
        <button class="btn btn-sm" id="button-cari-by-provinsi"><h2>CARI BERDASARKAN KABUPATEN</h2></button>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12 align-items-stretch" data-aos="fade-up" data-aos-delay="100" id="cari-desa-by-name">
          <div class="form-group">
            <label for="sel1">Nama Desa:</label>
            <select class="form-control select2" id="desa_by_name" name="desa_by_name">
              <option value="0"></option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-md-12 align-items-stretch" data-aos="fade-up" data-aos-delay="100" id="cari-desa-by-provinsi">
          <div class="row">

            <div class="col-lg-3">
                <div class="form-group">
                <label for="sel1">Provinsi:</label>
                <select class="form-control" id="provinsi_id" disabled="disabled">
                  <option>Nusa Tenggara Barat</option>
                </select>
              </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                <label for="sel1">Kabupaten:</label>
                <select class="form-control" id="kabupaten_id">
                  <option value="0">- Pilih -</option>
                  @foreach($kabupaten as $val)
                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="form-group">
                <label for="sel1">Kecamatan:</label>
                <select class="form-control" id="kecamatan_id">
                  <option value="0">- Pilih -</option>
                </select>
              </div>
            </div>

            <div class="col-lg-3 col-sm-12">
                <div class="form-group">
                <label for="sel1">Desa:</label>
                <select class="form-control" id="desa_id">
                  <option value="0">- Pilih -</option>
                </select>
              </div>
            </div>

          </div> 
        </div>
      </div>

    </div>
  </section>
</main>
<!-- End #main -->
@endsection