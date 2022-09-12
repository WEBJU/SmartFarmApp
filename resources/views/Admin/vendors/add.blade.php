@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.vendors') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.add_vendor') }}</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
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
                                <form class="form" method="post" action="{{ route('admin.vendors.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label>{{ trans('labels.first_name') }}</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{old('first_name')}}" placeholder="{{ trans('labels.first_name') }}">
                                            @if ($errors->has('first_name'))
                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>{{ trans('labels.last_name') }}</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{old('last_name')}}" placeholder="{{ trans('labels.last_name') }}">
                                            @if ($errors->has('last_name'))
                                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>{{ trans('labels.email') }}</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="{{ trans('labels.email') }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>{{ trans('labels.mobile') }}</label>
                                            <input type="text" class="form-control" name="mobile" id="mobile" value="{{old('mobile')}}" placeholder="{{ trans('labels.mobile') }}">
                                            @if ($errors->has('mobile'))
                                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>{{ trans('labels.password') }}</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="{{ trans('labels.password') }}">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>{{ trans('labels.confirm_password') }}</label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('labels.confirm_password') }}">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.vendors') }}" class="btn btn-raised btn-warning mr-1">
                                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                                        </a>
                                        <button type="submit" class="btn btn-raised btn-primary">
                                            <i class="fa fa-check-square-o"></i> {{ trans('labels.save') }}
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

@section('script')