@extends('layouts.teacher')

@section('content')
<section class="p-3">
  <header>
    <h3>Selamat Datang {{ Auth::guard('guru')->user()->nama }}</h3>
    <h4 class="mt-5">Hasil Analisis Terbaru</h4>
  </header>
</section>




@if ($data_individu==null)

<h2>Belum ada Data</h2>

@elseif($data_individu!=null)

<div class="row">
    <div class="card col-5 " style="margin-right: 30px" >
      <div id="chart_individu" class="chart"></div>
    </div>
    <div class="card col-5 px-2">
      <div id="chart_kelompok" class="chart" ></div>
    </div>
  </div>

  @section('chart')
      

  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script>
  Highcharts.chart('chart_individu', {
  chart: {
      type: 'column'
  },
  title: {
      text: 'Grafik Masalah'
  },
  subtitle: {
      text: {!! json_encode($siswa) !!}
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
      data: {!! json_encode($data_individu) !!}
  
  }]
  });
  
  </script>
  <script>
  Highcharts.chart('chart_kelompok', {
  chart: {
      type: 'column'
  },
  title: {
      text: 'Hasil Analisis Kelompok <br> {!! json_encode($sekolahh) !!} ' 
  },
  subtitle: {
      text: {!! json_encode($kelas) !!}
  },
  xAxis: {
      categories: {!! json_encode($kategori) !!},
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
      data: {!! json_encode($data_kelompok) !!}
  
  }]
  });
  
  </script>
  
  
  @endsection

    
@endif


 
@endsection