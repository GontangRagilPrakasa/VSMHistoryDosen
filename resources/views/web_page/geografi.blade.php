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
        colors: ['#058DC7', '#50BB32'],
        title: {
            text: 'GRAFIK GEOGRAFI DESA {{ $desa->desa_name }}'
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
                text: 'Hectare'
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
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> Hectare<br/>'
        },

        series: [
            {
                colorByPoint: true,
                data: [
                    {
                        name: "WILAYAH DESA",
                        y: {{ $desa->luas_geo_desa ?? 0 }}
                    },
                    {
                        name: "HUTAN DESA",
                        y: {{ $desa->luas_geo_hutan ?? 0 }}
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
          <h3>GEOGRAFI DESA <span>{{ $desa->desa_name }}</span></h3>
          <br>
          <div class="content">
            @include('web_page.navbar')
          </div>
        </div>

        <div class="row" style="font-size: 14px">

          <div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
            <div class="card text-black bg-white">

              <div class="card-header"><b>GEOGRAFI DESA</b></div>
              <div class="card-body">
                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">TOTAL LUAS WILAYAH DESA</div>
                  <div class="col-md-7">: {{ $desa->luas_geo_desa ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">TOTAL LUAS HUTAN DESA</div>
                  <div class="col-md-7">: {{ $desa->luas_geo_hutan ?? '-' }}</div>
                </div>

                <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
                  <div class="col-md-5">JENIS WILAYAH DESA</div>
                  <div class="col-md-7">: {{ $desa->geo_name ?? '-' }}</div>
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