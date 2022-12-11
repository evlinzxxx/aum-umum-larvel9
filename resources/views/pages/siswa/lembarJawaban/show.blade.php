@extends('layouts.user')

@section('main')

<h4 class="fw-bold p-5" style="margin-left: 570px">Hasil Analisis AUM UMUM </h4>

{{-- Section Start --}}
<section id="answer" class="contact" style="margin-top: -70pt">
    <div class="container">
      {{-- Start Student Information --}}
      <div class="card">
        <div class="title p-2 d-flex" style="background-color: #e8f6ffd1">
          <div class="mt-2 px-4"><img src="{{ asset('uploads/siswa/' . $siswa->url_photo) }}" alt="Admin" class="rounded-circle" width="100"></div>
          <div class="p-4 px-4 flex">
            <div class="d-flex">
              <h6 class="mt-2" style="font-weight: bold">Nama Lengkap : {{ $siswa->nama }}</h6>
            </div>
            <div class="d-flex">
              <h6 class="mt-2" style="font-weight: bold">NISN : {{ $siswa->nisn }}</h6>
            </div>
            <div class="d-flex">
              <h6 class="mt-2" style="font-weight: bold">Kelas : {{ $siswa->tingkatan}}  {{ $siswa->jurusan}}  {{ $siswa->kelas}}</h6>
            </div>
          </div>
        <div class="p-3 px-4 flex">
          <div class="d-flex">
            <h6 class="mt-3" style="font-weight: bold">Asal Sekolah : {{ $siswa->sekolah }}</h6>
            </div>
            <div class="d-flex">
              <h6 class="mt-2" style="font-weight: bold">Jenis Kelamin : {{ $siswa->gender }}</h6>
            </div>
          </div>
          <div class="d-flex">
            <h6 class="mt-4 p-2" style="font-weight: bold">Tanggal Pengisian : {{ $date }}</h6>
          </div>
          <div class="mt-5 px-5" >
            <form action="{{ route('user.cetakPdf', $siswa->nisn) }}" method="POST">
              @csrf
              <input type="hidden" name="chart_input" id="chart_input">
              <button type="submit" target="_blank" class="btn btn-danger"><i class="bi bi-printer-fill px-2"></i>Cetak</button>
            </form>
          </div>
        </div>
      </div>

    </section>
      {{-- End Student Information --}}
      
      <div class="card-body" style="padding-left:110px ; padding-right:110px ; margin-top: -30pt">
            <table class="table table-striped table-bordered p-5" style="width:100%;table-layout: fixed; overflow-wrap: break-word;">
              <thead>
                    <tr class="text-center">
                      <th rowspan="2" style=" text-align: center; vertical-align: middle;">Bidang Masalah</th>
                      <th colspan="2">Jenis Masalah</th>
                    </tr>
                    <tr class="text-center">
                      <th>Jumlah</th>
                      <th>Persentase (%)</th>
                    </tr>
                  </thead>
                <tbody>
                  @foreach ($hasils as $hasil)
                  @foreach ($hasil->categories as $aa)
                  <tr>
                    <td class="text-center">
                      {{ $aa->nama_kategori}}
                    </td>
                    @endforeach
                    <td class="text-center">
                      {{ $hasil->jumlah_ya }}
                    </td>
                    <td class="text-center">
                      {{ $hasil->persentase_masalah }}
                    </td>
                  </tr>
                        @endforeach

                        <tr class="fw-bold">
                          <td class="text-center">Keseluruhan ({{ $jml_pertanyaan }})</td>
                          <td class="text-center">{{ $jml_pertanyaan }}</td>
                          <td class="text-center">{{ ($jml_persen). "%" }}</td>
                        </tr>
                </tbody>
            </table>
          </div>

          <div class="row" style="margin-top: 50px">
              <div class="col-4" style="margin-top:50px ; margin-left: 115px">
              <h5 class="fw-bold">Keterangan : <br></h5>
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
            <div class="col-7" >
              <div class="card-body">
                <div id="chart" class="chart"  style="padding-right:100px">
                </div>
              </div>
            </div>
          </div>
          

          <div class="card" style="margin-left: 100px ; margin-right: 100px ; margin-top :40px">
            <h4 class="fw-bold text-primary text-center mt-3">Kesimpulan</h4>
            <p class="p-4">
              Berdasarkan hasil pengolahan AUM UMUM, dapat disimpulan bahwa <span class="fw-bold text-danger"> {{$siswa->nama}} </span>memiliki masalah pada Bidang<span class="fw-bold text-danger"> {{$kateg}} </span> yaitu pada
              masalah nomor <span class="fw-bold text-danger"> {{$masalah}} </span> dengan tingkat persentase masalah sebesar <span class="fw-bold text-success"> {{$p}}% </span>.Setelah pengisian AUM UMUM ini, diharapkan untuk
              bisa mengonsultasikan permasalahan yang dirasa cukup berat. Bisa menemui Guru Bimbingan Konseling (BK), Psikolog, maupun Orang-orang yang kamu percayai untuk mecurahkan dan mampu membantu mengatasi masalahMu.
              <br><br>
              Bimbingan yang diberikan kepada <span class="fw-bold text-danger"> {{$siswa->nama}} </span> adalah bimbingan pribadi terutama pada bidang untuk mendalami masalah {{$kateg}}.

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
              text: 'Grafik Masalah'
          },
          subtitle: {
              text: {!! json_encode($siswa->nama) !!}
          },
          xAxis: {
              categories: {!! json_encode($kategori) !!},
              crosshair: true
          },
          yAxis: {
              title: {
                  useHTML: true,
                  text: 'Jumlah Masalah'
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
              foreach($dataCharts as $dataChart) {
                  echo "['".$dataChart->kode_kategori."', ".$dataChart->jumlah_ya."],";
              }
            @endphp
    ]);
  
    var options = {
      title: "Grafik Masalah",
      bar: {groupWidth: '50%'},
      legend: 'none',
    };
  
    var chart_div = document.getElementById('chart_div');
    var chart_input = document.getElementById('chart_input');
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