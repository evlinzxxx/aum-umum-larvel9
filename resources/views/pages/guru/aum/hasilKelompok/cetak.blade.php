<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">

<h4 align="center">Hasil Analisis Kelompok AUM UMUM </h4>

{{-- Section Start --}}
<section style="margin-top: -50pt">
  <div style="padding-left:70px; padding-right:70px">
    {{-- Start Class Information --}}
      <div  style="background-color: #e8f6ffd1">
        <div style="padding: 20px">
            <p style="font-weight: bold; font-size:13px" >Asal Sekolah  : {{ $sekolah }}</p>
            <p style="font-weight: bold; font-size:13px; margin-left:300px; margin-top:-35px" >Jumlah Responden  : {{ $total_responden }}</p>
            <p style="font-weight: bold; font-size:13px" >Kelas  : {{ $tingkatan}}  {{ $jurusan}}  {{ $kelas}}</p>
          </div>
      </div>
    </div>

  </section>
    {{-- End Class Information --}}

    <style type="text/css">
      table tr td,
      table tr th{
        font-size: 9pt;
      }
    </style>

<div style="padding-left:70px ; padding-right:70px ; margin-top: -20pt">
  <table class="table table-striped table-bordered p-5" style="width:100%;table-layout: fixed; overflow-wrap: break-word;border-collapse: collapse">
    <thead>
          <tr>
            <th style="border: 0.1px solid; padding:2px" rowspan="2" >Bidang Masalah</th>
            <th style="border: 0.1px solid; padding:2px" colspan="4">Jenis Masalah</th>
          </tr>
          <tr>
            <th style="border: 0.1px solid; padding:2px">Jumlah Tertinggi</th>
            <th style="border: 0.1px solid; padding:2px">Jumlah Terendah</th>
            <th style="border: 0.1px solid; padding:2px">Jumlah Masalah</th>
            <th style="border: 0.1px solid; padding:2px">Rata-rata Masalah</th>
          </tr>
        </thead>
      <tbody>
        @foreach ($hasils as $hasil)
        @foreach ($hasil->categories as $kategori)
        <tr>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $kategori->nama_kategori }}
          </td>
          @endforeach
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $hasil['jumlah_tertinggi'] }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $hasil['jumlah_terendah'] }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $hasil['jumlah_masalah'] }}
          </td>
          <td align="center" style="border: 0.1px solid; padding:2px">
            {{ $hasil['rata_jumlah'] }}
          </td>
        </tr>
              @endforeach

              <tr class="fw-bold">
                <td align="center" style="border: 0.1px solid; padding:2px; font-weight:bold">Keseluruhan ({{ $jml_pertanyaan }})</td>
                <td align="center" style="border: 0.1px solid; padding:2px; font-weight:bold">{{ $jml_max_masalah }}</td>
                <td align="center" style="border: 0.1px solid; padding:2px; font-weight:bold">{{ $jml_min_masalah }}</td>
                <td align="center" style="border: 0.1px solid; padding:2px; font-weight:bold">{{ $jml_total_masalah }}</td>
                <td align="center" style="border: 0.1px solid; padding:2px; font-weight:bold">{{ $jml_rata_masalah }}</td>
              </tr>
      </tbody>
  </table>
</div>

<div style="margin-top: -10px">
  <div style="margin-left: 80px">
  <h5 >Keterangan : </h5>
  <div style="font-size: 10px; margin-top:-20px">
  JDK   : Jasmani dan Kesehatan <span style="font-weight:bold">(25)</span>  <br>
  DPI  : Diri Pribadi <span style="font-weight:bold">(20)</span> <br> 
  HSO  : Hubungan Sosial <span style="font-weight:bold">(15)</span> <br>
  EDK  : Ekonomi dan Keuangan <span style="font-weight:bold">(15)</span> <br>
  KDP  : Karir dan Pekerjaan <span style="font-weight:bold">(15)</span> <br>
  PDP  : Pendidikan dan Pelajaran <span style="font-weight:bold">(55)</span> <br>
  ANM  : Agama, Nilai, dan Moral <span style="font-weight:bold">(30)</span> <br>
  HMP  : Hubungan Muda Mudi dan Perkawinan <span style="font-weight:bold">(15)</span> <br>
  KHK  : Keadaan dan Hubungan dalam Keluarga <span style="font-weight:bold">(25)</span> <br>
  WSG  : Waktu Senggang <span style="font-weight:bold">(10)</span> <br>
</div>
</div>
</div>

<img style="width: 480; margin-left:35px; margin-top:20px" src="{{ $_POST['chart_inputs'] }}" alt="">

<div class="card" style="margin-left: 80px; margin-right:80px">
  <h4 class="fw-bold mt-3" allign="center" style="text-decoration-color: rgb(3, 48, 183)">Kesimpulan</h4>
  <div style="font-size: 10px; margin-top:-20px">
                Berdasarkan hasil pengolahan AUM UMUM, dapat disimpulan bahwa kelas {{ $tingkatan }} {{ $jurusan }} {{ $kelas }} memiliki masalah pada Bidang<span style="font-weight: bold; color:#eb5d1e"> {{ $kode_masalah }}  </span> yaitu 
                dengan tingkat persentase masalah sebesar <span style="font-weight: bold; color:#eb5d1e"> {{ $persen_max }} % </span>.Setelah pengisian AUM UMUM ini, diharapkan untuk siswa di kelas ini
                bisa mengonsultasikan permasalahan yang dirasa cukup berat. Bisa menemui Guru Bimbingan Konseling (BK), Psikolog, maupun Orang-orang yang kamu percayai untuk mecurahkan dan mampu membantu mengatasi masalahMu.
                <br><br>
                Bimbingan yang diberikan kepada kelas {{ $tingkatan }} {{ $jurusan }} {{ $kelas }}  secara menyeluruh adalah bimbingan pribadi terutama pada bidang untuk mendalami masalah {{ $kode_masalah }}.
              </p>
            </div>
        