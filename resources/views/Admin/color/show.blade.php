@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.color') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.edit_color') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.color.update') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="color_id" id="color_id" value="{{$data->id}}" class="form-control">
                                        <div class="form-group">
                                            <label for="color_name">{{ trans('labels.select_color') }}</label>
                                            <input type="color" class="form-control" name="color_name" id="color_name" value="{{$data->color_name}}" style="height: 50px;">
                                            @if ($errors->has('color_name'))
                                                <span class="text-danger">{{ $errors->first('color_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.color') }}" class="btn btn-raised btn-warning mr-1">
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
@section('script')