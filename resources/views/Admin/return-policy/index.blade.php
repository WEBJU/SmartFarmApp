@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.settings') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.return-policy') }}</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
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
                                <form class="form" method="post" action="{{ route('admin.return-policy.update') }}">
                                @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>
                                                        {{ trans('labels.return-policy') }}
                                                </label>
                                                <textarea class="form-control" name="return_policies" id="return_policies" rows="5" placeholder="{{ trans('placeholder.return-policy') }}">{{$data->return_policies}}</textarea>
                                                @if ($errors->has('return_policies'))
                                                    <span class="text-danger">{{ $errors->first('return_policies') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-actions right">
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