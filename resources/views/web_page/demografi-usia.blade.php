<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="200" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>JUMLAH PENDUDUK BERDASARKAN USIA</b></div>
    <div class="card-body">

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">A. < 1 TAHUN </div>
        <div class="col-md-7">: {{ ($desa->jumlah_usia_1_tahun) ? number_format($desa->jumlah_usia_1_tahun) : '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">B. 1-4 TAHUN</div>
        <div class="col-md-7">: {{ ($desa->jumlah_usia_4_tahun) ? number_format($desa->jumlah_usia_4_tahun) : '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">C. 5-14 TAHUN </div>
        <div class="col-md-7">: {{ ($desa->jumlah_usia_14_tahun) ? number_format($desa->jumlah_usia_14_tahun) : '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">D. 15-39 TAHUN </div>
        <div class="col-md-7">: {{ ($desa->jumlah_usia_39_tahun) ? number_format($desa->jumlah_usia_39_tahun) : '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">E. 40-64 TAHUN </div>
        <div class="col-md-7">: {{ ($desa->jumlah_usia_64_tahun) ? number_format($desa->jumlah_usia_64_tahun) : '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">F. > 65 TAHUN </div>
        <div class="col-md-7">: {{ ($desa->jumlah_usia_65_tahun) ? number_format($desa->jumlah_usia_65_tahun) : '-' }}</div>
      </div>

    </div>
  </div>
</div>