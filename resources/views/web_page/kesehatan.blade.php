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
          <h3>KESEHATAN DESA <span>{{ $desa->desa_name }}</span></h3>
          <br>
          <div class="content">
            @include('web_page.navbar')
          </div>
        </div>

        <div class="row" style="font-size: 14px">

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Ketersediaan Sarana Kesehatan") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Sarana kesehatan terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->sarkes_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke sarana kesehatan terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->sarkes_jarak) ?? '-' }} KM</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke sarana kesehatan terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->sarkes_waktu_tempuh) ?? '-' }} Menit</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Rumah Sakit") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Rumah Sakit di Desa") }}</div>
                  <div class="col-md-5">: {{ ($desa->rs_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Rumah Sakit terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->rs_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Rumah Sakit terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->rs_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Rumah Sakit Bersalin") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Rumah Sakit Bersalin di Desa") }}</div>
                  <div class="col-md-5">: {{ ($desa->rs_bersalin_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Rumah Sakit bersalin terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->rs_bersalin_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Rumah Sakit bersalin terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->rs_bersalin_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Puskesmas Rawat Inap") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Puskesmas dengan rawat inap di Desa") }}</div>
                  <div class="col-md-5">: {{ ($desa->puskesmas_inap_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Puskesmas dengan rawat inap terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->puskesmas_inap_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Puskesmas dengan rawat inap terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->puskesmas_inap_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Puskesmas Tanpa Rawat Inap") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Puskesmas tanpa rawat inap di Desa") }}</div>
                  <div class="col-md-5">: {{ ($desa->puskesmas_tanpa_inap_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Puskesmas tanpa rawat inap terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->puskesmas_tanpa_inap_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Puskesmas tanpa rawat inap terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->puskesmas_tanpa_inap_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Puskesmas Pembantu") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Puskesmas Pembantu di Desa") }}</div>
                  <div class="col-md-5">: {{ ($desa->puskesmas_pembantu_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Puskesmas Pembantu terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->puskesmas_pembantu_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Puskesmas Pembantu terdekat") }}</div>
                  <div class="col-md-5">: {{ ($desa->puskesmas_pembantu_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Rumah Bersalin") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Rumah Bersalin di Desa") }}</div>
                  <div class="col-md-5">: {{ ($desa->bersalin_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Rumah bersalin terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->bersalin_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Rumah bersalin terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->bersalin_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Poliklinik / Balai Pengobatan") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Poliklinik/Balai Pengobatan di Desa ") }}</div>
                  <div class="col-md-5">: {{ ($desa->poliklinik_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Poliklinik/Balai Pengobatan terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->poliklinik_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Poliklinik/Balai Pengobatan terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->poliklinik_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Tempat Praktek Dokter") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Tempat Praktek Dokter di Desa ") }}</div>
                  <div class="col-md-5">: {{ ($desa->dr_praktek_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Tempat Praktek Dokter terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->dr_praktek_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Tempat Praktek Dokter terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->dr_praktek_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Tempat Praktek Bidam") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Tempat Praktek Bidam di Desa ") }}</div>
                  <div class="col-md-5">: {{ ($desa->dr_praktek_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Tempat Praktek Bidam terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->dr_praktek_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Tempat Praktek Bidam terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->dr_praktek_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Apotik") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan sarana Apotek di Desa ") }}</div>
                  <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jarak ke Apotek terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Apotek terdekat ") }}</div>
                  <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">
              <div class="card-header"><b>{{ strtoupper("Ketersediaan Tenaga Kesehatan Bidan / Dokter / Lainnya") }}</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan tenaga kesehatan bidan Desa (BDD) ") }}</div>
                  <div class="col-md-5">: {{ ($desa->tenaga_bidan_status) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jumlah bidan Desa (BDD) di Desa ") }}</div>
                  <div class="col-md-5">: {{ ($desa->tenaga_bidan_jumlah) ?? '-' }}</div>
                </div>

                <br>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan tenaga kesehatan dokter ") }}</div>
                  <div class="col-md-5">: {{ ($desa->tenaga_dokter_status) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jumlah dokter di Desa ") }}</div>
                  <div class="col-md-5">: {{ ($desa->tenaga_bidan_jumlah) ?? '-' }}</div>
                </div>

                <br>  

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("a. Ketersediaan tenaga kesehatan lainnya selain dokter dan bidan di Desa") }}</div>
                  <div class="col-md-5">: {{ ($desa->tenaga_lainnya_status) ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-7">{{ ("b. Jumlah tenaga kesehatan lainnya selain dokter dan bidan") }}</div>
                  <div class="col-md-5">: {{ ($desa->tenaga_lainnya_jumlah) ?? '-' }}</div>
                </div>

              </div>
            </div>
          </div>

          @include('web_page.kesehatan-next')
      </div>
    </section>
</main>
<!-- End #main -->
@endsection