@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.payments') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{$paymentdetails->payment_name}} {{ trans('labels.payment_configuration') }} </div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            @if(Session::has('danger'))
                            <div class="alert alert-danger">
                                {{ Session::get('danger') }}
                                @php
                                    Session::forget('danger');
                                @endphp
                            </div>
                            @endif
                            <div class="px-3">
                                <form class="form" method="post" action="{{ route('admin.payments.update') }}">
                                @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="id" id="id" value="{{$paymentdetails->id}}" class="form-control">
                                        <div class="form-group">
                                            <label>{{ trans('labels.Environment') }}</label>
                                            <select id="environment" name="environment" class="form-control">
                                                <option selected="selected" value="">{{ trans('labels.Choose') }}</option>
                                                <option value="0" {{$paymentdetails->environment == 0  ? 'selected' : ''}}>{{ trans('labels.Production') }}</option>
                                                <option value="1" {{$paymentdetails->environment == 1  ? 'selected' : ''}}>{{ trans('labels.Sendbox') }}</option>
                                            </select>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                @if($paymentdetails->payment_name == "Stripe")
                                                <label>
                                                        {{ trans('labels.Stripe_public_key') }}
                                                </label>
                                                <input type="text" name="test_public_key" class="form-control" placeholder="{{ trans('labels.Stripe_public_key') }}" value="{{$paymentdetails->test_public_key}}">
                                                @endif

                                                @if($paymentdetails->payment_name == "RazorPay")
                                                <label>
                                                        {{ trans('labels.RazorPay_public_key') }}
                                                </label>
                                                <input type="text" name="test_public_key" class="form-control" placeholder="{{ trans('labels.RazorPay_public_key') }}" value="{{$paymentdetails->test_public_key}}">
                                                @endif

                                                @if($paymentdetails->payment_name == "Flutterwave")
                                                <label>
                                                        {{ trans('labels.Flutterwave_public_key') }}
                                                </label>
                                                <input type="text" name="test_public_key" class="form-control" placeholder="{{ trans('labels.Flutterwave_public_key') }}" value="{{$paymentdetails->test_public_key}}">
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                @if($paymentdetails->payment_name == "Stripe")
                                                <label>
                                                        {{ trans('labels.Stripe_Secret_key') }}
                                                </label>
                                                <input type="text" name="test_secret_key" class="form-control" placeholder="{{ trans('labels.Stripe_Secret_key') }}" value="{{$paymentdetails->test_secret_key}}">
                                                @endif 

                                                @if($paymentdetails->payment_name == "RazorPay")
                                                <label>
                                                        {{ trans('labels.RazorPay_Secret_key') }}
                                                </label>
                                                <input type="text" name="test_secret_key" class="form-control" placeholder="{{ trans('labels.RazorPay_Secret_key') }}" value="{{$paymentdetails->test_secret_key}}">
                                                @endif

                                                @if($paymentdetails->payment_name == "Flutterwave")
                                                <label>
                                                        {{ trans('labels.Flutterwave_Secret_key') }}
                                                </label>
                                                <input type="text" name="test_secret_key" class="form-control" placeholder="{{ trans('labels.Flutterwave_Secret_key') }}" value="{{$paymentdetails->test_secret_key}}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            @if($paymentdetails->payment_name == "Stripe")
                                            <label>
                                                    {{ trans('labels.Stripe_Production_Public_key') }}
                                            </label>
                                            <input type="text" name="live_public_key" class="form-control" placeholder="{{ trans('labels.Stripe_Production_Public_key') }}" value="{{$paymentdetails->live_public_key}}">
                                            @endif

                                            @if($paymentdetails->payment_name == "RazorPay") 
                                            <label>
                                                    {{ trans('labels.RazorPay_Production_Public_key') }}
                                            </label>
                                            <input type="text" name="live_public_key" class="form-control" placeholder="{{ trans('labels.RazorPay_Production_Public_key') }}" value="{{$paymentdetails->live_public_key}}">
                                            @endif

                                            @if($paymentdetails->payment_name == "Flutterwave") 
                                            <label>
                                                    {{ trans('labels.Flutterwave_Production_Public_key') }}
                                            </label>
                                            <input type="text" name="live_public_key" class="form-control" placeholder="{{ trans('labels.Flutterwave_Production_Public_key') }}" value="{{$paymentdetails->live_public_key}}">
                                            @endif

                                        </div>
                                        <div class="form-group col-md-6">
                                            @if($paymentdetails->payment_name == "Stripe")
                                            <label>
                                                    {{ trans('labels.Stripe_Production_Secret_key') }}
                                            </label>
                                            <input type="text" name="live_secret_key" class="form-control" placeholder="{{ trans('labels.Stripe_Production_Secret_key') }}" value="{{$paymentdetails->live_secret_key}}">
                                            @endif

                                            @if($paymentdetails->payment_name == "RazorPay") 
                                            <label>
                                                    {{ trans('labels.RazorPay_Production_Secret_key') }}
                                            </label>
                                            <input type="text" name="live_secret_key" class="form-control" placeholder="{{ trans('labels.RazorPay_Production_Secret_key') }}" value="{{$paymentdetails->live_secret_key}}">
                                            @endif

                                            @if($paymentdetails->payment_name == "Flutterwave") 
                                            <label>
                                                    {{ trans('labels.Flutterwave_Production_Secret_key') }}
                                            </label>
                                            <input type="text" name="live_secret_key" class="form-control" placeholder="{{ trans('labels.Flutterwave_Production_Secret_key') }}" value="{{$paymentdetails->live_secret_key}}">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            @if($paymentdetails->payment_name == "Flutterwave") 
                                            <label>
                                                    {{ trans('labels.encryption_key') }}
                                            </label>
                                            <input type="text" name="encryption_key" class="form-control" placeholder="{{ trans('labels.encryption_key') }}" value="{{$paymentdetails->encryption_key}}">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.payments') }}" class="btn btn-raised btn-warning mr-1">
                                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                                        </a>
                                        <button type="submit" class="btn btn-raised btn-primary">
                                            <i class="fa fa-check-square-o"></i> {{ trans('labels.update') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@section('scripttop')
@endsection