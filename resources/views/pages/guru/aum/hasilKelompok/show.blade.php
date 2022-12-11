@extends('layouts.teacher')

@section('content')
<header>
<h3>Hasil Analisis Kelompok &raquo; <span class="text-primary">{{ $tingkatan }} {{ $jurusan }} {{ $kelas }}</span> </h3>
</header>

<div>
  <a href="{{ route('dashboard.hasilKelompok.pilihShow') }}" class="btn btn-dark"><i class="fa-solid fa-backward px-2"></i>Kembali</a>
</div>

<h4 class="text-center fw-bold p-5">Hasil Analisis Kelompok AUM UMUM </h4>

{{-- Section Start --}}
<section id="answer" class="contact">
  <div class="container" style="padding-left:110px; padding-right:110px">
    {{-- Start Class Information --}}
    <div class="card">
      <div class="title p-2 d-flex" style="background-color: #e8f6ffd1">
        <div class="p-4 px-4 flex">
          <div class="d-flex">
            <p class="mt-2 fw-bold">Asal Sekolah <span class="px-3"></span> : {{ $sekolah }}</p>
          </div>
          <div class="d-flex">
            <p class="mt-2 fw-bold">Kelas <span class="px-5"></span> : {{ $tingkatan}}  {{ $jurusan}}  {{ $kelas}}</p>
          </div>
        </div>
      <div class="p-3 px-4 flex">
        <div class="d-flex">
          <p class="mt-3 fw-bold">Jumlah Responden <span class="px-1"></span> : {{ $total_responden }}</p>
          </div>
        <div style="margin-left: 400px" >
          <form action="{{ route('dashboard.hasilKelompok.cetakPdf', ['sekolah'=>$sekolah ,'tingkatan'=>$tingkatan, 'jurusan'=>$jurusan , 'kelas'=>$kelas]) }}" method="POST">
            @csrf
            <input type="hidden" name="chart_inputs" id="chart_inputs">
            <button type="submit" target="_blank" class="btn btn-danger"><i class="fa-solid fa-print px-2"></i>Cetak</button>
          </form>
        </div>
      </div>
    </div>

  </section>
    {{-- End Class Information --}}

<div class="card-body" style="padding-left:110px ; padding-right:110px ; margin-top: 20pt">
  <table class="table table-striped table-bordered p-5" style="width:100%;table-layout: fixed; overflow-wrap: break-word;">
    <thead>
          <tr class="text-center">
            <th rowspan="2" style=" text-align: center; vertical-align: middle;">Bidang Masalah</th>
            <th colspan="4">Jenis Masalah</th>
          </tr>
          <tr class="text-center">
            <th>Jumlah Tertinggi</th>
            <th>Jumlah Terendah</th>
            <th>Jumlah Masalah</th>
            <th>Rata-rata Masalah</th>
          </tr>
        </thead>
      <tbody>
        @foreach ($hasils as $hasil)
            @foreach ($hasil->categories as $kategori)
        <tr>
          <td class="text-center">
            {{ $kategori->nama_kategori }}
          </td>
          @endforeach
          <td class="text-center">
            {{ $hasil['jumlah_tertinggi'] }}
          </td>
          <td class="text-center">
            {{ $hasil['jumlah_terendah'] }}
          </td>
          <td class="text-center">
            {{ $hasil['jumlah_masalah'] }}
          </td>
          <td class="text-center">
            {{ $hasil['rata_jumlah'] }}
          </td>
        </tr>
              @endforeach

              <tr class="fw-bold">
                <td class="text-center">Keseluruhan ({{ $jml_pertanyaan }})</td>
                <td class="text-center">{{ $jml_max_masalah }}</td>
                <td class="text-center">{{ $jml_min_masalah }}</td>
                <td class="text-center">{{ $jml_total_masalah }}</td>
                <td class="text-center">{{ $jml_rata_masalah }}</td>
              </tr>
      </tbody>
  </table>
</div>

<div class="row" style="margin-top: 80px">
    <div class="col-4" style="margin-top:100px ; margin-left: 115px">
    <h5 class="fw-bold">Keterangan : <br></h5>
    <div style="font-size: 13px">
      JDK <span class="px-2"></span>  : Jasmani dan Kesehatan <span class="fw-bold">(25)</span>  <br>
      DPI <span class="px-2"></span> : Diri Pribadi <span class="fw-bold">(20)</span> <br> 
      HSO <span class="px-2"></span> : Hubungan Sosial <span class="fw-bold">(15)</span> <br>
      EDK <span class="px-2"></span> : Ekonomi dan Keuangan <span class="fw-bold">(15)</span> <br>
      KDP <span class="px-2"></span> : Karir dan Pekerjaan <span class="fw-bold">(35)</span> <br>
      PDP <span class="px-2"></span> : Pendidikan dan Pelajaran <span class="fw-bold">(35)</span> <br>
      ANM <span class="px-2"></span> : Agama, Nilai, dan Moral <span class="fw-bold">(30)</span> <br>
      HMP <span class="px-2"></span> : Hubungan Muda Mudi dan Perkawinan <span class="fw-bold">(15)</span> <br>
      KHK <span class="px-2"></span> : Keadaan dan Hubungan dalam Keluarga <span class="fw-bold">(25)</span> <br>
      WSG <span class="px-2"></span> : Waktu Senggang <span class="fw-bold">(10)</span> <br>
  </div>
  </div>

            <div class="col-6" >
              <div class="card-body">
                <div id="chart" class="chart"  style="padding-right:20px">
                </div>
              </div>
            </div>
            </div>

            <div class="card" style="margin-left: 100px ; margin-right: 100px ; margin-top :40px">
              <h4 class="fw-bold text-primary text-center mt-3">Kesimpulan</h4>
              <p class="p-4">
                Berdasarkan hasil pengolahan AUM UMUM, dapat disimpulan bahwa kelas <span class="fw-bold text-danger"> {{ $tingkatan }} {{ $jurusan }} {{ $kelas }} </span>memiliki masalah pada Bidang<span class="fw-bold text-danger"> {{ $kode_masalah }}  </span> yaitu 
                dengan tingkat persentase masalah sebesar <span class="fw-bold text-success"> {{ $persen_max }} % </span>.Setelah pengisian AUM UMUM ini, diharapkan untuk siswa di kelas ini
                bisa mengonsultasikan permasalahan yang dirasa cukup berat. Bisa menemui Guru Bimbingan Konseling (BK), Psikolog, maupun Orang-orang yang kamu percayai untuk mecurahkan dan mampu membantu mengatasi masalahMu.
                <br><br>
                Bimbingan yang diberikan kepada kelas <span class="fw-bold text-danger"> {{ $tingkatan }} {{ $jurusan }} {{ $kelas }} </span> secara menyeluruh adalah bimbingan pribadi terutama pada bidang untuk mendalami masalah {{ $kode_masalah }}.
  
              </p>
  
            </div>
  
            <div style="opacity  : 0%" id='chart_div'></div>
  @section('chart')
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script>
          Highcharts.chart('chart', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Hasil Analisis Kelompok AUM UMUM'
          },
          subtitle: {
              text: {!! json_encode($tingkatan.' '.$jurusan.' '.$kelas) !!}
          },
          xAxis: {
              categories: {!! json_encode($kategories) !!},
              crosshair: true
          },
          yAxis: {
              title: {
                  useHTML: true,
                  text: 'Rata-rata Masalah (%)'
              }
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: [{
              name: 'Bidang Masalah',
              data: {!! json_encode($data) !!}

          }]
      });
   
      </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
  
    var data = google.visualization.arrayToDataTable([
      ['Kategori', 'Persen'],
      
      @php
              foreach($hasils as $hasil) {
                  echo "['".$hasil->kode_kategori."', ".$hasil->rata_jumlah."],";
              }
            @endphp
    ]);
  
    var options = {
      title: "Grafik Masalah",
      bar: {groupWidth: '50%'},
      legend: 'none',
    };
  
    var chart_div = document.getElementById('chart_div');
    var chart_input = document.getElementById('chart_inputs');
    var chart = new google.visualization.ColumnChart(chart_div);
  
    // Wait for the chart to finish drawing before calling the getImageURI() method.
    google.visualization.events.addListener(chart, 'ready', function () {
      chart_div.innerHTML = '<img src="' + chart.getImageURI()  + '" class="img-responsive">';
      chart_input.value = chart.getImageURI();
    });
  
    chart.draw(data, options);
  
  }
  </script>
  
@endsection
@endsection