<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="200" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>KEPALA DESA</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">NAMA</div>
        <div class="col-md-7">: {{ $desa->nama_kades ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">JENIS KELAMIN</div>
        <div class="col-md-7">: {{ $desa->gender_name ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">NO. TELPON</div>
        <div class="col-md-7">: {{ $desa->no_telp_kades ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">PENDIDIKAN TERAKHIR</div>
        <div class="col-md-7">: {{ $desa->nama_pendidikan_kades ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">LAMA MASA JABATAN</div>
        <div class="col-md-7">: {{ $desa->masa_jabatan_kades ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">NAMA SEKDES</div>
        <div class="col-md-7">: {{ $desa->nama_kades ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">LAMA MASA JABATAN SEKDES</div>
        <div class="col-md-7">: {{ $desa->masa_jabatan_sekdes ?? '-' }}</div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="300" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>KANTOR DESA</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">ALAMAT LENGKAP</div>
        <div class="col-md-7">: {{ $desa->alamat_deswil ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">TERDAPAT KANTOR DESA</div>
        <div class="col-md-7">: {{ $desa->gedung_deswil  ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">LATITUDE, LONGITUDE</div>
        <div class="col-md-7">: {{ $desa->latitude_deswil ?? '-' }}, {{ $desa->longitude_deswil ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">BATAS DESA</div>
        <div class="col-md-7">: {{ (!$desa->peta_deswil) ? '-' : (($desa->peta_deswil == 1) ? 'Ada' : 'Tidak Ada') }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">NO. TELPON</div>
        <div class="col-md-7">: {{ $desa->no_telp_deswil ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">EMAIL</div>
        <div class="col-md-7">: {{ $desa->email_deswil ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">WEBSITE</div>
        <div class="col-md-7">: {{ $desa->web_deswil ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">FACEBOOK</div>
        <div class="col-md-7">: {{ $desa->facebook_deswil ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">TWITTER</div>
        <div class="col-md-7">: {{ $desa->twitter_deswil ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-5">INSTAGRAM</div>
        <div class="col-md-7">: {{ $desa->instagram_deswil ?? '-' }}</div>
      </div>

    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="400" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>ORGANISASI DESA</b></div>
    <div class="card-body">
      @foreach($mst_desa_organisasi as $organisasi)
        <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
          <div class="col-md-5">{{ strtoupper($organisasi->nama_organisasi) ?? '-' }}</div>
          <div class="col-md-7">
            : {{ ($organisasi->jumlah_lk) ? number_format($organisasi->jumlah_lk) : '-' }} <b>(Laki-laki)</b><br>
            : {{ ($organisasi->jumlah_pr) ? number_format($organisasi->jumlah_pr) : '-' }} <b>(Perempuan)</b><br>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>