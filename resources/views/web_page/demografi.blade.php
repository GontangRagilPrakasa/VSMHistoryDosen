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
          <h3>DEMOGRAFI DESA <span>{{ $desa->desa_name }}</span></h3>
          <br>
          <div class="content">
            @include('web_page.navbar')
          </div>
        </div>

        <div class="row" style="font-size: 14px">

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">

              <div class="card-header"><b>DEMOGRAFI DESA</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JUMLAH TOTAL PENDUDUK</div>
                  <div class="col-md-7">: {{ ($desa->jumlah_penduduk_total) ? number_format($desa->jumlah_penduduk_total) : '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JUMLAH PENDUDUK LAKI-LAKI </div>
                  <div class="col-md-7">: {{ ($desa->jumlah_penduduk_lk) ? number_format($desa->jumlah_penduduk_lk) : '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JUMLAH PENDUDUK PEREMPUAN </div>
                  <div class="col-md-7">: {{ ($desa->jumlah_penduduk_pr) ? number_format($desa->jumlah_penduduk_pr) : '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JUMLAH PENDUDUK PENDATANG S/D TAHUN {{ date('Y') }}</div>
                  <div class="col-md-7">: {{ ($desa->jumlah_penduduk_datang) ? number_format($desa->jumlah_penduduk_datang) : '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JUMLAH PENDUDUK PERGI S/D TAHUN {{ date('Y') }}</div>
                  <div class="col-md-7">: {{ ($desa->jumlah_penduduk_pergi) ? number_format($desa->jumlah_penduduk_pergi) : '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JUMLAH TOTAL KEPALA KELUARGA </div>
                  <div class="col-md-7">: {{ ($desa->jumlah_kk_total) ? number_format($desa->jumlah_kk_total) : '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JUMLAH TOTAL KEPALA KELUARGA LAKI-LAKI </div>
                  <div class="col-md-7">: {{ ($desa->jumlah_kk_lk) ? number_format($desa->jumlah_kk_lk) : '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JUMLAH TOTAL KEPALA KELUARGA PEREMPUAN </div>
                  <div class="col-md-7">: {{ ($desa->jumlah_kk_pr) ? number_format($desa->jumlah_kk_pr) : '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JUMLAH KELUARGA MISKIN </div>
                  <div class="col-md-7">: {{ ($desa->jumlah_kk_miskin) ? number_format($desa->jumlah_kk_miskin) : '-' }}</div>
                </div>
              </div>

            </div>
          </div>

          @include('web_page.demografi-usia')
          @include('web_page.demografi-pekerjaan')

        </div>

      </div>
    </section>
</main>
<!-- End #main -->
@endsection