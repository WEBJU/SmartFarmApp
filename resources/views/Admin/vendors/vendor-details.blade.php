@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | Vendor details
@endsection
@section('css')

@endsection
@section('content')

    <div class="content-wrapper"><!--User Profile Starts-->

        <!--About section starts-->
        <section id="about">
            <div class="row">
                <div class="col-12">
                    <div class="content-header">About</div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-block mt-2">
                                <img src='{!! asset("/storage/app/public/images/profile/".$data->profile_pic) !!}' class='media-object round-media height-50'>
                                <div class="mb-3">
                                    <h3 class="text-bold-500 primary mt-2">{{$data->name}}</h3>
                                    <div class="vendor_ratting">
                                    <i class="icon-star"></i>
                                    <span>({{@$data['rattings']->avg_ratting}} average ratings)</span>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <ul class="no-list-style">
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-mail font-small-3"></i> Email:</a></span>
                                                <a class="display-block overflow-hidden">{{$data->email}}</a>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-smartphone font-small-3"></i> Phone Number:</a></span>
                                                <span class="display-block overflow-hidden">{{$data->mobile}}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-home font-small-3"></i> Address:</a></span>
                                                <span class="display-block overflow-hidden">{{$data->store_address}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <ul class="no-list-style">
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-smartphone font-small-3"></i> Status:</a></span>
                                                <span class="display-block overflow-hidden">
                                                    @if($data->is_verified == 0)
                                                        Unverified
                                                    @else
                                                        Verified
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-monitor font-small-3"></i> Website:</a></span>
                                                <a class="display-block overflow-hidden"><a href="{{URL::to('vendor-details/'.$data->id)}}" target="_blank"> Go to store</a>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> Joined:</a></span>
                                                <span class="display-block overflow-hidden">{{$data->created_at}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <ul class="no-list-style">
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-monitor font-small-3"></i> Bank name:</a></span>
                                                <span class="display-block overflow-hidden">{{@$bankdata->bank_name}}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> Account type:</a></span>
                                                <span class="display-block overflow-hidden">{{@$bankdata->account_type}}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> Account number:</a></span>
                                                <span class="display-block overflow-hidden">{{@$bankdata->account_number}}</span>
                                            </li>
                                            <li class="mb-2">
                                                <span class="text-bold-500 primary"><a><i class="ft-book font-small-3"></i> Routing number:</a></span>
                                                <span class="display-block overflow-hidden">{{@$bankdata->routing_number}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0">Monthly orders</h4>
                    </div>
                    <div class="card-body">
                      <p class="font-medium-2 text-muted text-center pb-2">Last 6 Months Sales</p>
                      <div class="card-block">
                        <div id="piechart" class="height-400 lineAreaDashboard">
                        </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row" matchHeight="card">
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>{{$ttlorders}}</h3>
                                            <span>Total Orders</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-speedometer white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>{{$ttlcancelorders}}</h3>
                                            <span>Total cancelled order</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-close white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-left align-self-center">
                                            <i class="icon-action-undo white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body white text-right">
                                            <h3>{{$ttlreturnorders}}</h3>
                                            <span>Total return order</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-primary">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-left align-self-center">
                                            <i class="icon-graph white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body white text-right">
                                            <h3>{{$ttlpendingorders}}</h3>
                                            <span>Total pending order</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-success">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>Ksh.{{$ttlearning}}</h3>
                                            <span>Total Earning</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-bar-chart white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <div class="px-3 py-3">
                                    <div class="media">
                                        <div class="media-body white text-left">
                                            <h3>Ksh.{{$ttlpending->wallet}}</h3>
                                            <span>Pending Settlement</span>
                                        </div>
                                        <div class="media-right align-self-center">
                                            <i class="icon-wallet white font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="striped-light">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Transaction history</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>Vendor name</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Paid at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payoutdetails as $row)
                                        <tr>
                                            <td>{{$row->request_id}}</td>
                                            <td>{{$row['vendors']->name}}</td>
                                            <td>
                                                Requested amount : <b>{{Helper::CurrencyFormatter($row->amount)}}</b> <br>
                                                Admin commission ({{$row->commission_pr}}%) : - <b>{{Helper::CurrencyFormatter($row->commission)}}</b> <br><br>
                                                Payable amount : <b>{{Helper::CurrencyFormatter($row->paid_amount)}}</b>
                                            </td>
                                            <td>
                                                @if($row->status == 1)
                                                    <span class="badge badge-warning">Pending</span>
                                                @else
                                                    <span class="badge badge-success">Paid</span>
                                                @endif
                                            </td>
                                            <td>{{$row->paid_at}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--About section ends-->
    </div>

@endsection
@section('scripttop')
@endsection
@section('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // 
    google.charts.load('current', {'packages':['corechart']});

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Month Name', 'amount'],

            @php
            foreach($orders as $order) {
                echo "['".$order->month_name."', ".$order->amount."],";
            }
            @endphp
    ]);

      var options = {
        title: 'Monthly earnings',
        is3D: true,
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
</script>
@endsection