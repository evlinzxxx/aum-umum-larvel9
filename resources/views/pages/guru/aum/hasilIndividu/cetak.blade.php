<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
<h4 align="center">Hasil Analisis AUM UMUM </h4>

{{-- Start Student Information --}}
<section style="margin-top: -50pt">
        <div style="background-color: #e8f6ffd1 ; margin-left:80px; margin-right:80px ">
          <div><img  style="margin-top: 20px ; margin-left: 35px; margin-bottom: 15px; width:50" src="{{ asset('uploads/siswa/' . $siswa->url_photo) }}"></div>
          <div style="margin-left: 120px">
              <h6 style="font-weight: bold; margin-top: -73px ; font-size:8px">Nama Lengkap : {{ $siswa->nama }}</h6>
              <h6 style="font-weight: bold; margin-top: -10px; font-size:8px">NISN : {{ $siswa->nisn }}</h6>
              <div style="margin-top: -400px">
              <h6 style="font-weight: bold; margin-left:180px; font-size:8px; margin-top: -20px">Asal Sekolah : {{ $siswa->sekolah }}</h6>
            </div>
              <h6 style="font-weight: bold; margin-left:180px; font-size:8px; margin-top: -10px">Kelas : {{ $siswa->tingkatan}}  {{ $siswa->jurusan}}  {{ $siswa->kelas}}</h6>
              <div style="margin-top: -70px">
              <h6 style="font-weight: bold; font-size:8px">Jenis Kelamin : {{ $siswa->gender }}</h6>
            </div>
              <div style="margin-top: -70px">
              <h6 style="font-weight: bold; font-size:8px; margin-left: 180px">Tanggal Pengisian : {{ $date }}</h6>
            </div>
            </div>
            </div>
    </section>
      {{-- End Student Information --}}
      
      {{-- Start Individual Analysis --}}
      <div style="padding-left:80px ; padding-right:80px ; margin-top: -30pt">
        <table class="table table-striped table-bordered p-5" style="width:100%;table-layout: fixed; overflow-wrap: break-word;border-collapse: collapse">
          <thead>
            <tr class="text-center">
                <th  rowspan="2" style="border: 0.1px solid; padding:2px">Bidang Masalah</th>
                <th colspan="2" style="border: 0.1px solid; padding:2px" >Jenis Masalah</th>
            </tr>
            <tr class="text-center">
                <th style="border: 0.1px solid; padding:2px">Jumlah</th>
                <th style="border: 0.1px solid; padding:2px">Persentase (%)</th>
            </tr>
          </thead>
                  
          <tbody>
            @foreach ($hasils as $hasil)
              @foreach ($hasil->categories as $aa)
            <tr>
                <td align="center" style="border: 0.1px solid; padding:2px">
                  {{ $aa->nama_kategori}}
                </td>
              @endforeach
                <td align="center" style="border: 0.1px solid; padding:2px">
                  {{ $hasil->jumlah_ya }}
                </td>
                <td align="center" style="border: 0.1px solid; padding:2px">
                  {{ $hasil->persentase_masalah }}
                </td>
            </tr>
            @endforeach
            <tr class="fw-bold">
                <td align="center" align="center" style="border: 0.1px solid; padding:2px; font-weight:bold">Keseluruhan ({{ $jml_pertanyaan }})</td>
                <td align="center" style="border: 0.1px solid; padding:2px; font-weight:bold">{{ $total_mslh }}</td>
                <td align="center" style="border: 0.1px solid; padding:2px; font-weight:bold">{{ ($jml_persen). "%" }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      {{-- End Individual Analysis --}}
              
      {{-- Start Category Inforamtion --}}
      <div class="row" style="margin-top: -10px">
        <div class="col-4" style="margin-left: 80px">
          <h5 class="fw-bold">Keterangan : </h5>
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
      {{-- End Category Inforamtion --}}
      
      {{-- Start Graph Inforamtion --}}
      <img style="width: 480; margin-left:35px;margin-top:20px" src="{{ $_POST['chart_inputt'] }}" alt="">
      {{-- End Graph Inforamtion --}}
      
      
      {{-- Start Conclusion Inforamtion --}}
      <div style="margin-left: 80px; margin-right:80px;border: 0.1px solid;margin-top:25px">
        <h4 align="center" style="color:#1f77d5; margin-bottom:20px">Kesimpulan</h4>
        <div style="font-size: 10px; margin-top:-20px;padding:20px">
          Berdasarkan hasil pengolahan AUM UMUM, dapat disimpulan bahwa {{$siswa->nama}} memiliki masalah pada Bidang<span style="font-weight: bold; color:#eb5d1e"> {{$highest_kategori}}.</span>Masalah terbanyak
          terdapat pada nomor <span style="font-size: 9px">{{$highest_masalah}} </span>  dengan tingkat persentase masalah sebesar <span style="font-weight: bold; color:#ff0000"> {{$highest_percent}}% </span>.Setelah pengisian AUM UMUM ini, diharapkan untuk
          bisa mengonsultasikan permasalahan yang dirasa cukup berat. Bisa menemui Guru Bimbingan Konseling (BK), Psikolog, maupun Orang-orang yang kamu percayai untuk mecurahkan dan mampu membantu mengatasi masalahMu.
          <br><br>
          Bimbingan yang diberikan kepada {{$siswa->nama}} adalah bimbingan pribadi terutama pada bidang untuk mendalami masalah {{$highest_kategori}}.
        </div>
      </div>
      {{-- End Conclusion Inforamtion --}}
        

      <style type="text/css">
        table tr td,
        table tr th{
          font-size: 9pt;
        }
      </style>