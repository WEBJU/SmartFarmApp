@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.orders') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif

        @if(Session::has('danger'))
        <div class="alert alert-danger">
            {{ Session::get('danger') }}
            @php
                Session::forget('danger');
            @endphp
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h4>{{ trans('labels.invoice') }}</h4>
            </div>
        </div>
        <section class="invoice-template">
            <div class="card">
                <div class="card-body p-3">
                    <div id="invoice-template" class="card-block">
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-6 text-left">
                                <img src="{{$order_info['vendors']->image_url}}" alt="company logo" class="mb-2" width="70">
                                <ul class="px-0 list-unstyled">
                                    <li>{{$order_info['vendors']->store_address}}</li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <h2>{{ trans('labels.invoice') }}</h2>
                                <p class="pb-3"># {{$order_info->order_number}}</p>
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->
                        <!-- Invoice Customer Details -->
                        <div id="invoice-customer-details" class="row pt-2">
                            <div class="col-sm-12 text-left">
                                <p class="text-muted">{{ trans('labels.bill_to') }}</p>
                            </div>
                            <div class="col-6 text-left">
                                <ul class="px-0 list-unstyled">
                                    <li class="text-bold-800">{{$order_info->full_name}}</li>
                                    <li class="text-bold-800">{{$order_info->email}}</li>
                                    <li class="text-bold-800">{{$order_info->mobile}}</li>
                                    <li>{{$order_info->street_address}},</li>
                                    <li>{{$order_info->landmark}},</li>
                                    <li>{{$order_info->pincode}}.</li>
                                </ul>
                            </div>
                            <div class="col-6 text-right">
                                <p><span class="text-muted">{{ trans('labels.invoice_date') }} :</span> {{$order_info->date}}</p>
                            </div>
                        </div>
                        <!--/ Invoice Customer Details -->
                        <!-- Invoice Items Details -->
                        <div id="invoice-items-details" class="pt-2">
                            <div class="row">
                                <div class="table-responsive col-sm-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('labels.image') }}</th>
                                                <th>{{ trans('labels.name') }}</th>
                                                <th>{{ trans('labels.price') }}</th>
                                                <th>{{ trans('labels.qty') }}</th>
                                                <th>{{ trans('labels.tax') }}</th>
                                                <th>{{ trans('labels.shipping_charge') }}</th>
                                                <th>{{ trans('labels.status') }}</th>
                                                <th>{{ trans('labels.order_total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order_data as $row)

                                            @if ($row->discount_amount == "")
                                            122
                                                @php $grand_total = $row->subtotal+$row->tax+$row->shipping_cost; @endphp
                                            @else
                                                @php $grand_total = $row->subtotal+$row->tax+$row->shipping_cost-$row->discount_amount; @endphp
                                            @endif
                                            <tr>
                                                <td><img class="media-object round-media height-50" src="{{$row->image_url}}" alt="Generic placeholder image" /></td>
                                                <td>{{$row->product_name}} @if($row->variation != "")({{$row->variation}}) @endif</td>
                                                <td>{{Helper::CurrencyFormatter($row->price)}}</td>
                                                <td>{{$row->qty}}</td>
                                                <td>{{Helper::CurrencyFormatter($row->tax)}}</td>
                                                <td>{{Helper::CurrencyFormatter($row->shipping_cost)}}</td>
                                                @if(Auth::user()->roles->first()->name == "super-admin")
                                                <td> 
                                                    @if ($row->status == 1)
                                                        {{ trans('labels.order_placed') }}
                                                    @endif
                                                    @if ($row->status == 2)
                                                        {{ trans('labels.confirmed') }}
                                                    @endif
                                                    @if ($row->status == 3)
                                                        {{ trans('labels.order_shipped') }}
                                                    @endif
                                                    @if ($row->status == 4)
                                                        {{ trans('labels.delivered') }}
                                                    @endif
                                                    @if ($row->status == 5)
                                                        Order cancelled by vendor
                                                    @endif
                                                    @if ($row->status == 6)
                                                        Order cancelled by user
                                                    @endif
                                                    @if ($row->status == 7)
                                                        Return request raised
                                                    @endif
                                                    @if ($row->status == 8)
                                                        {{ trans('labels.return_in_progress') }}
                                                    @endif
                                                    @if ($row->status == 9)
                                                        {{ trans('labels.return_complete') }}
                                                    @endif
                                                    @if ($row->status == 20)
                                                        {{ trans('labels.return_rejected') }}
                                                    @endif
                                                </td>
                                                @endif
                                                @if(Auth::user()->roles->first()->name == "admin")
                                                <td id="tdstatus{{$row->id}}"> 
                                                    <div class="btn-group">
                                                        @if ($row->status != 4)
                                                            @if ($row->status != 5 && $row->status != 7 && $row->status != 8 && $row->status != 9 && $row->status != 10)
                                                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                                                @if ($row->status == 1)
                                                                    {{ trans('labels.order_placed') }}
                                                                @endif
                                                                @if ($row->status == 2)
                                                                    {{ trans('labels.confirmed') }}
                                                                @endif
                                                                @if ($row->status == 3)
                                                                    {{ trans('labels.order_shipped') }}
                                                                @endif
                                                                @if ($row->status == 4)
                                                                    {{ trans('labels.delivered') }}
                                                                @endif
                                                                <span class="caret"></span>
                                                            </a>
                                                            @endif
                                                            <ul class="dropdown-menu">
                                                                @if ($row->status == 1)
                                                                    <button class="dropdown-item changeStatus active" data-id="{{$row->id}}"  data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="2">{{ trans('labels.confirmed') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="3">{{ trans('labels.order_shipped') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="4">{{ trans('labels.delivered') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                @endif
                                                                @if ($row->status == 2)
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                    <button class="dropdown-item changeStatus active" data-id="{{$row->id}}"  data-status="2">{{ trans('labels.confirmed') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="3">{{ trans('labels.order_shipped') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="4">{{ trans('labels.delivered') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                @endif
                                                                @if ($row->status == 3)
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="2">{{ trans('labels.confirmed') }}</button>
                                                                    <button class="dropdown-item changeStatus active" data-id="{{$row->id}}"  data-status="3">{{ trans('labels.order_shipped') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="4">{{ trans('labels.delivered') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                @endif
                                                                @if ($row->status == 4)
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="1">{{ trans('labels.order_placed') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="2">{{ trans('labels.confirmed') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="3">{{ trans('labels.order_shipped') }}</button>
                                                                    <button class="dropdown-item changeStatus active"  data-id="{{$row->id}}" data-status="4">{{ trans('labels.delivered') }}</button>
                                                                    <button class="dropdown-item changeStatus"  data-id="{{$row->id}}" data-status="5">{{ trans('labels.cancelled') }}</button>
                                                                @endif
                                                            </ul>
                                                            @if ($row->status == 5)
                                                                <button class="btn btn-flat btn-danger">{{ trans('labels.cancelled') }}</button>
                                                            @endif
                                                            @if ($row->status == 7)
                                                                <button class="btn btn-flat btn-danger">{{ trans('labels.return') }}</button>
                                                            @endif
                                                            @if ($row->status == 8)
                                                                <button class="btn btn-flat btn-danger">{{ trans('labels.return_in_progress') }}</button>
                                                            @endif
                                                            @if ($row->status == 9)
                                                                <button class="btn btn-flat btn-danger">{{ trans('labels.return_complete') }}</button>
                                                            @endif
                                                            @if ($row->status == 10)
                                                                <button class="btn btn-flat btn-danger">{{ trans('labels.return_rejected') }}</button>
                                                            @endif
                                                        @else
                                                            <button class="btn btn-flat btn-success">{{ trans('labels.delivered') }}</button>
                                                        @endif
                                                    </div>
                                                </td>
                                                @endif
                                                <td>{{Helper::CurrencyFormatter($row->order_total)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 text-left">
                                    <p class="lead">Payment Methods:</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <!-- payment_type = COD : 1, Wallet : 2, RazorPay : 3, Stripe : 4, Flutterwave : 5 , Paystack : 6-->
                                                    <td>
                                                        @if($order_info->payment_type == 1)
                                                            {{ trans('labels.cod') }}
                                                        @endif

                                                        @if($order_info->payment_type == 2)
                                                            {{ trans('labels.wallet') }}
                                                        @endif

                                                        @if($order_info->payment_type == 3)
                                                            {{ trans('labels.RazorPay') }}
                                                        @endif

                                                        @if($order_info->payment_type == 4)
                                                            {{ trans('labels.Stripe') }}
                                                        @endif

                                                        @if($order_info->payment_type == 5)
                                                            {{ trans('labels.Flutterwave') }}
                                                        @endif

                                                        @if($order_info->payment_type == 6)
                                                            {{ trans('labels.Paystack') }}
                                                        @endif
                                                    </td>
                                                    <td class="text-right">{{$order_info->payment_id}}</td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p class="lead">{{ trans('labels.Total_due') }}</p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>{{ trans('labels.sub_total') }}</td>
                                                    <td class="text-right">{{Helper::CurrencyFormatter($order_info->subtotal)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ trans('labels.tax') }}</td>
                                                    <td class="text-right">{{Helper::CurrencyFormatter($order_info->tax)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ trans('labels.Shipping_charges') }}</td>
                                                    <td class="text-right">{{Helper::CurrencyFormatter($order_info->shipping_cost)}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-800">{{ trans('labels.total') }}</td>
                                                    <td class="text-bold-800 text-right">{{Helper::CurrencyFormatter($order_info->grand_total)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Footer -->
                        <!--/ Invoice Footer -->
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@section('scripttop')
@endsection
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    //Change Status
    $('body').on('click','.changeStatus',function() {
        let status=$(this).attr('data-status');
        let id=$(this).attr('data-id');
        Swal.fire({
            title: '{{ trans('labels.are_you_sure') }}',
            text: "{{ trans('labels.change_status') }}",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('labels.yes') }}',
            cancelButtonText: '{{ trans('labels.no') }}'
        }).then((t) => {
            if(t.value==true){
                $('#preloader').show();
                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route("admin.orders.changeStatus")}}',
                    type: "POST",
                    data : {'id':id,'status':status},
                    success:function(data)
                    { 
                        $('#preloader').hide();
                        location.reload();
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: '{{ trans('labels.cancelled') }}',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>
@endsection