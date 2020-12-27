@extends('admin.layout')
@section('body')

<div class="row">
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
        <div class="card bg-gradient-primary text-white text-center card-shadow-primary">
            <div class="card-body">
                <h6 class="font-weight-normal">Tổng số sản phẩm bán ra</h6>
                <h2 class="mb-0" style="font-size: 20px;"><?php echo $product_data ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
        <div class="card bg-gradient-danger text-white text-center card-shadow-danger">
            <div class="card-body">
                <h6 class="font-weight-normal">Tổng số khách hàng</h6>
                <h2 class="mb-0" style="font-size: 20px;"><?php echo $customer_data ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
        <div class="card bg-gradient-warning text-white text-center card-shadow-warning">
            <div class="card-body">
                <h6 class="font-weight-normal">Số đơn thành công</h6>
                <h2 class="mb-0" style="font-size: 20px;"><?php echo $order_data ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
        <div class="card bg-gradient-info text-white text-center card-shadow-info">
            <div class="card-body">
                <h6 class="font-weight-normal">Tổng doanh thu</h6>
                <h2 class="mb-0" style="font-size: 20px;"><?php echo number_format($prices_data) ?> đ</h2>
            </div>
        </div>
    </div>
</div>

<div class="row grid-margin">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Top lượt quan tâm</h4>
                <div class="table-responsive mt-2">
                    <table class="table mt-3 border-top">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Lượt xem</th>
                                <th>Đã bán ra</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($trending_data as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->name ?></td>
                                <td><?php echo $value->view ?></td>
                                <td><?php echo $value->order_detail[0]->total ?></td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Top lượt mua hàng</h4>
                <div class="table-responsive mt-2">
                    <table class="table mt-3 border-top">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Đã bán ra</th>
                                <th>Lượt xem</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($buying_data as $key => $value): ?>
                            <tr>
                                <td><?php echo $value->name ?></td>
                                <td><?php echo $value->order_detail[0]->total ?></td>
                                <td><?php echo $value->view ?></td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tỉ lệ mua hàng</h4>
                <div class="ct-chart ct-perfect-fourth buy_percent" id="ct-chart-pie"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tỉ lệ sản phẩm</h4>
                <div class="ct-chart ct-perfect-fourth product_percent" id="ct-chart-donut"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="float: left;">Thống kê doanh thu</h4>
                <button type="submit" class="btn btn-primary mr-2" style="float: right; margin: 0 10px; height: 38px">Lọc</button>
                <select class="form-control" id="exampleSelectGender" style="float: right;width: 150px;">
                    <option>12-2020</option>
                    <option>01-2021</option>
                </select>
                <canvas id="areaChart"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="float: left;">Thống kê bán hàng</h4>
                <button type="submit" class="btn btn-primary mr-2" style="float: right; margin: 0 10px; height: 38px">Lọc</button>
                <select class="form-control" id="exampleSelectGender" style="float: right;width: 150px;">
                    <option>12-2020</option>
                    <option>01-2021</option>
                </select>
                <canvas id="areaChart2"></canvas>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  
  $(function() {


  //Pie
  var pielabels = ['Thành công', 'Hủy'];
  if ($('#ct-chart-pie').length) {
    var datapie = {
      series: [<?php echo $buying_success ?>, <?php echo $buying_remove ?>]
    };

    var sum = function(a, b) {
      return a + b
    };

    new Chartist.Pie('#ct-chart-pie', datapie, {
      labelInterpolationFnc: function(value, index) {
        var percentage = Math.round(value / datapie.series.reduce(sum) * 100) + '%';
        return pielabels[index] + ' ' + percentage;
      }
    });
  }

  //Donut
  var labels = ['Nam', 'Nữ'];
  var data = {
    series: [<?php echo $product_man ?>, <?php echo $product_woman ?>]
  };

  if ($('#ct-chart-donut').length) {
    new Chartist.Pie('#ct-chart-donut', data, {
      donut: true,
      donutWidth: 60,
      donutSolid: true,
      startAngle: 270,
      showLabel: true,
      labelInterpolationFnc: function(value, index) {
        var percentage = Math.round(value / data.series.reduce(sum) * 100) + '%';
        return labels[index] + ' ' + percentage;
      }
    });
  }



  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };
  var areaData = {
    labels: [
      <?php 
        for ($i=1; $i <= 31 ; $i++) { 
          echo '"' . $i . '",';
        }
      ?>],
    datasets: [{
      label: '',
      data: [100000, 300000, 1100000, 200000, 100000, 100000, 400000, 100000, 100000, 1100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 100000, 50000, 100000, 200000, 300000, 100000, 0, 100000, 100000, 100000, 100000, 100000, 100000, 100000],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: true, // 3: no fill
    }]
  };
  var areaData2 = {
    labels: [
      <?php 
        for ($i=1; $i <= 31 ; $i++) { 
          echo '"' . $i . '",';
        }
      ?>],
    datasets: [{
      label: '',
      data: [12, 19, 3, 12, 19, 3, 5, 2, 3, 3, 12, 19, 3, 5, 2, 3, 3, 12, 19, 3, 5, 2, 3, 3, 5, 2, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: true, // 3: no fill
    }]
  };

  var areaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    }
  }



  if ($("#areaChart").length) {
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    var areaChart = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaData,
      options: areaOptions
    });
  }
  if ($("#areaChart2").length) {
    var areaChartCanvas = $("#areaChart2").get(0).getContext("2d");
    var areaChart2 = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaData2,
      options: areaOptions
    });
  }

});
</script>
@endsection()

@section('js')
  <!-- Custom js for this page-->
  <!-- <script src="{{ asset('js/chart.js') }}"></script> -->
  <!-- <script src="{{ asset('js/chartist.js') }}"></script> -->
@endsection()