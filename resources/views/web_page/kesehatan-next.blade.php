<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>{{ strtoupper("Akses Ke Poskesdes/ Polindes dan Posyandu") }}</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Ketersediaan sarana Poskesdes/ Polindes ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jarak ke Poskesdes/Polindes terdekat ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("c. Waktu tempuh untuk menuju ke Poskesdes/ Polindes terdekat ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("d. Fungsi Poskesdes/ Polindes ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("e. Ketersediaan rumah singgah / rumah tunggu untuk ibu hamil ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Jumlah Posyandu di Desa ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jumlah posyandu yang melaksanakan kegiatan / pelayanan sebulan sekali ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("c. Jumlah posyandu yang melaksanakan kegiatan / pelayanan 2 bulan sekali atau lebih ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("d. Mayoritas warga Desa berpartisipasi aktif dalam kegiatan Posyandu ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("e. Sumber Dana Pembiayaan Kegiatan Posyandu ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>{{ strtoupper("Tingkat Kepesertaan BPJS/ JKN/ KIS") }}</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Jumlah warga yang terdaftar menjadi peserta BPJS Kesehatan/ Jaminan Kesehatan Nasional/ Kartu Indonesia Sehat (KIS) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Warga Desa memanfaatkan pelayanan BPJS/JKN/KIS ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("c. Jumlah warga yang terdaftar menjadi peserta Jamkesda/BPJS/JKN/KIS ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>{{ strtoupper("Derajat Kesehatan dan Gizi Buruk") }}</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Terdapat kejadian kematian ibu melahirkan di Desa ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jumlah kejadian kematian ibu melahirkan di Desa ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Terdapat kejadian kematian balita di Desa") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jumlah kejadian kematian balita di Desa") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Terdapat kejadian kematian bayi (0-12 Bulan) di Desa ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jumlah kejadian kematian bayi (0-12 Bulan) di Desa ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Terdapat kejadian balita gizi buruk di Desa ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jumlah kejadian balita gizi buruk di Desa ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Terdapat kejadian luar biasa di Desa ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Penyakit yang menyebabkan kejadian luar biasa ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>{{ strtoupper("Sasaran 1.000 Hari Pertama Kehidupan (HPK) (Ibu hamil dan anak 0-23 bulan)") }}</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Jumlah Total Rumah Tangga 1.000 HPK ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jumlah Ibu Hamil ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("c. Jumlah Usia Anak 0-23 Bulan ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>{{ strtoupper("Pengukuran Tikar Pertumbuhan (Deteksi Dini Stunting) Usia Anak 0-23 Bulan") }}</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Panjang Anak 0-23 Bulan Pertumbuhan Normal (Hijau) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Panjang Anak 0-23 Bulan Pertumbuhan Resiko Stunting (Kuning) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("c. Panjang Anak 0-23 Bulan Pertumbuhan Terindikasi Stunting (Merah) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>{{ strtoupper("Kelengkapan Konvergensi Paket Layanan Pencegahan Stunting bagi 1.000 HPK Ibu Hamil") }}</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Jumlah Ibu Hamil yang Periksa 4 Kali Selama Kehamilan ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jumlah Ibu Hamil yang Mendapat dan Meminum Pil FE Selama 90 Hari ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("c. Jumlah Ibu Bersalin yang Mendapat Layanan Pemeriksaan NIFAS 3 Kali ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("d. Jumlah Ibu Hamil yang Mengikuti Konseling Gizi/ Kelas Ibu Minimal 4 Kali ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("e. Jumlah Ibu Hamil Mengalami Kekurangan Energi Kronis (KEK) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("f. Jumlah Ibu Hamil yang Mengalami KEK Mendapat Kunjungan Rumah Bulanan ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("g. Jumlah Ibu Hamil Mengalami Resiko Tinggi Kehamilan (RESTI) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("h. Jumlah Ibu Hamil yang Mengalami RESTI Mendapat Kunjungan Rumah Bulanan ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("i. Jumlah Ibu Hamil yang Memiliki Akses Air Minum Aman ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("j. Jumlah Ibu Hamil Memiliki Jamban Layak ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("k. Jumlah Ibu Hamil yang Memiliki Jaminan Kesehatan ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("Tingkat Konvergensi Desa Terhadap Ibu Hamil (Indikator yang Diterima) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("Tingkat Konvergensi Desa Terhadap Ibu Hamil (Indikator yang Seharusnya Diterima)") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("Tingkat Konvergensi Desa Terhadap Ibu Hamil ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>{{ strtoupper("Kelengkapan Konvergensi Paket Layanan Pencegahan Stunting bagi 1.000 HPK Anak Usia 0-23 Bulan (0-2 Tahun)") }}</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Jumlah Anak Usia < 12 Bulan yang Mendapat Imunisasi Dasar Lengkap ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jumlah Anak yang Ditimbang Rutin Setiap Bulan ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("c. Jumlah Anak yang Diukur Panjang/Tinggi Badan 2 Kali Dalam Setahun ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("d. Jumlah Orang Tua/Pengasuh Laki-laki yang Mengikuti Konseling Gizi Bulanan Anak ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("e. Jumlah Orang Tua/Pengasuh Perempuan yang Mengikuti Konseling Gizi Bulanan Anak ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("f. Jumlah Kunjungan Rumah Bagi Anak Gizi Buruk ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("g. Jumlah Kunjungan Rumah Bagi Anak Gizi Kurang ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("h. Jumlah Kunjungan Rumah Bagi Anak Stunting ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("i. Jumlah Anak 0-2 Tahun yang Memiliki Akses Air Minum Aman ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("j. Jumlah Anak 0-2 Tahun yang Memiliki Jamban Layak ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("k. Jumlah Anak Usia 0-2 Tahun yang Memiliki Jaminan Kesehatan ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("l. Jumlah Anak Usia 0-2 Tahun yang Memiliki Akta Kelahiran ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("m. Jumlah Orang Tua/Pengasuh yang Mengikuti Parenting Bulanan (PAUD) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("Tingkat Konvergensi Desa Terhadap Anak Usia 0-23 Bulan (Indikator yang Diterima) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("Tingkat Konvergensi Desa Terhadap Anak Usia 0-23 Bulan (Indikator yang Seharusnya Diterima) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("Tingkat Konvergensi Desa Terhadap Anak Usia 0-23 Bulan (Indikator yang Seharusnya Diterima) ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_waktu_tempuh) ?? '-' }}</div>
      </div>
    </div>
  </div>
</div>

<div class="col-lg-12 col-md-12" data-aos="fade-up" data-aos-delay="100" style="margin-bottom: 2%">
  <div class="card text-black bg-white">
    <div class="card-header"><b>{{ strtoupper("Kelengkapan Konvergensi Paket Layanan Pencegahan Stunting bagi 1.000 HPK Anak Usia > 2-6 Tahun ") }}</b></div>
    <div class="card-body">
      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("a. Jumlah Anak Usia > 2-6 Tahun ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_terdekat) ?? '-' }}</div>
      </div>

      <div class="row col-md-12" style="text-align: left; margin-bottom: 1%">
        <div class="col-md-7">{{ ("b. Jumlah Anak Usia > 2-6 Tahun yang Aktif Dalam Kegiatan PAUD ") }}</div>
        <div class="col-md-5">: {{ ($desa->apotek_jarak) ?? '-' }}</div>
      </div>
    </div>
  </div>
</div>