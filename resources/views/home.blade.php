@extends('layouts.app')

@section('content')
<div class="card w-100 p-3 mt-4">
  <div id="barChart"></div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var options = {
      chart: {
        type: 'bar',
        height: 400
      },
      series: [{
        name: 'Ditanggapi',
        data: @json($kategori1Data)
      }, {
        name: 'Belum Ditanggapi',
        data: @json($kategori2Data)
      }],
      xaxis: {
        categories: @json($labels)
      },
      colors: ['#7396F5', '#72C8FD'],
      plotOptions: {
        bar: {
          columnWidth: '40%',
          borderRadius: 6
        }
      },
      dataLabels: {
        enabled: false
      },
      legend: {
        position: 'top'
      }
    };

    var chart = new ApexCharts(document.querySelector("#barChart"), options);
    chart.render();
  });
</script>



@endsection
