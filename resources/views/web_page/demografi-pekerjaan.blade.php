<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="200" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>JUMLAH PENDUDUK BERDASARKAN PEKERJAAN</b></div>
    <div class="card-body">
      @foreach($mst_demografi_pekerjaan as $pekerjaan)
        <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
          <div class="col-md-5">{{ strtoupper($pekerjaan->job_name) }}</div>
          <div class="col-md-7">
            : {{ ($pekerjaan->jumlah_pekerja_lk) ? number_format($pekerjaan->jumlah_pekerja_lk) : '-' }} <b>(Laki-laki)</b><br>
            : {{ ($pekerjaan->jumlah_pekerja_pr) ? number_format($pekerjaan->jumlah_pekerja_pr) : '-' }} <b>(Perempuan)</b><br>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>