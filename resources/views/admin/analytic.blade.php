@extends('admin.layout')
@section('body')

<div class="row">
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
        <div class="card bg-gradient-primary text-white text-center card-shadow-primary">
            <div class="card-body">
                <h6 class="font-weight-normal">Tổng số sản phẩm bán ra</h6>
                <h2 class="mb-0" style="font-size: 20px;">8893</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
        <div class="card bg-gradient-danger text-white text-center card-shadow-danger">
            <div class="card-body">
                <h6 class="font-weight-normal">Tổng số khách hàng</h6>
                <h2 class="mb-0" style="font-size: 20px;">100</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
        <div class="card bg-gradient-warning text-white text-center card-shadow-warning">
            <div class="card-body">
                <h6 class="font-weight-normal">Tổng số đơn hàng</h6>
                <h2 class="mb-0" style="font-size: 20px;">5000</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 grid-margin stretch-card">
        <div class="card bg-gradient-info text-white text-center card-shadow-info">
            <div class="card-body">
                <h6 class="font-weight-normal">Tổng doanh thu</h6>
                <h2 class="mb-0" style="font-size: 20px;">1.324.200.000 đ</h2>
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
                                <th>Lượt mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Áo thun mùa đông</td>
                                <td>302</td>
                                <td>58</td>
                            </tr>
                            <tr>
                                <td>Áo dạ dài</td>
                                <td>103</td>
                                <td>30</td>
                            </tr>
                            <tr>
                                <td>Áo len ngắn</td>
                                <td>102</td>
                                <td>40</td>
                            </tr>
                            <tr>
                                <td>Váy dài</td>
                                <td>52</td>
                                <td>40</td>
                            </tr>
                            <tr>
                                <td>Quần thun</td>
                                <td>42</td>
                                <td>40</td>
                            </tr>
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
                                <th>Lượt xem</th>
                                <th>Lượt mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Áo thun mùa đông</td>
                                <td>302</td>
                                <td>58</td>
                            </tr>
                            <tr>
                                <td>Áo dạ dài</td>
                                <td>103</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>Áo len ngắn</td>
                                <td>102</td>
                                <td>40</td>
                            </tr>
                            <tr>
                                <td>Váy dài</td>
                                <td>52</td>
                                <td>40</td>
                            </tr>
                            <tr>
                                <td>Quần thun</td>
                                <td>42</td>
                                <td>40</td>
                            </tr>
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

@endsection()

@section('js')
  <!-- Custom js for this page-->
  <script src="{{ asset('js/chartist.js') }}"></script>
@endsection()