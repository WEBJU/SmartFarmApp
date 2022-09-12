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
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    @endif
                    <div class="card">                       
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('labels.orders') }}</h4>
                        </div>

                        <div class="col-md-4">
                            <form method="GET" action="{{route('admin.orders.search')}}">
                                <div class="input-group">
                                    <input type="text" id="search" name="search" placeholder="Type & Enter" value="{{ request()->get('search') }}" class="form-control round">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="basic-addon4"><i class="ft-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                                @include('Admin.orders.ordersstable')
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