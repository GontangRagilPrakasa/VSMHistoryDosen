@extends('layouts.page')
@section('title', 'Dashboard')

@section('contentCss')
<style>

</style>
@endsection

@section('contentJs')
<script>
  $(document).ready(function(){
    // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        colors: ['#DD9999', '#99DD99', '#9999DD'],
        title: {
            text: 'INDEX DESA MEMBANGUN {{ $desa->desa_name }}'
        },
        subtitle: {
            // text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'POINT'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}'
                }
            }
        },

        tooltip: {
            // headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b>'
        },

        series: [
            {
                colorByPoint: true,
                data: [
                    {
                        name: "NILAI IKS",
                        y: {{ $desa->iks_value ?? 0 }}
                    },
                    {
                        name: "NILAI IKE",
                        y: {{ $desa->ike_value ?? 0 }}
                    },
                    {
                        name: "NILAI IKL",
                        y: {{ $desa->ikl_value ?? 0 }}
                    }
                ]
            }
        ]
    });
  });
</script>
@endsection

@section('content')
<!-- #main -->
<main id="main">
    <section id="team" class="pricing section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h3>INDEK DESA MEMBANGUN DESA <span>{{ $desa->desa_name }}</span></h3>
          <br>
          <div class="content">
            @include('web_page.navbar')
          </div>
        </div>

        <div class="row" style="font-size: 14px">

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">

              <div class="card-header"><b>INDEK DESA MEMBANGUN</b></div>
              <div class="card-body">
                <div class="col-md-12" style="margin-bottom: 5%">
                  <table class="table table-bordered" width="100%" style="width: 100%">
                    <thead>
                      <tr>
                        <td colspan="3" class="text-center"><b>VERIFIKASI</b></td>
                      </tr>
                      <tr style="">
                        <td style="width: 33.3333%" class="text-center">KECAMATAN</td>
                        <td style="width: 33.3333%" class="text-center">KABUPATEN</td>
                        <td style="width: 33.3333%" class="text-center">PROVINSI</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style="width: 33.3333%" class="text-center">
                          <b>{{ (!$desa->verifikasi_kec) ? '-' : (($desa->verifikasi_kec == 0) ? 'Belum Verifikasi' : 'Sudah Verifikasi') }}</b>
                        </td>
                        <td style="width: 33.3333%" class="text-center">
                          <b>{{ (!$desa->verifikasi_kab) ? '-' : (($desa->verifikasi_kab == 0) ? 'Belum Verifikasi' : 'Sudah Verifikasi') }}</b>
                        </td>
                        <td style="width: 33.3333%" class="text-center">
                          <b>{{ (!$desa->verifikasi_prov) ? '-' : (($desa->verifikasi_prov == 0) ? 'Belum Verifikasi' : 'Sudah Verifikasi') }}</b>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">STATUS</div>
                  <div class="col-md-7">: 
                    @if($desa->is_verify == 1)
                      <button class="btn btn-xs btn-success">VERIFIED</button>
                    @else
                      <button class="btn btn-xs btn-warning">NOT VERIFIED</button>
                    @endif
                  </div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">IKS {{ date('Y') }}</div>
                  <div class="col-md-7">: {{ $desa->iks_value ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">IKE {{ date('Y') }}</div>
                  <div class="col-md-7">: {{ $desa->ike_value ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">IKL {{ date('Y') }}</div>
                  <div class="col-md-7">: {{ $desa->ikl_value ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">NILAI IDM {{ date('Y') }}</div>
                  <div class="col-md-7">: <b>{{ $desa->idm_value ?? '-' }}</b></div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">STATUS IDM {{ date('Y') }}</div>
                  <div class="col-md-7">: <b>{{ strtoupper($desa->idm_status_name) ?? '-' }}</b></div>
                </div>
              </div>

            </div>
          </div>

        </div>

        <div class="content">
          <figure class="highcharts-figure">
              <div id="container"></div>
              <p class="highcharts-description">
              </p>
          </figure>
        </div>
      </div>
    </section>
</main>
<!-- End #main -->
@endsection