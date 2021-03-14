@extends('layouts.page')
@section('title', 'Dashboard')

@section('contentCss')
<style>

</style>
@endsection

@section('contentJs')
<script>
  $(document).ready(function(){

  });
</script>
@endsection

@section('content')
<!-- #main -->
<main id="main">
    <section id="team" class="pricing section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h3>INFO DESA <span>{{ $desa->desa_name }}</span></h3>
          <br>
          <div class="content">
            @include('web_page.navbar')
          </div>
        </div>

        <div class="row" style="font-size: 14px">

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="box featured">

              <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                <div class="col-md-5">NAMA DESA  </div>
                <div class="col-md-7">: <b>{{ $desa->desa_name ?? '-' }}</b></div>
              </div>

              <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                <div class="col-md-5">NAMA KECAMATAN</div>
                <div class="col-md-7">: <b>{{ $desa->kecamatan_name ?? '-' }}</b></div>
              </div>

              <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                <div class="col-md-5">NAMA KABUPATEN</div>
                <div class="col-md-7">: <b>{{ $desa->kabupaten_name ?? '-' }}</b></div>
              </div>

              <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                <div class="col-md-5">NAMA PROVINSI</div>
                <div class="col-md-7">: <b>{{ $desa->provinsi_name ?? '-' }}</b></div>
              </div>

            </div>
          </div>

          @include('web_page.desa-detail')

        </div>

      </div>
    </section>
</main>
<!-- End #main -->
@endsection